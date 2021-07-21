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
$('.datum_pl_flipdiv').removeClass('pl_scroolListing');
$('.datum_pl_googlemap_view').css('display','none');
$('.datum_portfolio_item').css('width','100%');
$('.datum_portfolio_item .datum_item').css('width','25%');


}
});



$(".slider-for").lightGallery();


        $('.slider-for').slick({
            slidesToShow : 1,
            slidesToScroll : 1,
            arrows : true,
            fade : true,
            
        });