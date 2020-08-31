<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            // 'name'=>['required', 'string'],
           

            // 'description' => ['required', 'string', 'min:10'],
            // // 'etat_annonce' => ['required'],
            // 'sous_category' => ['required'],
            // // 'cas_premium' => ['required'],
            //  'prixx_redution' => ['required', 'integer'],
            //  'prixx_redution' => ['required', 'integer'],
            // 'prixx_redution' => ['required', 'integer'],
            //  'quantitex'=> ['required', 'integer'],
            // // 'caution' => ['required', 'integer'],
            // 'valeur' => ['required'],
            // // 'colorval'=>['required'],
        ];
    }
      // public function messages(){
    //     return [
    //         'titre.min' => 'min de 4 lettre example  ',
    //     ];
    // }
}
