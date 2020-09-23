<?php
namespace Germania\ResponseDecoder;

trait ResponseDecoderTrait
{

    /**
     * @var ResponseDecoderInterface
     */
    protected $response_decoder;


    /**
     * Returns the ResponseDecoder.
     *
     * @return ResponseDecoderInterface Response decoder
     */
    public function getResponseDecoder() : ?ResponseDecoderInterface
    {
        return $this->response_decoder;
    }


    /**
     * @param ResponseDecoderInterface $decoder Response decoder
     */
    public function setResponseDecoder( ResponseDecoderInterface $decoder )
    {
        $this->response_decoder = $decoder;
        return $this;
    }

}
