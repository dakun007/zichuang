<?php
namespace app\admin\model;
use think\Model;
class Kuai extends Model
{
    protected $autoWriteTimestamp = true; //自动添加时间
    // 添加
    public function add()
    {
        $name = input('post.title');
        
        if($name != ''){
            if (!$this->where("username='$name'")->find()) {
                $opre = new Kuai(['username'=>$name]);
                $ysx = $opre->allowField(['username'])->save();
                if($opre->id){
                    return 200;
                }else{
                    return '添加失败';
                }
            }else{
                return '改名称已存在';
            }

        }else{
            return '数据不能为空';
        }
        exit;
    }


    // 修改
    public function save_bak()
    {
        $name = input('post.username');
        $id = input('post.id');
        
        if($name != '' && $id != ''){
            if (!$this->where("username='$name' and id!='$id'")->find()) {
                $ysx = Kuai::allowField(['username'])->save(input('post.'),['id'=>$id]);
                if($ysx){
                    return 200;
                }else{
                    return '修改失败';
                }
            }else{
                return '改名称已存在';
            }

        }else{
            return '数据不能为空';
        }
        exit;
    }

    // 展示
    public function index()
    {
        $where = array();
        $user = input('username');
        if($user){
            $where['username'] = ['like',"%$user%"];
        }
        $list = Kuai::where($where)->order('id desc')->paginate(10,false,['query'=>['username'=>$user]]);
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
        ];
    }

    // 删除数据
    public function delete_bak()
    {
        $id = arr_jie(input('id'));
        if(!empty($id)){
            $yse = Kuai::get($id);
            if($yse->delete()){
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