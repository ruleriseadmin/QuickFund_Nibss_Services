<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NibssService
{
    protected $client;
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->baseUrl = config('nibss.base_url');
        $this->clientId = config('nibss.client_id');
        $this->clientSecret = config('nibss.client_secret');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => 30,
        ]);
    }

    /**
     * Example: BVN Validation
     */
    public function verifyBVN(string $bvn)
    {
        try {
            $response = $this->client->post('/bvn/verify', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'bvn' => $bvn
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $e) {
            Log::error("NIBSS BVN Error: " . $e->getMessage());
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function initiateDirectDebit(array $data)
    {
        try {
            $response = $this->client->post('/direct-debit/initiate', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                    'Accept' => 'application/json',
                ],
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $e) {
            Log::error("NIBSS Direct Debit Error: " . $e->getMessage());
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function transferFunds(array $data)
    {
        try {
            $response = $this->client->post('/transfer', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                    'Accept' => 'application/json',
                ],
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $e) {
            Log::error("NIBSS Transfer Error: " . $e->getMessage());
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
