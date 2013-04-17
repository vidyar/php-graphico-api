<?php
/**
 * This file is part of php-graphico-api.
 *
 * (c) Yuya Takeyama
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once 'HTTP/Request.php';

/**
 * HttpClient uses PEAR's HTTP_Request.
 *
 * @author Yuya Takeyama
 */
class Graphico_Api_HttpClient_PearClient implements Graphico_Api_HttpClientInterface
{
    /**
     * @var array
     */
    private $options;

    public function __construct($options = array())
    {
        $default = array(
            'timeout'        => 10,
            'allowRedirects' => false,
        );

        $this->options = array_merge($default, $options);
    }

    /**
     * @param  string $method Request method.
     * @param  string $url    Request URL.
     * @param  array  $params Request parameters.
     * @return array
     */
    public function request($method, $url, $params = array())
    {
        $req = new HTTP_Request($url, $this->options);

        switch (strtoupper($method)) {
        case 'GET':
            $req->setMethod(HTTP_REQUEST_METHOD_GET);
            break;
        case 'POST':
            $req->setMethod(HTTP_REQUEST_METHOD_POST);
            break;
        case 'PUT':
            $req->setMethod(HTTP_REQUEST_METHOD_PUT);
            break;
        case 'DELETE':
            $req->setMethod(HTTP_REQUEST_METHOD_DELETE);
            break;
        default:
            throw new InvalidArgumentException(sprintf('Invalid method "%s" is specified', $method));
        }

        foreach ($params as $key => $value) {
            $req->addPostData($key, $value);
        }

        if (Pear::isError($req->sendRequest())) {
            throw new RuntimeException(sprintf('Exception is occured when requesting to %s', $url));
        }

        return array($req->getResponseCode(), $req->getResponseHeader(), $req->getResponseBody());
    }
}
