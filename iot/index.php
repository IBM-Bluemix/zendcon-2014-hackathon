 <?php
// Licensed under the Apache License. See footer for details.

$tripId = "Amanda-1407354135195";

try {
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://hrtracker.mybluemix.net/api/trip/" . $tripId . "/data");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
  $data = curl_exec($ch);
  curl_close($ch);    

  $trip = json_decode( $data, TRUE );

  echo "<p>";
  echo json_encode($trip);
  echo "</p>";

} catch(Exception $e) {
  echo '<p>Failed to retrieve trip data</p>';
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