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
 * Interface of HttpClient.
 *
 * @author Yuya Takeyama
 */
interface Graphico_Api_HttpClientInterface
{
    /**
     * @param  string $method Request method.
     * @param  string $uri    Request URI.
     * @param  array  $params Request parameters.
     * @return array
     */
    public function request($method, $uri, $params = array());
}
