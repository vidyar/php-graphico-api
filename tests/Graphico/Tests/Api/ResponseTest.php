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
 * Unit-tests for Graphico_Api_Client class.
 *
 * @author Yuya Takeyama
 */
class Graphico_Tests_Api_ResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider provideSuccessfulResponses
     */
    public function isSuccess_should_be_true_if_the_response_is_success($response)
    {
        $this->assertTrue($response->isSuccess());
    }

    public function provideSuccessfulResponses()
    {
        return array(
            array($this->createResponseWithStatus(200)),
            array($this->createResponseWithStatus(201)),
            array($this->createResponseWithStatus(204)),
        );
    }

    /**
     * @test
     * @dataProvider provideNotSuccessfulResponses
     */
    public function isSuccess_should_be_false_if_the_response_is_not_success($response)
    {
        $this->assertFalse($response->isSuccess());
    }

    public function provideNotSuccessfulResponses()
    {
        return array(
            array($this->createResponseWithStatus(300)),
            array($this->createResponseWithStatus(400)),
            array($this->createResponseWithStatus(500)),
        );
    }

    /**
     * @test
     * @dataProvider provideClientErrorResponses
     */
    public function isClientError_should_be_true_if_the_response_is_client_error($response)
    {
        $this->assertTrue($response->isClientError());
    }

    public function provideClientErrorResponses()
    {
        return array(
            array($this->createResponseWithStatus(400)),
            array($this->createResponseWithStatus(401)),
            array($this->createResponseWithStatus(403)),
            array($this->createResponseWithStatus(404)),
        );
    }

    /**
     * @test
     * @dataProvider provideNotClientErrorResponses
     */
    public function isClientError_should_be_false_if_the_response_is_not_client_error($response)
    {
        $this->assertFalse($response->isClientError());
    }

    public function provideNotClientErrorResponses()
    {
        return array(
            array($this->createResponseWithStatus(200)),
            array($this->createResponseWithStatus(300)),
            array($this->createResponseWithStatus(500)),
        );
    }

    /**
     * @test
     * @dataProvider provideServerErrorResponses
     */
    public function isServerError_should_be_true_if_the_response_is_server_error($response)
    {
        $this->assertTrue($response->isServerError());
    }

    public function provideServerErrorResponses()
    {
        return array(
            array($this->createResponseWithStatus(500)),
            array($this->createResponseWithStatus(502)),
            array($this->createResponseWithStatus(503)),
        );
    }

    /**
     * @test
     * @dataProvider provideNotServerErrorResponses
     */
    public function isServerError_should_be_false_if_the_response_is_not_server_error($response)
    {
        $this->assertFalse($response->isServerError());
    }

    public function provideNotServerErrorResponses()
    {
        return array(
            array($this->createResponseWithStatus(200)),
            array($this->createResponseWithStatus(300)),
            array($this->createResponseWithStatus(400)),
        );
    }

    /**
     * @test
     */
    public function offsetExists_should_be_true_if_the_key_has_value()
    {
        $response = $this->createResponseWithBody('{"foo":"bar"}');

        $this->assertTrue(isset($response['foo']));
    }

    /**
     * @test
     */
    public function offsetExists_should_be_true_if_the_key_is_not_existent()
    {
        $response = $this->createResponseWithBody('{}');

        $this->assertFalse(isset($response['foo']));
    }

    /**
     * @test
     */
    public function offsetGet_should_be_the_value_in_json_response_body()
    {
        $response = $this->createResponseWithBody('{"foo":"bar"}');

        $this->assertEquals('bar', $response['foo']);
    }

    /**
     * @test
     */
    public function offsetGet_should_be_null_when_the_key_is_not_existent()
    {
        $response = $this->createResponseWithBody('{}');

        $this->assertNull($response['foo']);
    }

    private function createResponseWithStatus($status)
    {
        return new Graphico_Api_Response($status, array(), '');
    }

    private function createResponseWithBody($body)
    {
        return new Graphico_Api_Response(200, array(), $body);
    }
}
