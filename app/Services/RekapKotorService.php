<?php

namespace App\Services;

use App\Helpers\Query;
use App\Http\Requests\RekapTransaksiRequest;
use App\Models\DetailKotor;
use App\Models\QcKotor;
use App\Models\RekapKotor;
use Illuminate\Http\Request;

trait RekapKotorService
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
        return $this->views($this->module('form'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCreate(RekapTransaksiRequest $request)
    {
        $data = $this->transaksi->insert($request->get('data'));

        if($data)
        {
            return redirect()->route( $this->module('getData'))->with('success', 'created successfully');
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
        $transaksi = $this->transaksi->where('header', $code)->get();
        $jenis = Query::getJenisData($model->customer_code);
        if($transaksi->count() == 0)
        {
            $transaksi = RekapKotor::where($this->getCode(), $code)->get();
        }

        return $this->views($this->module(true).'.form', $this->share([
            'model' => $model,
            'transaksi' => $transaksi,
            'jenis' => $jenis,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(RekapTransaksiRequest $request)
    {
        try {

            $data = QcKotor::insert($request->get('data'));

            if($data)
            {
                return redirect()->back()->with('success', 'created successfully');
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
        $data = RekapKotor::where($this->getCode(), $code)->first();
        if(!$data)
        {
            return redirect()->route($this->module('getData'))->with('error', 'data not found');
        }

        $this->model = QcKotor::where('qkotor_code_customer', $data->customer_code)
                              ->where('qkotor_tanggal', $data->tanggal)
                              ->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }

    public function postBulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        $data = RekapKotor::whereIn($this->getCode(), $ids)->get();

        if(!$data)
        {
            return redirect()->route($this->module('getData'))->with('error', 'data not found');
        }

        foreach($data as $item)
        {
            $this->model = QcKotor::where('qkotor_code_customer', $item->customer_code)
                              ->where('qkotor_tanggal', $item->tanggal)
                              ->delete();
        }

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }

}
