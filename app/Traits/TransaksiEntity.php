<?php

namespace App\Traits;

trait TransaksiEntity
{
    public static function field_customer_code()
    {
        return 'customer_code';
    }

    public function getFieldCustomerCodeAttribute()
    {
        return $this->{$this->field_customer_code()};
    }

    public static function field_customer_nama()
    {
        return 'customer_nama';
    }

    public function getFieldCustomerNameAttribute()
    {
        return $this->{$this->field_customer_nama()};
    }

    public static function field_jenis_id()
    {
        return 'jenis_id';
    }

    public function getFieldJenisIdAttribute()
    {
        return $this->{$this->field_jenis_id()};
    }

    public static function field_jenis_nama()
    {
        return 'jenis_nama';
    }

    public function getFieldJenisNamaAttribute()
    {
        return $this->{$this->field_jenis_nama()};
    }


    public static function field_tanggal()
    {
        return 'tanggal';
    }

    public function getFieldTangalAttribute()
    {
        return $this->{$this->field_tanggal()};
    }

    public static function field_qty()
    {
        return 'qty';
    }

    public function getFieldQtyAttribute()
    {
        return $this->{$this->field_qty()};
    }

    public static function field_qc()
    {
        return 'qc';
    }

    public function getFieldQcAttribute()
    {
        return $this->{$this->field_qc()};
    }

    public static function field_kode()
    {
        return 'kode';
    }

    public function getFieldKodeAttribute()
    {
        return $this->{$this->field_kode()};
    }
}
