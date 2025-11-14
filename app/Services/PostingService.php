<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Posting;
use Illuminate\Http\Request;

trait PostingService
{
    public function save($data, $customer = null, $start, $end, $type = TransactionType::KOTOR)
    {
        try {

            $query =  Posting::query()
                ->where('tanggal', '>=', $start)
                ->where('tanggal', '<=', $end)
                ->where('type', $type)
                ;

            if($customer)
            {
                $query = $query
                ->where('customer', $customer);
            }

            $query->delete();

            $check = Posting::insert($data);

        } catch (\Throwable $th) {

            return $th->getMessage();
        }

    }
}
