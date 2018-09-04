<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

// 控制后台地址
function dizhi () {
    $yuming = $_SERVER['HTTP_HOST']; //域名
    //判断域名
    if ($yuming != 'www.mishi186.com' and $yuming != 'mishi186.com' and $yuming != 'www.mi1888.com') {
        echo "<div style='color:red;text-align: center;font-size:18px;'>404</div>";
        exit;
    } 
}


//UTFWry.dat获取ip地址信息
function UTFWry()
{
    $ip_a = $_SERVER["REMOTE_ADDR"];
    import('Net.IpLocation', EXTEND_PATH,'.php');
    $Ip = new \IpLocation();
    $area = $Ip->getlocation($ip_a);
    return $area['country'];
}


// 产品页面地址：
function public_goods($val='',$ye='html'){
    if(isset($val)){
        return "../application/index/view/goods/$val.$ye";
    }
}

// 创建文件
function public_chuan($data='',$val=''){
    if(isset($data)){
        // 判断文件是否存在
        $url = public_goods($data);
        $yz = file_exists($url);
        if($yz){
            unlink($url); //删除文件
        }
        // 创建文件
        $fh = fopen($url, 'w');
        fwrite($fh , $val);
        fclose($fh);
    }
}

// 加密
function hasha($data='',$val='dakun',$sui=''){
    $pwd = $data.$val.$sui;
    return md5($pwd);
};

//日期转换
function public_ri($val=''){
    if($val){
        return date('Y-m-d',$val);
    }
}

//随机
function suiji(){
    $val = '123456789qwertyuiopasdfghjklzxcvbnm-=_+';
    return substr(str_shuffle($val),0,8);
}


//获取当前地址
function addr_thod(){
    return url(request()->controller().'/'.request()->action());
}
// 获取当前方法
function action_ko(){
    return request()->action();
}

// 判断导航是否选中
function public_ation($arr,$str){
    $val = action_ko();
    foreach($arr as $key => $value){
        if($val == $value){
            return $str;
        }
    };
}

//删除图片
function del_img($val=''){
    if($val){
        $img =__PHPIMG__.$val;
        if(file_exists($img)){
            unlink($img);
        }
    }
}



//图片
function zu_img($val=''){
    if($val){
        $val = str_replace('\\','/',$val);
        $img = __IMGPHP__.$val;
        return $img;
    }
}

//时间转换
function public_time($val=''){
    if($val){
        return date('Y-m-d H:i:s',$val);
    }
}


//研发加密
function arr_jia($val='',$key='dakun007'){
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+"; //定义加密密钥
    $nh = rand(0,64);  //随机数
    $ch = $chars[$nh]; //把chars变量定义成一个数组，根据$nh数据变化
    $mdKey = sha1($key.$ch);  //加密sha1()$key固定值，$ch随机值;
    $mdKey = substr($mdKey,0, 5); //截取sha1值
    $str = base64_encode(base64_encode($val.','.$mdKey));
    $arr_let = strlen($str);
    $jian = $arr_let-6; //起步
    $arr = '';
    for ($i=0; $i < $arr_let; $i++) {
        if($i==0){
            $arr .= $str[$arr_let-1];
        }elseif($i==$arr_let-1){
            $arr .= $str[0];
        }elseif($i==2){
            $arr .= $str[$jian];
        }elseif($i==$jian){
            $arr .= $str[2];
        }else{
            $arr .= $str[$i];
        }
    }
    $sui = rand(10,99);
    return base64_encode($sui.$arr);
}

//研发解密
function arr_jie($val=''){
    $str = substr(base64_decode($val),2);
    $arr_let = strlen($str);
    $jian = $arr_let-6; //起步
    $arr_ar = '';
    for ($i=0; $i < $arr_let; $i++) {
        if($i==0){
            $arr_ar .= $str[$arr_let-1];
        }elseif($i==$arr_let-1){
            $arr_ar .= $str[0];
        }elseif($i==2){
            $arr_ar .= $str[$jian];
        }elseif($i==$jian){
            $arr_ar .= $str[2];
        }else{
            $arr_ar .= $str[$i];
        }
    }
    $stra = explode(',',base64_decode(base64_decode($arr_ar)));
    return $stra[0];
}

// 淘宝ip
function ip(){
    $ip = $_SERVER["REMOTE_ADDR"];
    $url='http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
    $ch = curl_init(); 
    curl_setopt ($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch, CURLOPT_TIMEOUT, 1); 
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,1); 
    $dxycontent = curl_exec($ch); 
    
    // $result = file_get_contents($url);
    $result = json_decode($dxycontent,true);
    return $result;
}

//138ip
function ip138()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    $url = "http://api.ip138.com/query/?ip=$ip&token=72a03ede2a100abca1c8d632333f2db0";
    $ch = curl_init(); 
    curl_setopt ($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch, CURLOPT_TIMEOUT, 1); 
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,1); 
    $dxycontent = curl_exec($ch); 
    
    // $result = file_get_contents($url);
    $result = json_decode($dxycontent,true);
    return $result['data'][0].$result['data'][1].$result['data'][2].$result['data'][3];
}

// 百度ip

// 前段展示
// function end_ip(){
//     $ip = ip();
//     if(empty($ip)){
//         echo "<script>alert('当前抢购人数过多，请忍心等待一下！')</script>";
//         return null;
//     }else{
//         return $ip;
//     }
// }

// 展示后端
function after_ip()
{
    $ip = ip();
    if(empty($ip)){
        end_ip();
        return null;
    }else{
        return $ip;
    }

}


function public_img($val='',$ya='jpg,png,gif'){
    if($_FILES['file']['size']==0){
        echo json_encode([
            'static' => 0,
            'msg' => '文件过大无法上传',
        ]);
        exit;
    }
    $file=request()->file("file");
    if($file){
        $info = $file->validate(['size'=>1024000*1024000,'ext'=>$ya])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            //删除图片
            $img = session($val);
            if($img){
                del_img($img);
                session($val,null);
            }
            // 成功上传后 获取上传信息
            $img = $info->getSaveName();
            \session($val,$img);
            echo json_encode([
                'static' => 1,
                'msg' => '上传成功',
            ]);
        }else{
            // 上传失败获取错误信息
            echo json_encode([
                'static' => 0,
                'msg' => $file->getError(),
            ]);
        }
    }
}

//状态(1是，2取消，3预约中)
function public_zhuan($data=''){
    if($data==1){
        return '<span class="layui-badge layui-bg-blue">已确定预约</span>';
    }else if($data == 2){
        return '<span class="layui-badge layui-bg-gray">已取消预约</span>';
        return '已取消预约';
    }else if($data==3){
        return '<span class="layui-badge">预约中</span>';
    }
}

//商城状态订单是否有效（1，签收，2，退货，）
function goods_zhuan($data=''){
    if($data==1){
        return '<span class="layui-badge layui-bg-blue">有效</span>';
    }else if($data == 2){
        return '<span class="layui-badge">无效</span>';
    }
}

//商城发货（1，未发货，2， 发货）
function goods_fahuo($data=''){
    if($data==4){
        return '<span class="layui-badge">未处理</span>';
    }else if($data == 1){
        return '<span class="layui-badge layui-bg-blue">已发货</span>';
    }else if($data == 3){
        return '<span class="layui-badge layui-bg-gray">确定退货</span>';
    }else if($data == 2){   
        return '<span class="layui-badge layui-bg-blue">确定签收</span>';
    }else if($data == 5){
        return '<span class="layui-badge">再联系</span>';
    }else if($data == 6){
        return '<span class="layui-badge">未发货</span>';
    }else if($data == 7){
        return '<span class="layui-badge">待审核</span>';
    }else if($data == 8){
        return '<span class="layui-badge">垃圾单</span>';
    }else if($data == 9){
        return '<span class="layui-badge">拒收</span>';
    }else if($data == 10){
        return '<span class="layui-badge">已完成</span>';
    }else if($data == 11){
        return '<span class="layui-badge">售货状态</span>';
    }
}



//树形
function public_chex($val,$data){
    foreach($val as $kex => $valx){
        if($valx==0){
            return 'checked';
        }elseif($valx==$data){
            return 'checked';
        }
    }
}

//删除缓存session图片
function public_sess_img($val=''){
    if(!request()->isPost()){
        $img = session($val);
        if($img){
            del_img($img);
            session($val,null);
        }
    }
}


//默认地址
define('__TAGE__','/public/static/admin');

// 只能输入数字
function input_shu(){
    echo 'onkeyup="this.value=this.value.replace(/\D/g,\'\')" onafterpaste="this.value=this.value.replace(/\D/g,\'\')"';
}
//提交按钮
function submit($val='立即提交'){
    echo '<button class="layui-btn submit-btn" lay-submit="" lay-filter="demo1">'.$val.'</button>';
}

//解密
function public_base($val=''){
    return base64_decode($val);
}

// 百度编辑器引用
function baidu($val='myEd'){
    echo "var um = UM.getEditor('$val',{initialFrameWidth: '100%'});";
}
//查询数量
function public_shu($data,$ya,$va,$cishu='',$fal=1){
    $str = '';
    foreach($data as $key=>$val){
        if($val[$ya]==$va){
            if($cishu==1){
                $str+=$cishu;
            }else{
                $str+=$val[$cishu];
            }
        }
    }
    if($fal==1){
        return "<span class='layui-badge'>$str</span>";
    }else{
        return $str;
    }
}

//查询UV
function public_uv($sel='',$vax,$ip,$sql,$fal=1){
    $ax = '';
    foreach($sel as $k => $v){
        if($v[$sql] == $vax){
            $ax[] = $v[$ip];
        }
    }
    $ax = count(array_unique($ax));
    if($fal==1){
        return "<span class='layui-badge'>$ax</span>";
    }else{
        return $ax;
    }
}

// 金额
function public_jie($meny,$or_moeny){
    $ax = 0;
    foreach($meny as $key => $vel){
        $ax += $vel[$or_moeny];
    }
    return $ax;
}

//获取域名
function yuming(){
    return 'https://'.$_SERVER['HTTP_HOST'].'/';
}

// zhuanyi
function zhuanyi($val){
    $url = yuming();
    return str_replace('\\','/',$url.__IMG__.$val);
}

//循环判断
function public_xu($val,$str){
    $ar = '';
    foreach ($val as $ke => $va){
        foreach($str as $k=>$v){
            if($ke==$k){
                if($va==''){
                    $ar = $v;
                    break;
                }
            }
        }
        if($ar!=false){
            break;
        }
    }
    if($ar){
        return $ar;
    }else{
        return 200;
    }
}

// 简介循环判断
function public_xy($val=''){
    $str = '';
    foreach($val as $ke=>$va){
        if($va==''){
            $str = 500;
        }
    };
    if($str == ''){
        return 200;
    }else{
        return '有数据为空';
    }
}


function post_data(){

    $receipt = file_get_contents("php://input");
    if($receipt == null){
        $receipt = $GLOBALS['HTTP_RAW_POST_DATA'];
    }
    return $receipt;
}

// 日期
function ri(){
    return strtotime(date('Y-m-d',time()));
}

//月
function yue(){
    return date('m');
}

//年
function nian(){
    return date('Y');
}

// 判断是否appid
function appid_yz($val){
    $user = input($val);
    $sql = \think\Db::name('user')->where("us_api='$user'")->find();
    if($sql==false){
        exit('数据异常，404');
    }else{
        return $sql;
    }
}


// 获取token
function get_access_token($appid,$secret) {
    $get_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
    $content = file_get_contents($get_url);
    $content_json = json_decode($content);
    $access_token = $content_json->access_token;
    $expires_in = $content_json->expires_in;
    return $access_token;
}

function curl_post($url='',$postdata='',$options=array()){
    $ch=curl_init($url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    if(!empty($options)){
        curl_setopt_array($ch, $options);
    }
    $data=curl_exec($ch);
    curl_close($ch);
    // return $data;
}


// 提示模板 https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=
function public_muban($appid,$appid_ye,$pid,$mu,$adds,$for_id,$val1,$val2,$val3,$val4,$url){
    $get = get_access_token($appid,$appid_ye);
    $data = '';
    $data = [
        "touser"            => $pid,
        "template_id"       => $mu,
        "page"              => $adds,
        "form_id"           => $for_id,
        'data' => [
            "keyword1"=> [
                "value"=> $val1
            ],
            "keyword2"=> [
                "value"=> $val2
            ],
            "keyword3"=> [
                "value"=> $val3
            ],
            "keyword4"=> [
                "value"=> $val4
            ],

        ],
    ];
    $data = json_encode($data);
    $aa = curl_post($url.$get,$data);
    // var_dump($aa);
    // echo $data;
}


//随机手机
function public_tel(){
    $shu = '1234567890';
    $yz = '3587';
    for ($i=0;$i<=100;$i++){
        $ax[] = '1'.substr(str_shuffle($yz),0,1).substr(str_shuffle($yz),0,1).'****'.substr(str_shuffle($shu),0,4);
    }
    return $ax;
}

//随机姓氏
function public_xing(){
    $name = '赵|钱|孙|李|周|吴|郑|王|冯陈|褚|卫|蒋|沈|韩|杨|朱|秦|尤|许何|吕|施|张|孔|曹|严|华|金|魏|陶|姜|戚|谢|邹|喻|柏|水|窦|章云|苏|潘|葛|奚|范|彭|郎|鲁|韦|昌|马|苗|凤|花|方|俞|任|袁|柳酆|鲍|史|唐|费|廉|岑|薛|雷|贺|倪|汤|滕|殷|罗|毕|郝|邬|安|常乐|于|时|傅|皮|卞|齐|康|伍|余|元|卜|顾|孟|平|黄|和|穆|萧|尹姚|邵|湛|汪|祁|毛|禹|狄|米|贝|明|臧|计|伏|成|戴|谈|宋|茅|庞|熊|纪|舒|屈|项|祝|董|粱|杜|阮|蓝|闵|席|季|麻|强|贾|路|娄|危江|童|颜|郭|梅|盛|林|刁|钟|徐|邱|骆|高|夏|蔡|田|樊|胡|凌|霍虞|万|支|柯|昝|管|卢|莫|经|房|裘|缪|干|解|应|宗|丁|宣|贲|邓郁|单|杭|洪|包|诸|左|石|崔|吉|钮|龚|程|嵇|邢|滑|裴|陆|荣|翁荀|羊|於|惠|甄|麴|家|封|芮|羿|储|靳|汲|邴|糜|松|井|段|富|巫|乌|焦|巴|弓|牧|隗|山|谷|车|侯|宓|蓬|全|郗|班|仰|秋|仲|伊|宫宁|仇|栾|暴|甘|钭|厉|戎|祖|武|符|刘|景|詹|束|龙|叶|幸|司|韶郜|黎|蓟|薄|印|宿|白|怀|蒲|邰|从|鄂|索|咸|籍|赖|卓|蔺|屠|蒙池|乔|阴|欎|胥|能|苍|双|闻|莘|党|翟|谭|贡|劳|逄|姬|申|扶|堵冉|宰|郦|雍|舄|璩|桑|桂|濮|牛|寿|通|边|扈|燕|冀|郏|浦|尚|农温|别|庄|晏|柴|瞿|阎|充|慕|连|茹|习|宦|艾|鱼|容|向|古|易|慎戈|廖|庾|终|暨|居|衡|步|都|耿|满|弘|匡|国|文|寇|广|禄|阙|东殴|殳|沃|利|蔚|越|夔|隆|师|巩|厍|聂|晁|勾|敖|融|冷|訾|辛|阚那|简|饶|空|曾|毋|沙|乜|养|鞠|须|丰|巢|关|蒯|相|查|後|荆|红游|竺|权|逯|盖|益|桓|公|万俟|司马|上官|欧阳|夏侯|诸葛闻人|东方|赫连|皇甫|尉迟|公羊|澹台|公冶|宗政|濮阳淳于|单于|太叔|申屠|公孙|仲孙|轩辕|令狐|钟离|宇文长孙|慕容|鲜于|闾丘|司徒|司空|亓官|司寇|仉|督|子车颛孙|端木|巫马|公西|漆雕|乐正|壤驷|公良|拓跋|夹谷宰父|谷梁|晋|楚|闫|法|汝|鄢|涂|钦|段干|百里|东郭|南门呼延|归|海|羊舌|微生|岳|帅|缑|亢|况|后|有|琴|梁丘|东门|西门|商|牟|佘|佴|伯|赏|南宫|墨|哈|谯|笪|年|爱|阳|佟第五|言|福|百|家|姓|终|卓|蔺|屠|蒙|池|乔|阳|郁|胥|能|苍|双闻|莘|党|翟|谭|贡|劳|逄|姬|申|扶|堵冉|宰|郦|雍|却|璩|桑|桂|濮|牛|寿|通边|扈|燕|冀|僪|浦|尚|农|温|别|庄|晏柴|瞿|阎|充|慕|连|茹|习|宦|艾|鱼|容向|古|易|慎|戈|庾|终|暨|居|衡|步都耿|满|弘|匡|国|文|寇|广|禄|阙|东欧殳|沃|利|蔚|越|夔|隆|师|巩|厍|聂晁勾|敖|融|冷|訾|辛|阚|那|简|饶|空曾毋|沙|乜|养|鞠|须|丰|巢|关|蒯|相查后|荆|红|游|竺|权|逮|盍|益|桓|公|唱万俟|司马|上官|欧阳|夏侯|诸葛|闻人|东方|赫连|皇甫|尉迟|公羊澹台|公冶|宗政|濮阳|淳于|单于|太叔|申屠|公孙|仲孙|轩辕|令狐钟离|宇文|长孙|慕容|司徒|司空|召|有|舜|丛|岳寸|贰|皇|侨|彤|竭|端|赫|实|甫|集|象翠|狂|辟|典|良|函|芒|苦|其|京|中|夕之|蹇|称|诺|来|多|繁|戊|朴|回|毓税|荤|靖|绪|愈|硕|牢|买|但|巧|枚|撒泰|秘|亥|绍|以|壬|森|斋|释|奕|姒|朋求|羽|用|占|真|穰|翦|闾|漆|贵|代|贯旁|崇|栋|告|休|褒|谏|锐|皋|闳|在|歧禾|示|是|委|钊|频|嬴|呼|大|威|昂|律冒|保|系|抄|定|化|莱|校|么|抗|祢|綦悟|宏|功|庚|务|敏|捷|拱|兆|丑|丙|畅苟|随|类|卯|俟|友|答|乙|允|甲|留|尾佼|玄|乘|裔|延|植|环|矫|赛|昔|侍|度旷|遇|偶|前|由|咎|塞|敛|受|泷|袭|衅叔|圣|御|夫|仆|镇|藩|邸|府|掌|首|员焉|戏|可|智|尔|凭|悉|进|笃|厚|仁|业肇|资|合|仍|九|衷|哀|刑|俎|仵|圭|夷徭|蛮|汗|孛|乾|帖|罕|洛|淦|洋|邶|郸郯|邗|邛|剑|虢|隋|蒿|茆|菅|苌|树|桐锁|钟|机|盘|铎|斛|玉|线|针|箕|庹|绳磨|蒉|瓮|弭|刀|疏|牵|浑|恽|势|世|仝同|蚁|止|戢|睢|冼|种|涂|肖|己|泣|潜卷|脱|谬|蹉|赧|浮|顿|说|次|错|念|夙斯|完|丹|表|聊|源|姓|吾|寻|展|出|不户|闭|才|无|书|学|愚|本|性|雪|霜|烟寒|少|字|桥|板|斐|独|千|诗|嘉|扬|善揭|祈|析|赤|紫|青|柔|刚|奇|拜|佛|陀弥|阿|素|长|僧|隐|仙|隽|宇|祭|酒|淡塔|琦|闪|始|星|南|天|接|波|碧|速|禚腾|潮|镜|似|澄|潭|謇|纵|渠|奈|风|春濯|沐|茂|英|兰|檀|藤|枝|检|生|折|登驹|骑|貊|虎|肥|鹿|雀|野|禽|飞|节|宜鲜|粟|栗|豆|帛|官|布|衣|藏|宝|钞|银门|盈|庆|喜|及|普|建|营|巨|望|希|道载|声|漫|犁|力|贸|勤|革|改|兴|亓|睦修|信|闽|北|守|坚|勇|汉|练|尉|士|旅五|令|将|旗|军|行|奉|敬|恭|仪|母|堂丘|义|礼|慈|孝|理|伦|卿|问|永|辉|位让|尧|依|犹|介|承|市|所|苑|杞|剧|第零|谌|招|续|达|忻|六|鄞|战|迟|候|宛励|粘|萨|邝|覃|辜|初|楼|城|区|局|台原|考|妫|纳|泉|老|清|德|卑|过|麦|曲竹|百|福|言|第五|佟|爱|年|笪|谯|哈|墨南宫|赏|伯|佴|佘|牟|商|西门|东门|左丘|梁丘|琴后|况|亢|缑|帅|微生|羊舌|海|归|呼延|南门|东郭百里|钦|鄢|汝|法|闫|楚|晋|谷梁|宰父|夹谷|拓跋壤驷|乐正|漆雕|公西|巫马|端木|颛孙|子车|督|仉|司寇|亓官鲜于|锺离|盖|逯|库|郏|逢|阴|薄|厉|稽|闾丘公良|段干|开|光|操|瑞|眭|泥|运|摩|伟|铁迮|荔菲|辗迟';
   $name = explode('|',$name);
    shuffle($name);
    return $name;
}

//随机名称加手机
function public_name(){
    $public_tel = public_tel();
    $public_xing = public_xing();
    $xin = ['先生','女士','小姐'];
    foreach ($public_tel as $key => $value){
        shuffle($xin);
        $ax[] = [
            'name' => $public_xing[$key]. $xin[0],
            'tel' => $value,
        ];
    }
    return $ax;
}

//路径
define('__PHPIMG__','./static/uploads/');
define('__IMG__','static/uploads/');
define('__IMGPHP__','/static/uploads/');
