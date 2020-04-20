<?php

namespace Teakowa\Octo\Adapter;

use GuzzleHttp\Client;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Guzzle
 *
 * @package Teakowa\Octo\Adapter
 */
final class Guzzle implements Adapter
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * {@inheritdoc}
     */
    public function __construct(Header $headers, string $baseURI = null)
    {
        $this->client = new Client([
            'base_uri' => $baseURI,
            'headers'  => $headers->getHeaders(),
            'Accept'   => 'application/json',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('get', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('post', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function put(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('put', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function patch(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('patch', $uri, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $uri, array $data = [], array $headers = []): ResponseInterface
    {
        return $this->request('delete', $uri, $data, $headers);
    }

    /**
     * @param  string  $method
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     *
     * @return mixed
     * @throws \Teakowa\Octo\Adapter\JSONException
     * @throws \Teakowa\Octo\Adapter\ResponseException
     */
    public function request(string $method, string $uri, array $data = [], array $headers = []): Client
    {
        if (! in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
            throw new InvalidArgumentException('Request method must be get, post, put, patch, or delete');
        }

        $response = $this->client->$method($uri, [
            'headers'                              => $headers,
            ($method === 'get' ? 'query' : 'json') => $data,
        ]);

        $this->checkError($response);

        return $response;
    }

    /**
     * @param  \Psr\Http\Message\ResponseInterface  $response
     *
     * @throws \Teakowa\Octo\Adapter\JSONException
     * @throws \Teakowa\Octo\Adapter\ResponseException
     */
    private function checkError(ResponseInterface $response): void
    {
        $json = json_decode($response->getBody());

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new JSONException();
        }

        if (isset($json->errors) && count($json->errors) >= 1) {
            throw new ResponseException($json->errors[0]->message, $json->errors[0]->code);
        }

        if (isset($json->success) && ! $json->success) {
            throw new ResponseException('Request was unsuccessful.');
        }
    }
}
