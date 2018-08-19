<?php
namespace app\index\controller;
use think\Controller;
class Index extends  Rotem
{
    public function index()
    {
        $str = $_SERVER['HTTP_HOST']; // 获取当前域名
        $find = \think\Db::name('level')->where("name='$str'")->field('b.go_user')->join('__GOODS__ b','a.point_id=b.go_id')->alias('a')->find();
        if(!empty($find)){
            $str = 'goods/'.$find['go_user'];
            return $this->fetch($str);
            // var_dump($find);
            exit;
        }
        return $this->fetch('goods/index');
    }


    public function aa()
    {

        echo ip138();
    }
    
}
