<?php
    session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    date_default_timezone_set("Asia/Bangkok");
    $id = $_POST["id"];
    $op_follow_assign_name = $_POST["op_follow_assign_name"];
    $sql = "UPDATE add_new_job SET follow_assign_date = CURRENT_TIMESTAMP , follow_assign_name = '".$op_follow_assign_name."' WHERE id=".$id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
      //send to line
      date_default_timezone_set("Asia/Bangkok");
      $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"],"all_in_one_project") or die("Error: " . mysqli_error($con));
      mysqli_query($con, "SET NAMES 'utf8' ");
      $query = "SELECT  * FROM add_new_job  WHERE id = ".$id
      or die("Error:" . mysqli_error($con));
      $result =  mysqli_query($con, $query);
          while($row = mysqli_fetch_array($result)) {
              $participant = $row["participant"];
              $brand = $row["brand"];
              $sku = $row["sku"];
              $request_username = $row["request_username"];
              $parent = $row["parent"];

          }
          $sent_to = explode(",",$participant);
          foreach ($sent_to as $sent_to_username) {
          if($sent_to_username<>$_SESSION["username"] and $sent_to_username<>$request_username){
          $query = "SELECT  * FROM account where username = '".$sent_to_username."'" or die("Error:" . mysqli_error($con));
          $result =  mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                  $key = $row["token_line"];
              }
              if($key<>"" and $key<>null){
                  sent_line_noti("\nNS-".$id." [".$brand." ".$sku." SKUs]  \n--------------------------\n".$_SESSION["nickname"]." has assign this task to ".$op_follow_assign_name,$key);
              }
          }
      }
       add_participant($_POST['id'],"add_new_job");
       add_participant($parent,"add_new_job");
        insert_log("send to traffic > accepted_date = ".date("Y-m-d H:i:s")." \n status = accepted" ,"add_new_job",$id);
        // echo date("Y-m-d H:i:s");
	}else{
        insert_log("send to traffic faild >".$con->error ,"add_new_job",$id);
        // echo 'Error: ' . $sql . '<br>' . $con->error.'';
    }
    mysqli_close($con);
    //header( "location: https://cdse-commercecontent.com/base/homepage.php");
    ?>
