<?php

namespace App\Http\Requests;

use App\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'customer' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $posting = request()->has('posting') ?? false;

        $this->merge([
            'posting' => $posting
        ]);
    }
}
