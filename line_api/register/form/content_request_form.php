<?php

//Detect special conditions devices
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

//do something with this information
if( $iPod || $iPhone ){
    $input_file = '<input type="file" accept="image/*">';
}else if($iPad){
    
    $input_file = '<input type="file" accept="image/*">';
}else if($Android){
    $input_file = '<input type="file" id="file-input" name="image"  multiple >';
    
}else if($webOS){
    $input_file = '<input type="file" id="file-input" name="image"  multiple >';
    
}
?>

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
    </style>
</head>

<body>
    <div class="container-sm" style="margin-top:5px">
        <p id="userId" style="font-size: 10px;color: #a1a1a1;"></p>
        <hr>
        <!-- form start ---------------- -->
        <h2 style="font-size:28px" for="exampleFormControlTextarea1" class="form-label" >แจ้งข้อมูลของสินค้าและปัญหาที่พบ</h2>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">กรอกรายละเอียดของปัญหา</label>
            <textarea class="form-control" rows="8" placeholder="ใส่รายละเอียดของปัญหาให้ครบถ้วน" id="exampleFormControlTextarea1"></textarea>
        </div>
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">แนบไฟล์ excel (ถ้ามี)</label>
            <input class="form-control" type="file" id="formFile">
        </div> -->
        <div class="mb-3">
        <div class="d-grid gap-1" >
            <label for="file-input_camera">
                    <span class="btn btn-outline-primary" ><ion-icon name="camera-outline"></ion-icon> ถ่ายภาพ </span>
            </label>
            </div>
            <label for="formFile" class="form-label">ถ่ายภาพ หรือ เลือกไฟล์ </label>
            <?php echo $input_file; ?>
          
            
            
        </div>
        <div class="mb-3">
        <div class="form-floating">
            <label for="floatingSelect">Priority</label>
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                <option selected>ปกติ</option>
                <option value="1">ด่วน</option>
                <option value="3">ต้องการดำเนินการเดี่ยวนี้</option>
            </select>
        </div>
        </div>
       
        <div class="mb-3">
        <div class="d-grid gap-1">
            <button class="btn btn-primary" type="button">Send</button>
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