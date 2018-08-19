(function () {
    layui.use('form', function(){
        var form = layui.form;
        // 监听提交
        form.on('submit(formDemo)', function(data){

            $form = $('form').attr('action'); //获取地址
            public_post($form,data.field,'/admin/goods/subg.html?id='+localStorage.subg);
            return false;
        });
    });
})();