<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sumR extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'sum' => 'required|numeric|min:1|max:100',
            'min' => 'required|numeric|min:0|max:100|lt:max',
            'max' => 'required|numeric|min:1|max:100|gt:min',
            'addition' => 'required_without_all:subtraction,multiplication,divisionMethod',
            'subtraction' => 'required_without_all:addition,multiplication,divisionMethod',
            'multiplication' => 'required_without_all:addition,subtraction,divisionMethod',
            'divisionMethod' => 'required_without_all:addition,subtraction,multiplication',
        ];
    }

    public function messages()
    {
        return [
            'min.lt' => '范围最小的数 必须小于 范围最大的数。！',
            'max.gt' => '范围最大的数 必须大于 范围最小的数。！',
        ];
    }
}
