<?php

/*
 * This file is part of the umulmrum/holiday package.
 *
 * (c) Stefan Kruppa
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Umulmrum\Holiday\Provider\Spain;

use Umulmrum\Holiday\Constant\HolidayName;
use Umulmrum\Holiday\Constant\HolidayType;
use Umulmrum\Holiday\Model\Holiday;
use Umulmrum\Holiday\Model\HolidayList;
use Umulmrum\Holiday\Provider\CommonHolidaysTrait;
use Umulmrum\Holiday\Provider\CompensatoryDaysTrait;
use Umulmrum\Holiday\Provider\Religion\ChristianHolidaysTrait;

class Cantabria extends Spain
{
    use ChristianHolidaysTrait;
    use CommonHolidaysTrait;
    use CompensatoryDaysTrait;

    /**
     * {@inheritdoc}
     */
    public function calculateHolidaysForYear(int $year): HolidayList
    {
        $holidays = parent::calculateHolidaysForYear($year);
        $holidays->add($this->getMaundyThursday($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        $holidays->add($this->getEasterMonday($year));
        $holidays->add($this->getRegionalDay($year));
        $holidays->add($this->getDayOfBienAparecida($year));

        return $holidays;
    }

    private function getRegionalDay(int $year, int $additionalType = HolidayType::OTHER): Holiday
    {
        return Holiday::create(HolidayName::REGIONAL_DAY, "{$year}-07-28", HolidayType::OFFICIAL | HolidayType::DAY_OFF | $additionalType);
    }

    private function getDayOfBienAparecida(int $year): Holiday
    {
        return Holiday::create(HolidayName::DAYOFBIENAPARECIDA, "{$year}-09-15", HolidayType::OFFICIAL | HolidayType::RELIGIOUS);
    }
}
