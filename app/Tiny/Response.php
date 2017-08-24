<?php


namespace App\Tiny;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Illuminate\Http\Response as IlluminateResponse;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Scope;
use League\Fractal\Resource\Collection as FractalCollection;

class Response implements Responsable
{
    protected $status;
    protected $headers;
    protected $content;
    /**
     * @var FractalManager
     */
    protected static $fractalManager;

    public static function setFractalManager(FractalManager $fractalManager)
    {
        static::$fractalManager = $fractalManager;
    }

    public static function getFractalManager()
    {
        return static::$fractalManager;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function setHeaders($headers){
        $this->headers = $headers;
    }

    public function __construct($content = '', $status = 200, $headers = [])
    {
        $this->setContent($content);
        $this->setStatus($status);
        $this->setHeaders($headers);
    }

    public function toResponse($request)
    {
        return new IlluminateResponse($this->content, $this->status, $this->headers);
    }

    /**
     * @return Response
     */
    public function item($item, $transformer, $meta = []){
        $resource = new Item($item, $transformer);
        $resource->setMeta($meta);
        $this->setContent($this->fractalCreateData($resource));
        return $this;
    }

    /**
     * @return Response
     */
    public function collection(Collection $collection, $transformer, $meta = []){
        $resource = new FractalCollection($collection, $transformer);
        $resource->setMeta($meta);
        $this->setContent($this->fractalCreateData($resource));
        return $this;
    }

    /**
     * @return Response
     */
    public function paginator(Paginator $paginator, $transformer, $meta = []){
        $collection = $paginator->getCollection();
        $resource = new FractalCollection($collection, $transformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        $resource->setMeta($meta);
        $this->setContent($this->fractalCreateData($resource));
        return $this;
    }

    private function fractalCreateData(ResourceInterface $resource, $scopeIdentifier = null, Scope $parentScopeInstance = null){
        if(!isset(static::$fractalManager)) {
            static::setFractalManager(app(FractalManager::class));
        }
        return static::$fractalManager->createData($resource, $scopeIdentifier, $parentScopeInstance)->toArray();
    }

    /**
     * @return Response
     */
    public function noContent()
    {
        $this->setContent(null);
        $this->setStatus(204);
        return $this;
    }
}