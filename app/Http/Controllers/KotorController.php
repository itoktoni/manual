<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Http\Requests\TransaksiRequest;
use App\Models\Kotor;
use App\Models\Transaksi;
use App\Traits\ControllerHelper;
use Illuminate\Http\Request;

class KotorController extends Controller
{
    use ControllerHelper;

    protected $model;
    protected $transaksi;

    public function __construct(Kotor $model, Transaksi $transaksi)
    {
        $this->model = $model;
        $this->transaksi = $transaksi;
    }

    public function share($data = [])
    {
        $rs = Query::getRsData();
        $jenis = Query::getJenisData();

        return array_merge([
            'model' => false,
            'transaksi' => false,
            'rs' => $rs,
            'jenis' => $jenis,
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
    public function postCreate(TransaksiRequest $request)
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
        $transaksi = $this->transaksi->where('transaksi_code', $code)->get();

        return $this->views($this->module(true).'.form', $this->share([
            'model' => $model,
            'transaksi' => $transaksi,
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(TransaksiRequest $request, Transaksi $transaksi)
    {

        try {
            $this->transaksi->where('transaksi_code', $transaksi->transaksi_code)->delete();
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
        $this->model = $this->transaksi->where('transaksi_code', $code);
        $this->model->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }

    public function postBulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids);
        $this->transaksi::whereIn($this->transaksi->field_key(), $ids)->delete();

        return redirect()->route($this->module('getData'))->with('success', 'deleted successfully');
    }
}