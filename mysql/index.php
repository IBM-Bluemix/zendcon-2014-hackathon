 <?php
// Licensed under the Apache License. See footer for details.

//Get Connection Variables from VCAPS_SERVICES. We first need to pull in our MySQL database 
//connection variables from the VCAPS_SERVICES environment variable. This environment variable 
//will be put in your project by Bluemix once you add the MySQL database to your Bluemix
//application. 

//Debug: If you want to see all the variables returned you can use this line of code. 
// var_dump(getenv('VCAP_SERVICES')); 

// vcap_services Extraction 
$services_json = json_decode(getenv('VCAP_SERVICES'),true);
$mySql = $services_json["mysql-5.5"][0]["credentials"];

// Extract the VCAP_SERVICES variables for MySQL connection.  
$myDbUsername = $mySql["username"];
$myDbPassword = $mySql["password"];
$myDbHost = $mySql["hostname"];
$myDbName = $mySql["name"];
$myDbPort = $mySql["port"];

//Debug: Uncomment if you want to see the credentials extracted from VCAP_SERVICES
// var_dump($myDbUsername . " " . $myDbPassword . " " . $myDbHost . " " . $myDbName . " " . $myDbPort); 
 
try {

  $con=mysqli_connect($myDbHost,$myDbUsername,$myDbPassword, $myDbName, $myDbPort);

  // Check connection
  if (mysqli_connect_errno()) {
    throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
  }
  echo '<p>Connected to MySQL</p>';

  if (!mysqli_query($con,"CREATE TABLE IF NOT EXISTS hello(name VARCHAR(20))")) {
      throw new Exception("Failed to create a table:  (" . mysqli_errno($con) . ") " . mysqli_error($con));
  }

  if (!mysqli_query($con,"INSERT INTO hello(name) VALUES ('World')")) {
    throw new Exception("Failed to insert into table: (" . mysqli_errno($con) . ") " . mysqli_error($con));
  }

  $result = mysqli_query($con,"SELECT * FROM hello");
  if(mysqli_error($con)) {
    throw new Exception("Failed to select from table: (" . mysqli_errno($con) . ") " . mysqli_error($con));
  }
  while($row = mysqli_fetch_array($result)) {
      echo "<p>Hello " . $row['name'] . "</p>";
      echo "<br>";
  }

  $result = mysqli_query($con,"DELETE FROM hello");
  if(mysqli_error($con)) {
    throw new Exception("Failed to delete from table: (" . mysqli_errno($con) . ") " . mysqli_error($con));
  }

  mysql_close($con);

} catch(Exception $e) {
  echo '<p>There Was an Error With MySQL!!!</p>';
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