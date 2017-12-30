<?php


namespace App\Http\Controllers\Backend\Api;


use App\Http\Controllers\ApiController;
use App\Http\Controllers\Traits\Authorizable;
use App\Http\Requests\Backend\LinkRequest;
use App\Models\Link;
use App\Repositories\LinkRepository;
use App\Services\CustomOrder;
use App\Transformers\Backend\LinkTransformer;

class LinksController extends ApiController
{
    use Authorizable;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(LinkRequest $request)
    {
        $links = Link::byType($request->get('type_name', null))->oldest()->get();
        $links = app(CustomOrder::class)->order($links);
        return $this->response()->collection($links, new LinkTransformer());
    }

    public function store(LinkRequest $request, LinkRepository $linkRepository)
    {
        $linkRepository->create($request->validated());
        return $this->response()->noContent();
    }

    public function update(Link $link, LinkRequest $request, LinkRepository $linkRepository)
    {
        $linkRepository->update($request->validated(), $link);
        return $this->response()->noContent();
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return $this->response()->noContent();
    }

    public function show(Link $link)
    {
        return $this->response()->item($link, new LinkTransformer());
    }

}
