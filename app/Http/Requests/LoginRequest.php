<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password' => 'required|between:6,8',
            'user_name' => 'required|alpha_num|max:30',
        ];
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
