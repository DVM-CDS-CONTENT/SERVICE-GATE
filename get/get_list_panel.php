<?php
session_start();
$ac_role = $_POST['ac_role'];
$ac_username = $_POST['ac_username'];
$ac_nickname = $_POST['ac_nickname'];
function get_panel_card($database,$table,$primary_key_id,$id,$title,$prefix,$end_key,$status_key){
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    $query = "SELECT * FROM ".$database.".".$table." where ".$primary_key_id." = '".$id."' and ".$end_key." is not null
    order by id ASC limit 10" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        
         ?>
            <div class="" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="" style="list-style: none"><strong><?php echo $prefix.$row[$title];?><strong></li>
                    <li class="" style="list-style: none"><?php echo $row['brand']." ".$row['sku'];?></li>
                    <li class=""style="list-style: none" ><span><?php echo $row[$status_key];?></span></li>
                </ul>
            </div>
            <?php
    }
}
if($ac_role=='follow'){
    get_panel_card('all_in_one_project','add_new_job','follow_up_by',$ac_username ,'id','NS-','accepted_date','status');
}elseif($ac_role=='writer'){
    get_panel_card('u749625779_cdscontent','job_cms','content_assign_name',$ac_nickname,'job_number','','content_complete_date','job_status_filter');
}elseif($ac_role=='shooter'){
    get_panel_card('u749625779_cdscontent','job_cms','shoot_assign_name',$ac_nickname,'job_number','','shoot_complete_date','job_status_filter');
}elseif($ac_role=='retoucher'){
    get_panel_card('u749625779_cdscontent','job_cms','retouch_assign_name',$ac_nickname,'job_number','','retouch_complete_date','job_status_filter');
}elseif($ac_role=='product_executive'){
    get_panel_card('all_in_one_project','add_new_job','follow_up_by',$ac_username ,'id','NS-','accepted_date','status');
}

?>