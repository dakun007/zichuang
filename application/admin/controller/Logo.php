<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/8
 * Time: 10:26
 *操作： 登陆页面
 *
 */
namespace app\admin\controller;
use think\Controller;
class Logo extends  Controller{

    public function logo(){
        //域名
        dizhi();

        // 判断是否登录
        if(session('admin_id')!='' || session('admin_user')!=''){
            header('Location:/admin/index/index.html');
            exit;
        }
        if(request()->isPost()){
            $yzm = input('post.yzm');
            if(captcha_check($yzm)){
                $model = \think\Loader::model('admin')->logo_bak();
                if($model==200){
                    $this->success('登陆成功');
                }else{
                   $this->error($model);
                }
            }else{
                $this->error('验证码错误');
            }
//
            exit;
        }

        return $this->fetch();
    }
}
?>