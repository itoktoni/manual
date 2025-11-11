<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Models\DetailKotor;
use App\Models\RekapKotor;
use App\Services\RekapKotorService;
use App\Traits\ControllerHelper;

class RekapKotorController extends Controller
{
    use ControllerHelper, RekapKotorService;

    protected $model;
    protected $transaksi;

    public function __construct(RekapKotor $model, DetailKotor $transaksi)
    {
        $this->model = $model;
        $this->transaksi = $transaksi;
    }

    public function getCode()
    {
        return 'kode';
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
}