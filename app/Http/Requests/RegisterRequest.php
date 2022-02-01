<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if($request->method() == 'PUT'){
            return [
                'password' => 'required|between:6,8',
                'email' => 'required|email|unique:users,email',
                'first_name' => 'required|max:30',
                'last_name' => 'required|max:30',
            ];
        }else{
            return [
                'password' => 'required|between:6,8',
                'email' => 'required|email|unique:users,email',
                'first_name' => 'required|alpha_num|max:30',
                'last_name' => 'required|alpha_num|max:30',
                'same_password' => 'required|same:password'
            ];
        } 
    }
    public function messages(){
        return [
            'required' => 'Хоосон байна',
            'email' =>'И-мэйл буруу байна',
            'alpha' => 'Зөвхөн цагаан толгойн тэмдэгт байна',
            'max' => ':max -с бага утга байх ёстой',
            'same' => 'Нууц үг тохирохгүй байна '
        ];
    }
}
