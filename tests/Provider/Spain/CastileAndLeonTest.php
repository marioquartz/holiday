<?php

namespace Umulmrum\Holiday\Test\Provider\Spain;

use Umulmrum\Holiday\Provider\Spain\CastileAndLeon;
use Umulmrum\Holiday\Test\Calculator\AbstractHolidayCalculatorTest;

class CastileAndLeonTest extends AbstractHolidayCalculatorTest
{
    protected function getHolidayProviders(): array
    {
        return [CastileAndLeon::class];
    }

    public function getData(): array
    {
        return [
            [
                2020,
                [
                    '2020-01-01',
                    '2020-01-06',
                    '2020-04-09',
                    '2020-04-10',
                    '2020-04-23',
                    '2020-05-01',
                    '2020-08-15',
                    '2020-10-12',
                    '2020-11-01',
                    '2020-11-02',
                    '2020-12-06',
                    '2020-12-07',
                    '2020-12-25',
                ],
            ],
        ];
    }
}
