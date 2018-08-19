$(function(){
        //图片懒加载
     
        $('#back_top').click(function(){
            $('body').scrollTop(0);
        });
    });
$('#smaller_one .l_check').click(function(){
    $(this).addClass('check_active').siblings('.l_check').removeClass('check_active');
});

//购买跳转
function reLink() {
	$('html,body').scrollTop($('#big-counter').offset().top - 40);
}
        /*时间导航*/
        //验证日期
    function IsValidDate(y, m, d) {
        var date = new Date(y, m - 1, d);
        return date.getFullYear() == y && date.getMonth() == (m - 1)
            && date.getDate() == d;
    }
function getMonthMaxDay(year, month) {
    var day = new Date(year, month, 0);
    return day.getDate();
}
function showtime() {
    var myDate = new Date();
    var y = myDate.getFullYear();
    var m = myDate.getMonth() + 1;
    var d = myDate.getDate();
    var ym;
    var tm;
    $(".time-date").each(function(index, object) {
        tm = m - 2 + index;
        if (tm > 12) {
            tm = tm - 12;
            ym = y + 1;
        } else {
            ym = y;
        }
        if (IsValidDate(ym, tm, d)) {
            $(object).html(tm + "-" + d);
        }
    });
}
/*时间导航*/

/**
 * 倒计时
 */
function timer(intDiff) {
    window.setInterval(function() {
        if(localStorage.intDiff=='' || localStorage.intDiff<=1 || localStorage.intDiff=='NaN'){
            intDiff = 1800;
            localStorage.intDiff = intDiff;
        }else{
            intDiff = localStorage.intDiff;
        }
        
        var day = 0, hour = 0, minute = 0, second = 0;//时间默认值
        if (intDiff > 0) {
            day = Math.floor(intDiff / (60 * 60 * 24));
            hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
            minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
            second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
        }
        if (minute <= 9)
            minute = '0' + minute;
        if (second <= 9)
            second = '0' + second;
        $('#hour_show').html('<s id="h"></s>' + hour + '时');
        $('#minute_show').html('<s></s>' + minute + '分');
        $('#second_show').html('<s></s>' + second + '秒');
        if(minute<=25){
            $('.baid-ya').css('width','90%');
            $('.baid').html('90%');
        }else if(minute<=28){
            $('.baid-ya').css('width',' 80%');
            $('.baid').html('80%');
        }else if(minute<=29){
            $('.baid-ya').css('width',' 75%');
            $('.baid').html('75%');
        }else if(minute==30){
            $('.baid-ya').css('width','70%');
            $('.baid').html('70%');
        }
        $('.yan').css('color','red');
        intDiff--;
        localStorage.intDiff = intDiff;
    }, 1000);

    var second_hao = 0;
    window.setTimeout(function(){
        window.setInterval(function() {
            ++second_hao;
            if(second_hao>9){
                second_hao=0;
            }
            $('#second_hao').html('<s></s>' + second_hao);
        },100)
    },1000);

}

/*进度条*/
var initwidth1 = 50, initwidth2 = 60;//初始进度条的长度,最大100
function progressbar() {
    var pbr1 = Math.round(Math.random() * 5);//随机0~5
    var pbr2 = Math.round(Math.random() * 5);//随机0~5
    initwidth1 = initwidth1 + pbr1, initwidth2 = initwidth2 + pbr2;
    $(".progress-bar").each(function(index, obj) {
        if (index == 0 && initwidth1 < 98) {
            $(obj).css("width", initwidth1 + "%");
        } else if (index == 1 && initwidth2 < 98) {
            $(obj).css("width", initwidth2 + "%");
        } else {
            $(obj).css("width", "98%");
        }

    });
}

/*进度条*/

/*评论滚动*/
var speeds = 60; /*控制滚动速度*/
var wffahuo = document.getElementById('wffahuo');
var wffahuo1 = document.getElementById('wffahuo1');
var wffahuo2 = document.getElementById('wffahuo2');
wffahuo2.innerHTML = wffahuo1.innerHTML;
function Marquee1() {
    if (wffahuo2.offsetHeight - wffahuo.scrollTop <= 0) {
        wffahuo.scrollTop -= wffahuo1.offsetHeight;
    } else {
        wffahuo.scrollTop++;
    }
}
var MyMar1 = setInterval(Marquee1, speeds);
/*评论滚动*/

$(function() {
    showtime();
    //var intDiff = parseInt(1800);//倒计时总秒数量
    timer();
});