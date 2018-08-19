/*  
* 技术员：吴坤盛
*　创建时间：2018/8/7　10:31
*
*/
(function(){
    layui.use(['form'], function () {
        var form = layui.form;

        form.on('submit(formDemo)', function(data){
            $url = $('form').attr('action');
            public_post($url,data.field,'/admin/admin/index.html');
            return false;
        });

    })
})();