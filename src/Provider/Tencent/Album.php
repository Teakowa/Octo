<?php

namespace Teakowa\Octo\Provider\Tencent;

use Teakowa\Octo\Provider\Tencent;

/**
 * Class Album
 *
 * @package Teakowa\Octo\Provider\Tencent
 */
class Album extends Tencent
{
    /**
     * @var
     */
    private $body;

    /**
     * @param  int|null  $id
     * @param  string|null  $mid
     *
     * @return \stdClass
     */
    public function info(int $id = null, string $mid = null): \stdClass
    {
        $result     = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_album_info_cp.fcg', [
            'albumid'  => $id,
            'albummid' => $mid,
            'platform' => 'mac',
            'format'   => 'json',
            'newsong'  => 1,
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * @param  string|null  $mid
     * @param  int  $size
     *
     * @return \stdClass
     */
    public function pic(string $mid = null, int $size = 300):\stdClass
    {
        $url = 'https://y.gtimg.cn/music/photo_new/T002R'.$size.'x'.$size.'M000'.$mid.'.jpg?max_age=2592000';

        return (object) ['url' => $url];
    }
}