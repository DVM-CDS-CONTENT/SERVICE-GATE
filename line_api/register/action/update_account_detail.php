<?php
 $username = $_POST['username'];
 $attribute_update_name = $_POST['attribute_update_name'];
 $attribute_update_value = $_POST['attribute_update_value'];
 session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE account SET ".$attribute_update_name." = '".$attribute_update_value."'  WHERE username='".$username."'";
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        echo '<div style="  height: 200px;
        width: 400px;
        background: black;
        position: fixed;
        top: 50%;
        left: 50%;
        margin-top: -100px;
        color:green;
        margin-left: -200px;"><h6><strong><ion-icon name="checkmark-circle-outline"></ion-icon>Success ! </strong></h6><hr>คุณสามารถปิดหน้าต่างนี้เพื่อส่งเริ่มส่งข้อความ</div>';
	}else{
        echo '<script>alert("Error: ' . $sql . '\n\n' . $con->error.'")</script>';
    }
    mysqli_close($con);
?>