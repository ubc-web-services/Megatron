(function () {

  Drupal.behaviors.clfFlyout = {
    attach: function (context, settings) {
      // Primary flyout toggle.
      if (document.getElementsByClassName("flyout-toggle").length > 0) {
        var pushTrigger = document.getElementsByClassName("flyout-toggle");
        var pushPanel = document.getElementById("off-canvas-flyout");
        var pushContent = document.getElementById("pushed-content");
        var pushMask = document.getElementById("off-canvas-mask");
        var activeClass = "off-canvas-flyout--is-active";
        var animatingClass = "off-canvas-flyout--is-animating";
        var i;
        document.body.classList.add("has-off-canvas-flyout");
        for (i = 0; i < pushTrigger.length; i++) {
          pushTrigger[i].addEventListener("click", function () {
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
        // Old Safari requires 'webkit' prefix.
        pushPanel.addEventListener("webkitTransitionEnd", finishedAnimating);
        pushPanel.addEventListener("transitionend", finishedAnimating);

        function finishedAnimating() {
          document.body.classList.remove(animatingClass);
          pushPanel.classList.remove(animatingClass);
          pushContent.classList.remove(animatingClass);
          pushMask.classList.remove(animatingClass);
        }
      }
    }
  }
}());
