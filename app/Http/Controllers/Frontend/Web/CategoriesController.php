<?php


namespace App\Http\Controllers\Frontend\Web;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends FrontendController
{
    public function show($slug, Request $request)
    {
        /**
         * @var $category Category
         */
        $category = Category::byCateSlug($slug)->firstOrFail();
        if ($category->isPostList()) {
            return $this->showList($category, $request);
        } else {
            return $this->showPage($category);
        }
    }

    protected function showList(Category $category, Request $request)
    {
        $posts = $category->postListWithOrder($request->get('order'))->with('user')->paginate($this->perPage());
        $posts->appends($request->all());

        return view('theme::' . $category->getListTemplate(), [
            'posts' => $posts,
            'category' => $category
        ]);
    }

    protected function showPage(Category $category)
    {
        $page = $category->getPage();
        if (is_null($page)) {
            // todo
            abort(404, '该单页还没有初始化');
        }

        return view('theme::' . $category->getPageTemplate(), [
            'category' => $category,
            'page' => $page
        ]);
    }
}
