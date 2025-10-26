<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'transaksi_id',
            'transaksi_id_jenis',
            'transaksi_code_rs',
            'transaksi_code',
            'transaksi_kotor',
            'transaksi_retur',
            'transaksi_rewash',
            'transaksi_tanggal',
            'transaksi_qc_kotor',
            'transaksi_qc_retur',
            'transaksi_qc_rewash',
            'transaksi_created_at',
            'transaksi_updated_at',
            'transaksi_deleted_at',
            'transaksi_created_by',
            'transaksi_updated_by',
            'transaksi_deleted_by',
        ];

    protected $filterable = [
            'transaksi_id',
            'transaksi_id_jenis',
            'transaksi_code_rs',
            'transaksi_code',
            'transaksi_kotor',
            'transaksi_retur',
            'transaksi_rewash',
            'transaksi_tanggal',
            'transaksi_qc_kotor',
            'transaksi_qc_retur',
            'transaksi_qc_rewash',
            'transaksi_created_at',
            'transaksi_updated_at',
            'transaksi_deleted_at',
            'transaksi_created_by',
            'transaksi_updated_by',
            'transaksi_deleted_by',
        ];

    protected $sortable = [
            'transaksi_id',
            'transaksi_id_jenis',
            'transaksi_code_rs',
            'transaksi_code',
            'transaksi_kotor',
            'transaksi_retur',
            'transaksi_rewash',
            'transaksi_tanggal',
            'transaksi_qc_kotor',
            'transaksi_qc_retur',
            'transaksi_qc_rewash',
            'transaksi_created_at',
            'transaksi_updated_at',
            'transaksi_deleted_at',
            'transaksi_created_by',
            'transaksi_updated_by',
            'transaksi_deleted_by',
        ];

    public static function field_name()
    {
        return 'transaksi_name';
    }

    public function rules($id = null)
    {
        $rules = [
            'transaksi_id' => ['required', 'numeric'],
            'transaksi_id_jenis' => ['numeric'],
            'transaksi_code_rs' => ['string'],
            'transaksi_code' => [''],
            'transaksi_kotor' => ['numeric'],
            'transaksi_retur' => ['numeric'],
            'transaksi_rewash' => ['numeric'],
            'transaksi_tanggal' => ['date'],
            'transaksi_qc_kotor' => ['numeric'],
            'transaksi_qc_retur' => ['numeric'],
            'transaksi_qc_rewash' => ['numeric'],
            'transaksi_created_at' => ['date'],
            'transaksi_updated_at' => ['date'],
            'transaksi_deleted_at' => ['date'],
            'transaksi_created_by' => ['numeric'],
            'transaksi_updated_by' => ['numeric'],
            'transaksi_deleted_by' => ['numeric'],
        ];

        return $rules;
    }
}