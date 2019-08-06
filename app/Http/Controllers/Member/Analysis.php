<?php
/**
 * Created by PhpStorm.
 * User: JiangWei
 * Date: 2019/4/14
 * Time: 16:19
 */

namespace App\Http\Controllers\Member;
/*
 * 因此分析法
 * 2019/4/14
 * JiangWei
 *
 *   $last_names = array_column($Array,'column');   根据二维数组里面的某一列进行排序！！！
     array_multisort($last_names,SORT_DESC,$Array);
 */

use App\Model\Borrow;

class Analysis
{
    public function Main()
    {

    }

    private static function calculateOM()
    {
        $influenceMoney = array_map('array_shift', Borrow::where([['status', '0'],['status_special','0']])->select('sale')->get()->toarray());
        $COST = 400;
        $OM = array();
        for ($i = 0; $i < count($influenceMoney); $i++) {
            $influenceMoney[$i] = $influenceMoney[$i] - $COST;
            if ($influenceMoney[$i] == 0) {
                die();
            }
            $OM[$i] = 1 / ($influenceMoney[$i] * self::forOM($influenceMoney));
        }
        return $OM;
    }

    private static function forOM($arr)
    {
        $sum = 0;
        for ($i = 0; $i < count($arr); $i++) {
            $sum = 1 / $arr[$i] + $sum;
        }
        return $sum;
    }

    private static function calculateS1()
    {
        $allW = 0;
        $arr = array_map('array_shift', Borrow::where([['status', '0'],['status_special','0']])->select('order_time')->get()->toarray());
        $Warr = array();
        $S = array();
        for ($j = 0; $j < count($arr); $j++) {
            $Warr[$j] = 0;
            $temp = strtotime($arr[$j]);
            for ($i = 0; $i < count($arr); $i++) {
                if (strtotime($arr[$i]) >= $temp) {
                    $Warr[$j]++;
                }
            }
            $Warr[$j]--;
        }
        if ($Warr[0] == 0) $Warr[0]++;
        for ($i = 0; $i < count($Warr); $i++) {
            $allW = $allW + $Warr[$i];
        }
        for ($i = 0; $i < count($arr); $i++) {
            $S[$i] = $Warr[$i] / $allW;
        }
        return $S;
    }

    private static function calculateS2()
    {
        $allW = 0;
        $arr = array_map('array_shift', Borrow::where([['status', '0'],['status_special','0']])->select('enddate')->get()->toarray());
        $Warr = array();
        $S = array();
        for ($j = 0; $j < count($arr); $j++) {
            $Warr[$j] = 0;
            $temp = $arr[$j];
            for ($i = 0; $i < count($arr); $i++) {
                if ($arr[$i] >= $temp) {
                    $Warr[$j]++;
                }
            }
            $Warr[$j]--;
        }
        if ($Warr[0] == 0) $Warr[0]++;
        for ($i = 0; $i < count($Warr); $i++) {
            $allW = $allW + $Warr[$i];
        }
        for ($i = 0; $i < count($arr); $i++) {
            $S[$i] = $Warr[$i] / $allW;
        }
        return $S;


    }

    private static function calculateSM()
    {
        $S1Arr = self::calculateS1();
        $S2Arr = self::calculateS2();
        $SMArr = array();
        for ($i = 0; $i < count($S1Arr); $i++) {
            $SMArr[$i] = $S1Arr[$i] * 0.4 + $S2Arr[$i] * 0.6;
        }
        return $SMArr;
    }


    public static function calculateTM()
    {
        $OM = self::calculateOM();
        $SM = self::calculateSM();
        $TM = array();
        for ($i = 0; $i < count($OM); $i++) {
            $TM[$i] = $OM[$i] * 0.5 + $SM[$i] * 0.5;
        }
        return $TM;
    }
}
