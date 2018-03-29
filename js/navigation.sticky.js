(function ($) {

  // Insert necessary JavaScript stuff here.
  $(document).ready(function () {

    window.onscroll = function() { stickyNav() };
    var navbar = document.getElementById("ubc7-unit-menu");
    var unitbar = document.getElementById("ubc7-unit");
    var stickynav = navbar.offsetTop;
    var stickyunit = unitbar.offsetTop;
    function stickyNav() {
      if (window.pageYOffset >= stickynav) {
        navbar.classList.add("navigation-is-sticky");
        document.body.classList.add("unit-menu-is-sticky");
      } else {
        navbar.classList.remove("navigation-is-sticky");
        document.body.classList.remove("unit-menu-is-sticky");
      };
      if (window.pageYOffset >= stickyunit) {
        unitbar.classList.add("navigation-is-sticky");
        document.body.classList.add("unit-area-is-sticky");
      } else {
        unitbar.classList.remove("navigation-is-sticky");
        document.body.classList.remove("unit-area-is-sticky");
      }
    }

  });

})(jQuery);
