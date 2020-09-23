<?php
namespace Germania\ResponseDecoder;

use Psr\Http\Message\ResponseInterface;

interface ResponseDecoderInterface
{

    /**
     * Returns the requested item as array.
     *
     * @param  ResponseInterface $response Response
     * @return array
     */
    public function getResource( ResponseInterface $response) : array;


    /**
     * Returns an array with the requested response items.
     *
     * @param  ResponseInterface $response Response
     * @return array
     */
    public function getResourceCollection( ResponseInterface $response) : array;
}
