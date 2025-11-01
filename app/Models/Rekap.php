<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'rekap';
    protected $primaryKey = 'rekap_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'rekap_code',
            'rekap_rs_code',
            'rekap_rs_nama',
            'rekap_kotor',
            'rekap_qc',
            'rekap_tanggal',
        ];

    protected $filterable = [
            'rekap_code',
            'rekap_rs_id',
            'rekap_rs_nama',
            'rekap_tanggal',
        ];

    protected $sortable = [
            'rekap_code',
            'rekap_rs_id',
            'rekap_rs_nama',
            'rekap_tanggal',
        ];

    public static function field_name()
    {
        return 'rekap_code';
    }

    public function has_transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_code', 'rekap_code');
    }

    public function has_rs()
    {
        return $this->hasOne(Rs::class, 'rs_code', 'rekap_rs_code');
    }
}