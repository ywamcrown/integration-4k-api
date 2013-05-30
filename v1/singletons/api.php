	<?php

class JSON_API {
  
  function __construct() {
	  
    $this->query = new JSON_API_Query();
    $this->response = new JSON_API_Response();
 

  }
  
  function template_redirect() {
	  
  
    // Check to see if there's an appropriate API controller + method    
    $controller = strtolower($this->query->get_controller());
	
    $available_controllers = $this->get_controllers();
	 
     $active_controllers = $available_controllers;
   
    if ($controller) {
      
      if (!in_array($controller, $active_controllers)) {
        $this->error("Unknown controller '$controller'.");
      }
      
      $controller_path = $this->controller_path($controller);
      if (file_exists($controller_path)) {
        require_once $controller_path;
      }
	  
      $controller_class = $this->controller_class($controller);
      
      if (!class_exists($controller_class)) {
        $this->error("Unknown controller '$controller_class'.");
      }
      
      $this->controller = new $controller_class();
      $method = $this->query->get_method($controller);
      
      if ($method) {
      
        $this->response->setup();
        
        // Run action hooks for method
       // do_action("json_api-{$controller}-$method");
        
        // Error out if nothing is found
        if ($method == '404') {
          $this->error('Not found');
        }
        
        // Run the method
        $result = $this->controller->$method();
        
		
        // Handle the result
		if(is_array($result)) 
		      $this->response->respond($result,true);
		else 
       	 $this->response->respond($result);
        
        // Done!
        exit;
      }
    }
  }
  
 
    
  
  function get_method_url($controller, $method, $options = '') {

   // $url = get_bloginfo('url');
    //$base = get_option('json_api_base', 'api');
   // $permalink_structure = get_option('permalink_structure', '');
   /* if (!empty($options) && is_array($options)) {
      $args = array();
      foreach ($options as $key => $value) {
        $args[] = urlencode($key) . '=' . urlencode($value);
      }
      $args = implode('&', $args);
    } else {
      $args = $options;
    }
    if ($controller != 'core') {
      $method = "$controller/$method";
    }
    if (!empty($base) && !empty($permalink_structure)) {
      if (!empty($args)) {
        $args = "?$args";
      }
      return "$url/$base/$method/$args";
    } else {*/
      return "$url?json=$method&$args";
    ///}
  }
   
  function get_controllers() {

    $controllers = array();
	
    $dir = json_api_dir();
    $dh = opendir("$dir/controllers");
    while ($file = readdir($dh)) {
      if (preg_match('/(.+)\.php$/', $file, $matches)) {
        $controllers[] = $matches[1];
      }
    }
	
 //   $controllers = apply_filters('json_api_controllers', $controllers);
    return array_map('strtolower', $controllers);
  }
  
  
  function controller_info($controller) {
    $path = $this->controller_path($controller);
    $class = $this->controller_class($controller);
    $response = array(
      'name' => $controller,
      'description' => '(No description available)',
      'methods' => array()
    );
    if (file_exists($path)) {
      $source = file_get_contents($path);
      if (preg_match('/^\s*Controller name:(.+)$/im', $source, $matches)) {
        $response['name'] = trim($matches[1]);
      }
      if (preg_match('/^\s*Controller description:(.+)$/im', $source, $matches)) {
        $response['description'] = trim($matches[1]);
      }
      if (preg_match('/^\s*Controller URI:(.+)$/im', $source, $matches)) {
        $response['docs'] = trim($matches[1]);
      }
      if (!class_exists($class)) {
        require_once($path);
      }
      $response['methods'] = get_class_methods($class);
      return $response;
    }  else {
      $this->error("Unknown controller '$controller'.");
    }
    return $response;
  }
  
  function controller_class($controller) {
    return "json_api_{$controller}_controller";
  }
  
  function controller_path($controller) {
	  
    $dir = json_api_dir();
	
    $controller_class = $this->controller_class($controller);
	$variavel = $controller_class.'path';
	$$variavel = $dir.'/controllers/'.$controller.'.php';
    return $$variavel;
  }
  
  function get_nonce_id($controller, $method) {
    $controller = strtolower($controller);
    $method = strtolower($method);
    return "json_api-$controller-$method";
  }
 
  function error($message = 'Unknown error', $status = 'error') {
    $this->response->respond(array(
      'error' => $message
    ), $status);
  }
  
  function include_value($key) {
    return $this->response->is_value_included($key);
  }
  
}

?>
