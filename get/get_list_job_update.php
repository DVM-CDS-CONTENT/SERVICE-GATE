<?php
// $type = $_GET['type']; 

// if($type =='owner'){

// }
 session_start();
 date_default_timezone_set("Asia/Bangkok");
 $con = mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "
    SELECT id, `action`, action_date, action_by, action_table, action_data_id, nt_readable, nt_readed
    FROM all_in_one_project.log 
    where (nt_readable like '%".$_SESSION["username"]."%' or nt_readed like '%".$_SESSION["username"]."%' ) and action_by <> '".$_SESSION["username"]."'
    order by id desc
    limit 100
 ";
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result)) {
    echo ' <li class="notifications-li">
                <span>'.$row["action_table"].'</span>
                <span>'.$row["action_data_id"].'</span>
                <span>'.$row["action"].'</span>
                <span>'.$row["actiondate"].'</span>
           </li>';
  }
  mysqli_close($con);
  ?>