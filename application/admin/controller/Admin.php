<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/7
 * Time: 9:54
 *
 * 技术员： 吴坤盛
 *
 * 用户表
 *
 */
namespace app\admin\controller;
use think\Controller;
class Admin extends Ro{

//    展示
    public function index(){
        $model = \think\Loader::model('admin')->index();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);
        return $this->fetch();
    }

//    添加
    public function add(){
        if(request()->isPost()){
            $model = \think\Loader::model('admin')->add();
            if($model==200){
                $this->success('添加成功');
            }else{
                $this->error($model);
            }
            exit;
        }
        $sql = \think\Db::name('quanuser')->select();
        $goods = \think\Db::name('goods')->field('go_id,go_user,go_bak')->where("go_jibie=1")->select();
        
        $this->assign([
            'sql' => $sql,
            'goods' => $goods,
        ]);
        return $this->fetch();
    }

//    修改
    public function save_bak(){
        $sql = 'admin';
        $id = arr_jie(input('id'));
//        提交数据
        if(request()->isPost()){
            $model = \think\Loader::model('admin')->save_bak();
            if($model==200){
                $this->success('修改成功');
            }else{
                $this->error($model);
            }
            exit;
        }

        if(isset($id)){
            $find = \think\Db::name($sql)->find($id);
            if(isset($find)){
                $sql = \think\Db::name('quanuser')->select();
                $goods = \think\Db::name('goods')->field('go_id,go_user,go_bak')->where("go_jibie=1")->select();
                $this->assign([
                    'find' => $find,
                    'sql' => $sql,
                    'goods' => $goods,
                    'goId' => explode(',',$find['ad_goods_id']),
                ]);

                return $this->fetch();
            }
        }
    }

//    删除
    public function delete_admin(){
        if(request()->isPost()){
            $model = \think\Loader::model('admin')->delete_admin();
            if($model==200){
                $this->success('删除成功');
            }else{
                $this->error($model);
            }
            exit;
        }
    }




}
?>