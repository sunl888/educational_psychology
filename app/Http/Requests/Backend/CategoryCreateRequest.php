<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;
use App\Models\Category;
use App\Rules\ImageName;
use App\Rules\ImageNameExist;
use Illuminate\Validation\Rule;

class CategoryCreateRequest extends Request
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
            'type' => ['required', Rule::in([Category::TYPE_POST, Category::TYPE_PAGE, Category::TYPE_LINK])],
            'image' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
            'parent_id' => ['bail', 'nullable', 'integer', 'exists:categories,id'],
            'cate_name' => ['required', 'string', 'between:2,30'],
            'description' => ['nullable', 'string', 'between:2,500'],
            'url' => ['required_if:type,' . Category::TYPE_LINK, 'url'],
            'is_target_blank' => ['required_if:type,' . Category::TYPE_LINK, 'boolean'],
            'is_nav' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'page_template' => ['required_if: type,' . Category::TYPE_PAGE, 'alpha_dash', 'between:1,30'],
            'list_template' => ['required_if:type,' . Category::TYPE_POST, 'alpha_dash', 'between:1,30'],
            'content_template' => ['required_if:type,' . Category::TYPE_POST, 'alpha_dash', 'between:1,30']
        ];
    }
}
