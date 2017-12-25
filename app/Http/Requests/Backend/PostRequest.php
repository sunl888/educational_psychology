<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;
use App\Models\Category;
use App\Models\Post;
use App\Rules\ImageName;
use App\Rules\ImageNameExist;
use Illuminate\Validation\Rule;

class PostRequest extends Request
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
                    'title' => ['required', 'string', 'between:1,100'],
                    'excerpt' => ['nullable', 'string', 'between:1,512'],
                    'content' => ['required', 'string'],
                    // todo 图片尺寸验证
                    'cover' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
                    'status' => ['nullable', Rule::in([Post::STATUS_PUBLISH, Post::STATUS_DRAFT])],
                    'type' => ['nullable', Rule::in([Category::TYPE_POST, Category::TYPE_PAGE])],
                    'views_count' => ['nullable', 'integer'],
                    'order' => ['nullable', 'integer'],
                    'template' => ['nullable', 'string', 'between:1,30'],
                    'category_id' => ['bail', 'required', 'integer', Rule::exists('categories', 'id')->where(function ($query) {
                        $query->where('type', Category::TYPE_POST);
                    })],
                    'published_at' => ['nullable', 'date'],
                    'top' => ['nullable'],
                    'top_expired_at' => ['nullable', 'date'],
                    'attachment_ids' => ['nullable', 'array'],
                    'tag_ids' => ['nullable', 'array'],
                    'fields' => ['nullable', 'array']
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'title' => ['nullable', 'string', 'between:1,100'],
                    'excerpt' => ['nullable', 'string', 'between:1,512'],
                    'content' => ['nullable', 'string'],
                    'cover' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
                    'status' => ['nullable', Rule::in([Post::STATUS_PUBLISH, Post::STATUS_DRAFT])],
                    'type' => ['nullable', Rule::in([Category::TYPE_POST, Category::TYPE_PAGE])],
                    'views_count' => ['nullable', 'integer'],
                    'order' => ['nullable', 'integer'],
                    'template' => ['nullable', 'string', 'between:1,30'],
                    'category_id' => ['bail', 'nullable', 'integer', Rule::exists('categories', 'id')->where(function ($query) {
                        $query->where('type', Category::TYPE_POST);
                    })],
                    'published_at' => ['nullable', 'date'],
                    'top' => ['nullable'],
                    'top_expired_at' => ['nullable', 'date'],
                    'attachment_ids' => ['nullable', 'array'],
                    'tag_ids' => ['nullable', 'array'],
                    'fields' => ['nullable', 'array']
                ];
            default:
                return [];
                break;
        }

    }
}
