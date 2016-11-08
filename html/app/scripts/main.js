var thinkmarket = {
	slider: function(parent,arg){
		parent.slick(arg);
	},
	headfixe : function(parent,arg){
		parent.scrollToFixed(arg);
	}
}

$(function(){
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
});
