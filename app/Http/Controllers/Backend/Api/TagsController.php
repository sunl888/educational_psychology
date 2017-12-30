<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Traits\Authorizable;
use App\Http\Requests\Backend\TagRequest;
use App\Repositories\TagRepository;
use App\Models\Tag;
use App\Transformers\Backend\TagTransformer;

class TagsController extends ApiController
{
    use Authorizable;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::withSimpleSearch()->latest()->get();
        return $this->response()->collection($tags, new TagTransformer());
    }

    public function store(TagRequest $request, TagRepository $tagRepository)
    {
        $tag = $tagRepository->create($request->validated());
        return $this->response()->item($tag, new TagTransformer());
    }


    public function update(Tag $tag, TagRequest $request, TagRepository $tagRepository)
    {
        $tagRepository->update($request->validated(), $tag);
        return $this->response()->noContent();
    }

    public function show(Tag $tag)
    {
        return $this->response()->item($tag, new TagTransformer());
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->response()->noContent();
    }
}
