<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Models\Customer;
use App\Models\ListRetur;
use App\Models\Retur;
use App\Services\ReturTransaksiService;
use App\Traits\ControllerHelper;

class ReturController extends Controller
{
    use ControllerHelper, ReturTransaksiService;

    protected $model;
    protected $transaksi;

    public function getCode()
    {
        return 'retur_code';
    }

    public function __construct(ListRetur $model, Retur $transaksi)
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
            'type' => TransactionType::RETUR,
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
        $customer = Customer::where('customer_code', $data[0]->retur_code_customer)->first();

        return $this->views($this->module('print'), [
            'data' => $data,
            'model' => $model,
            'customer' => $customer,
        ]);
     }
}