<?php

namespace Teakowa\Octo\Adapter;

/**
 * Interface Header.
 */
interface Header
{
    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @param string $provider
     *
     * @return array
     *
     * @since 1.2.1
     */
    public function getProvider(string $provider): array;
}
