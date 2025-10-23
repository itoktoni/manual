<?php

namespace App\Helpers;

use App\Models\Rs;

class Query
{
    public static function getRsData()
    {
        $rs = Rs::query()->get();

        if($rs)
        {
            $rs = $rs->mapWithKeys(function ($item) {
                return [$item->rs_code => $item->rs_nama];
            })->toArray();
        }

        return $rs;
    }
}