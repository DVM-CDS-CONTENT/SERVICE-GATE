<?php 
$username = $_GET['username'];
$verify_code = $_GET['verify_code'];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$sql  = "SELECT username,verify_code from account WHERE username='".$username."' and verify_code = '".$verify_code."'";
$query = mysqli_query($con,$sql);
if((mysqli_fetch_array($query) === null)){
    echo 'verify uncomplete';
}else{
    $sql  = "UPDATE account SET verify_code = 'verified' WHERE username='".$username."'";
	$query = mysqli_query($con,$sql);
    echo 'verify complete';
}
?>