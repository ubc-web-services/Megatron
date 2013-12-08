<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?> <?php print $doctype; ?>
  <!--[if IEMobile 7]><html class="no-js iem7 oldie" dir="<?php print $language->dir; ?>" <?php print $rdf->version . $rdf->namespaces; ?>><![endif]-->
  <!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" dir="<?php print $language->dir; ?>" <?php print $rdf->version . $rdf->namespaces; ?>><![endif]-->
  <!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" dir="<?php print $language->dir; ?>" <?php print $rdf->version . $rdf->namespaces; ?>><![endif]-->
  <!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" dir="<?php print $language->dir; ?>" <?php print $rdf->version . $rdf->namespaces; ?>><![endif]-->
  <!--[[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" dir="<?php print $language->dir; ?>" <?php print $rdf->version . $rdf->namespaces; ?>><!--<![endif]-->
  <head<?php print $rdf->profile; ?>>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="cleartype" content="on">
    <!--[if lte IE 7]>
  <link href="https://cdn.ubc.ca/clf/<?php print theme_get_setting('clf_clf_version'); ?>/css/font-awesome-ie7.css" rel="stylesheet">
  <![endif]-->
  <link rel="shortcut icon" href="//cdn.ubc.ca/clf/<?php print theme_get_setting('clf_clf_version'); ?>/img/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="//cdn.ubc.ca/clf/<?php print theme_get_setting('clf_clf_version'); ?>/img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="//cdn.ubc.ca/clf/<?php print theme_get_setting('clf_clf_version'); ?>/img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="//cdn.ubc.ca/clf/<?php print theme_get_setting('clf_clf_version'); ?>/img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="//cdn.ubc.ca/clf/<?php print theme_get_setting('clf_clf_version'); ?>/img/apple-touch-icon-57-precomposed.png">
  <link href="//cdn.ubc.ca/clf/<?php print theme_get_setting('clf_clf_version'); ?>/css/ubc-clf-<?php print theme_get_setting('clf_clf_package'); ?><?php print theme_get_setting('clf_clf_theme_new'); ?>.min.css" rel="stylesheet">
  <?php print $styles; ?>
  <?php $clf_scriptsoption = theme_get_setting('clf_scriptsoption');
  if ($clf_scriptsoption == 'head') { print $scripts; }
 ?>
  <script src="<?php print base_path() . path_to_theme();?>/js/lib/modernizr.custom.2.6.2.js"></script>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <?php print $page_top; ?>
  <?php print $page; ?> 
  <?php if ($clf_scriptsoption == 'footer') { print $scripts; } ?>
  <?php print $page_bottom; ?>
</body>
</html>
