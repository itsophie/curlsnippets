
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



include './vendor/autoload.php';
use GuzzleHtttp\Client;
use GuzzleHtttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;


echo "Oh, Hello";

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://localhost:4000/api/',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);

var_dump($client);
