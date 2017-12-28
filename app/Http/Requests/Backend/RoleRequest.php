<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class RoleRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'name' => ['bail', 'required', 'alpha_num', 'between:2,30', 'unique:roles'],
                    'display_name' => ['nullable', 'string', 'between:2,30'],
                    'description' => ['nullable', 'string', 'between:2,190'],
                    'order' => ['nullable', 'integer'],
                    'permissions' => ['nullable', 'array']
                ];
            case 'PUT':
            case 'PATCH':
                $role = $this->route()->parameter('role');
                return [
                    'name' => ['bail', 'nullable', 'alpha_num', 'between:2,30', Rule::unique('roles')->ignore($role->id)],
                    'display_name' => ['nullable', 'string', 'between:2,30'],
                    'description' => ['nullable', 'string', 'between:2,190'],
                    'order' => ['nullable', 'integer'],
                    'permissions' => ['nullable', 'array']
                ];
            default:
                return [];
                break;
        }
    }
}
