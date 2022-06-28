<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Unidade extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'tag' =>  'required',
             'local_id' =>  'required',
             'data_fabricacao' =>  'required',
             'data_compra' =>  'required',
             'data_validade' =>  'required',
             'data_primeiro_uso' =>  'required',
        ];
    }
}
