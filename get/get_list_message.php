<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query_tg = "SELECT message_box.id as id, target.target_username as username, target.read as read, target.accepted_date as accepted_date, target.read_date as read_date, target.create_date as create_date, target.update_date as update_date, target.msid as msid
  ,message_box.title as title,message_box.description as description 
  FROM all_in_one_project.target_message_box as target
  left join all_in_one_project.message_box as message_box on target.msid = message_box.id ;
  where target.target_username = ".$_SESSION["username"]." ORDER BY id DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query_tg);
 
        echo "<tr>";
        echo "<th scope='row' style='background: #ededed;'>star</th>";
        echo "<td style='background: #ededed;'>".$row["id"]."</dh>";
        echo "<td style='background: #ededed;'>".$row["title"]."</td>";  
        echo "<td style='background: #ededed;'><button type='button' class='btn btn-warning'>ตรวจสอบ</button></td>";
        echo "</tr>";
    } 

  mysqli_close($con);
  ?>
