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
  autoplaySpeed: 3000, // time each slide stays
  arrows: false,
  dots: false,
  speed: 800, // animation speed
  infinite: true,
  cssEase: 'ease-in-out' // makes the slide smooth
});

});