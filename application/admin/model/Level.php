<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/10
 * Time: 16:43
 *
 *
 */
namespace app\admin\model;
use think\Model;
class Level extends Model{
    protected $autoWriteTimestamp = true;
//    添加
    public function add(){
        $data = input('post.');
        if(empty($data['name'])){
            return '请输入域名';
        }else if(empty($data['point_id'])){
            return '请选择指向地址';
        }
        $where['name'] = ['eq',$data['name']];
        $find = $this->where($where)->find();
        if($find==false){
            $list = $this->save($data);
            if($list){
                return 200;
            }else{
                return '添加失败';
            }
        }else {
            return '该域名已存在';
        }
    }

//    展示
    public function index(){
        $where = [];
        $user = input('user');
        if($user){
            $where['name'] = ['like',"%$user%"];
        }
        $list = Level::where($where)->order('id desc')->join('__GOODS__ b','a.point_id=b.go_id')->field('a.*,b.go_user')->alias('a')->paginate(10,false,['query'=>['user'=>$user]]);
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
        ];
    }

//    修改
    public function  save_bak(){
        $data = input('post.');
        if(empty($data['name'])){
            return '请输入域名';
        }else if(empty($data['point_id'])){
            return '请选择指向地址';
        }
        $id = $data['id'];
        $where['name'] = ['eq',$data['name']];
        $find = $this->where($where)->where("id!='$id'")->find();
        if($find==false){
            $list = $this->isUpdate(true)->save($data);
            if($list){
                return 200;
            }else{
                return '修改失败';
            }
        }else {
            return '该域名已存在';
        }
    }

//    删除
    public function delete_level(){
        $id = arr_jie(input('id'));
        if(!empty($id)){
            $list = Level::get($id);
            if($list->delete()){
                return 200;
            }else{
                return '删除失败';
            }
        }else{
            return '数据异常';
        }
    }

}
?>