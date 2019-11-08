<?php

namespace App\Http\Requests;

use App\Deck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeck extends FormRequest
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
    public function rules(Deck $deck)
    {
        if($this->deck) {
            return [
                'title' => 'required|max:255',
                'slug' => [
                    'required',
                    Rule ::unique('decks')->ignore($this->deck->id)],
                'description' => 'max:5000',
                'public' => 'required'
            ];
        }

        return [
            'title' => 'required|max:255',
            'slug' => 'required|unique:decks,slug|max:255',
            'description' => 'max:5000',
            'public' => 'required'
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
