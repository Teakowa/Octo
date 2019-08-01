<?php

use PHPUnit\Framework\TestCase;
use Teakowa\Octo\Adapter\Guzzle as Adapter;
use Teakowa\Octo\Adapter\Headers;

/**
 * Class testKugou
 */
class testKugou extends TestCase
{
    /**
     * @var int
     */
    private $artist = 90573;
    /**
     * @var string
     */
    private $song = 'C1B0C0290E09ECB419CFA1F27F841018';
    /**
     * @var int
     */
    private $album = 9613798;
    /**
     * @var array
     */
    private $headers = [
        'User-Agent' => 'Android442-AndroidPhone-9156-15-0-PlayerRecommendDetail-wifi',
    ];
    /**
     * @var \Teakowa\Octo\Adapter\Guzzle
     */
    private $adapter;
    /**
     * @var \Teakowa\Octo\Provider\Kugou
     */
    private $api;

    /**
     *
     */
    public function setUp(): void
    {
        $this->adapter = new Adapter(new Headers($this->headers));
        $this->api     = new Teakowa\Octo\Provider\Kugou($this->adapter);
    }

    /**
     *
     */
    public function testArtistClass()
    {
        $class = $this->api->artist()->class();
        self::assertIsObject($class);
        self::assertObjectHasAttribute('classid', $class->list[0]);
    }

    /**
     *
     */
    public function testArtistList()
    {
        $list = $this->api->artist()->list(1);
        self::assertIsObject($list);
        self::assertObjectHasAttribute('singerid', $list->singers->list->info[0]);
    }

    /**
     *
     */
    public function testArtistInfo()
    {
        $artist = $this->api->artist()->info($this->artist);
        self::assertIsObject($artist);
        self::assertObjectHasAttribute('info', $artist);
        self::assertObjectHasAttribute('singerid', $artist->info);
    }

    /**
     *
     */
    public function testArtistFans()
    {
        $fans = $this->api->artist()->fans($this->artist, 70634285);
        self::assertIsObject($fans);
        self::assertObjectHasAttribute('follow', $fans->data);
        self::assertObjectHasAttribute('fansnum', $fans->data);
    }

    /**
     *
     */
    public function testNewSong()
    {
        $new = $this->api->song()->new();
        self::assertIsObject($new);
        self::assertObjectHasAttribute('hash', $new->data[0]);
    }

    /**
     *
     */
    public function testSongInfo()
    {
        $info = $this->api->song()->info($this->song);
        self::assertIsObject($info);
        self::assertObjectHasAttribute('hash', $info);
    }

    /**
     *
     */
    public function testSongSpecial()
    {
        $special = $this->api->song()->special($this->song);
        self::assertIsObject($special);
        self::assertObjectHasAttribute('albumid', $special->data->info->album);
    }

    /**
     *
     */
    public function testAlbum()
    {
        $album = $this->api->album($this->album);
        self::assertIsObject($album);
        self::assertObjectHasAttribute('hash', $album->list[0]);
    }

    /**
     *
     */
    public function testSearch()
    {
        $result = $this->api->search('Octo');
        self::assertIsObject($result);
        self::assertObjectHasAttribute('FileHash', $result->data->lists[0]);
    }
}