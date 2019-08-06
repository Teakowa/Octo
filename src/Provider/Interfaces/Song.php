<?php

namespace Teakowa\Octo\Provider\Interfaces;

use Teakowa\Octo\Adapter\Adapter;

/**
 * Interface Song.
 */
interface Song
{
    /**
     * Song constructor.
     *
     * @param \Teakowa\Octo\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter);

    /**
     * @return \stdClass
     */
    public function info(): \stdClass;
}
