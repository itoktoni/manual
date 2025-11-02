<?php

namespace App\Services;

use App\Http\Requests\PengirimanRequest;
use App\Models\Rekap;
use App\Models\Transaksi;
use Illuminate\Http\Request;

trait BersihKotorTransaksiService
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
        $qc = Rekap::where(Rekap::field_key(), request()->query('qc'))->first();
        $transaksi = Rekap::where(Rekap::field_key(), request()->query('qc'))->get();

        return $this->views($this->module('create'), $this->share([
            'model' => $this->model,
            'qc' => $qc,
            'transaksi' => $transaksi,
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCreate(PengirimanRequest $request)
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
        $transaksi = $this->transaksi->where($this->getCode(), $code)->get();

        return $this->views($this->module(true).'.form', $this->share([
            'model' => $model,
            'transaksi' => $transaksi,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(PengirimanRequest $request)
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
        $this->transaksi::whereIn($this->transaksi->field_key(), $ids)->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function getQc($code)
    {
        $model = $this->model->findOrFail($code);
        $transaksi = $this->transaksi->where($this->getCode(), $code)->get();

        return $this->views($this->module(true).'.qc', $this->share([
            'model' => $model,
            'transaksi' => $transaksi,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postQc(PengirimanRequest $request, Transaksi $transaksi)
    {

        try {
            $this->transaksi->where($this->getCode(), $transaksi->field_key)->delete();
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
     * Show the form for editing the specified resource.
     */
    public function getDelivery($code)
    {
        $model = $this->model->findOrFail($code);
        $transaksi = $this->transaksi->where($this->getCode(), $code)->get();

        return $this->views($this->module(true).'.qc', $this->share([
            'model' => $model,
            'transaksi' => $transaksi,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postDelivery(PengirimanRequest $request, Transaksi $transaksi)
    {

        try {
            $this->transaksi->where($this->getCode(), $transaksi->field_key)->delete();
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

}
