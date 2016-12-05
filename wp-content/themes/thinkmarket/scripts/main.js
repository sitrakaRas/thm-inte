"use strict";

var thinkmarket = {
    slider: function slider(parent, arg) {
        parent.slick(arg);
    },
    headfixe: function headfixe(parent, arg) {
        parent.scrollToFixed(arg);
    },
    resizeSlide: function resizeSlide(elem, arg) {
        var sectionSize = $(window).height();
        if (arg.sub) {
            sectionSize = sectionSize - arg.sub;
        }
        elem.height(sectionSize);
    },
    equalHeight: function equalHeight(container) {
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            $el,
            topPosition = 0,
            currentDiv;

        $(container).each(function () {

            $el = $(this);
            topPosition = $el.position().top;

            if (currentRowStart != topPosition) {

                // we just came to a new row.  Set all the heights on the completed row
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
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
                currentTallest = currentTallest < $el.height() ? $el.height() : currentTallest;
            }

            // do the last row

            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    },
    filterActu: function filterActu(cible) {
        $("#last-actu.actu-inner .actu-wrapper .all").addClass("hidden");
        $("#last-actu.actu-inner .actu-wrapper " + cible).removeClass("hidden");
    }
};

$(function () {

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
        slidesToShow: 4,
        dots: true,
        infinite: true,
        easing: 'easeOut',
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1
            }
        }]

    };
    thinkmarket.slider($(".slider-part"), arg);

    //slider citation
    var arg_cit = {
        dots: true
    };
    thinkmarket.slider($("#citation.slider, #citation .slider"), arg_cit);

    //menu fixe
    var menu_arg;
    thinkmarket.headfixe($(".main-nav"), menu_arg);

    $(window).on("scroll", function () {
        if ($(".main-nav").offset().top > 10) {
            $(".main-nav").addClass("minimize");
        } else {
            $(".main-nav").removeClass("minimize");
        }
    });

    //top slider
    var arg_St = {
        dots: true,
        easing: 'easeOut',
        infinite: true,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: false
            }
        }]
    };

    thinkmarket.slider($(".slider-top"), arg_St);

    // business case 
    var arg_bc = {
        dots: true,
        easing: 'easeOut',
        infinite: true
    };
    thinkmarket.slider($(".slider-bc"), arg_bc);

    //slider-schifter
    var arg_sh = {
        dots: true,
        slidesToScroll: 3,
        slidesToShow: 3,
        easing: 'easeOut',
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                arrows: false
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    };

    thinkmarket.slider($(".slider-schifter"), arg_sh);

    //slider-expertise
    var arg_ex = {
        dots: true,
        slidesToScroll: 3,
        slidesToShow: 3,
        easing: 'easeOut',
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToScroll: 2,
                slidesToShow: 2
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToScroll: 1,
                slidesToShow: 1
            }
        }]
    };

    thinkmarket.slider($(".slider-expertise"), arg_ex);

    //parallaxe slider
    (function () {
        var parallax = document.querySelectorAll("#block-top .item-top"),
            speed = 0.3;

        if ($(window).width() > 767) {
            //désactivation parallaxe sur version mobile
            $(window).scroll(function () {
                [].slice.call(parallax).forEach(function (el, i) {

                    var windowYOffset = $(window).scrollTop(),
                        elBackgrounPos = "0px, " + windowYOffset * speed + "px, 0px";

                    el.style.transform = "translate3d(" + elBackgrounPos + ")";
                });
            });
        }
    })();

    $(window).on("resize", function () {
        var vw = $(window).width();

        var arg_slide = {
            sub: 90
        };

        thinkmarket.resizeSlide($(".item-top"), arg_slide);

        // Init Skrollr
        // --28.11.2016
        // var s = skrollr.init();
        // // Refresh Skrollr after resizing our sections
        // s.refresh($('#block-top'));


        //same height #recute

        if ($("#recrute").length > 0) {
            thinkmarket.equalHeight(".processus-wrapper .block");
        }

        //same height bloc associés

        if ($("#associes").length > 0 && vw > 1024) {
            thinkmarket.equalHeight(".mid-part");
        } else {
            $(".mid-part").removeAttr("style");
        }
    });

    $("img").each(function () {
        //add class square/portrait/landscape to imgs
        $(this).load(function () {
            if ($(this).prop("naturalWidth") == $(this).prop("naturalHeight")) {
                $(this).addClass("img-square");
            } else if ($(this).prop("naturalWidth") < $(this).prop("naturalHeight")) {
                $(this).addClass("img-portrait");
            } else if ($(this).prop("naturalWidth") > $(this).prop("naturalHeight")) {
                $(this).addClass("img-landscape");
            }
        });
    });

    $(window).trigger("resize");

    var arg_vid = {
        dots: true,
        easing: 'easeOut',
        lazyLoad: 'ondemand',
        responsive: [{
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: false
            }
        }]
    };
    thinkmarket.slider($(".slidervideoctnr"), arg_vid);

    //playing video slider
    if ($("#slidervideo").length > 0) {
        $("#slidervideo .slick-active .video-play")[0].play();
    }

    $(".slidervideoctnr").on("afterChange", function (event, slick) {
        $("#slidervideo .slick-active .video-play")[0].play();
    });
    $(".slidervideoctnr").on("beforeChange", function (event, slick) {
        $("#slidervideo .items .video-play")[0].pause();
    });

    //slider top scroll to
    $("#block-top .to-next-btn a").on("click", function (e) {
        e.preventDefault();
        var id = "#" + $("#block-top").next().attr("id");

        if ($('body.safari').length) {
            $("body.safari").animate({ scrollTop: $(id).offset().top - 50 }, 1000);
        } else {
            $("html,body").animate({ scrollTop: $(id).offset().top - 50 }, 1000);
        }
    });

    //add class on hover
    if ($("#joins_us").length > 0) {
        $("#joins_us a").on("mouseover", function () {
            $("#joins_us").toggleClass("hover");
        });
        $("#joins_us a").on("mouseout", function () {
            $("#joins_us").toggleClass("hover");
        });
    }

    //tab filter actu

    $(".actu-inner .tabs li a").on("click", function (e) {
        e.preventDefault();

        thinkmarket.filterActu($(this).attr("href"));
        $(".actu-inner .tabs li").removeClass("active");
        $(this).parent().toggleClass("active");
    });

    $(".actu-inner .actu-bloc .text-actu h3 a").on("click", function (e) {
        e.preventDefault();

        thinkmarket.filterActu($(this).attr("href"));
        var that = $(this);
        $(".actu-inner .tabs li").removeClass("active");
        $(".actu-inner .tabs li").each(function () {
            if ($(this).find("a").attr("href") == that.attr("href")) {
                $(this).toggleClass("active");
            }
        });
    });

    //patchs javascript

    (function _0037156_0037171() {
        //correction retournement shift
        var $contentBoxTypeOne = $("#block-top .content-box-type-one");
        var $shift = $contentBoxTypeOne.find("a");
        $shift.addClass('shift').wrapInner('<span>');

        $shift.on('mouseenter mouseout', function () {
            if (!$shift.hasClass('spinning')) {
                $shift.addClass('spinning');
                setTimeout(function () {
                    $shift.removeClass('spinning');
                }, 300);
                $shift.toggleClass('spin');
            }
        });

        $contentBoxTypeOne.find("h1,h2").mouseleave(function () {
            $shift.removeClass("spin");
        });
    })();

    (function _0037167() {
        //problème de chargement ajout loader
        /*var $itemTop = $('#block-top .item-top');
        $itemTop.each(function(){
            var $this = $(this);
              if($this.css('background-image')!="none"){
                $this.append('<span class="spinner">');
                console.log($this.css('background-image'));
            }
          })*/
        $("body").append('<div id="loader"><span class="spinner"></span></div>');
        $(window).load(function () {
            $("body > #loader").fadeOut(1000, function () {
                $(this).remove();
            });
        });
    })();

    (function () {
        //Correction problème de menu transparent au scroll
        $(window).scroll(function () {
            if ($('#navbar').hasClass('in')) {
                $('.navbar-header button.navbar-toggle').trigger('click');
            }
        });
    })();

    (function () {
        //Ajout poster video
        var $video = $('#slidervideo video');
        $video.each(function () {
            $(this).closest('.row').css({ 'backgroundImage': 'url(' + $(this).attr('poster') + ')' });
        });
    })();

    (function () {//Groupement "nos clients"


    })();
});
//# sourceMappingURL=main.js.map
