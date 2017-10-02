<?php

namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Requests\Backend\TagCreateRequest;
use App\Http\Requests\Backend\TagUpdateRequest;
use App\Repositories\TagRepository;
use App\Tag;
use App\Transformers\Backend\TagTransformer;
use Illuminate\Http\Request;

class TagsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tags = Tag::recent()->get();
        return $this->response()->collection($tags, new TagTransformer());
    }

    public function store(TagCreateRequest $request, TagRepository $tagRepository)
    {
        $tagRepository->create($request->validated());
        return $this->response()->noContent();
    }


    public function update(Tag $tag, TagUpdateRequest $request, TagRepository $tagRepository)
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
