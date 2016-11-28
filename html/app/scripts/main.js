var thinkmarket = {
    slider: function(parent,arg){
        parent.slick(arg);
    },
    headfixe : function(parent,arg){
        parent.scrollToFixed(arg);
    },
    resizeSlide : function(elem,arg){
        var sectionSize = $(window).height();
        if(arg.sub){
            sectionSize = sectionSize - arg.sub;
        }
        elem.height(sectionSize);
    },
    equalHeight : function(container){
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            $el,
            topPosition = 0,
            currentDiv;

        $(container).each(function() {

            $el = $(this);
            topPosition = $el.position().top;

            if (currentRowStart != topPosition) {

                // we just came to a new row.  Set all the heights on the completed row
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }

                // set the variables for the new row
                rowDivs.length = 0; // empty the array
                currentRowStart = topPosition;
                currentTallest = $el.height();
                rowDivs.push($el);

            } else {

                // another div on the current row.  Add it to the list and check if it's taller
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

            }

            // do the last row

            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }

        })
    },
    filterActu : function(cible){
        $("#last-actu.actu-inner .actu-wrapper .all").addClass("hidden");
        $("#last-actu.actu-inner .actu-wrapper " + cible).removeClass("hidden");
    }
}

$(function(){

    //browser detection
    var bDetection = browserDetection();
    var bName = bDetection.browser;
    var bVers = bDetection.version;
    var bOs = bDetection.os;
    $("body").addClass(bName + " " + bName + "-" + bVers + " " + bOs);


    //same height block
    $(".row-shiffter .block-shifter").matchHeight();
    $(".logo-wrapper .block-logo").matchHeight();

    //slider partenaire
    var arg = {
        slidesToShow : 4,
        dots : true,
        infinite: true,
        easing: 'easeOut',
        responsive : [
            {
                breakpoint : 1024,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint : 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint : 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]

    };
    thinkmarket.slider($(".slider-part"),arg);

    //slider citation
    var arg_cit = {
        dots: true
    }
    thinkmarket.slider($("#citation.slider"),arg_cit);

    //menu fixe
    var menu_arg;
    thinkmarket.headfixe($(".main-nav"),menu_arg);

    $(window).on("scroll",function(){
        if($(".main-nav").offset().top > 10 ){
            $(".main-nav").addClass("minimize");
        }else{
            $(".main-nav").removeClass("minimize");
        }

    });

    //top slider
    var arg_St = {
        dots : true,
        easing : 'easeOut',
        infinite: true,
        adaptiveHeight: true,
        responsive : [
            {
                breakpoint : 768,
                settings: {
                    arrows: false,
                    dots : false
                }
            }
        ]
    };

    thinkmarket.slider($(".slider-top"),arg_St);

    /*if($('body').length){ //bug safari
        var $safariBody = $('body');
        var $sliderTop = $(".slider-top");
        getSafariBgImage($sliderTop);

        function getSafariBgImage($sliderTop){
            var bgImage = $sliderTop.find(".slick-active").css("background-image");
            console.log(bgImage);
            $safariBody.css({'backgroundImage':bgImage});
        }

        $sliderTop.on('afterChange', function(event, slick, direction){
            getSafariBgImage($sliderTop);
            // left
        });
    }*/

    // business case 
    var arg_bc = {
        dots : true,
        easing : 'easeOut',
        infinite: true,
        fade: true,
        responsive:[
            {
                breakpoint: 768,
                settings : {
                    arrows : false,
                    dots : false
                }
            }
        ]
    };
    thinkmarket.slider($(".slider-bc"),arg_bc);

    //slider-schifter
    var arg_sh = {
        dots : true,
        slidesToScroll: 3,
        slidesToShow : 3,
        easing: 'easeOut',
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows : false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots : false,
                    arrows : false

                }
            }
        ]
    }

    thinkmarket.slider($(".slider-schifter"),arg_sh);

    //slider-expertise
    var arg_ex = {
        dots : true,
        slidesToScroll: 1,
        slidesToShow : 3,
        easing: 'easeOut',
        responsive : [
            {
                breakpoint : 1024,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint : 768,
                settings: {
                    slidesToShow: 1,
                    arrows : false,
                    dots : false
                }
            }
        ]
    }

    thinkmarket.slider($(".slider-expertise"),arg_ex);


    //parralaxe slider
    (function(){
        var parallax = document.querySelectorAll("#block-top .item-top"),
            speed = 0.5;

        $(window).scroll(function(){
            [].slice.call(parallax).forEach(function(el,i){

                var windowYOffset = $(window).scrollTop(),
                    elBackgrounPos = "center " + (windowYOffset * speed) + "px";

                el.style.backgroundPosition = elBackgrounPos;

            });
        });

    })();

    $(window).on("resize", function(){
        var arg_slide = {
            sub : 90
        };

        thinkmarket.resizeSlide($(".item-top"),arg_slide);

        // Init Skrollr
        /*--28.11.2016
        var s = skrollr.init();
        // Refresh Skrollr after resizing our sections
        s.refresh($('#block-top'));
        */


        //same height #recute

        if($("#recrute").length > 0 ){
            thinkmarket.equalHeight(".processus-wrapper .block");
        }
    });

    $("img").each(function(){ //add class square/portrait/landscape to imgs
        $(this).load(function(){
            if($(this).prop("naturalWidth")==$(this).prop("naturalHeight")){
                $(this).addClass("img-square");
            }else if($(this).prop("naturalWidth")<$(this).prop("naturalHeight")){
                $(this).addClass("img-portrait");
            }else if($(this).prop("naturalWidth")>$(this).prop("naturalHeight")){
                $(this).addClass("img-landscape");
            }
        })
    })

    $(window).trigger("resize");

    var arg_vid = {
        dots : true,
        easing: 'easeOut',
        lazyLoad: 'ondemand',
        responsive:[
            {
                breakpoint: 768,
                settings : {
                    arrows : false,
                    dots : false
                }
            }
        ]
    };
    thinkmarket.slider($(".slidervideoctnr"),arg_vid);

    //playing video slider
    if($("#slidervideo").length > 0){
        $("#slidervideo .slick-active .video-play")[0].play();
    }

    $(".slidervideoctnr").on("afterChange",function(event,slick){
        $("#slidervideo .slick-active .video-play")[0].play();
    });
    $(".slidervideoctnr").on("beforeChange",function(event,slick){
        $("#slidervideo .items .video-play")[0].pause();
    });

    //slider top scroll to
    /*$("#block-top .to-next-btn a").on("click",function(e){
        e.preventDefault();
        var id = "#" + $("#block-top").next().attr("id");
        $("html,body").animate({scrollTop: $(id).offset().top},500);
    }); - 25.11.2016*/

    //slider top scroll to
    $('#block-top .to-next-btn a').click(function(e){
        e.preventDefault();
        var h = 55 + $("#block-top").height();
        var speed = 1000;
        if($('body.safari').length){
            $("body.safari").animate({scrollTop: h},speed);
        }else{
            $("html").animate({scrollTop: h},speed);
        }
    })

    //add class on hover
    if($("#joins_us").length > 0){
        $("#joins_us a").on("mouseover",function(){
            $("#joins_us").toggleClass("hover");
        });
        $("#joins_us a").on("mouseout",function(){
            $("#joins_us").toggleClass("hover");
        });
    }

    //tab filter actu

    $(".actu-inner .tabs li a").on("click",function(e){
        e.preventDefault();

        thinkmarket.filterActu($(this).attr("href"));
        $(".actu-inner .tabs li").removeClass("active");
        $(this).parent().toggleClass("active");
    });

    //patch javascript

    (function _0037156_0037171() { //correction retournement shift
        var $h1 = $("#block-top h1");
        if($h1.text()=="It's time to shift.It's time to shift."){
            $h1.html('<h1>It\'s time<br>to <a class="shift" href="#" tabindex="0"><span>shift</span></a>.</h1>');
        }

        var $shift = $h1.find(".shift");
        $shift.on('mouseenter mouseout',function(){
            if(!$shift.hasClass('spinning')){
                $shift.addClass('spinning')
                setTimeout(function(){$shift.removeClass('spinning')},300)
                $shift.toggleClass('spin');
            }
        });
    })();


    (function _0037177() { //ajout rollover image bleu
        var $img = $("#shifter-part a.link-offre img");
        $img.each(function(){
            var $imgClone =  $(this).clone();
            var src = $imgClone.attr("src");
            var regexp = /(.*)(\.[^.]*)$/;
            var output = regexp.exec(src);
            $imgClone.attr("src",output[1]+"-hover"+output[2]);
            $(this).after($imgClone);
        });
    })();


    /*(function _0037156() {
    })()*/


});
