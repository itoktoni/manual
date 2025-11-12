<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Helpers\Query;
use App\Models\BersihKotor;
use App\Models\Customer;
use App\Models\DetailKotor;
use App\Models\ListBersihKotor;
use App\Services\BersihKotorTransaksiService;
use App\Traits\ControllerHelper;

class BersihKotorController extends Controller
{
    use ControllerHelper, BersihKotorTransaksiService;

    protected $model;
    protected $transaksi;

    public function getCode()
    {
        return 'bkotor_code';
    }

    public function __construct(ListBersihKotor $model, BersihKotor $transaksi)
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

        $model = $this->model->find($code);
        $data = $jenis = [];
        $customer = $unique = null;

        if(!empty($model))
        {
            $customer_code = $model->customer_code;
            $customer = Customer::find($customer_code);

            $data =  BersihKotor::query()
                ->leftJoinRelationship('has_jenis')
                ->whereNotNull('bkotor_delivery')
                ->where('bkotor_delivery', $code)
                ->get();

            $unique = $code;

            if($data->count() == 0)
            {
                $data =  BersihKotor::query()
                    ->leftJoinRelationship('has_jenis')
                    ->whereNull('bkotor_delivery')
                    ->where('bkotor_code_customer', $customer_code)
                    ->where('bkotor_tanggal', $model->bersih_kotor_tanggal)
                    ->get();

                    $unique = generateCode('DLV'.$customer_code);

                       BersihKotor::whereNull('bkotor_delivery')
                        ->where('bkotor_code_customer', $customer_code)
                        ->where('bkotor_tanggal', $model->bkotor_tanggal)
                    ->update([
                        'bkotor_delivery' => $unique
                    ]);

                    return redirect()->route($this->module('getPrint'), ['code' => $unique]);

            }

            $model = $data->first();

            $jenis = Query::getJenisData($customer_code);
        }

         return $this->views($this->module('print'), [
            'data' => $data,
            'model' => $model,
            'unique' => $unique,
            'jenis' => $jenis,
            'customer' => $customer,
        ]);
     }
}