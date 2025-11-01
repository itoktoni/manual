<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class ListKotor extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'list_kotor';
    protected $primaryKey = 'list_kotor_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'list_kotor_code',
            'list_kotor_rs_code',
            'list_kotor_rs_nama',
            'list_kotor_qty',
            'list_kotor_qc',
            'list_kotor_tanggal',
        ];

    protected $filterable = [
            'list_kotor_code',
            'list_kotor_rs_id',
            'list_kotor_rs_nama',
            'list_kotor_tanggal',
        ];

    protected $sortable = [
            'list_kotor_code',
            'list_kotor_rs_id',
            'list_kotor_rs_nama',
            'list_kotor_tanggal',
        ];

    public static function field_name()
    {
        return 'list_kotor_code';
    }

    public function has_transaksi()
    {
        return $this->belongsTo(RekapKotor::class, 'rekap_kotor_code', 'list_rekap_code');
    }

    public function has_rs()
    {
        return $this->hasOne(Rs::class, 'rs_code', 'list_kotor_rs_code');
    }
}