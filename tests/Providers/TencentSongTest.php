<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Tencent;

class TencentSongTest extends TestCase
{
    public $id = 234706815;
    public $mid = '003aLIjx2X4Dw7';

    public function testArtistInfo()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/song.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $tencent = new Tencent($mock);
        $result = $tencent->song()->info($this->id);

        $this->assertEquals($this->mid, $result->data[0]->mid);
        $this->assertEquals($this->id, $result->data[0]->id);
    }

    public function testSongUrl()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Tencent/url.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $tencent = new Tencent($mock);
        $result = $tencent->song()->url($this->id, $this->mid);

        $this->assertObjectHasAttribute('url', $result);
    }
}
