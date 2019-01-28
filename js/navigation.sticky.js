(function () {

  Drupal.behaviors.megatronStickyNav = {
    attach: function (context, settings) {

      var navbar = document.getElementById("ubc7-unit-menu");
      var unitbar = document.getElementById("ubc7-unit");
      var stickynav = navbar.offsetTop;
      var stickyunit = unitbar.offsetTop;
      var latestKnownScrollY = 0;
      var ticking = false;

      function onScroll() {
        latestKnownScrollY = window.scrollY;
        requestTick();
      }

      function requestTick() {
        if (!ticking) {
          window.requestAnimationFrame(update);
        }
        ticking = true;
      }

      function update() {
        ticking = false;
        var currentScrollY = latestKnownScrollY;

        /* Issue with modal close button
        console.log showed that CTools modal close button adds numerous zero values to stickynav var.
        We were getting the original correct value (178) followed by zero values, which made the nav perpetually stick.
        On every modal open/close, more zero values were being added (due to the nature of Drupal behaviors called repeatedly).
        Checking stickynav > 0 is a bandaid solution to a bigger issue of vanilla js firing repeatedly within Drupal behaviors.
        */
        if (stickynav > 0) {
          //toggle classes
          if (currentScrollY >= stickynav) {
            navbar.classList.add("navigation-is-sticky");
            document.body.classList.add("unit-menu-is-sticky");
          }
          else {
            navbar.classList.remove("navigation-is-sticky");
            document.body.classList.remove("unit-menu-is-sticky");
          }
          if (currentScrollY >= stickyunit) {
            unitbar.classList.add("navigation-is-sticky");
            document.body.classList.add("unit-area-is-sticky");
          }
          else {
            unitbar.classList.remove("navigation-is-sticky");
            document.body.classList.remove("unit-area-is-sticky");
          }
        }

      }

      // window.requestAnimationFrame(update);
      window.addEventListener('scroll', onScroll, false);
    }
  }

}());
