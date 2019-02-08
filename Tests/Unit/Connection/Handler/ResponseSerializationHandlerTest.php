<?php
/**
 * This file is part of the Elastic PHP Client Codegen package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elastic\Client\Tests\Unit\Connection\Handler;

use GuzzleHttp\Ring\Future\CompletedFutureArray;
use PHPUnit\Framework\TestCase;
use Elastic\Client\Connection\Handler\ResponseSerializationHandler;
use Elastic\Client\Serializer\SmartSerializer;

/**
 * Unit tests for the response serialization handler.
 *
 * @package Elastic\Client\Test\Unit\Connection\Handler
 *
 * @author  Aurélien FOUCRET <aurelien.foucret@elastic.co>
 */
class ResponseSerializationHandlerTest extends TestCase
{
    /**
     * Check data unserialization accross various response of the dataprovider.
     *
     * @dataProvider requestDataProvider
     */
    public function testBodyContent($body, $expectedResult)
    {
        if ($expectedResult instanceof \Exception) {
            $this->expectException(get_class($expectedResult));
        }

        $handler = $this->getHandler($body);
        $result = $handler([])->wait();

        if (!$expectedResult instanceof \Exception) {
            $this->assertEquals($expectedResult, $result['body']);
        }
    }

    /**
     * @return array
     */
    public function requestDataProvider()
    {
        $serializer = $this->getSerializer();
        $data = [
            [$serializer->serialize(['foo' => 'bar']), ['foo' => 'bar']],
            ['["foo", "bar"]', ['foo', 'bar']],
            ['{}', []],
            ['[]', []],
            // @todo : try invalid response and exception
        ];

        return $data;
    }

    /**
     * @return \Elastic\Client\Connection\Handler\RequestSerializationHandler
     */
    private function getHandler($body)
    {
        $handler = function ($request) use ($body) {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $body);
            rewind($stream);

            return new CompletedFutureArray(['body' => $stream]);
        };

        $serializer = $this->getSerializer();

        return new ResponseSerializationHandler($handler, $serializer);
    }

    /**
     * @return \Elastic\Client\Serializer\SmartSerializer
     */
    private function getSerializer()
    {
        return new SmartSerializer();
    }
}
