<?php
namespace tests;

use Germania\ResponseDecoder\ResponseDecoderInterface;
use Germania\ResponseDecoder\ResourceDecoderCallable;

use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;


class ResourceDecoderCallableTest extends \PHPUnit\Framework\TestCase
{
    use ProphecyTrait;

    public function testInstantiation()
    {
        $decoder_mock = $this->prophesize(ResponseDecoderInterface::class);
        $decoder = $decoder_mock->reveal();

        $sut = new ResourceDecoderCallable($decoder);
        $this->assertIsCallable( $sut );
        return $sut;
    }

}
