<?php
/*
Controller name: Core
Controller description: Basic introspection methods
*/

class JSON_API_Core_Controller {
  
  public function info() {

    global $json_api;
	
    $php = '';
    if (!empty($json_api->query->controller)) {
      return $json_api->controller_info($json_api->query->controller);
    } else {
      $dir = json_api_dir();
      if (file_exists("$dir/index.php")) {
        $php = file_get_contents("$dir/index.php");
      } else {
        // Check one directory up, in case json-api.php was moved
        $dir = dirname($dir);
        if (file_exists("$dir/index.php")) {
          $php = file_get_contents("$dir/index.php");
        }
      }
      if (preg_match('/^\s*Version:\s*(.+)$/m', $php, $matches)) {
        $version = $matches[1];
      } else {
        $version = '(Unknown)';
      }
 

      $controllers =  $json_api->get_controllers();
	  
 
      return array(
        'json_api_version' => $version,
        'controllers' => array_values($controllers)
      );
    }
  }
  
 
   
}

?>
