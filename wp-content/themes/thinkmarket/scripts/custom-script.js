(function ($) {
  "use strict";
  var test = true;
  var stop = false;
  infiniteScrollActus();
    
  function infiniteScrollActus() {
      if( $('.actu-inner').length > 0 ) {
          $(window).scroll(function(e) {
            e.stopPropagation();
            var spinTop = $(".spinnerWrapper").offset().top;
            if($(window).scrollTop() >= spinTop - $(window).height() && test == true) {
              test = false;
              if(stop != true){
                var params =  {
                    action : 'get_item_article',
                    offset : $('.actu-inner .actu-wrapper .all:last-child').data('offset') + 1,
                    term_id: $(".term_id").val(),
                    old_number: $(".old_number").val()
                };

                if($('.actu-inner .actu-wrapper .all:last-child').data('offset') != $('.actu-inner .actu-wrapper .all:last-child').data('count') - 1){
                  do_ajax( params, 'json', 'loader', callback_get_item_article );
                }
              }
            }               
          });
      }
    
  }

  function callback_get_item_article(resp){
    $('.actu-inner .actu-wrapper .all:last-child').after( resp );
    test = true;
  }

  function do_ajax(params, dataType, typeLoader, callback_response) {

    switch (typeLoader) {
      case 'cache_page':
        $('.cache-page').show();
        break;
      case 'loader':
        $('.spinnerWrapper').show();
        break;
      case 'loader_btn':
        $('.hide-btn').css('visibility', 'hidden');
        $('.loader-btn').show();
        break;
    }

    $.ajax({
      url: admin.ajaxurl,
      method: 'POST',
      data: params,
      dataType: dataType,
      success: function (rep) {
        callback_response(rep.html);
        if(rep.fin == true){
          stop = true;
        }
        $(".old_number").val(rep.old_number);
      },
      complete: function () {
        switch (typeLoader) {
          case 'cache_page':
            setTimeout(function () {
              $('.cache-page').hide();
            }, 999);
            break;
          case 'loader':
            $('.spinnerWrapper').hide();
            break;
          case 'loader_btn':
            $('.loader-btn').hide();
            $('.hide-btn').css('visibility', 'visible');
            break;
        }

      }
    });

  };

})(jQuery);