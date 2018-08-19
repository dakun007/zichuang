/*  
* 技术员：吴坤盛
*　创建时间：2018/8/7　10:29
*
*/

(function(){
    layui.use(['form'], function () {
        var form = layui.form;
        //    删除
        public_del();
        //    修改
        $('.save').click(function () {
            $this = $(this).attr('layui-id');
            page_add('99%','50%','修改','/admin/admin/save_bak.html?id='+$this)
        });

        //添加
        $('.add').click(function(){
            page_add('99%','50%','添加','/admin/admin/add.html')
        });
    })
})();