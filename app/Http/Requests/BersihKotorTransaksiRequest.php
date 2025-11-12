<?php

namespace App\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class BersihKotorTransaksiRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'customer' => 'required',
            'tanggal' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        if (request()->segment(3) == 'update')
        {
            $code = array_keys(request()->query())[0] ?? null;
        }

        $customer_code = request()->get('customer');

        if(empty($code))
        {
            $code = generateCode('BSH'.$customer_code);
        }

        $date = $this->tanggal ?? date('Y-m-d');
        $now = date('Y-m-d H:i:s');
        $user = auth()->user()->id;

        $primary = generateCode('DLV'.$customer_code);
        $data = [];
    foreach (request('qty', []) as $key => $value) {

            $data[$key] = [
                'bkotor_code_customer' => $customer_code,
                'bkotor_id_jenis' => $key,
                'bkotor_code' => $primary,
                'bkotor_delivery' => $code,
                'bkotor_qty' => $value['qty'] ?? 0,
                'bkotor_tanggal' => $date,
                'bkotor_created_at' => $now,
                'bkotor_updated_at' => $now,
                'bkotor_created_by' => $user,
                'bkotor_updated_by' => $user,
            ];
        }

        $this->merge([
            'data' => $data,
            'code' => $code,
        ]);
    }
}
