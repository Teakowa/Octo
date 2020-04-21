<?php

namespace Teakowa\Octo\Provider;

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Adapter\Headers;
use Teakowa\Octo\Provider\Interfaces\API;
use Teakowa\Octo\Provider\Tencent\Album;
use Teakowa\Octo\Provider\Tencent\Artist;
use Teakowa\Octo\Provider\Tencent\Song;
use Teakowa\Octo\Traits\BodyAccessorTrait;

/**
 * Class Tencent.
 */
final class Tencent implements API
{
    use BodyAccessorTrait;
    /**
     * @var \Teakowa\Octo\Adapter\Adapter
     */
    protected $adapter;
    /**
     * @var string
     */
    protected $url = 'https://i.y.qq.com/';
    /**
     * @var array
     */
    protected $header;

    /**
     * Tencent constructor.
     *
     * @param  \Teakowa\Octo\Adapter\Adapter  $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->header = (new Headers())->getProvider('Tencent');
    }

    /**
     * @param  int|null  $id
     * @param  string|null  $mid
     *
     * @return \Teakowa\Octo\Provider\Tencent\Artist
     */
    public function artist(int $id = null, string $mid = null): Artist
    {
        return new Artist($this->adapter, $id, $mid);
    }

    /**
     * @param  int|null  $id
     * @param  string|null  $mid
     *
     * @return \Teakowa\Octo\Provider\Tencent\Song
     */
    public function song(int $id = null, string $mid = null): Song
    {
        return new Song($this->adapter, $id, $mid);
    }

    /**
     * @param  int|null  $id
     * @param  string|null  $mid
     *
     * @return \Teakowa\Octo\Provider\Tencent\Album
     */
    public function album(int $id = null, string $mid = null): Album
    {
        return new Album($this->adapter, $id, $mid);
    }

    /**
     * @param  string  $keyword
     * @param  int|null  $page
     * @param  int|null  $limit
     *
     * @return \stdClass
     */
    public function search(string $keyword, int $page = 1, int $limit = 30): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/client_search_cp.fcg', [
            'p' => $page,
            'n' => $limit,
            'w' => $keyword,
            'format' => 'json',
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }

    /**
     * @param  int  $id
     *
     * @return \stdClass
     */
    public function playlist(int $id): \stdClass
    {
        $result = $this->adapter->get($this->url.'v8/fcg-bin/fcg_v8_playlist_cp.fcg', [
            'id' => $id,
            'format' => 'json',
            'newsong' => 1,
            'platform' => 'jqspaframe.json',
        ], $this->header);
        $this->body = json_decode($result->getBody());

        return (object) $this->body;
    }
}
