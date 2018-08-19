function title(){
    var x = 10;
    var y = 20;
    var newtitle = '';
    $('.tooltip').mouseover(function (e) {
        newtitle = this.title;
        this.title = '';
        $('body').append('<div id="tooltip">' + newtitle + '</div>');
        var bo = $('body').width()-40;
        var ce = e.pageX + x ;
        if (ce > bo){
            ce = bo;
        }
        $('#tooltip').css({
            'left': (ce + 'px'),
            'top': (e.pageY + y + 'px')
        }).show();
    }).mouseout(function () {
        this.title = newtitle;
        $('#tooltip').remove();
    }).mousemove(function (e) {
        var bo = $('body').width() - 40;
        var ce = e.pageX + x;
        if (ce > bo) {
            ce = bo;
        }
        $('#tooltip').css({
            'left': (ce + 'px'),
            'top': (e.pageY + y + 'px')
        }).show();
    });
}

// 验证码
function yzm_img($val) {
        $('.logo-yzm-tow').attr('src', $val +'?id'+ Math.random());
}

// 提交事件
function submit_lay(val) {
    var sub = $('.submit-btn');
    if(val){
        sub.attr('disabled',''); //禁止再次点击
        sub.attr('title','提交中...');
        sub.addClass('submit_jin');
        sub.css('background-color','#eee');
    }else{
        sub.removeAttr('disabled');
        sub.attr('title', '立即提交');
        sub.removeClass('submit_jin');
        sub.css('background-color', '#009688');
    }
}
//生成加载
function submit_bak(val,str='加载中...'){
    if(val){
        $('body').append('<div class="submit_bak_jia"><div class="submit-back"></div> <div class="submit-black" title="加载中..."></div> <div title="加载中..." class="submit-jia"><i class="layui-icon layui-anim layui-anim-rotate layui-anim-loop" style="font-size: 100px; color: #fff;">&#xe63e;</i><p>'+str+'</p></div> </div>');
    }else{
        $('.submit_bak_jia').remove();
    }
}

//跳转页面
function option(val=''){
    if(val!=''){
        window.parent.frames.location.href=val;
    }else{
        window.location.href='';
    }
}


//iframe使用
function page_add(wid, he, user, url) {
    if (wid == '' && he == '') {
        he = "98%";
        wid = "99%";
    }
    var chuan = '&#xE61C;';
    $('body').append('<div class="page">\
             <div class="page-bak"></div>\
                 <div class="page-centet" style="width:200px;height:200px; box-shadow: 1px 1px 50px rgba(0,0,0,.3);">\
                     <div class="page-title"><span class="page-span">'+ user + '</span><i class="iconfont page-qian" lay-tr="1" style="" title="全屏">'+chuan+'</i> <i class="layui-icon page-icon" style="" title="关闭">&#x1006;</i></div>\
                     <div class="page-set" style="width:98%; overflow: hidden;"><iframe  class="iframe" src="" frameborder="0"></iframe></div>\
                 </div>\
             </div>');
        // alert();
    $('.page-qian').click(function(){
        $tr = $(this).attr('lay-tr');
        if($tr==1){
            $('.page-centet').animate({ width: '99%', height: "98%"},300,'',setTimeout(function () {$('.page-centet iframe').attr('src',url)},300));
            $(this).attr('lay-tr','2');
            $(this).attr('title','还原窗口');
            $(this).html('&#xE677;');
            $(this).css({'font-size':'20px','top':'8px'});
        }else{
            $('.page-centet').animate({ width:wid, height: he},300,'',setTimeout(function () {$('.page-centet iframe').attr('src',url)},300));
            $(this).attr('lay-tr','1');
            $(this).attr('title','全屏');
            $(this).html('&#xE61C;');
            $(this).css({'font-size':'14px','top':'12px'});
        }
    });
    $('.page-centet').animate({ width: wid, height: he},300,'',setTimeout(function () {$('.page-centet iframe').attr('src',url)},300));
    $('.page-icon').click(function () {
        setTimeout(function () { $('.page-centet iframe').attr('src','')},50)
        $('.page-centet').animate({ width: '200px', height: '200px' }, 300, '', setTimeout(function () { $('.page').remove()},300));
    });
}

// 删除
function public_del($data=''){
    $('.public-del').click(function(){
        $this = $(this).attr('layui-id');  //id值
        $url = $(this).attr('href'); //地址
        $strx = {id:$this};
        if($data!=''){
            $strx = {id:$this,url:$data};
        }
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.confirm('确定要删除么?', {icon: 3, title:'提示'}, function(index){
                $.post(
                    $url,
                    $strx,
                    function(res){
                        if(res.code==1){
                            layer.msg(res.msg,{icon:1,time:1000},function(){
                                window.location.href="";
                            })
                        }else{
                            layer.msg(res.msg,{icon:5,time:1000})
                        }
                    }
                );
            });
        });  
        
        return false;
    });
    
}

//返回上一页和刷新当前
function shuanx(){
    $('.houtui').click(function(){
        history.go(-1);
        // var url = window.location.href;
        alert(document.referrer);
    });
    $('.shuanx').click(function(){
        window.location.href='';
    });
}


//放大图片
function public_img($val){
    $('body').append('<div class="pub-img">\
    <div class="page-bak pub-bak"></div>\
    <img src="'+$val+'" id="pub-val" />\
    </div>');
    $("img").on("load",function(){
        var w = $(this).width();
        var h = $(this).height();
        var puh = $(window).height();
        var puw = $(window).width();
        if(h>=puh){
            $('#pub-val').css({height:puh-200+'px'});
        }
    });
    $('.pub-bak').click(function(){
        $('.pub-img').remove();
    });
}


// 切换iframe
function public_ifr(){
    $('.index-ifr').click(function(){
        $this = $(this).attr('href');
        $('.iframe').attr('src',$this);
        return false;
    });
}

// 排序
function public_pai(){
    $('.publicpai').click(function(){
        $id = '';
        $val = '';
        $url = $('.publicpai').attr('href'); //地址
        $('.public-pai').each(function(){ //内容以及ID
            $id += $(this).attr('layui-id')+',';  //id值
            $val += $(this).val()+','; //内容
        }); 
        $val = $val.substr(0, $val.length - 1); //删除最后一个
        $id = $id.substr(0, $id.length - 1); //删除最后一个
        // 提交
        layui.use('layer', function(){
            var layer = layui.layer;
            $.post(
                $url,
                {
                    id:$id,val:$val
                },
                function(res){
                    if(res.code==1){
                        layer.msg(res.msg,{icon:1,time:1000},function(){
                            window.location.href="";
                        })
                    }else{
                        layer.msg(res.msg,{icon:5,time:1000})
                    }
                }
            );
        })
       
        // alert($url);
    });
}

//提交信息
function public_post($url,$val,$tiao=''){
    // layui.use('layer', function(){
    //     var layer = layui.layer;
    submit_bak(true);
    submit_lay(true);
        $.post(
            $url,
            $val,
            function(res){
                if(res.code==1){
                    submit_bak(false);
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        option($tiao);
                    })
                }else{
                    layer.msg(res.msg,{icon:5,time:1000});
                    submit_bak(false);
                    submit_lay(false);
                }
            }
        );
    // })
}


//获取到get值
function public_get(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var reg_rewrite = new RegExp("(^|/)" + name + "/([^/]*)(/|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    var q = window.location.pathname.substr(1).match(reg_rewrite);
    if (r != null) {
        return unescape(r[2]);
    } else if (q != null) {
        return unescape(q[2]);
    } else {
        return null;
    }
}


//禁止返回上一页
// function fan_no(){
//     // javascript:window.history.forward(1); 
// }