<?php

namespace App\Support;


use Illuminate\Contracts\Support\Responsable;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Scope;
use League\Fractal\Resource\Collection as FractalCollection;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

class TransformerResponse implements Responsable
{

    protected $resource = null;
    protected $meta = [];
    protected $response;
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

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
    /**
     * @return TransformerResponse
     */
    public function item($item, $transformer){
        $this->resource = new Item($item, $transformer);
        return $this;
    }

    /**
     * @return TransformerResponse
     */
    public function collection(Collection $collection, $transformer){
        $this->resource = new FractalCollection($collection, $transformer);
        return $this;
    }

    /**
     * @return TransformerResponse
     */
    public function paginator(Paginator $paginator, $transformer){
        $collection = $paginator->getCollection();
        $this->resource = new FractalCollection($collection, $transformer);
        $this->resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this;
    }

    private function fractalCreateData(ResourceInterface $resource, $scopeIdentifier = null, Scope $parentScopeInstance = null){

        if(!isset(static::$fractalManager)) {
            static::setFractalManager(app(FractalManager::class));
        }
        return static::$fractalManager->createData($resource, $scopeIdentifier, $parentScopeInstance)->toArray();
    }

    public function toResponse($request)
    {
        $this->resource->setMeta($this->meta);
        $this->response->setContent($this->fractalCreateData($this->resource));
        return $this->response->toResponse($request);
    }

    /**
     * Set the meta data for the binding.
     *
     * @param array $meta
     *
     * @return TransformerResponse
     */
    public function setMeta(array $meta)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * Add a meta data key/value pair.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return TransformerResponse
     */
    public function addMeta($key, $value)
    {
        $this->meta[$key] = $value;
        return $this;
    }

    /**
     * Get the binding meta data.
     *
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    public function __call($method, $arguments)
    {
        return $this->response->$method(...$arguments);
    }

}