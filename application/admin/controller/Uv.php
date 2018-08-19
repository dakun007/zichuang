<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/6
 * Time: 19:18
 *
 * 技术员： 吴坤盛
 *
 * 流量UV操作
 *
 */

namespace app\admin\controller;
use think\Controller;
class Uv extends Ro{

    public function yue(){
        $model = \think\LOader::model('flow')->yue();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'sel' => $model['sel'],
        ]);
        return $this->fetch();
    }

//    删除月份
    public function delete_yue(){
        $model = \think\Loader::model('flow')->delete_yue('fl_month');
        if($model==200){
            $this->success('删除成功');
        }else{
            $this->error($model);
        }
    }

//   查看日期
    public function ri(){
        $model = \think\Loader::model('flow')->ri();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'sel' => $model['sel'],
        ]);
        return $this->fetch();
    }


//    查看ip
    public function ip(){
        $model = \think\Loader::model('flow')->ip();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'sel' => $model['sel'],
        ]);
        return $this->fetch();
    }


}

?>