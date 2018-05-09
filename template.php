<?php

/** Implements hook_theme().
---------------------------------------------------------- */
function megatron_theme() {
  return array(
    'ubc_clf_toolbar' => array(
      'variables' => array('element' => NULL),
    ),
    'ubc_clf_header' => array(
      'variables' => array('element' => NULL),
    ),
    'ubc_clf_unit' => array(
      'variables' => array('element' => NULL),
    ),
    'ubc_clf_visual_identity_footer' => array(
      'variables' => array('element' => NULL),
    ),
    'ubc_clf_global_utility_footer' => array(
      'variables' => array('element' => NULL),
    ),
    'megatron_links' => array(
      'variables' => array(
        'links' => array(),
        'attributes' => array(),
        'heading' => NULL,
      ),
    ),
    'megatron_secondary_links' => array(
      'variables' => array(
        'links' => array(),
        'attributes' => array(),
        'heading' => NULL,
      ),
    ),
    'megatron_btn_dropdown' => array(
      'variables' => array('links' => array(), 'attributes' => array(), 'type' => NULL),
    ),
  );
}

/** SANITIZE STRING FOR INJECTION
---------------------------------------------------------- */
function megatron_id_safe($string) {
  // Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
  $string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
  // If the first character is not a-z, add 'n' in front.
  if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
    $string = 'id'. $string;
  }
  return $string;
}

/** CHANGE DEFAULT META CONTENT-TYPE TAG TO HTML5 VERSION
---------------------------------------------------------- */
function megatron_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**Changes the search form to use the HTML5 "search" input attribute
---------------------------------------------------------- */
function megatron_preprocess_search_block_form(&$variables) {
  $variables['search_form'] = str_replace('type="text"', 'type="search"', $variables['search_form']);
}

/** HTML.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function megatron_preprocess_html(&$variables) {
  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  if (!$variables['is_front'] && !theme_get_setting('clf_use_path_body_classes')) {
    // Add unique class for each page.
    $path = drupal_get_path_alias($_GET['q']);
    // Add unique class for each website section.
    list($section, ) = explode('/', $path, 2);
    if (arg(0) == 'node') {
      if (arg(1) == 'add') {
        $section = 'node-add';
      }
      elseif (is_numeric(arg(1)) && (arg(2) == 'edit' || arg(2) == 'delete')) {
        $section = 'node-' . arg(2);
      }
    }
    // Add a body class that reflects content placement.
    $variables['classes_array'][] = drupal_html_class('section-' . megatron_id_safe($section));
    $variables['classes_array'][] = drupal_html_class('path-' . megatron_id_safe($path));
  }
  // Add a body class to tell us what colours we're using.
  $variables['classes_array'][] = drupal_html_class('themecolour' . theme_get_setting('clf_clf_theme_new'));

  // Uses RDFa attributes if the RDF module is enabled
  // Lifted from Adaptivetheme for D7, full credit to Jeff Burnz
  // Add rdf info
  $variables['doctype'] = '<!DOCTYPE html>' . "\n";
  $variables['rdf'] = new stdClass;
  $variables['rdf']->version = '';
  $variables['rdf']->namespaces = '';
  $variables['rdf']->profile = '';

  if (module_exists('rdf')) {
    $variables['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+RDFa 1.1//EN">' . "\n";
    $variables['rdf']->version = 'version="HTML+RDFa 1.1"';
    $variables['rdf']->namespaces = $variables['rdf_namespaces'];
    $variables['rdf']->profile = ' profile="' . $variables['grddl_profile'] . '"';
  }

  // Add js libraries and scripts
  $clfVerison = theme_get_setting('clf_clf_version');
  $options = array(
    'group' => JS_THEME,
  );
  drupal_add_js('//cdn.ubc.ca/clf/' . $clfVerison . '/js/ubc-clf.min.js', array(
    'type' => 'external',
    'group' => JS_LIBRARY,
    'weight' => 0,
  ));

  $showSecondary = theme_get_setting('clf_secondarynavoption');
  if ($showSecondary) {
    drupal_add_css(path_to_theme('megatron') . '/css/secondary-nav.css', array(
      'group' => CSS_THEME,
      'weight' => 115,
      'every_page' => TRUE,
      'preprocess' => FALSE,
    ));
  }

  // Add body classes if layout is not default
  $clfLayout = theme_get_setting('clf_layout');
  if (($clfLayout == '__full') || ($clfLayout == '__fluid')) {
    $variables['classes_array'][] = drupal_html_class('full-width');
  }
  if ($clfLayout == '__fluid') {
    $variables['classes_array'][] = drupal_html_class('full-width-left');
  }
  // Add body class if theme_get_setting('clf_nogradient') is set to true
  if (theme_get_setting('clf_nogradient') == TRUE) {
    $variables['classes_array'][] = drupal_html_class('no-gradient');
  }

  /* ADD A NOFOLLOW META TAG TO PREVENT SITE INDEXING IF IT IS NOT A PRODUCTION WEBSITE */
  // Setup meta tag
  if (theme_get_setting('clf_environment')) {
    $nofollow = array(
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => array(
        'name' =>  'robots',
        'content' => 'noindex, nofollow',
      )
    );
    // Add header meta tag
    drupal_add_html_head($nofollow, '$nofollow');
  }

  // ADD CSS
  $packageprefix = '7.0.4/css/ubc-clf';
  $minversion = '';
  $packagesuffix = '.min';
  $minlayout = '-full';
  if (theme_get_setting('clf_clf_minimal') == TRUE) {
    $packageprefix = '7.0.4-minimal/css/minimal-clf';
    $minversion = '-7.0.4';
    $minlayout = '';
    $packagesuffix = '';
    if ((theme_get_setting('clf_layout') == '__full') || (theme_get_setting('clf_layout') == '__fluid')) {
      $minlayout = '-full';
    }
  }
  drupal_add_css('https://cdn.ubc.ca/clf/' . $packageprefix . $minlayout . $minversion . theme_get_setting('clf_clf_theme_new') . $packagesuffix . '.css', array('type' => 'external', 'group'=>CSS_THEME, 'every_page' => TRUE, 'weight' => -2));
  drupal_add_css(drupal_get_path('theme', 'megatron') . '/css/clf_drupal.css', array('group' => CSS_THEME, 'every_page' => TRUE, 'weight' => -1));
  // ADD JAVASCRIPT
  // Load modernizr if requested
  if (theme_get_setting('clf_modernizr')) {
    drupal_add_js(drupal_get_path('theme', 'megatron') .'/js/lib/modernizr/modernizr.custom.2.6.2.js', array('group' => JS_THEME, 'every_page' => TRUE, 'weight' => 1000));
  }
  drupal_add_js(drupal_get_path('theme', 'megatron') . '/js/lib/bootstrap/bootstrap-alert-min.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -99));
  drupal_add_js(drupal_get_path('theme', 'megatron') . '/js/lib/megatron/megatron-min.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -98));
}

/** BREADCRUMB ALTERATIONS
Return a themed breadcrumb trail
---------------------------------------------------------- */
function megatron_breadcrumb($variables) {
  global $base_path;
  $breadcrumb = $variables['breadcrumb'];
  $breadcrumb = array_unique($breadcrumb);
  $breadcrumb[0] = '';
  $show_breadcrumb = theme_get_setting('breadcrumb_display');
  $pos = FALSE;

  if ((!empty($breadcrumb)) && ($show_breadcrumb == 'yes')) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $crumbs = '<ul class="breadcrumb expand">';
    $crumbs .= '<li class="breadcrumb-home"><a href="' . $base_path . '">' . theme_get_setting('clf_unitname') . '</a></li>';

    $array_size = count($breadcrumb);
    $i = 0;
    while ( $i < $array_size) {
      if (drupal_get_title()) {
        $pos = strpos($breadcrumb[$i], drupal_get_title());
      }
      //we stop duplicates entering where there is a sub nav based on page jumps
      if ($pos === FALSE) {
        $crumbs .= '<li class="breadcrumb-' . $i;
        $crumbs .=  '">' . $breadcrumb[$i] . '</li> » ';
      }
      $i++;
    }
    $crumbs .= '<li class="active">'. drupal_get_title() .'</li></ul>';
    return $crumbs;
  }
  return '';
}


/** NODE.TPL.PHP PREPROCESS VARIABLES
stripe and add 'Unpublished' div.
---------------------------------------------------------- */
function megatron_preprocess_node(&$variables, $hook) {
  // Add a striping class.
   $variables['classes_array'][] = 'node-' . $variables['zebra'];
  // Add 'node-unpublished' class to unpublished nodes.
  if (!$variables['status']) {
    $variables['classes_array'][] = 'node-unpublished';
    $variables['unpublished'] = TRUE;
  }
  else {
    $variables['unpublished'] = FALSE;
  }
  if ($variables['teaser']) {
      $variables['classes_array'][] = 'row-fluid';
  }
  // add node template suggestions for teasers!
  if ($variables['view_mode'] == 'teaser') {
    $variables['theme_hook_suggestions'][] = 'node__' . $variables['node']->type . '__teaser';
    $variables['theme_hook_suggestions'][] = 'node__' . $variables['node']->nid . '__teaser';
  }
}

/** BLOCK.TPL.PHP PREPROCESS VARIABLES
stripe blocks, add custom tpl suggestion for primary content.
---------------------------------------------------------- */
function megatron_preprocess_block(&$variables, $hook) {
  // Add a striping class.
  $variables['classes_array'][] = 'block-' . $variables['zebra'];
  $variables['title_attributes_array']['class'][] = 'block-title';
}

/** BLOCK.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function megatron_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}

/** PAGE.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function megatron_preprocess_page(&$variables) {
  // Define CLF page elements in an include
  include_once 'includes/template-ubc-clf-elements.inc';
  // Add template suggestions based on content type.
  if (isset($variables['node']->type)) {
    //$variables['theme_hook_suggestions'][] = 'page' . theme_get_setting('clf_layout') . '';
    $variables['theme_hook_suggestions'][] = 'page__type__' . $variables['node']->type;
  }

  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second']) && !drupal_is_front_page()) {
    $variables['columns'] = 3;
  }
  elseif (!empty($variables['page']['sidebar_first']) && !drupal_is_front_page()) {
    $variables['columns'] = 2;
  }
  elseif (!empty($variables['page']['sidebar_second']) && !drupal_is_front_page()) {
    $variables['columns'] = 2;
  }
  elseif (!empty($variables['page']['sidebar_first']) && drupal_is_front_page()) {
    $variables['columns'] = 4;
  }
  else {
    $variables['columns'] = 1;
  }

  // Primary nav
  $variables['primary_nav'] = FALSE;
  if ($variables['main_menu']) {
    // Build links
    $tree = menu_tree_page_data(variable_get('menu_main_links_source', 'main-menu'));
    $variables['main_menu'] = megatron_menu_navigation_links($tree);

    // Build list
    $variables['primary_nav'] = theme('megatron_links', array(
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      ),
      'links' => $variables['main_menu'],
      'attributes' => array(
        'id' => 'main-menu',
        'class' => array('nav'),
      ),

    ));
  }

  // Secondary nav
  $showSecondary = theme_get_setting('clf_secondarynavoption');
  $variables['secondary_nav'] = FALSE;
  if ($showSecondary) {
    if ($variables['secondary_menu']) {
      // Build links
      $tree = menu_tree_page_data(variable_get('menu_secondary_links_source', 'user-menu'));
      $variables['secondary_menu'] = megatron_menu_navigation_links($tree);

      // Build list
      $variables['secondary_nav'] = theme('megatron_links', array(
        'heading' => array(
          'text' => t('Secondary menu'),
          'level' => 'h2',
          'class' => array('element-invisible'),
        ),
        'links' => $variables['secondary_menu'],
        'attributes' => array(
          'id' => 'secondary-menu',
          'class' => array('nav'),
        ),

      ));
    }
  }

  // Drawer nav.
  $variables['navigation_placement'] = theme_get_setting('clf_navigation_placement');
  $drawer_enabled = theme_get_setting('clf_navigation_placement') != 'default' && theme_get_setting('clf_navigation_placement') != 'double' && theme_get_setting('clf_navigation_placement') != 'higher';
  $variables['drawer_enabled'] = $drawer_enabled;
  if ($variables['main_menu'] && theme_get_setting('clf_use_primary_menu_in_drawer')) {
    // Build links.
    $tree = menu_tree_page_data(variable_get('menu_main_links_source', 'main-menu'));
    $variables['main_menu'] = megatron_menu_navigation_links($tree);

    // Build list.
    $variables['page']['drawer'] = array(
      '#theme' => 'megatron_links',
      '#heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      ),
      '#links' => $variables['main_menu'],
      '#attributes' => array(
        'id' => 'main-menu',
        'class' => array('nav'),
      ),
    );
  }

  // Add js and css for drawer option
  if ($drawer_enabled) {
    drupal_add_js(drupal_get_path('theme', 'megatron') . '/js/off.canvas.drawer.js');
    drupal_add_css(drupal_get_path('theme', 'megatron') . '/css/off.canvas.drawer.css');
  }

  // Add js and css for navigation sticky option
  if (theme_get_setting('clf_sticky_option')) {
    drupal_add_js(drupal_get_path('theme', 'megatron') . '/js/navigation.sticky.js');
    drupal_add_css(drupal_get_path('theme', 'megatron') . '/css/navigation.sticky.css');
  }
}

/** BOOTSTRAP THEME FUNCTIONS USED */
/** Alter the span class for a region (main content / sidebars)
---------------------------------------------------------- */
function _megatron_content_span($columns = 1) {
  $class = FALSE;
  switch($columns) {
  case 1:
    // default (no sidebars)
    $class = 'span12';
    break;
  case 2:
    // 1 sidebar
    $class = 'span9';
    break;
  case 3:
    // 2 sidebars
    $class = 'span6';
    break;
  case 4:
    // front with 1 sidebar
    $class = 'span8';
    break;
  }
  return $class;
}


function megatron_theme_get_info($setting_name, $theme = NULL) {
// If no key is given, use the current theme if we can determine it.
  if (!isset($theme)) {
    $theme = !empty($GLOBALS['theme_key']) ? $GLOBALS['theme_key'] : '';
  }

  $output = array();

  if ($theme) {
    $themes = list_themes();
    $theme_object = $themes[$theme];

    // Create a list which includes the current theme and all its base themes.
    if (isset($theme_object->base_themes)) {
      $theme_keys = array_keys($theme_object->base_themes);
      $theme_keys[] = $theme;
    }
    else {
      $theme_keys = array($theme);
    }
    foreach ($theme_keys as $theme_key) {
      if (!empty($themes[$theme_key]->info[$setting_name])) {
        $output[$setting_name] = $themes[$theme_key]->info[$setting_name];
      }
    }
  }

  return $output;
}


/** THEME MEGATRON MAIN MENU LINKS
Returns navigational links based on a menu tree */
function megatron_menu_navigation_links($tree, $lvl = 0) {
  $result = array();

  if (count($tree) > 0) {
    foreach ($tree as $id => $item) {

      // Only work with enabled links
      if (empty($item['link']['hidden'])) {
        $class = '';
        // add active-trail
        if ($item['link']['in_active_trail']) {
          $class = ' active-trail ';
        }
        // add class based on link title
        $classtwo = megatron_id_safe($item['link']['title']);
        $new_item = array(
          'title' => $item['link']['title'],
          'link_path' => $item['link']['link_path'],
          'href' => $item['link']['href'],
        );

        // Don't use levels deeper than 1
        if ($lvl < 1) {
          $new_item['below'] = megatron_menu_navigation_links($item['below'], $lvl+1);
        }
        $result['menu-'. $item['link']['mlid'] . $class . ' ' .$classtwo] = $new_item;
      }
    }
  }
  return $result;
}


/** OTHER THEME FUNCTIONS
---------------------------------------------------------- */

/** Preprocess function for theme_megatron_btn_dropdown
adds classes to dropdown menus */
function megatron_preprocess_megatron_btn_dropdown(&$variables) {
  // Add default class
  $variables['attributes']['class'][] = 'btn-group';

  // Check if its a array of links so we need to theme it first here.
  if (is_array($variables['links'])) {
  $variables['links'] = theme('links', array(
    'links' => $variables['links'],
    'attributes' => array(
    'class' => array('dropdown-menu'),
    ),
  ));
  }
}


/** theme_megatron_btn_dropdown
changes link to toggle and adds toggle graphic
---------------------------------------------------------- */
function megatron_megatron_btn_dropdown($variables) {
  $type_class = '';

  // Type class
  if (isset($variables['type'])) {
    $type_class = ' btn-'. $variables['type'];
  }

  // Start markup
  $output = '<div'. drupal_attributes($variables['attributes']) .'>';

  // Add as string if its not a link
  if (is_array($variables['label'])) {
    $output .= l($variables['label']['title'], $$variables['label']['href'], $variables['label']);
  }

  $output .= '<a class="btn '. $type_class .' dropdown-toggle" data-toggle="dropdown" href="#">';

  // Its a link so create one
  if (is_string($variables['label'])) {
    $output .= check_plain($variables['label']);
  }

  // Finish markup
  $output .= '
  <div class="ubc7-arrow down-arrow"></div>
  </a>
  ' . $variables['links'] . '
  </div>';

  return $output;
}


/** THEME MENU UNORDERED LIST MARKUP
theme all sets of links
-- you can override this for specific menus with megatron_menu_tree__menu_name
---------------------------------------------------------- */
function megatron_menu_tree(&$variables) {
  return '<ul class="menu nav bootstrap-sidenav">' . $variables['tree'] . '</ul>';
}


function megatron_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
      $sub_menu = drupal_render($element['#below']);
  }

  $element['#attributes']['class'][] = megatron_id_safe($element['#title']);
  $element['#attributes']['id'] = 'mid-' . $element['#original_link']['mlid'];
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}



/** TABS
ZEN TABS (also see custom styles in stylesheet)
Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
---------------------------------------------------------- */
function megatron_menu_local_task($variables) {
  $link = $variables['element']['#link'];
  $link['localized_options']['html'] = TRUE;
  return '<li' . (!empty($variables['element']['#active']) ? ' class="active"' : '') . '>' . l('<span class="tab">' . $link['title'] . '</span>', $link['href'], $link['localized_options']) . "</li>\n";
}

//  Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
function megatron_menu_local_tasks() {
  $output = array();
  if ($primary = menu_primary_local_tasks()) {
    if (menu_secondary_local_tasks()) {
      $primary['#prefix'] = '<ul class="tabs primary with-secondary clearfix">';
    }
    else {
      $primary['#prefix'] = '<ul class="tabs primary clearfix">';
    }
    $primary['#suffix'] = '</ul>';
    $output[] = $primary;
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $secondary['#prefix'] = '<ul class="tabs secondary clearfix">';
    $secondary['#suffix'] = '</ul>';
    $output[] = $secondary;
  }
  return drupal_render($output);
}


/** FORMS
Implements hook_form_alter().
---------------------------------------------------------- */
function megatron_form_alter(&$form, &$form_state, $form_id) {
  // Customize the search block form
  if ($form_id == 'search_block_form') {
    $form['#attributes']['class'][] = 'form-inline input-append';
    $form['search_block_form']['#attributes']['title'] = t('enter your search terms...');
    $form['search_block_form']['#attributes']['placeholder'] = t('Enter your search terms...');
    $form['search_block_form']['#attributes']['class'][] = 'nomargin';
    $form['search_block_form']['#theme_wrappers'] = NULL;
    $form['actions']['#theme_wrappers'] = NULL; // remove the div around the button
    $form['actions']['submit']['#value'] = t('Go'); // Change the text on the submit button
  }
  if ($form_id == 'search_form') {
    $form['basic']['#attributes']['class'][] = 'form-inline input-append clearfix';
    $form['advanced']['#title'] =  t('Refine your search');
    $form['actions']['submit']['#value'] = t('Go'); // Change the text on the submit button
  }
}

/** Returns HTML for a form element.
---------------------------------------------------------- */
function megatron_form_element(&$variables) {
  $element = &$variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }

  // Add bootstrap class
  $attributes['class'] = array('control-group');

  // Check for errors and set correct error class
  if (isset($element['#parents']) && form_get_error($element)) {
    $attributes['class'][] = 'error';
  }

  if (!empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }
  if (!empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
  }
  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }
  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#field_prefix']) ? '<span class="field-prefix">' . $element['#field_prefix'] . '</span> ' : '';
  $suffix = isset($element['#field_suffix']) ? ' <span class="field-suffix">' . $element['#field_suffix'] . '</span>' : '';

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= '<div class="controls">';
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;

    case 'after':
      $output .= '<div class="controls">';
      $variables['#children'] = ' ' . $prefix . $element['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;

    case 'none':
    case 'attribute':
      // Output no label and no required marker, only the children.
      $output .= '<div class="controls">';
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }

  if ( !empty($element['#description']) ) {
    $output .= '<p class="help-block">' . $element['#description'] . "</p>\n";
  }

  $output .= "</div></div>\n";

  return $output;
}

/** Returns HTML for a form element label and required marker.
---------------------------------------------------------- */
function megatron_form_element_label(&$variables) {
  $element = $variables['element'];
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // If title and required marker are both empty, output no label.
  if ((!isset($element['#title']) || $element['#title'] === '') && empty($element['#required'])) {
    return '';
  }

  // If the element is required, a required marker is appended to the label.
  $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '';

  $title = filter_xss_admin($element['#title']);

  $attributes = array();
  // Style the label as class option to display inline with the element.
  if ($element['#title_display'] == 'after') {
    $attributes['class'][] = 'option';
    $attributes['class'][] = $element['#type'];
  }
  // Show label only to screen readers to avoid disruption in visual flows.
  elseif ($element['#title_display'] == 'invisible') {
    $attributes['class'][] = 'element-invisible';
  }

  if (!empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }

  // @Bootstrap: Add Bootstrap control-label class.
  $attributes['class'][] = 'control-label';

  // @Bootstrap: Insert radio and checkboxes inside label elements.
  $output = '';
  if ( isset($variables['#children']) ) {
    $output .= $variables['#children'];
  }

  // @Bootstrap: Append label
  $output .= $t('!title !required', array('!title' => $title, '!required' => $required));

  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $output . "</label>\n";
}

/** BUTTONS
---------------------------------------------------------- */

/**
 * Implements hook_preprocess_button().
 */
function megatron_preprocess_button(&$variables) {
  // Static storage of button class mapping to avoid excessive t() calls.
  static $button_classes;
  if (!isset($button_classes)) {
    $button_classes = array(
      // Specific buttons first to be caught first in the loop below.
      t('Save and add') => 'btn-info',
      t('Add another item') => 'btn-info',
      t('Add effect') => 'btn-primary',
      t('Add and configure') => 'btn-primary',
      t('Update style') => 'btn-primary',
      t('Download feature') => 'btn-primary',

      // General buttons.
      t('Save') => 'btn-primary',
      t('Apply') => 'btn-primary',
      t('Create') => 'btn-primary',
      t('Confirm') => 'btn-primary',
      t('Submit') => 'btn-secondary',
      t('Export') => 'btn-primary',
      t('Import') => 'btn-primary',
      t('Restore') => 'btn-primary',
      t('Rebuild') => 'btn-primary',
      t('Search') => 'btn-secondary',
      t('Add') => 'btn-info',
      t('Update') => 'btn-info',
      t('Delete') => 'btn-danger',
      t('Remove') => 'btn-danger',
    );
  }
  $variables['element']['#attributes']['class'][] = 'btn';

  if (isset($variables['element']['#value'])) {
    foreach ($button_classes as $search => $class) {
      if (strpos($variables['element']['#value'], $search) !== FALSE) {
        $variables['element']['#attributes']['class'][] = $class;
        break;
      }
    }
  }
}

/** Implements theme_button().
---------------------------------------------------------- */
function megatron_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));
  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  $element['#attributes']['class'][] = 'btn';
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
  // Add a btn-primary class if submit button.
  if (isset($element['#parents']) && ($element['#parents'][0] == 'submit')) {
    $element['#attributes']['class'][] = 'btn-secondary';
  }
 return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/** TABLES */
/** Add Bootstrap table class to tables added by Drupal
---------------------------------------------------------- */
function megatron_preprocess_table(&$variables) {
  if (!isset($variables['attributes']['class'])) {
    $variables['attributes']['class'] = array('table', 'table-striped');
  }
  else {
    $variables['attributes']['class'][] = 'table';
    $variables['attributes']['class'][] = 'table-striped';
  }
}

/** VIEWS
Provides views theme override functions for Bootstrap themes.

Add Bootstrap table class to views tables.
---------------------------------------------------------- */
function megatron_preprocess_views_view_table(&$variables) {
  $variables['classes_array'][] = 'table';
}

function megatron_preprocess_views_view_grid(&$variables) {
  $variables['class'] .= ' table';
}

/** STATUS MESSAGES
Returns HTML for status and/or error messages, grouped by type.
---------------------------------------------------------- */
function megatron_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );
  $status_alert_types = array(
    'status' => 'info',
    'error' => 'error',
    'warning' => 'warning',
  );
  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= '<div class="alert alert-block alert-' . $status_alert_types[$type] . '">';
    $output .= '<a class="close" data-dismiss="alert" href="#">&times;</a>';
    if (!empty($status_heading[$type])) {
      $output .= '<h4 class="alert-heading">' . $status_heading[$type] . '</h4>';
    }
    if (count($messages) > 1) {
      $output .= ' <ul>';
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . '</li>';
      }
      $output .= ' </ul>';
    }
    else {
      $output .= $messages[0];
    }
    $output .= '</div>';
  }

  return $output;
}

/** EXCLUDE CSS
Allow css files to be excluded in the .info file
---------------------------------------------------------- */
function megatron_css_alter(&$css) {
  $excludes = _megatron_alter(megatron_theme_get_info('exclude'), 'css');
  $css = array_diff_key($css, $excludes);
}


/** REPLACE CORE jQUERY
Replace jQuery with updated version
---------------------------------------------------------- */
function megatron_js_alter(&$javascript) {
  if (module_exists('jquery_update')) {

  }
  else {
    $javascript['misc/jquery.js']['data'] = '//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js';
    $javascript['misc/jquery.js']['type'] = 'external';
    $javascript['misc/jquery.js']['group'] = JS_LIBRARY;
    $javascript['misc/jquery.js']['weight'] = -100;
    $javascript['misc/jquery.js']['version'] = '1.8.1';
  }
}


function _megatron_alter($files, $type) {
  $output = array();

  foreach($files as $key => $value) {
    if (isset($files[$key][$type])) {
      foreach($files[$key][$type] as $file => $name) {
        $output[$name] = FALSE;
      }
    }
  }
  return $output;
}

/** Returns HTML for a set of links.
---------------------------------------------------------- */
function megatron_megatron_links($variables) {
  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];

  global $language_url;
  $output = '';

  if (count($links) > 0) {
    $output = '';

    // Treat the heading first if it is present to prepend it to the list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading is a string.
        $heading = array(
          'text' => $heading,
        );
      }
      $output .= '<h3';
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</h3>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $children = array();
      if (isset($link['below'])) {
        $children = $link['below'];
      }

      $attributes = array('class' => array($key));
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
           && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $attributes['class'][] = 'active';
      }
      if (count($children) > 0) {
        $attributes['class'][] = 'dropdown';
        $link['attributes']['class'][] = 'btn';
      }

      if (!isset($link['attributes'])) {
        $link['attributes'] = array();
      }
      $class = (count($children) > 0) ? 'dropdown' : NULL;
      $output .= '<li ' . drupal_attributes($attributes) . '>';

      if (isset($link['href'])) {
        if (count($children) > 0) {
          $link['html'] = TRUE;
          $output .=  '<div class="btn-group">' .l($link['title'], $link['href'], $link);
          $output .=  '<button class="btn dropdown-toggle" data-toggle="dropdown"><span class="ubc7-arrow blue down-arrow"></span></button>';
        }else{
          $output .= l($link['title'], $link['href'], $link);
        }
      }
      elseif (!empty($link['title'])) {
       if (empty($link['html'])) {
         $link['title'] = check_plain($link['title']);
       }
       $span_attributes = '';
       if (isset($link['attributes'])) {
         $span_attributes = drupal_attributes($link['attributes']);
       }
       $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
     }

    if (count($children) > 0) {
      $attributes = array();
      $attributes['class'] = array('dropdown-menu');
      $output .= theme('megatron_links', array('links' => $children, 'attributes' => $attributes));
      $output .= '</div>';
    }

    $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

/**
 * Implements template_preprocess_textarea().
 *
 * Hide grippie.
 */
function megatron_preprocess_textarea(&$variables) {
  $variables['element']['#resizable'] = FALSE;
}

/**
 * Implements theme_form().
 *
 * Removes the XHTML redundant inner div.
 */
function megatron_form($variables) {
  $element = $variables['element'];
  if (isset($element['#action'])) {
    $element['#attributes']['action'] = drupal_strip_dangerous_protocols($element['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element['#attributes']['accept-charset'])) {
    $element['#attributes']['accept-charset'] = "UTF-8";
  }

  return '<form' . drupal_attributes($element['#attributes']) . '>' . $element['#children'] . '</form>';
}
