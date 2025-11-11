<?php

namespace App\Services;

use App\Helpers\Query;
use App\Http\Requests\TransaksiRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

trait KotorTransaksiService
{
    abstract public function getCode();
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
        $data = $this->model->filter(request())->paginate($perPage);
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
        $jenis = Query::getJenisData(request()->get('customer'));

        return $this->views($this->module('form'), [
            'jenis' => $jenis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCreate(TransaksiRequest $request)
    {
        $data = $this->transaksi->insert($request->get('data'));

        if($data)
        {
            return redirect()->route( $this->module('getUpdate'), ['code' => $request->get('code')])->with('success', 'created successfully');
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
        $model = $this->model->findOrFail($code);
        $transaksi = $this->transaksi->where($this->getCode(), $code)->get();
        $jenis = Query::getJenisData($model->customer_code);

        return $this->views($this->module(true).'.form', $this->share([
            'model' => $model,
            'transaksi' => $transaksi,
            'jenis' => $jenis,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(TransaksiRequest $request)
    {
        try {
            $this->transaksi->where($this->getCode(), $request->get('code'))->delete();
            $data = $this->transaksi->insert($request->get('data'));

            if($data)
            {
                return redirect()->route( $this->module('getData'))->with('success', 'created successfully');
            }

            return redirect()->back()->with('error', 'creation failed');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getDelete($code)
    {
        $this->model = $this->transaksi->where($this->getCode(), $code);
        $this->model->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }

    public function postBulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        $this->transaksi::whereIn($this->transaksi->field_name(), $ids)->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }
}
