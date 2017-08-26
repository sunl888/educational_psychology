<?php

namespace App\Http\Requests\Backend;


use App\Http\Requests\Request;
use App\Models\Category;
use App\Rules\ImageName;
use App\Rules\ImageNameExist;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends Request
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
        $category = $this->route('category');
        $rules = [
            'type' => ['nullable', Rule::in([Category::TYPE_POST, Category::TYPE_PAGE, Category::TYPE_LINK])],
            'image' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
            'parent_id' => ['bail', 'nullable', 'integer', Rule::exists('categories', 'id')->where('id', '!=', $category->id)],
            'cate_name' => ['nullable', 'string', 'between:2,30'],
            'description' => ['nullable', 'string', 'between:2,500'],
            'is_nav' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'url' => ['required_if:type,' . Category::TYPE_LINK, 'url'],
            'is_target_blank' => ['required_if:type,' . Category::TYPE_LINK, 'boolean'],
            'cate_slug' => ['bail', 'required_unless:type,' . Category::TYPE_LINK, 'string', 'between:2,30', Rule::unique('categories')->ignore($category->id)],
            'page_template' => ['nullable', 'alpha_dash', 'between:1,30'],
            'list_template' => ['nullable', 'alpha_dash', 'between:1,30'],
            'content_template' => ['nullable', 'alpha_dash', 'between:1,30']
        ];
    }
}
