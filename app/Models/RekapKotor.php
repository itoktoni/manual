<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class RekapKotor extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'rekap_kotor';
    protected $primaryKey = 'rekap_kotor_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'rekap_kotor_code',
            'rekap_kotor_rs_code',
            'rekap_kotor_rs_nama',
            'rekap_kotor_qty',
            'rekap_kotor_qc',
            'rekap_kotor_tanggal',
        ];

    protected $filterable = [
            'rekap_kotor_code',
            'rekap_kotor_rs_id',
            'rekap_kotor_rs_nama',
            'rekap_kotor_tanggal',
        ];

    protected $sortable = [
            'rekap_kotor_code',
            'rekap_kotor_rs_id',
            'rekap_kotor_rs_nama',
            'rekap_kotor_tanggal',
        ];

    public static function field_name()
    {
        return 'rekap_kotor_code';
    }

    public function has_transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_code', 'rekap_kotor_code');
    }

    public function has_rs()
    {
        return $this->hasOne(Rs::class, 'rs_code', 'rekap_kotor_rs_code');
    }
}