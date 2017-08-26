<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;
use App\Models\Category;
use App\Models\Post;
use App\Rules\ImageName;
use App\Rules\ImageNameExist;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends Request
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
        $post = $this->route('post');
        return [
            'title' => ['nullable', 'string', 'max:100'],
            'slug' => ['bail', 'required', 'regex:/^[A-Za-z0-9\-\_]+$/', 'string', Rule::unique('posts')->ignore($post->id)],
            'excerpt' => ['nullable', 'string'],
            'content' => 'required|string',
            'cover' => ['bail', 'nullable', new ImageName(), new ImageNameExist()],
            'status' => ['nullable', Rule::in([Post::STATUS_PUBLISH, Post::STATUS_DRAFT])],
            'type' => ['nullable', Rule::in([Category::TYPE_POST, Category::TYPE_PAGE])],
            'views_count' => ['nullable', 'integer'],
            'order' => ['nullable', 'integer'],
            'template' => ['nullable', 'string', 'between:1,30'],
            'category_id' => ['bail', 'nullable', 'integer', 'exists:categories,id'],
            'published_at' => ['nullabl', 'date']
        ];
    }
}
