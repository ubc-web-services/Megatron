<?php

/** CLF THEME INFO
---------------------------------------------------------- */
function megatron_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['clf_credits'] = array(
    '#type' => 'fieldset', 
    '#title' => t('UBC CLF 7.0 Drupal Theme Information'), 
    '#prefix' => '<div class="clf_credits">', 
    '#suffix' => '</div>',
    '#weight' => -10,
    '#description' => t('<strong> The CLF 7.0 Drupal theme is a responsive theme, developed by the <a href="http://web.it.ubc.ca/forms/webservices/" title="Contact UBC IT Web Services" target="_blank">UBC IT Web Services Department</a>.<br /><br />The <a href="http://brand.ubc.ca/clf" title="Discover the UBC CLF Brand" target="_blank">CLF</a> is developed and distributed by Communications &amp; Marketing. For support or to report and issue with this theme, <a href="http://clf.ubc.ca/support/" title="Contact UBC Communications & Marketing" target="_blank">please contact us</a>.'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );  
    
/** CLF COLOUR OPTIONS
---------------------------------------------------------- */
  $form['clf_theme'] = array(
    '#type' => 'fieldset', 
    '#title' => t('CLF Theme Options'), 
    '#prefix' => '<div class="clf_coloroptions">', 
    '#suffix' => '</div>',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['clf_theme']['clf_clf_theme_new'] = array(
    '#type' => 'select',
    '#title' => t('CLF Colour Scheme'),
    '#description' => t('View <a href="http://clf.ubc.ca/design-specifications/">colour theme options</a> and design specifications.'),
    '#default_value' => theme_get_setting('clf_clf_theme_new'),
    '#options' => array(
      '' => t('White on Blue'),
      '-wg' => t('White on Grey'),
      '-gw' => t('Grey on White'),
      '-bw' => t('Blue on White'),
    ),
  );
  
  $form['clf_theme']['clf_clf_version'] = array(
    '#type' => 'select',
    '#title' => t('CLF Version'),
    '#description' => t('Select the release version of the CLF you\'d like to use.'),
    '#default_value' => theme_get_setting('clf_clf_version'),
    '#options' => array(
      '7.0.2' => t('Release 7.0.2'),
      '7.0.3' => t('Release 7.0.3'),
      '7.0.4' => t('Release 7.0.4'),
    ),
  );
  
  $form['clf_theme']['clf_clf_package'] = array(
    '#type' => 'select',
    '#title' => t('CLF Package'),
    '#description' => t('Select the package of the CLF you\'d like to use.<br /><br />Choosing a minimal version will exclude many of the default CLF styles, but may be preferable for themes with a large number of customizations. <em>Note: Minimal package is only currently available for CLF version 7.0.2</em>'),
    '#default_value' => theme_get_setting('clf_clf_package'),
    '#options' => array(
      'full' => t('Full Version'),
      'min' => t('Minimal Version'),
    ),
  );
  
  $form['clf_theme']['clf_layout'] = array(
    '#type' => 'select', 
    '#title' => t('Layout'), 
    '#description' => t('Make the CLF Full Width'),
    '#default_value' => theme_get_setting('clf_layout'),
    '#options' => array(
     '' => t('Default'),
     '__fluid' => t('Left Aligned Full Width CLF (must use CLF version 7.0.4+)'),
     '__full' => t('Full Width CLF (must use CLF version 7.0.4+)'),
   ),
 );
 
  $form['clf_theme']['clf_navoption'] = array(
    '#type' => 'checkbox', 
    '#title' => t('Primary Navigation Mobile Placement'),
    '#description' => t('Show the Primary Navigation at the bottom of the page on Mobile devices, in addition to the top navigation placement'),
    '#default_value' => theme_get_setting('clf_navoption'),
);

  $form['clf_theme']['clf_jqueryoption'] = array(
    '#type' => 'checkbox', 
    '#title' => t('Do not load updated jQuery (1.8.x) from theme'),
    '#description' => t('If you would like to use a module such as jQuery Update, you can enable this option to prevent jQuery from loading with the theme.<br /><br />Please note that jQuery version 1.8+ is required for the CLF.'),
    '#default_value' => theme_get_setting('clf_jqueryoption'),
);

  $form['clf_theme']['clf_scriptsoption'] = array(
    '#type' => 'select', 
    '#title' => t('Script Location'),
    '#description' => t('Include scripts in the page head or footer'),
    '#default_value' => theme_get_setting('clf_scriptsoption'),
    '#options' => array(
      'footer' => t('Footer'),
      'head' => t('Head'),
    ),
);
  
  /** CLF CAMPUS IDENTITY OPTIONS
  ---------------------------------------------------------- */
  $form['clf_identity'] = array(
    '#type' => 'fieldset', 
    '#title' => t('Campus Identity'), 
    '#prefix' => '<div class="clf_identity">', 
    '#suffix' => '</div>',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  $form['clf_identity']['clf_unit_campus'] = array(
      '#type' => 'select',
      '#title' => t('Campus Identity'),
      '#description' => t('This field shows your unit\'s campus mandate: Vancouver Campus or Okanagan Campus. If your unit has an institution-wide mandate or if neither choice is applicable, select the third option. See <a href="http://clf.ubc.ca/parts-of-the-clf/">Campus Identity</a> for guidelines.'),
      '#default_value' => theme_get_setting('clf_unit_campus'),
      '#options' => array(
        'vancouver' => t('Vancouver'),
        'okanagan' => t('Okanagan'),
        '' => t('Institution-wide mandate / Not applicable'),
      ),
  );
  
  /** CLF UNIT / WEBSITE INFORMATION
  ---------------------------------------------------------- */
  $form['clf_unit_info'] = array(
    '#type' => 'fieldset', 
    '#title' => t('Unit / Website Information'), 
    '#prefix' => '<div class="clf_unit_info">', 
    '#suffix' => '</div>',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  $form['clf_unit_info']['clf_faculty'] = array(
    '#type' => 'checkbox', 
    '#title' => t('Is your unit part of a Faculty?'),
    '#default_value' => theme_get_setting('clf_faculty'),
  );
  
  $form['clf_unit_info']['clf_faculty_name'] = array(
      '#type' => 'select',
      '#title' => t('If yes, choose your Faculty'),
      '#default_value' => theme_get_setting('clf_faculty_name'),
      '#options' => array(
        'Faculty of Applied Science' => t('Faculty of Applied Science'),
        'Faculty of Arts' => t('Faculty of Arts'),
        'Faculty of Dentistry' => t('Faculty of Dentistry'),
        'Faculty of Education' => t('Faculty of Education'),
        'Faculty of Forestry' => t('Faculty of Forestry'),
        'Faculty of Land and Food Systems' => t('Faculty of Land and Food Systems'),
        'Faculty of Law' => t('Faculty of Law'),
        'Faculty of Medicine' => t('Faculty of Medicine'),
        'Faculty of Pharmaceutical Sciences' => t('Faculty of Pharmaceutical Sciences'),
        'Faculty of Science' => t('Faculty of Science'),
        'Graduate and Postdoctoral Studies' => t('Graduate and Postdoctoral Studies'),
        'Sauder School of Business' => t('Sauder School of Business'),
      ),
  );
  
  $form['clf_unit_info']['clf_unitname'] = array(
    '#type' => 'textfield', 
    '#title' => t('This field will populate the <a href="http://clf.ubc.ca/parts-of-the-clf/#unit-name" title="View the location of the Unit Name" target="_blank">Unit Name</a> in the header and the <a href="http://clf.ubc.ca/parts-of-the-clf/#unit-sub-footer" title="View the location of the Unit Sub Footer" target="_blank">Unit Sub Footer</a>. '), 
    '#default_value' => theme_get_setting('clf_unitname'), 
    '#size' => 60, 
    '#maxlength' => 128,
    '#required' => true,
  );
  
 $form['clf_unit_info']['colourpicker'] = array(
      '#type' => 'textfield',
      '#title' => 'Unit Name Background Colour',
      '#description' => t('See design specifications for <a href="http://clf.ubc.ca/parts-of-the-clf/#unit-colors" title="Learn more about the Unit Name background colours" target="_blank">Unit Name background colours</a>. Use HEX colour (do not include the #)'),
      '#size' => 7,
      '#maxlength' => 7,
      '#suffix' => '<div id="colourpicker"></div>',
      '#default_value' => theme_get_setting('colourpicker'),
  );
 
  $form['clf_unit_info']['breadcrumb_display'] = array(
   '#type' => 'select',
   '#title' => t('Breadcrumbs Display Option'),
   '#description' => t('See <a href="http://clf.ubc.ca/parts-of-the-clf/#breadcrumbs" title="earn more about the breadcrumbs guidelines" target="_blank">breadcrumbs guidelines</a>.'),
   '#default_value' => theme_get_setting('breadcrumb_display'),
   '#options' => array(
     'yes' => t('Yes (Highly Recommended'),
     'no' => t('No'),
   ),
  );

/*  $form['clf_general']['clf_unitinfohelp'] = array('#type' => 'markup', '#value' => '<p>Fill in your unit\'s information here.  Only the unit name field is required.  The field values are used to generate a <a href="http://microformats.org/wiki/hcard" target="_blank">microformats hCard</a> in the CLF footer.</p>');

*/

  $form['clf_unit_info']['clf_streetaddr'] = array(
    '#type' => 'textfield', 
    '#title' => t('Street Address'), 
    '#default_value' => theme_get_setting('clf_streetaddr'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_locality'] = array(
    '#type' => 'textfield', 
    '#title' => t('City'), 
    '#default_value' => theme_get_setting('clf_locality'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_region'] = array(
    '#type' => 'textfield', 
    '#title' => t('Province / Region'), 
    '#default_value' => theme_get_setting('clf_region'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_country'] = array(
    '#type' => 'textfield', 
    '#title' => t('Country'), 
    '#default_value' => theme_get_setting('clf_country'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_postal'] = array(
    '#type' => 'textfield', 
    '#title' => t('Postal Code'), 
    '#default_value' => theme_get_setting('clf_postal'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_telephone'] = array(
    '#type' => 'textfield', 
    '#title' => t('Telephone Number - format as xxx xxx xxxx (spaces only)'), 
    '#default_value' => theme_get_setting('clf_telephone'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_fax'] = array(
    '#type' => 'textfield', 
    '#title' => t('Fax Number - format as xxx xxx xxxx (spaces only)'), 
    '#default_value' => theme_get_setting('clf_fax'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_email'] = array(
    '#type' => 'textfield', 
    '#title' => t('Email'), 
    '#default_value' => theme_get_setting('clf_email'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_unit_info']['clf_website'] = array(
    '#type' => 'textfield', 
    '#title' => t('Website'), 
    '#description' => t('Do not include the http://'),
    '#default_value' => theme_get_setting('clf_website'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );



/** CLF SOCIAL MEDIA LINKS (FOOTER)
---------------------------------------------------------- */
    $form['clf_social'] = array(
      '#type' => 'fieldset', 
      '#title' => t('Unit Social Media Links'), 
      '#prefix' => '<div class="clf_general">', 
      '#suffix' => '</div>',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    
    $form['clf_social']['clf_social_facebook'] = array(
      '#type' => 'textfield', 
      '#title' => t('Facebook Account Link'), 
      '#default_value' => theme_get_setting('clf_social_facebook'), 
      '#size' => 60, 
      '#maxlength' => 128,
    );

    $form['clf_social']['clf_social_twitter'] = array(
      '#type' => 'textfield', 
      '#title' => t('Twitter Account Link'), 
      '#default_value' => theme_get_setting('clf_social_twitter'), 
      '#size' => 60, 
      '#maxlength' => 128,
    );
    
    $form['clf_social']['clf_social_linkedin'] = array(
      '#type' => 'textfield', 
      '#title' => t('Linkedin Account Link'), 
      '#default_value' => theme_get_setting('clf_social_linkedin'), 
      '#size' => 60, 
      '#maxlength' => 128,
    );
    
    $form['clf_social']['clf_social_googleplus'] = array(
      '#type' => 'textfield', 
      '#title' => t('Google Plus Account Link'), 
      '#default_value' => theme_get_setting('clf_social_googleplus'), 
      '#size' => 60, 
      '#maxlength' => 128,
    );
    
    $form['clf_social']['clf_social_youtube'] = array(
      '#type' => 'textfield', 
      '#title' => t('YouTube Account Link'), 
      '#default_value' => theme_get_setting('clf_social_youtube'), 
      '#size' => 60, 
      '#maxlength' => 128,
    );


/** CLF UTILITY BUTTON SEARCH TOOL CONFIG
---------------------------------------------------------- */
  $form['clf_utility'] = array(
    '#type' => 'fieldset', 
    '#title' => t('Global Utility Button Search Tool Configuration'), 
    '#prefix' => '<div class="clf_header">', 
    '#suffix' => '</div>',
    '#description' => t('See search tool configuration <a href="http://clf.ubc.ca/implementing-the-clf/#search-tool" title="Learn more about the Search Tool Guidelines" target="_blank">guidelines</a>.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['clf_utility']['clf_searchlabel'] = array(
    '#type' => 'textfield', 
    '#title' => t('Search Label (usually your unit name)'), 
    '#default_value' => theme_get_setting('clf_searchlabel'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_utility']['clf_searchdomain'] = array(
    '#type' => 'textfield', 
    '#title' => t('Search Domain'), 
    '#default_value' => theme_get_setting('clf_searchdomain'), 
    '#size' => 60, 
    '#maxlength' => 128,
    '#description' => t('Search domains allows you to limit search results in your search box to a specific domain. e.g. <strong>*.arts.ubc.ca</strong> or <strong>www.publicaffairs.ubc.ca/category/</strong>'),
  );

  $form['clf_utility']['clf_subunit_override'] = array(
    '#type' => 'textfield', 
    '#title' => t('Subunit Name Override (overrides text in search bar)'), 
    '#default_value' => theme_get_setting('clf_subunit_override'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

// Return the additional form widgets
return $form;
}
?>

