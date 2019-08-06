<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Kugou;

class KugouAlbumTest extends TestCase
{
    public $id = 9613798;

    public function testAlbumInfo()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/album.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $kugou = new Kugou($mock);
        $result = $kugou->album($this->id)->info();

        $this->assertObjectHasAttribute('list', $result);
        $this->assertObjectHasAttribute('cname', $result);
    }

    public function testAlbumPic()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/album.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $kugou = new Kugou($mock);
        $result = $kugou->album($this->id)->info();

        $this->assertObjectHasAttribute('img400', $result);
    }
}
