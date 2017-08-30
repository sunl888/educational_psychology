<?php


namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Backend\CategoryCreateRequest;
use App\Http\Requests\Backend\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
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

    public function index(Request $request)
    {
        $type = $request->get('type', null);
        $topicCategories = Category::topCategories()->ordered()->ancient()->get();
        $topicCategories->load(['children' => function ($query) use ($type) {
            $query->byType($type)->ordered()->ancient();
        }]);
        if (!is_null($type)) {
            $topicCategories = $topicCategories->filter(function ($category) use ($type) {
                return $category->type == $type || $category->children->isNotEmpty();
            });
        }

        return $this->response()->collection($topicCategories, new CategoryTransformer())->disableEagerLoading();
    }

    public function visualOutput(Request $request, CategoryService $categoryService)
    {
        return $categoryService->allCategoryIndent($request->get('type'), '　∟　');
    }

    public function destroy(Category $category)
    {
        // todo 考虑关联数据问题
        $category->delete();
        return $this->response()->noContent();
    }

}
