<?php
$create_type = $_POST['create_type'];
$parent = $_POST['parent'];
$label = $_POST['label'];
$code = $_POST['code'];
$path_id = $_POST['path_id'];

session_start();

function insert_folder($parent,$label,$code,$path_id){
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO assets_directories (
	code,
    label,
    parent,
    path_id
    )
	VALUES (
    '".$code."',
    '".$label."',
    '".$parent."',
    '".$path_id."'
    )";
	$query = mysqli_query($con,$sql);
    mysqli_close($con);
}

insert_folder($parent,$label,$code,$path_id)


?>