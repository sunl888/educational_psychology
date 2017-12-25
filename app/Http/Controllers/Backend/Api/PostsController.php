<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Traits\Authorizable;
use App\Http\Requests\Backend\PostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Transformers\Backend\PostTransformer;

class PostsController extends ApiController
{
    use Authorizable;

    public function __construct()
    {
        $this->middleware('auth');
        $this->addAbility(['realDestroy' => 'delete']);
    }

    /**
     * 获取文章列表
     * @param PostRequest $request
     * @return \App\Support\Response\TransformerResponse
     */
    public function index(PostRequest $request)
    {
        $posts = Post::applyFilter($request)
            ->withSimpleSearch()
            ->withSort()
            ->paginate($this->perPage());
        return $this->response()->paginator($posts, new PostTransformer())->setMeta(Post::getAllowSearchFieldsMeta() + Post::getAllowSortFieldsMeta());
    }

    public function store(PostRequest $request, PostRepository $postRepository)
    {
        $postRepository->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Post $post, PostRequest $request, PostRepository $postRepository)
    {
        $postRepository->update($request->validated(), $post);
        return $this->response()->noContent();
    }

    public function show(Post $post)
    {
        return $this->response()->item($post, new PostTransformer());
    }

    /**
     * 软删除
     * @param Post $post
     * @return \App\Support\Response\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->response()->noContent();
    }

    /**
     * 真删除
     * @param $post
     * @return \App\Support\Response\Response
     */
    public function realDestroy($post)
    {
        $postModel = app(Post::class);
        $postModel->where($postModel->getRouteKeyName(), $post)->forceDelete();
        return $this->response()->noContent();
    }


    /**
     * 恢复软删除
     * @param $post
     * @return mixed
     */
    public function restore($post)
    {
        $postModel = app(Post::class);
        $postModel->onlyTrashed()->where($postModel->getRouteKeyName(), $post)->restore();
        return $this->response()->noContent();
    }
}
