<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Models\ListKotor;
use App\Models\Rekap;
use App\Services\RekapKotorService;
use App\Traits\ControllerHelper;

class RekapKotorController extends Controller
{
    use ControllerHelper, RekapKotorService;

    protected $model;
    protected $transaksi;

    public function __construct(ListKotor $model, Rekap $transaksi)
    {
        $this->model = $model;
        $this->transaksi = $transaksi;
    }

    public function getCode()
    {
        return 'rekap_code';
    }

    public function share($data = [])
    {
        $rs = Query::getRsData();
        $jenis = Query::getJenisData();

        return array_merge([
            'model' => false,
            'transaksi' => false,
            'type' => TransactionType::KOTOR,
            'rs' => $rs,
            'jenis' => $jenis,
        ], $data);
    }
}