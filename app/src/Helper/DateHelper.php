<?php

namespace App\Helper;

class DateHelper
{    
    /**
     * getRangeFromPeriod: retourne la liste des jours entre deux dates (au format "Y-m-d")
     *
     * @param  string $beginDate
     * @param  string $endDate
     * @return array $range, la liste des jours entre deux dates (au format "Y-m-d")
     */
    public static function getRangeFromPeriod(string $beginDate, string $endDate)
    {
        $beginDateTimeStamp = strtotime($beginDate);
        $endDateTimeStamp = strtotime($endDate);

        $range = array();
        while ($beginDateTimeStamp < $endDateTimeStamp) {
            // on exclus les weekend
            if (!in_array(date("N", $beginDateTimeStamp), array(6, 7))) {
                $newDate = date("Y-m-d", $beginDateTimeStamp);
                $range[] = $newDate;
            }
            $beginDateTimeStamp += 86400;
        }

        return $range;
    }
}
