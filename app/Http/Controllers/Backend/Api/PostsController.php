<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Services\PostService;
use App\Transformers\Backend\PostTransformer;
use Illuminate\Http\Request;

class PostsController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 获取文章列表
     * @param Request $request
     * @return \App\Support\TransformerResponse
     */
    public function index(Request $request)
    {
        $posts = Post::applyFilter($request)
            ->paginate($this->perPage());
        return $this->response()->paginator($posts, new PostTransformer());
    }

    public function store(PostCreateRequest $request, PostService $postService)
    {
        $postService->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Post $post, PostUpdateRequest $request, PostService $postService)
    {
        $postService->update($post, $request->validated());
        return $this->response()->noContent();
    }

}