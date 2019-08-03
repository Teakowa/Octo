<?php

namespace Teakowa\Octo\Provider\Kugou;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Kugou;

/**
 * Class Song.
 */
class Song extends Kugou
{
    /**
     * @var
     */
    private $body;
    /**
     * @var string
     */
    private $hash;

    /**
     * Song constructor.
     *
     * @param \Teakowa\Octo\Adapter\Adapter $adapter
     * @param string|null                   $hash
     */
    public function __construct(Adapter $adapter, string $hash = null)
    {
        parent::__construct($adapter);
        $this->hash = $hash;
    }

    /**
     * @return \stdClass
     */
    public function new(): \stdClass
    {
        $new = $this->adapter->get($this->url, ['json' => true], $this->header);
        $this->body = json_decode($new->getBody());

        return (object) $this->body;
    }

    /**
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
