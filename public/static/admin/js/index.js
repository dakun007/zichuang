layui.use('element', function () {
    var element = layui.element;

    // 
    title();

    //切换iframe
    public_ifr();
    // 
    $('#iconfont').click(function () {
        var youlan = $(window).width();
        if ($('#black').css('left') == '-200px') {
            
            if (youlan < 1260) {
                $('.header-bak').remove();
                // alert(youlan);
                $('.layui-body').append('<div class="header-bak"></div>');
                $('#black').css({ 'z-index': 1002 });
                $('.header-top').css('display', 'none');
                $('.layui-body').animate({ left: '0' }, 0);
                $('.layui-footer').animate({ left: '0' }, 0);
                $('#black').animate({ left: '0px' }, 200);
                $('.layui-logo').animate({ left: '0px' }, 200);
                $('.header-bak').click(function () {
                    open();
                });
            }else{
                shut();
            }
        } else {
            open();
        }
    });
    $(window).resize(function () {          //当浏览器大小变化时
        var youlan = $(window).width();
        var hei = $(window).height();
        // alert();          //浏览器时下窗口可视区域高度
        if (youlan < 1260) {
            open();
        }
        if (youlan > 1260) {
            shut();
        }
    });

    function open() {
        $('.header-top').animate({ left: '0px' }, 200);
        $('.layui-logo').animate({ left: '-200px' }, 200);
        $('#black').animate({ left: '-200px' }, 200);
        $('.layui-body').animate({ left: '0' }, 200);
        $('.layui-footer').animate({ left: '0' }, 200);
        $('.header-bak').remove();
        $('.header-top').css('display', 'block');
    }
    function shut() {
        $('.header-bak').remove();
        $('#black').animate({ left: '0px' }, 200);
        $('.layui-logo').animate({ left: '0px' }, 200);
        $('.header-top').animate({ left: '200px' }, 200);
        $('.layui-body').animate({ left: '200px' }, 200);
        $('.layui-footer').animate({ left: '200px' }, 200);
        $('.header-top').css('display', 'block');
    }

    $('.baijin').click(function(){
        $this = $(this).index('.baijin');
        if($this != 0){
            $('.layui-body').css('background','#fff');
        }else{
            $('.layui-body').css('background', '#f5f5f5');
        }
    });
    

});