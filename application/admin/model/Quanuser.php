<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/13
 * Time: 7:39
 *
 *
 */
namespace app\admin\model;
use think\Model;
class Quanuser extends Model{

    protected $autoWriteTimestamp = true;

//    展示
    public function  index(){
        $where = [];
        $list = Quanuser::where($where)->order('id desc')->paginate(10);
        $page = $list->render();
        return [
            'page' => $page,
            'list' => $list,
        ];
    }


//    添加
    public function  add(){
        $user = input('user');
        $yzm = $_POST['like1'];
        if(isset($yzm[0])){
            $yzm = 0;
        }else{
            $yzm = implode(',',$yzm);
        }

        $data = [
            'nameuser' => $user,
            'quan' => $yzm,
        ];
        $sql = $this->save($data);
        if($sql){
            return 200;
        }else{
            return '添加失败';
        }
    }

    //    修改
    public function  save_bak(){
        $user = input('user');
        $id = input('id');
        $yzm = $_POST['like1'];
        if(isset($yzm[0])){
            $yzm = 0;
        }else{
            $yzm = implode(',',$yzm);
        }

        $data = [
            'nameuser' => $user,
            'quan' => $yzm,
            'id' => $id,
        ];
        $sql = $this->isUpdate(true)->save($data);
        if($sql){
            return 200;
        }else{
            return '添加失败';
        }
    }

//    删除
    public function delete_bak(){
        $id = arr_jie(input('id'));
        if(!empty($id)){
            $sql = Quanuser::get($id);
            if($sql->delete()){
                return 200;
            }else{
                return '删除失败';
            }
        }
    }
}
?>