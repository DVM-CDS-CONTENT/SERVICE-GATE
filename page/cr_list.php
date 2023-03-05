<!doctype html>

    </form>
    <div class="btn-group btn-group-sm" style="position: inherit;" role="group"
        aria-label="Basic checkbox toggle button group">
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills pe-3 bg-white shadow-sm border-end " style="height: 100%;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php
                function get_attribute_list_filter($table){
                    $current_value = "";
                    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
                    $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute
                    WHERE table_name = '".$table."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
                    $result_op = mysqli_query($con, $query_op);
                    $i=0;
                    while($option = mysqli_fetch_array($result_op)) {
                        if($option["default_filter_grid"]==1){
                        $selected = 'selected';
                        }else{
                        $selected = '';
                        }
                        if($option["attribute_code"]<>"" and $i==0){
                        $i++;
                        $option_element .= "<option ".$selected ." style='color: #ffffff;' value=''></option>";
                        }
                        $option_element .= "<option ".$selected ." style='color: #ffffff;' value='".$option["attribute_code"]."'>".$option["attribute_label"]."</option>";
                    }
                    $input = '
                        <select multiple  id="list_of_filter" class="border-0 shadow-sm bg-dark" onchange="get_filter_attribute()">
                        '.$option_element.'
                        </select>
                    <script>
                    new SlimSelect({
                    select: "#list_of_filter",
                    settings: {
                        maxValuesShown: 1,
                        maxValuesMessage: "{number} filter selected",
                        paceholderText: "Add more filter",
                        maxSelected: 10,
                        allowDeselect: true
                    }
                    })
                    </script>
                    ';
                    return $input;
                }
                ?>

                <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ps-4 pe-5 pt-1 border-bottom pb-0 mb-2 "
                style="border-bottom: 1px #e1dede solid;">
                <div class="row" style="width:100%">
                    <div style="width:auto;place-self: center;">
                    <ion-icon name="file-tray-stacked-outline"></ion-icon><strong>Bucket</strong>
                    </div>
                </div>
                </nav>
                    <?php

                                $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                                mysqli_query($con, "SET NAMES 'utf8' ");
                                $query = "SELECT pb.id, pb.project_name, pb.prefix , pb.color_project , count(cr.id) as count_backlog FROM all_in_one_project.project_bucket as pb
                                left join all_in_one_project.content_request cr
                                on cr.ticket_template = pb.prefix AND
                                cr.status not in ('archive','cancel','close')
                                where pb.status = 'Open'
                                group by pb.id, pb.project_name, pb.prefix , pb.color_project;" or die("Error:" . mysqli_error($con));
                                $result = mysqli_query($con, $query);
                                $bucket  = '<button class="nav-link border  text-start active" id="v-pills-all-tab" data-bs-toggle="pill" data-bs-target="#v-pills-all" type="button" role="tab" aria-controls="v-pills-all" aria-selected="true">';
                                $bucket  .= '<div class="row"><div style="place-self: center;"class="col-2"><img class="me-2 rounded" src="https://ui-avatars.com/api/?name=ALL>&background=999999&color=fff&rounded=false&size=25">';
                                $bucket  .= '</div><div class="col-10">All Bucket</div></div></button>';
                                while($row = mysqli_fetch_array($result)) {
                                    $bucket  .=
                                    '<button class="nav-link border text-start" onclick="get_list_update_content(&#39;'.$row['prefix'].'&#39;)" id="v-pills-'.$row['prefix'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$row['prefix'].'" type="button" role="tab" aria-controls="v-pills-'.$row['prefix'].'" aria-selected="true">';
                                    $bucket  .= '
                                            <div class="row">
                                                <div style="place-self: center;" class="col-2">
                                                    <img class="me-2 rounded" src="https://ui-avatars.com/api/?name='.$row['prefix'].'>&background='.str_replace("#","",$row['color_project']).'&color=fff&rounded=false&size=25">
                                                </div>
                                                <div class="col-10">';
                                                        $bucket .= $row['project_name'].'
                                                        <span class="badge rounded-pill bg-secondary">'.$row["count_backlog"].'</span>
                                                </div>
                                            </div>
                                    </button>';
                                }
                                mysqli_close($con);
                                echo $bucket;
                            ?>
            </div>
            <div class="tab-content" id="v-pills-tabContent" style="width: 100%;">

                <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ps-4 pe-5"
                    style="border-bottom: 1px #e1dede solid;">
                    <div class="row" style="width:100%">
                        <div style="width:auto;place-self: center;">
                            <ion-icon name="filter-outline"></ion-icon><strong>Dynamic Filter</strong>
                        </div>
                        <div style="width:auto">
                            <?php echo get_attribute_list_filter('content_request'); ?>
                        </div>
                        <div style="width:auto">
                            <button class="btn btn-dark btn-sm " style="margin-left:10px;position: initial!important;"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#content_request_canvas"
                                aria-controls="offcanvasExample">
                                <ion-icon size="small" name="add-outline" role="img" class="md icon-small hydrated"
                                    aria-label="add outline">
                                </ion-icon>
                                New Ticket
                            </button>
                        </div>
                        <div style="width:auto">
                        <ul class="nav nav-pills mb-3 row p-0 me-3" id="pills-tab"
                            style="right: 0;position: absolute;padding: 10px 40px;" role="tablist">
                            <li class="nav-item col p-0" role="presentation">
                                <button class="nav-link ts-view active m-0" id="pills-list_view_ts-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-list_view_ts" type="button" role="tab" aria-controls="pills-list_view_ts"
                                    aria-selected="true">
                                    <ion-icon name="reorder-four-outline" style="margin:0px"></ion-icon>
                                </button>
                            </li>
                            <li class="nav-item col p-0" role="presentation">
                                <button class="nav-link ts-view m-0" id="pills-board_view_ts-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-board_view_ts" type="button" role="tab" aria-controls="pills-board_view_ts"
                                    aria-selected="false">
                                    <ion-icon name="grid-outline" style="margin:0px"></ion-icon>
                                </button>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
                <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ps-4 pe-5">
                    <div class="row g-3 align-items-center" id="dynamic_filter" style="width: 100%;">

                    </div>

                </nav>

                <?php
                    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                    mysqli_query($con, "SET NAMES 'utf8' ");
                    $query = "SELECT id, project_name, prefix , color_project FROM all_in_one_project.project_bucket;" or die("Error:" . mysqli_error($con));
                    $result = mysqli_query($con, $query);
                    echo '<div class="tab-pane fade show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab" tabindex="0">';
                    echo '<div id="bucket_all" class="m-3">';
                    echo include("../get/get_list_update_content.php");
                    echo '</div>';
                    echo'</div>';
                    while($row = mysqli_fetch_array($result)) {
                        echo'<div class="tab-pane fade" id="v-pills-'.$row['prefix'].'" role="tabpanel" aria-labelledby="v-pills-'.$row['prefix'].'-tab" tabindex="0">';
                        echo '<div id="bucket_'.$row['prefix'].'" class="m-3"></div>';
                        echo '</div>';
                    }
                    mysqli_close($con);
                ?>
            </div>
        </div>
    </div>

<script>

function get_list_update_content(bucket) {
    $.post("base/get/get_list_update_content.php", {
        bucket: bucket
    }, function(data) {
        $('#bucket_' + bucket).html(data);
    });
}

function get_filter_attribute() {
    var selected = [];
    for (var option of document.getElementById('list_of_filter').options) {
        if (option.selected) {
            selected.push("'" + option.value + "'");
        }
    }
    var dynamic_filter = selected.toString();
    var table_name = 'content_request';
    console.log(dynamic_filter);
    // dynamic_filter = "'"+value+"'";
    $.post("../base/get/get_dynamic_filter.php", {
        dynamic_filter: dynamic_filter,
        table_name: table_name
    }, function(data) {
        $('#dynamic_filter').html(data);
    });
}
get_filter_attribute();

</script>
<script>
tinymce.init({
    selector: 'textarea#cr_description',
    plugins: 'print preview paste importcss searchreplace table autolink autosave save directionality lists code visualblocks visualchars fullscreen link template codesample charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist  wordcount textpattern noneditable help charmap  emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'bold italic underline strikethrough | forecolor backcolor removeformat | table code | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | pagebreak | charmap emoticons | fullscreen  preview  print | link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 500,
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link bold italic | quicklink h2 h3 blockquote ',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>
<script type="text/javascript">
tinymce.init({
    selector: '#des_cr_inline',
    inline: true
});
</script>
<script>
tinymce.init({
    selector: 'textarea#ms_description',
    height: 380,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    //content_style: 'body { font-family: Prompt, sans-serif; font-size:14px }'
});
</script>
<script>
// run_ts_command('task');
</script>
<script>
function load_tiny_comment() {
    tinymce.init({
        selector: "textarea#comment_input_cr",
        plugins: "autoresize link lists emoticons",
        toolbar: "bold italic underline strikethrough  forecolor  numlist bullist  link blockquote emoticons",
        menubar: false,
        statusbar: false,
        width: "100%",
        toolbar_location: "bottom",
        autoresize_bottom_margin: 0,
        contextmenu: false,
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px; } ',
        setup: (ed) => {
            editor = ed;
        },
    });
}



function cr_id_toggle(id) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("base/page/cr_detail.php", {
            id: id
        }, function(data) {
            // $('#calloffcanvas_cr').html(data);
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    }
}

</script>
<style>
.tox.tox-tinymce.tox-tinymce--toolbar-bottom {
    border-radius: 7px;
    margin-top: 8px;
}

.tox-tinymce:not(.tox-tinymce-inline) .tox-editor-header:not(:first-child) .tox-toolbar-overlord:first-child .tox-toolbar__primary,
.tox-tinymce:not(.tox-tinymce-inline) .tox-editor-header:not(:first-child) .tox-toolbar:first-child {
    border-top: 1px solid #fff;
}

.tox .tox-tbtn svg {
    display: block;
    fill: #6c757d !important;
}
</style>
<script>
baguetteBox.run('.baguetteBoxFour', {
    buttons: false
});
</script>
<script>
timeago().render(document.querySelectorAll('.timeago'));
</script>