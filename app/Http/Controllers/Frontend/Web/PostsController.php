<?php

namespace App\Http\Controllers\Frontend\Web;


use App\Http\Requests\Request;
use App\Models\Post;
use Auth;

class PostsController extends FrontendController
{
    /**
     * 正文
     *
     * @param  $cateSlug
     * @return \Illuminate\Contracts\View\View
     */
    public function show($postSlug, Request $request)
    {
        /**
         * @var $post Post
         */
        $post = Post::bySlug($postSlug)->firstOrFail();
        /*if (Auth::check() && Auth::user()->can('admin.post.show')) {
            $post = $queryBuilder->where(
                function ($query) {
                    $query->publishAndDraft();
                }
            )->withTrashed()->firstOrFail();
            if (!$post->isPublish() || $post->trashed()) {
                // 管理员预览草稿或未发布的文章
                app(Alert::class)->setDanger('当前文章未发布，此页面只有管理员可见!');
            }
        } else {
            $post = $queryBuilder->publish()->firstOrFail();
        }*/
        //event(new PostHasBeenRead($category, $post, $request->getClientIp()));

        return view($post->getTemplate(), ['post' => $post]);
    }
}
