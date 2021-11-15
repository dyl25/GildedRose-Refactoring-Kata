<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testQualityDegradesTwice(): void
    {
        $items = [new Item('foo', -1, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testBrieQualityIncrease(): void
    {
        $items = [new Item('Aged Brie', 1, 2)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(3, $items[0]->quality);
    }

    public function testConjuredItemDegradeFaster(): void
    {
        $items = [new Item('Conjured', 10, 4)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(2, $items[0]->quality);
    }

    public function testConjuredItemQualityCanNotBeNegative(): void
    {
        $items = [new Item('Conjured', 10, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }
}
