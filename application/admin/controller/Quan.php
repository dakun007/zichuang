<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/12
 * Time: 18:24
 *
 *
 */
namespace app\admin\controller;
use think\Controller;
class Quan extends  Ro{
//    展示
    public function index(){
//        展示
        $fuji['fuji'] = ['eq',1];
        $model = \think\Loader::model('quan')->index($fuji);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);

        return view();
    }

//    添加
    public function  add(){
        if(request()->isPost()){
            $model = \think\Loader::model('quan')->add();
            $this->yzm($model,200,'添加成功');
            exit;
        }
        $str = \think\Db::name('quan')->field('id,name,fuji')->select();
        $this->assign([
            'str' => $str,
        ]);
        return view();
    }

//    修改
    public function save(){
        $sql = 'quan';
        $id = arr_jie(input('id'));

        if(request()->isPost()){
            $model = \think\Loader::model('quan')->save_bak();
            $this->yzm($model,200,'修改成功');
            exit;
        }

        if(!empty($id)){
            $find = \think\Db::name($sql)->find($id);
            if(!empty($find)){
                $str = \think\Db::name('quan')->field('id,name,fuji')->select();
                $this->assign([
                    'find' => $find,
                    'str' => $str,
                ]);
                return view();
            }
        }
    }

//    删除
    public function delete(){
        if(request()->isPost()){
            $mdoel = \think\Loader::model('quan')->delete_bak();
            $this->yzm($mdoel,200,'删除成功');
        }
    }

//    查看子级
    public function ziji(){
        $id = arr_jie(input('id'));
        if(!empty($id)){
            $fuji['guan'] = ['eq',$id];
            $model = \think\Loader::model('quan')->index($fuji);
            $this->assign([
                'list' => $model['list'],
                'page' => $model['page'],
            ]);
            return view();
        }
    }

//    查看次级
    public function ciji(){
        $id = arr_jie(input('id'));
        if(!empty($id)){
            $fuji['guan'] = ['eq',$id];
            $model = \think\Loader::model('quan')->index($fuji);
            $this->assign([
                'list' => $model['list'],
                'page' => $model['page'],
            ]);
            return view();
        }
    }
}
?>