 <?php
// Licensed under the Apache License. See footer for details.

//Get Connection Variables from VCAPS_SERVICES. We first need to pull in our Watson QA 
//connection variables from the VCAPS_SERVICES environment variable. This environment variable 
//will be put in your project by Bluemix once you add the Watson QA service to your Bluemix
//application. 

header('Content-type: application/json');

//Debug: If you want to see all the variables returned you can use this line of code. 
// var_dump(getenv('VCAP_SERVICES')); 

// vcap_services Extraction 
$services_json = json_decode(getenv('VCAP_SERVICES'), true);
$watsonQa = $services_json["question_and_answer"][0]["credentials"];

// Extract the VCAP_SERVICES variables for Watson QA connection.  
$username = $watsonQa["username"];
$password = $watsonQa["password"];
$url = $watsonQa["url"] . '/v1/question/travel';
$auth = base64_encode($username . ":" . $password);

//Debug: Uncomment if you want to see the credentials extracted from VCAP_SERVICES
// var_dump($username . " " . $password . " " . $url . " " . $auth); 
 
try {

  $data = json_decode( file_get_contents("php://input"), TRUE );
  //Debug: Here's a sample request you can use for testing
  // $data = array(
  //   'question' => array(
  //     'evidenceRequest' => array('items' => 5),
  //     'questionText' => 'What should I see in Prague?'
  //   )
  // );  
  $data_string = json_encode($data);                                                                                     

  $curl = curl_init();
  
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
      'Content-Type: application/json',
      'X-synctimeout: 30',
      'Authorization: Basic ' . $auth,
      'Content-Length: ' . strlen($data_string))                                                                       
  );     
     
    curl_setopt($curl, CURLOPT_POST, true);       
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);

    curl_close($curl);

    echo $result;


} catch(Exception $e) {
  echo '<p>There Was an Error Accessing Watson QA!!!</p>';
  echo $e->getMessage();
}

//-------------------------------------------------------------------------------
// Copyright IBM Corp. 2014
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
// http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//-------------------------------------------------------------------------------
?>