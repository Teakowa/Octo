<?php

namespace Teakowa\Octo\Provider\Tencent;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

/**
 * Class Album.
 */
class Album extends Tencent
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $mid;

    /**
     * Album constructor.
     *
     * @param \Teakowa\Octo\Adapter\Adapter $adapter
     * @param int|null                      $id
     * @param string|null                   $mid
     */
    public function __construct(Adapter $adapter, int $id = null, string $mid = null)
    {
        parent::__construct($adapter);
        $this->id = $id;
        $this->mid = $mid;
    }

    /**
     * @var
     */
    private $body;

    /**
     * @return \stdClass
     */
    public function info(): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_album_info_cp.fcg', [
            'albumid'  => $this->id,
            'albummid' => $this->mid,
            'platform' => 'mac',
            'format'   => 'json',
            'newsong'  => 1,
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * @param int $size
     *
     * @return \stdClass
     */
    public function pic(int $size = 300): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_album_info_cp.fcg', [
            'albumid'  => $this->id,
            'albummid' => $this->mid,
            'platform' => 'mac',
            'format'   => 'json',
            'newsong'  => 1,
        ], $this->header);
        $this->body = json_decode($result->getBody());

        $mid = !empty($this->mid) ? $this->mid : $this->body->data->mid;
        $url = 'https://y.gtimg.cn/music/photo_new/T002R'.$size.'x'.$size.'M000'.$mid.'.jpg?max_age=2592000';

        return (object) ['url' => $url];
    }
}
