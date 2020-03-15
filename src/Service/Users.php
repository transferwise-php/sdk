<?php declare(strict_types=1);

namespace TransferWise\Service;

use TransferWise\Model\Token;

class Users extends BaseService
{
    public function me(): Token
    {
        $response = $this->client->request('GET', '/v1/me', []);
        return (new Token())->populateFromResponse($response);
    }

    public function getById()
    {
        
    }
}