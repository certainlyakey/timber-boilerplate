<?php
/*  
    Redefine or setup variables that should be available via $context['post'] 
    in all the templates. If you want to do something with global post.thumbnail 
    property before it reaches templates — here's is the place 
*/


class CommonPost extends TimberPost {

  // we should fully rewrite default functions readding their original functionality as well
  // public function thumbnail() {
  //   $returned = $thumbnail_id ? new TimberImage($thumbnail_id) : null;
  //   return $returned;
  // }
}
