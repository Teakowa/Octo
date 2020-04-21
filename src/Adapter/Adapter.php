<?php

namespace Teakowa\Octo\Adapter;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface Adapter.
 */
interface Adapter
{
    /**
     * Adapter constructor.
     *
     * @param  Header  $header
     * @param  string  $baseURI
     */
    public function __construct(Header $header, string $baseURI);

    /**
     * Sends a GET request.
     * Per Robustness Principle - not including the ability to send a body with a GET request (though possible in the
     * RFCs, it is never useful).
     *
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     *
     * @return mixed
     */
    public function get(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     *
     * @return mixed
     */
    public function post(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     *
     * @return mixed
     */
    public function put(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     *
     * @return mixed
     */
    public function patch(string $uri, array $data = [], array $headers = []): ResponseInterface;

    /**
     * @param  string  $uri
     * @param  array  $data
     * @param  array  $headers
     *
     * @return mixed
     */
    public function delete(string $uri, array $data = [], array $headers = []): ResponseInterface;
}
