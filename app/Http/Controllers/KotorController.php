<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Models\Customer;
use App\Models\Kotor;
use App\Models\ListKotor;
use App\Services\KotorTransaksiService;
use App\Traits\ControllerHelper;

class KotorController extends Controller
{
    use ControllerHelper, KotorTransaksiService;

    protected $model;
    protected $transaksi;

    public function getCode()
    {
        return 'kotor_code';
    }

    public function __construct(ListKotor $model, Kotor $transaksi)
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

    public function getPrint($code)
    {
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $data = $this->transaksi->select('*')
            ->leftJoinRelationship('has_jenis')
            ->where($this->model->field_key(), $code)
            ->get();

        $model = $data[0] ?? null;
        $customer = Customer::where('customer_code', $data[0]->kotor_code_customer)->first();

        return $this->views($this->module('print'), [
            'data' => $data,
            'model' => $model,
            'customer' => $customer,
        ]);
     }
}