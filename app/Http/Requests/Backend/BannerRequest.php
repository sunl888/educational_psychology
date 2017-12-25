<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;
use App\Models\Banner;
use App\Rules\ImageName;
use App\Rules\ImageNameExist;
use Illuminate\Validation\Rule;

class BannerRequest extends Request
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
                    'url' => ['nullable', 'url'],
                    'title' => ['nullable', 'string', 'between:1,30'],
                    'image' => ['bail', 'required', new ImageName(), new ImageNameExist()],
                    'type_name' => ['bail', 'required', 'string', 'between:1,30', Rule::exists('types', 'name')->where('model_name', Banner::class)],
                    'is_visible' => ['nullable', 'boolean'],
                    'is_target_blank' => ['nullable', 'boolean'],
                    'enabled_at' => ['nullable', 'date'],
                    'expired_at' => ['nullable', 'date']
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'url' => ['nullable', 'url'],
                    'title' => ['nullable', 'string', 'between:1,30'],
                    'image' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
                    'type_name' => ['bail', 'nullable', 'string', 'between:1,30', Rule::exists('types', 'name')->where('model_name', Banner::class)],
                    'is_visible' => ['nullable', 'boolean'],
                    'is_target_blank' => ['nullable', 'boolean'],
                    'enabled_at' => ['nullable', 'date'],
                    'expired_at' => ['nullable', 'date']
                ];
            default:
                return [];
                break;
        }
    }

}
