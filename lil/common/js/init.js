(function ($) {


  /* ------------------------------- */
  $(function(){
    load_event();
	transparent_load_event();
	mapFunc();

    /*slidescroll*/
    $("a[href*='#']").slideScroll();
    /**/
    $("#topics dt:even").addClass("bg_b");

	$('.linkbox').hover(function(){
		$(this).parent().stop().animate({opacity: 0.7}, 500);
	}, function(){
		$(this).parent().stop().animate({opacity: 1.0}, 500);
	});

	var pathname = location.pathname;
	var path_array = pathname.split("/");
	if(path_array[2] == ""){
		$('#g_navi ul li img').eq(0).attr("src", $('#g_navi ul li img').eq(0).attr("src").replace("-out-", "-on-") );
		$('#g_navi ul li img').eq(0).addClass("current");
	}else if(path_array[2] == "kumon_shosha"){
		$('#g_navi ul li img').eq(1).attr("src", $('#g_navi ul li img').eq(1).attr("src").replace("-out-", "-on-") );
		$('#g_navi ul li img').eq(1).addClass("current");
	}else if(path_array[2] == "enter"){
		$('#g_navi ul li img').eq(2).attr("src", $('#g_navi ul li img').eq(2).attr("src").replace("-out-", "-on-") );
		$('#g_navi ul li img').eq(2).addClass("current");
	}else if(path_array[2] == "kyoka"){
		$('#g_navi ul li img').eq(3).attr("src", $('#g_navi ul li img').eq(3).attr("src").replace("-out-", "-on-") );
		$('#g_navi ul li img').eq(3).addClass("current");
	}else if(path_array[2] == "taiken"){
		$('#g_navi ul li img').eq(4).attr("src", $('#g_navi ul li img').eq(4).attr("src").replace("-out-", "-on-") );
		$('#g_navi ul li img').eq(4).addClass("current");
	}else if(path_array[2] == "inst"){
		$('#g_navi ul li img').eq(5).attr("src", $('#g_navi ul li img').eq(5).attr("src").replace("-out-", "-on-") );
		$('#g_navi ul li img').eq(5).addClass("current");
	}

    $('#pagefooter table tr').eq(0).css('display','none');
	$('#pagefooter table tr').eq(1).css('display','none');

	// Pulldown Menu
	$("#g_navi li").hover(function() {
		$(this).children('ul').show();
	}, function() {
		$(this).children('ul').hide();
	});

  });

})(jQuery);

/*image rollover*/
var load_event = function(){
  $('a>img[src*="-out-"],input[src*="-out-"]').each(function(){
    var $$ = $(this);
    $$.mouseover(function(){ $(this).attr('src', $(this).attr('src').replace(/-out-/,'-on-')) });
    $$.mouseout (function(){
      if ( !$(this).hasClass('current') ) { $(this).attr('src', $(this).attr('src').replace(/-on-/,'-out-')) }
    });
  });

  $('a[subwin]').die('click').click(subwin_func);

}

/*sub window*/
var subwin_func = function () {
  var $$ = $(this);
  var param = $$.attr('subwin').split(/\D+/);
  var w = param[0] || 300;
  var h = param[1] || 300;
  var s = ($$.attr('subwin').match(/slim/))?'no':'yes';
  var r = ($$.attr('subwin').match(/fix/) )?'no':'yes';
  var t = $$.attr('target') || '_blank' ;
  window.open( $$.attr('href'), t, "resizable="+r+",scrollbars="+s+",width="+w+",height="+h ).focus();
  return false;
}


/* transparent */
var transparent_load_event = function(){
	var timer = setTimeout(function(){
		$('a img.transparent, .jitsuyo_block').each(function(){
			var $$ = $(this);
			$$.bind("mouseover", function(){
				$(this).stop().queue([]).fadeTo(300, 0.7);
			})
			$$.bind("mouseout", function(){
				$(this).stop().queue([]).fadeTo(300, 1);
			})
		});
	}, 600)
}

var mapFunc = function(){
	var empty_image = $("#img_map2").attr("src");
	// サイドメニュー用
	$(".map_area_item").hover(function(event){
		//var uncle = abc(this);
		var uncle = $(this);
		//var map_link = $(this).attr("name")
		var map_link = '/lil/img/common/map_allarea.png';
		$(uncle).css("opacity",1);
		$(uncle).attr("src",map_link);
	},
	function(event){
		//console.log(empty_image);
		//var uncle = abc(this);
		var uncle = $(this);
		$(uncle).css("opacity",0).attr("src",empty_image);

	});
	
	// 中コンテンツ用
	$(".map02_area_item").hover(function(event){
		var uncle = $(this);
		var map_link = '/lil/img/common/map02_allarea.png';
		$(uncle).css("opacity",1);
		$(uncle).attr("src",map_link);
	},
	function(event){
		//console.log(empty_image);
		var uncle = $(this);
		$(uncle).css("opacity",0).attr("src",empty_image);

	});
	
	/*function abc(tag){
		var a = $(tag).parent().prev();
		return a;
	}*/
};
