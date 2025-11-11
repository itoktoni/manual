<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class QcKotor extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'qc_kotor';
    protected $primaryKey = 'qkotor_id';
    public $incrementing = true;
    public $timestamps = true;
    // protected $keyType = 'string';

    const CREATED_AT = 'qkotor_created_at';
    const UPDATED_AT = 'qkotor_updated_at';
    const DELETED_AT = 'qkotor_deleted_at';

    const CREATED_BY = 'qkotor_created_by';
    const UPDATED_BY = 'qkotor_updated_by';
    const DELETED_BY = 'qkotor_deleted_by';

    protected $fillable = [
            'qkotor_id',
            'qkotor_code',
            'qkotor_rs_code',
            'qkotor_rs_nama',
            'qkotor_kotor',
            'qkotor_retur',
            'qkotor_rewash',
            'qkotor_tanggal',
        ];

    protected $filterable = [
            'qkotor_code',
            'qkotor_rs_code',
            'qkotor_rs_nama',
            'qkotor_kotor',
            'qkotor_retur',
            'qkotor_rewash',
            'qkotor_tanggal',
        ];

    protected $sortable = [
            'qkotor_code',
            'qkotor_rs_code',
            'qkotor_rs_nama',
            'qkotor_kotor',
            'qkotor_retur',
            'qkotor_rewash',
            'qkotor_tanggal',
        ];

    public static function field_name()
    {
        return 'qkotor_code';
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'qkotor_code_customer');
    }
}