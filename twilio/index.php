<?php
// Licensed under the Apache License. See footer for details.

require('twilio-php/Services/Twilio.php');

//Get authentication Variables from VCAPS_SERVICES. We first need to pull in our Sendgrid  
//connection variables from the VCAPS_SERVICES environment variable. This environment variable 
//will be put in your project by Bluemix once you bind the Sendgrid service to your Bluemix
//application. 

var_dump(getenv('VCAPS_SERVICES'));

// vcap_services Extraction 
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$VcapSvs = $services_json["Twilio"][0]["credentials"];

//Debug: If you want to see all the variables returned you can use this line of code. 
//var_dump($services_json); 

// Extract the VCAP_SERVICES variables for Cloudant connection.  
 $sid = $VcapSvs["accountSID"];
 $token = $VcapSvs["authToken"];


 try {

	$fromNumber = getenv('MY_TWILIO_NUMBER'); //Your Twilio number from twilio.com/user/account/phone-numbers/incoming
	$toNumber = getenv('MY_DESTINATION_NUMBER'); //Verified Twilio number from twilio.com/user/account/phone-numbers/verified

	$client = new Services_Twilio($sid, $token);
	$message = $client->account->messages->sendMessage(
	  $fromNumber, // From a valid Twilio number
	  $toNumber, // Text this number
	  "Hello from IBM Bluemix!"
	);

	print $message->sid;

}
  catch(Exception $e) {
  //We sent something to Sag that it didn't expect.
  echo '<p>There was an error sending an SMS using Twilio!!!</p>';
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