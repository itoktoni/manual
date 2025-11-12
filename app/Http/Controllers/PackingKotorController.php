<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Http\Requests\BersihKotorTransaksiRequest;
use App\Http\Requests\PackingKotorTransaksiRequest;
use App\Models\BersihKotor;
use App\Models\Customer;
use App\Models\DetailKotor;
use App\Traits\ControllerHelper;
use Illuminate\Http\Request;

class PackingKotorController extends Controller
{
    use ControllerHelper;

    protected $model;
    protected $transaksi;

    public function getCode()
    {
        return 'bkotor_code';
    }

     public function __construct(BersihKotor $model, BersihKotor $transaksi)
    {
        $this->model = $model;
        $this->transaksi = $transaksi;
    }

    public function share($data = [])
    {
        $customer = Query::getCustomerData();

        return array_merge([
            'model' => false,
            'transaksi' => false,
            'type' => TransactionType::KOTOR,
            'customer' => $customer,
            'jenis' => [],
        ], $data);
    }


    public function index()
    {
        return redirect()->route($this->module('getData'));
    }

    public function getData()
    {
        $perPage = request('perpage', 10);
        $data = $this->model->addSelect('*')
            ->leftJoinRelationship('has_customer')
            ->leftJoinRelationship('has_jenis')
            ->filter(request())
            ->paginate($perPage);

        return $this->views($this->module(), [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCreate()
    {
        $qc = DetailKotor::where('customer_code', request()->get('customer'))
            ->where('tanggal', request()->get('tanggal'))
            ->where('jenis_id', request()->get('jenis'))
            ->first();

        $jenis = Query::getJenisData(request()->get('customer'));

        return $this->views($this->module('form'), [
            'qc' => $qc,
            'jenis' => $jenis,
        ]);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function postCreate(PackingKotorTransaksiRequest $request)
    {
        $data = $request->get('data');
        $check = BersihKotor::create($data);

        if($check)
        {
            return redirect()->route($this->module('getPrint'), ['code' => $check->field_key])->with('success', 'created successfully');
        }

        return redirect()->back()->with('error', 'creation failed');
    }

    /**
     * Display the specified resource.
     */
    public function getShow($code)
    {
        $this->model = $this->getModel($code, ['has_transaksi']);
        return $this->views($this->module(), $this->share([
            'model' => $this->model,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getUpdate($code)
    {
        $model = $this->model->where($this->model->field_key(), $code)->firstOrFail();
        $jenis = Query::getJenisData($model->bkotor_code_customer);

        $qc = DetailKotor::where('customer_code', $model->bkotor_code_customer)
            ->where('tanggal', $model->bkotor_tanggal)
            ->where('jenis_id', $model->bkotor_id_jenis)
            ->first();

        return $this->views($this->module(true).'.form', $this->share([
            'model' => $model,
            'jenis' => $jenis,
            'qc' => $qc,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(PackingKotorTransaksiRequest $request, BersihKotor $model)
    {
        return $this->update($request->get('data'), $model);
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

    public function getPrint($code)
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $data = $this->model->select('*')
            ->leftJoinRelationship('has_jenis')
            ->leftJoinRelationship('has_customer')
            ->where($this->model->field_key(), $code)
            ->get();

        $customer = null;
        $model = $data->first();

        if(!empty($model))
        {
            $customer = Customer::where('customer_code', $model->bkotor_code_customer)->first();
        }

        return $this->views($this->module('print'), [
            'data' => $data,
            'model' => $model,
            'customer' => $customer,
        ]);
     }
}