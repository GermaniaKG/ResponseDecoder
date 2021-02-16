<?php
namespace Germania\ResponseDecoder;

use Psr\Http\Message\ResponseInterface;

class ResourceCollectionDecoderCallable
{
    use ResponseDecoderTrait;

    public function __construct(ResponseDecoderInterface $decoder )
    {
        $this->setResponseDecoder( $decoder );
    }

    public function __invoke( ResponseInterface $response) : array
    {
        return $this->getResponseDecoder()->getResourceCollection($response);
    }

}
