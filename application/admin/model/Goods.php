<?php
namespace app\admin\model;
use think\Model;
class Goods extends Model{

    protected $autoWriteTimestamp = true;
    // 添加
    public function add($data=''){
        if(isset($data)){
            // 验证名称
            $username = $data['go_user'];
            $str = public_xy($data);
            if($str == 200){
                $add = $this->where("go_user='$username'")->find();
                if($add == false){
                    $user = new Goods($data);
                    $user->allowField(['go_user','go_money','go_bak','go_jibie','create_time','go_guan'])->save();
                    if($user->go_id){
                        public_chuan($username,$_POST['desc']);
                        return 200;
                    }else{
                        return '添加失败';
                    }
                }else{
                    return '名称重复，请修改！';
                }
            }else{
                return $str;
            }
            exit;
        }
    }

    // 修改
    public function save_bak($data=''){
        if(isset($data)){
            // 验证名称
            $username = $data['go_user'];
            $str = public_xy($data);
            if($str == 200){
                $id = $data['go_id'];
                $add = $this->where("go_user='$username' and go_id!='$id'")->find();
                $yo = $this->field('go_user')->find($id);
                if($add == false){
                    $user = new Goods();
                    $ye = $user->allowField(['go_user','go_money','go_bak','go_jibie','create_time','go_guan'])->save($data,['go_id'=>$id]);
                    if($ye){
                        $xa = public_goods($yo['go_user']);
                        unlink($xa);
                        $sl = str_replace("<&textarea>","</textarea>",$_POST['desc']);
                        public_chuan($username,$sl);
                        return 200;
                    }else{
                        return '修改失败';
                    }
                }else{
                    return "名称重复，请修改！$id 2";
                }
            }else{
                return $str;
            }
            exit;
        }
    }

    // 父级预览
    public function index()
    {
        $where = array();
        $user = input('username');
        if($user){
            $where['go_user'] = array('like',"%$user%");
        }
        $list = Goods::where("go_jibie=1")->where($where)->order('go_id desc')->paginate(10);
        // 获取分页显示
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
        ];
    }

    // 删除
    public function delete_goods(){
        $id = arr_jie(input('post.id'));
        if(isset($id)){
            $find = $this->field("go_user,go_jibie")->find($id);
            if($find['go_jibie']==1){
                $fu = \think\Db::name('goods')->where("go_guan='$id'")->field('go_id,go_user')->select();
                $arr = '';
                foreach ($fu as $key => $vals){
                    $arr[] = $vals['go_id'];
                }
                $arr[] = $id;
                $sql = Goods::destroy($arr);
                if($sql){
//                    循环删除子级
                    foreach($fu  as $key => $xs){
                        $str = public_goods($xs['go_user']);
                        unlink($str);
                    }

//                   删除父级
                    $str = public_goods($find['go_user']);
                    unlink($str);
                    return 200;
                }else{
                    return '删除失败';
                }

            }else{
                $sql = Goods::get($id);
                if($sql->delete()){
                    $str = public_goods($find['go_user']);
                    unlink($str);
                    return 200;
                }else{
                    return '删除失败';
                }
            }
        }else{
            return '数据异常';
        }
    }

    /*********************************子级操作**********************************/
//    预览
    public function subg(){
        $id = arr_jie(input('id'));
        $list = Goods::where("go_jibie=2 and go_guan='$id'")->order('go_id desc')->paginate(10,false,['query'=>['id'=>input('id')]]);
        // 获取分页显示
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
        ];
    }

    
}

?>