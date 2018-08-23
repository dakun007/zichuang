<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/5
 * Time: 22:13
 *
 * 流量表
 *
 * 技术员：　吴坤盛
 *
 */
namespace app\index\model;
use think\Model;
class Flow extends Model
{

//    写入数据表
    public function add()
    {
        // $ip = ip();
        $nian = nian(); //年
        $yue = yue(); // 月
        $ri = ri(); //日
        $ipx = $_SERVER["REMOTE_ADDR"];
        $url = addr_thod();
//        判断今天是否有访问记录
        $jilu = $this->where("fl_ip='$ipx' and fl_day='$ri' and fl_url='$url'")->field('fl_ency,fl_id')->find();
        // $ip_str = $ip['data']['country'].$ip['data']['region'].$ip['data']['city'];
        // if(empty($ip_str)){
        //     echo "<script>alert('当前抢购人数过多，请忍心等待一下！')</script>";
        // }
        $ip_str = '无法获取';
        $data = [
            'fl_ip' => $ipx,
            'fl_adds' => $ip_str,
            'fl_time' => time(),
            'fl_url' => $url,
            'fl_year' => $nian,
            'fl_month' => $yue,
            'fl_day' => $ri,
            'fl_ency' => 1,
        ];
        if($jilu){
            //更新信息
            $strx = [
                'fl_ency' =>  $jilu['fl_ency']+1,
            ];
            $id = $jilu['fl_id'];
            $this->save($strx,['fl_id'=>$id]);
        }else {
            $this->save($data);
        }
    }

}


?>