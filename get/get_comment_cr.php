<?php
//issue get
session_start();

$id = $_POST['id'];
if(isset($_POST['comment'])){
    $comment = $_POST['comment'];
}else{
    $comment ="";
}

function get_comment_cr($id){
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT 
    cm.id as id,
    cm.comment  as comment ,
    cm.ticket_id as ticket_id ,
    cm.comment_by as comment_by ,
    cm.comment_date  as comment_date ,
    ac.firstname as firstname,
    ac.lastname as lastname
    FROM all_in_one_project.comment as cm
    Left join all_in_one_project.account ac
    on ac.username = cm.comment_by 
    WHERE ticket_type = 'content_request' and ticket_id = ".$id." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
     $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $query_attach = "SELECT * FROM attachment WHERE ticket_type = 'cr_comment' and ticket_id = ".$row['id']." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
        $result_attach = mysqli_query($con, $query_attach);
        while($row_attach = mysqli_fetch_array($result_attach)) {
            $herf = str_replace("../..","../..",$row_attach['file_path'].$row_attach['file_name']);
            if($row_attach['is_image']==1){
                $list_image .= '<a target= "_blank" href="'.$herf.'"><img src="'.$herf.'"  class="img-thumbnail" alt="'.$row_attach['file_name'].'" style="object-fit:cover;width:180px;height:180px;margin: 5px;"></a>';
            }else{
                $list_file .= '<a type="button" href="'.$herf.'" style="margin-right:8px;margin-bottom:5px;font-size: 12px;border-color: #7ec1a2;"class="btn btn-outline-success btn-sm "><ion-icon name="document-outline" style="font-size: 12px;"></ion-icon>'.$row_attach['file_name'].'</a>';
            }
        }
      echo   '
      <li class="list-group-item" style="position: initial;padding-left:0px;border-color: #e9ecef;    border-right-width: 0px;
      border-left-width: 0px;
      border-top-width: 0px;">
      <div class="ms-2 me-auto">
      <div >
      <div>
      <div class="row">
        <div class="col" style="max-width: fit-content;">
            <div style="   
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #222f3e;
            font-size: 20px;
            color: #fff;
            text-align: center;
            line-height: 40px;
            top: 0px;"
            >
            '.substr(ucwords($row['firstname']),0,1).'
            </div>
          </div>
            <div class="col">
                <div class="fw-bold">'.ucwords($row['firstname']).' '.ucwords($row['lastname']).'</div><small style="color:gray">Comment '.$row['comment_date'].'</small>
            </div>
          </div>
      </div>
      <div style="margin-right: 7px;">'.$list_file.'</div>
          <p>'.$row['comment'].'</p>
          <div >'.$list_image.'</div>
      </div>
      </li>';
  unset($list_image);
  unset($list_file);
      }
  }
  get_comment_cr($id);
  mysqli_close($con);
?>