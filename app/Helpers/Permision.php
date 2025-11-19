<?php

use Illuminate\Support\Carbon;

if (! function_exists('allowSameDate')) {
    function allowSameDate($date)
    {
        return $date == date('Y-m-d');
    }
}
