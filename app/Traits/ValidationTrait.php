<?php

namespace App\Traits;

trait ValidationTrait
{
    abstract public function validation(): array;

    public function rules()
    {
        return $this->filterValidation();
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function filterValidation()
    {
        if (request()->segment(5) == 'update') {

            $collection = collect($this->validation())->map(function ($item, $key) {
                if (strpos($item, 'unique') !== false) {
                    $string = explode('|', $item);
                    $builder = '';
                    foreach ($string as $value) {
                        if (strpos($value, 'unique') === false) {
                            $builder = $builder.$value.'|';
                        }
                    }
                    $key = rtrim($builder, '|');
                } else {
                    $key = $item;
                }

                return $key;
            });

            return $collection->toArray();
        }

        if (request()->segment(5) == 'delete') {

            return [
                'code' => 'required',
            ];
        }

        return $this->validation();
    }
}
