<?php

declare(strict_types=1);

namespace TransferWise\Service;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use TransferWise\Model\BaseModel;

abstract class BaseService
{
    /** @var ClientInterface */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    protected function enumerate(string $class, ResponseInterface $response): array
    {
        /** @var BaseModel $instance */
        $instance = new $class();

        return $instance->enumerateFromResponse($response);
    }
}
