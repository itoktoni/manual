<?php

namespace App\Http\Controllers;

use App\Helpers\Query;
use App\Models\Ruangan;
use App\Traits\ControllerHelper;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class RuanganController extends Controller
{
    use ControllerHelper;

    protected $model;

    public function __construct(Ruangan $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route($this->module('getData'));
    }

    public function share($data = [])
    {
        $customer = Query::getCustomerData();

        return array_merge([
            'model' => false,
            'customer' => $customer,
        ], $data);
    }

    public function getData()
    {
        $perPage = request('perpage', 10);
        $data = $this->model->leftJoinRelationship('has_customer')
            ->addSelect('customer.customer_nama as customer_nama')
            ->filter(request())
            ->paginate($perPage);
        $data->appends(request()->query());

        return $this->views($this->module(), [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCreate()
    {
        return $this->views($this->module('form'));
    }

    /**
      * Store a newly created resource in storage.
      */
    public function postCreate()
    {
         return $this->create(request()->all());
    }

    /**
      * Show the form for uploading data.
      */
    public function getUpload()
    {
         return $this->views($this->module('upload'));
    }

    /**
      * Handle the uploaded file and insert data.
      */
    public function postUpload(Request $request)
    {
        $request->validate([
            'ruangan_file' => ['required', 'file', 'mimes:xlsx', 'max:2048'],
        ]);

        $file = $request->file('ruangan_file');

        $rows = SimpleExcelReader::create($file->getPathname(), 'xlsx')->getRows();

        $inserted = 0;
        $errors = [];

        foreach ($rows as $row) {
            try {
                $data = [
                    'ruangan_code_rs' => $row['rs'] ?? null,
                    'ruangan_code' => $row['code'] ?? null,
                    'ruangan_nama' => $row['nama'] ?? null,
                ];

                // Validate each row
                $validator = validator($data, $this->model->rules());

                if ($validator->fails()) {
                    $errors[] = 'Row error: ' . implode(', ', $validator->errors()->all());
                    continue;
                }

                $this->model->updateOrCreate($data, [ 'ruangan_code_rs', 'ruangan_code', 'ruangan_nama']);
                $inserted++;
            } catch (\Exception $e) {
                $errors[] = 'Row error: ' . $e->getMessage();
            }
        }

        $message = "Inserted $inserted records.";
        if (!empty($errors)) {
            $message .= " Errors: " . implode('; ', $errors);
        }

        return redirect()->route($this->module('getData'))->with('success', $message);
    }

    /**
      * Download the template for upload.
      */
    public function getTemplate()
    {
        $data = [
            ['rs' => 'RS01', 'code' => 'R001', 'nama' => 'Ruangan Example'],
            ['rs' => 'RS01', 'code' => 'R002', 'nama' => 'Another Ruangan'],
        ];

        return response()->stream(function () use ($data) {
            SimpleExcelWriter::create('php://output', 'xlsx')->addRows($data);
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="ruangan_template.xlsx"',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function getShow($code)
    {
        $this->model = $this->getModel($code);
        return $this->views($this->module(), $this->share([
            'model' => $this->model,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getUpdate($code)
    {
        $model = $this->model->findOrFail($code);

        return $this->views($this->module(true).'.form', $this->share([
            'model' => $model,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(Request $request, Ruangan $ruangan)
    {
        return $this->update($request->all(), $ruangan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getDelete($code)
    {
        $this->model = $this->model->findOrFail($code);
        $this->model->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }

    public function postBulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        $this->model::whereIn($this->model->field_key(), $ids)->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }
}