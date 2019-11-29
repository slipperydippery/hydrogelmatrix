<?php

namespace App\Http\Requests;

use App\Test;
use Illuminate\Foundation\Http\FormRequest;

class StoreTest extends FormRequest
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
    public function rules(Test $test)
    {
        if($this->test){
            return ;
        }

        return [
            'title' => 'required|max:255',
            'slug' => 'required|unique:tests,slug|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Een titel is verplict',
            'slug.required'  => 'Een slug is verplicht',
            'slug.unique'  => 'Een slug moet uniek zijn',
        ];
    }
}
