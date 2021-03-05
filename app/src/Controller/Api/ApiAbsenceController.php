<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Mapper\AbsenceMapper;
use App\Helper\DateHelper;

class ApiAbsenceController extends AbstractController
{
    /**
     * isInclusDansPeriode: vérifie si une période est inclus dans le mois courant (ici on ne prendra en compte que les jours ouvrés)
     *
     * @param  Request $request
     * @return JsonResponse
     * 
     * @Route("/api/absence/isInclusDansPeriode",  methods="POST")
     */
    public function isInclusDansPeriode(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isValidData($data)) {
            $newAbsence = AbsenceMapper::getAbsence($data);
            $rangeAbsPeriod = DateHelper::getRangeFromPeriod($newAbsence->getBeginDate(), $newAbsence->getEndDate());

            if (count($rangeAbsPeriod) > 0) {
                $periodCurMonth = $this->getPeriodCurMonth();
                $rangePeriodCurMonth = DateHelper::getRangeFromPeriod($periodCurMonth[0], $periodCurMonth[1]);

                $intersec = count(array_intersect($rangeAbsPeriod, $rangePeriodCurMonth));

                return new JsonResponse($intersec > 0);
            } else {
                return new JsonResponse(false);
            }
        } else {
            return new JsonResponse('Invalid parameters!', 500);
        }
    }

    /**
     * isValidData: vérifie que les paramètres sont renseignés et que "beginDate" < "endDate"
     *
     * @param  array $data, liste contenant "beginDate" et "endDate"
     * @return bool, true si vrai, sinon false
     */
    private function isValidData($data)
    {
        if (
            empty($data['beginDate'])
            || empty($data['endDate'])
            || $data['beginDate'] >= $data['endDate']
        ) {
            return false;
        }
        return true;
    }


    /**
     * getPeriodCurMonth: retourne la liste des jours du mois courant
     *
     * @return array $periodCurMonth, liste des jours du mois courant
     */
    private function getPeriodCurMonth()
    {
        $curDate = date("Y-m-d", time());
        $tabCurDate = explode("-", $curDate);
        $curMonth = $tabCurDate[1];
        $curYear = $tabCurDate[0];
        $numberDaysCurMonth = cal_days_in_month(CAL_GREGORIAN, $curMonth, $curYear);
        $periodCurMonth = array($curYear . "-" . $curMonth . "-01", $curYear . "-" . $curMonth . "-" . $numberDaysCurMonth);

        return $periodCurMonth;
    }
}
