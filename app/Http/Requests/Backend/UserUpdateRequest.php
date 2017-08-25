<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;
use App\Rules\ImageName;
use App\Rules\ImageNameExist;

class UserUpdateRequest extends Request
{
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
            'user_name' => 'nullable|unique:users',
            'nick_name' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:5|max:20',
            'email' => 'nullable|email|unique:users',
            'avatar' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
            'roles' => 'nullable|array',
            'permissions' => 'nullable|array',
        ];
    }
}