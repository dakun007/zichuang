<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/8
 * Time: 11:09
 *
 *
 */
namespace  app\admin\controller;
use think\Controller;
class Ro extends Controller{
    public function __construct(){
        parent::__construct();
        //域名
        dizhi();
        //
        if(session('admin_id')=='' || session('admin_user')==''){
            header('Location:/admin/Logo/logo.html');
            exit;
        }

//        权限
        $kon = request()->controller();
        $zhi = request()->action();
        $val = request()->controller().'/'.request()->action();
        $id = session('admin_id');
        $sql = \think\Db::name('admin')->field('ad_id,ad_quanuser_id')->find($id);
        $sql_id = $sql['ad_quanuser_id'];
        $quan = \think\Db::name('quanuser')->field('id,quan')->find($sql_id);
        $quan_id = $quan['quan'];
        if($quan['quan']!=0){
            // 需要开放的端口
            $array = [
                'Index/index','Index/header','Index/tui','Index/kefu'
            ];
            if(!in_array($val,$array)){
                $quanx1 = \think\Db::name('quan')->where("kong='$kon' and fang='$zhi'")->where("id in ($quan_id)")->select();
                if($quanx1==false){
                    $this->error('权限不足');
                    exit;
                }
            }

        }

    }

//    共享继承操作
    public function yzm($model,$yzm=200,$user){
        if($model==$yzm){
            $this->success($user);
        }else{
            $this->error($model);
        }
    }
}
?>