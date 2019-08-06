<?php

namespace Teakowa\Octo\Provider\Interfaces;

use Teakowa\Octo\Adapter\Adapter;

interface Song
{
    public function __construct(Adapter $adapter);

    public function info(): \stdClass;
}