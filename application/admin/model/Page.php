<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/10
 * Time: 15:05
 *
 *
 */
namespace app\admin\model;
use think\Model;
class Page extends Model{

    protected $autoWriteTimestamp = true;

//展示
    public function index(){
        $list = Page::order('id desc')->join('__GOODS__ b','a.want_id=b.go_id')->join('__GOODS__ c','a.point_id=c.go_id')->field('a.*,b.go_user as user,c.go_user as nameuser')->alias('a')->paginate(10,false);
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
        ];
    }

//添加
    public function add(){
        $data = input('post.');

        $where['want_id'] = ['eq',$data['want_id']];
        $where['point_id'] = ['eq',$data['point_id']];

        $find = $this->where($where)->find();
        if($find==false){
            if(empty($data['want_id'])){
                return '请选择跳转地址';
            }else if(empty($data['point_id'])){
                return '请选择指向地址';
            }
            $sl = $this->isUpdate(false)->save($data);
            if($sl){
                return 200;
            }else{
                '添加失败';
            }
        }else{
            return '改地址跳转已存在';
        }

    }

    public function save_bak(){
        $data = input('post.');

        $where['want_id'] = ['eq',$data['want_id']];
        $where['point_id'] = ['eq',$data['point_id']];
        $id = $data['id'];
        $find = $this->where($where)->where("id!='$id'")->find();
        if($find==false){
            if(empty($data['want_id'])){
                return '请选择跳转地址';
            }else if(empty($data['point_id'])){
                return '请选择指向地址';
            }
            $sl = $this->isUpdate(true)->save($data);
            if($sl){
                return 200;
            }else{
                '修改失败';
            }
        }else{
            return '改地址跳转已存在';
        }
    }

//    删除
    public function delete_page(){
        $id = arr_jie(input('id'));
        if(!empty($id)){
            $user = Page::get($id);
            if($user->delete()){
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