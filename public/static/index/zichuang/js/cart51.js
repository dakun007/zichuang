// JavaScript Document
var o_sumpay="0";
window.onload=function(){
	//非会员隐藏优惠券
	if($("input[name=isReg]").val()=="0"){
		$(".coupon-wrap").hide();
		}
	discoulist();//优惠券更新
	o_sumpay=$(".cart-total .sumpay").html().split("¥")[1];
	getCartInfo();
	asEvent();
	cancle();
	getInfor();
	//提交
	$(".btn").click(function(){
		//登录状态
		if($(this).attr("href")=="javascript:;"){
		    //获取输入信息
		    checkName();
		    checkPhone();
		    checkAddress();
		    //验证姓名
		    //if(orderName==""){
			//    $("body").append(Div_bg,Div_ts);
			//    $(".dialog span").html(nEmptmsg);
			//    addilog();
			//    $("input[name=orderName]").focus();	
		    //}else 
		    //if(!isName.test(orderName)){
			//    $("body").append(Div_bg,Div_ts);
			//    $(".dialog span").html(nErrormsg);
			//    addilog();
			//    $("input[name=orderName]").focus();
		    //}
		    //else
		    //验证手机号
		    if(phoneNum==""){
			    $("body").append(Div_bg,Div_ts);
			    $(".dialog span").html(pemptmsg);
			    addilog();
			    //$("input[name=mobile]").focus();	
		    }
		    else
		    if(!(isPhone.test(phoneNum))||!(phoneNum.length==11)){
			    $("body").append(Div_bg,Div_ts);
			    $(".dialog span").html(perrormsg);
			    addilog();
			    //$("input[name=mobile]").focus();
		    }
		    //else
		    //验证地址
		    //if(orderAddr==""){
			//    $("body").append(Div_bg,Div_ts);
			//    $(".dialog span").html(aEmptmsg);
			//    addilog();
			//    $("textarea[name=orderAddress]").focus();	
		    //}
		    else{
			    __doPostBack();//成功提交
			    }
		}else{}
    });
}


//优惠券的显示
function discoulist(){
	var user_userInfo=$("input[name=user_userInfo]").val();
	var totalM=$(".totalM").html().split("¥")[1];
	if(user_userInfo!=""||user_userInfo!=null){
		var usefeenum=$("input[name=usefeenum]");
		$("input[name=usefeenum]").each(function(i) {
            if(Number(totalM)>=Number(this.value)){
				$(this).parent().show();
			}else{
				$(this).parent().hide();
				}
        });
	}
}


//姓名验证
var isName,orderName,nEmptmsg,nErrormsg;
function checkName(){
	isName=/^[\u4E00-\u9FA5]{1,16}$/;
	orderName= $("input[name=orderName]").val();
	nEmptmsg=$("input[name=orderName]").attr("emptmsg");
	nErrormsg=$("input[name=orderName]").attr("errormsg");
}

//手机号验证
var isPhone,phoneNum,pemptmsg,perrormsg;
function checkPhone(){
	isPhone= /^(13[0-9]|14[0-9]|15[012356789]|18[0-9]|17[678])\d{8}$|^(0\d{2,3}-?|\(0\d{2,3}\))?[1-9]\d{4,7}(-\d{1,8})?$/;
	phoneNum = $("input[name=mobile]").val();
	pemptmsg=$("input[name=mobile]").attr("emptmsg");
	perrormsg=$("input[name=mobile]").attr("errormsg");
}

//地址验证
var orderAddr,aEmptmsg;
function checkAddress(){
	orderAddr= $("textarea[name=orderAddress]").val();
	aEmptmsg=$("textarea[name=orderAddress]").attr("emptmsg");
}

//提示框
var Div_bg='<div class="backdrop-w hide"></div>';
var Div_ts='<div class="dialog hide"><span></span></div>';

//显示对话框
function addilog(){
	 var ml=Math.floor(($(".dialog").width()+40)/2);
		$(".dialog").css({'margin-left':"-"+ml+"px"});
		$(".backdrop-w").fadeIn().delay(2000).fadeOut(function(){$(this).remove();});
		$(".dialog").fadeIn().delay(2000).fadeOut(function(){$(this).remove();});
	 }


//获取购物车参数
function getCartInfo(){
  var cartInfo = $("input[name=cartInfo]").val();
  var sCart = cartInfo.split(",");
    if(sCart[0]>0){
      sCD_init(sCart[1]);
      sCountDown(sCart[1]);
    }
}

var selcet,opertype,modi="modi",del="del",num,style,obj,id,product;
//加减事件
function asEvent(){
	var lista=$(".amount-c a");
	for(var i=0;i<lista.length;i++){
		lista[i].onclick=function () {
			var aClassName=$(this).attr("class");
			var getSpan=$(this).siblings("span");
			style=getSpan.attr("style");
			obj=getSpan.attr("obj");
			id=getSpan.attr("id");
			var addnum=parseInt(getSpan.html())+1;
			var subnum=parseInt(getSpan.html())-1;
			switch (aClassName) {
				case 'add':
					  getSpan.html(addnum);
					  AS(modi,addnum,style,obj,id);
					  break;
				case 'sub':
					if(getSpan.html()>1){
					  getSpan.html(subnum);
					  AS(modi,subnum,style,obj,id);
					}
					else if(getSpan.html()<=1){
						}
					  break;
				default:
					  break;
			}
		}
	}
}

//删除事件
function cancle(){
	var cancle=$(".cancle");
	for(var i=0;i<cancle.length;i++){
		cancle[i].onclick=function(){
			$("body").append(Div_b,Div_c);
			$(".backdrop").fadeIn();
			$(".cancle-dialog").fadeIn();
			var camount=$(this).siblings(".list-info").find(".amount");
			product=$(this).parent().parent();
			num=camount.html();
			style=camount.attr("style");
			obj=camount.attr("obj");
			id=camount.attr("id");
		}
	}
}

//加减删信息提交
function AS(opertype,num,style,obj,id){
	post_infor(opertype,num);
}

//提交信息
//获取购物车信息
var str,s,totalM,favor,freight,sumpay,save;
function post_infor(opertype,num){
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var str = xmlhttp.responseText;
		var s=str.split(",");
		totalM = s[2];
		favor  = s[3];
		freight= s[4];
		sumpay = s[5];
		save   = s[6];
		onlineReduceVal = s[8];
		  if(s[0]>0){
		    sCD_init(s[1]);
		    sCountDown(s[1]);
			onlinediscount();//在线优惠
			discoulist();//优惠券更新
		  } else{

		  }
		}
	  } 
	xmlhttp.open("POST","/a/postUserCart.ashx?oper=postmodifyEX&opertype="+opertype+"&obj="+obj+"&contentID="+id+"&num="+num+"&style="+style,true);
	xmlhttp.send();
}

var getsave,getsumpay;
function getInfor(){
	getsave=$(".save").html().split("¥")[1].replace(/\D+/g,"");
	getsumpay=$(".sumpay").html().split("¥")[1];
}

$(document).on("click",'#payReceive',function(){
	getInfor();
	$(".save").html("¥"+getsave);
	$(".cart-total .sumpay").html("¥"+getsumpay);
});

$(document).on("click",'#payWeiXin',function(){
	onlineselect();
});

$(document).on("click",'#payAlipay',function(){
	onlineselect();
});

$(document).on("click",'#payCard',function(){
	onlineselect();
});

function onlineselect(){
	var onlinediscount=parseInt($("input[name=onlinediscount]").val());
	var save=parseInt($(".save").html().split("¥")[1]);
	if(onlinediscount!="0" && onlinediscount!="" && onlinediscount!=undefined){
		$(".save").html("<span style='display:none;'>¥"+save+" + ¥"+onlinediscount+"=</span>"+"¥"+(save+onlinediscount));
		//$(".save").html(" ¥"+(save+onlinediscount)+"<span></span>");
		$(".cart-total .sumpay").html("¥"+$(".sumpay").html().split("¥")[1]+"<span> - </span>¥"+onlinediscount+" = "+($(".sumpay").html().split("¥")[1]-onlinediscount));
	}
}

function onlinediscount(){
	$("input[name=onlinediscount]").val(onlineReduceVal);
	var onlinediscount=$("input[name=onlinediscount]").val();
	var onlineDisc=document.getElementsByClassName("onlineDisc");
	for(var i=0;i<onlineDisc.length;i++){
		onlineDisc[i].innerHTML="立减"+onlineReduceVal+"元";
	}
	if(onlinediscount!="0" && onlinediscount!="" && onlinediscount!=undefined){
		if($('input:radio[name="pay"]:checked').val()!="0"){
			$(".totalM").html("¥"+totalM);
			$(".favor").html("¥"+favor);
			$(".count .sumpay").html("¥"+(totalM-favor));
			$(".freight").html("¥"+freight);
			if(freight>0){$(".postage").html("购物满39元，即可免运费");}
				else{$(".postage").html("本单已免运费");}
			$(".save").html("¥"+(parseInt(save)+parseInt(onlinediscount)));
			$(".cart-total .sumpay").html("¥"+sumpay+"<span> - </span>¥"+onlinediscount+" = "+(sumpay-onlinediscount));
		}else{
			showTotalInfor();
		}
	}else{
		showTotalInfor();
	}
}

function showTotalInfor(){
	$(".totalM").html("¥"+totalM);
	$(".favor").html("¥"+favor);
	$(".count .sumpay").html("¥"+(totalM-favor));
	$(".freight").html("¥"+freight);
	if(freight>0){$(".postage").html("购物满39元，即可免运费");}
		else{$(".postage").html("本单已免运费");}
	$(".save").html("¥"+save);
	$(".cart-total .sumpay").html("¥"+sumpay);
}

//购物倒计时
//初始化
var ls;
function sCD_init(leftSecond){
	window.clearInterval(ls);
    if(leftSecond>0){
    var minutes=0,
      seconds=0//时间默认值  
    minutes = Math.floor(leftSecond/60);
    seconds = Math.floor(leftSecond%60);
    if (minutes <= 9) minutes = "0" + minutes;
    if (seconds <= 9) seconds = "0" + seconds;
    $(".count-time").html(minutes+":"+seconds);
  }
}
function sCountDown(leftSecond){  
  if(leftSecond>0){
	    ls =setInterval(function(){
		var minutes=0,
			seconds=0//时间默认值	
		minutes = Math.floor(leftSecond/60);
		seconds = Math.floor(leftSecond%60);
		if (minutes <= 9) minutes = "0" + minutes;
		if (seconds <= 9) seconds = "0" + seconds;
		$(".count-time").html(minutes+":"+seconds);
		leftSecond--;
		if(leftSecond<0) {
			alert("亲，时间已过，请重新选购吧！");
			window.clearInterval(ls);
			window.location.href="/user/order_T.aspx";
			};
	}, 1000);   
  }else{
	alert("亲，时间已过，请重新选购吧！");
	window.clearInterval(ls);
	window.location.href="/user/order_T.aspx";
  } 
}

//删除对话框
var Div_b = '<div class="backdrop hide"></div>';
var Div_c = '<div class="cancle-dialog hide"><div class="h-d"><p style="text-align:center;">你要删除该商品吗？</p></div><div class="c-d"><a class="d-cancle" href="javascript:;">取消</a><a class="d-remove" href="javascript:;">删除</a></div></div></div>';
//取消
$(document).on("click",'.d-cancle',function(){
	$(".backdrop").fadeOut(function(){
		$(this).remove();
		});
	$(".cancle-dialog").fadeOut(function(){
		$(this).remove();
		});
	});
//删除商品
$(document).on("click",'.d-remove',function(){
	AS(del,num,style,obj,id);
	product.remove();
	$(".backdrop").fadeOut(function(){
		$(this).remove();
		});
	$(".cancle-dialog").fadeOut(function(){
		$(this).remove();
		});
	judge()
});
//判断为空
function judge(){
	var pLength=$(".product").length;
	if(pLength>0){
		}
	else{
		window.location.href="/user/order_T.aspx";
		}
}

//优惠券部分
var u_c_value="0";//优惠金额
//显示可用优惠券列表
$(document).on("click",'#choose-coupon',function(){
	if($(this).attr("href")=="javascript:;"){
			$(".header").hide("fast");
			$(".goods-info").hide("fast");
			$(".use-coupon-wrap").show();
			document.getElementsByTagName('body')[0].scrollTop = 0;
	}else{}
	});
//点击优惠券
$(document).on("click",'.coupon-part',function(){
	u_c_value=$(this).children("input[name=u_c_value]").val();
	$(".coupon-part").children("div.u-c-back").removeClass("u-c-select");
	$(this).children("div.u-c-back").addClass("u-c-select");
	$(".coupon-part").removeClass("c_p_select");
	$(this).addClass("c_p_select");
	});
//再次点击已选优惠券，撤销选中
$(document).on("click",'.c_p_select',function(){
	$(".c_p_select").removeClass("c_p_select");
	u_c_value="0";
	$(".coupon-part").children("div.u-c-back").removeClass("u-c-select");
	});
//关闭按钮	
$(document).on("click",'.close-btn',function(){
	$(".use-coupon-wrap").hide();
	$(".header").show("fast");
	$(".goods-info").show("fast");
	});
//点击确定
$(document).on("click",'.u-c-btn',function(){
	//传值部分
	if(u_c_value=="0"){//如果未选优惠券直接跳出
		$("#choose-coupon").html('优惠券');
		$(".coupon").html("¥0");
		$(".cart-total .sumpay").html("¥"+o_sumpay);
		$(".use-coupon-wrap").hide();
		$(".header").show("fast");
		$(".goods-info").show("fast");
		}
		else{//已选优惠券，传值
		    var userID=document.getElementById('userID').value;
		    var CouponID=$(".u-c-select").siblings("input[name=CouponID]").val();
		    postUserID(userID,CouponID); 
		}
	});	


function getReturnValue(){
   var xmlhttp;
   if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          var returnValue = xmlhttp.responseText;
          var s=returnValue.split(",");
          totalM = s[2];
		  favor  = s[3];
		  freight= s[4];
		  sumpay = s[5];  //获取返回的订单应付金额
		  save   = s[6];  //获取节省金额
		  coupon = s[7];  //获取返回的优惠券值
		  if(s[0]>0){
		    $("#choose-coupon").html('<span class="c-c-title">优惠券</span><span class="c-c-coupon">-￥'+coupon+'</span>');
		    $(".coupon").html("¥"+coupon);//获取返回的优惠券值
			$(".totalM").html("¥"+totalM);
			$(".favor").html("¥"+favor);
			$(".count .sumpay").html("¥"+(totalM-favor));
			$(".freight").html("¥"+freight);
			if(freight>0){$(".postage").html("购物满39元，即可免运费");}
				else{$(".postage").html("本单已免运费");}
			$(".save").html("¥"+save);
			$(".cart-total .sumpay").html("¥"+sumpay);
          } else{}        
		  //效果  
		  $(".use-coupon-wrap").hide();
		  $(".header").show("fast");
		  $(".goods-info").show("fast");
        }
      }  
    xmlhttp.open("POST","../a/postUserCart.ashx?oper=getcartallinfo",true);
    xmlhttp.send();
}

function postUserID(uid,cid){
   var xmlhttp;
   if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          var returnValue = xmlhttp.responseText;
          if(returnValue=="成功"){
          	getReturnValue();
          }else{
          	alert("未选优惠券");
          }
        }
      }  
    xmlhttp.open("POST","../user/User_UseCoupon.ashx?userID="+uid+"&CouponID="+cid,true);
    xmlhttp.send();
}