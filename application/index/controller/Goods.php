<?php

namespace app\index\controller;
use think\Controller;
class Goods extends Rotem
{

    // 产品地址:空操作
    public function _empty(){

        $str = action_ko(); // 获取当前方法
        $find = \think\Db::name('goods')->where("go_user='$str'")->field('go_user,b.point_id')->join('__PAGE__ b','a.go_id=b.want_id')->alias('a')->find();
        if(!empty($find)){
            $id = $find['point_id'];
            $find = \think\Db::name('goods')->field('go_user')->find($id);
            $str = 'goods/'.$find['go_user'];
            return $this->fetch($str);  //指定位置
        }
        return $this->fetch("goods/$str");  //指定位置
    }

//    提交订单
    public function order(){
        if(request()->isPost()){
            
            $id = input('post.id');
            $name = input('post.name'); //产品名称
            $style = input('post.style');     //款式
            $number = input('post.number');     //数量
            $username = input('post.username');     //用户
            $tel = input('post.tel');     //电话
            $addr = input('post.addr');     //地址
            $nian = nian();     //年
            $yue = yue();     //月
            $ri = ri();     //日
            $ip_yes = $_SERVER["REMOTE_ADDR"];
            $ax = '';
            if($username == ''){
                $ax = '请输入姓名';
            }else if($tel == ''){
                $ax = '请输入手机号码';
            }else if(!preg_match('/^1([0-9]{9})/',$tel)){
                $ax = '请输入正确的手机号码';
            }else if($addr == ''){
                $ax = '请输入地址';
            }else if($id == '' || $name == ''){
                $ax = '数据异常';
            }else if($number == ''){
                $ax = '请输入数量';
            }else if($style == ''){
                $ax = '请输入款式';
            }
            if($ax==''){
                $meo = \think\Db::name('goods')->find($id);
                if($meo){
                    $where = "or_name='$name' and or_style='$style' and or_user='$username' and or_tel='$tel' and or_year='$nian' and or_month='$yue' and or_day='$ri' and or_ip='$ip_yes' and or_addr='$addr'";
                    $sql_order = \think\Db::name('order')->where($where)->find();
                    if($sql_order){
                        $this->success('提交成功，我们会在24小时内拨打您的手机号，请保持手机通信！');
                        exit;
                    }
                    // var_dump($where);
                    // exit;
                    $ip = ip();
                    $ip_str = $ip['data']['country'].$ip['data']['region'].$ip['data']['city'];
                    if(empty($ip_str)){
                        $ip_str = ip138();
                        if(empty($ip_str)){
                            $ip_str = '无法获取';
                        }
                    }
                    $data = [
                        'or_name' => $name, //产品名称
                        'or_style' => $style, //款式
                        'or_moeny' => $meo['go_money'], //金额
                        'or_number' => $number, //数量
                        'or_user' => $username, //用户
                        'or_tel' => $tel, //电话
                        'or_addr' => $addr, //地址
                        'or_goods' => 4, //是否发货
                        'or_tive' => 1, //是否有效
                        'create_time' => time(), //添加时间
                        'or_year' => $nian, //年
                        'or_month' => $yue, //月
                        'or_day' => $ri, //日
                        'or_ip' => $ip_yes, //ip
                        'or_ip_adds' => $ip_str, //ip地址
                        'or_goods_id' => $id, //产品页面id:
                    ];

                    $sql_order = \think\Db::name('order')->where($where)->find();
                    if($sql_order){
                        $this->success('提交成功，我们会在24小时内拨打您的手机号，请保持手机通信！');
                        exit;
                    }else{
                        $sql = \think\Db::name('order')->insert($data);
                        if($sql){
                            $this->success('提交成功，我们会在24小时内拨打您的手机号，请保持手机通信！');
                        }else{
                            $this->error('很遗憾提交失败');
                        }
                    }
                }
            }else{
                $this->error($ax);
            }

        }else{
            $this->error(404);
        }
    }

}

?>