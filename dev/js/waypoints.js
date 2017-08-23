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
