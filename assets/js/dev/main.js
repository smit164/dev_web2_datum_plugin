
$(document).ready(function(){
  $('.datum_checkbox-accordian > li > .answer').hide();
    
  $('.datum_checkbox-accordian li span').click(function() {
    
    if ($(this).closest('li').hasClass("active")) {
      $(this).closest('li').removeClass("active").find(".answer").slideUp();
    } else {
      $(".datum_checkbox-accordian > li.active .answer").slideUp();
      $(".datum_checkbox-accordian > li.active").removeClass("active");
      $(this).closest('li').addClass("active").find(".answer").slideDown();
    }
    return false;
  });
  
});

$(document).ready(function(){
  $('#datum_property_dropDown').click(function(){
    $('#datum_drop-down-property').toggleClass('datum_drop-down--active');
  });
});

$(document).ready(function(){
  $('#datum_sort_dropDown').click(function(){
    $('.datum_drop-down-sort').toggleClass('datum_drop-down--active');
  });
});


// Header Sticky
function stickyFunction() {
	var header = document.getElementById("site-header");
	var sticky = header.offsetHeight;
	if (window.pageYOffset > 0) {
		header.classList.add("fixed");
	} else {
		header.classList.remove("fixed");
	}
}

// LeftNav Sticky
window.onscroll = function() {
	var scrollposition = $(window).scrollTop();
	var headerheight = $('.header').outerHeight();
	if(scrollposition > 0 && scrollposition < $('.site-footer').offset().top - $('.leftnav-listing').outerHeight() - headerheight){
		$('.leftnav-listing').addClass('leftnav-fixed')
	}else{
		$('.leftnav-listing').removeClass('leftnav-fixed')
	}
	stickyFunction();
	onScrollHighlighted();
};

// LeftNav onscroll Highlight
function onScrollHighlighted() {
   var leftNavHeight = 0;
   var scrollHeight = $(document).height();
   var scrollPosition = $(window).height() + $(window).scrollTop();
   var contentnavArray = [] ;
   var scrollPos = $(document).scrollTop();  
   var header_height = $('.header').outerHeight();

    $('.leftnav-listing li a').each(function () {
        var currLink = $(this);
        var refElement = currLink.attr('href').replace('#', '');
        contentnavArray.push(refElement);
    }); 

   $.each(contentnavArray, function (i, val) {
       var refElement = $('section#' + val);
       var currLink = $('*[href=\'#' + val + '\']');
       var nextrefElement;       
       if (contentnavArray.length > i + 1) {
           nextrefElement = $('section#' + contentnavArray[i + 1]);
       } else {
           nextrefElement = $('footer');
       }
       if (0 !== refElement.length) {
           if (refElement.offset().top - header_height <= scrollPos && nextrefElement.offset().top > scrollPos) {    
               $('.leftnav-listing li').removeClass('is_visiable_section');
               currLink.parents('.leftnav-listing li').addClass('is_visiable_section');
           } else if (0 === (scrollHeight - scrollPosition) / scrollHeight) { 
               currLink.parents('.leftnav-listing li').removeClass('is_visiable_section');
               currLink.parents('.leftnav-listing li').addClass('is_visiable_section');
           } else { 
               currLink.parents('.leftnav-listing li').removeClass('is_visiable_section');
           }
       }
   });
}

// leftnav on click scroll
$(document).on('click', '.leftnav-listing li > a', function(){
	var getattr = ($(this).attr('href')).trim();
	var headmrg = ($('[id="' + getattr.substr(1) + '"]').css('margin-top')).slice(0,-2);
	$('html, body').animate({
		scrollTop: $('[id="' + getattr.substr(1) + '"]').offset().top - /*$('.header').outerHeight()*/ - headmrg
	}, 1000);
});
 

$(document).ready(function(){
	var w_width = $( window ).width();
	
	/*Menu toggle Button*/
	$('.nav-button').click(function() {
		$('body').toggleClass('show_menu');
		$('.nav-wrap ul.top_nav').slideToggle();
	});

	/*Append down-arrow Span*/
	$('ul.top_nav > li:has(ul)').addClass('has-submenu').append('<span class="down-arrow"></span>');
	$('li.has-submenu ul > li:has(ul)').addClass('has-submenu').append('<span class="down-arrow"></span>');

	/*Navigation Menu */

 	/*Multi level*/
    $("ul.top_nav li span.down-arrow").on("click",function(e){  
		if($(this).parents(".has-submenu").hasClass("submenu-active") && (!($(this).parent().hasClass("submenu-active")) ) ){ 
			$(this).parent().siblings().removeClass("submenu-active");
			$(this).parent().addClass("submenu-active");
			$(this).parent().siblings(".has-submenu").children(".sub-nav").slideUp(400);
			$(this).siblings(".sub-nav").slideDown(400); 
		}	
		else if($(this).parents(".has-submenu").hasClass("submenu-active") && $(this).parent().hasClass("submenu-active")){
			$(this).parent().removeClass("submenu-active");
			$(this).siblings(".sub-nav").slideUp(400); 
		} 
		else{
			$(this).parent().siblings().removeClass("submenu-active");
			$(this).parent().addClass("submenu-active");
			$(".has-submenu > .sub-nav").slideUp(400);
			$(this).siblings(".sub-nav").slideDown(400);
		}
	});
	
	/*First Level*/
	/*$('ul.top_nav li span.down-arrow').click(function(e) {   
	   $(this).parent().siblings().removeClass('submenu-active');
	   $(this).parent().toggleClass('submenu-active');
	   $('.sub-nav').not($(this).siblings() && $(this).parents('.sub-nav')).slideUp();
	   $(this).siblings('.sub-nav').slideToggle();
	   e.stopPropagation();
	});*/

	onScrollHighlighted();

})

$(window).resize( function(){
	var w_width = $( window ).width();
	if(w_width > 919){
		$('.nav-wrap ul.top_nav').show();			
		$('.nav-wrap ul.top_nav ul').removeAttr("style");;			
	}

	onScrollHighlighted();

});








$('.datum_search_keyword').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: false,
    variableWidth: true,
});


$('.datum_slick_carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    autoplay: true
});

$('.datum_details_strap_slider').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 2,
    autoplay: true,
    arrows:true
});

$('.datum_modal_toggle').on('click', function(e) {
  e.preventDefault();
  $('.datum_modal').toggleClass('is-visible');
});
      

var totalSteps = $(".datum_steps li").length;

$(".submit").on("click", function(){
  return false; 
});

$(".datum_steps li:nth-of-type(1)").addClass("active");
$(".datum_main_form_container:nth-of-type(1)").addClass("active");

$(".datum_main_form_container").on("click", ".next", function() { 
  $(".datum_steps li").eq($(this).parents(".datum_main_form_container").index() + 1).addClass("active"); 
  $(this).parents(".datum_main_form_container").removeClass("active").next().addClass("active flipInX");   
});

$(".datum_main_form_container").on("click", ".back", function() {  
  $(".datum_steps li").eq($(this).parents(".datum_main_form_container").index() - totalSteps).removeClass("active"); 
  $(this).parents(".datum_main_form_container").removeClass("active flipInX").prev().addClass("active flipInY"); 
});



$('#pl_showmap').change(function(){
var pl_showmap = $('#pl_showmap:checked').val();

if(pl_showmap){
$("#CLEARCIRCLE").hide();
$(".oeplDrawCircle").show();
$('.datum_pl_flipdiv').addClass('datum_pl_scroolListing');
$('.datum_pl_googlemap_view').css('display','block');
$('.datum_portfolio_item').css('width','50%');
$('.datum_portfolio_item .datum_item').css('width','50%');
$('#CLEARCIRCLE').trigger('click');
} else {
$('.datum_pl_flipdiv').removeClass('datum_pl_scroolListing');
$('.datum_pl_googlemap_view').css('display','none');
$('.datum_portfolio_item').css('width','100%');
// $('.datum_portfolio_item .datum_item').css('width','25%');


}
});


$(".slider-for").lightGallery();

$('.slider-for').slick({
    slidesToShow : 1,
    slidesToScroll : 1,
    arrows : true,
    fade : true,        
});


var MODULE = MODULE || {};

(function($, MODULE) {
  MODULE.init_accordion = function() {
    // Logic for accordion
    var accordion = (function() {
      var $accordion_elem = $(".datum_accordion"),
        $accordion_headerlink = $accordion_elem.find(
          ".js-accordion__entry-header-link"
        ),
        $accordion_item = $accordion_elem.find(".datum_accordion_entry");

      var settings = {
        speed: parseInt($accordion_elem.attr("data-speed")) || 400,
        individual_openable: $accordion_elem.attr("data-individual-openable") === "true"
      };

      return {
        init: function() {
          $accordion_headerlink.on("click", function(e) {
            e.preventDefault();
            accordion.toggle($(this));
          });

          if (
            !settings.individual_openable &&
            $(".datum_accordion_entry.is-expanded").length > 1
          ) {
            $(".datum_accordion_entry.is-expanded").removeClass(
              "is-expanded"
            );
          }
        },
        toggle: function(self) {
          if (
            !settings.individual_openable &&
            self[0] !=
              self
                .closest(".datum_accordion")
                .find(
                  ".datum_accordion_entry.is-expanded .datum_accordion_entry_header_link"
                )[0]
          ) {
            self
              .closest(".datum_accordion")
              .find(".datum_accordion_entry")
              .removeClass("is-expanded")
              .find(".c-accordion__entry-body")
              .slideUp();
          }

          self
            .closest(".datum_accordion_entry")
            .toggleClass("is-expanded")
            .attr("aria-expanded", function(i, attr) {
              return attr == "true" ? "false" : "true";
            });

          self.parent().attr("aria-selected", function(i, attr) {
            return attr == "true" ? "false" : "true";
          });

          self
            .parent()
            .next()
            .stop()
            .slideToggle(settings.speed)
            .attr("aria-hidden", function(i, attr) {
              return attr == "true" ? "false" : "true";
            });
        }
      };
    })();

    accordion.init();
  };

  /* READY FUNCTION
  ====================== */

  $(function() {
    MODULE.init_accordion();
  });
})(jQuery, MODULE);



$("#multiple").select2({
          placeholder: "Search by City, State, Country, Zip Code",
          allowClear: true
      });



    $(".js-select2").select2({
      closeOnSelect : false,
      placeholder : "Select",
      allowHtml: true,
      allowClear: true,
      tags: true // создает новые опции на лету
    });




$('.datum_closed_listings-slider').slick({
              dots: false,
              infinite: true,
              speed: 500,
              slidesToShow: 3,
              slidesToScroll: 1,
              autoplay: false,
              autoplaySpeed: 2000,
              arrows: true,
              responsive: [
              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                  adaptiveHeight: true,
                },
              },
              {
                breakpoint: 767,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                },
              },
            ]
            });