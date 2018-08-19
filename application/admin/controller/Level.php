<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/10
 * Time: 16:32
 *
 *
 */
namespace app\admin\controller;
use think\Controller;
class Level extends Controller{

//    展示
    public function  index(){
        $model = \think\Loader::model('level')->index();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);
        return $this->fetch();
    }

//    添加
    public function add(){
        if(request()->isPost()){
            $model = \think\Loader::model('level')->add();
            if($model==200){
                $this->success('添加成功');
            }else{
                $this->error($model);
            }
            exit;
        }
        $list = \think\Db::name('goods')->field('go_id,go_user,go_bak')->select();
        $this->assign([
            'list' => $list,
        ]);
        return $this->fetch();
    }

//    修改
    public function save(){
        $sql = 'level';
        $id = arr_jie(input('id'));

        if(request()->isPost()){
            $model = \think\Loader::model('level')->save_bak();
            if($model==200){
                $this->success('修改成功');
            }else{
                $this->error($model);
            }
            exit;
        }

        if(!empty($id)){
            $find = \think\Db::name($sql)->find($id);
            if($find){
                $list = \think\Db::name('goods')->field('go_id,go_user,go_bak')->select();
                $this->assign([
                    'list' => $list,
                    'find' => $find,
                ]);
                return $this->fetch();
            }
        }
    }

//    删除
    public function delete_level(){
        if(request()->isPost()){
            $model = \think\Loader::model('level')->delete_level();
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