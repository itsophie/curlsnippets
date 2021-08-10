
<?php

require 'vendor/autoload.php';
use GuzzleHtttp\Client;
use GuzzleHtttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

Class MetabaseAPIClient
{
  private $client = null;
  const API_URL = "http://localhost:4000/api";

  var $username;
  var $password;

  var $accessToken;

  public function __construct($username,$password)
  {
      $this->username = $username;
      $this->password = $password;
      $this->client = new Client(['base_uri'=>API_URL]);
  }



public function prepare_access_token()
{
  try {
    $url = self::API_URL . "/session";
    $data = ['username' => $this->username, 'password' => $this->password];
    $response = $this->client->post($url,['query' =>$data]);
    $result = json_decode($response->getBody()->getContents());
    $this->accessToken =$result->id;
  }
  catch (RequestException $e){
    $response = $this->StatusCodeHandling($e);
    return $response;
  }
}

public function StatusCodeHandling($e)

{

  if ($e->getResponse()->getStatusCode() == ‘400’)

  {

    $this->prepare_access_token();

  }

  elseif ($e->getResponse()->getStatusCode() == ‘422’)

  {

    $response = json_decode($e->getResponse()->getBody(true)->getContents());

    return $response;

  }

  elseif ($e->getResponse()->getStatusCode() == ‘500’)

  {

    $response = json_decode($e->getResponse()->getBody(true)->getContents());

    return $response;

  }

  elseif ($e->getResponse()->getStatusCode() == ‘401’)

  {

    $response = json_decode($e->getResponse()->getBody(true)->getContents());

    return $response;

  }

  elseif ($e->getResponse()->getStatusCode() == ‘403’)

  {

    $response = json_decode($e->getResponse()->getBody(true)->getContents());

    return $response;

  }

  else

  {

    $response = json_decode($e->getResponse()->getBody(true)->getContents());

    return $response;

  }

}

public function get_dashboards()

{

  try

  {

    $url = self::API_URL . “/dashboard”;

    $option = array(‘exceptions’ => false);

    $header = array('Authorization'=>’Bearer‘ . $this->accessToken);

    $response = $this->client->get($url, array(‘headers’ => $header));

    $result = $response->getBody()->getContents();

    return $result;

  }

  catch (RequestException $e)

  {

    $response = $this->StatusCodeHandling($e);

    return $response;

  }

}
}
