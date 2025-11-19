<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use App\Traits\TransaksiEntity;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'retur';
    protected $primaryKey = 'retur_id';
    public $incrementing = true;
    public $timestamps = true;
    // protected $keyType = 'string';

    const CREATED_AT = 'retur_created_at';
    const UPDATED_AT = 'retur_updated_at';
    const DELETED_AT = 'retur_deleted_at';

    const CREATED_BY = 'retur_created_by';
    const UPDATED_BY = 'retur_updated_by';
    const DELETED_BY = 'retur_deleted_by';

    protected $fillable = [
            'retur_id',
            'retur_code',
            'retur_id_jenis',
            'retur_code_customer',
            'retur_qty',
            'retur_tanggal',
        ];

    protected $filterable = [
            'retur_code',
            'retur_code_customer',
            'retur_tanggal',
        ];

    protected $sortable = [
            'retur_code',
            'retur_code_customer',
            'retur_tanggal',
        ];

    public static function field_name()
    {
        return 'retur_code';
    }

    public static function field_tanggal()
    {
        return 'retur_tanggal';
    }

    public function getFieldTanggalAttribute()
    {
        return $this->{$this->field_tanggal()};
    }

    public static function field_qty()
    {
        return 'retur_qty';
    }

    public function getFieldQtyAttribute()
    {
        return $this->{$this->field_qty()};
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'retur_code_customer');
    }

    public function has_jenis()
    {
        return $this->hasOne(Jenis::class, 'jenis_id', 'retur_id_jenis');
    }
}