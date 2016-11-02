var thinkmarket = {
	slider: function(parent,arg){
		parent.slick(arg);
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
});
