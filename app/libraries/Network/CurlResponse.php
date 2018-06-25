<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2018/6/24
 * Time: 下午 03:26
 */
namespace App\libraries\Network;

class CurlResponse
{
    /**
     * responseBody
     * @var string
     */
    private $responseBody;

    /**
     * response
     * @var array
     */
    private $response;

    /**
     * post
     * @var array
     */
    private $post;

    /**
     * httpMethod
     * @var string
     */
    private $httpMethod;

    /**
     * cookieList
     * @var string
     */
    private $cookieList;

    /** @var array $responseInfo */
    private $responseInfo = [];

    /**
     * @property array posts
     */
    /** @var array $posts */
    private $posts = [];

    /**
     * Gets the responseBody.
     *
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * Sets the responseBody.
     *
     * @param string $responseBody the response body
     *
     * @return self
     */
    public function setResponseBody($responseBody)
    {
        $this->responseBody = $responseBody;

        return $this;
    }

    /**
     * Gets the response.
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the response.
     *
     * @param array $response the response
     *
     * @return self
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Gets the post.
     *
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Sets the post.
     *
     * @param array $post the post
     *
     * @return self
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Gets the httpMethod.
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Sets the httpMethod.
     *
     * @param string $httpMethod the http method
     *
     * @return self
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    /**
     * Gets the cookieList.
     *
     * @return string
     */
    public function getCookieList()
    {
        return $this->cookieList;
    }

    /**
     * Sets the cookieList.
     *
     * @param string $cookieList the cookie list
     *
     * @return self
     */
    public function setCookieList($cookieList)
    {
        $this->cookieList = $cookieList;

        return $this;
    }

    /**
     * @param array $responseInfo
     * @return CurlResponse
     */
    public function setResponseInfo(array $responseInfo): CurlResponse
    {
        $this->responseInfo = $responseInfo;

        return $this;
    }

    /**
     * @return array
     */
    public function getResponseInfo(): array
    {
        return $this->responseInfo;
    }

    /**
     * @param array $posts
     * @return CurlResponse
     */
    public function setPosts(array $posts): CurlResponse
    {
        $this->posts = $posts;

        return $this;
    }
}
