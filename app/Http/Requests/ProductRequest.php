<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Console\Input\Input;

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

        $rule1 = [
            'name' => ['required', 'string', 'unique:produits'],


            'description' => ['required', 'string', 'min:10'],
            // // 'etat_annonce' => ['required'],
            'sous_category' => ['required'],
            // 'file' => ['required'],
            // // 'cas_premium' => ['required'],
            // 'prixx_redution' => ['required', 'integer'],
            //  'prixx_redution' => ['required', 'integer'],
            // 'prixx_redution' => ['required', 'integer'],
            // // 'caution' => ['required', 'integer'],
            // 'valeur' => ['required'],
            // // 'colorval'=>['required'],
        ];
        if ($this->input('typeProduct') == 'configurable') {
            $rule1 = [
                'name' => ['required', 'string', 'unique:produits'],
                'description' => ['required', 'string', 'min:10'],
                // // 'etat_annonce' => ['required'],
                'prixx_redution' => ['required'],
                'prixx_redution.*' => ['required', 'Numeric'],
                //Less Than  Less Than Or Equal
                'prixx_initial' => ['required'],
                'prixx_initial.*' => ['required', 'Numeric'],
                'valeur' => ['required'],
                'valeur.*' => ['required'],
                'sous_category' => ['required'],
                'quantitex' => ['required'],
                'quantitex.*' => ['required', 'Numeric'],

            ];
        }

        return $rule1;
    }
    public function messages()
    {
        return [
            'prixx_redution.*.required' => 'tu dois mentionner le prix de reduction de tes variants',
        ];
    }
}