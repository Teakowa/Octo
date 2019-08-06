<?php

namespace Teakowa\Octo\Provider\Kugou;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Adapter\Headers;
use Teakowa\Octo\Provider\Interfaces\Album as API;

final class Album implements API
{
    /**
     * @var \Teakowa\Octo\Adapter\Adapter
     */
    private $adapter;
    /**
     * @var array
     */
    private $header;
    /**
     * @var string
     */
    private $url = 'http://m.kugou.com/';
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var
     */
    private $body;

    /**
     * Album constructor.
     *
     * @param  \Teakowa\Octo\Adapter\Adapter  $adapter
     * @param  int|null  $id
     */
    public function __construct(Adapter $adapter, int $id = null)
    {
        $this->adapter = $adapter;
        $this->header  = (new Headers())->getProvider('Kugou');
        $this->id      = $id;
    }

    /**
     * Get album info.
     *
     * @return \stdClass
     * @since 1.2.2
     */
    public function info(): \stdClass
    {
        $result     = $this->adapter->get($this->url.'app/i/getablum.php', [
            'type'    => 1,
            'ablumid' => $this->id,
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * Get album pic.
     *
     * @param  int  $size
     *
     * @return \stdClass
     * @since 1.2.2
     */
    public function pic(int $size = 300): \stdClass
    {
        $result     = $this->adapter->get($this->url.'app/i/getablum.php', [
            'type'    => 1,
            'ablumid' => $this->id,
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) ['url' => $this->body->img400];
    }
}