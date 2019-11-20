jQuery(function($){
  $('.c-slick').slick({

  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  prevArrow: '<div class="slick-prev"><span class="fa fa-angle-left"></span><span class="sr-only">Prev</span></div>',
  nextArrow: '<div class="slick-next"><span class="fa fa-angle-right"></span><span class="sr-only">Next</span></div>',

  responsive: [
    {
      breakpoint: 901,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 601,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: false
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
  });
});
