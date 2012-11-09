<?php

function megatron_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['clf_credits'] = array(
    '#type' => 'fieldset', 
    '#title' => t('Megatron Theme Information'), 
    '#prefix' => '<div class="clf_credits">', 
    '#suffix' => '</div>',
    '#weight' => -10,
    '#description' => t('<strong>Megatron is a responsive Drupal theme for the UBC CLF (Common Look and Feel).</strong><br />The CLF is developed and distributed by UBC Web Communications. You can find out more about the CLF and the UBC brand at <a href="http://brand.ubc.ca/" title="Discover the UBC CLF Brand" target="_blank">brand.ubc.ca</a>.<br />Megatron has been developed by the UBC IT Web Services Department. For support, to report an issue or more information, please contact UBC IT <a href="http://web.it.ubc.ca/forms/webservices/" title="Contact UBC IT Web Services" target="_blank">Web Services</a>.'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  
  
/** CLF COLOUR SETTINGS
---------------------------------------------------------- */
  $form['clf_theme'] = array(
    '#type' => 'fieldset', 
    '#title' => t('CLF Colour and Theme Options'), 
    '#prefix' => '<div class="clf_coloroptions">', 
    '#suffix' => '</div>',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['clf_theme']['clf_clf_theme'] = array(
    '#type' => 'select',
    '#title' => t('CLF Colour Scheme'),
    '#description' => t('Choose the CLF Colour Scheme.'),
    '#default_value' => theme_get_setting('clf_clf_theme'),
    '#options' => array(
      'https://cdn.ubc.ca/clf/7.0.1/css/ubc-clf-full.min.css' => t('Blue with White text'),
      'https://cdn.ubc.ca/clf/7.0.1/css/ubc-clf-full-bw.min.css' => t('White with Blue text'),
      'https://cdn.ubc.ca/clf/7.0.1/css/ubc-clf-full-gw.min.css' => t('White with Grey text'),
      'https://cdn.ubc.ca/clf/7.0.1/css/ubc-clf-full-wg.min.css' => t('Grey with White text'),
    ),
  );
    
  $form['clf_theme']['clf_unit_campus'] = array(
      '#type' => 'select',
      '#title' => t('Campus'),
      '#description' => t('Choose the Unit campus.'),
      '#default_value' => theme_get_setting('clf_unit_campus'),
      '#options' => array(
        'vancouver' => t('Vancouver'),
        'okanagan' => t('Okanagan'),
      ),
  );
  
  $form['clf_theme']['colourpicker'] = array(
      '#type' => 'textfield',
      '#title' => 'Enter the hex number for the Unit Area background. Format should be "cccccc".',
      '#size' => 7,
      '#maxlength' => 7,
      '#suffix' => '<div id="colourpicker"></div>',
      '#default_value' => theme_get_setting('colourpicker'),
  );
 
  
/** CLF UTILITY INFORMATION
---------------------------------------------------------- */
  $form['clf_utility'] = array(
    '#type' => 'fieldset', 
    '#title' => t('CLF Utility Header (SEARCH / PLACE OF MIND DROPDOWN)'), 
    '#prefix' => '<div class="clf_header">', 
    '#suffix' => '</div>',
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

  $form['clf_utility']['clf_subunit_blank'] = array(
    '#type' => 'checkbox', 
    '#title' => t('Make subunit text in search bar blank (overrides all other settings)'), 
    '#default_value' => theme_get_setting('clf_subunit_blank'),
  );


/** CAROUSEL SETTINGS
---------------------------------------------------------- */
  /*
  $form['carousel'] = array(
      '#type' => 'fieldset',
      '#title' => 'Carousel settings',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );

  $form['carousel']['image'] = array(
      '#prefix' => '<div id="carousel-image">',
      '#suffix' => '</div>',
      '#type' => 'radios',
      '#title' => t(''),
      '#default_value' => theme_get_setting('image'),
      '#options' => array(
      ),
  ); 

  $form['carousel']['enable_carousel'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable carousel'),
      '#description' => t('Click the box to enable the carousel.'),
      '#default_value' => theme_get_setting('enable_carousel'),
  );

  $form['carousel']['carousel_speed'] = array(
       '#type' => 'select',
       '#title' => t('How fast should it be'),
       '#description' => t('Set animation speed'),
       '#default_value' => theme_get_setting('carousel_speed'),
       '#options' => array(
        '1500' => t('Slow'),
        '1000' => t('Medium'),
        '400' => t('Fast'),     
       ),
  );

  $form['carousel']['carousel_duration'] = array(
      '#type' => 'select',
      '#title' => t('How long between each slide (in seconds)'),
      '#description' => t(''),
      '#default_value' => theme_get_setting('animation'),
      '#options' => array(
        '8000' => t('8'),
        '6000' => t('6'),
        '4000' => t('4'),
      ),
  );

  $form['carousel']['carousel_option'] = array(
       '#type' => 'select',
       '#title' => t('Choose a style'),
       '#description' => t('Set the style for your carousel'),
       '#default_value' => theme_get_setting('carousel_option'),
       '#options' => array(
        'default' => t('Standard UBC CLF carousel'),
        'thumbnails' => t('With thumbnails'),
        'sliding_gallery' => t('Horizonal Slider'),
        'transparent_slider' => t('Transparent Slider'),     
       ),
  );

  $form['carousel']['number_of_items'] = array(
      '#type' => 'select',
      '#title' => t('Number of Items (must have at least two)'),
      '#description' => t('Choose the number of items.'),
      '#default_value' => theme_get_setting('number_of_items'),
      '#options' => array(
        '2' => t('2'),
        '3' => t('3'),
        '4' => t('4'),
        '5' => t('5'),
        '6' => t('6'),
        '7' => t('7'),
        '8' => t('8'),
        '0' => t('Unlimited'),
      ),
  );
  */


/** Tab widget settings   
---------------------------------------------------------- */
 
 /*
  $form['widget'] = array(
      '#type' => 'fieldset',
      '#title' => 'Tab widget settings',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );
  
  $form['widget']['widget_image'] = array(
      '#prefix' => '<div id="widget-image">',
      '#suffix' => '</div>',
      '#type' => 'radios',
      '#title' => t(''),
      '#default_value' => theme_get_setting('widget_image'),
      '#options' => array(
      ),
  );

  $form['widget']['widget_enable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable widget'),
      '#description' => t('Click the checkbox to enable the widget.'),
      '#default_value' => theme_get_setting('widget_enable'),
  );

  $form['widget']['widget_items'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Add items to widget'),
      '#description' => t('Check the items to add to the widget.'),
      '#default_value' => theme_get_setting('widget_items'),
      '#options' => array(
        'featured' => t('<strong>Featured</strong> - Must have Featured Module installed'),
        'news' => t('<strong>News</strong> - Must have News Module installed'),
        'events' => t('<strong>Events</strong> - Must have Events Module installed'),
      ),
  );
  */



/** CLF GENERAL UNIT INFORMATION
---------------------------------------------------------- */
  $form['clf_general'] = array(
    '#type' => 'fieldset', 
    '#title' => t('CLF General Unit Information'), 
    '#prefix' => '<div class="clf_general">', 
    '#suffix' => '</div>',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['clf_general']['clf_unitinfohelp'] = array('#type' => 'markup', '#value' => '<p>Fill in your unit\'s information here.  Only the unit name field is required.  The field values are used to generate a <a href="http://microformats.org/wiki/hcard" target="_blank">microformats hCard</a> in the CLF footer.</p>');

  $form['clf_general']['clf_unitname'] = array(
    '#type' => 'textfield', 
    '#title' => t('Unit Name (sets name in Unit area of header and footer)'), 
    '#default_value' => theme_get_setting('clf_unitname'), 
    '#size' => 60, 
    '#maxlength' => 128,
    '#required' => true,
  );
  
  $form['clf_general']['clf_campus'] = array(
      '#type' => 'radios',
      '#title' => t('Campus'),
      '#description' => t('Choose the campus.'),
      '#default_value' => theme_get_setting('clf_campus'),
      '#options' => array(
        '' => t('Exclude'),
        '<div class="ubc7-address-campus">Vancouver Campus</div>' => t('Vancouver'),
        '<div class="ubc7-address-campus">Okanagan Campus</div>' => t('Okanagan'),
      ),
  );

  $form['clf_general']['clf_streetaddr'] = array(
    '#type' => 'textfield', 
    '#title' => t('Street Address'), 
    '#default_value' => theme_get_setting('clf_streetaddr'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_general']['clf_locality'] = array(
    '#type' => 'textfield', 
    '#title' => t('City'), 
    '#default_value' => theme_get_setting('clf_locality'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_general']['clf_region'] = array(
    '#type' => 'textfield', 
    '#title' => t('Province / Region'), 
    '#default_value' => theme_get_setting('clf_region'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_general']['clf_country'] = array(
    '#type' => 'textfield', 
    '#title' => t('Country Name'), 
    '#default_value' => theme_get_setting('clf_country'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_general']['clf_postal'] = array(
    '#type' => 'textfield', 
    '#title' => t('Postal Code'), 
    '#default_value' => theme_get_setting('clf_postal'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_general']['clf_telephone'] = array(
    '#type' => 'textfield', 
    '#title' => t('Telephone Number'), 
    '#default_value' => theme_get_setting('clf_telephone'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_general']['clf_fax'] = array(
    '#type' => 'textfield', 
    '#title' => t('Fax Number'), 
    '#default_value' => theme_get_setting('clf_fax'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_general']['clf_email'] = array(
    '#type' => 'textfield', 
    '#title' => t('Email'), 
    '#default_value' => theme_get_setting('clf_email'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );


/** CLF UMBRELLA UNIT INFORMATION
---------------------------------------------------------- */
  $form['clf_umbrella'] = array(
    '#type' => 'fieldset', 
    '#title' => t('CLF Umbrella Unit Information'), 
    '#prefix' => '<div class="clf_general">', 
    '#suffix' => '</div>',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['clf_umbrella']['clf_u_unitinfoshow'] = array(
      '#type' => 'checkbox',
      '#prefix' => '<label>Show unit information in footer</label>', 
      '#suffix' => '<br />',
      '#title' => t('Show in Footer'),
      '#description' => t('Should the Umbrella Unit information be displayed in the footer?'),
      '#default_value' => theme_get_setting('clf_u_unitinfoshow'),
  );
  

  $form['clf_umbrella']['clf_u_unitname'] = array(
    '#type' => 'textfield', 
    '#title' => t('Umbrella Unit Name (sets Umbrella Unit name in Unit area of header and footer)'), 
    '#default_value' => theme_get_setting('clf_u_unitname'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );
  
  $form['clf_umbrella']['clf_u_campus'] = array(
      '#type' => 'radios',
      '#title' => t('Campus'),
      '#description' => t('Choose the campus.'),
      '#default_value' => theme_get_setting('clf_u_campus'),
      '#options' => array(
        '' => t('Exclude'),
        '<div class="ubc7-address-campus">Vancouver Campus</div>' => t('Vancouver'),
        '<div class="ubc7-address-campus">Okanagan Campus</div>' => t('Okanagan'),
      ),
  );

  $form['clf_umbrella']['clf_u_streetaddr'] = array(
    '#type' => 'textfield', 
    '#title' => t('Street Address'), 
    '#default_value' => theme_get_setting('clf_u_streetaddr'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_umbrella']['clf_u_locality'] = array(
    '#type' => 'textfield', 
    '#title' => t('City'), 
    '#default_value' => theme_get_setting('clf_u_locality'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_umbrella']['clf_u_region'] = array(
    '#type' => 'textfield', 
    '#title' => t('Province / Region'), 
    '#default_value' => theme_get_setting('clf_u_region'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_umbrella']['clf_u_country'] = array(
    '#type' => 'textfield', 
    '#title' => t('Country Name'), 
    '#default_value' => theme_get_setting('clf_u_country'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_umbrella']['clf_u_postal'] = array(
    '#type' => 'textfield', 
    '#title' => t('Postal Code'), 
    '#default_value' => theme_get_setting('clf_u_postal'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_umbrella']['clf_u_telephone'] = array(
    '#type' => 'textfield', 
    '#title' => t('Telephone Number'), 
    '#default_value' => theme_get_setting('clf_u_telephone'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_umbrella']['clf_u_fax'] = array(
    '#type' => 'textfield', 
    '#title' => t('Fax Number'), 
    '#default_value' => theme_get_setting('clf_u_fax'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );

  $form['clf_umbrella']['clf_u_email'] = array(
    '#type' => 'textfield', 
    '#title' => t('Email'), 
    '#default_value' => theme_get_setting('clf_u_email'), 
    '#size' => 60, 
    '#maxlength' => 128,
  );
  
  
/** CLF SOCIAL MEDIA LINKS (FOOTER)
---------------------------------------------------------- */
    $form['clf_social'] = array(
      '#type' => 'fieldset', 
      '#title' => t('CLF Social Media Links (FOOTER)'), 
      '#prefix' => '<div class="clf_general">', 
      '#suffix' => '</div>',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
  
    $form['clf_social']['clf_social_twitter'] = array(
      '#type' => 'textfield', 
      '#title' => t('Twitter Account Link'), 
      '#default_value' => theme_get_setting('clf_social_twitter'), 
      '#size' => 60, 
      '#maxlength' => 128,
    );
  
    $form['clf_social']['clf_social_facebook'] = array(
      '#type' => 'textfield', 
      '#title' => t('Facebook Account Link'), 
      '#default_value' => theme_get_setting('clf_social_facebook'), 
      '#size' => 60, 
      '#maxlength' => 128,
    );


/** WEB TOOLS (analytics etc.)
---------------------------------------------------------- */
  $form['web_tools'] = array(
      '#type' => 'fieldset',
      '#title' => 'Tracking and SEO',
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );

  $form['web_tools']['google_analytics'] = array(
      '#type' => 'textfield',
      '#title' => t('Paste Google Analytics UA tracking code (for example, UA-125436)'),
      '#maxlength' => '50',
      '#description' => t('You can find this on the settings page in your <a href="http://google.com/analytics" target="_blank">Google Analytics account</a>. Should be in form UA-XXXXXXX'),
      '#default_value' => 'UA-',
      '#required' =>  FALSE,
      '#default_value' => theme_get_setting('google_analytics'),
  );

  $form['web_tools']['webmaster_tools_verification'] = array(
      '#type' => 'textfield',
      '#title' => t('Paste your Google Webmaster Tools verification code (for example, 30594838)'),
      '#required' => FALSE,
      '#default_value' => theme_get_setting('webmaster_tools_verification'),
  );


// Return the additional form widgets
return $form;
}
?>

