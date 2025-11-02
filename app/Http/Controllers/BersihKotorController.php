<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Models\Bersih;
use App\Models\Pengiriman;
use App\Services\BersihKotorTransaksiService;
use App\Traits\ControllerHelper;

class BersihKotorController extends Controller
{
    use ControllerHelper, BersihKotorTransaksiService;

    protected $model;
    protected $transaksi;

    public function getCode()
    {
        return 'pengiriman_code';
    }

    public function __construct(Bersih $model, Pengiriman $transaksi)
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
            'type' => TransactionType::KOTOR,
            'rs' => $rs,
            'jenis' => $jenis,
        ], $data);
    }
}