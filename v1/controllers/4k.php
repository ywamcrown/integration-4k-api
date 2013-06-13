<?php
/*
Controller name: Overlay
Controller description: User Functions via Json
*/

class JSON_API_4k_Controller {
 
  /*
  Find Omega Zone by Address
  */
  public function findOzByAddress() {
  //http://maps.googleapis.com/maps/api/geocode/json?address=Brasilia&sensor=true
    global $json_api;
    define('GoogleMAPSERVER','http://maps.googleapis.com/maps/api/geocode/json');
    extract($json_api->query->get(array('address', 'sensor')));

    if(isset($address)){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //References for curl_setopt - http://us1.php.net/manual/en/function.curl-setopt.php
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_URL, GoogleMAPSERVER);

// echo "address is " . $address;
// echo "sensor is " . $sensor;
    //$data = "sensor=true";
      $data = ''; 
        $data = array(
          //'address' => "'".$address."'",
          'sensor' => true
          
        );
//var_dump($data);

//print_r($data);
        
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      $result =  curl_exec($ch); // Getting JSON result string from MAPSERVER
      curl_close($ch);
      return $result;

    }

/*
    extract($json_api->query->get(array('lat','lng')));  //extract parameters from URL 

    if(isset($lat) && isset($lng)){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //References for curl_setopt - http://us1.php.net/manual/en/function.curl-setopt.php
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_URL, MAPSERVER);  //MAPSERVER is defined in index.php as http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMap1a/MapServer/2/query 
        $data = array(
          'geometry' => $lat.", ".$lng,
          'f' => 'json',
          'geometryType' => 'esriGeometryPoint',
          'returnGeometry' => 'false'
        );  //Preparing parameters for MAPSERVER.  Details of parameters - http://mapservices.nps.gov/arcgis/sdk/rest/index.html?query.html
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      $result =  curl_exec($ch); // Getting JSON result string from MAPSERVER
      curl_close($ch);

      return $result;
    }elseif (!isset($lat) && isset($lng)){
      $json_api->error("Latitue not defined.");
    }elseif (!isset($lng) && isset($lat)){
      $json_api->error("Longitude not defined.");
<<<<<<< HEAD
    }else $json_api->error("Addres not defined."); 

*/
=======
    }else $json_api->error("Address not defined."); 
>>>>>>> 536d7ec0cd321d6bd209e643ad0ecae810f0e93f
  }

//http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMaptruea/MapServer/2/

//http://mapservices.nps.gov/arcgis/sdk/rest/index.html?query.html

  /*
  Find Omega Zone by Country Name
  */
  public function findOzbyCountryName(){ 
    global $json_api;

    extract($json_api->query->get(array('country')));  //extract parameters from URL 

    if(isset($country)){ 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //References for curl_setopt - http://us1.php.net/manual/en/function.curl-setopt.php
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_URL, MAPSERVER);  //MAPSERVER is defined in index.php as http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMap1a/MapServer/2/query
        $data = array(
          'where' => "Cnty_Name='".$country."'",
          'f' => 'json',
          'returnGeometry' => 'false'
        );  //Preparing parameters for MAPSERVER.  Details of parameters - http://mapservices.nps.gov/arcgis/sdk/rest/index.html?query.html
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              // Getting results
      $result =  curl_exec($ch); // Getting JSON result string from MAPSERVER
      curl_close($ch);        
      return $result;
    }else $json_api->error("Country not defined.");
  }


  /*
  Find Omega Zone by World Type
  */
  public function findOzByWorldType(){
    global $json_api;

    extract($json_api->query->get(array('world')));  //extract parameters from URL 

    if(isset($world)){ 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //References for curl_setopt - http://us1.php.net/manual/en/function.curl-setopt.php
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_URL, MAPSERVER);  //MAPSERVER is defined in index.php as http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMap1a/MapServer/2/query
        $data = array(
          'where' => "World='".$world."'",
          'f' => 'json',
          'returnGeometry' => 'false'
        );  //Preparing parameters for MAPSERVER.  Details of parameters - http://mapservices.nps.gov/arcgis/sdk/rest/index.html?query.html
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              // Getting results
      $result =  curl_exec($ch); // Getting JSON result string from MAPSERVER
      curl_close($ch);
      return $result;
    }else $json_api->error("World Type not defined.");
  }


  /*
  Find Omega Zone by Omega zone name
  */
  public function findOzByZoneName() {
    global $json_api;
    
    extract($json_api->query->get(array('zone')));  //extract parameters from URL 

    if(isset($zone)){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //References for curl_setopt - http://us1.php.net/manual/en/function.curl-setopt.php
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_URL, MAPSERVER);  //MAPSERVER is defined in index.php as http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMap1a/MapServer/2/query
        $data = array(
          'where' => "Zone_Name='".$zone."'",
          'f' => 'json',
          'returnGeometry' => 'false'
        );  //Preparing parameters for MAPSERVER.  Details of parameters - http://mapservices.nps.gov/arcgis/sdk/rest/index.html?query.html
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              // Getting results
      $result =  curl_exec($ch); // Getting JSON result string from MAPSERVER
      curl_close($ch);
      return $result;
    }else $json_api->error("Zone not defined.");
  }


  /*
  Find Omega Zone by World ID
  */
  public function findOzByWorldID() {
    global $json_api;

    extract($json_api->query->get(array('world_id')));  //extract parameters from URL 

    if(isset($world_id)){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //References for curl_setopt - http://us1.php.net/manual/en/function.curl-setopt.php
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_URL, MAPSERVER);  //MAPSERVER is defined in index.php as http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMap1a/MapServer/2/query
        $data = array(
          'where' => "WorldID='".$world_id."'",
          'f' => 'json',
          'returnGeometry' => 'false'
        );  //Preparing parameters for MAPSERVER.  Details of parameters - http://mapservices.nps.gov/arcgis/sdk/rest/index.html?query.html
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              // Getting results
      $result =  curl_exec($ch); // Getting JSON result string from MAPSERVER
      curl_close($ch);
      return $result;
    }else $json_api->error("World ID not defined.");
  }


  /*
  Find total number of Omega Zone
  */
  public function findTotalOz() {

    $ch = curl_init();
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //References for curl_setopt - http://us1.php.net/manual/en/function.curl-setopt.php
  	curl_setopt($ch, CURLOPT_POST, true);
  	curl_setopt($ch, CURLOPT_URL, MAPSERVER);  //MAPSERVER is defined in index.php as http://maps.mapfactory.org/ArcGIS/rest/services/YWAM/4kWorldMap1a/MapServer/2/query
      $data = array(
  			'where' => 'Offers>=0',
  			'f' => 'json',
  			'returnGeometry' => 'false',
  			'returnDistinctValues' => 'true',
  			'returnCountOnly' =>'true'
   		);  //Preparing parameters for MAPSERVER.  Details of parameters - http://mapservices.nps.gov/arcgis/sdk/rest/index.html?query.html
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              // Getting results
    $result =  curl_exec($ch); // Getting JSON result string from MAPSERVER
    curl_close($ch);
    return $result;
  }  
}
?>
