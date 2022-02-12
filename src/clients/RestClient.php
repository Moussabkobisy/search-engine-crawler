<?php

namespace src\clients;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class RestClient
{
    /**
     * @param $keyword
     * @param $engine
     * @param int $start
     * @return mixed
     * @throws Exception|GuzzleException
     */
    public function buildUriAndCall($keyword, $engine, $start = 1)
    {
        $baseUrl = "https://www.googleapis.com/customsearch/v1";
        $key = getenv('key');
        if (!$key || $key === "") throw new Exception("cannot find api key in your env file");
        $cx = getenv('cx');
        if (!$cx || $cx === "") throw new Exception("cannot find CX key in your env file");
        $uri = $baseUrl . "?fields=queries,items(title,link,snippet)&key=" . $key . "&cx=" . $cx . "&q=" . $keyword . $engine . "&start=" . $start;
        return $this->callServer($uri);
    }


    /**
     * @param $endPoint
     * @return mixed
     * @throws GuzzleException
     */
    private function callServer($endPoint)
    {
        try {
            $client = new Client();
            $result = $client->get($endPoint);
            return json_decode($result->getBody()->getContents());
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = json_decode($response->getBody()->getContents());
            throw new Exception($responseBodyAsString->error->message);
        }
    }
}
