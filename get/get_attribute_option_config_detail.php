<?php

$attribute_code = $_POST['attribute_code'];
$table_name = $_POST['table_name'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT *
FROM u749625779_cdscontent.job_attribute_option
where attribute_code='".$attribute_code."'  and attribute_table = '".$table_name."'"  or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) { 

    $attribute_option_row .= ' <tr id="attribute_option_id_'.$row['id'].'">
    <th>'. $row['attribute_option_code'].'</th>
    <td>'. $row['attribute_option_label'].'</td>
    <td>
    <button type="button" data-bs-toggle="modal" 
    data-bs-target="#exampleModal" onclick="form_attribute_option('. $row['id'].')" class="btn btn-dark btn-sm">
    <ion-icon name="create-outline" style="margin: 0;"></ion-icon></button>

    <button type="button"  class="btn btn-danger btn-sm" onclick="delete_option(&#39;u749625779_cdscontent&#39;,&#39;job_attribute_option&#39;,'. $row['id'].',&#39;id&#39;)" >
    <ion-icon name="trash-outline" style="margin: 0;"></ion-icon></button>
    </td>

    
  </tr>';


}
echo $attribute_option_row ;
?>