<?php

namespace App\Http\Requests;

use App\Models\Rs;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RekapTransaksiRequest extends FormRequest
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
            $code = request()->get('code');
        }

        if(empty($code))
        {
             $rs = Rs::find($this->rs)->field_key ?? null;
             $code = generateCode('RKP'.$rs);
        }


        $date = $this->tanggal ?? date('Y-m-d');
        $now = date('Y-m-d H:i:s');
        $user = auth()->user()->id;

        $data = [];
        foreach (request('qty', []) as $key => $value) {

            if(!empty($value['qty']))
            {
                $data[$key] = [
                    'rekap_code_rs' => $this->rs,
                    'rekap_id_jenis' => $key,
                    'rekap_code' => $code,
                    'rekap_kotor' => $value['kotor'],
                    'rekap_qc' => $value['qty'],
                    'rekap_tanggal' => $date,
                    'rekap_type' => $this->type,
                    'rekap_created_at' => $now,
                    'rekap_updated_at' => $now,
                    'rekap_created_by' => $user,
                    'rekap_updated_by' => $user,
                ];
            }

        }

        // dd($data);

        $this->merge([
            'data' => $data,
        ]);
    }
}
