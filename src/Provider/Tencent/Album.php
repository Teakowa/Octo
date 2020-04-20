<?php

namespace Teakowa\Octo\Provider\Tencent;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Adapter\Headers;
use Teakowa\Octo\Provider\Interfaces\Album as API;

/**
 * Class Album.
 */
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
    private $url = 'https://i.y.qq.com/';
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $mid;
    /**
     * @var
     */
    private $body;

    /**
     * Album constructor.
     *
     * @param  \Teakowa\Octo\Adapter\Adapter  $adapter
     * @param  int|null  $id
     * @param  string|null  $mid
     */
    public function __construct(Adapter $adapter, int $id = null, string $mid = null)
    {
        $this->adapter = $adapter;
        $this->header = (new Headers())->getProvider('Tencent');
        $this->id = $id;
        $this->mid = $mid;
    }

    /**
     * Get album info.
     *
     * @return \stdClass
     */
    public function info(): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_album_info_cp.fcg', [
            'albumid' => $this->id,
            'albummid' => $this->mid,
            'platform' => 'mac',
            'format' => 'json',
            'newsong' => 1,
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
     */
    public function pic(int $size = 300): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_album_info_cp.fcg', [
            'albumid' => $this->id,
            'albummid' => $this->mid,
            'platform' => 'mac',
            'format' => 'json',
            'newsong' => 1,
        ], $this->header);
        $this->body = json_decode($result->getBody());

        $mid = ! empty($this->mid) ? $this->mid : $this->body->data->mid;
        $url = 'https://y.gtimg.cn/music/photo_new/T002R'.$size.'x'.$size.'M000'.$mid.'.jpg?max_age=2592000';

        return (object) ['url' => $url];
    }
}
