<?php

namespace App\Models;

use App\Traits\DefaultEntity;
use App\Traits\Filterable;
use App\Traits\OptionModel;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use Filterable, DefaultEntity, OptionModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'jenis';
    protected $primaryKey = 'jenis_id';
    public $incrementing = true;
    public $timestamps = false;
    protected $keyType = 'int';

    protected $fillable = [
             'jenis_id',
             'jenis_nama',
             'jenis_code_rs',
             'jenis_harga',
             'jenis_fee',
             'jenis_total',
         ];

    protected $filterable = [
             'jenis_id',
             'jenis_nama',
             'jenis_code_rs',
             'jenis_harga',
             'jenis_fee',
             'jenis_total',
         ];

    protected $sortable = [
             'jenis_id',
             'jenis_nama',
             'jenis_code_rs',
             'jenis_harga',
             'jenis_fee',
             'jenis_total',
         ];

    public static function field_name()
    {
        return 'jenis_nama';
    }

    public function rules($id = null)
    {
        $rules = [
             'jenis_nama' => ['required', 'string', 'max:255'],
             'jenis_code_rs' => ['required'],
             'jenis_harga' => ['numeric'],
             'jenis_fee' => ['numeric'],
         ];

        return $rules;
    }

    public function has_rs()
    {
        return $this->belongsTo(Rs::class, 'jenis_code_rs', 'rs_code');
    }
}