window.onload = function(){
  $('.index-btn').click(function(){
    var clickedIndex = $(this).attr('data-option');

    //thisの親要素のactiveのみremove
    var $remove = $(this).parent().prev().children().children('.active');
    $remove.removeClass('active');

    //thisの親要素のslideにactiveをaddClass
    var $addClass = $(this).parent().prev().children().children('.slide');
    $addClass.eq(clickedIndex).addClass('active');
  });
};


//var $result = $(this).parent().parent('.result');
//var $good_btn = $(this).parent('.good-btn');