<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'posting';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'int';

    protected $fillable = [
            'code',
            'rs',
            'jenis',
            'tanggal',
            'type',
            'kotor',
            'qc',
            'bersih',
            'pending',
            'plus',
            'minus',
        ];

    protected $filterable = [
            'rs',
            'jenis',
            'tanggal',
            'type',
            'kotor',
            'qc',
            'bersih',
            'pending',
            'plus',
            'minus',
            'jenis_nama',
            'customer_nama',
        ];

    protected $sortable = [
            'rs',
            'jenis',
            'tanggal',
            'type',
            'kotor',
            'qc',
            'bersih',
            'pending',
            'plus',
            'minus',
        ];

    public static function field_name()
    {
        return 'posting_name';
    }

    public function rules($id = null)
    {
        $rules = [
            'rs' => [''],
            'jenis' => ['numeric'],
            'tanggal' => ['date'],
            'type' => ['in:KOTOR,RETUR,REWASH'],
            'kotor' => ['numeric'],
            'qc' => ['numeric'],
            'bersih' => ['numeric'],
            'pending' => ['numeric'],
            'plus' => ['numeric'],
            'minus' => ['numeric'],
        ];

        return $rules;
    }

    public static function field_jenis_id()
    {
        return 'jenis';
    }

    public function getFieldJenisIdAttribute()
    {
        return $this->{$this->field_jenis_id()};
    }

    public static function field_jenis_name()
    {
        return 'jenis_nama';
    }

    public function getFieldJenisNameAttribute()
    {
        return $this->{$this->field_jenis_name()};
    }

    public static function field_tanggal()
    {
        return 'tanggal';
    }

    public function getFieldTanggalAttribute()
    {
        return $this->{$this->field_tanggal()};
    }

    public static function field_kotor()
    {
        return 'kotor';
    }

    public function getFieldKotorAttribute()
    {
        return $this->{$this->field_kotor()};
    }


    public function has_customer()
    {
        return $this->hasOne(Customer::class, 'customer_code', 'customer');
    }

    public function has_jenis()
    {
        return $this->hasOne(Jenis::class, 'jenis_id', 'jenis');
    }
}