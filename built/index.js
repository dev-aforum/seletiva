$(document).ready(function() {

    $("#form_inscription_celphone").mask("(99) 9999 - 9999?9");
    $("#form_inscription_telephone").mask("(99) 9999 - 9999?9");
});

$(document).ready(function(){
    $('#form_inscription_age').change(function(){
        if($(this).val() < 18){
            $('#tutorName').css('display','block');
            $('#tutorId').css('display','block');
            $('#tutorName').addClass('required');
            $('#tutorId').addClass('required');
        }else{
            $('#tutorName').css('display','none');
            $('#tutorId').css('display','none');
            $('#tutorName').removeClass('required');
            $('#tutorId').removeClass('required');
        }
    });

$('#btn-sm-scouter').click(function(e){
        e.preventDefault();
            // ($('#form_inscription_imgup1').val() == ''? $('#form_inscription_imgPreview1').css('border','1px solid red') : $('#form_inscription_imgPreview1').css('border',''));
            var valida = validaForm({
                form:$("form[name='form_inscription']"),
                notValidate: true,
                //msgError: 'ampos.',
                validate: false
            });
            if (!valida){
                return false;
            }else{
                $(".loading-animation").removeClass('hide');
                var data = new FormData($("form[name=form_inscription]")[0]);
                setTimeout(function(){
                    enviarForm(data);
                },1000)
            };
    });

    $('#form_inscription_email').change(function(){
        if(!validaEmail($(this).val())){
            msgErro('E-mail inválido');
            $('#form_inscription_email').val('');
        }
    });


});

function enviarForm(data){
    //Local
    //var url = 'http://192.168.0.87/forum_dev/cadastroScouterSeletiva/';
    //Homologa
    //var url = 'http://intranet.aforum.com.br/homologa/cadastroScouterSeletiva/';
    //Produção
    var url = 'https://intranet.aforum.com.br/cadastroScouterSeletiva/';

    //se o cookie de nome ainda não estiver definido
    if ( Cookies.get("name") === undefined ) {

      Cookies.set( "name" , $("[name='user_name']").val() );
    //   $(".loading-animation").show();
      $.ajax({
          type: "POST",
          url: url,
          processData: false,
          contentType: false,
          data: data,
        //   async: false,
          dataType: 'json',
          success: function (data) {
              if(data.sucesso == 0){
                  $(".loading-animation").addClass('hide');
                  msgSucesso(data.mensagem,1000);
                  setTimeout(function(){
                    location = "sucesso.html";
                  },2000);

              }else{
                  $(".loading-animation").addClass('hide');
                  msgErro(data.mensagem,1000);
              }
          }
      });



    } else {

      if( Cookies.get("name") === $("[name='user_name']").val() ){

        alert("O cadastro de " + $("[name='user_name']").val() + " já foi realizado" );
        $(".loading-animation").addClass('hide');

      } else {

        Cookies.set( "name" , $("[name='user_name']").val() );
        // $(".loading-animation").show();
        $.ajax({
            type: "POST",
            url: url,
            processData: false,
            contentType: false,
            data: data,
            // async: false,
            dataType: 'json',
            success: function (data) {
                if(data.sucesso == 0){
                    $(".loading-animation").addClass('hide');
                    msgSucesso(data.mensagem,1000);
                    setTimeout(function(){
                      location = "sucesso.html";
                    },2000);


                }else{
                    $(".loading-animation").addClass('hide');
                    msgErro(data.mensagem,1000);
                }
            }
        });

      }
    }
}
