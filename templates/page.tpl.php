<?php 

	/*	
	Available variables:
	
	General utility variables:
	$base_path: The base URL path of the Drupal installation. At the very least, this will always default to /.
	$directory: The directory the template is located in, e.g. modules/system or themes/bartik.
	$is_front: TRUE if the current page is the front page.
	$logged_in: TRUE if the user is registered and signed in.
	$is_admin: TRUE if the user has permission to access administration pages.
	
	Site identity:
	$front_page: The URL of the front page. Use this instead of $base_path, when linking to the front page. This includes the language domain or prefix.
	$logo: The path to the logo image, as defined in theme configuration.
	$site_name: The name of the site, empty when display has been disabled in theme settings.
	$site_slogan: The slogan of the site, empty when display has been disabled in theme settings.
	Navigation:
	
	$main_menu (array): An array containing the Main menu links for the site, if they have been configured.
	$secondary_menu (array): An array containing the Secondary menu links for the site, if they have been configured.
	$breadcrumb: The breadcrumb trail for the current page.
	
	Page content (in order of occurrence in the default page.tpl.php):
	$title_prefix (array): An array containing additional output populated by modules, intended to be displayed in front of the main title tag that appears in the template.
	$title: The page title, for use in the actual HTML content.
	$title_suffix (array): An array containing additional output populated by modules, intended to be displayed after the main title tag that appears in the template.
	$messages: HTML for status and error messages. Should be displayed prominently.
	$tabs (array): Tabs linking to any sub-pages beneath the current page (e.g., the view and edit tabs when displaying a node).
	$action_links (array): Actions local to the page, such as 'Add menu' on the menu administration interface.
	$feed_icons: A string of all feed icons for the current page.
	$node: The node object, if there is an automatically-loaded node associated with the page, and the node ID is the second argument in the page's path 
	(e.g. node/12345 and node/12345/revisions, but not comment/reply/12345).
	
	Regions:
	$page['help']: Dynamic help text, mostly for admin pages.
	$page['highlighted']: Items for the highlighted content region.
	$page['content']: The main content of the current page.
	$page['sidebar_first']: Items for the first sidebar.
	$page['sidebar_second']: Items for the second sidebar.
	$page['header']: Items for the header region.
	$page['footer']: Items for the footer region.
	
	*/

?>
<?php require_once(drupal_get_path('theme','megatron') . '/includes/config.php'); ?>
<?php $mobilenav = theme_get_setting('clf_navoption'); ?>
<?php 
$clf_layout = theme_get_setting('clf_layout');
$containerstart = '';
$containerend = '';
$fluidcontainerstart = '';
$fluidcontainerend = '';
if (($clf_layout == '__full') || ($clf_layout == '__fluid')) {
    $fluidcontainerstart = '<div class="container">';
    $fluidcontainerend = '</div>';
}
if ($clf_layout == '') {
    $containerstart = '<div class="container">';
    $containerend = '</div>';
} ?>
<div class="skip">
  <a href="#main" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  <a href="#ubc7-unit-menu" class="element-invisible element-focusable"><?php print t('Skip to main navigation'); ?></a>
</div>

<?php print $containerstart; ?>
  <!-- UBC Global Utility Menu -->
  <div class="collapse expand" id="ubc7-global-menu">
      <div id="ubc7-search" class="expand">
        <?php print $fluidcontainerstart; ?>
          <div id="ubc7-search-box">
            <?php if (!empty($page['search'])): print render($page['search']); else: print theme('ubc_clf_toolbar'); endif; ?>
          </div>
        <?php print $fluidcontainerend; ?>
      </div>
      <?php print $fluidcontainerstart; ?>
      <div id="ubc7-global-header" class="expand">
          <!-- Global Utility Header from CDN -->
      </div>
      <?php print $fluidcontainerend; ?>
  </div>
  <!-- End of UBC Global Utility Menu -->
  <!-- UBC Header -->
  <header id="ubc7-header" class="row-fluid expand" role="banner">
    <?php print $fluidcontainerstart; ?>
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
    <?php print $fluidcontainerend; ?>
  </header>
  <!-- End of UBC Header -->
  <!-- UBC Unit Identifier -->
  <div id="ubc7-unit" class="row-fluid expand">
    <?php print $fluidcontainerstart; ?>
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
    <?php print $fluidcontainerend; ?>
  </div>
  <!-- End of UBC Unit Identifier -->
  <!-- UBC Unit Navigation -->
  <?php if (!empty($primary_nav)): ?>
  <nav id="ubc7-unit-menu" role="navigation" class="navbar expand">
    <div class="navbar-inner expand">
      <?php print $fluidcontainerstart; ?>
      <div class="nav-collapse collapse" id="ubc7-unit-navigation">
        <?php print $primary_nav; ?>
      </div>
      <?php print $fluidcontainerend; ?>
    </div>
  </nav>
  <?php endif; ?>
  <!-- End of UBC Unit Navigation -->
  <!-- UBC Unit Breadcrumbs -->
  <?php if (($clf_layout == '__full') || ($clf_layout == '__fluid')): ?>
  <div class="full-width-container">
  <?php endif; ?>
  <?php if (!empty($breadcrumb) && (!$is_front)): ?>
  <?php print $breadcrumb; ?>
  <?php endif; ?> 
  <!-- End of UBC Unit Breadcrumbs -->
  <!-- Content Area -->
   <?php if (!empty($page['highlighted'])): ?>
     <div class="highlighted inflate"><?php print render($page['highlighted']); ?></div>
   <?php endif; ?>
  
  <div id="main" class="expand row-fluid <?php if (!$is_front): print ' contentwrapper-node-'; ?><?php if (isset($node)): print $node->nid; endif; ?><?php endif; ?>">
    <div id="content" class="column<?php if (!$is_front): ?> maincontent-node-<?php if (isset($node)): print $node->nid; endif; ?><?php endif; ?>" role="main">
      
      <?php if (!empty($page['sidebar_first']) && (!$is_front)): ?>
      <aside class="span3 region region-sidebar-first" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
      <?php endif; ?>
      
      <section class="<?php print _megatron_content_span($columns); ?>">  
        <?php print render($title_prefix); ?>
        <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php print $messages; ?>
        <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
        <?php endif; ?>
        <?php if (!empty($page['help'])): ?> 
        <div class="well"><?php print render($page['help']); ?></div>
        <?php endif; ?>
        <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <?php print render($page['content']); ?>
      </section>
      
      <?php if (!empty($page['sidebar_first']) && ($is_front)): ?>
      <aside class="span4 region region-sidebar-first" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
      <?php endif; ?>
 
      <?php if (!empty($page['sidebar_second']) && (!$is_front)): ?>
      <aside class="span3 region region-sidebar-second" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
      <?php endif; ?>

    </div><!-- /#content -->
  </div><!-- /#main -->
  
  <?php if (!empty($page['prefooter'])): ?> 
    <?php print render($page['prefooter']); ?>
  <?php endif; ?>
  <?php if (($clf_layout == '__full') || ($clf_layout == '__fluid')): ?>
  </div>
  <?php endif; ?>
  
  <!-- Footer Area Unit Menu - Mobile Only -->
  <?php if (!empty($primary_nav) && (!empty($mobilenav))): ?>
  <div id="ubc7-unit-alternate-navigation" class="navbar expand visible-phone" role="navigation">
    <div class="navbar-inner expand">
      <?php print $fluidcontainerstart; ?>
      <div class="nav-collapse collapse">
        <?php print $primary_nav; ?>
      </div>
      <?php print $fluidcontainerend; ?>
    </div>
  </div>
  <?php endif; ?>
  <!-- End of Footer Area Unit Menu -->
    
  <footer id="ubc7-footer" role="contentinfo" >
    <?php print theme('ubc_clf_visual_identity_footer'); ?>
    <?php print theme('ubc_clf_global_utility_footer'); ?>
  </footer>
<?php print $containerend; ?> <!-- /#container -->
