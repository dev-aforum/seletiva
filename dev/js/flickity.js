// SLIDERS
// descobertas
$(document).ready(function(){
  $('.descobertas_sliderNav').flickity({
    contain: true,
    dragable: true,
  });
});

// feedack
$(document).ready(function(){
  $('#feedback_mainRow').flickity({
    contain: true,
    dragable: true,
    autoPlay: 5000,
    wrapAround: true,
    adaptiveHeight: true,
  });

});

// depoimentos
$(document).ready(function(){
  $('.opiniao_slider').flickity({
    dragable: true,
    contain: true,
    autoPlay: 5000,
    wrapAround: true,
  });
});


$(document).ready(function(){
  $('.portfolio_slider').flickity({
    contain: true,
    dragable: true,
    autoPlay: 5000,
    wrapAround: true,
    pageDots: false,
    lazyLoad: true,
  });
});
//modal
