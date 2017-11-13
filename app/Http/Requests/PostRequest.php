<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
            return [
                    'image|mimes:jpg,png',
                    'title' => 'string|required',
                    'longtext' => 'string|required',
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

    public function inputs(){
        $inputs = $this->except(['_token']);
        
        $inputs['user_id'] = Auth::id();

        if(strlen($inputs['longtext'])<20) {
            $inputs['text']=$inputs['longtext'];
        } else {
            $inputs['text']=substr($inputs['longtext'],0,20).'...';
        }

        if($this->hasFile('image')) {   
            $image = $this->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/image'), $inputs['image']);
        } else {
            $inputs['image']='no-image.png';
        }
        
        return $inputs;
    }

}

