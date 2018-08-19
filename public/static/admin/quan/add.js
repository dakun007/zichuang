/*
* 技术员：吴坤盛
*　创建时间：2018/8/13　2:56
*
*/

(function(){
    layui.use('form', function(){
        var form = layui.form;

        form.on('radio(jibie)', function (data) {
            $this = data.value;
            if($this == 1){
                $('.erji,.sanji').css('display','none');
                $('.name').css('display','none');
            }else if($this == 2){
                $('.sanji').css('display','none');
                $('.erji').css('display','block');
                $('.name').css('display','block');
            }else if($this == 3){
                $('.sanji').css('display','block');
                $('.erji').css('display','none');
                $('.name').css('display','block');
            }
        });

        //监听提交
        form.on('submit(demo1)', function(data){
            // layer.msg(JSON.stringify(data.field));
            $url = $('form').attr('action');
            public_post($url,data.field,window.parent.location)
            return false;
        });
    });
})();