<?php

namespace App\Http\Controllers\Frontend\Web;


use App\Events\PostHasBeenRead;
use App\Models\Post;
use App\Services\Alert;
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

        event(new PostHasBeenRead($post, $request->getClientIp()));

        return view('theme::' . $post->getTemplate(), ['post' => $post]);
    }
}
