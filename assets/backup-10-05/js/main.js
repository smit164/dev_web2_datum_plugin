$(".datum_search_keyword").slick({ dots: !1, infinite: !0, speed: 300, slidesToShow: 1, centerMode: !1, variableWidth: !0 });
$(".datum_slick_carousel").slick({ dots: !1, infinite: !0, speed: 300, slidesToShow: 1, autoplay: !0 });
$(".datum_details_strap_slider").slick({ dots: !1, infinite: !0, speed: 300, slidesToShow: 2, autoplay: !0, arrows: !0 });
$(".slider-for").lightGallery();
$(".slider-for").slick({ slidesToShow: 1, slidesToScroll: 1, arrows: !0, fade: !0 });
var totalSteps = $(".datum_steps li").length;
$(".datum_steps li:nth-of-type(1)").addClass("active");
$(".datum_main_form_container:nth-of-type(1)").addClass("active");