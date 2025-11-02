<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Bersih extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'bersih';
    protected $primaryKey = 'bersih_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'bersih_code',
            'bersih_rs_code',
            'bersih_rs_nama',
            'bersih_kotor',
            'bersih_qc',
            'bersih_tanggal',
        ];

    protected $filterable = [
            'bersih_code',
            'bersih_rs_id',
            'bersih_rs_nama',
            'bersih_tanggal',
        ];

    protected $sortable = [
            'bersih_code',
            'bersih_rs_id',
            'bersih_rs_nama',
            'bersih_tanggal',
        ];

    public static function field_name()
    {
        return 'bersih_code';
    }

    public function has_transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'pengiriman_code', 'bersih_code');
    }

    public function has_rs()
    {
        return $this->hasOne(Rs::class, 'rs_code', 'bersih_rs_code');
    }
}