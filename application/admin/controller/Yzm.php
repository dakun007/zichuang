<?php
namespace app\admin\controller;
use think\captcha\Captcha;
class Yzm extends Captcha{
    public function index(){
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    20,    
            // 验证码位数
            'length'      =>    4,   
            // 关闭验证码杂点
            'useNoise'    =>    false, 
            'fontttf' => '5.ttf',
            'codeSet' => '0123456789',
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }
        
}
?>