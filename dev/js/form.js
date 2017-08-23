
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
