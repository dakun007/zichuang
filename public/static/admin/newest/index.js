/*  
* 技术员：吴坤盛
*　创建时间：2018/8/8　8:00
*
*/
(function(){
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
        ,layer = layui.layer
        ,layedit = layui.layedit
        ,laydate = layui.laydate;

        //日期
        laydate.render({
            elem: '#tive'
        });
        laydate.render({
            elem: '#tive1'
        });
        //    修改
        $('.save').click(function(){
            $this = $(this).attr('layui-id');
            page_add('40%','99%','修改','/admin/newest/save_bak.html?id='+$this);
        });
        //    预览页面
        $('.yulan').click(function(){
            $url = $(this).attr('href');
            window.open($url);
            return false;
        });
        //    删除
        public_del();
    });
})();