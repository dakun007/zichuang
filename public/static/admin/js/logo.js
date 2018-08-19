layui.use(['form', 'layedit', 'laydate'], function () {
    var form = layui.form
        , layer = layui.layer
        , layedit = layui.layedit
        , laydate = layui.laydate;
    // console.info(form.on('submit(demo1)'));
    // 自定义验证规则
    form.verify({
        title: function (value) {
            if (value == '') {
                return '用户名称不能为空';
            }
        },
        pass: function (value) {
            if (value == '') {
                return '密码不能为空';
            }
        },
        yzm: function (value) {
            if (value.length != 4) {
                return '请输入四位数验证码';
            }
        },
    });
    //
    yzm_img('/admin/yzm/index.html');
    //监听提交
    form.on('submit(demo1)', function (data) {
        submit_lay(true);
        submit_bak(true);
        $.post(
            '/admin/logo/logo.html',
            data.field,
            function(res){
                if(res.code==1){
                    submit_bak(false);
                    layer.msg(res.msg,{icon:1,time:1000},function(){
                        window.location.href='/admin/index/index.html';
                    })
                }else{
                    layer.msg(res.msg,{icon:5,time:1000});
                    submit_bak(false);
                    submit_lay(false);
                    yzm_img('/admin/yzm/index.html');
                }
            }
        );
        return false;
    });

});