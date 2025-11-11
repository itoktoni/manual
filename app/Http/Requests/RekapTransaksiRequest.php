<?php

namespace App\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RekapTransaksiRequest extends FormRequest
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
        // if (request()->segment(3) == 'update')
        // {
        //     $code = array_keys(request()->query())[0] ?? null;
        // }

        $customer_code = request()->get('customer');
        $code = generateCode('QC'.$customer_code);

        // if(empty($code))
        // {
        //     $code = generateCode('TRX'.$customer_code);
        // }

        $date = $this->tanggal ?? date('Y-m-d');
        $now = date('Y-m-d H:i:s');
        $user = auth()->user()->id;

        $data = [];
        foreach (request('qty', []) as $key => $value) {

            $data[$key] = [
                'qkotor_code_customer' => $customer_code,
                'qkotor_id_jenis' => $key,
                'qkotor_code' => $code,
                'qkotor_qty' => $value['qty'] ?? 0,
                'qkotor_tanggal' => $date,
                'qkotor_created_at' => $now,
                'qkotor_updated_at' => $now,
                'qkotor_created_by' => $user,
                'qkotor_updated_by' => $user,
            ];
        }

        $this->merge([
            'data' => $data,
            'code' => $code,
        ]);
    }
}
