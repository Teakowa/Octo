<?php

namespace Teakowa\Octo\Adapter;

class Headers implements Header
{

    public function __construct(array $headers)
    {
        $this->headers  = $headers;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}

