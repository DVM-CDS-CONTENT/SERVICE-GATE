


<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
    <title>Content Service Gate | Profile</title>
    <style>
    /* #pictureUrl { } */
    body {
        font-family: 'Prompt', sans-serif;
    }

    .form-label {
        margin-bottom: .5rem;
        font-weight: 600;
        font-size: smaller;
    }

    .form-floating>.form-control {
        font-weight: 600;
    }

    .form-floating {
        font-size: small;
        ;
        font-weight: 600;
    }
    /* input[type="file"] {
    display: none;
} */
    </style>
</head>

<body>
    <div class="container-sm" style="margin-top:5px">

        <p id="userId" style="font-size: 10px;color: #a1a1a1;"></p>
        <hr>
        <!-- form start ---------------- -->
        <h2 style="font-size:28px" for="exampleFormControlTextarea1" class="form-label" >แจ้งข้อมูลของสินค้าและปัญหาที่พบ</h2>
        <div class="mb-3">
            <!-- <label for="exampleFormControlTextarea1" class="form-label">กรอกรายละเอียดของปัญหา</label> -->
            <input type="hidden" id="userId_value" placeholder="Type to search...">
            <textarea class="form-control" id="detail_request" name="detail_request" rows="8" placeholder="ใส่รายละเอียดของปัญหาให้ครบถ้วน" ></textarea>
        </div>
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">แนบไฟล์ excel (ถ้ามี)</label>
            <input class="form-control" type="file" id="formFile">
        </div> -->
        <div class="mb-3">
        <div class="d-grid gap-1" >
            <!-- <label for="file-input_camera" style="width:100%"> 
                    <span class="btn btn-outline-primary" style="width:100%" ><ion-icon name="camera-outline"></ion-icon> ถ่ายภาพ หรือ เลือกไฟล์ </span>
            </label> -->


            </div>

            <?php

            //Detect special conditions devices
            $iPod    = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
            $iPhone  = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
            $iPad    = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
            $Android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
            $webOS   = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
            // echo $_SERVER['HTTP_USER_AGENT'];
            //do something with this information
            if( $iPod || $iPhone ){
                $input_file = '<input type="file" id="actual-btn_meq" name="actual-btn_meq[]"  multiple="multiple" hidden >';
               
                
            }else if($iPad){
                
                $input_file = '<input type="file" id="actual-btn_meq" name="actual-btn_meq[]"  multiple hidden>';
            }else if($Android){
                $input_file = '<input type="file" id="actual-btn_meq" name="actual-btn_meq[]"  multiple capture hidden>';
                
            }else if($webOS){
                $input_file = '<input type="file" id="actual-btn_meq" name="actual-btn_meq[]"  multiple capture hidden>';
                
            }else{
                $input_file = '<input type="file" id="actual-btn_meq" name="actual-btn_meq[]"  multiple capture hidden>';
            }
            ?>

            <?php echo $input_file; ?>
            <!-- <input type="file" id="actual-btn_meq" name="actual-btn_meq[]" multiple hidden /> -->
                <label class="btn btn-outline-primary" style="width:100%" id="label_file_meq" name="label_file_meq" for="actual-btn_meq">
                    <ion-icon name="camera-outline"></ion-icon> เพิ่มรูปภาพ หรือไฟล์
                </label>
            <span id="file-chosen_meq"> </span>
            
            
        </div>
        <div class="mb-3">
        <div class="form-floating">
            <label for="priority">Priority</label>
            <select class="form-select" id="priority" aria-label="Floating label select example">
                <option selected>ปกติ</option>
                <option value="1">ด่วน</option>
                <option value="3">ต้องการดำเนินการเดี่ยวนี้</option>
            </select>
        </div>
        </div>
       
        <div class="mb-3">
        <div class="d-grid gap-1">
            <button class="btn btn-primary" id="send" onclick="create_ticket()" type="button">Send</button>
        </div>
        </div>
        
        <!-- form end ---------------- -->
    </div>
    <script src="https://static.line-scdn.net/liff/edge/versions/2.9.0/sdk.js"></script>
    <script>
    function runApp() {
        liff.getProfile().then(profile => {
            // document.getElementById("pictureUrl").src = profile.pictureUrl;
            document.getElementById("userId").innerHTML = '<b>UserId:</b> ' + profile.userId;
            // document.getElementById("displayName").innerHTML = '<b>DisplayName:</b> ' + profile.displayName;
            // document.getElementById("statusMessage").innerHTML = '<b>StatusMessage:</b> ' + profile.statusMessage;
            // document.getElementById("getDecodedIDToken").innerHTML = '<b>Email:</b> ' + liff.getDecodedIDToken().email;
            // document.getElementById("displayName").value = profile.displayName;
            // document.getElementById("displayName_show").innerHTML =  profile.displayName;
            document.getElementById("userId_value").value = profile.userId;
            
        }).catch(err => console.error(err));
    }
    liff.init({
        liffId: "1656539537-AvYwK6yR"
    }, () => {
        if (liff.isLoggedIn()) {
            runApp()
        } else {
            liff.login();
        }
    }, err => console.error(err.code, error.message));
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<script>
var actualBtn_meq = document.getElementById('actual-btn_meq');
var fileChosen_meq = document.getElementById('file-chosen_meq');
var fileChosen_bt_meq = document.getElementById('label_file_meq');
actualBtn_meq.addEventListener('change', function() {
    // fileChosen.textContent = this.files[0].name
    count_file_meq = this.files.length;
    var i_meq;
    var file_name_meq;
    for (i_meq = 0; i_meq < count_file_meq; i_meq++) {
        if (i_meq == 0) {
            file_name_meq = this.files[i_meq].name;
        } else {
            file_name_meq += " , " + this.files[i_meq].name;
        }
    }
    if (file_name_meq == "undefined") {
        fileChosen_bt_meq.textContent = "ถ่ายภาพ หรือ เลือกไฟล์";
    }
    fileChosen_bt_meq.textContent = count_file_meq + " ไฟล์ : " + file_name_meq;
    fileChosen_bt_meq.textContent = count_file_meq + " ไฟล์ : " + file_name_meq;
})

function create_ticket(){

    var form_data = new FormData();
    var detail_request = document.getElementById("detail_request").value;
    var priority = document.getElementById("priority").value;
    var userId = document.getElementById("userId_value").value;
    document.getElementById('detail_request').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var meq = document.getElementById('actual-btn_meq').files.length;
    for (var i = 0; i < meq; i++) {
        form_data.append("files_meq[]", document.getElementById('actual-btn_meq').files[i]);
    }
    // form_data.append("files", files)              // Appending parameter named file with properties of file_field to form_data
    form_data.append("detail_request", detail_request) // Adding extra parameters to form_data
    form_data.append("priority", priority)
    form_data.append("userId", userId)
    
    $.ajax({
        url: "https://content-service-gate.cdsecommercecontent.ga/line_api/register/action/create_cr_ticket.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            // $('#call_ticket_comment').html(data);
            // document.getElementById('comment_box').scrollBy(0, document.getElementById(
            //     "call_ticket_comment").offsetHeight);
            // document.getElementById('actual-btn_cme').value = ''; //clear value
            // fileChosen_bt_cme.innerHTML = '<ion-icon style="margin:0px" name="attach-outline"></ion-icon>';
            alert(data);
        }
    });



}

$(document).ready(function() {
$("#send").click(function() {
// disable button
$(this).prop("disabled", true);
// add spinner to button
$(this).html(
'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...'
);
});
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>