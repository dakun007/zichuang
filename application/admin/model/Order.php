<?php
/**
 * 技术员： 吴坤盛
 * Date: 2018/8/7
 * Time: 21:41
 *操作：订单表
 *
 */
namespace app\admin\model;
use think\Model;
class Order extends Model{

    protected $autoWriteTimestamp = true;

//    展示
    public function index($where=array(),$ax = []){

        $user = input('user'); //产品名称
        $sex = input('sex'); //是否有效
        $tel = input('tel'); //手机号码
        $key = input('key'); //订单状态
        $kuai = input('or_kuai_id'); //快递
        $numbers = input('numbers'); //订单号
        $kaishi = strtotime(input('kaishi')); //开始时间
        $jieshi = input('jieshi'); //结束时间

        if($user){
            $where['or_name'] = ['like',"%$user%"];
        }
        if($kuai){
            $where['or_kuai_id'] = ['eq',$kuai];
        }
        if($sex){
            $where['or_tive'] = ['eq',$sex];
        }
        if($kaishi && $jieshi){
            $jieshi = \strtotime($jieshi.'23:59:59');
            $ax = "a.create_time between $kaishi and $jieshi";
        }else if($kaishi){
            $ax = "a.create_time >= '$kaishi'";
        }else if($jieshi){
            $jieshi = \strtotime($jieshi.'23:59:59');
            $ax = "a.create_time <= '$jieshi'";
        }

        if($tel){
            $where['or_tel'] = ['like',"%$tel%"];
        }

        if($key){
            $where['or_goods'] = ['eq',$key];
        }
        
        if ($numbers) {
            $where['or_order'] = ['like',"%$numbers%"];
        }
        
        $list = Order::where($where)->where($ax)->order('or_id desc')->field('b.create_time as create_t,a.*,b.go_user')->alias('a')->join('__GOODS__ b','a.or_goods_id = b.go_id')->paginate(10,false,['query'=>['user'=>$user,'id'=>input('id'),'nian'=>input('nian'),'kaishi'=>input('kaishi'),'jieshi'=>input('jieshi'),'key'=>input('key'),'sex'=>input('sex'),'numbers'=>input('numbers'),'tel'=>input('tel')]]);
        $page = $list->render();
        $meny = $this->where($where)->where($ax)->alias('a')->select();
        return [
            'list' => $list,
            'page' => $page,
            'meny' => $meny,
        ];
    }


//    删除
    public function delete_order(){
        $id = arr_jie(input('id'));
        if(!empty($id)){
            $str = Order::get($id);
            if($str->delete()){
                return 200;
            }else{
                return '删除失败';
            }
        }else{
            return '数据异常';
        }
    }

//    修改
    public function save_bak(){
        $data = input('post.');
        $id = $data['or_id'];
        if($data['or_goods']==1 || $data['or_goods']==2){
            if($data['or_order']==''){
                return '请输入单号';
            }
        }
        unset($data['or_id']);
        $sql = new Order;
        $sql = $sql->save($data,['or_id'=>$id]);
        if($sql){
            return 200;
        }else{
            return '修改失败';
        }
    }

//    展示年
    public function nian($where=array()){
        $user = input('user'); //年份
        if($user){
            $where['or_year'] = ['like',"%$user%"];
        }
        $list = Order::where($where)->order('or_id desc')->group('or_year')->paginate(10,false,['query'=>['user'=>$user]]);
        $page = $list->render();
        $meny = $this->where($where)->select();
        return [
            'list' => $list,
            'page' => $page,
            'meny' => $meny,
        ];
    }
    //    展示月
    public function yue(){
        $where=array();
        $user = input('user'); //月份
        if($user){
            $where['or_month'] = ['like',"%$user%"];
        }
        $where['or_tive'] = ['eq',1];
        $where['or_goods'] = ['eq',2];
        $where['or_year'] = ['eq',arr_jie(input('id'))];
        $list = Order::where($where)->order('or_id desc')->group('or_month')->paginate(10,false,['query'=>['user'=>input('user'),'id'=>input('id')]]);
        $page = $list->render();
        $meny = $this->where($where)->select();
        return [
            'list' => $list,
            'page' => $page,
            'meny' => $meny,
        ];
    }

//    订单数据汇总
    public function summary()
    {
        $where = [];
        $kaishi = strtotime(input('kaishi'));
        $jieshi = input('jieshi');
        if($kaishi && $jieshi){
            $jieshi = strtotime($jieshi.'23:59:59');
            $where['create_time'] = ['between',[$kaishi,$jieshi]];
        } elseif ($kaishi) {
            $where['create_time'] = ['egt',$kaishi];
        } elseif ($jieshi) {
            $jieshi = strtotime($jieshi.'23:59:59');
            $where['create_time'] = ['elt',$jieshi];
        }
        $sql = $this->where($where)->select();
        return $sql;
    }

}

?>