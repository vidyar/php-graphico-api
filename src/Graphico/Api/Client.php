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
 * The Client.
 *
 * @author Yuya Takeyama
 */
class Graphico_Api_Client
{
    /**
     * Constructor
     *
     * @param Graphico_Api_HttpClientInterface $httpClient
     * @param string $baseUrl
     */
    public function __construct(Graphico_Api_HttpClientInterface $httpClient, $baseUrl)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl    = $baseUrl;
    }

    /**
     * Calls API
     *
     * @param  string $method Request method
     * @param  string $uri    Request URI. Version path should be omitted.
     * @param  array  $param  Request parameters.
     * @return Graphico_Api_ResponseInterface
     */
    public function call($method, $uri, $params = array())
    {
        $method = strtoupper($method);

        switch ($method) {
        case 'GET':
        case 'POST':
            break;
        case 'PUT':
        case 'DELETE':
            $params = array_merge($params, array('_method' => $method));
            $method = 'POST';
            break;
        default:
            throw new InvalidArgumentException(sprintf('Invalid request method "%s" is specified', $method));
        }

        list($status, $header, $body) = $this->httpClient->request($method, $this->baseUrl . $uri, $params);

        return new Graphico_Api_Response($status, $header, $body);
    }

    public function get($uri, $params = array())
    {
        return $this->call('GET', $uri, $params);
    }

    public function post($uri, $params = array())
    {
        return $this->call('POST', $uri, $params);
    }

    public function put($uri, $params = array())
    {
        return $this->call('PUT', $uri, $params);
    }

    public function delete($uri, $params = array())
    {
        return $this->call('DELETE', $uri, $params);
    }
}
