<?php

namespace App\Helpers;

use App\Models\Jenis;
use App\Models\Rs;

class Query
{
    public static function getRsData()
    {
        $query = Rs::query()->get();

        if($query)
        {
            $query = $query->mapWithKeys(function ($item) {
                return [$item->field_key => $item->field_name];
            })->toArray();
        }

        return $query;
    }

    public static function getJenisData()
    {
        $query = Jenis::query()->get();

        if($query)
        {
            $query = $query->mapWithKeys(function ($item) {
                return [$item->field_key => $item->field_name];
            })->toArray();
        }

        return $query;
    }
}