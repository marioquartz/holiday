<?php

namespace Umulmrum\Holiday\Provider\Spain;

use Umulmrum\Holiday\Constant\HolidayType;
use Umulmrum\Holiday\Model\HolidayList;
use Umulmrum\Holiday\Provider\Religion\ChristianHolidaysTrait;

class CastileLaMancha extends Spain
{
    use ChristianHolidaysTrait;

    /**
     * {@inheritdoc}
     */
    public function calculateHolidaysForYear(int $year): HolidayList
    {
        $holidays = parent::calculateHolidaysForYear($year);
        $holidays->add($this->getSaintJosephsDay($year, HolidayType::OFFICIAL));
        $holidays->add($this->getMaundyThursday($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        $holidays->add($this->getEasterMonday($year, HolidayType::OFFICIAL));
        $holidays->add($this->getCorpusChristi($year, HolidayType::OFFICIAL));
        // This holiday is substituted by Easter Monday
        $holidays->removeByIndex($this->getIndexFromDate($holidays, "{$year}-11-01"));
        // This holiday is substituted by Corpus Cristi
        $holidays->removeByIndex($this->getIndexFromDate($holidays, "{$year}-12-06"));

        return $holidays;
    }
}
