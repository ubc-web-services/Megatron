<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 *
 * @ingroup themeable
 */
?>
<!DOCTYPE html>
  <!--[if IEMobile 7]><html class="no-js iem7 oldie" dir="<?php print $language->dir; ?>"><![endif]-->
  <!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" dir="<?php print $language->dir; ?>"><![endif]-->
  <!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" dir="<?php print $language->dir; ?>"><![endif]-->
  <!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="dir="<?php print $language->dir; ?>"><![endif]-->
  <!--[[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" dir="<?php print $language->dir; ?>"><!--<![endif]-->
  <head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="cleartype" content="on">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
</head>
<?php require_once(drupal_get_path('theme','megatron') . '/includes/template-ubc-clf-elements.inc'); ?>
<?php require_once(drupal_get_path('theme','megatron') . '/includes/config.php'); ?>
<div class="skip">
  <a href="#main" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  <a href="#ubc7-unit-menu" class="element-invisible element-focusable"><?php print t('Skip to main navigation'); ?></a>
</div>

<div class="container">
  <!-- UBC Global Utility Menu -->
  <div class="collapse expand" id="ubc7-global-menu">
      <div id="ubc7-search" class="expand">
          <div id="ubc7-search-box">
            <?php print theme('ubc_clf_toolbar'); ?>
          </div>
      </div>
      <div id="ubc7-global-header" class="expand">
          <!-- Global Utility Header from CDN -->
      </div>
  </div>
  <!-- End of UBC Global Utility Menu -->
  <!-- UBC Header -->
  <header id="ubc7-header" class="row-fluid expand" role="banner">
    <div class="span1">
      <div id="ubc7-logo">
        <a href="http://www.ubc.ca" tabindex="1" title="The University of British Columbia (UBC)">The University of British Columbia</a>
      </div>
    </div>
    <div class="span2">
      <div id="ubc7-apom">
        <a href="http://aplaceofmind.ubc.ca" tabindex="2" title="UBC a place of mind">UBC - A Place of Mind</a>                        
      </div>
    </div>
    <div class="span9" id="ubc7-wordmark-block">
      <div id="ubc7-wordmark">
        <a href="http://www.ubc.ca" tabindex="3" title="The University of British Columbia (UBC)">The University of British Columbia <span class="ubc7-campus" id="ubc7-<?php print theme_get_setting('clf_unit_campus'); ?>-campus"><?php print theme_get_setting('clf_unit_campus'); ?> campus</span></a>
      </div>
      <div id="ubc7-global-utility">
        <button data-toggle="collapse" data-target="#ubc7-global-menu" tabindex="4"><span>UBC Search</span></button>
        <noscript><a id="ubc7-global-utility-no-script" href="http://ubc.ca/" title="UBC Search">UBC Search</a></noscript>
      </div>
    </div>
  </header>
  <!-- End of UBC Header -->
  <!-- UBC Unit Identifier -->
  <div id="ubc7-unit" class="row-fluid expand">
    <div class="span12">
      <div class="navbar">
        <a class="btn btn-navbar" data-toggle="collapse" data-target="#ubc7-unit-navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      </div>
      <?php print theme('ubc_clf_header'); ?>
    </div>
  </div>
  <!-- End of UBC Unit Identifier -->
  <!-- Content Area -->
      <div id="main" class="expand row-fluid <?php if (!$is_front): print ' contentwrapper-node-'; ?><?php if (isset($node)): print $node->nid; endif; ?><?php endif; ?>">
        <div id="content" class="column<?php if (!$is_front): ?> maincontent-node-<?php if (isset($node)): print $node->nid; endif; ?><?php endif; ?>" role="main">

          <section class="span12">
          <?php if (!empty($title)): ?><h1 class="page-header"><?php print $title; ?></h1><?php endif; ?>
          <?php if (!empty($messages)): print $messages; endif; ?>
          <div style="margin-bottom: 2em;"><?php print $content; ?></div>
          </section> 

        </div><!-- /#content -->
      </div><!-- /#main -->

      <footer id="ubc7-footer" role="content-info" >
        <?php print theme('ubc_clf_visual_identity_footer'); ?>
        <?php print theme('ubc_clf_global_utility_footer'); ?>
      </footer>
    </div> <!-- /#container -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script src="//cdn.ubc.ca/clf/7.0.4/js/ubc-clf.min.js"></script>
    </body>
    </html>
