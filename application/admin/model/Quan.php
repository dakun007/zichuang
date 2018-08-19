<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/13
 * Time: 1:35
 *
 *
 */
namespace app\admin\model;
use think\Model;
class Quan extends Model{

    protected $autoWriteTimestamp = true;

//    展示
    public function index($where=[]){

        $list = Quan::where($where)->paginate(10);
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
        ];
    }

//    添加
    public function  add(){
        $jibie = input('fuji');
        $find = $this->where(['name' => input('name')])->find();
        if($jibie == 1){
            if(isset($find)){
                return '该名称已存在';
            }
            $data = [
                'name' => input('name'),
                'fuji' => $jibie,
            ];
        }else if($jibie == 2){
            $data = [
                'name' => input('name'),
                'fuji' => $jibie,
                'guan' => input('jibie2'),
                'kong' => input('kong'),
                'fang' => input('fang'),
            ];
        }else if($jibie == 3){
            $data = [
                'fuji' => $jibie,
                'name' => input('name'),
                'guan' => input('jibie3'),
                'kong' => input('kong'),
                'fang' => input('fang'),
            ];
        }
        $sql = $this->save($data);
        if(isset($sql)){
            return 200;
        }else{
            return '添加失败';
        }

    }

//    修改
    public function save_bak(){
        $jibie = input('fuji');
        $id = input('id');
        $name = input('name');
        $find = $this->where("name='$name' and id!='$id'")->find();
        if($jibie == 1){
            if(isset($find)){
                return '该名称已存在';
            }
            $data = [
                'name' => input('name'),
                'fuji' => $jibie,
            ];
        }else if($jibie == 2){
            $data = [
                'name' => input('name'),
                'fuji' => $jibie,
                'guan' => input('jibie2'),
                'kong' => input('kong'),
                'fang' => input('fang'),
            ];
        }else if($jibie == 3){
            $data = [
                'fuji' => $jibie,
                'name' => input('name'),
                'guan' => input('jibie3'),
                'kong' => input('kong'),
                'fang' => input('fang'),
            ];
        }
        $sql = $this->save($data,['id'=>$id]);

        if(isset($sql)){
            return 200;
        }else{
            return '修改失败';
        }
    }

//    删除
    public function  delete_bak(){
        $id = arr_jie(input('id'));
        if(isset($id)){
            $user = Quan::get($id);
            if($user->delete()){
                return 200;
            }else{
                return '删除失败';
            }
        }
        return '数据异常';
    }

}
?>