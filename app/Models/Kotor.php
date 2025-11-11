<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use App\Traits\TransaksiEntity;
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
    protected $primaryKey = 'kotor_id';
    public $incrementing = true;
    public $timestamps = true;
    // protected $keyType = 'string';

    const CREATED_AT = 'kotor_created_at';
    const UPDATED_AT = 'kotor_updated_at';
    const DELETED_AT = 'kotor_deleted_at';

    const CREATED_BY = 'kotor_created_by';
    const UPDATED_BY = 'kotor_updated_by';
    const DELETED_BY = 'kotor_deleted_by';

    protected $fillable = [
            'kotor_id',
            'kotor_code',
            'kotor_id_jenis',
            'kotor_code_customer',
            'kotor_qty',
            'kotor_tanggal',
        ];

    protected $filterable = [
            'kotor_code',
            'kotor_code_customer',
            'kotor_tanggal',
        ];

    protected $sortable = [
            'kotor_code',
            'kotor_code_customer',
            'kotor_tanggal',
        ];

    public static function field_name()
    {
        return 'kotor_code';
    }

    public static function field_tanggal()
    {
        return 'kotor_tanggal';
    }

    public function getFieldTanggalAttribute()
    {
        return $this->{$this->field_tanggal()};
    }

    public static function field_qty()
    {
        return 'kotor_qty';
    }

    public function getFieldQtyAttribute()
    {
        return $this->{$this->field_qty()};
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'kotor_code_customer');
    }

    public function has_jenis()
    {
        return $this->hasOne(Jenis::class, 'jenis_id', 'kotor_id_jenis');
    }
}