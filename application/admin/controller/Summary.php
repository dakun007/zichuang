<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/17
 * Time: 22:55
 *操作： 数据汇总
 *
 */

namespace  app\admin\controller;
use think\Controller;
class Summary extends Ro
{
//    订单数据汇总
    public function order()
    {
        $sql = \think\LOader::model('order')->summary();
        $str = 0; //        有效订单数量
        $str_num = 0; //        有效订单金额

        foreach ($sql as $key => $value) {
            //        有效订单 和 金额
            if ($value['or_goods'] == 6 || $value['or_goods'] == 1 || $value['or_goods'] == 2 || $value['or_goods'] == 3) {
                $str += 1;
                $str_num += $value['or_moeny']; //有效订单金额
            }
        }
        $this->assign([
            'sql' => $sql,
            'str' => $str,
            'str_num' => $str_num,
        ]);
        return view();
    }

}




?>

