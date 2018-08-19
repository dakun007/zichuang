<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/7
 * Time: 15:06
 *技术员： 吴坤盛
 *操作账号表
 *
 */
namespace app\admin\model;
use think\Model;
class Admin extends Model{

    protected $autoWriteTimestamp = true; //自动添加时间

//    添加
    public function add(){
//        验证
        $data = input('post.');
        $str = public_xy($data);
        if($str == 200){
//            判断用户是否重复
            $user = $data['ad_user'];
            $sql = $this->where("ad_user='$user'")->find();
            if($sql==false){
                $shuiji = suiji();
                $data['ad_passad'] = hasha($data['ad_passad'],'',$shuiji);
                $data['ad_passad_jia'] = $shuiji;
//                添加数据
                $opre = new Admin($data);
                $opre->allowField(['ad_user','ad_passad_jia','ad_passad','ad_quanuser_id'])->save();
                if($opre->ad_id){
                    return 200;
                }else{
                    return '添加失败';
                }
            }else{
                return '名称已存在';
            }

        }else{
            return $str;
        }
    }

//    展示数据
    public function index(){
        $where = array();
        $user = input('user');
        if($user){
            $where['ad_user'] = ['like',"%$user%"];
        }
        $list = Admin::where($where)->order('ad_id desc')->field('a.*,b.nameuser')->alias('a')->join('__QUANUSER__ b','a.ad_quanuser_id=b.id')->paginate(10,false,['query'=>['user'=>$user]]);
        $page = $list->render();
        return [
            'list' => $list,
            'page' => $page,
        ];
    }

//    修改
    public function save_bak(){
        $user = input('post.ad_user');
        $passad = input('post.ad_passad');
        $id = arr_jie(input('post.ad_id'));
        if(isset($user) and isset($id)){
//           判断用户是否为重复
            $sql = $this->where("ad_user='$user' and ad_id!='$id'")->find();
            if($sql==false){
                $data = array();
                if($passad){
                    $shuiji = suiji();
                    $data['ad_passad'] = hasha($passad,'',$shuiji);
                    $data['ad_passad_jia'] = $shuiji;
                }
                $data['ad_quanuser_id'] = input('post.ad_quanuser_id');
                $data['ad_user'] = $user;
                $opre = Admin::allowField(['ad_user','ad_passad_jia','ad_passad','ad_quanuser_id'])->save($data,['ad_id'=>$id]);
                if($opre){
                    return 200;
                }else{
                    return '修改失败';
                }
            }else{
                return '名称已存在';
            }
        }else{
            return '名称不能为空';
        }
    }

//    删除
    public function delete_admin(){
        $id = arr_jie(input('post.id'));
        if(!empty($id)){
            $user = Admin::get($id);
            if($user->delete()){
                return 200;
            }else{
                return '删除失败';
            }
        }
    }

//    登陆
    public function logo_bak(){
        $user = input('post.user');
        $pass = input('post.pass');
        $find = $this->where("ad_user='$user'")->find();
        if($find){
            if(hasha($pass,'',$find['ad_passad_jia'])==$find['ad_passad']){
                session('admin_id',$find['ad_id']);
                session('admin_user',$find['ad_user']);

                 $tely = new Lately;
                 $ip = ip();
                 $ip_str = $ip['data']['country'].$ip['data']['region'].$ip['data']['city'];
                 $da = [
                     'la_admin_id' => $find['ad_id'],
                     'la_time' => time(),
                     'la_ip' => $ip['data']['ip'],
                     'la_ip_adds' => $ip_str,
                 ];
                 $tely->save($da);
                return 200;
            }
        }
        return '账号密码错误';

    }

}
?>