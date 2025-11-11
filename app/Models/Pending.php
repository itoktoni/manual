<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'pending';
    protected $primaryKey = 'pending_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'pending_code',
            'pending_rs_code',
            'pending_rs_nama',
            'pending_kotor',
            'pending_qc',
            'pending_tanggal',
        ];

    protected $filterable = [
            'pending_code',
            'pending_rs_id',
            'pending_rs_nama',
            'pending_tanggal',
        ];

    protected $sortable = [
            'pending_code',
            'pending_rs_id',
            'pending_rs_nama',
            'pending_tanggal',
        ];

    public static function field_name()
    {
        return 'pending_code';
    }

    public function has_transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_code', 'pending_code');
    }

    public function has_customer()
    {
        return $this->hasOne(Rs::class, 'rs_code', 'pending_rs_code');
    }
}