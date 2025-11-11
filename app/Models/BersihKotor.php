<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;
use Mattiverse\Userstamps\Traits\Userstamps;

class BersihKotor extends Model
{
    use Filterable, DefaultEntity, OptionModel, Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'bersih_kotor';
    protected $primaryKey = 'bkotor_code';
    public $incrementing = false;
    public $timestamps = true;
    protected $keyType = 'string';

    const CREATED_AT = 'bkotor_created_at';
    const UPDATED_AT = 'bkotor_updated_at';
    const DELETED_AT = 'bkotor_deleted_at';

    const CREATED_BY = 'bkotor_created_by';
    const UPDATED_BY = 'bkotor_updated_by';
    const DELETED_BY = 'bkotor_deleted_by';

    protected $fillable = [
            'bkotor_id',
            'bkotor_code',
            'bkotor_delivery',
            'bkotor_id_jenis',
            'bkotor_code_customer',
            'bkotor_qty',
            'bkotor_tanggal',
        ];

    protected $filterable = [
            'bkotor_code',
            'jenis_nama',
            'customer_code',
            'bkotor_tanggal',
        ];

    protected $sortable = [
            'bkotor_code',
            'bkotor_id_jenis',
            'bkotor_code_customer',
            'bkotor_tanggal',
        ];

    public static function field_name()
    {
        return 'bkotor_code';
    }

    public static function field_key()
    {
        return 'bkotor_code';
    }


    public static function field_tanggal()
    {
        return 'bkotor_tanggal';
    }

    public function getFieldTanggalAttribute()
    {
        return $this->{$this->field_tanggal()};
    }

    public static function field_qty()
    {
        return 'bkotor_qty';
    }

    public function getFieldQtyAttribute()
    {
        return $this->{$this->field_qty()};
    }

    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'bkotor_code_customer');
    }

    public function has_user()
    {
        return $this->hasOne(User::class, 'id', 'bkotor_created_by');
    }

    public function has_jenis()
    {
        return $this->hasOne(Jenis::class, 'jenis_id', 'bkotor_id_jenis');
    }

    public function rules($id = null)
    {
        $rules = [
            'customer' => ['required'],
        ];

        return $rules;
    }
}