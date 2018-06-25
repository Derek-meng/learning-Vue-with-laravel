<?php
namespace Tests\Feature;

use App\Http\Proxy\TokenProxy;
use App\libraries\Network\Curl;
use Tests\TestCase;

class CurlTest extends TestCase
{
    /**
     * @return array
     * @throws \App\libraries\Network\CurlExeFailException
     */
    public function testCurl()
    {
        $url = \App::make('url')->to('/') . ':8000/oauth/token';
        $post = [
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_Secret'),
            'grant_type'    => 'password',
            'scope'         => '',
            'username'      => 'a0985265734@gmail.com',
            'password'      => '123456',
        ];
        $curl = new Curl();
        $reponse = $curl->doPostRequest($url, $post, true)->getHtml();
        $responseArr = json_decode($reponse, true);
        dd($responseArr['access_token']);

        return $responseArr;
    }

    public function testProxy()
    {
        /** @var TokenProxy $tokenProxy */
        $tokenProxy = \App::make(TokenProxy::class);
        $testData = [
            'scope'    => '',
            'username' => 'a0985265734@gmail.com',
            'password' => '123456',
        ];
        dd($tokenProxy->proxy('password', $testData));
    }
}
