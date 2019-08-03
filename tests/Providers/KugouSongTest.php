<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Kugou;

class KugouSongTest extends TestCase
{
    public $hash = 'C1B0C0290E09ECB419CFA1F27F841018';

    public function testNewSong()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/newSong.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $song = new Kugou($mock);
        $result = $song->song()->new();

        $this->assertObjectHasAttribute('hash', $result->data[0]);
    }

    public function testSongInfo()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/songInfo.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $song = new Kugou($mock);
        $result = $song->song($this->hash)->info();

        $this->assertObjectHasAttribute('hash', $result);
        $this->assertEquals($this->hash, $result->hash);
    }

    public function testSongSpecial()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/songSpecial.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $song = new Kugou($mock);
        $result = $song->song($this->hash)->special();

        $this->assertObjectHasAttribute('kugou_index', $result->data->info);
        $this->assertObjectHasAttribute('album', $result->data->info);
    }
}
