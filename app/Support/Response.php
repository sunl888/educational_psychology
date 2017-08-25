<?php


namespace App\Support;


use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Class Response
 * @method TransformerResponse item($item, $transformer)
 * @method TransformerResponse collection(\Illuminate\Support\Collection $collection, $transformer)
 * @method TransformerResponse paginator(\Illuminate\Contracts\Pagination\Paginator $paginator, $transformer)
 * @method \League\Fractal\Manager getFractalManager()
 * @method void setFractalManager(\League\Fractal\Manager $fractalManager)
 * @method TransformerResponse setMeta(array $meta)
 * @method TransformerResponse addMeta($key, $value)
 * @method void getMeta()
 * @package App\Support
 */

class Response implements Responsable
{
    protected $status;
    protected $headers;
    protected $content;

    protected $resource = null;


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
    public function noContent()
    {
        $this->setContent(null);
        $this->setStatus(204);
        return $this;
    }

    public function __call($methodName, $arguments)
    {
        return (new TransformerResponse($this))->$methodName(...$arguments);
    }
}