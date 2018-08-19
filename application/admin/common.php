<?php


//admin 操作

//订单汇总展示 数量
function public_summatr($sql,$goods,$goods_num,$tive,$tive_num)
{
    $str = 0;
    foreach ($sql as $key => $value) {
         if ($value[$goods] == $goods_num and $value[$tive] == $tive_num) {
             $str += 1;
         }
    }
    return $str;
}

//订单汇总展示 金额
function public_jine_summ($sql,$goods,$goods_num,$tive,$tive_num,$jine)
{
    $str = 0;
    foreach ($sql as $key => $value) {
        if ($value[$goods] == $goods_num and $value[$tive] == $tive_num) {
            $str += $value[$jine];
        }
    }
    return $str;
}

//订单汇总展示 有效-无效数量
function public_summect ($sql,$goods,$tive)
{
    $str = 0;
    foreach ($sql as $key => $value) {
        if ($value[$goods] == $tive) {
            $str += 1;
        }
    }
    return $str;
}

//订单汇总展示 有效-无效金额
function public_summect_jine ($sql,$goods,$tive,$jine)
{
    $str = 0;
    foreach ($sql as $key => $value) {
        if ($value[$goods] == $tive) {
            $str += $value[$jine];
        }
    }
    return $str;
}


?>