<?php

namespace Teakowa\Octo\Provider\Interfaces;

use Teakowa\Octo\Adapter\Adapter;

/**
 * Interface API.
 */
interface API
{
    /**
     * API constructor.
     *
     * @param \Teakowa\Octo\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter);

    /**
     * @param int|null $id
     *
     * @return mixed
     */
    public function artist(int $id = null);

    /**
     * @return mixed
     */
    public function song();

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function album(int $id);

    /**
     * @param string $keyword
     *
     * @return mixed
     */
    public function search(string $keyword);
}
