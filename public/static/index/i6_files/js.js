$(function(){

    $('.submit_btn').click(function(){

        $wfprovince = $(".wfprovince").val()+'-'+$(".wfcity").val()+'-'+$(".wfarea").val()+'，'+ $(".addr_info").val(); //选择地址地址
        if($('input[name=username]').val()==''){
          alert('请输入姓名');
            return false;
        }
        if($('input[name=tel]').val()==''){
          alert('请输入手机号');
            return false;
        }
        if($(".wfprovince").val()+'-'+$(".wfcity").val()+'-'+$(".wfarea").val()=='' || $(".addr_info").val()==''){
           alert('请选择地址和填写详情地址');
           return false;
        }
        $('input[name=addr]').val($wfprovince);
        var params = jQuery("form").serialize().replace(/\+/g," ");
        params = decodeURIComponent(params, true);
        $.post(
            '/index/goods/order.html',
            params,
            function(res){
                if(res.code==1){
                    alert(res.msg);
                    localStorage.rel=2;
                    window.location.href=''
                }else{
                    alert(res.msg);
                }
            }
        );
        return false;
    });

//
    $('.kai').click(function(){
       alert('即将开始');
    });
    $('.jie').click(function(){
        alert('已结束');
    });

    
})

window.onload=function (){

    if(localStorage.rel!=2){
        alert('恭喜您获得一次iPhone 8 Plus 秒杀价！');
    }else{
        localStorage.rel='';
    }


}