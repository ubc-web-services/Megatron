<?php 

/** Return the UBC CLF toolbar wrapper
---------------------------------------------------------- */
function megatron_ubc_clf_toolbar($variables) {
    // get search domain
    if (theme_get_setting('clf_searchdomain')) {
        $subunit_search = theme_get_setting('clf_searchdomain');
    } 
    else {
        $subunit_search = '*.ubc.ca';
    }

    // get unit name
    if (theme_get_setting('clf_searchlabel')) {
        $subunit_text = t('Search ') . theme_get_setting('clf_searchlabel');
    } 
    else {
        $subunit_text = t('Search');
    }


    // get search text
    if (theme_get_setting('clf_subunit_blank')) {
    } 
    else if (theme_get_setting('clf_subunit_override')) {
        $search_text = t('Search ') . theme_get_setting('clf_subunit_override');
    }
    else {
        $search_text = t('Search');
    }
  $output = '<form class="form-search" method="get" action="//www.ubc.ca/search/refine/">
      <input type="text" name="q" placeholder="' . $search_text . '" class="input-xlarge search-query">
      <input type="hidden" name="label" value="' . $subunit_text . '" />
      <input type="hidden" name="site" value="' . $subunit_search .'" />
      <button type="submit" class="btn btn-primary">Search</button>
    </form>';
  return $output;
}

/** Return the UBC CLF HEADER
---------------------------------------------------------- */
function megatron_ubc_clf_header($variables) {
  global $base_path;
  $output = '';
   if (theme_get_setting('clf_faculty')) {
      $output .= '
      <div id="ubc7-unit-name"><a href="' . $base_path . '"><span id="ubc7-unit-faculty">' . theme_get_setting('clf_faculty_name'); 
      $output .= '</span><span id="ubc7-unit-identifier">';
      $output .= '' . theme_get_setting('clf_unitname') . '</span></a>
  </div>';
  } 
  else {
      $output .= '
      <div id="ubc7-unit-name" class="ubc7-single-element"><a href="/"><span id="ubc7-unit-identifier">';
      $output .= '' . theme_get_setting('clf_unitname') . '</span></a>
    </div>';
  }
return $output;
}

/** Return the UBC CLF BREADCRUMBS
---------------------------------------------------------- */
function megatron_ubc_clf_breadcrumbs($variables) {
  $title = drupal_set_title();
  $output = '';
  $output .= '<ul class="breadcrumb expand">';
              
  if (theme_get_setting('clf_crumbumbrellaunit')) {
      $output .= '<li><a href="' . theme_get_setting('clf_crumbumbrellawebsite') . '">' . theme_get_setting('clf_crumbumbrellaunit') . '</a><span class="divider">/</span>'; 
  } 
  if (theme_get_setting('clf_crumbunit')) {
      $output .= '<li><a href="' . theme_get_setting('clf_crumbwebsite') . '">' . theme_get_setting('clf_crumbunit') . '</a><span class="divider">/</span>'; 
  }
  $output .= '<li>' . $title . '</li></ul>';
return $output;
}

/** Return the UBC CLF visual identity footer
---------------------------------------------------------- */
function megatron_ubc_clf_visual_identity_footer($variables) {
    $clf_layout = theme_get_setting('clf_layout');
    $containerstart = '';
    $containerend = '';
    if (($clf_layout == '__full') || ($clf_layout == '__fluid')) {
        $containerstart = '<div class="container">';
        $containerend = '</div>';
    } 
    $output = '<div id="ubc7-unit-footer" class="row-fluid expand">';
    $output .= $containerstart;
    $output .= '<div class="span10" id="ubc7-unit-address">'; 
    $output .= '<div class="ubc7-address-unit-name"><strong>' . theme_get_setting('clf_unitname') . '</strong></div>' . theme_get_setting('clf_campus') . ''; 
    if (theme_get_setting('clf_faculty')) {
        $output .= '<div class="ubc7-address-faculty-name">' . theme_get_setting('clf_faculty_name') . '</div>'; }
    $output .= '<div class="ubc7-address-street">' . theme_get_setting('clf_streetaddr') . '</div>';
    $output .= '<div class="ubc7-address-location">';
    $output .= '<span class="ubc7-address-city">' . theme_get_setting('clf_locality') . '</span>';
     if (theme_get_setting('clf_locality') && theme_get_setting('clf_region')) {
        $output .= ',';
      }
    $output .= ' <span class="ubc7-address-province" title="' . theme_get_setting('clf_region') . '">' . theme_get_setting('clf_region') . '</span> ';
    $output .= '<span class="ubc7-address-country">' . theme_get_setting('clf_country') . '</span> ';
    $output .= '<span class="ubc7-address-postal">' . theme_get_setting('clf_postal') . '</span>';
    $output .= '</div>';
    if (theme_get_setting('clf_telephone')) {
       $output .= '<div class="ubc7-address-phone">Tel ' . theme_get_setting('clf_telephone') . '</div>';
     }
    if (theme_get_setting('clf_fax')) {
       $output .= '<div class="ubc7-address-fax">Fax ' . theme_get_setting('clf_fax') . '</div>';
     }
    if (theme_get_setting('clf_email')) {
        $output .= '<div class="ubc7-address-email">E-mail <a href="mailto:' . theme_get_setting('clf_email') . '">' . theme_get_setting('clf_email') . '</a></div>';
    }
    if (theme_get_setting('clf_website')) {
        $output .= '<div class="ubc7-address-website">Website <a href="http://' . theme_get_setting('clf_website') . '" title="' . theme_get_setting('clf_unitname') . '">' . theme_get_setting('clf_website') . '</a></div>';
    }
    $output .= '</div>';
    if (theme_get_setting('clf_social_facebook') || theme_get_setting('clf_social_twitter') || theme_get_setting('clf_social_linkedin') || theme_get_setting('clf_social_googleplus') || theme_get_setting('clf_social_youtube'))  {
      $output .= '<div class="span2"><strong>Find us on</strong><div id="ubc7-unit-social-icons">';
        if (theme_get_setting('clf_social_facebook')) {
          $output .= '<a href="' . theme_get_setting('clf_social_facebook') . '"><i class="icon-facebook-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_twitter')) {
          $output .= '<a href="' . theme_get_setting('clf_social_twitter') . '"><i class="icon-twitter-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_linkedin')) {
          $output .= '<a href="' . theme_get_setting('clf_social_linkedin') . '"><i class="icon-linkedin-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_googleplus')) {
          $output .= '<a href="' . theme_get_setting('clf_social_googleplus') . '"><i class="icon-google-plus-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_youtube')) {
          $output .= '<a href="' . theme_get_setting('clf_social_youtube') . '"><i class="icon-youtube"></i></a>&nbsp;';
        }
      $output .= '</div></div>';
    } 
    else { $output .= ''; }
    $output .= $containerend;
    $output .= '</div><div class="row-fluid expand ubc7-back-to-top">';
    $output .= $containerstart;
    $output .= '<div class="span2">
          <a href="#" title="Back to top">Back to top <div class="ubc7-arrow up-arrow grey"></div></a>
        </div>';
    $output .= $containerend;    
    $output .= '</div>';
    return $output;
  }
  
  /** Return the UBC CLF visual identity footer
  ---------------------------------------------------------- */
  function megatron_ubc_clf_global_utility_footer($variables) {
    $clf_layout = theme_get_setting('clf_layout');
    $containerstart = '';
    $containerend = '';
    if (($clf_layout == '__full') || ($clf_layout == '__fluid')) {
        $containerstart = '<div class="container">';
        $containerend = '</div>';
    } 
    $output = '<div class="row-fluid expand" id="ubc7-global-footer">';
    $output .= $containerstart;
    $output .= '<div class="span5" id="ubc7-signature"><a href="http://www.ubc.ca/">The University of British Columbia</a></div>
         <div class="span7" id="ubc7-footer-menu"></div>';
    $output .= $containerend;   
    $output .= '</div>
      <div class="row-fluid expand" id="ubc7-minimal-footer">';
    $output .= $containerstart;
    $output .= '<div class="span12">
           <ul>
             <li><a href="https://cdn.ubc.ca/clf/ref/emergency">Emergency Procedures</a> <span class="divider">|</span></li>
             <li><a href="https://cdn.ubc.ca/clf/ref/terms">Terms of Use</a> <span class="divider">|</span></li>
             <li><a href="https://cdn.ubc.ca/clf/ref/copyright">Copyright</a> <span class="divider">|</span></li>
             <li><a href="https://cdn.ubc.ca/clf/ref/accessibility">Accessibility</a></li>
           </ul>
         </div>';
     $output .= $containerend;   
     $output .= '</div>';
    return $output;
  }
