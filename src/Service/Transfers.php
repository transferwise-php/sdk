<?php declare(strict_types=1);

namespace TransferWise\Service;

use TransferWise\Model\Transfer;

class Transfers extends BaseService
{
    public function create()
    {

    }

    public function getById()
    {

    }

    public function getPayinMethods()
    {

    }

    public function getTemporaryQuote()
    {

    }

    /**
     * @param array $params
     *
     * @return array|Transfer[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $params = []): array
    {
        $options = !empty($params) ? ['query' => $params] : [];

        $response = $this->client->request('GET', '/v1/transfers', $options);

        return $this->enumerate(Transfer::class, $response);
    }
}