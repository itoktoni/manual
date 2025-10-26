<?php

namespace App\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'rs' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        if (request()->segment(3) == 'update')
        {
            $code = request()->segment(4);
        }
        else
        {
            $code = generateCode('TRX');
        }

        $date = date('Y-m-d');

        $data = [];
        foreach (request('qty', []) as $key => $value) {
            $data[$key] = [
                'transaksi_code_rs' => $this->rs,
                'transaksi_id_jenis' => $key,
                'transaksi_code' => $code,
                'transaksi_kotor' => $value['kotor'],
                'transaksi_retur' => $value['retur'],
                'transaksi_rewash' => $value['rewash'],
                'transaksi_tanggal' => $date,
            ];
        }

        $this->merge([
            'data' => $data,
        ]);
    }
}
