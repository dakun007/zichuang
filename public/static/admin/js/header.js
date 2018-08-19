(function(){
    wid();
    $(window).resize(function () {          //当浏览器大小变化时
        wid();
    });

    function wid() {
        var youlan = $(window).width();
        // console.info(youlan);
        if (youlan < 970) {
            // $('.header-three').css('margin-top', '20px');
            $('.header-three').css({ 'margin-top': '20px', width: '100%' });
            $('.header-hical').css('width', '100%');
            $('.header-three').eq(0).css('margin-top', '0px');
            // $('.layui-col-md3').css('margin-top', '10px');
        }
        if (youlan > 970) {
            // $('.layui-col-md3').css('margin-top', '0px');
            $('.header-three').css({ 'margin-top': '0px', width: '95%' });
            $('.header-hical').css('width', '98.3%');
        }
    }

    Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '流量统计系统 ( 最近7天数据 )'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
})();