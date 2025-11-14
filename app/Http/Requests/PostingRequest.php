<?php

namespace App\Http\Requests;

use App\Enums\TransactionType;
use App\Models\DetailKotor;
use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class PostingRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'customer' => 'required',
            'type' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $data = [];
        $code = generateCode('FIXCUT');

        if($this->type == TransactionType::KOTOR)
        {
            $data = DetailKotor::query()
            ->where('customer_code', $this->customer)
            ->where('tanggal', '>=', $this->start)
            ->where('tanggal', '<=', $this->end)
            ->get()
            ->map(function($item) use ($code){

                return [
                    'code' => $code,
                    'customer' => $item->customer_code,
                    'jenis' => $item->jenis_id,
                    'tanggal' => $item->tanggal,
                    'type' => $this->type,
                    'kotor' => $item->qty,
                    'qc' => $item->qc,
                    'bersih' => $item->bc,
                    'pending' => $item->pending,
                    'plus' => $item->plus,
                    'minus' => $item->minus,
                ];
            })->toArray() ?? [];
        }

        $this->merge([
            'data' => $data,
        ]);
    }
}
