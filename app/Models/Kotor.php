<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Kotor extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'kotor';
    protected $primaryKey = 'kotor_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'kotor_code',
            'kotor_rs_id',
            'kotor_rs_nama',
            'kotor_kotor',
            'kotor_retur',
            'kotor_rewash',
            'kotor_tanggal',
        ];

    protected $filterable = [
            'kotor_code',
            'kotor_rs_id',
            'kotor_rs_nama',
            'kotor_kotor',
            'kotor_retur',
            'kotor_rewash',
            'kotor_tanggal',
        ];

    protected $sortable = [
            'kotor_code',
            'kotor_rs_id',
            'kotor_rs_nama',
            'kotor_kotor',
            'kotor_retur',
            'kotor_rewash',
            'kotor_tanggal',
        ];

    public static function field_name()
    {
        return 'kotor_code';
    }

    public function has_transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_code', 'kotor_code');
    }

    public function has_rs()
    {
        return $this->hasOne(Rs::class, 'rs_code', 'kotor_rs_code');
    }
}