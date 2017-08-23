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
