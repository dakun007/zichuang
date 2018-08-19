<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Ro
{
    // 继承
    public function index()
    {
        $id = session('admin_id');
        $sql = \think\Db::name('admin')->field('ad_id,ad_quanuser_id')->find($id);
        $sql_id = $sql['ad_quanuser_id'];
        $quan = \think\Db::name('quanuser')->field('id,quan')->find($sql_id);
        $quan_id = $quan['quan'];
        if($quan['quan']==0){
            $quanx1 = \think\Db::name('quan')->where("fuji=1")->select();
            $quanx2 = \think\Db::name('quan')->where("fuji=2")->select();
            $yzm = 200;
        }else{
            $quanx1 = \think\Db::name('quan')->where("fuji=1 and id in ($quan_id)")->select();
            $quanx2 = \think\Db::name('quan')->where("fuji=2 and id in ($quan_id)")->select();
            $yzm = 500;
        }
        $this->assign([
            'quanx1' => $quanx1,
            'quanx2' => $quanx2,
            'yzm' => $yzm,
        ]);
        return $this->fetch();
    }

    // 首页
    public function header()
    {
        $ri = ri(); //获取今天时间戳
//        账号
        $user = \think\Db::name('admin')->count();
//        最新订单24小时
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_day'] = ['eq',$ri];
        $model = \think\Db::name('order')->where($yzm)->count();
        $order = \think\Db::name('order')->count();
//        最近登陆
        $lately = \think\Db::name('lately')->order('la_id desc')->limit(5)->field('a.*,b.ad_user')->alias('a')->join('__ADMIN__ b','a.la_admin_id = b.ad_id')->select();

        //流量展示七天
        $pv = \think\Db::name('flow')->order('fl_id desc')->limit(0,7)->group('fl_day')->select();
        $fl = \think\Db::name('flow')->order('fl_id desc')->select();
        $this->assign([
            'user' => $user,
            'model' => $model,
            'order' => $order,
            'lately' => $lately,
            'pv' => $pv,
            'fl' => $fl,
        ]);
        return $this->fetch();
    }

    //
    // public function text()
    // {
    //     $str = 'index';
    //     $this->assign('str',$str);
    //     return $this->fetch();
    // }
    
    // // 空操作
    // public function _empty()
    // {
    //     $str = action_ko(); // 获取当前方法
    //     return $this->fetch("index/$str");  //指定位置
    // }

//
    public function  kefu(){

        return view();
    }

//    退出
    public function tui(){
        session(null);
        $this->success('退出成功',url('logo/logo'));
    }
}
