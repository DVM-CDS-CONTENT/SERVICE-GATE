<?php
 session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","taxonomy") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$sku = $_POST['sku'];
$element_name = $_POST['element_name'];
$new_value = $_POST['new_value'];
//select taxonomy
$query = "SELECT ".$element_name." from taxonomy.taxonomy_raw_f2 where sku='".$sku."'"
or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $old_value=$row[$element_name];
}

        //insert to complete data
        $sql = "INSERT INTO taxonomy.taxonomy_revised_record_f2
        (sku,
        attribute_code,
        old_value,
        new_value)
        values
        (
        '".$sku."',
        '".$element_name."',
        '".$old_value."',
        '".$new_value."')"
        or die("Error:" . mysqli_error($con));
        $query = mysqli_query($con,$sql);
        if($query){
                echo "update completed";
        }else{
                echo "error: can't update revised record Error->".$con->error.", please contact jaroonwit - sku  ".$sku;
        }


?>