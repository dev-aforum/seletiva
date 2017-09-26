// botão de navegação

$('#navButton').on('click',function(){
  if($('nav').hasClass('open')){
    $('nav').removeClass('open');
  } else {
    $('nav').addClass('open');
  }
});

$('.nav_link').on('click',function(){

  if($('nav').hasClass('open')){
    $('nav').removeClass('open');
  }
});


//profiles
$('#showProfile').on('click',function(){
  $('#profiles').css({'display':'block'}).hide().fadeIn();
  reposition();
});


$(document).ready(function(){
  //descobertas
  var screenWidth= $(window).width();
  if(screenWidth>=700){
    var descobertaImg = $('#descoberta_img').height();
    console.log(descobertaImg);
    $('.descobertas_sliderNavItem ').css({'height':descobertaImg});
  } else {
    var descobertaImg = $('#descoberta_img').height();
    console.log(descobertaImg);
    $('.descobertas_sliderNavItem').css({'height':descobertaImg*1.5});
  }

  if(screenWidth<=700){
    $('.profile_textContainer').css({'height':'auto'});
  }


});

// posicionamento de imagens

$(window).resize(function(){

  var imgHeightResize = $('#seletivaJoin img').height();
  var imgTopResize = 0 - (imgHeightResize/100)*66;
  $('#seletivaJoin img').css({'top' : imgTopResize});

   var imgHeight2Resize = $('.profile img').height();
   var imgTop2Resize = 0 - (imgHeight2Resize/5)*3;
  $('.profile img').css({'top' : imgTop2Resize});
  var textHeight = $('#profile_text').height();
  var divHeigth = (textHeight/5)*8;
  $('.profile_textContainer').css({'height':divHeigth});

  //descobertas
  var screenWidth= $(window).width();
  if(screenWidth>=700){
    var descobertaImg = $('#descoberta_img').height();
    console.log(descobertaImg);
    $('.descobertas_sliderNavItem ').css({'height':descobertaImg});
  } else {
    var descobertaImg = $('#descoberta_img').height();
    console.log(descobertaImg);
    $('.descobertas_sliderNavItem ').css({'height':descobertaImg*1.5});
  }

  if(screenWidth<=700){
    $('.profile_textContainer').css({'height':'auto'});
  }

});
function reposition (){
  console.log('indeise');
  var imgHeightResize = $('#seletivaJoin img').height();
  var imgTopResize = 0 - ((imgHeightResize/100)*66);
  $('#seletivaJoin img').css({'top' : imgTopResize});

   var imgHeight2Resize = $('.profile img').height();
   var imgTop2Resize = 0 - (imgHeight2Resize/5)*3;
  $('.profile img').css({'top' : imgTop2Resize});
  var textHeight = $('#profile_text').height();
  var divHeigth = (textHeight/5)*8;
  $('.profile_textContainer').css({'height':divHeigth});

}

window.onload=reposition;
