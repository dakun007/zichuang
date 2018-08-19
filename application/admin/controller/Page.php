<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/10
 * Time: 15:06
 *
 *
 */
namespace app\admin\controller;
use think\Controller;
class Page extends Controller{

//    展示
    public function index(){
        $model = \think\Loader::model('page')->index();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);
        return $this->fetch();
    }


//    添加
    public function add(){
        if(request()->isPost()){
            $model = \think\Loader::model('page')->add();
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
        $sql = 'page';
        $id = arr_jie(input('id'));

        if(request()->isPost()){
            $model = \think\Loader::model('page')->save_bak();
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

        $this->error('数据异常');
    }


//    删除
    public function delete_page(){

        if(request()->isPost()){
            $model = \think\Loader::model('page')->delete_page();
            if($model==200){
                $this->success('删除成功');
            }else{
                $this->error($model);
            }
            exit;
        }

        $this->error('数据异常');

    }

}
?>