<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/6
 * Time: 5:16
 *
 * 流量表
 *
 * 技术员： 吴坤盛
 *
 */
namespace app\admin\model;
use think\Model;
class Flow extends Model{

    public function yue(){
        $where = array();
        $user = input('yue');
        if($user){
            $where['fl_month'] = ['like',"%$user%"];
        }
        // 查询状态为1的用户数据 并且每页显示10条数据
        $list = Flow::where($where)->order('fl_id desc')->group('fl_month')->paginate(10,false,['query'=>['yue'=>$user]]);
        $sel = $this->field('fl_month,fl_ency,fl_ip')->select();
        // 获取分页显示
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
            'sel' => $sel,
        ];
    }

//    批量删除数据
    public function delete_yue($data=''){
        $yue = arr_jie(input('post.id'));
        if(isset($yue)){
            $sql = Flow::destroy([$data => $yue]);
            if($sql){
                return 200;
            }else{
                return '删除失败';
            }
        }else{
            return '数据异常';
        }
    }

//    日详情
    public function ri(){
        $where = array();
        $ri = input('ri');
        $yue =  arr_jie(input('id'));
        if($ri){
            $ri = strtotime($ri);
            $where['fl_day'] = ['like',"%$ri%"];
        }
        $where['fl_month'] = ['eq',$yue];
//        var_dump($where);
        // 查询状态为1的用户数据 并且每页显示10条数据
        $list = Flow::where($where)->order('fl_id desc')->group('fl_day')->paginate(10,false,['query'=>['id'=>$_GET['id'],'ri'=>$ri]]);
        $cheng = $list[count($list)-1]['fl_day'];
        $sel = $this->where("fl_month='$yue' and fl_day>='$cheng'")->field('fl_ency,fl_day,fl_month,fl_ip')->select();
        // 获取分页显示
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
            'sel' => $sel,
        ];

    }

//  ip详情
    public function ip(){
        $where = array();
        $ri = input('ip');
        $yue =  arr_jie(input('id'));
        if($ri){
            $where['fl_ip'] = ['like',"%$ri%"];
        }
        $where['fl_day'] = ['eq',$yue];
//        var_dump($where);
        // 查询状态为1的用户数据 并且每页显示10条数据
        $list = Flow::where($where)->order('fl_id desc')->group('fl_ip')->paginate(10,false,['query'=>['id'=>$_GET['id'],'ip'=>$ri]]);
        
        $sel = $this->where("fl_day='$yue'")->field('fl_ency,fl_day,fl_ip')->select();
        // 获取分页显示
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
            'sel' => $sel,
        ];
    }

//    删除针对的日期的ip
    public function detele_ip_ri(){
        $yue = arr_jie(input('post.id'));
        $url = arr_jie(input('post.url'));
        if(isset($yue)){
            $sql = Flow::destroy(['fl_day'=>$url,'fl_ip'=>$yue]);
            if($sql){
                return 200;
            }else{
                return '删除失败';
            }
        }else{
            return '数据异常';
        }
    }

//     展示针对ip显示当天操作信息
    public function index(){
        $where = array();
        $id = input('id');
        $ip = input('ip');
        $where['fl_day'] = ['eq',arr_jie($id)];
        $where['fl_ip'] = ['eq',arr_jie($ip)];
//        var_dump($where);
        // 查询状态为1的用户数据 并且每页显示10条数据
        $list = Flow::where($where)->order('fl_id desc')->paginate(10,false,['query'=>['id'=>$id,'ip'=>$ip]]);
        $sel = $this->where("fl_day='$id' and fl_ip='$ip'")->field('fl_ency,fl_day,fl_ip')->select();
        // 获取分页显示
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
            'sel' => $sel,
        ];
    }

//    删除id
    public function detele_index(){
        $yue = arr_jie(input('post.id'));
        if(isset($yue)){
            $sql = Flow::get($yue);
            if($sql->delete()){
                return 200;
            }else{
                return '删除失败';
            }
        }else{
            return '数据异常';
        }
    }


/******************************UV操作**************************/
//uv月份
//    public function uv_yue(){
//        $where = array();
//        $id = input('user');
//        if($id){
//            $stx = arr_jie($id);
//            $where['fl_month'] = ['like',"%$stx%"];
//        }
//        $list = Flow::where($where)->order('fl_id desc')->paginate(10,false,['query'=>['user'=>$id]]);
//        $page = $list->render();
//
//        return [
//            'list' => $list,
//            'page' => $page,
//        ];
//    }

}
?>