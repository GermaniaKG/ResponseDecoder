<?php
namespace Germania\ResponseDecoder;

use Germania\JsonDecoder\JsonDecoder;
use Psr\Http\Message\ResponseInterface;

class JsonApiResponseDecoder implements ResponseDecoderInterface
{


    /**
     * @inheritDoc
     */
    public function getResourceCollection( ResponseInterface $response) : array
    {
        $data = $this->getData($response);
        array_walk($data, [$this, 'validateItem']);
        $items = array_column($data, "attributes");
        return $items;
    }


    /**
     * @inheritDoc
     */
    public function getResource( ResponseInterface $response) : array
    {
        $data = $this->getData($response);
        $this->validateItem($data);
        $item = $data["attributes"];
        return $item;
    }



    /**
     * @throws ReponseDecoderException
     */
    protected function validateItem( $resource_item, $index = null )
    {
        if (!is_array($resource_item)) {
            $msg = !is_null($index)
            ? sprintf("Element %s: Expected array, got '%s'", $index, gettype($resource_item))
            : sprintf("Expected array, got '%s'", gettype($resource_item));

            throw new ReponseDecoderException($msg);
        }
        if (!array_key_exists("attributes", $resource_item)) {
            throw new ReponseDecoderException("Data element lacks 'attributes'");
        }
    }


    /**
     * @param  ResponseInterface $response
     * @return array
     *
     * @throws ReponseDecoderException
     */
    public function getData( ResponseInterface $response) : array
    {
        try {
            $response_body_decoded = (new JsonDecoder)($response, "associative");
        }
        catch (\JsonException $e) {
            throw new ReponseDecoderException("Problems decoding JSON", 0, $e);
        }

        if (!isset( $response_body_decoded['data'] )):
            throw new ReponseDecoderException("Missing 'data' element");
        endif;

        if (!is_array( $response_body_decoded['data'] )):
            throw new ReponseDecoderException("Element 'data' is not array");
        endif;

        $result = $response_body_decoded['data'];
        return $result;
    }
}
