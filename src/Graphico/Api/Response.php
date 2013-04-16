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
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $data;

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
        $this->parseBodyAsJson();

        return isset($this->data[$key]);
    }

    public function offsetGet($key)
    {
        $this->parseBodyAsJson();

        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function offsetSet($key, $value)
    {
        throw new BadMethodCallException('Response is immutable');
    }

    public function offsetUnset($key)
    {
        throw new BadMethodCallException('Response is immutable');
    }

    private function parseBodyAsJson()
    {
        if (is_null($this->data)) {
            $this->data = json_decode($this->body, true);
        }
    }
}
