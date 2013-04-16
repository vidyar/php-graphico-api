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
 * Response of Graphico API.
 *
 * @author Yuya Takeyam
 */
class Graphico_Api_Response implements Graphico_Api_ResponseInterface
{
    /**
     * @var int
     */
    private $status;

    /**
     * @var array
     */
    private $header;

    /**
     * @string
     */
    private $body;

    /**
     * Constructor.
     *
     * @param  int    $status
     * @param  array  $header
     * @param  string $body
     */
    public function __construct($status, array $header, $body)
    {
        $this->status = $status;
        $this->header = $header;
        $this->body   = $body;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function isSuccess()
    {
        return $this->getStatus() >= 200 && $this->getStatus() < 300;
    }

    public function isClientError()
    {
        return $this->getStatus() >= 400 && $this->getStatus() < 500;
    }

    public function isServerError()
    {
        return $this->getStatus() >= 500 && $this->getStatus() < 600;
    }

    public function offsetExists($key)
    {
    }

    public function offsetGet($key)
    {
    }

    public function offsetSet($key, $value)
    {
    }

    public function offsetUnset($key)
    {
    }
}
