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
  $output = '
    <!-- UBC Global Utility Menu -->
    <div class="collapse expand" id="ubc7-global-menu">
        <div id="ubc7-search" class="expand">
            <div id="ubc7-search-box">
                <form class="form-search" method="get" action="http://www.ubc.ca/search/refine/">
                    <input type="text" name="q" placeholder="' . $search_text . '" class="input-xlarge search-query">
                    <input type="hidden" name="label" value="' . $subunit_text . '" />
                    <input type="hidden" name="site" value="' . $subunit_search .'" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <div id="ubc7-global-header" class="expand">
            <!-- Global Utility Header from CDN -->
        </div>
    </div>
    <!-- End of UBC Global Utility Menu -->';
  return $output;
}

/** Return the UBC CLF HEADER
---------------------------------------------------------- */
function megatron_ubc_clf_header($variables) {
  $output = '';
   if (theme_get_setting('clf_u_unitname')) {
      $output .= '
      <div id="ubc7-unit-name"><a href="/"><span id="ubc7-unit-faculty">' . theme_get_setting('clf_u_unitname'); 
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
    $output = '<div id="ubc7-unit-footer" class="row-fluid expand">';
    if (theme_get_setting('clf_u_unitinfoshow')) {
        $output .= '<div class="span5" id="ubc7-unit-address">';
    } 
    else { $output .= '<div class="span10" id="ubc7-unit-address">'; }
    $output .= '<div class="ubc7-address-unit-name"><strong>' . theme_get_setting('clf_unitname') . '</strong></div>' . theme_get_setting('clf_campus') . ''; 
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
    $output .= '<div id="ubc7-address-phone">' . theme_get_setting('clf_telephone') . '</div></div>';
    if (theme_get_setting('clf_u_unitinfoshow')) {
        $output .= '<div class="span5">';
        $output .= '<div class="ubc7-address-unit-name"><strong>' . theme_get_setting('clf_u_unitname') . '</strong></div>'; 
        $output .= theme_get_setting('clf_u_campus');
        $output .= '<div class="ubc7-address-street">' . theme_get_setting('clf_u_streetaddr') . '</div>';
        $output .= '<div class="ubc7-address-location">';
        $output .= '<span class="ubc7-address-city">' . theme_get_setting('clf_u_locality') . '</span>';
         if (theme_get_setting('clf_u_locality') && theme_get_setting('clf_u_region')) {
            $output .= ',';
          }
        $output .= ' <span class="ubc7-address-province" title="' . theme_get_setting('clf_u_region') . '">' . theme_get_setting('clf_region') . '</span> ';
        $output .= '<span class="ubc7-address-country">' . theme_get_setting('clf_u_country') . '</span> ';
        $output .= '<span class="ubc7-address-postal">' . theme_get_setting('clf_u_postal') . '</span>';
        $output .= '</div>';
        $output .= '<div class="ubc7-address-phone">' . theme_get_setting('clf_u_telephone') . '</div></div>';
    } 
    else { $output .= ''; }
    $output .= '<div class="span2">';
    if (theme_get_setting('clf_social_facebook') || theme_get_setting('clf_social_twitter'))  {
      $output .= '<strong>Find us on</strong><div id="ubc7-unit-social-icons">';
        if (theme_get_setting('clf_social_facebook')) {
          $output .= '<a href="' . theme_get_setting('clf_social_facebook') . '"><i class="icon-facebook-sign"></i></a>&nbsp;';
        }
        if (theme_get_setting('clf_social_twitter')) {
          $output .= '<a href="' . theme_get_setting('clf_social_twitter') . '"><i class="icon-twitter-sign"></i></a>&nbsp;';
        }
      $output .= '</div>';
    } 
    else { $output .= ''; }
    $output .= '
      </div></div>
      <div class="row-fluid expand ubc7-back-to-top">
        <div class="span2">
          <a href="#" title="Back to top">Back to top <div class="ubc7-arrow up-arrow grey"></div></a>
        </div>
      </div>';
    return $output;
  }
  
  /** Return the UBC CLF visual identity footer
  ---------------------------------------------------------- */
  function megatron_ubc_clf_global_utility_footer($variables) {
    $output = '<div class="row-fluid expand" id="ubc7-global-footer">
         <div class="span5" id="ubc7-signature"><a href="http://www.ubc.ca/">The University of British Columbia</a></div>
         <div class="span7" id="ubc7-footer-menu"></div>
      </div>
      <div class="row-fluid expand" id="ubc7-minimal-footer">
         <div class="span12">
           <ul>
             <li><a href="https://cdn.ubc.ca/clf/ref/emergency">Emergency Procedures</a> <span class="divider">|</span></li>
             <li><a href="https://cdn.ubc.ca/clf/ref/terms">Terms of Use</a> <span class="divider">|</span></li>
             <li><a href="https://cdn.ubc.ca/clf/ref/copyright">Copyright</a> <span class="divider">|</span></li>
             <li><a href="https://cdn.ubc.ca/clf/ref/accessibility">Accessibility</a></li>
           </ul>
         </div>
      </div>';
    return $output;
  }

/** Scripts for Google Analytics 
---------------------------------------------------------- */
function megatron_ubc_clf_bottom_scripts($variables) {
    $output = '';
    if (theme_get_setting('google_analytics')) {
        $output .= '<script type="text/javascript"> 
          <!--//--><![CDATA[//><!--var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));//--><!]]></script>';
        $output .= '<script type="text/javascript"> 
          <!--//--><![CDATA[//><!--
            try{var pageTracker = _gat._getTracker("' . theme_get_setting('google_analytics') . '");pageTracker._trackPageview();} catch(err) {}
          //--><!]]>
        </script>';
      } 
    return $output; 
  }