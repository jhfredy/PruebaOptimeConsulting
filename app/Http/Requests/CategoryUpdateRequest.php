<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'code'=>sprintf('sometimes|required|alpha_num|unique:categories,code,%d,id',$this->id),
            'name'=>sprintf('required|string|min:2|max:255|unique:categories,name,%d,id',$this->id),
            'description'=>'required|string|max:255',
        ];
        
    }

    public function messages()
    {
        return [
            'code.required' => 'El campo de código es requerido',
            'name.required' =>'El campo de nombre es requerido',
            'description.required' => 'El campo de descripcion es requerido',
            'name.min' => 'El campo de nombre debe tener mas de :min caracteres',
            'code.alpha' => 'El campo de código no acepta caracteres especiales',
            'code.unique' => 'Este registro ya existe',
            'name.unique' => 'Este Registro ya existe',
            'code.alpha_num'=>'El campo de código solo acepta números y letras',
        ];
    }
}
