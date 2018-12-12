<?php

namespace App\Services;



use Exception;
use GuzzleHttp\Client;

class OpenTrivia
{
    CONST URL = 'https://opentdb.com/';
    CONST LIMIT = 10;

    /**
     * @var Client
     */
    private $client;

    /**
     * OpenTrivia constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     *
     */
    public function getCategories(){
        return $this->queryAPI('api_category.php');
    }


    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getQuestions($params = []){
        $params['amount'] = $params['amount'] ?? SELF::LIMIT;
        return $this->queryAPI('api.php', $params);
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function queryAPI($endpoint, $params = []){
        try{
            $request = $this->client->get(SELF::URL.$endpoint, ['query' => $params]);
            return $this->handleResponse($request);
        }catch (Exception $e){
            dd($e);
        }
    }

    /**
     * @param $response
     * @return mixed
     */
    protected function handleResponse($response){
        return $response->getBody()->getContents();
    }
}