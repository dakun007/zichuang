// JavaScript Document
$(function() {
	//app隐藏
  	$("#zcmp-app").hide();
  	//图片延迟加载  
  	$("img").lazyload({
    	effect:"fadeIn",
    	threshold:"1000",
    	failure_limit:"10",
  	});
});

//页面加载
window.onload=function(){
	percent();
	goHere();
	//获取时间点 
    var curtime = new Date();
    var endtime = new Date($("input[name=endTime]").val());//endTime
    var leftime = Math.floor((endtime.getTime()-curtime.getTime())/1000);
    timed(leftime);
    //毫秒显示效果
	ms();		 
}

//百分比
function percent(){
  //获取时间点
  var curtime = new Date();
  var curhour=curtime.getHours();
  var base=0,range=0;
  var percent   = document.getElementById("percentNum");
  var progress  = document.getElementById("progress");
  var soldNum  = document.getElementById("soldNum");
    if(curhour<=4){
      base=60;range=5;
      }else
    if(curhour<=8){
      base=60;range=10;
      }else
    if(curhour<=12){
      base=60;range=15;
      }else
    if(curhour<=16){
      base=70;range=10;
      }else
    if(curhour<=20){
      base=80;range=15;
      }else
    if(curhour<24){
      base=90;range=9;
      }
    var opercent=Math.floor(Math.random()*range+base);
    progress.style.width = percent.innerHTML = opercent+"%";
    soldNum.innerHTML=Math.round(502537*opercent/100);
}

function goHere(){
	$(".conbtn").click(function(){
		var a = $(".buy-Title").offset().top;
		$("html,body").animate({scrollTop:a},0);
	});
}

//倒计时
function timed(leftime){
	    window.setInterval(function(){
	    var day=0,
		    hour=0,
		    minute=0,
		    second=0;	
	    if(leftime > 0){
		    day = Math.floor(leftime / (60 * 60 * 24));
		    hour = Math.floor(leftime / (60 * 60)) - (day * 24);
		    minute = Math.floor(leftime / 60) - (day * 24 * 60) - (hour * 60);
		    second = Math.floor(leftime) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
	    }
	    if (hour   <= 9) hour = "0" + hour;
	    if (minute <= 9) minute = "0" + minute;
	    if (second <= 9) second = "0" + second;
		document.getElementById("h").innerHTML=hour;
		document.getElementById("m").innerHTML=minute;
		document.getElementById("s").innerHTML=second;
	    leftime--;
	    }, 1000);
}

//毫秒效果
function ms(){
	var ms=9;
	window.setInterval(function(){
		if(ms<0){
			ms=9;
			}else{
				document.getElementById("ms").innerHTML=ms;
				ms--;
				}
		},100);
	}