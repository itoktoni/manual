<?php

namespace App\Helpers;

use App\Enums\TransactionType;
use App\Models\Customer;
use App\Models\DetailKotor;
use App\Models\Jenis;
use App\Models\Posting;

class Query
{
    public static function getCustomerData()
    {
        $query = Customer::query()->get();

        if($query)
        {
            $query = $query->mapWithKeys(function ($item) {
                return [$item->field_key => $item->field_name];
            })->toArray();
        }

        return $query;
    }

    public static function getJenisData($customer = false)
    {
        $query = [];

        if($customer)
        {
            $customer = request()->get('customer') ?? $customer;

            $query = Jenis::query();
            $query = $query->where(Jenis::field_customer(), $customer);
            $query = $query->get();
        }

        if($query)
        {
            $query = $query->mapWithKeys(function ($item) {
                return [$item->field_key => $item->field_name];
            })->toArray();
        }

        return $query;
    }

    public static function posting($request)
    {
        try {
            $data = [];
            $code = generateCode('FIXCUT');

            $query = Posting::query()
                ->where('tanggal', '>=', $request->start)
                ->where('tanggal', '<=', $request->end)
                ->where('type', TransactionType::KOTOR)
            ;

            if ($customer = $request->customer) {
                $query = $query
                    ->where('customer', $customer);
            }

            $query->delete();

            $data = DetailKotor::query()
                ->where('customer_code', $request->customer)
                ->where('tanggal', '>=', $request->start)
                ->where('tanggal', '<=', $request->end)
                ->get()
                ->map(function ($item) use ($code) {

                    return [
                        'code'     => $code,
                        'customer' => $item->customer_code,
                        'jenis'    => $item->jenis_id,
                        'tanggal'  => $item->tanggal,
                        'type'     => TransactionType::KOTOR,
                        'kotor'    => $item->qty,
                        'qc'       => $item->qc,
                        'bersih'   => $item->bc,
                        'pending'  => $item->pending,
                        'plus'     => $item->plus,
                        'minus'    => $item->minus,
                    ];

                })->toArray() ?? [];

            $check = Posting::insert($data);

        } catch (\Throwable $th) {
            return abort(500, $th->getMessage());
        }
    }
}