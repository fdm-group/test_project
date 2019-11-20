jQuery(function($){
window.onscroll = function() {navScroll()};

function navScroll() {
  if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
    //var logo = document.getElementById("logo");

    $("#navigation").addClass("shrink-nav");
      $("#img").addClass("shrink-logo");

      //document.getElementById("navigation").addClass("shrink-nav");
      //document.getElementById("img").addClass("shrink-nav");
  } else {
    //document.getElementById("navigation").style.height = "60px";
  /*  document.getElementById("navigation").style.padding = "10px 15px 10px 15px";
    document.getElementById("img").width = "120";

    document.getElementById("img").margin = "10";
    document.getElementById("navigation").style.opacity = "1";
    document.getElementById("navigation").style.height = "95px";
    */

    $("#navigation").removeClass("shrink-nav");
      $("#img").removeClass("shrink-logo");
  }
}

});
