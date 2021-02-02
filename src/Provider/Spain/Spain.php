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
use Umulmrum\Holiday\Provider\HolidayProviderInterface;
use Umulmrum\Holiday\Provider\Religion\ChristianHolidaysTrait;

class Spain implements HolidayProviderInterface
{
    use ChristianHolidaysTrait;
    use CommonHolidaysTrait;
    use CompensatoryDaysTrait;

    /**
     * {@inheritdoc}
     */
    public function calculateHolidaysForYear(int $year): HolidayList
    {
        $holidays = new HolidayList();
        $holidays->add($this->getNewYear($year, HolidayType::DAY_OFF));
        $holidays->add($this->getEpiphany($year, HolidayType::OFFICIAL | HolidayType::RELIGIOUS | HolidayType::DAY_OFF));
        $holidays->add($this->getGoodFriday($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        if (($year >= 1889 && $year <= 1939) || $year >= 1978) {
            $holidays->add($this->getLaborDay($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        }
        $holidays->add($this->getAssumptionDay($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        $holidays->add($this->getAllSaintsDay($year, HolidayType::DAY_OFF));
        if ($year >= 1892) {
            $holidays->add($this->getSpanishNationalDay($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        }
        if ($year >= 1983) {
            $holidays->add($this->getConstitutionDay($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        }
        $holidays->add($this->getChristmasDay($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));

        return $holidays;
    }

    private function getSpanishNationalDay(int $year, int $additionalType = HolidayType::OTHER): Holiday
    {
        return Holiday::create(HolidayName::SPANISH_NATIONAL_DAY, "{$year}-10-12", HolidayType::OFFICIAL | $additionalType);
    }

    private function getConstitutionDay(int $year, int $additionalType = HolidayType::OTHER): Holiday
    {
        return Holiday::create(HolidayName::CONSTITUTION_DAY, "{$year}-12-06", HolidayType::OFFICIAL | $additionalType);
    }

    /**
        Compensatory Day is optional. Only is added in some regions
    **/
    public function addCompensatoryConstitutionDay(HolidayList $holidays, int $year):void
    {
        if ($year >= 1983) {
            foreach ($holidays as $key => $value) {
                if (HolidayName::CONSTITUTION_DAY === $value->getName() && date($year.'-12-06') === $value->getSimpleDate()) {
                    $holiday=$value;
                }
            }
            $this->addLaterCompensatoryDay($holidays, $holiday, HolidayType::OTHER);
        }
    }

    public function addCompensatoryAllSaints(HolidayList $holidays, int $year):void
    {
        foreach ($holidays as $key => $value) {
            if (HolidayName::ALL_SAINTS_DAY === $value->getName() && date($year.'-11-01') === $value->getSimpleDate()) {
                $holiday=$value;
            }
        }
        $this->addLaterCompensatoryDay($holidays, $holiday, HolidayType::OTHER);
    }
}
