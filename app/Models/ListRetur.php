<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class ListRetur extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'list_retur';
    protected $primaryKey = 'retur_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'retur_code',
            'rs_code',
            'customer_nama',
            'retur_qty',
            'retur_tanggal',
        ];

    protected $filterable = [
            'retur_code',
            'customer_code',
            'customer_nama',
            'retur_tanggal',
        ];

    protected $sortable = [
            'retur_code',
            'rs_code',
            'customer_nama',
            'retur_tanggal',
        ];

    public static function field_name()
    {
        return 'retur_code';
    }

    public function has_transaksi()
    {
        return $this->belongsTo(Kotor::class, 'retur_code', 'retur_code');
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'customer_code');
    }
}