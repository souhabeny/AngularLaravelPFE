<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
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
            'libelle' => 'required',
           'description' => 'required',
           'couleur'=>'string',
           'image'=>'required | image',
           'prix' => 'required | Numeric',
           'promo'=> 'Numeric | between:0,99.99',
           
           'idCategorie' => 'required',
           'idUser' => 'required',
           
        ];
    }
}
