<?php
/**
 * This file is part of the Swiftype Common PHP Client package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swiftype\Tests\Unit\Connection\Handler;

use GuzzleHttp\Ring\Future\CompletedFutureArray;
use PHPUnit\Framework\TestCase;
use Swiftype\Connection\Handler\ResponseSerializationHandler;
use Swiftype\Serializer\SmartSerializer;

/**
 * Unit tests for the response serialization handler.
 *
 * @package Swiftype\Test\Unit\Connection\Handler
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
        $data = [
            ['{"foo": "bar"}', ['foo' => 'bar']],
            ['["foo", "bar"]', ['foo', 'bar']],
            ['{}', []],
            ['[]', []],
            // @todo : try invalid response and exception
        ];

        return $data;
    }

    /**
     * @return \Swiftype\Connection\Handler\RequestSerializationHandler
     */
    private function getHandler($body)
    {
        $handler = function () use ($body) {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $body);
            rewind($stream);
            $headers = ['content_type' => 'application/json'];

            return new CompletedFutureArray(['body' => $stream, 'transfer_stats' => $headers]);
        };

        $serializer = $this->getSerializer();

        return new ResponseSerializationHandler($handler, $serializer);
    }

    /**
     * @return \Swiftype\Serializer\SmartSerializer
     */
    private function getSerializer()
    {
        return new SmartSerializer();
    }
}
