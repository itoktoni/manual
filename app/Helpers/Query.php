<?php

namespace App\Helpers;

use App\Models\Customer;
use App\Models\Jenis;

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
}