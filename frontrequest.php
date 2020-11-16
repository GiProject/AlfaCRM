<?php

require __DIR__ . '/../vendor/autoload.php';

$alfacrmConfig = [
    'login' => 'rasulov@bosskids.ru',
    'password' => '5CacPXx7',
];

$jar = new \GuzzleHttp\Cookie\CookieJar;
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://bosskids.s20.online/',
    'cookies' => $jar
]);

$request = $client->request('POST', 'login', [
    'form_params' => [
        '_csrf' => get_csrf_token(),
        'LoginForm' => [
            'username' => $alfacrmConfig['login'],
            'password' => $alfacrmConfig['password'],
            'rememberMe' => 0
        ],
        'login-button' => ''
    ]
]);

$request = $client->request('GET', 'https://bosskids.s20.online/company/4/calendar/fetch', [
    'query' => [
        'start' => '2020-09-28',
        'end' => '2020-11-02',
        '_' => 1603806329774
    ]
]);

echo $request->getBody()->getContents();


//Запрашиваем страницу, чтобы получить _csrf
function get_csrf_token(){

    global $client;

    $token = false;
    $request = $client->request('GET');

    $dom = new DOMDocument;
    $dom->loadHTML($request->getBody()->getContents());
    $meta = $dom->getElementsByTagName('meta');

    for( $i = 0; $meta->count() > $i; $i++){

        if( $meta->item($i)->getAttribute('name') == 'csrf-token' ){

            $token = $meta->item($i)->getAttribute('content');
            break;
        }
    }

    return $token;

}




return;

print_r($request->getBody()->getContents());