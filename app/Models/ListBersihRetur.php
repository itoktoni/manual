<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class ListBersihRetur extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'list_bersih_retur';
    protected $primaryKey = 'bretur_delivery';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'bretur_delivery',
            'customer_code',
            'customer_nama',
            'bersih_retur_qty',
            'bretur_tanggal',
        ];

    protected $filterable = [
            'bretur_delivery',
            'customer_code',
            'customer_nama',
            'bretur_tanggal',
        ];

    protected $sortable = [
            'bretur_delivery',
            'customer_code',
            'customer_nama',
            'bretur_tanggal',
        ];

    public static function field_name()
    {
        return 'bretur_delivery';
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'customer_code');
    }
}