<?php
/**
 * This file is part of php-graphico-api.
 *
 * (c) Yuya Takeyama
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Interface of response.
 *
 * @author Yuya Takeyam
 */
interface Graphico_Api_ResponseInterface extends ArrayAccess
{
    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return array
     */
    public function getHeader();

    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @return bool
     */
    public function isClientError();

    /**
     * @return bool
     */
    public function isServerError();
}
