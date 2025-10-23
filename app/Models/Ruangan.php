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
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
            'ruangan_id',
            'ruangan_code',
            'ruangan_nama',
            'ruangan_id_rs',
        ];

    protected $filterable = [
            'ruangan_id',
            'ruangan_code',
            'ruangan_nama',
            'ruangan_id_rs',
        ];

    protected $sortable = [
            'ruangan_id',
            'ruangan_code',
            'ruangan_nama',
            'ruangan_id_rs',
        ];

    public static function field_name()
    {
        return 'ruangan_name';
    }

    public function rules($id = null)
    {
        $rules = [
            'ruangan_id' => ['required', 'numeric'],
            'ruangan_code' => [''],
            'ruangan_nama' => [''],
            'ruangan_id_rs' => [''],
        ];

        return $rules;
    }
}