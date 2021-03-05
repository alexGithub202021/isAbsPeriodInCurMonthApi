<?php

namespace App\Entity;

class Absence
{
    /**
     * @var string ("Y-m-d" formatted value)
     *
     */
    private $beginDate;

    /**
     * @var string ("Y-m-d" formatted value)
     *
     */    
    private $endDate;

    /**
     * Get the value of beginDate
     */
    public function getBeginDate()
    {
        return $this->beginDate;
    }

    /**
     * Set the value of beginDate
     *
     * @return  self
     */
    public function setBeginDate($beginDate)
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }
}
