<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'code'=>sprintf('required|alpha_num|sometimes|min:2|max:10|unique:products,code,%d,id',$this->id),
            'name'=>sprintf('required|string|min:4|max:255|unique:products,name,%d,id',$this->id),
            'description'=>'required|string|max:255',
            'category_id'=>'integer|required',
            'brand'=>'required|string|max:255',
            'price'=>'numeric|required|min:100|max:99999999',
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
            'code.min'=>'El campo de código debe tener más de :min caracteres y minimo de :max caracteres',
            'code.max'=>'El campo de código debe tener más de :min caracteres y minimo de :max caracteres',
            'category_id.required'=>'el campo de categoría es obligatorio',
            'brand.required'=>'el campo de marca es obligatorio',
            'price.numeric'=>'el campo del precio debe ser númerico',
            'price.required'=>'el campo de precio es obligario',
            'price.min'=>'el campo precio debe ser menor a :min',
            'price.max'=>'el campo de precio debe ser menor a :max',
        ];
    }
}
