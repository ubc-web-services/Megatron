<?php

/** hook_theme() 
---------------------------------------------------------- */
function megatron_theme() {
  return array(
    'ubc_clf_toolbar' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_header' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_unit' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_visual_identity_footer' => array(
      'variables' => array('element' => NULL)
    ),
    'ubc_clf_global_utility_footer' => array(
      'variables' => array('element' => NULL)    
    ),
    'megatron_links' => array(
      'variables' => array('links' => array(), 'attributes' => array(), 'heading' => NULL),
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
function megatron_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}



/** HTML.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function megatron_preprocess_html(&$vars) {
    // Classes for body element. Allows advanced theming based on context
    // (home page, node of certain type, etc.)
    if (!$vars['is_front']) {
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
      // add a body class that reflects content placement
      $vars['classes_array'][] = drupal_html_class('section-' . megatron_id_safe($section));
      $vars['classes_array'][] = drupal_html_class('path-' . megatron_id_safe($path));
    }
    // add a body class to tell us what layout we're using
    //$vars['classes_array'][] = drupal_html_class('layout' . theme_get_setting('clf_layout'));
    // add a body class to tell us what colours we're using
    $vars['classes_array'][] = drupal_html_class('themecolour' . theme_get_setting('clf_clf_theme_new'));
    
      
    //Uses RDFa attributes if the RDF module is enabled
    //Lifted from Adaptivetheme for D7, full credit to Jeff Burnz
    // Add rdf info
     if (module_exists('rdf')) {
       $vars['doctype'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+RDFa 1.1//EN">' . "\n";
       $vars['rdf']->version = 'version="HTML+RDFa 1.1"';
       $vars['rdf']->namespaces = $vars['rdf_namespaces'];
       $vars['rdf']->profile = ' profile="' . $vars['grddl_profile'] . '"';
     } else {
       $vars['doctype'] = '<!DOCTYPE html>' . "\n";
       $vars['rdf']->version = '';
       $vars['rdf']->namespaces = '';
       $vars['rdf']->profile = '';
     }

     // Add js libraries and scripts
     $options = array(
       'group' => JS_THEME,
     );
     drupal_add_js('//cdn.ubc.ca/clf/7.0.1/js/ubc-clf.min.js?v.7.0.1', array('type' => 'external', 'group'=>JS_LIBRARY, 'weight' => 0));    
  }


/** BREADCRUMB ALTERATIONS
Return a themed breadcrumb trail
---------------------------------------------------------- */
function megatron_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  $breadcrumb = array_unique($breadcrumb);
  $breadcrumb[0] = ''; 
  $show_breadcrumb = theme_get_setting('breadcrumb_display');
    
  if ((!empty($breadcrumb)) && ($show_breadcrumb == 'yes')) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $crumbs = '<ul class="breadcrumb expand">';
    $crumbs .= '<li class="breadcrumb-home"><a href="/">' . theme_get_setting('clf_unitname') . '</a></li>';
    
    $array_size = count($breadcrumb);
    $i = 0;
    while ( $i < $array_size) {
    
      $pos = strpos($breadcrumb[$i], drupal_get_title());
      //we stop duplicates entering where there is a sub nav based on page jumps
      if ($pos === false){
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
function megatron_preprocess_node(&$vars, $hook) {
  // Add a striping class. 
   $vars['classes_array'][] = 'node-' . $vars['zebra'];
  // Add 'node-unpublished' class to unpublished nodes. 
  if (!$vars['status']) {
    $vars['classes_array'][] = 'node-unpublished';
    $vars['unpublished'] = TRUE;
  }
  else {
    $vars['unpublished'] = FALSE;
  }
  if($vars['teaser'])
      $vars['classes_array'][] = 'row-fluid';
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
  // Add template suggestions based on content type 
  if (isset($variables['node'])) {  
    //$variables['theme_hook_suggestions'][] = 'page' . theme_get_setting('clf_layout') . '';
    $variables['theme_hook_suggestions'][] = 'page__type__'. $variables['node']->type;
    $variables['theme_hook_suggestions'][] = "page__node__" . $variables['node']->nid; 
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
  if($variables['main_menu']) {
    // Build links
    $tree = menu_tree_page_data(variable_get('menu_main_links_source', 'main-menu'));
    $variables['main_menu'] = megatron_menu_navigation_links($tree);
    
    // Build list
    $variables['primary_nav'] = theme('megatron_links', array(
      'links' => $variables['main_menu'],
      'attributes' => array(
        'id' => 'main-menu',
        'class' => array('nav'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      ),
    ));
  }
}


/** BOOTSTRAP THEME FUNCTIONS USED */
/** Alter the span class for a region (main content / sidebars)
---------------------------------------------------------- */
function _megatron_content_span($columns = 1) {
  $class = FALSE;
  switch($columns) {
  case 1:
    $class = 'span12';
    break;
  case 2:
    $class = 'span9';
    break;
  case 3:
    $class = 'span6';
    break;
  case 4:
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


/** Returns navigational links based on a menu tree */
function megatron_menu_navigation_links($tree, $lvl = 0) {
  $result = array();

  if(count($tree) > 0) {
	foreach($tree as $id => $item) {
	  $new_item = array('title' => $item['link']['title'], 'link_path' => $item['link']['link_path'], 'href' => $item['link']['href']);
	  
	  // Don't use levels deeper than 1
	  if($lvl < 1)
		$new_item['below'] = megatron_menu_navigation_links($item['below'], $lvl+1);
	  
	  $result['menu-'. $item['link']['mlid']] = $new_item;
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
  if(is_array($variables['links'])) {
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
  if(isset($variables['type']))
	$type_class = ' btn-'. $variables['type'];
  
  // Start markup
  $output = '<div'. drupal_attributes($variables['attributes']) .'>';
  
  // Ad as string if its not a link
  if(is_array($variables['label'])) {
	$output .= l($variables['label']['title'], $$variables['label']['href'], $variables['label']);
  }
  
  $output .= '<a class="btn'. $type_class .' dropdown-toggle" data-toggle="dropdown" href="#">';
  
  // Its a link so create one
  if(is_string($variables['label'])) {
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


function megatron_menu_tree(&$variables) {
  return '<ul class="menu nav bootstrap-sidenav">' . $variables['tree'] . '</ul>';
}


function megatron_menu_link(array $variables) {
  // remove some default drupal menu classes
  $remove = array('leaf', 'expanded', 'collapsed', 'expandable');
    if($remove){
     $variables['element']['#attributes']['class'] = array_diff($variables['element']['#attributes']['class'],$remove);
  }
  
  $element = $variables['element'];
  $sub_menu = '';
  
  // Sanitize title
  //$element['#title'] = check_plain($element['#title']);
  
  if ($element['#below']) {
	// Add our own wrapper
	unset($element['#below']['#theme_wrappers']);
    $sub_menu = '<ul class="menu nav subnav">' . drupal_render($element['#below']) . '</ul>';

	$element['#localized_options']['html'] = TRUE;	
	$element['#href'] = "";
  }
  
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  // Adding a class depending on the TITLE of the link using our safe string
  $element['#attributes']['class'][] = megatron_id_safe($element['#title']);
  // Adding an ID depending on the ID of the link
  $element['#attributes']['id'][] = 'mid-' . $element['#original_link']['mlid'];
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}


// ZEN TABS (also see custom styles in stylesheet and 'tabs' images folder)
// Customize the PRIMARY and SECONDARY LINKS, to allow the admin tabs to work on all browsers
function megatron_menu_local_task($variables) {
  $link = $variables['element']['#link'];
  $link['localized_options']['html'] = TRUE;
  return '<li' . (!empty($variables['element']['#active']) ? ' class="active"' : '') . '>' . l('<span class="tab">' . $link['title'] . '</span>', $link['href'], $link['localized_options']) . "</li>\n";
}

//  Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
function megatron_menu_local_tasks() {
  $output = array();
  if ($primary = menu_primary_local_tasks()) {
    if(menu_secondary_local_tasks()) {
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
    //$form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#attributes']['title'] = t('enter your search terms...');
    $form['search_block_form']['#attributes']['placeholder'] = t('Enter search terms');
    //$form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    //$form['search_block_form']['#size'] = 40;  // define size of the textfield
    //$form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield
    $form['actions']['submit']['#value'] = t('Go'); // Change the text on the submit button
    //$form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');
    
    // Add extra attributes to the text box
    //$form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search';}";
    //$form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search') {this.value = '';}";
    // Prevent user from searching the default text
    //$form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='Search'){ alert('Please enter a search'); return false; }";
  }
}  


/** Returns HTML for status and/or error messages, grouped by type.
---------------------------------------------------------- */
function megatron_status_messages($vars) {
  $display = $vars['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
  );
  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= "<div class=\"alert alert-block alert-$type\">\n";
    $output .= "  <a class=\"close\" data-dismiss=\"alert\" href=\"#\">x</a>\n";
    if (!empty($status_heading[$type])) {
      $output .= '<h4 class="alert-heading">' . $status_heading[$type] . "</h4>\n";
    }
    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . $message . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= $messages[0];
    }
    $output .= "</div>\n";
  }
  return $output;
}


/** Allow css files to be excluded in the .info file
---------------------------------------------------------- */
function megatron_css_alter(&$css) {
  $excludes = _megatron_alter(megatron_theme_get_info('exclude'), 'css');
  $css = array_diff_key($css, $excludes);
}


/** Allow js files to be excluded in the .info file / Replace jQuery with updated version
---------------------------------------------------------- */
function megatron_js_alter(&$javascript) {
  // USED TO EXCLUDE JS FILES VIA THE .INFO FILE - REMOVED DUE TO CONFLICT WITH IMCE - DEC6-2012 - jotoole 
  //$excludes = _megatron_alter(megatron_theme_get_info('exclude'), 'js');
  //$js = array_diff_key($js, $excludes);
  // Swap out jQuery to use an updated version of the library.
  $javascript['misc/jquery.js']['data'] = '//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js';
}


function _megatron_alter($files, $type) {
  $output = array();
  
  foreach($files as $key => $value) {
    if(isset($files[$key][$type])) {
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
    $output .= '<ul' . drupal_attributes($attributes) . '>';
    
    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          // Set the default level of the heading. 
          'level' => 'li',
        );
      }
      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $num_links = count($links);
    $i = 1;
	
    foreach ($links as $key => $link) {
      $children = array();
      if(isset($link['below']))
      $children = $link['below'];
      
	    $attributes = array('class' => array($key));
	  
	    // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $attributes['class'][] = 'first';
      }
      if ($i == $num_links) {
        $attributes['class'][] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
           && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $attributes['class'][] = 'active';
      }
	  
	    if(count($children) > 0) {
		    $attributes['class'][] = 'dropdown';
		    $link['attributes']['data-toggle'] = 'dropdown';
		    $link['attributes']['class'][] = 'dropdown-toggle';
      }
	  
  	  if(!isset($link['attributes']))
  		$link['attributes'] = array();
  		
  	  $class = (count($children) > 0) ? 'dropdown' : NULL;
  	  $output .= '<li' . drupal_attributes(array('class' => array($class))) . '>';
	  
  	  if (isset($link['href'])) {
  		  if(count($children) > 0) { 
  		    $link['html'] = TRUE;
  		    $link['title'] .= '<div class="ubc7-arrow down-arrow"></div>';
  		    $output .=  '<a' . drupal_attributes($link['attributes']) . ' href="#">'. $link['title'] .'</a>';
  		  }else{
  		    // Pass in $link as $options, they share the same keys.
  		    $output .= l($link['title'], $link['href'], $link);
  		  }
  	  }
  	  elseif (!empty($link['title'])) {
  	   // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
  	   if (empty($link['html'])) {
  		   $link['title'] = check_plain($link['title']);
  	   }
  	   $span_attributes = '';
  	   if (isset($link['attributes'])) {
  		   $span_attributes = drupal_attributes($link['attributes']);
  	   }
	     $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
     }
	  
	  $i++;
	  
	  if(count($children) > 0) {
		  $attributes = array();
      $attributes['class'] = array('dropdown-menu');
		  $output .= theme('megatron_links', array('links' => $children, 'attributes' => $attributes));
	  }
	  
	  $output .= "</li>\n";	
    }

    $output .= '</ul>';
  }

  return $output;
}

/** Define CLF page elements in an include */
require_once('includes/template-ubc-clf-elements.inc');es.
  	   if (empty($link['html'])) {
  		   $link['title'] = check_plain($link['title']);
  	   }
  	   $span_attributes = '';
  	   if (isset($link['attributes'])) {
  		   $span_attributes = drupal_attributes($link['attributes']);
  	   }
	     $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
     }
	  
	  $i++;
	  
	  if(count($children) > 0) {
		  $attributes = array();
      $attributes['class'] = array('dropdown-menu');
		  $output .= theme('megatron_links', array('links' => $children, 'attributes' => $attributes));
	  }
	  
	  $output .= "</li>\n";	
    }

    $output .= '</ul>';
  }

  return $output;
}

/** Define CLF page elements in an include */
require_once('includes/template-ubc-clf-elements.inc');