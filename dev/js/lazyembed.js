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
