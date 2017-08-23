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
