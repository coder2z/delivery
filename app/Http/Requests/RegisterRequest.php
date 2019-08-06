<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
    public function rules()
    {
        return [
            'name' => 'required|max:30|unique:users,name',
            'password' => 'required|max:16',
            'rpassword' => 'required|same:password',
            'number' => 'required|max:18|unique:users,number',
            'token'=>'required',
            'tel' => 'required|max:11|min:7|unique:users,tel',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不为空',
            'name.max' => '用户名太长',
            'name.unique' => '用户名重复',
            'password.required' => '密码不为空',
            'password.max' => '密码太长',
            'number.required' => '身份证不为空',
            'number.max' => '身份证格式不正确',
            'number.unique' => '此身份证已经注册',
            'token.required' => '职务不为空',
            'tel.required' => '电话不为空',
            'tel.max' => '电话号码格式不正确',
            'tel.min' => '电话号码格式不正确',
            'tel.unique' => '电话号码已经注册',
            'rpassword.same' => '密码与确认密码不匹配',
            'rpassword.required' => '密码与确认密码不匹配',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json([
            'code' => 422,
            $validator->errors(),
        ], 422)));
    }
}
