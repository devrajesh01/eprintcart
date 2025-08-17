$(document).ready(function () {
  var header = $("header");
  var sticky = header.offset().top;

  $(window).scroll(function () {
    if (window.pageYOffset > sticky) {
      header.addClass("fixed");
    } else {
      header.removeClass("fixed");
    }
  });

  // banner slider
  $('.banner-slider').slick({
  autoplay: true,
  autoplaySpeed: 2000, 
  arrows: false,
  dots: false,
  speed: 1200, 
  infinite: true,
  cssEase: 'ease-in-out' 
});

});