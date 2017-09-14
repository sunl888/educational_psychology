<?php

namespace App\Http\Controllers\Frontend\Web;


use App\Models\Post;
use Illuminate\Http\Request;
use Auth;


class PostsController extends FrontendController
{
    /**
     * 正文
     *
     * @param  $cateSlug
     * @return \Illuminate\Contracts\View\View
     */
    public function show($slug, Request $request)
    {
        /**
         * @var $post Post
         */
        $queryBuilder = Post::bySlug($slug);
        if (Auth::check()) {

            $post = $queryBuilder->where(
                function ($query) {
                    $query->publishOrDraft();
                }
            )->withTrashed()->firstOrFail();

            if (!$post->isPublish() || $post->trashed()) {
                // 管理员预览草稿或未发布的文章
                app(Alert::class)->setDanger('当前文章未发布，此页面只有管理员可见!');
            }

        } else {
            $post = $queryBuilder->publishPost()->firstOrFail();
        }
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
