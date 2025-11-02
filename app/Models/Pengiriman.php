<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'pengiriman';
    protected $primaryKey = 'pengiriman_code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'pengiriman_id',
            'pengiriman_id_jenis',
            'pengiriman_code_rs',
            'pengiriman_code',
            'pengiriman_kotor',
            'pengiriman_retur',
            'pengiriman_rewash',
            'pengiriman_tanggal',
            'pengiriman_qc_kotor',
            'pengiriman_qc_retur',
            'pengiriman_qc_rewash',
            'pengiriman_created_at',
            'pengiriman_updated_at',
            'pengiriman_deleted_at',
            'pengiriman_created_by',
            'pengiriman_updated_by',
            'pengiriman_deleted_by',
        ];

    protected $filterable = [
            'pengiriman_id',
            'pengiriman_id_jenis',
            'pengiriman_code_rs',
            'pengiriman_code',
            'pengiriman_kotor',
            'pengiriman_retur',
            'pengiriman_rewash',
            'pengiriman_tanggal',
            'pengiriman_qc_kotor',
            'pengiriman_qc_retur',
            'pengiriman_qc_rewash',
            'pengiriman_created_at',
            'pengiriman_updated_at',
            'pengiriman_deleted_at',
            'pengiriman_created_by',
            'pengiriman_updated_by',
            'pengiriman_deleted_by',
        ];

    protected $sortable = [
            'pengiriman_id',
            'pengiriman_id_jenis',
            'pengiriman_code_rs',
            'pengiriman_code',
            'pengiriman_kotor',
            'pengiriman_retur',
            'pengiriman_rewash',
            'pengiriman_tanggal',
            'pengiriman_qc_kotor',
            'pengiriman_qc_retur',
            'pengiriman_qc_rewash',
            'pengiriman_created_at',
            'pengiriman_updated_at',
            'pengiriman_deleted_at',
            'pengiriman_created_by',
            'pengiriman_updated_by',
            'pengiriman_deleted_by',
        ];

    public static function field_name()
    {
        return 'pengiriman_name';
    }

    public function rules($id = null)
    {
        $rules = [
            'pengiriman_id' => ['required', 'numeric'],
            'pengiriman_id_jenis' => ['numeric'],
            'pengiriman_code_rs' => ['string'],
            'pengiriman_code' => [''],
            'pengiriman_kotor' => ['numeric'],
            'pengiriman_retur' => ['numeric'],
            'pengiriman_rewash' => ['numeric'],
            'pengiriman_tanggal' => ['date'],
            'pengiriman_qc_kotor' => ['numeric'],
            'pengiriman_qc_retur' => ['numeric'],
            'pengiriman_qc_rewash' => ['numeric'],
            'pengiriman_created_at' => ['date'],
            'pengiriman_updated_at' => ['date'],
            'pengiriman_deleted_at' => ['date'],
            'pengiriman_created_by' => ['numeric'],
            'pengiriman_updated_by' => ['numeric'],
            'pengiriman_deleted_by' => ['numeric'],
        ];

        return $rules;
    }
}