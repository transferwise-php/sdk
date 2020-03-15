<?php

namespace TransferWise\Model;

use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\json_decode;
use TransferWise\Exception\UnexpectedResponseException;

abstract class BaseModel
{
    protected $mapping = [];

    /**
     * @param array $array
     * @return $this
     */
    public function populateFromArray(array $array)
    {
        foreach ($array as $key => $val) {
            // If key exists in mapping
            if (isset($this->mapping[$key])) {
                /**@var BaseModel $subClass */
                $subClass = new $this->mapping[$key]();
                $this->{$key} = $subClass->populateFromArray($val);
                continue;
            }

            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }

        return $this;
    }

    public function populateFromResponse(ResponseInterface $response)
    {
        if (0 !== strpos($response->getHeaderLine('Content-Type'), 'application/json')) {
            return $this;
        }

        $json = json_decode((string)$response->getBody(), true);
        if (!empty($json)) {
            $this->populateFromArray($json);
        }

        return $this;
    }

    public function enumerateFromResponse(ResponseInterface $response): array
    {
        if (0 !== strpos($response->getHeaderLine('Content-Type'), 'application/json')) {
            return $this;
        }

        $json = json_decode((string)$response->getBody(), true);

        if (!is_array($json)) {
            throw new UnexpectedResponseException('Expect response as an array');
        }

        return array_map(
            function (array $item) {
                $class = get_class($this);
                $instance = new $class();

                return $instance->populateFromArray($item);
            },
            $json
        );
    }
}