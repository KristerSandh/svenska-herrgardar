<?php

declare(strict_types=1);

/**
 * This file is part of PHP Nominatim.
 * (c) Maxime Hélias <maximehelias16@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace maxh\Nominatim\Test;

class LookupTest extends \PHPUnit\Framework\TestCase
{
    protected $url = 'http://nominatim.openstreetmap.org/';

    /**
     * Contain url of the current application.
     *
     * @var \maxh\Nominatim\Nominatim
     */
    private $nominatim;

    /**
     * @throws \maxh\Nominatim\Exceptions\NominatimException
     */
    protected function setUp()
    {
        $this->nominatim = new \maxh\Nominatim\Nominatim($this->url);
    }

    /**
     * @throws \maxh\Nominatim\Exceptions\InvalidParameterException
     */
    public function testOsmIds()
    {
        /** @var \maxh\Nominatim\Lookup $lookup */
        $lookup = $this->nominatim->newLookup()
            ->format('xml')
            ->osmIds('R146656,W104393803,N240109189');

        $expected = [
            'format'  => 'xml',
            'osm_ids' => 'R146656,W104393803,N240109189',
        ];

        $query = $lookup->getQuery();
        $this->assertSame($expected, $query);

        $expected = \http_build_query($query);
        $this->assertSame($expected, $lookup->getQueryString());
    }
}
