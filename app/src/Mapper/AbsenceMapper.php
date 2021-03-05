<?php

namespace App\Mapper;

use App\Entity\Absence;

class AbsenceMapper
{    
    /**
     * getAbsence: retourne une instance de Absence depuis un array
     *
     * @param  array $data, contient deux dates (format "Y-m-d"))
     * @return Absence $newAbsence
     */
    public static function getAbsence($data): Absence
    {
        $newAbsence = new Absence();

        $newAbsence
            ->setBeginDate($data['beginDate'])
            ->setEndDate($data['endDate']);

        return $newAbsence;
    }
}
