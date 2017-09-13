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
        $postList = $category->postListWithOrder($request->get('order'))->with('user')->paginate($this->perPage());
        $postList->appends($request->all());

        return view($category->getListTemplate(), [
            'postList' => $postList,
        ]);
    }

    protected function showPage(Category $category)
    {
        $page = $category->getPage();
        if (is_null($page)) {
            // todo
            abort(404, '该单页还没有初始化');
        }

        return view($category->getPageTemplate(), ['page' => $page]);
    }
}
