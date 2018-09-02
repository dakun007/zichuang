(function(){
    layui.use(['form'], function () {
        var form = layui.form;

        form.on('submit(demo1)', function(data){
            $url = $('form').attr('action');
            public_post($url,data.field,'/admin/kuai/index.html');
            return false;
        });

    })
})();