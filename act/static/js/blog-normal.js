var ww = document.body.clientWidth;

$(document).ready(function() {
	$(".nav li a").each(function() {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		};
	});

	$(".item-more").click(function() {
		if($(this).attr('data-active') == 0) {
			$(this).parent().prev().addClass('no-omit');
			$(this).parent().prev().css('height', 'auto');
			$(this).attr('data-active', '1');
			$(this).html('收 起<i class="item-more-img"><img src="images/arrow.png" alt=""/></i>');
			$(this).children().children().addClass('active-omit');
		}
		else {
			$(this).parent().prev().removeClass('no-omit');
			$(this).parent().prev().css('height', '4.2em');
			$(this).attr('data-active', '0');	
			$(this).html('更 多<i class="item-more-img"><img src="images/arrow.png" alt=""/></i>');	
		}
	});
	
	$(".toggleMenu").click(function(e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$(".nav").toggle();
	});
	adjustMenu();
})

$(window).bind('resize orientationchange', function() {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function() {
	if (ww < 768) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".nav").hide();
		} else {
			$(".nav").show();
		}
		$(".nav li").unbind('mouseenter mouseleave');
		$(".nav li a.parent").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} 
	else if (ww >= 768) {
		$(".toggleMenu").css("display", "none");
		$(".nav").show();
		$(".nav li").removeClass("hover");
		$(".nav li a").unbind('click');
		$(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	$(this).toggleClass('hover');
		});
	}
}

