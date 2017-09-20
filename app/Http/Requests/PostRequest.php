<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                    'image' => 'image',
                    'title' => 'required',
                    'longtext' => 'required',
                    'category_id' => 'required',
                  ];
        
   }

   public function messages()
    {
        return [
            'image' =>'The file must be a picture',
            'longtext.required' => 'The text field is required',
            'category_id.required' => 'Choose a category!!'
       ];
    }
}