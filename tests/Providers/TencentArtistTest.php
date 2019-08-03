<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

class TencentArtistTest extends TestCase
{
    public $id = 199515;
    public $mid = '0003ZpE43ypssl';

    public function testArtistInfo()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/artist.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $tencent = new Tencent($mock);
        $result = $tencent->artist($this->id)->info(1);

        $this->assertObjectHasAttribute('list', $result->data);
    }

    public function testArtistFans()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/fans.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $tencent = new Tencent($mock);
        $result = $tencent->artist($this->id)->fans();

        $this->assertObjectHasAttribute('num', $result);
    }

    public function testArtistPic()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/pic.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $tencent = new Tencent($mock);
        $result = $tencent->artist($this->id, $this->mid)->pic();

        $this->assertObjectHasAttribute('url', $result);
    }
}
