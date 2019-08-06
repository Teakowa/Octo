<?php

namespace Teakowa\Octo\Provider\Interfaces;

use Teakowa\Octo\Adapter\Adapter;

interface API
{
    public function __construct(Adapter $adapter);

    public function artist(int $id = null);

    public function song();

    public function album(int $id);

    public function search(string $keyword);
}
