<?php

/* Setup variables that should be available via $context in all the templates
*/


class CurrentTheme extends TimberSite {
  function __construct() {

    add_filter( 'timber_context', array( $this, 'themeprefix_add_to_context_global' ) );
    add_filter( 'timber_context', array( $this, 'themeprefix_add_to_context_header' ) );

    parent::__construct();
  }

  function themeprefix_add_to_context_global( $context ) {
    $context['site'] = $this;
    return $context;
  }
  
  function themeprefix_add_to_context_header( $context ) {
    // add menus
    $context['mainmenu'] = new TimberMenu('mainmenu');
    return $context;
  }

}
new CurrentTheme();