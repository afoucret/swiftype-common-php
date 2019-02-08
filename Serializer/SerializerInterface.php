<?php
/**
 * This file is part of the Elastic PHP Client Codegen package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elastic\Client\Serializer;

/**
 * Serializer interface.
 *
 * @package Elastic\Client\Serializer
 *
 * @author  Aurélien FOUCRET <aurelien.foucret@elastic.co>
 */
interface SerializerInterface
{
    /**
     * Serialize a complex data-structure into a json encoded string.
     *
     * @param mixed The data to encode
     *
     * @return string
     */
    public function serialize($data);

    /**
     * Deserialize json encoded string into an associative array.
     *
     * @param string $data    JSON encoded string
     * @param array  $headers Response Headers
     *
     * @return array
     */
    public function deserialize($data, $headers);
}
