<?php

declare(strict_types=1);

namespace TransferWise\Api;

class UsersApi extends AbstractApi
{
    public function getMe(): array
    {
        return [
            'method' => 'GET',
            'path'   => 'me',
            'params' => [],
        ];
    }
}
