<?php

namespace Teakowa\Octo\Provider\Interfaces;

use Teakowa\Octo\Adapter\Adapter;

/**
 * Interface Artist.
 */
interface Artist
{
    /**
     * Artist constructor.
     *
     * @param \Teakowa\Octo\Adapter\Adapter $adapter
     * @param int|null                      $id
     */
    public function __construct(Adapter $adapter, int $id = null);

    /**
     * @return \stdClass
     */
    public function info(): \stdClass;

    /**
     * @param int $size
     *
     * @return \stdClass
     */
    public function pic(int $size = 300): \stdClass;
}
