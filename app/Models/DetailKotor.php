<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use App\Traits\TransaksiEntity;
use Illuminate\Database\Eloquent\Model;

class DetailKotor extends Model
{
    use Filterable, DefaultEntity, OptionModel, TransaksiEntity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'detail_kotor';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'code',
            'customer_code',
            'customer_nama',
            'jenis_id',
            'jenis_nama',
            'qty',
            'qc',
            'bc',
            'tanggal',
        ];

    protected $filterable = [
            'code',
            'customer_id',
            'customer_nama',
            'jenis_id',
            'jenis_nama',
            'tanggal',
        ];

    protected $sortable = [
            'code',
            'customer_id',
            'customer_nama',
            'tanggal',
        ];

    public static function field_name()
    {
        return 'code';
    }

    public function has_jenis()
    {
        return $this->hasOne(Jenis::class, 'jenis_id', 'jenis_id');
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'customer_code');
    }
}