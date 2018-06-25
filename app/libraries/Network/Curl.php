<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2018/6/24
 * Time: 下午 03:24
 */
namespace App\libraries\Network;

class Curl
{
    const POST_METHOD = 'post';
    /**
     * Default user agent
     * @var string
     */
    const DEFAULT_USERAGENT = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.89 Safari/537.36';

    /**
     * @property resource curl
     */
    private $curl;

    /**
     * @property CurlResponse response
     */
    /** @var CurlResponse $response */
    private $response;

    public function __construct()
    {
        $this->curl = curl_init();
        $this->response = new CurlResponse();
        $this->setDefaultOptions();
    }

    private function setDefaultOptions()
    {
        $this->setFollowLocation(true)
            ->setAutoReferer(true)
            ->setCookieSession(false)
            ->setReturnTransfer(true)
            ->setTimeout(30)
            ->setUserAgent(self::DEFAULT_USERAGENT)
            ->setConnectTimeout(60);
    }

    /**
     * @param bool $followLocation
     * @return Curl
     */
    private function setFollowLocation(bool $followLocation): Curl
    {
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, $followLocation);

        return $this;
    }

    /**
     * @param bool $autoReferer
     * @return Curl
     */
    private function setAutoReferer(bool $autoReferer): Curl
    {
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, $autoReferer);

        return $this;
    }

    /**
     * @param bool $cookieSession
     * @return $this
     */
    private function setCookieSession(bool $cookieSession): Curl
    {
        curl_setopt($this->curl, CURLOPT_COOKIESESSION, $cookieSession);

        return $this;
    }

    /**
     * @param bool $returnTransfer
     * @return Curl
     */
    private function setReturnTransfer(bool $returnTransfer): Curl
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, $returnTransfer);

        return $this;
    }

    /**
     * @param int $timeout
     * @return Curl
     */
    private function setTimeout(int $timeout): Curl
    {
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $timeout);

        return $this;
    }

    /**
     * @param string $userAgent
     * @return Curl
     */
    private function setUserAgent(string $userAgent): Curl
    {
        curl_setopt($this->curl, CURLOPT_USERAGENT, $userAgent);

        return $this;
    }

    /**
     * @param int $secTime
     * @return Curl
     */
    private function setConnectTimeout(int $secTime): Curl
    {
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $secTime);

        return $this;
    }

    /**
     * @param string $url
     * @param array $posts
     * @param bool $httpBuildQuery
     * @param bool $handleReset
     * @return Curl
     * @throws CurlExeFailException
     */
    public function doPostRequest(string $url, array $posts = [], bool $httpBuildQuery = false, bool $handleReset = true): Curl
    {
        $this->setPostOptionNotIsQuery($url, $posts, $httpBuildQuery);
        curl_exec($this->curl);
        // save response detail.
        $this->saveResponseDetail(self::POST_METHOD, $posts);
        if ($handleReset) {
            $this->resetHandle();
        }
        // check error.
        $this->checkSucceed();

        return $this;
    }

    /**
     * @param string $url
     * @param array $posts
     * @param bool $httpBuildQuery
     * @return $this
     */
    private function setPostOptionNotIsQuery(string $url, array $posts, bool $httpBuildQuery)
    {
        $postFields = $httpBuildQuery ? (http_build_query($posts)) : $posts;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postFields);

        return $this;
    }

    /**
     * Get response info.
     * @param bool $loadDetail if true well load detail again from handle.
     * @return CurlResponse
     */
    public function getResponse(bool $loadDetail = false): CurlResponse
    {
        if ($loadDetail) {
            $this->saveResponseDetail();
        }

        return $this->response;
    }

    /**
     * @param string $method
     * @param array $posts
     */
    private function saveResponseDetail(string $method = self::GET_METHOD, array $posts = [])
    {
        $this->response->setResponseBody(curl_multi_getcontent($this->curl))
            ->setHttpMethod($method)
            ->setResponseInfo(curl_getinfo($this->curl))
            ->setPosts($posts)
            ->setCookieList(curl_getinfo($this->curl, CURLINFO_COOKIELIST));
    }

    /**
     * Reset curl handle to default without close.
     */
    private function resetHandle()
    {
        curl_reset($this->curl);
        $this->setDefaultOptions();
    }

    /**
     *
     */
    public function checkSucceed()
    {
        if ($this->getErrorNumber() != CURLE_OK) {
            throw new CurlExeFailException($this->getErrorMessage() . "(" . $this->getErrorNumber() . ")");
        }
    }

    /**
     * Return the last error number
     * @return int
     */
    private function getErrorNumber()
    {
        return curl_errno($this->curl);
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->getResponse()->getResponseBody();
    }

    /**
     * Close the curl handle.
     */
    public function close()
    {
        curl_close($this->curl);
    }
}
