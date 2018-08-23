(function(){
      
    var swiper = new Swiper('.swiper-container', {
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
    },
  });


    /*评论滚动*/
    var area =document.getElementById('scrollBox');
    var con1 = document.getElementById('con1');
    var con2 = document.getElementById('con2');
    con2.innerHTML=con1.innerHTML;
    function scrollUp(){
    if(area.scrollTop>=con1.offsetHeight){
        area.scrollTop=0;
    }else{
        area.scrollTop++
    }
    }                
    var time = 50;
    var mytimer=setInterval(scrollUp,time);
    var second_hao = '';
    // 
    window.setInterval(function() {
      if(localStorage.intDiff=='' || localStorage.intDiff<=1 || localStorage.intDiff=='NaN'){
        intDiff = 1800;
        localStorage.intDiff = intDiff;
      }else{
          intDiff = localStorage.intDiff;
      }
      
      var day = 0, hour = 0, minute = 0, second = 0;//时间默认值
      if (intDiff > 0) {
          day = Math.floor(intDiff / (60 * 60 * 24));
          hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
          minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
          second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
      }
      if (minute <= 9)
          minute = '0' + minute;
      if (second <= 9)
          second = '0' + second;
      $('.shi').html( hour + '时');
      $('.fen').html(minute + '分');
      $('.miao').html(second + '秒');
      if(minute<=25){
          $('.index-right-jindutiao-bak').css('width','90%');
          $('.index-right-jindutiao-bak-left').html('90%');
          $('.index-yesx').html(parseInt($('.index-yesx').html())+aa());
      }else if(minute<=28){
          $('.index-right-jindutiao-bak').css('width',' 80%');
          $('.index-right-jindutiao-bak-left').html('80%');
          $('.index-yesx').html(parseInt($('.index-yesx').html())+aa());
      }else if(minute<=29){
          $('.index-right-jindutiao-bak').css('width',' 75%');
          $('.index-right-jindutiao-bak-left').html('75%');
      }else if(minute==30){
          $('.index-right-jindutiao-bak').css('width','70%');
          $('.index-right-jindutiao-bak-left').html('70%');
          $('.index-yesx').html(parseInt($('.index-yesx').html())+aa());
      }
      $('.yan').css('color','red');
      intDiff--;
      localStorage.intDiff = intDiff;
  }, 1000);
    // miao
    window.setTimeout(function(){
      window.setInterval(function() {
          ++second_hao;
          if(second_hao>9){
              second_hao=0;
          }
          $('.index-miao-hao').html(second_hao);
      },100)
    $('.index-yesx').html(2630);
  },1000);


  function aa() {
    return Math.floor(Math.random()*10);
}  

// 

$('.index-cicun').click(function(){
    $('.index-cicun').removeClass('index-cicun-red');
    $(this).addClass('index-cicun-red');
    $('.index-imgx-ma').html($(this).html());
});


  })();