<?php

namespace App\Http\Controllers;

use App\Helpers\Query;
use App\Models\Jenis;
use App\Models\Rs;
use App\Traits\ControllerHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class JenisController extends Controller
{
    use ControllerHelper;

    protected $model;

    public function __construct(Jenis $model)
    {
        $this->model = $model;
    }

    public function share($data = [])
    {
        $rs = Query::getRsData();

        return array_merge([
            'model' => false,
            'rs' => $rs,
        ], $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route($this->module('getData'));
    }

    public function getData()
    {
        $perPage = request('perpage', 10);
        $data = $this->model->leftJoinRelationship('has_rs')
            ->addSelect('rs.rs_nama as rs_nama')
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
      * Show the form for uploading data.
      */
    public function getUpload()
    {
         return $this->views($this->module('upload'));
    }

    /**
      * Download the template for upload.
      */
    public function getTemplate()
    {
        $data = [
            ['rs_code' => 'RS001', 'nama' => 'Jenis Example', 'harga' => 10000, 'fee' => 500],
            ['rs_code' => 'RS002', 'nama' => 'Another Jenis', 'harga' => 15000, 'fee' => 750],
        ];

        return response()->stream(function () use ($data) {
            SimpleExcelWriter::create('php://output', 'xlsx')->addRows($data);
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="jenis_template.xlsx"',
        ]);
    }

    /**
      * Store a newly created resource in storage.
      */
    public function postCreate(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('jenis_file')) {
            $file = $request->file('jenis_file');
            $path = $file->store('jenis_files', 'public');
            $data['jenis_file'] = $path;
        }

        return $this->create($data);
    }

    /**
      * Handle the uploaded file and insert data.
      */
    public function postUpload(Request $request)
    {
        $request->validate([
            'jenis_file' => ['required', 'file', 'mimes:xlsx', 'max:2048'],
        ]);

        $file = $request->file('jenis_file');

        $rows = SimpleExcelReader::create($file->getPathname(), 'xlsx')->getRows();

        $inserted = 0;
        $errors = [];

        foreach ($rows as $row) {
            try {
                $data = [
                    'jenis_code_rs' => $row['rs_code'] ?? null,
                    'jenis_nama' => $row['nama'] ?? null,
                    'jenis_harga' => $row['harga'] ?? 0,
                    'jenis_fee' => $row['fee'] ?? 0,
                ];

                // Validate each row
                $validator = validator($data, $this->model->rules());

                if ($validator->fails()) {
                    $errors[] = 'Row error: ' . implode(', ', $validator->errors()->all());
                    continue;
                }

                $this->model->updateOrCreate($data, ['jenis_code_rs', 'jenis_nama']);

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
    public function postUpdate(Request $request, Jenis $jenis)
    {
        $data = $request->all();

        if ($request->hasFile('jenis_file')) {
            // Delete old file if exists
            if ($jenis->jenis_file) {
                Storage::disk('public')->delete($jenis->jenis_file);
            }
            $file = $request->file('jenis_file');
            $path = $file->store('jenis_files', 'public');
            $data['jenis_file'] = $path;
        }

        return $this->update($data, $jenis);
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