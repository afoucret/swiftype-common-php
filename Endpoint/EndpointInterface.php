<?php
/**
 * This file is part of the Elastic PHP Client Codegen package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elastic\Client\Endpoint;

/**
 * API endpoint interface.
 *
 * @package Elastic\Client
 *
 * @author  Aurélien FOUCRET <aurelien.foucret@elastic.co>
 */
interface EndpointInterface
{
    /**
     * HTTP method for the current endpoint.
     *
     * @return string
     */
    public function getMethod();

    /**
     * URI for the current endpoint.
     *
     * @return string
     */
    public function getURI();

    /**
     * Params data for the current endpoint.
     *
     * @return string[]|null
     */
    public function getParams();

    /**
     * Body content for the current endpoint.
     *
     * @return array|null
     */
    public function getBody();

    /**
     * Set body data for the endpoint.
     *
     * @param array|null $body body data
     *
     * @return $this
     */
    public function setBody($body);

    /**
     * Set params data for the endpoint.
     *
     * @param array|null $params params data
     *
     * @return $this
     */
    public function setParams($params);
}
