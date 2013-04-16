<?php
/**
 * This file is part of phpgraphico-api.
 *
 * (c) Yuya Takeyama
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Unit-tests for Graphico_Api_Client class.
 *
 * @author Yuya Takeyama
 */
class Graphico_Tests_Api_ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function call_should_call_HttpClient_correctly()
    {
        $httpClient = $this->getMock('Graphico_Api_HttpClientInterface');
        $httpClient->expects($this->once())
            ->method('request')
            ->with('GET', 'http://graphico.example.com/api/v0/foo', array('bar' => 'baz'))
            ->will($this->returnValue($this->getMock('Graphico_Api_ResponseInterface')));

        $client = new Graphico_Api_Client($httpClient, 'http://graphico.example.com/api/v0');

        $client->call('GET', '/foo', array('bar' => 'baz'));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function call_should_throw_InvalidArgumentException_when_invalid_request_method_is_specified()
    {
        $client = $this->createClient();

        $client->call('INVALID METHOD', '/path');
    }

    private function createClient()
    {
        return new Graphico_Api_Client(
            $this->getMock('Graphico_Api_HttpClientInterface'),
            'http://graphico.example.com/api/v0'
        );
    }
}
