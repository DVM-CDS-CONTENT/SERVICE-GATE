<?php
 $username = $_POST['username'];
 $tell = $_POST['tell'];
 $dept = $_POST['dept'];
 $user_id = $_POST['user_id'];
 $pictureUrl = $_POST['pictureUrl'];


 function bb_register($id ,$user_id,$username,$tell,$department,$header){
 
 
 $curl = curl_init();
  
 curl_setopt_array($curl, array(
   CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_ENCODING => '',
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_TIMEOUT => 0,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   CURLOPT_CUSTOMREQUEST => 'POST',
   CURLOPT_POSTFIELDS =>'
    { "to": "'.$user_id.'",
     "messages":[
                     {
                     "type": "flex",
                     "altText": "Register Success !",
                     "sender": {
                         "name": "CSG-BOT",
                         "iconUrl": "https://line.me/conyprof"
                     },
                      "contents": {
   "type": "bubble",
   "size": "mega",
   "direction": "ltr",
   "body": {
     "type": "box",
     "layout": "vertical",
     "spacing": "none",
     "margin": "none",
     "contents": [
       {
         "type": "text",
         "text": "'.$header.'",
         "weight": "bold",
         "size": "xl",
         "color": "#57CE5BFF",
         "align": "start",
         "gravity": "bottom",
         "wrap": true,
         "style": "normal",
         "contents": []
       },
       {
         "type": "separator",
         "margin": "md"
       },
       {
         "type": "box",
         "layout": "horizontal",
         "margin": "lg",
         "contents": [
           {
             "type": "text",
             "text": "ID",
             "weight": "bold",
             "align": "start",
             "margin": "none",
             "wrap": true,
             "style": "normal",
             "contents": []
           },
           {
             "type": "text",
             "text": "'.$id.'",
             "align": "start",
             "contents": []
           }
         ]
       },
       {
         "type": "box",
         "layout": "horizontal",
         "margin": "sm",
         "contents": [
           {
             "type": "text",
             "text": "Username",
             "weight": "bold",
             "contents": []
           },
           {
             "type": "text",
             "text": "'.$username.'",
             "contents": []
           }
         ]
       },
       {
         "type": "box",
         "layout": "horizontal",
         "margin": "none",
         "contents": [
           {
             "type": "text",
             "text": "Tell",
             "weight": "bold",
             "contents": []
           },
           {
             "type": "text",
             "text": "'.$tell.'",
             "contents": []
           }
         ]
       },
       {
         "type": "box",
         "layout": "horizontal",
         "contents": [
           {
             "type": "text",
             "text": "Department",
             "weight": "bold",
             "contents": []
           },
           {
             "type": "text",
             "text": "'.$department.'",
             "contents": []
           }
         ]
       },
       {
         "type": "separator",
         "margin": "lg"
       },
       {
         "type": "box",
         "layout": "vertical",
         "margin": "lg",
         "contents": [
           {
             "type": "text",
             "text": "โปรดระบุปัญหาที่พบ โดยละเอียด  หลังจากได้รับข้อความของท่านแล้ว ทางทีมจะติดต่อกลับและดำเนินการต่อโดยเร็ว ขอบคุณ",
             "align": "center",
             "gravity": "center",
             "wrap": true,
             "contents": []
           }
         ]
       }
     ]
   }
 }
                      
                     }
             ]
     }',
   CURLOPT_HTTPHEADER => array(
     'Content-Type: application/json',
     'Authorization: Bearer J/R5foEYEGdmDL85DJBMdlMfOos7JOKVlqzd4VOE3nXpT8OtSoc6On+3wNH4bZ6GU+4riP4v562ixfwVUwWdDmHae3qbVBxKUMrKcgoBFbGkrpX+QttoamNeNodqY5aXN3hXijql94zqPLAW7d+JgQdB04t89/1O/w1cDnyilFU='
   ),
 ));
 
 $response = curl_exec($curl);
 
 
 // echo $response;
 echo '<script> console.log("'.$response.'");</script> ';
 curl_close($curl);
 }
 
 
 session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "INSERT INTO account (firstname,nickname,username,password,department,office_tell,register_type,line_user_id,profile_url) values (
    '".$username."',
     '".$username."',
     '".$username."',
     '378af2140b1f3aa30a6c5790454fab97',  
     '".$dept."',
     '".$tell."',
     'line_login',
     '".$user_id."',
     '".$pictureUrl."'
    )";
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        $lasted_id = $con->insert_id;
        $sql_uu = "UPDATE account SET username  = '".$lasted_id."_".$username."'  WHERE id='".$lasted_id."'";
        $query_uu = mysqli_query($con,$sql_uu);
        bb_register($lasted_id ,$user_id,$lasted_id."_".$username,$tell,$dept,"Register success !");
        echo '<div style="  height: 200px;
        width: 400px;
        position: fixed;
        top: 50%;
        left: 50%;
        text-align: center;
        margin-top: -100px;
        margin-left: -200px;"><h6><strong><ion-icon name="checkmark-circle-outline"></ion-icon>Success ! </strong></h6><p>คุณสามารถปิดหน้าต่างนี้เพื่อส่งเริ่มส่งข้อความ</p></div>';
       
	}else{
        echo '<script>alert("Error: ' . $sql . '\n\n' . $con->error.'")</script>';
    }
    mysqli_close($con);
?>