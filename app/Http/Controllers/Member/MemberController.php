<?php
/**
 * Created by PhpStorm.
 * User: JiangWei
 * Date: 2019/4/12
 * Time: 13:30
 */

namespace App\Http\Controllers\Member;

use App\Model\Borrow;
use Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     *
     * Excel导出
     */
    public function export()
    {
        if (isset($_POST['light'])  && isset($_POST['heavy'])) {
            $light_x = $_POST['light'];
            $heavy_x = $_POST['heavy'];
            $MAX_WEIGHT = $light_x * 3000 + $heavy_x * 8000;
            $allCompany = [];
            ini_set('memory_limit', '500M');
            set_time_limit(0);//设置超时限制为0分钟
            $borrow = DB::select('select  borrow.id,borrow.receiver,borrow.site,borrow.tel,borrow.goods,borrow.specifications,borrow.number,borrow.sale,borrow.order_time,borrow.enddate,borrow.rangs_id,borrow.specifications,borrow.weight,company.name from company join nexus on nexus.company_id = company.id  right join borrow on borrow.rangs_id = nexus.ranges_id where borrow.status = 0 and borrow.status_special=0 order by borrow.id');
            $specialArr = DB::select('select  borrow.id,borrow.receiver,borrow.site,borrow.tel,borrow.goods,borrow.specifications,borrow.number,borrow.sale,borrow.order_time,borrow.enddate,borrow.rangs_id,borrow.specifications,borrow.weight,company.name from company join nexus on nexus.company_id = company.id  right join borrow on borrow.rangs_id = nexus.ranges_id where borrow.status = 0 and borrow.status_special = 1 order by borrow.id');
            if (!$borrow && !$specialArr || !$MAX_WEIGHT) {
                self::emptyExcel();
            }
            $borrow = json_decode(json_encode($borrow), true);
            $specialArr = json_decode(json_encode($specialArr), true);
            $TM = Analysis::calculateTM();
            $mixArray = [];
            $excelArr = [];
            $carArr = [];
            $SUM = 0;
            $i = 0;
            /*
             * 数组融合
             */
            foreach ($borrow as $row) {
                $row['rank'] = $TM[$i];
                $i++;
                if (!in_array($row['name'], $allCompany)) {
                    array_push($allCompany, $row['name']);
                }
                array_push($mixArray, $row);
            }
            /*
             * 根据rank字段排序
             */
            $last_names = array_column($mixArray, 'rank');
            array_multisort($last_names, SORT_DESC, $mixArray);
            /*
             *上次没发完的货这次优先发货
             */
            foreach ($specialArr as $row) {
                array_unshift($mixArray, $row);
            }
            /*
             *货车能发多少货
             */
            foreach ($mixArray as $row) {
                $goodsWeight = $row['number'] * $row['weight'];
                $SUM = $SUM + $goodsWeight;
                if ($SUM < $MAX_WEIGHT) {
                    array_push($carArr, $row);
                    $idBorrow = Borrow::find($row['id']);
                    $idBorrow->status = 1;
                    $idBorrow->save();
                } else {
                    $temp = $row['number'];
                    while ($SUM > $MAX_WEIGHT) {
                        $SUM = $SUM - $row['weight'];
                        $temp--;
                    }
                    if ($temp) {
                        $row['number'] = $row['number'] - $temp;
                        array_push($carArr, $row);
                        $idBorrow = Borrow::find($row['id']);
                        $idBorrow->status_special = 1;
                        $idBorrow->number = $temp;
                        $idBorrow->save();
                    }
                    break;
                }
            }
            /*
       * PHP的多维数组创建
       * 存储对应公司的对应订单
       */
            foreach ($carArr as $row) {
                if (in_array($row['name'], $allCompany)) {
                    for ($j = 0; $j < count($allCompany); $j++) {
                        if ($allCompany[$j] == $row['name']) {
                            if (!isset($excelArr[$allCompany[$j]])) {
                                $excelArr[$allCompany[$j]] = [];
                                array_push($excelArr[$allCompany[$j]], $row);
                            } else {
                                array_push($excelArr[$allCompany[$j]], $row);
                            }
                        }
                    }
                }
            }
            /*
            * 除去多余字段
            */
            foreach ($allCompany as $key) {

                for ($j = 0; $j < count($excelArr[$key]); $j++) {
                    if (isset($excelArr[$key][$j]) && $excelArr[$key][$j]) {
                        unset($excelArr[$key][$j]['rank']);
                        unset($excelArr[$key][$j]['weight']);
                        unset($excelArr[$key][$j]['name']);
                        unset($excelArr[$key][$j]['rangs_id']);
                    }
                }

            }
            /*
             * 去除数据库中的字段名
             */
            foreach ($allCompany as $key) {
                if (isset($excelArr[$key]) && $excelArr[$key]) {
                    for ($i = 0; $i < count($excelArr[$key]); $i++) {
                        $excelArr[$key][$i] = array_values($excelArr[$key][$i]);
                        $excelArr[$key][$i][0] = str_replace('=', ' ' . '=', $excelArr[$key][$i][0]);
                    }
                    array_unshift($excelArr[$key], array('订单编号', '收货人', '地址', '电话号码', '药品', '规格', '数量', '销售额/元', '下单日期', '交货期/天'));//标题行
                }
            }

            Excel::create('订单信息' . date('Y-m-d', time()), function ($excel) use ($excelArr, $allCompany) {
                foreach ($allCompany as $key) {
                    if (isset($excelArr[$key]) && $excelArr[$key]) {
                        $temp = $excelArr[$key];
                        $excel->sheet($key, function ($sheet) use ($temp) {
                            $sheet->rows($temp);
                        });
                    } else {
                        $empty = [];
                        $excel->sheet('无订单', function ($sheet) use ($empty) {
                            $sheet->rows($empty);
                        });
                        break;
                    }
                }
            })->export('xls');


        }

    }


    /**
     *
     * Excel导入
     */
    public function import()
    {
        $filePath = 'storage/exports/' . iconv('UTF-8', 'GBK', '用户信息') . '.xls';
        Excel::load($filePath, function ($reader) {
            $data = $reader->all();
            dd($data);
        });
    }

    private static function emptyExcel()
    {
        $empty = [];
        Excel::create('订单信息' . date('Y-m-d', time()), function ($excel) use ($empty) {
            $excel->sheet('无订单', function ($sheet) use ($empty) {
                $sheet->rows($empty);
            });
        })->export('xls');
        die();
    }

}