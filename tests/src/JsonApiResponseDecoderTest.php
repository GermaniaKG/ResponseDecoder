<?php
namespace tests;

use Germania\ResponseDecoder\JsonApiResponseDecoder;
use Germania\ResponseDecoder\ResponseDecoderInterface;

use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;


class JsonApiResponseDecoderTest extends \PHPUnit\Framework\TestCase
{
    use ProphecyTrait;

    public function testInstantiation()
    {
        $sut = new JsonApiResponseDecoder;
        $this->assertInstanceOf( ResponseDecoderInterface::class, $sut);
        return $sut;
    }

}
