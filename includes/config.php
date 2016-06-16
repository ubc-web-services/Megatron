<?php if (theme_get_setting('colourpicker')): ?>
<style media="screen">
/* Header Option Overrides */
#ubc7-unit {
  background: #<?php print theme_get_setting('colourpicker') ?> !important;
  box-shadow: inset 0 -10px 10px -10px #333;
  -moz-box-shadow: inset 0 -10px 10px -10px #333;
  -webkit-box-shadow: inset 0 -10px 10px -10px #333;
}
</style>
<?php endif ?>
