<?php
namespace app\admin\controller;
use think\Controller;
class Goods extends Ro
{

    // 展示
    public function index()
    {
        $model = \think\Loader::model('goods')->index();

        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);
        return $this->fetch();
    }

    // 添加
    public function add()
    {  
        if(request()->isPost()){
            $data =  input('post.');
            $data['go_jibie'] = 1;
            $model = \think\Loader::model('goods')->add($data);
            if($model==200){
                $this->success('添加成功');
            }else{
                $this->error($model);
            }
            exit;
        }
        return $this->fetch();
    }

    // 修改
    public function save(){
        $id = arr_jie(input('id'));
        $sql = 'goods';
        // 提交数据
        if(request()->isPost()){
            $data =  input('post.');
            $model = \think\Loader::model('goods')->save_bak($data);
            if($model==200){
                $this->success('修改成功');
            }else{
                $this->error($model);
            }
            exit;
        }
        // 展示数据
        if(isset($id)){
            $val = \think\Db::name($sql)->find($id);
            if($val){
                // 获取页面数据
                $str = file_get_contents(public_goods($val['go_user']));
                $sl = str_replace("</textarea>","<&textarea>",$str);
                $this->assign([
                    'val' => $val,
                    'sl' => $sl,
                ]);
                return $this->fetch();
                exit;
            }
        }
        $this->error('数据异常');
    }

    // 验证数据
    // public function yzm(){
    //     public_xu();
    // }

    //删除
    public function delete_goods(){
        $sql = \think\Loader::model('goods')->delete_goods();
        if($sql == 200){
            $this->success('删除成功');
        }else{
            $this->error($sql);
        }
    }


    /**********************************子级操作***************************************************/
    //预览
    public function subg(){
        $model = \think\Loader::model('goods')->subg();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
        ]);
        return $this->fetch();
    }
//    子级添加
    public function subg_add(){
        if(request()->isPost()){
            $data = input('post.');
            $data['go_guan'] = arr_jie($data['go_guan']);
            $data['go_jibie'] = 2;
            $model = \think\Loader::model('goods')->add($data);
            if($model==200){
                $this->success('添加成功');
            }else{
                $this->error($model);
            }
            exit;
        }
        return $this->fetch();
    }

//    子级修改
    public function subg_save(){

        $id = arr_jie(input('id'));
        $sql = 'goods';
        // 提交数据
        if(request()->isPost()){
            $data =  input('post.');
            $model = \think\Loader::model('goods')->save_bak($data);
            if($model==200){
                $this->success('修改成功');
            }else{
                $this->error($model);
            }
            exit;
        }
        // 展示数据
        if(isset($id)){
            $val = \think\Db::name($sql)->find($id);
            if($val){
                // 获取页面数据
                $str = file_get_contents(public_goods($val['go_user']));
                $sl = str_replace("</textarea>","<&textarea>",$str);
                $this->assign([
                    'val' => $val,
                    'sl' => $sl,
                ]);
                return $this->fetch();
                exit;
            }
        }
        $this->error('数据异常');
    }

}

?>