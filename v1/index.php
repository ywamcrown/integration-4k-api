<?php

/*
Version: 13.5.1
Version Description: July 2013 1.0
*/
define('CHARSET','utf8');
define('MAPSERVER','http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMap1a/MapServer/2/query');
  

   function json_api_dir() {
  if (defined('JSON_API_DIR') && file_exists(JSON_API_DIR)) {
    return JSON_API_DIR;
  } else {
    return dirname(__FILE__);
  }
}

$json_api = 0; 
 

function json_api_init() {
   global $json_api;

  
   //define rewrite rules
 // $this->json_api_rewrites();

  $json_api = new JSON_API();
}

 

function json_api_activation() {
  // Add the rewrite rule on activation
  global $wp_rewrite;
   $wp_rewrite->flush_rules();
}
 

function json_api_rewrites() {
  //$base = get_option('json_api_base', 'api');
  $base = 'api';
  
  $json_api_rules = array(
    "$base\$" => 'index.php?json=info',
    "$base/(.+)\$" => 'index.php?method=$matches[1]'
  );
  return $json_api_rules;
}

 
 
 $dir = json_api_dir();
 
 
@include_once "$dir/singletons/api.php";
@include_once "$dir/singletons/query.php";
@include_once "$dir/singletons/introspector.php";
 @include_once "$dir/singletons/response.php";
@include_once "$dir/models/post.php";
@include_once "$dir/models/comment.php";
@include_once "$dir/models/category.php";
@include_once "$dir/models/tag.php";
@include_once "$dir/models/author.php";
@include_once "$dir/models/attachment.php";
 

  json_api_init();
  $json_api->template_redirect();
?>