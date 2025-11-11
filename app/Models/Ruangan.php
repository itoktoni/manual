<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'ruangan';
    protected $primaryKey = 'ruangan_code';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'ruangan_id',
            'ruangan_code',
            'ruangan_nama',
            'ruangan_code_rs',
        ];

    protected $filterable = [
            'ruangan_id',
            'ruangan_code',
            'ruangan_nama',
            'ruangan_code_rs',
        ];

    protected $sortable = [
            'ruangan_id',
            'ruangan_code',
            'ruangan_nama',
            'ruangan_code_customer',
        ];

    public static function field_name()
    {
        return 'ruangan_name';
    }

    public function rules($id = null)
    {
        $rules = [
            'ruangan_code' => [''],
            'ruangan_nama' => [''],
            'ruangan_code_rs' => [''],
        ];

        return $rules;
    }

    public function has_customer()
    {
        return $this->belongsTo(Customer::class, 'ruangan_code_customer', 'customer_code');
    }
}