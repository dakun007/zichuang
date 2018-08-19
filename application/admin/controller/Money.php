<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/8
 * Time: 9:19
 *
 *
 */
namespace  app\admin\controller;
use think\Controller;
class Money extends Ro{

//    展示年
    public function money_nian(){
//        $ri = yue(); //获取今天时间戳
//        $nian = nian(); //获取今天时间戳
//        $yzm['or_month'] = ['eq',$ri];
//        $yzm['or_year'] = ['eq',$nian];
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',2];
        $model = \think\Loader::model('order')->nian($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny']
        ]);
        return $this->fetch();
    }

//    展示月
    public function money_yue(){


        $model = \think\Loader::model('order')->yue();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny']
        ]);
        return $this->fetch();
    }

//    展示日
    public function  money_ri(){

        $yzm['or_month'] = ['eq',arr_jie(input('id'))];
        $yzm['or_year'] = ['eq',arr_jie(input('nian'))];
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',2];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny']
        ]);
        return $this->fetch();
    }

}
?>