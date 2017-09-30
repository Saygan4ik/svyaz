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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('product');
        return [
            'name' => 'required|unique:products,name,'.$id.'|max:100',
            'group_id' => 'required',
            'price' => 'numeric|nullable',
            'quantity' => 'numeric|nullable',
            'discount' => 'numeric|nullable|min:0'
        ];
    }
}
