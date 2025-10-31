<?php

namespace App\Http\Requests;

use App\Models\Rs;
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
            $rs = Rs::find($this->rs)->field_key ?? null;
            $code = generateCode('TRX'.$rs);
        }

        $date = date('Y-m-d');
        $now = date('Y-m-d H:i:s');
        $user = auth()->user()->id;

        $data = [];
        foreach (request('qty', []) as $key => $value) {

            if(!empty($value['qty']))
            {
                $data[$key] = [
                    'transaksi_code_rs' => $this->rs,
                    'transaksi_id_jenis' => $key,
                    'transaksi_code' => $code,
                    'transaksi_qty' => $value['qty'],
                    'transaksi_tanggal' => $date,
                    'transaksi_type' => $this->type,
                    'transaksi_created_at' => $now,
                    'transaksi_updated_at' => $now,
                    'transaksi_created_by' => $user,
                    'transaksi_updated_by' => $user,
                ];
            }

        }

        $this->merge([
            'data' => $data,
        ]);
    }
}
