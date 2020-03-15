<?php declare(strict_types=1);

namespace TransferWise;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use TransferWise\Exception\Exception;
use TransferWise\Service\ExchangeRates;
use TransferWise\Service\Quotes;
use TransferWise\Service\Transfers;
use TransferWise\Service\Users;

class SDK
{
    const API_MODE_LIVE = 'live';
    const API_MODE_SANDBOX = 'sandbox';
    private const API_ENDPOINT_LIVE = 'https://api.transferwise.com';
    private const API_ENDPOINT_SANDBOX = 'https://api.sandbox.transferwise.tech';

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function users(): Users
    {
        return new Users($this->client);
    }

    public function quotes(): Quotes
    {
        return new Quotes($this->client);
    }

    public function exchangeRates(): ExchangeRates
    {
        return new ExchangeRates($this->client);
    }

    public function transfers(): Transfers
    {
        return new Transfers($this->client);
    }

    /**
     * Create guzzle client, default to use sandbox endpoint
     *
     * @param string $token
     * @param string $mode
     * @return Client
     */
    public static function createClient(string $token, string $mode = self::API_MODE_SANDBOX): Client
    {
        $acceptedModes = [self::API_MODE_SANDBOX, self::API_MODE_LIVE];

        if (!in_array($mode, $acceptedModes)) {
            throw new Exception(
                sprintf(
                    'API mode must be one of "%s" but got "%s"',
                    join(', ', $acceptedModes),
                    $mode
                )
            );
        }

        $endpoints = [
            self::API_MODE_SANDBOX  => self::API_ENDPOINT_SANDBOX,
            self::API_ENDPOINT_LIVE => self::API_ENDPOINT_LIVE,
        ];

        $userAgent = sprintf(
            'transferwise-php-sdk/1.0 (%s, %s) (+https://github.com/transferwise-php/sdk)',
            PHP_VERSION,
            PHP_OS
        );

        return new Client(
            [
                'base_uri' => $endpoints[$mode],
                'headers'  => [
                    'User-Agent'    => $userAgent,
                    'Authorization' => 'Bearer '.$token,
                ],
            ]
        );
    }
}