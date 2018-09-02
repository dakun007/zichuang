<?php
namespace app\admin\controller;
use think\Controller;
class Kuai extends Ro
{
    protected $sql = 'kuai';
    public function index()
    {
        $model = \think\Loader::model($this->sql)->index();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);
        return view();
    }

    public function add()
    {
        if (request()->isPost()) {
            $model = \think\Loader::model($this->sql)->add();
            if($model == 200){
                $this->success('添加成功');
            }else{
                $this->error($model);
            }
            exit;
        }
        return view();
    }

    public function save()
    {
        $id = \arr_jie(input('id'));

        if (request()->isPost()) {
            $model = \think\Loader::model($this->sql)->save_bak();
            if($model == 200){
                $this->success('修改成功');
            }else{
                $this->error($model);
            }
            exit;
        }

        if (!empty($id)) {
            $sql = \think\Db::name($this->sql)->find($id);
            $this->assign([
                'sql' => $sql,
            ]);
            return view();
        }
    }

    public function delete_bak()
    {
        $model = \think\Loader::model($this->sql)->delete_bak();
        if($model == 200){
            $this->success('删除成功');
        }else{
            $this->error($model);
        }
    }
}



?>