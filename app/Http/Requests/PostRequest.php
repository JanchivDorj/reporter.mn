<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
    public function rules(Request $request)
    {
       /*  return [
            'title' => 'required|max:255',
            'content' => 'required',
            'post_img' => 'required|numeric',
            // 'image' => 'required'
            'image' => 'image|mimes:jpeg,jpg,bmp,png,gif|max:3000',
        ]; */

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'title' => 'required|max:255',
                        'content' => 'required',
                        'post_img' => 'required|numeric',
                        // 'image' => 'required'
                        'image' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:3000',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'title' => 'required|max:255',
                        'content' => 'required',
                        'post_img' => 'required|numeric',
                        // 'image' => 'required'
                        'image' => 'image|mimes:jpeg,jpg,bmp,png,gif|max:3000',
                    ];
                }
            default:
                break;

        // if($request->method() == 'PUT'){
        //     return [
        //         'title' => 'required|max:255',
        //         'content' => 'required',
        //         'post_img' => 'required|numeric',
        //         // 'image' => 'required'
        //     ];
        // }else{
        //     return [
        //         'title' => 'required|max:255',
        //         'content' => 'required',
        //         'post_img' => 'required|numeric',
        //         'image' => 'required'
        //     ];
        
        }
    }
}
