<?php

/* Setup variables that should be available via $context in all the templates
*/


class CurrentTheme extends TimberSite {
  function __construct() {

    add_filter( 'timber_context', array( $this, 'themeprefix_add_to_context_global' ) );
    add_filter( 'timber_context', array( $this, 'themeprefix_add_to_context_header' ) );
    add_filter( 'timber_context', array( $this, 'themeprefix_add_to_context_footer' ) );

    parent::__construct();
  }

  function themeprefix_add_to_context_global( $context ) {
    global $common_config;
    $context['common_config'] = $common_config;

    $context['site'] = $this;
    return $context;
  }
  
  function themeprefix_add_to_context_header( $context ) {
    // add menus
    $context['mainmenu'] = new TimberMenu('mainmenu');
    return $context;
  }

  function themeprefix_add_to_context_footer( $context ) {
    require_once( get_template_directory() . '/footer.php');
    return $context;
  }

}
new CurrentTheme();