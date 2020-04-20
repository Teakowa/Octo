<?php

namespace Teakowa\Octo\Provider\Kugou;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Adapter\Headers;
use Teakowa\Octo\Provider\Interfaces\Song as API;

/**
 * Class Song.
 */
final class Song implements API
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
     * @var
     */
    private $body;
    /**
     * @var string|null
     */
    private $hash;

    /**
     * Song constructor.
     *
     * @param  \Teakowa\Octo\Adapter\Adapter  $adapter
     * @param  string|null  $hash
     */
    public function __construct(Adapter $adapter, string $hash = null)
    {
        $this->adapter = $adapter;
        $this->header = (new Headers())->getProvider('Kugou');
        $this->hash = $hash;
    }

    /**
     * Get new release songs.
     *
     * @return \stdClass
     */
    public function new(): \stdClass
    {
        $new = $this->adapter->get($this->url, ['json' => true], $this->header);
        $this->body = json_decode($new->getBody());

        return (object) $this->body;
    }

    /**
     * Get song info by hash.
     *
     * @return \stdClass
     */
    public function info(): \stdClass
    {
        $info = $this->adapter->get($this->url.'app/i/getSongInfo.php', [
            'cmd' => 'playInfo', 'hash' => $this->hash,
        ], $this->header);
        $this->body = json_decode($info->getBody());

        return (object) $this->body;
    }

    /**
     * Get song special info by hash.
     *
     * @return \stdClass
     */
    public function special(): \stdClass
    {
        $this->url = 'http://servicebj.mobile.kugou.com/v1/yueku/special_album_recommend';
        $special = $this->adapter->get($this->url, ['hash' => $this->hash, 'api_ver' => 2], $this->header);
        $this->body = json_decode($special->getBody());

        return (object) $this->body;
    }
}
