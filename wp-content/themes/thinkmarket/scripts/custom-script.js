(function ($) {
  "use strict";

  function do_ajax(params, dataType, typeLoader, callback_response) {

    switch (typeLoader) {
      case 'cache_page':
        $('.cache-page').show();
        break;
      case 'loader':
        $('.loader').show();
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
        callback_response(rep)
      },
      complete: function () {
        switch (typeLoader) {
          case 'cache_page':
            setTimeout(function () {
              $('.cache-page').hide();
            }, 999);
            break;
          case 'loader':
            $('.loader').hide();
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