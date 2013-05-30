<?php
/*
Controller name: Overlay
Controller description: User Functions via Json
*/

class JSON_API_4k_Controller {

 

public function findOZByAddress() { 
//http://maps.googleapis.com/maps/api/geocode/json?address=Brasilia&sensor=true
  
}
 

public function findOZbyCountryName(){ 
  global $json_api;
  $output = array();

   extract($json_api->query->get(array('country')));

   if(isset($country)){ 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, MAPSERVER);
             $data = array(
            'where' => "Cnty_Name='".$country."'", 
            'f' => 'json', 
            'returnGeometry' => 'false'
            );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // Getting results
        $result =  curl_exec($ch); // Getting jSON result string
            
        return $result;
}else  $json_api->error("Country not defined.");
  
  

}

public function findOZByWorldType(){ }

public function findOZbyName() { }

public function FindOzByWorldID() { }


public function findTotalOZ() {

        $ch = curl_init();
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			  curl_setopt($ch, CURLOPT_POST, 1);
			  curl_setopt($ch, CURLOPT_URL, MAPSERVER);
             $data = array(
				    'where' => 'Offers>=0', 
				    'f' => 'json', 
				    'returnGeometry' => 'false',
				    'returnDistinctValues' => 'true',
				    'returnCountOnly' =>'true'
 				  );
  			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // Getting results
        $result =  curl_exec($ch); // Getting jSON result string
            
        return $result;

    }  
  
 
}

?>
