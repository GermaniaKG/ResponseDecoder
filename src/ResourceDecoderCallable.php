<?php
namespace Germania\ResponseDecoder;

use Psr\Http\Message\ResponseInterface;

class ResourceDecoderCallable
{
    use ResponseDecoderTrait;

    public function __construct (ResponseDecoderInterface $decoder )
    {
        $this->setResponseDecoder( $decoder );
    }

    public function __invoke( ResponseInterface $response) : array
    {
        return $this->getResponseDecoder()->getResource($response);
    }

}
