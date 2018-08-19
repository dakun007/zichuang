<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/13
 * Time: 7:35
 *
 *
 */
namespace app\admin\controller;
use think\Controller;
class Quanuser extends Ro {

//    展示
    public function index(){
        $model = \think\Loader::model('quanuser')->index();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);
        return view();
    }

//    添加
    public function add(){
        if(request()->isPost()){
            $model = \think\Loader::model('quanuser')->add();
            $this->yzm($model,200,'添加成功');
            exit;
        }
        $model = \think\Db::name('quan')->select();
        $this->assign([
            'model' => $model,
        ]);
        return view();
    }

//    修改
    public function save(){
        $sql = 'quanuser';
        $id = arr_jie(input('id'));

        if(request()->isPost()){
            $model = \think\Loader::model('quanuser')->save_bak();
            $this->yzm($model,200,'修改成功');
            exit;
        }

        if(!empty($id)){
            $find = \think\Loader::model($sql)->find($id);
            if($find){
                $model = \think\Db::name('quan')->select();
                $yzx = explode(',',$find['quan']);
                $this->assign([
                    'model' => $model,
                    'find' => $find,
                    'yzm' => $yzx,
                ]);
                return view();
            }
        }

    }

//    删除
    public  function  delete(){

        if(request()->isPost()){
            $model = \think\Loader::model('quanuser')->delete_bak();
            $this->yzm($model,200,'删除成功');
        }

    }

}
?>