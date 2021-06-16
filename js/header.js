var i = 0;

jQuery(function(){

  jQuery('.bar-btn-js').click(function(){
    if(i == 0){
      $('.right-btn').slideDown();
      $('.right-btn').css('display','flex');
      $('.bar-btn-js').addClass('fa-times');
      $('.bar-btn-js').removeClass('fa-bars');
      i = 1;
    }else if(i == 1){
      $('.right-btn').slideUp();
      //$('.right-btn').css('display','none');
      $('.bar-btn-js').addClass('fa-bars');
      $('.bar-btn-js').removeClass('fa-times');
      i = 0;
     }
   });

});