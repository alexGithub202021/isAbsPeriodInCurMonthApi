<?php

namespace App\Tests;

use App\Controller\Api\ApiAbsenceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use PHPUnit\Framework\TestCase;

class ApiAbsenceControllerTest extends TestCase
{
    public function testIsInclusDansPeriode()
    {
        $postData = json_encode($this->getValidPeriodReference());
        $expected = new JsonResponse(true);

        $controller = new ApiAbsenceController();
        $actual = $controller->isInclusDansPeriode(new Request([], [], [], [], [], [], $postData));

        return self::assertEquals($actual, $expected);
    }

    public function testIsNotInclusDansPeriode()
    {
        $postData = json_encode($this->getInvalidPeriodReference());
        $expected = new JsonResponse(false);

        $controller = new ApiAbsenceController();
        $actual = $controller->isInclusDansPeriode(new Request([], [], [], [], [], [], $postData));

        return self::assertEquals($actual, $expected);
    }

    public function testIsInclusDansPeriodeWithEmptyParams()
    {
        $postData = json_encode(array(
            "beginDate" => "2021-01-01",
            "endDate" => ""
        ));
        $expected = 500;

        $controller = new ApiAbsenceController();
        $actual = $controller->isInclusDansPeriode(new Request([], [], [], [], [], [], $postData));

        return self::assertEquals($expected, $actual->getStatusCode());
    }

    public function testIsInclusDansPeriodeWithInvalidParams()
    {
        $postData = json_encode(array(
            "beginDate" => "2022-01-01",
            "endDate" => "2021-02-07"
        ));
        $expected = '"Invalid parameters!"';

        $controller = new ApiAbsenceController();
        $actual = $controller->isInclusDansPeriode(new Request([], [], [], [], [], [], $postData));

        return self::assertEquals($expected, $actual->getContent());
    }

    private function getValidPeriodReference()
    {
        $curDate = date("Y-m-d", time());
        $tabCurDate = explode("-", $curDate);
        $curMonth = $tabCurDate[1];
        $curYear = $tabCurDate[0];
        $periodCurMonth = array(
            "beginDate" => $curYear . "-" . $curMonth . "-01",
            "endDate" => $curYear . "-" . $curMonth . "-07"
        );

        return $periodCurMonth;
    }

    private function getInvalidPeriodReference()
    {
        $curDate = date("Y-m-d", time());
        $tabCurDate = explode("-", $curDate);
        $curMonth = $tabCurDate[1];
        if ($curMonth >= 1 && $curMonth < 12) {
            $curMonth++;
        } else {
            $$curMonth--;
        }
        $curYear = $tabCurDate[0];
        $periodCurMonth = array(
            "beginDate" => $curYear . "-" . $curMonth . "-01",
            "endDate" => $curYear . "-" . $curMonth . "-07"
        );

        return $periodCurMonth;
    }
}
