<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/6
 * Time: 4:50
 *
 * 流量操作： PV
 *
 * 技术员： 吴坤盛
 *
 */
namespace app\admin\controller;
use think\Controller;
class Pv extends Ro{

//    展示月份
    public function yue(){
        $model = \think\Loader::model('flow')->yue();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'sel' => $model['sel'],
        ]);
        return $this->fetch();
    }

//    展示日
    public function ri(){
        $model = \think\Loader::model('flow')->ri();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'sel' => $model['sel'],
        ]);
        return $this->fetch();
    }

//    展示ip点击数量
    public function ip(){
        $model = \think\Loader::model('flow')->ip();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'sel' => $model['sel'],
        ]);
        return $this->fetch();
    }

//    展示针对ip显示当天操作信息
    public function pv_index(){
        $model = \think\Loader::model('flow')->index();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'sel' => $model['sel'],
        ]);
        return $this->fetch();
    }

//    删除月份
    public function detele_yue(){
        if(request()->isPost()){
            $model = \think\Loader::model('flow')->delete_yue('fl_month');
            if($model==200){
                $this->success('删除成功');
            }else{
                $this->error($model);
            }
        }else{
            $this->error('数据异常');
        }
    }

//  删除日、
    public function detele_ri(){
        if(request()->isPost()){
            $model = \think\Loader::model('flow')->delete_yue('fl_day');
            if($model==200){
                $this->success('删除成功');
            }else{
                $this->error($model);
            }
        }else{
            $this->error('数据异常');
        }
    }

//    删除针对日期的ip
    public function  detele_ip_ri(){
        if(request()->isPost()){
            $model = \think\Loader::model('flow')->detele_ip_ri();
            if($model==200){
                $this->success('删除成功');
            }else{
                $this->error($model);
            }
        }else{
            $this->error('数据异常');
        }
    }

//    删除id
    public function detele_index(){
        if(request()->isPost()){
            $model = \think\Loader::model('flow')->detele_index();
            if($model==200){
                $this->success('删除成功');
            }else{
                $this->error($model);
            }
        }else{
            $this->error('数据异常');
        }
    }
}

?>