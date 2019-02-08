<?php
/**
 * This file is part of the Elastic PHP Client Codegen package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elastic\Client\Exception;

/**
 * Exception thrown when something goes bad on the server.
 *
 * @package Elastic\Client\Exception
 *
 * @author  Aurélien FOUCRET <aurelien.foucret@elastic.co>
 */
class ApiException extends ConnectionException implements ClientException
{
}
