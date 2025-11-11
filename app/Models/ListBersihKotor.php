<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class ListBersihKotor extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'list_bersih_kotor';
    protected $primaryKey = 'bkotor_delivery';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'bkotor_delivery',
            'customer_code',
            'customer_nama',
            'bersih_kotor_qty',
            'bkotor_tanggal',
        ];

    protected $filterable = [
            'bkotor_delivery',
            'customer_code',
            'customer_nama',
            'bkotor_tanggal',
        ];

    protected $sortable = [
            'bkotor_delivery',
            'customer_code',
            'customer_nama',
            'bkotor_tanggal',
        ];

    public static function field_name()
    {
        return 'bkotor_delivery';
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'customer_code');
    }
}