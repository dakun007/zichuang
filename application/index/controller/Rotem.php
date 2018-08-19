<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/5
 * Time: 22:10
 *
 * 共享页面
 *
 * 技术员： 吴坤盛
 */

namespace app\index\controller;
use think\Controller;
class Rotem extends Controller
{
    public function __construct(){
        parent::__construct();
        
        $url = addr_thod();
        if($url != '/index/goods/order.html' || request()->action() != 'order'){
	        //    流量计算
	        $flow = \think\Loader::model('Flow')->add();
        }

        $this->assign([
            'shouji' => public_name(),
        ]);

    }



}

?>