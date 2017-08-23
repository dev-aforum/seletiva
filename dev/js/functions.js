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
