UBC CLF 7.0.2 DRUPAL THEME (aka Megatron)
=======================================

A responsive UBC CLF (Common Look and Feel) theme for Drupal 7. Created by the UBC IT Web Services Department.


UBC CLF 7.0 DRUPAL THEME FEATURES
_________________

Bootstrap / CLF:
grid, menu system (click to expand), status / alerts, form elements, markup compatible with default bootstrap markup, no need for conditional IE stylesheets

Drupal / Theme level:
- Modernizr
- Unit LESS files (and uncompressed CSS for everyone else)
- page / content type template suggestions (beyond page and blog)
- body classes to indicate page section and path for easier theming
- HTML5 markup
- ability to add / exclude css / js in .info file

Usage:
 - you MUST use an alternate admin theme or jQuery will be break. It is also recommended to use the 'edit / create content in admin theme' option on the /admin/appearance page.


RECOMMENDED MODULES
___________________

- AIS (Adaptive Image Styles) - for automating the creation of alternate image sizes that scale with the detected viewport
- Media - for inserting adaptive images into textarea fields (allows you to choose image style per image)
- Block Class - allows you to easily use ‘visible-phone / visible-tablet / visible-desktop’ type bootstrap styles on blocks of content


MODULES NOT RECOMMENDED
_______________________

- Environment Indicator - breaks in jQuery versions 1.8+

MODULES THAT REQUIRE THEME CHANGES
_______________________

- jQuery update - If jQuery update is used, you must remove the updated jQuery in template.php (megatron_js_alter). Additionally, the jQuery version should be 1.8.x.