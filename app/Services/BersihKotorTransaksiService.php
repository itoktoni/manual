<?php

namespace App\Services;

use App\Helpers\Query;
use App\Http\Requests\BersihKotorTransaksiRequest;
use App\Models\BersihKotor;
use App\Models\DetailKotor;
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
        $qc = DetailKotor::where('customer_code', request()->get('customer'))
            ->where('tanggal', request()->get('tanggal'));

        if(request()->get('jenis'))
        {
            $qc = $qc->where('jenis_id', request()->get('jenis'));
        }

        $qc = $qc->get();

        $jenis = Query::getJenisData(request()->get('customer'));

        return $this->views($this->module('create'), [
            'qc' => $qc,
            'jenis' => $jenis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCreate(BersihKotorTransaksiRequest $request)
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

        $transaksi =  BersihKotor::query()
                ->whereNotNull('bkotor_delivery')
                ->where('bkotor_delivery', $code)
                ->get();

        if($transaksi->count() == 0)
        {
            $transaksi =  BersihKotor::query()
                ->whereNull('bkotor_delivery')
                ->where('bkotor_code_customer', $model->customer_code)
                ->where('bkotor_tanggal', $model->bkotor_tanggal)
                ->get();
        }

        $jenis = Query::getJenisData($model->customer_code);

        $qc = DetailKotor::where('customer_code', $model->customer_code)
        ->where('tanggal', $model->bkotor_tanggal)
        ->get();

        return $this->views($this->module(true).'.update', $this->share([
            'model' => $model,
            'transaksi' => $transaksi,
            'jenis' => $jenis,
            'qc' => $qc,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(BersihKotorTransaksiRequest $request)
    {
        try {
            // $this->transaksi->where('bkotor_delivery', $request->get('code'))->delete();
            // $data = $this->transaksi->insert($request->get('data'));

            // if($data)
            // {
            //     return redirect()->route( $this->module('getData'))->with('success', 'created successfully');
            // }

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
        $this->model = BersihKotor::where('bkotor_delivery', $code);
        $this->model->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }

    public function postBulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        BersihKotor::whereIn('bkotor_delivery', $ids)->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }
}
