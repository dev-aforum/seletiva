$(document).ready(function() {


  $(window).resize(function () {

    if ($(window).width() < 1024) {
      $("#imgEtapa-1").appendTo("#containerEtapa-1");
      $("#imgEtapa-2").appendTo("#containerEtapa-2");
      $("#offset-Etapa-2").remove();
      $("#imgEtapa-3").appendTo("#title-Etapa-3");
    }

  });

  if ($(window).width() < 1024) {
    $("#imgEtapa-1").appendTo("#containerEtapa-1");
    $("#imgEtapa-2").appendTo("#containerEtapa-2");
    $("#offset-Etapa-2").remove();
    $("#imgEtapa-3").appendTo("#title-Etapa-3");

  }
});

$(document).ready(function() {
  $("#estaForumTitle");
});

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

// Adaptação do texto ao tamanho da tela

$('body').flowtype();
$('body').flowtype({
 minimum   : 300,
 maximum   : 1200,
 minFont   : 6,
 maxFont   : 30,
 fontRatio : 70
});


$(document).ready(function(){
  lookInputNumberAndChange('#form_inscription_age','.form_inscription_tutorData', 18);

  fillSelectWithNumber(99,"#form_inscription_age" );

  //image preview 01
  $.uploadPreview({
    input_field: "#form_inscription_imgup1",   // Default: .image-upload
    preview_box: "#form_inscription_imgPreview1",  // Default: .image-preview
    label_field: "#form_upload_button_fakeButton1",    // Default: .image-label
    label_default: "Adcionar foto",   // Default: Choose File
    label_selected: "Trocar foto",  // Default: Change File
    no_label: false,                 // Default: false
    success_callback: function(){
      $('#form_upload_button_fakeButton1').addClass('text');
    }
  });

  //image preview 01
  $.uploadPreview({
    input_field: "#form_inscription_imgup2",   // Default: .image-upload
    preview_box: "#form_inscription_imgPreview2",  // Default: .image-preview
    label_field: "#form_upload_button_fakeButton2",    // Default: .image-label
    label_default: "Adcionar foto de corpo",   // Default: Choose File
    label_selected: "Trocar foto de corpo",  // Default: Change File
    no_label: false,                 // Default: false
    success_callback: function(){

    }
  });

});

/**********************************************
FORMS & UI
**********************************************/

/* lookInputNumberAndChange
 * PURPOSE : Trigger a input and compares the input number with a condition to show or not a html object
 *  PARAMS : JQuery selector - inputToLook | JQuery selector - objectsToShow | numberCondition - interger
 * RETURNS :
 *   NOTES : Good to see if someone is older than a specific age
 */
function lookInputNumberAndChange (inputToLook, objectsToShow, numberCondition){
  //when input changes
  $(inputToLook).on('change',function(){
   var selected = $(inputToLook).val(); //get value from object

   //if the object is lower than the condition show it, if ot hide it
   if(selected < numberCondition){
      $(objectsToShow).show(); //show object
    } else if (selected >= numberCondition) {
      $(objectsToShow).hide(); //hide object
    }
 });
}

/*showOnClick
 * PURPOSE : Shows trigger object to show something if hidden
 *  PARAMS : JQuery selector - buttonId | JQuery selector - toShowId
 * RETURNS :
 *   NOTES :
 */

function showOnClick(buttonId, toShowId){
  // when user clicks on something
  $(buttonId).on('click',function(e){
    var toShow_css_diplay = $(toShowId).css('display'); // get css display of object to show
    if( toShow_css_diplay == 'none') { // if it's not shown fadein objcet
      $(toShowId).css({'display':'inherit'}).hide().fadeIn();
    } //end of if
  });//end of click trigger
} //end on showOnClick


/* formSelectChange
 * PURPOSE : Hide or show an element in the HTML DOM depending on value of another one
 *  PARAMS : formselect,hidden
 * RETURNS : JQuery selector of the select- formselect | Array JQuery objects id to match class in the option- hidden
 *   NOTES :
 */

function formSelectChange (formselect, hidden){
  console.log("formSelectChange");
  console.log("formselect: " + formselect);
  console.log("hidden: " + hidden);

  $(formselect).change(function(){ // if object changes

    var selected = $(formselect).val();//get object value;


    // for each of the hidden elements
    $.each(hidden, function(index,value){
      // if its equal to the seleted value show, if its not hid
      console.log('value: ' + value);
      if (selected == value){
        $("#" + value).show();
      } else {
        $("#" + value).hide();
      }//end of if else
    });//end of each
  });//end of trigger
}//end of formSelectChange


/* imagePreview
 * PURPOSE : Preview image upload inside an object of the HTML DOM
 *  PARAMS : JQuery selector of Input with  'filetype' = 'File' - inputsClass | JQuery selector - displayArea
 * RETURNS :
 *   NOTES :
 */
function imagePreview (inputsClass,displayArea){

    $(inputsClass).change(function(){ // if object changes


    var fileType = $(this).prop('files')[0].type;//get filetype of upload object

    var file = $(this).prop('files')[0];//get the files
    console.log(file);

    //if the file is and image with suported filetype or tell user that file is not suported
    if( fileType == 'image/jpeg' | fileType == 'image/png'){
      var reader = new FileReader();//create a new reader
      //when the reader is created
      reader.onload = function(e){
        $(displayArea).append(
        '<img src=' + e.result + '>'
        );//end of append
      };//end of reder.onlod
      reader.readAsDataURL(file);//get reader to read the file
    } else {
      $(displayArea).append(
      '<p>Arquivo não suportado</p>'
      );//end of append
    }//end of if else
  });//end of change trigger
}//end of imagePreview

/*fillSelectWithNumber
 * PURPOSE : fill a select with numeric options of choice
 *  PARAMS :  interger - numberOfOptions | JQuery Selector selectId
 * RETURNS :  -
 *   NOTES :
 */
function fillSelectWithNumber (numberOfOptions, selectId){
  //get a js version of number passed
  JsNumberOfOptions = numberOfOptions-1;
  //loop number passed times adding the options
  for (x=0; x<=JsNumberOfOptions; x++){
    $(selectId).append(
    "<option value='" + x + "'>" + x + "</option>"
    ); //end of append
  } //end of for
} //end of fillSelectWithNumber

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

//we get all the youtube class divs in a variable
var youtube = document.querySelectorAll( ".youtube" );

//THUMBNAIL
//loop trought all the divs
for (var i = 0; i<youtube.length;i++){
  var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";

  // Load the image asynchronously
   var image = new Image();
       image.src = source;
       image.addEventListener( "load", function() {
           youtube[ i ].appendChild( image );
       }( i ) );

  //VIDEO
 //add the video onClick
 youtube[i].addEventListener( "click", function() {
     var iframe = document.createElement( "iframe" );
     iframe.setAttribute( "frameborder", "0" );
     iframe.setAttribute( "allowfullscreen", "" );
     iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );
     this.innerHTML = "";
     this.appendChild( iframe );
     iframe.playVideo();
   } );
}

// $(document).ready(function() {
//   if( $(window).width() < 700) {
//     setTimeout(function(){
//       $(".loading").removeClass('loading').addClass('fadeIn');
//     },8000)
//   } else {
//     setTimeout(function(){
//       $(".loading").removeClass('loading').addClass('fadeIn');
//     },3000)
//   }
//
//
// });

$(document).ready(function(){

  // MASCARA
  // guardamos altura e a largura da tela em variaveis
  var windowWidth = $(window).width();
  var windowHeigth = $(window).height();
  // adcionamos o tamanho da mascara de acordo com o tamanho da tela
  $('.modal_mascara').css({
    'height': windowHeigth,
    'width' : windowWidth,
  });
  // caso a tela troque de tamanho, mudamos o tamanho da máscara
  $('.modal_mascara').on('resize',function(){
    // guardamos altura e a largura da tela em variaveis
    windowWidth = $(window).width();
    windowHeigth = $(window).height();
    // adcionamos o tamanho da mascara de acordo com o tamanho da tela
    $('.modal_mascara').css({
      'height': windowHeigth,
      'width' : windowWidth,
    });
  });




  // BOTÃO DE FECHAR
  function modalEmpty(){
    $('.modal_container').empty();
  }

  function modalHide(){
    $('.modal').fadeOut(200,function(){
      $('.modal_mascara').hide();
      $(this).css({'display':'none'});
    });
  }

  function modalClose(){
    modalHide();
  }

  $('.modal_close').click(function(ev){
    // impedimos o comportamento normal do click
    ev.preventDefault();
    modalClose(); //chamamos a função que fecha e limpa a modal
    $('.modal_content').css({'display':'none'});
  });


    // LINK PARA MODAL
    // ADCIONAR CONTEUDO
    function setModal(modalLinkId, htmlToAppend){
      // MODAL
      // guardamos altura e a largura da tela em variaveis
      var windowWidth = $(window).width();
      var windowHeigth = $(window).height();
      // guardamos em uma variavel a posição da janela
      var windowPosition = $(document).offset();
      // posicionamos o modal de acordo com o tamanho da tela
      $('.modal').css({
        'top': windowPosition.top,
        'left' : windowPosition.left,
        'height' : windowHeigth,
        'width' : windowWidth,
      });
      $('#'+modalLinkId).on('click', function(ev){
        console.log('dentro da func de modal');
        // garatimos que nenhnum outro comparmento seja disparado
        ev.preventDefault();
        $('.modal_mascara').css({'display':'inherit'}).hide().fadeIn(1000);
        $('.modal').css({'display':'inherit'}).hide().fadeIn(1000);
        $('#modal_' + modalLinkId).css({'display':'block'}).hide().fadeIn(1000);
        $('.sliderModal').css({'height':(windowHeigth/5)*4});
        $('.sliderModal_img').css({'height':(windowHeigth/5)*3});
        $('.sliderModal_' + modalLinkId).flickity({
          contain: true,
          dragable: true,
          wrapAround: true,
          lazyLoad: 5,
        });
      });
    }

    // CRIANDO MODAIS PARA LINKS

    // portfolio_1
    // for (x)
    setModal('portfolio_1');
    setModal('portfolio_2');
    setModal('portfolio_3');
    setModal('portfolio_4');
    setModal('portfolio_5');
    setModal('portfolio_6');
    setModal('portfolio_7');
    setModal('portfolio_8');
    setModal('portfolio_9');
    setModal('portfolio_10');
    setModal('portfolio_11');
    setModal('portfolio_12');



});

// console.log("WAYPOINT!");

$(document).ready(function() {


console.log(document.getElementById('fadeInOnScoll'));
var icones = new Waypoint({
  element: document.getElementById('fadeInOnScoll'),
  context: document.getElementById("container"),
  handler: function(element) {

      alert("ASDASDAS");
    // alert("ADASDAS")
    // notify('Basic waypoint triggered')
    // console.log(this.element);
    // this.element.setAttribute("class","animated FadeIn");

  }
  // ,
  // offset: "100%"
});

// var waypoint = new Waypoint({
//   element: document.getElementById('px-offset-waypoint'),
//   handler: function(direction) {
//     notify('I am 20px from the top of the window')
//   },
//   offset: 20
// });

console.log(icones);
console.log(icones.element);
console.log(icones.handler);
console.log(icones.callback);
// alert("waypoints read");

});
