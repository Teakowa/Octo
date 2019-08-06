<?php

namespace Teakowa\Octo\Provider\Interfaces;

use Teakowa\Octo\Adapter\Adapter;

interface Album
{
    public function __construct(Adapter $adapter, int $id = null);

    public function info(): \stdClass;

    public function pic(int $size = 300): \stdClass;
}