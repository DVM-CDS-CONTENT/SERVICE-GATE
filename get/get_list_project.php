<?php
  session_start();
  if($_POST["prefix_project_sticky"]<>""){
    $_SESSION["prefix_project_sticky"] = $_POST["prefix_project_sticky"];
  }else{
    if($_SESSION["prefix_project_sticky"]==""){
      $_SESSION["prefix_project_sticky"] = "'CR','DT'";
      
    }else{
      $_SESSION["prefix_project_sticky"] = $_SESSION["prefix_project_sticky"];
    }
  }
 

  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT pb.id,pb.project_name,
  pb.description,
  pb.owner,
  pb.sticky,
  pb.status,
  pb.prefix,
  ac.profile_url
  FROM all_in_one_project.project_bucket as pb 
  left join all_in_one_project.account as ac
  on pb.owner = ac.username 
  where pb.prefix in (".$_SESSION['prefix_project_sticky'].") order by pb.sticky DESC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  
 ?><div class="overflow-auto slide" style="padding: 10px;margin-bottom:10px">
    <div class="card-group" style="width: max-content;"><?php
     while($row = mysqli_fetch_array($result)) {
       
       // sticky project
       if($row["sticky"]==1){
        $sticky_style= 'style="border: solid 3px #75dfa5c7;border-radius: 10px!important;margin: 10px;height: 100%;"';
       }else{
        $sticky_style= 'style="border-radius: 10px!important;margin: 10px;height: 100%;"';
       }

       //count comment
      $sql="SELECT count(*) as total from content_request where ticket_template = '".$row["prefix"]."'";
      $result_in=mysqli_query($con,$sql);
      $data=mysqli_fetch_assoc($result_in);
      $count_ticket = $data['total'];

       //assign and status not close
       $sql="SELECT count(*) as total from content_request where ticket_template = '".$row["prefix"]."' and case_officer='".$_SESSION["username"]."' and status<>'Close'";
       $result_nc=mysqli_query($con,$sql);
       $data_nc=mysqli_fetch_assoc($result_nc);
       $count_nc = $data_nc['total'];
       if($count_nc>0){
          $count_nc_style='<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$count_nc.'<span class="visually-hidden">unread messages</span></span>';
       }else{
         unset($count_nc_style);
       }

       if($row['prefix']=="CR" ){
        $ico_ts ='ticket-outline';
        $ico_ts_bg = '#dc3545!important';
      }elseif($row['prefix']=="DT" ){
        $ico_ts ='terminal-outline';
        $ico_ts_bg = '#36a2ff!important';
      }else{
        $ico_ts ='ticket-outline';
        $ico_ts_bg = '#000000!important';
        
      }
         echo ' 
            
              <div class="card shadow-sm" '.$sticky_style.'>
              <button type="button" class="btn btn-sm" style="text-align: initial;" onclick="get_project_model('.$row["id"].')" data-bs-toggle="modal" data-bs-target="#project_model">
              '.$count_nc_style.'
                  <div class="card-body" >
                      <h6 class="card-title" style="font-weight:900;margin-bottom:15px;color:'.$ico_ts_bg.'"><span>'.$row["prefix"]."</span> | ".$row["project_name"].'</h6>
                      <div style="margin:5px;font-size: 14px;color: #6b6b6b!important;"><ion-icon name="file-tray-stacked-outline" style="font-size: 18px;color: #6b6b6b!important;"></ion-icon> '.$count_ticket.' Tickets</div>
                      <div style="margin:5px;font-size: 14px;color: #6b6b6b!important;"><ion-icon name="people-outline" style="font-size: 18px;color: #6b6b6b!important;"></ion-icon> 
                      <img src="'.$row["profile_url"].'" class="rounded-circle" alt="...">'.$row["owner"].'.</div>
                  </div>
                  </button>
              </div>
            
          
       ';

     }
  mysqli_close($con);
  ?>

    </div>
    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> -->
</div><?php

?>