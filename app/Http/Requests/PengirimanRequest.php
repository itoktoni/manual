<?php

namespace App\Http\Requests;

use App\Models\Rs;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class PengirimanRequest extends FormRequest
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
            $code = array_keys(request()->query())[0] ?? null;
        }

        if(empty($code))
        {
            $rs = Rs::find($this->rs)->field_key ?? null;
            $code = generateCode('DLV'.$rs);
        }

        $date = $this->tanggal ?? date('Y-m-d');
        $now = date('Y-m-d H:i:s');
        $user = auth()->user()->id;

        $data = [];
        foreach (request('qty', []) as $key => $value) {

            if(!empty($value['qty']))
            {
                $data[$key] = [
                    'pengiriman_code_rs' => $this->rs,
                    'pengiriman_id_jenis' => $key,
                    'pengiriman_code' => $code,
                    'pengiriman_qty' => $value['qty'],
                    'pengiriman_tanggal' => $date,
                    'pengiriman_type' => $this->type,
                    'pengiriman_created_at' => $now,
                    'pengiriman_updated_at' => $now,
                    'pengiriman_created_by' => $user,
                    'pengiriman_updated_by' => $user,
                ];
            }

        }

        $this->merge([
            'data' => $data,
            'code' => $code,
        ]);
    }
}
