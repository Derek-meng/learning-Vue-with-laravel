<?php
/**
 * Created by PhpStorm.
 * User: Derek
 * Date: 2018/6/22
 * Time: 下午 02:59
 */
namespace App\Http\Proxy;

use App\libraries\Network\Curl;

class TokenProxy
{
    /**
     * @property Curl http
     */
    /** @var Curl $http */
    private $http;

    public function __construct()
    {
        $this->http = new Curl();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\libraries\Network\CurlExeFailException
     */
    public function login()
    {
        if (auth()->attempt(['email' => request('email'), 'password' => request('password'), 'is_active' => 1])) {
            $data = [
                'username' => request('email') ?? '',
                'password' => request('password') ?? '',
                'scope'    => '',
            ];

            return $this->proxy('password', $data);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Credentials not match'
        ], 421);
    }

    /**
     * response Token 隱藏ScreeKey
     * @param string $grantType
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\libraries\Network\CurlExeFailException
     */
    public function proxy(string $grantType, array $data = [])
    {
        $post = array_merge($data, [
            'client_id'     => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_Secret'),
            'grant_type'    => $grantType,
        ]);
        $url = \App::make('url')->to('/') . '/oauth/token';
        $response = $this->http->doPostRequest($url, $post, true)->getHtml();
        $this->http->close();
        $token = json_decode($response, true);

        return response()->json([
            'token'      => $token['access_token'],
            'expires_in' => $token['expires_in']
        ])->cookie('refreshToken', $token['refresh_token'], 86400, null, null, false, true);
    }
}
