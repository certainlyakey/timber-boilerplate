<?php

/* Hooks related to content structure and everything displayed on admin side
*/


//Enable background updates even if there is a git in the root (and there is!)
add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );
