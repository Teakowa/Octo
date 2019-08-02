<?php

use Teakowa\Octo\Adapter\Adapter;
use Teakowa\Octo\Provider\Kugou\Artist;

/**
 * Class testKugou.
 */
class KugouArtistTest extends TestCase
{
    public $id = 90573;

    public function testArtistClass()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/artistClass.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $artist = new Artist($mock);
        $result = $artist->class();

        $this->assertEquals(88, $result->list[0]->classid);
    }

    public function testArtistList()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/artistList.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $list   = new Artist($mock);
        $result = $list->list(1);

        $this->assertEquals(1, $result->classid);
    }

    public function testArtistInfo()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/artistInfo.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $list   = new Artist($mock);
        $result = $list->info($this->id);

        $this->assertEquals($this->id, $result->info->singerid);
    }

    public function testArtistFans()
    {
        $response = $this->getPsr7JsonResponseForFixture('Providers/Kugou/artistFans.json');

        $mock = $this->createMock(Adapter::class);
        $mock->method('get')->willReturn($response);

        $mock->expects($this->once())->method('get');

        $list   = new Artist($mock);
        $result = $list->fans($this->id, 70634285);

        $this->assertObjectHasAttribute('fansnum', $result->data);
    }
}
