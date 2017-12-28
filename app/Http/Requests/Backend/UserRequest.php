<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;
use App\Rules\ImageName;
use App\Rules\ImageNameExist;
use Illuminate\Validation\Rule;

class UserRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'user_name' => ['bail', 'required', 'alpha_num', 'between:2,30', 'unique:users'],
                    'nick_name' => ['required', 'string', 'between:2,30'],
                    'password' => ['required', 'string', 'between:5,20'],
                    'email' => ['bail', 'required', 'email', 'unique:users'],
                    'avatar' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
                    'roles' => ['nullable', 'array'],
                    'permissions' => ['nullable', 'array'],
                ];
            case 'PUT':
            case 'PATCH':
                $user = $this->route('user');
                return [
                    'user_name' => ['bail', 'nullable', 'alpha_num', 'between:2,30', Rule::unique('users')->ignore($user->id)],
                    'nick_name' => ['nullable', 'string', 'between:2,30'],
                    'password' => ['nullable', 'string', 'between:5,20'],
                    'email' => ['bail', 'nullable', 'email', Rule::unique('users')->ignore($user->id)],
                    'avatar' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
                    'roles' => ['nullable', 'array'],
                    'permissions' => ['nullable', 'array'],
                ];
            default:
                return [];
                break;
        }

    }
}
