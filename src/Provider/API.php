<?php

namespace Teakowa\Octo\Provider;

use Teakowa\Octo\Adapter\Adapter;

interface API
{
    public function __construct(Adapter $adapter);
}