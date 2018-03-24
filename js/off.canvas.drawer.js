(function ($) {

  // Insert necessary JavaScript stuff here.
  $(document).ready(function () {

    /* Primary Drawer Toggle */
    var pushTrigger = document.getElementsByClassName("drawer-toggle--primary");
    var pushPanel = document.getElementById("off-canvas-drawer--primary");
    var pushContent = document.getElementById("pushed-content");
    var pushMask = document.getElementById("off-canvas-mask");
    var activeClass = "off-canvas-drawer--is-active";
    var animatingClass = "off-canvas-drawer--is-animating";
    var i;
    document.body.classList.add("has-off-canvas-drawer");
    for (i = 0; i < pushTrigger.length; i++) {
      pushTrigger[i].addEventListener("click", function() {
          document.body.classList.toggle(activeClass);
          pushPanel.classList.toggle(activeClass);
          pushContent.classList.toggle(activeClass);
          pushMask.classList.toggle(activeClass);
          document.body.classList.add(animatingClass);
          pushPanel.classList.add(animatingClass);
          pushContent.classList.add(animatingClass);
          pushMask.classList.add(animatingClass);
      });
    }
    /* Old Safari requires 'webkit' prefix */
    pushPanel.addEventListener("webkitTransitionEnd", finishedAnimating);
    pushPanel.addEventListener("transitionend", finishedAnimating);
    function finishedAnimating() {
        document.body.classList.remove(animatingClass);
        pushPanel.classList.remove(animatingClass);
        pushContent.classList.remove(animatingClass);
        pushMask.classList.remove(animatingClass);
    }

  });

})(jQuery);
