<?php

$db_host = "64.227.100.246";
	$db_user = "wnfthmnhyp";
	$db_pass = "nkvJ44Cnfr";
	$db_name = "wnfthmnhyp";
$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);


if (isset($_REQUEST['find_state'])) {
  $bank_name=$_REQUEST['find_state'];
  $query=mysqli_query($con,"SELECT DISTINCT `adr4` FROM `bank_records` WHERE `name`='$bank_name'");
  $resp='<option>Select</option>';
  while ($data=mysqli_fetch_array($query)) {
    $resp=$resp."<option>".$data['adr4']."</option>";
  }
  echo $resp;
}

if (isset($_REQUEST['find_city'])) {
  $bank_name=$_REQUEST['find_city'];
  $state=$_REQUEST['bank_state'];
  $query=mysqli_query($con,"SELECT DISTINCT `adr3` FROM `bank_records` WHERE `name`='$bank_name' AND `adr4`='$state'");
  $resp='<option>SELECT STATE</option>';
  while ($data=mysqli_fetch_array($query)) {
    $resp=$resp."<option>".$data['adr3']."</option>";
  }
  echo $resp;
}

if (isset($_REQUEST['find_branch'])) {
  $bank_name=$_REQUEST['find_branch'];
  $state=$_REQUEST['bank_state'];
  $city=$_REQUEST['bank_city'];
  $query=mysqli_query($con,"SELECT  `adr1` FROM `bank_records` WHERE `name`='$bank_name' AND `adr4`='$state' AND `adr3`='$city'");
  $resp='<option>SELECT CITY</option>';
  while ($data=mysqli_fetch_array($query)) {
    $resp=$resp."<option>".$data['adr1']."</option>";
  }
  echo $resp;
}

if (isset($_REQUEST['find_ifsc'])) {
  $bank_name=$_REQUEST['find_ifsc'];
  $state=$_REQUEST['bank_state'];
  $city=$_REQUEST['bank_city'];
  $branch=$_REQUEST['bank_branch'];
  $query=mysqli_query($con,"SELECT  `ifsc` FROM `bank_records` WHERE `name`='$bank_name' AND `adr4`='$state' AND `adr3`='$city' AND `adr1`='$branch'");
  $resp='<option>SELECT BRANCH</option>';
  while ($data=mysqli_fetch_array($query)) {
    // $resp=$resp."<option>".$data['ifsc']."</option>";
    $string = "".$data['ifsc']."";
  
// Printing the string directly
echo ("<span>Your IFSC Code is:</span> ");
  }
  echo $string;
}
 ?>