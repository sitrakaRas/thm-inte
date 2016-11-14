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
	}
};

$(function () {
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
		infinite: true
	};

	thinkmarket.slider($(".slider-top"), arg_St);

	// business case 
	var arg_bc = {
		dots: true,
		easing: 'easeOut',
		infinite: true,
		fade: true
	};
	thinkmarket.slider($(".slider-bc"), arg_bc);

	//slider-schifter
	var arg_sh = {
		dots: true,
		slidesToScroll: 3,
		slidesToShow: 3,
		easing: 'easeOut'
	};

	thinkmarket.slider($(".slider-schifter"), arg_sh);

	$(window).on("resize", function () {
		var arg_slide = {
			sub: 90
		};

		thinkmarket.resizeSlide($(".item-top"), arg_slide);

		// Init Skrollr
		var s = skrollr.init();
		// Refresh Skrollr after resizing our sections
		s.refresh($('#block-top'));
	});

	$(window).trigger("resize");
});
//# sourceMappingURL=main.js.map
