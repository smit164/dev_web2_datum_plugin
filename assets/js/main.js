function stickyFunction() {
    
}

function onScrollHighlighted() {
    
}
$(document).ready(function() {
    $(".datum_checkbox-accordian > li > .answer").hide(), $(".datum_checkbox-accordian li span").click(function() {
        return $(this).closest("li").hasClass("active") ? $(this).closest("li").removeClass("active").find(".answer").slideUp() : ($(".datum_checkbox-accordian > li.active .answer").slideUp(), $(".datum_checkbox-accordian > li.active").removeClass("active"), $(this).closest("li").addClass("active").find(".answer").slideDown()), !1, $('ul.datum_checkbox-accordian li.datum_accordian-card').each(function( index ) {
            if($(this).hasClass('active')) {
                $(this).children().find('span').text('-');
            } else {
                $(this).children().find('span').text('+');
            }
        });
    })
}), $(document).ready(function() {
    $("#datum_property_dropDown").click(function() {
        $("#datum_drop-down-property").toggleClass("datum_drop-down--active")
    })
}), $(document).ready(function() {
    $("#datum_sort_dropDown").click(function() {
        $(".datum_drop-down-sort").toggleClass("datum_drop-down--active")
    })
}), window.onscroll = function() {
    var e = $(window).scrollTop(),
        t = $(".header").outerHeight();
    0 < e && e < $(".site-footer").offset().top - $(".leftnav-listing").outerHeight() - t ? $(".leftnav-listing").addClass("leftnav-fixed") : $(".leftnav-listing").removeClass("leftnav-fixed"), stickyFunction(), onScrollHighlighted()
}, $(document).on("click", ".leftnav-listing li > a", function() {
    var e = $(this).attr("href").trim(),
        t = $('[id="' + e.substr(1) + '"]').css("margin-top").slice(0, -2);
    $("html, body").animate({
        scrollTop: $('[id="' + e.substr(1) + '"]').offset().top - -t
    }, 1e3)
}), $(document).ready(function() {
    $(window).width();
    $(".nav-button").click(function() {
        $("body").toggleClass("show_menu"), $(".nav-wrap ul.top_nav").slideToggle()
    }), $("ul.top_nav > li:has(ul)").addClass("has-submenu").append('<span class="down-arrow"></span>'), $("li.has-submenu ul > li:has(ul)").addClass("has-submenu").append('<span class="down-arrow"></span>'), $("ul.top_nav li span.down-arrow").on("click", function(e) {
        $(this).parents(".has-submenu").hasClass("submenu-active") && !$(this).parent().hasClass("submenu-active") ? ($(this).parent().siblings().removeClass("submenu-active"), $(this).parent().addClass("submenu-active"), $(this).parent().siblings(".has-submenu").children(".sub-nav").slideUp(400), $(this).siblings(".sub-nav").slideDown(400)) : $(this).parents(".has-submenu").hasClass("submenu-active") && $(this).parent().hasClass("submenu-active") ? ($(this).parent().removeClass("submenu-active"), $(this).siblings(".sub-nav").slideUp(400)) : ($(this).parent().siblings().removeClass("submenu-active"), $(this).parent().addClass("submenu-active"), $(".has-submenu > .sub-nav").slideUp(400), $(this).siblings(".sub-nav").slideDown(400))
    }), onScrollHighlighted()
}), $(window).resize(function() {
    919 < $(window).width() && ($(".nav-wrap ul.top_nav").show(), $(".nav-wrap ul.top_nav ul").removeAttr("style")), onScrollHighlighted()
}), $(".datum_search_keyword").slick({
    dots: !1,
    infinite: !0,
    speed: 300,
    slidesToShow: 1,
    centerMode: !1,
    variableWidth: !0
}), $(".datum_slick_carousel").slick({
    dots: !1,
    infinite: !0,
    speed: 300,
    slidesToShow: 1,
    autoplay: !0
}), $(".datum_details_strap_slider").slick({
    dots: !1,
    infinite: !0,
    speed: 300,
    slidesToShow: 2,
    autoplay: !0,
    arrows: !0
}), $(".datum_modal_toggle").on("click", function(e) {
    e.preventDefault(), $(".datum_modal").toggleClass("is-visible")
});
var totalSteps = $(".datum_steps li").length;
$(".submit").on("click", function() {
    return !1
}), $(".datum_steps li:nth-of-type(1)").addClass("active"), $(".datum_main_form_container:nth-of-type(1)").addClass("active"), $(".datum_main_form_container").on("click", ".next", function() {
    $(".datum_steps li").eq($(this).parents(".datum_main_form_container").index() + 1).addClass("active"), $(this).parents(".datum_main_form_container").removeClass("active").next().addClass("active flipInX")
}), $(".datum_main_form_container").on("click", ".back", function() {
    $(".datum_steps li").eq($(this).parents(".datum_main_form_container").index() - totalSteps).removeClass("active"), $(this).parents(".datum_main_form_container").removeClass("active flipInX").prev().addClass("active flipInY")
}), $("#pl_showmap").change(function() {
    $("#pl_showmap:checked").val() ? ($("#CLEARCIRCLE").hide(), $(".oeplDrawCircle").show(), $(".datum_pl_flipdiv").addClass("datum_pl_scroolListing"), $(".datum_pl_googlemap_view").css("display", "block"), $(".datum_portfolio_item").css("width", "50%"), $(".datum_portfolio_item .datum_item").css("width", "50%"), $("#CLEARCIRCLE").trigger("click")) : ($(".datum_pl_flipdiv").removeClass("datum_pl_scroolListing"), $(".datum_pl_googlemap_view").css("display", "none"), $(".datum_portfolio_item").css("width", "100%"))
}), $(".slider-for").lightGallery(), $(".slider-for").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: !0,
    fade: !0
});
var MODULE = MODULE || {};
! function(a, e) {
    e.init_accordion = function() {
        var e, t, i, s = (e = a(".datum_accordion"), t = e.find(".js-accordion__entry-header-link"), e.find(".datum_accordion_entry"), i = {
            speed: parseInt(e.attr("data-speed")) || 400,
            individual_openable: "true" === e.attr("data-individual-openable")
        }, {
            init: function() {
                t.on("click", function(e) {
                    e.preventDefault(), s.toggle(a(this))
                }), !i.individual_openable && 1 < a(".datum_accordion_entry.is-expanded").length && a(".datum_accordion_entry.is-expanded").removeClass("is-expanded")
            },
            toggle: function(e) {
                i.individual_openable || e[0] == e.closest(".datum_accordion").find(".datum_accordion_entry.is-expanded .datum_accordion_entry_header_link")[0] || e.closest(".datum_accordion").find(".datum_accordion_entry").removeClass("is-expanded").find(".c-accordion__entry-body").slideUp(), e.closest(".datum_accordion_entry").toggleClass("is-expanded").attr("aria-expanded", function(e, t) {
                    return "true" == t ? "false" : "true"
                }), e.parent().attr("aria-selected", function(e, t) {
                    return "true" == t ? "false" : "true"
                }), e.parent().next().stop().slideToggle(i.speed).attr("aria-hidden", function(e, t) {
                    return "true" == t ? "false" : "true"
                })
            }
        });
        s.init()
    }, a(function() {
        e.init_accordion()
    })
}(jQuery, MODULE), $("#multiple").select2({
    placeholder: "Search by City, State, Country, Zip Code",
    allowClear: !0
}), $(".js-select2").select2({
    closeOnSelect: !1,
    placeholder: "Select",
    allowHtml: !0,
    allowClear: !0,
    tags: !0
}), $(".datum_closed_listings-slider").slick({
    dots: !1,
    infinite: !0,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: !1,
    autoplaySpeed: 2e3,
    arrows: !0,
    responsive: [{
        breakpoint: 992,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            adaptiveHeight: !0
        }
    }, {
        breakpoint: 767,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }]
});