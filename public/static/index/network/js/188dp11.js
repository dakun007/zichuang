$(document).ready(function(){
    //Form
    var pId = $("input[name=productInfor]").attr("pId");
    document.getElementById("Form1").action="/user/order_T.aspx?obj=allobj&contentID="+pId;
    //商品名称
    var productTitle = $("input[name=productInfor]").attr("title");
    document.title=productTitle;
    $(".headerTitle").html(productTitle);
    //主图
    for(var i=0;i<mainImgs.length;i++){
        $(".swiper-wrapper").append("<div class='swiper-slide'><img src='"+mainImgs[i]+"'/></div>");
    }
    //轮播
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        loop : true,
        grabCursor: true,
        autoplay : 3000,
        autoplayDisableOnInteraction: false
    });
    //商品信息
    var productTitle = $("input[name=productInfor]").attr("title");
    var productPrice = $("input[name=productInfor]").attr("price");
    var Discount = $("input[name=productInfor]").attr("discount");
    var actMes = $("input[name=actMes]").val();
    var buyNums = $("input[name=buyNums]").val().split(",");
    $(".productTitle")[0].innerHTML=$(".proSelectTit")[0].innerHTML=productTitle;
    $(".price")[0].innerHTML=$(".selectPrice")[0].innerHTML=productPrice;
    $(".oldPrice").html(Math.ceil(productPrice/Discount*10));
    $(".discount").html(Discount+"折");
    $(".buyNumber").html(buyNums[0]);
    $("#percentNum").html(buyNums[1]);
    $(".actMes").html(actMes);
    $("input[name=childID00]").val(pId);
    //百分比条
    $('.percentFill').width($("#percentNum").html()+"%");
    //倒计时
    timeDown();
    //smallImg
    $(".selectImg").attr("src",smallImgs[0]);
    //sku1信息
    var productSku1 = $("input[name=productSku]").attr("sku1").split(",");
    $('.skuItem1').html(productSku1[1]);
    $('.skuMsg1').html(productSku1[0]);
    for(var i=1;i<productSku1.length;i++){
        if(productSku1[i]==""){
            ;
        }else{
            if(i==1){
                $(".skuList1 .skuListItem").append("<a href='javascript:;' class='skuItem select' onclick='styleSelect(this,1)' title='"+productSku1[i]+"'>"+"<input type='radio' name='radiogroup_00_01' value='1' checked>"+productSku1[i]+"</a>");
            }else{
                $(".skuList1 .skuListItem").append("<a href='javascript:;' class='skuItem' onclick='styleSelect(this,1)' title='"+productSku1[i]+"'>"+"<input type='radio' name='radiogroup_00_01' value='"+i+"'>"+productSku1[i]+"</a>");
            }
        }
    }
    //sku2信息
    var sku2 = $("input[name=productSku]").attr("sku2");
    if(typeof(sku2)!="undefined"){
        var productSku2 = sku2.split(",");
        $(".skuGap").html("-");
        $(".skuItem2").html(productSku2[1]);
        $('.skuMsg2').html(productSku2[0]);
        for(var i=1;i<productSku2.length;i++){
            if(productSku2[i]==""){
                ;
            }else{
                if(i==1){
                    $(".skuList2 .skuListItem").append("<a href='javascript:;' class='skuItem select' onclick='styleSelect(this,2)' title='"+productSku2[i]+"'>"+"<input type='radio' name='radiogroup_00_02' value='1' checked>"+productSku2[i]+"</a>");
                }else{
                    $(".skuList2 .skuListItem").append("<a href='javascript:;' class='skuItem' onclick='styleSelect(this,2)' title='"+productSku2[i]+"'>"+"<input type='radio' name='radiogroup_00_02' value='"+i+"'>"+productSku2[i]+"</a>");
                }
            }
        }
    }
});

window.onload=function(){
    //底部-回到顶部
    document.getElementById("goTop").onclick = function(){
        $('body,html').animate({scrollTop:0},500);
    }
    //底部-立即购买
    $(".btnBottom").click(function(){
        var scroll_offset = $(".proSelecthead").offset();
        $("body,html").animate({
            scrollTop:scroll_offset.top
        },500);
    });
    //订单提交
    var submitButton = document.getElementById("btn");
    submitButton.onclick=function () {
        var name = $("input[name=username]").val();
        var mobile = $("input[name=tel]").val();
        var address = $("input[name=addr]").val();
        if(name == ""){
            //alert("请输入您的姓名！");
            tips("请输入您的姓名！");
            return false;
        }else
        if(mobile == ""){
            //alert("请输入您的手机号！");
            tips("输入您的手机号！");
            return false;
        }else if(!(mobile.length==11)){
            //alert("请输入11位手机号码！");
            tips("请输入11位手机号码！");
            return false;
        }else if(address==''){
            tips("请输入详情地址！");
            return false;
        }else{
            var params = jQuery("form").serialize().replace(/\+/g," ");
            params = decodeURIComponent(params, true);
            $.post(
                '/index/goods/order.html',
                params,
                function(res){
                    if(res.code==1){
                        alert(res.msg);
                        window.location.href=''
                    }else{
                        alert(res.msg);
                    }
                }
            );
            // document.getElementById("Form1").submit();
        }
    }
    //详情图
    for(var i=0;i<detailImgs.length;i++){
        $(".imgList").append("<img src='"+detailImgs[i]+"'/>");
    }
}

function styleSelect(obj,style){
    //款式选择
    $(obj).children("input").prop("checked", true);
    $(obj).addClass("select").siblings().removeClass("select");
    var selectIndex = $(obj).index();
    var title = $(obj).attr("title");
    if(style==1){
        $(".skuItem1").html(title);
        $(".selectImg").attr("src",smallImgs[selectIndex]);
    }else{
        $(".skuItem2").html(title);
    }
    $('input[name=style]').val(title);
}

//倒计时
function timeDown(){
    if(localStorage.initime=='' || localStorage.initime<=1 || localStorage.initime=='NaN'){
        initime = 1800;
        localStorage.initime = initime;
    }else{
        initime = localStorage.initime;
    }
    
    var timer = setInterval(function(){
        var day = 0, hour = 0, minute = 0, second = 0;
        if(initime > 0){
            day = Math.floor(initime / (60 * 60 * 24));
            hour = Math.floor(initime / (60 * 60)) - (day * 24);
            minute = Math.floor(initime / 60) - (day * 24 * 60) - (hour * 60);
            second = Math.floor(initime) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
        }
        if(day <= 9) day = '0' + day;
        if (hour <= 9) hour = '0' + hour;
        if (minute <= 9) minute = '0' + minute;
        if (second <= 9) second = '0' + second;
        $('#day').html(day);
        $('#hour').html(hour);
        $('#minute').html(minute);
        $('#second').html(second);
        initime--;
        localStorage.initime = initime;
        var buyNums = $("input[name=buyNums]").val().split(",");
    },1000);
    var second_hao = 0;
    window.setTimeout(function(){
        window.setInterval(function() {
            ++second_hao;
            if(second_hao>9){
                second_hao=0;
            }
            $('#second_hao').html(second_hao);
        },100)
    },1000);
}

//提示
function tips(tipsMsg){
    var tipsContent = "<div class='tips'>"+tipsMsg+"</div>";
    if($('div').is('.tips')){
        $('.tips').remove();
    }
    $('body').append(tipsContent);
    $('.tips').delay(3000).fadeOut();
}