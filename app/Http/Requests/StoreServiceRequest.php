<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_title'      => 'required',
            'service_price'     => 'required'
        ];
    }

    public function attributes(){

        return [
            'service_title' => 'Название сервиса',
            'service_price' => 'Цена'
        ];

    }
}
