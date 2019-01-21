(function () {

  Drupal.behaviors.megatronFlyout = {
    attach: function (context, settings) {
      // Primary flyout toggle.
      if (document.getElementsByClassName("flyout-toggle").length > 0) {
        var pushTrigger = document.getElementById("flyout-button");
        var closeTrigger = document.getElementsByClassName("flyout__close");
        var pushMask = document.getElementById("off-canvas-mask-flyout");
        var pushPanel = document.getElementById("off-canvas-flyout");
        var pushContent = document.getElementById("pushed-content-flyout");
        var activeClass = "off-canvas-flyout--is-active";
        var animatingClass = "off-canvas-flyout--is-animating";
        var i;
        document.body.classList.add("has-off-canvas-flyout");
        pushTrigger.addEventListener("click", flyOutOpen, true);
        pushMask.addEventListener("click", flyOutClose, true);
        for (i = 0; i < closeTrigger.length; i++) {
          closeTrigger[i].addEventListener("click", flyOutClose, true);
        }
        function flyOutOpen(e) {
          console.log('open clicked');
          document.body.classList.add(activeClass);
          pushPanel.classList.add(activeClass);
          pushContent.classList.add(activeClass);
          pushMask.classList.add(activeClass);
          document.body.classList.remove(animatingClass);
          pushPanel.classList.remove(animatingClass);
          pushContent.classList.remove(animatingClass);
          pushMask.classList.remove(animatingClass);
        }
        function flyOutClose(e) {
          console.log('close clicked');
          document.body.classList.remove(activeClass);
          pushPanel.classList.remove(activeClass);
          pushContent.classList.remove(activeClass);
          pushMask.classList.remove(activeClass);
          document.body.classList.add(animatingClass);
          pushPanel.classList.add(animatingClass);
          pushContent.classList.add(animatingClass);
          pushMask.classList.add(animatingClass);
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
