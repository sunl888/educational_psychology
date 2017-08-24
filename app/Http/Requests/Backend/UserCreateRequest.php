<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class UserCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|unique:users',
            'nick_name' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'avatar' => 'nullable|',
            'password' => 'required',
            'role_ids' => 'nullable|int_array'
        ];
    }
}