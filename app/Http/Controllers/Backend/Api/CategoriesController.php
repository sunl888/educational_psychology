<?php


namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Transformers\Backend\CategoryTransformer;

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

    public function store(CategoryCreateRequest $request, CategoryService $categoryService)
    {
        $categoryService->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Category $category, CategoryUpdateRequest $request, CategoryService $categoryService)
    {
        $categoryService->update($category, $request->validated());
        return $this->response()->noContent();
    }

    public function index()
    {

    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->response()->noContent();
    }

}