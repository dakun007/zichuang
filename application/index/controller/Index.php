<?php
namespace app\index\controller;
use think\Controller;
class Index extends  Rotem
{
    public function index()
    {
        $yuming = $_SERVER['HTTP_HOST']; //域名
        //判断域名
        if ($yuming == 'www.mishi186.com' and $yuming == 'mishi186.com') {
            echo "<div style='color:red;text-align: center;font-size:18px;'>404</div>";
            exit;
        } 
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
