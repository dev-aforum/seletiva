/**
 * Created by Papo2 on 01/06/2017.
 */

function validaForm(params){

    var valida = true;
    var notpermitidos = ['', '__/__/____',undefined, null];
    var config = {
        form: $("form"),
        notValidate: false,
        msgError: 'Preencha o(s) campo(s) obrigatório(s)',
        validate: false,
        msgValidate:  '',
        validaEmail: false

    }

    $.extend(config, params);
    var $form = config.form;
    $form.find(':input.required').each(function () {
        var $input = $(this);
        if($input.attr('id') != 'form_inscription_imgup1')
            $input.val($.trim($input.val()));

        var border = (!$input.val()) ? '1px solid red' : '1px solid #cecece';
        if ($.inArray($input.val(), notpermitidos) == 0) valida = false;

        $input.closest('input, .box_sel_d, textarea').css('border', border);
    });

    if (config.notValidate && !valida) msgErro(config.msgError);
    else if (config.validate&& valida);

    return valida;
}


function validaEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function msgErro(msg, time, func) {
    if(typeof time == 'undefined')
        time = 3000;
    if(typeof func == 'undefined')
        func = '';

    jError(
        msg,
        {
            autoHide: true, // added in v2.0
            clickOverlay: true, // added in v2.0
            MinWidth: 250,
            TimeShown: time,
            ShowTimeEffect: 200,
            HideTimeEffect: 200,
            LongTrip: 20,
            HorizontalPosition: 'center',
            VerticalPosition: 'top',
            ShowOverlay: true,
            ColorOverlay: '#000',
            OpacityOverlay: 1.0,
            onClosed: function () { // added in v2.0
                func;
            },
            onCompleted: function () { // added in v2.0
            }
        });
}

function msgSucesso(msg, time, func) {

    if(typeof time == 'undefined')
        time = 3000;

    if(typeof func == 'undefined')
        func = '';

    jSuccess(
        msg,
        {
            autoHide: true, // added in v2.0
            clickOverlay: true, // added in v2.0
            MinWidth: 250,
            TimeShown: time,
            ShowTimeEffect: 100,
            HideTimeEffect: 500,
            LongTrip: 20,
            HorizontalPosition: 'center',
            VerticalPosition: 'top',
            ShowOverlay: true,
            ColorOverlay: '#000',
            OpacityOverlay: 0.3,
            onClosed: function () { // added in v2.0
                func
            },
            onCompleted: function () { // added in v2.0
            }
        });
}
