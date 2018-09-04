$(document).ready(function() {
    var types = $('.groupchoice');
    for (var i = 0; i < types.length; i++) {
        types.eq(i).children('label').click(function(event) {
            $(this).removeClass('tSelect').addClass('tSelect');
            $(this).siblings('label').removeClass('tSelect');
        });
    }

    $("#button").bind('click', process);
    var submitFlag=true;
	var subTimer;
    //直接提交
    function process() {

        var msgAlert = '<div class="dialog"><span id="dialog"></span></div>';

        //验证用户信息
        checkName();
        checkPhone();
        checkAddress();

        //验证姓名
        var userList1 = $(".user_list")[0];
        var userList2 = $(".user_list")[1];
        var userList3 = $(".user_list")[2];
        if (orderName == "") {
            $(".user_msg").append(msgAlert);

            $("#dialog").html(nEmptmsg);
            addilog();
            ChangeColor(userList1);
            //$("input[name=orderName]").focus();
        } else if (!isName.test(orderName)) {
            $(".user_msg").append(msgAlert);
            $("#dialog").html(nErrormsg);
            addilog();
            ChangeColor(userList1);
            //$("input[name=orderName]").focus();
        } else
        //验证手机号
        if (phoneNum == "") {
            $(".user_msg").append(msgAlert);
            $("#dialog").html(pemptmsg);
            addilog();
            ChangeColor(userList2);
            //$("input[name=mobile]").focus();
        } else if (! (phoneNum.length == 11)) {
            $(".user_msg").append(msgAlert);
            $("#dialog").html(perrormsg);
            addilog();
            ChangeColor(userList2);
            //$("input[name=mobile]").focus();
        } else
        //验证地址
        if (orderAddr == "") {
            $(".user_msg").append(msgAlert);
            $("#dialog").html(aEmptmsg);
            addilog();
            ChangeColor(userList3);
            //$("textarea[name=orderAddress]").focus();
            addilog();
        } else if (orderAddr.length <= 3) {
            $(".user_msg").append(msgAlert);
            $("#dialog").html(aEmptmsg);
            addilog();
            ChangeColor(userList3);
            //$("textarea[name=orderAddress]").focus();
        } else {
        	if (submitFlag) {
        		submitFlag = false;
        		document.Form1.submit();
        	} else {
        		if(subTimer){
        			clearTimeout(subTimer);
        		}
        		subTimer=setTimeout(function() {
        			submitFlag = true;
        		},
        		5000);
        	}
        }
    }

    //姓名验证
    var isName, orderName, nEmptmsg, nErrormsg;
    function checkName() {
        isName = /^[\u4E00-\u9FA5]{1,16}$/;
        orderName = $("input[name=orderName]").val();
        nEmptmsg = $("input[name=orderName]").attr("emptmsg");
        nErrormsg = $("input[name=orderName]").attr("errormsg");
    }

    //手机号验证
    var isPhone, phoneNum, pemptmsg, perrormsg;
    function checkPhone() {
        isPhone = /^(13[0-9]|14[0-9]|15[012356789]|18[0-9]|17[678])\d{8}$|^(0\d{2,3}-?|\(0\d{2,3}\))?[1-9]\d{4,7}(-\d{1,8})?$/;
        phoneNum = $("input[name=mobile]").val();
        pemptmsg = $("input[name=mobile]").attr("emptmsg");
        perrormsg = $("input[name=mobile]").attr("errormsg");
    }

    //地址验证
    var orderAddr, aEmptmsg;
    function checkAddress() {
        orderAddr = $("textarea[name=orderAddress]").val();
        aEmptmsg = $("textarea[name=orderAddress]").attr("emptmsg");
    }

    // 边框颜色闪烁
    function ChangeColor(obj) {
        var colors = ['#e2e2e2', 'red', '#e2e2e2', 'red', '#e2e2e2', 'red', '#e2e2e2'];
        var timer = '';
        var ii = 0;
        timer = setInterval(function() {
            obj.style.borderColor = colors[ii];
            ii++;
            if (ii > colors.length) {
                ii = 0;
                clearInterval(timer);
            }
        },
        200);
    }

    //显示对话框
    function addilog() {
        $(".dialog").css({
            position: 'fixed',
            top: '100px',
            left: '0',
            width: '100%',
            textAlign: 'center',
            border: 'none',
            lineHeight: '26px',
            zIndex: '9'
        });
        $("#dialog").css({
            display: 'inline-block',
            padding: '6px 16px',
            borderRadius: '2px',
            color: 'white',
            backgroundColor: 'rgba(0,0,0,.8)',
        });

        $(".dialog").fadeIn().delay(2000).fadeOut(function() {
            $(this).remove();
        });
    }
});