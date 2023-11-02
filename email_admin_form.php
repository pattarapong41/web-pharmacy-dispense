<?php 
 
     session_start();

    // error_reporting(0);

     $errors = array();

     if (isset($_GET['logout'])){
      session_destroy();
      header('location: login.php');
  }
     

     $con = mysqli_connect('localhost', 'root', '', 'registration_system','4306');
     if ($con) {
      //echo "Connect succses";
     } else {
      echo "Failed to connect" . mysqli_connect_error();
     }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
    <title>Data Dispense</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
          crossorigin="anonymous">
    <script defer src="JS/script_admin.js"></script>    
    <style>
        body {background: #fffbf2;}

        p {font-family: Arial, Helvetica, sans-serif;
           font-size: 20px;
           padding: 10px;}

        h5 {font-family: Arial, Helvetica, sans-serif;
            font-size: 25px;}

        h6 {font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;}

        .w3-bar {height: 66px;}

        .container {padding: 20px;
                    height: 30px;}

        .input-group input {text-align: center;}           

        .success {color: #32714a;
                  background: #dff9d8;
                  border: 1px solid #32714a;
                  margin-bottom: 20px;
                  text-align: center;}

        .error {width: 42%;
                margin: 0px auto;
                padding: 20px;
                border: 1px solid #a81818;
                color: #a81818;
                background: #fef3f3;
                border-radius: 5px;
                text-align: center;} 
                
        .activeLink {background-color: #FFFFFF; color: #fef3f3;}      

    </style>
</head>
<body>
  <div class="w3-bar w3-black">
    <div class="w3-bar-item">
      <P>ยินดีต้อนรับ : <strong><?php echo $_SESSION['admin_name']; ?></strong></P>
    </div>
    <div class="w3-bar-item home w3-hover-gray">
      <p><a href="admin_index.php" style="color: green;">ข้อมูลผู้ใช้</a></p>
    </div>
    <div class="w3-bar-item dispense w3-hover-gray">
      <p><a href="search_dispense.php" style="color: blue;">ข้อมูลประวัติการจ่ายยา</a></p>
    </div>
    <div class="w3-bar-item mydata w3-hover-gray">
      <p><a href="email_admin_form.php" style="color: yellow;">ข้อมูลส่วนตัว</a></p>
    </div>
    <div class="w3-bar-item">
      <p><a href="email_admin_form.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
    </div>
    <div class="w3-bar-item">
    </div>
  </div>
 </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8 mx-auto bg-light rounded p-4">
                <h5 class="text-center font-weight-bold">ข้อมูลส่วนตัว</h5>
                <hr class="my-1">
                <?php if (isset($_GET['error'])) { ?>
                  <p class="error">
                     <?php echo $_GET['error']; 
                           unset($_GET['error']);?>
                  </p>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                  <p class="success">
                     <?php echo $_GET['success']; 
                           unset($_GET['success']);?>
                  </p>
                <?php } ?>
                <br>
                <h6 class="text-center text-secondary">โปรดกรอกอีเมลล์ในนี้</h5>
                <form action="data_admin.php" method="POST" class="p-3">
                    <div class="input-group">
                       <input type="email" name="email" class="form-control form-control-lg border-info rounded-0" 
                              placeholder="กรุณากรอกอีเมลล์">  
                        <div class="input-group-append">
                            <input type="submit" name="confirm_e" value="ยืนยัน" class="btn btn-info btn-lg rounded-0">
                        </div>
                    </div>              
                </form>
            </div>
        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>