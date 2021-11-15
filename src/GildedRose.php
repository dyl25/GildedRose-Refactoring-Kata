<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    public const NORMAL_QUALITY_INCREMENT = 1;

    public const NORMAL_SELL_IN_INCREMENT = 1;

    public const MAX_QUALITY_LVL = 50;

    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Update the quality of an item
     */
    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name !== 'Aged Brie' and $item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name === 'Conjured') {
                        $qty = $item->quality - (self::NORMAL_QUALITY_INCREMENT * 2);

                        if ($qty < 0) {
                            $item->quality = 0;
                        } else {
                            $item->quality = $qty;
                        }
                    } elseif ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - self::NORMAL_QUALITY_INCREMENT;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + self::NORMAL_QUALITY_INCREMENT;
                    if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + self::NORMAL_QUALITY_INCREMENT;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + self::NORMAL_QUALITY_INCREMENT;
                            }
                        }
                    }
                }
            }

            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                $item->sell_in = $item->sell_in - self::NORMAL_SELL_IN_INCREMENT;
            }

            if ($item->sell_in < 0) {
                if ($item->name !== 'Aged Brie') {
                    if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - self::NORMAL_QUALITY_INCREMENT;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + self::NORMAL_QUALITY_INCREMENT;
                    }
                }
            }
        }
    }
}
