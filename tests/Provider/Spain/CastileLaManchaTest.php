<?php

namespace Umulmrum\Holiday\Test\Provider\Spain;

use Umulmrum\Holiday\Provider\Spain\CastileLaMancha;
use Umulmrum\Holiday\Test\Calculator\AbstractHolidayCalculatorTest;

class CastileLaManchaTest extends AbstractHolidayCalculatorTest
{
    protected function getHolidayProviders(): array
    {
        return [CastileLaMancha::class];
    }

    public function getData(): array
    {
        return [
            [
                2020,
                [
                    '2020-01-01',
                    '2020-01-06',
                    '2020-03-19',
                    '2020-04-09',
                    '2020-04-10',
                    '2020-04-13',
                    '2020-05-01',
                    '2020-06-11',
                    '2020-08-15',
                    '2020-10-12',
                    '2020-12-25',
                ],
            ],
        ];
    }
}
