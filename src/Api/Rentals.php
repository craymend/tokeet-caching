<?php

namespace Craymend\TokeetSdk\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Rentals extends ApiBase
{
    /**
     * "Retrieve all rentals in your account"
     * 
     * https://apidocs.tokeet.com/#d3b1bef3-f5bc-9a0b-d2f4-99a92ec2dbbc
     * 
     * @return stdObject
     */
    public function getRentals()
    {
        $url = "rental?account=$this->account";

        $curOptions = $this->options;
        $curOptions['headers'] = [
            'Authorization' => $this->apiKey
        ];

        $client = new Client([
            'base_uri' => $this->baseUrl
        ]);

        try{
            $response = $client->request('GET', $url, $curOptions);

            $body = (string) $response->getBody();
            $jsonBody = json_decode($body);
            $data = $jsonBody->data;

            return (object) [
                'code' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase(),
                'data' => $data,
                'status' => 'success'
            ];
        }catch(GuzzleException $e){
            return (object) [
                'error' => $e->getMessage(),
                'status' => 'fail'
            ];
        }
    }

    /**
     * "Retrieve a rental with the specified rental id (pkey)"
     * 
     * https://apidocs.tokeet.com/#6e9898ea-0924-b70b-8b2a-d0e3e0fca06a
     * 
     * @return stdObject
     */
    public function getRental($rentalPKey)
    {
        $url = "rental/$rentalPKey?account=$this->account";

        $curOptions = $this->options;
        $curOptions['headers'] = [
            'Authorization' => $this->apiKey
        ];

        $client = new Client([
            'base_uri' => $this->baseUrl
        ]);

        try{
            $response = $client->request('GET', $url, $curOptions);

            $body = (string) $response->getBody();
            $jsonBody = json_decode($body);
            $data = $jsonBody->data;
            $data = $data;

            return (object) [
                'code' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase(),
                'data' => $data,
                'status' => 'success'
            ];
        }catch(GuzzleException $e){
            return (object) [
                'error' => $e->getMessage(),
                'status' => 'fail'
            ];
        }
    }

    /**
     * "Retrieve the open and blocked dates for a given rental over the upcoming 2 years."
     * 
     * https://apidocs.tokeet.com/#ab89fdee-df6a-eaa0-d576-6c925fc821db
     * 
     * @return stdObject
     */
    public function getRentalAvailability($rentalPKey)
    {
        $url = "rental/$rentalPKey/availability?account=$this->account";

        $curOptions = $this->options;
        $curOptions['headers'] = [
            'Authorization' => $this->apiKey
        ];

        $client = new Client([
            'base_uri' => $this->baseUrl
        ]);

        try{
            $response = $client->request('GET', $url, $curOptions);

            $body = (string) $response->getBody();
            $data = json_decode($body);

            return (object) [
                'code' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase(),
                'data' => $data,
                'status' => 'success'
            ];
        }catch(GuzzleException $e){
            return (object) [
                'error' => $e->getMessage(),
                'status' => 'fail'
            ];
        }
    }
}