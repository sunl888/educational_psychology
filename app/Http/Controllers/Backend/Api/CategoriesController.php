<?php


namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Backend\CategoryCreateRequest;
use App\Http\Requests\Backend\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Transformers\Backend\CategoryTransformer;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Category $category)
    {
        return $this->response()->item($category, new CategoryTransformer());
    }

    public function store(CategoryCreateRequest $request, CategoryRepository $categoryRepository)
    {
        $categoryRepository->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Category $category, CategoryUpdateRequest $request, CategoryRepository $categoryRepository)
    {
        $categoryRepository->update($request->validated(), $category);
        return $this->response()->noContent();
    }

    public function index()
    {
        $topicCategories = Category::topCategories()->get();
        $topicCategories->load(['children' => function ($query){
            $query->byType(request('type'));
        }]);
        $topicCategories = $topicCategories->filter(function ($category){
            return $category->children->isNotEmpty();
        });
        return $this->response()->collection($topicCategories, new CategoryTransformer())->disableEagerLoading();
    }

    public function destroy(Category $category)
    {
        // todo 考虑关联数据问题
        $category->delete();
        return $this->response()->noContent();
    }

}
