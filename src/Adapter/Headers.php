<?php

namespace Teakowa\Octo\Adapter;

/**
 * Class Headers
 *
 * @package Teakowa\Octo\Adapter
 */
class Headers implements Header
{
    /**
     * @var array
     */
    private $headers;

    /**
     * Headers constructor.
     *
     * @param  array  $headers
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
