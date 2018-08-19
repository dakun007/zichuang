/*
* 技术员：吴坤盛
*　创建时间：2018/8/10　16:53
*
*/
(function(){
    layui.use('form', function(){
        var form = layui.form;

        // 监听提交
        form.on('submit(demo1)', function(data){
            $url = $('form').attr('action');
            public_post($url,data.field,'/admin/level/index.html')
            return false;
        });
    });
})();