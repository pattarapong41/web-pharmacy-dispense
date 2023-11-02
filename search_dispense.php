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
<div class="w3-bar w3-blue">
 <div class="w3-bar-item">
  <P>ยินดีต้อนรับ : <strong><?php echo $_SESSION['admin_name']; ?></strong></P>
 </div>
 <div class="w3-bar-item home w3-hover-gray">
   <p><a href="admin_index.php" style="color: purple;">ข้อมูลผู้ใช้</a></p>
 </div>
 <div class="w3-bar-item dispense w3-hover-gray">
   <p><a href="search_dispense.php" style="color: purple;">ข้อมูลประวัติการจ่ายยา</a></p>
 </div>
 <div class="w3-bar-item mydata w3-hover-gray">
   <p><a href="data_admin.php" style="color: purple;">ข้อมูลส่วนตัว</a></p>
 </div>
 <div class="w3-bar-item w3-right">
   <p><a href="admin_index.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
 </div>
 <div class="w3-bar-item w3-right">
   <p><a href="change_pass_admin.php?logout='1'" style="color: yellow;">เปลี่ยนรหัสผ่าน</a></p>
 </div>
</div>
        <?php if (isset($_GET['success'])) { ?>
                  <p class="success">
                     <?php echo $_GET['success']; 
                           unset($_GET['success']);?>
                  </p>
                <?php } ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error">
                <h3>
                  <?php 
                      echo $_SESSION['error'];
                      unset($_SESSION['error']);
                  ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_GET['error'])) { ?>
                  <p class="error">
                     <?php echo $_GET['error']; 
                           unset($_GET['error']);?>
                  </p>
                <?php } ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8 mx-auto bg-light rounded p-4">
                <h5 class="text-center font-weight-bold">ค้นหาข้อมูลประวัติการจ่ายยา</h5>
                <hr class="my-1">
                <h5 class="text-center text-secondary">โปรดกรอกเลขบัตรประชาชนในนี้</h5>
                <form action="data_dispense.php" method="POST" class="p-3">
                    <div class="input-group">
                       <input type="text" name="id_num_se" class="form-control form-control-lg border-info rounded-0" 
                              placeholder="กรุณากรอกเลขบัตรประชาชน" required>  
                        <div class="input-group-append">
                            <input type="submit" name="search" value="ค้นหา" class="btn btn-info btn-lg rounded-0">
                        </div>
                    </div>              
                </form>
            </div>
        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>