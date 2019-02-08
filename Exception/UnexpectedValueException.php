<?php
/**
 * This file is part of the Elastic PHP Client Codegen package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Elastic\Client\Exception;

/**
 * Denote a value that is outside the normally accepted values.
 *
 * @package Elastic\Client\Exception
 *
 * @author  Aurélien FOUCRET <aurelien.foucret@elastic.co>
 */
class UnexpectedValueException extends \UnexpectedValueException implements ClientException
{
}
