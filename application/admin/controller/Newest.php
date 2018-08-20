<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/7
 * Time: 17:16
 *
 *
 */
namespace app\admin\controller;
use think\Controller;
class Newest extends Ro{

//    展示24小时
    public function index(){
        $ri = ri(); //获取今天时间戳
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_day'] = ['eq',$ri];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return $this->fetch();
    }

//    修改
    public function save_bak(){
        $id = arr_jie(input('id'));
        $sql = 'order';

        if(request()->isPost()){
            $model = \think\Loader::model('order')->save_bak();
            if($model==200){
                $this->success('修改成功');
            }else{
                $this->error($model);
            }
            exit;
        }

        if(!empty($id)){
            $find = \think\Db::name($sql)->field('a.*,b.go_user')->alias('a')->join('__GOODS__ b','a.or_goods_id = b.go_id')->find($id);
            if(!empty($id)){
                $this->assign([
                    'find' => $find,
                ]);
                return $this->fetch();
            }
        }

        $this->error('数据异常');
    }

//    删除
    public function delete_newest(){
        if(request()->isPost()){
            $model = \think\Loader::model('order')->delete_order();
            if($model==200){
                $this->success('删除成功');
            }else{
                $this->error($model);
            }
        }else{
            $this->error('数据异常');
        }
    }

//    展示全部订单
    public function whole(){
        $model = \think\Loader::model('order')->index();
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return $this->fetch();
    }

//    展示有效订单
    public function tive(){
        $yzm['or_tive'] = ['eq',1];
        //$value['or_goods'] == 6 || $value['or_goods'] == 1 || $value['or_goods'] == 2 || $value['or_goods'] == 3
        $shu = 'or_goods=6 OR or_goods=1 OR or_goods=2 OR or_goods=3';
        $model = \think\Loader::model('order')->index($yzm,$shu);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return $this->fetch();
    }

//    展示无效订单
    public function invalid(){
        $yzm['or_tive'] = ['eq',2];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return $this->fetch();
    }

//    展示发货
    public function goods(){
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',1];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return $this->fetch();
    }

    //    展示确定签收
    public function sign(){
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',2];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return $this->fetch();
    }

    //    展示退货
    public function retu(){
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',3];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return $this->fetch();
    }

    // 展示再联系
    public function liax()
    {
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',5];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return view();
    }

    // 展示未发货
    public function delivery()
    {
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',6];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return view();
    }

    // 展示未发货
    public function audited()
    {
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',7];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return view();
    }

    // 展示未处理
    public function handle()
    {
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',4];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return view();
    }

    // 展示垃圾单
    public function garbage()
    {
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',8];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return view();
    }

    // 展示拒收
    public function tion()
    {
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',9];
        $model = \think\Loader::model('order')->index($yzm);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny'],
        ]);
        return view();
    }

//    展示本月金额
    public function  yue_money(){
        $ri = yue(); //获取今天时间戳
        $nian = nian(); //获取今天时间戳
        $yzm['or_month'] = ['eq',$ri];
        $yzm['or_year'] = ['eq',$nian];
        $yzm['or_tive'] = ['eq',1];
        $yzm['or_goods'] = ['eq',2];
        $model = \think\Loader::model('order')->index($yzm);
        // var_dump($model['meny']);
        $this->assign([
            'list' => $model['list'],
            'page' => $model['page'],
            'meny' => $model['meny']
        ]);
        return $this->fetch();
    }

}

?>