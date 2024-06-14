<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Dotenv\Dotenv;

class BitvavoService
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;

    public function __construct()
    {
        // Laad de .env variabelen
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();

        // Haal de API-sleutels uit de .env variabelen
        $this->apiKey = env('BITVAVO_API_KEY');
        $this->apiSecret = env('BITVAVO_API_SECRET');

        // Maak een nieuwe Guzzle client aan
        $this->client = new Client(['base_uri' => 'https://api.bitvavo.com/v2/']);
    }

    public function getMarkets()
    {
        return $this->sendRequest('GET', 'markets');
    }

    public function getTickerPrice()
    {
        return $this->sendRequest('GET', 'ticker/price');
    }
    

    private function sendRequest($method, $uri, $params = [])
    {
        $timestamp = time() * 1000;
        $signature = hash_hmac('sha256', $timestamp . $method . '/v2/' . $uri, $this->apiSecret);

        $headers = [
            'Bitvavo-Access-Key' => $this->apiKey,
            'Bitvavo-Access-Signature' => $signature,
            'Bitvavo-Access-Timestamp' => $timestamp,
            'Bitvavo-Access-Window' => 10000
        ];

        // Log de headers voor debugging
        Log::info('Request headers: ', $headers);

        $response = $this->client->request($method, $uri, [
            'headers' => $headers
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
    
    
}
?>