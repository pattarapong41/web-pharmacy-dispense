<?php 
    include('server.php');
    session_start();

    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['user_name']);
        header('location: login.php');
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
  };

    
        
        $user_id = $_SESSION['user_name'];

        $sql = " SELECT * FROM users_db WHERE user_id = '$user_id' ";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
    <title>Pharmacy</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
    <script defer src="JS/script_user.js"></script>
    <style>

         .w3-bar {height: 67px;}

         .p2 {font-family: Arial, Helvetica, sans-serif;
              font-size: 21px;
              padding: 10px;}

         .w3-bar-2 {height: 50px;}
         
         .activeLink {background-color: #FFFFFF; color: #fef3f3;}

    </style>
</head>
<body>
  <div class="w3-bar w3-blue">
    <div class="w3-bar-item">
      <P class="p2">ยินดีต้อนรับ : <strong><?php echo $_SESSION['user_name']; ?></strong></P>
   </div>
    <div class="w3-bar-item w3-hover-gray">
      <p class="p2"><a href="index.php"style="color: purple;">หน้าหลัก</a></p>
    </div>
    <div class="w3-bar-item dispense w3-hover-gray">
      <p class="p2"><a href="web.php"style="color: purple;">ประวัติการจ่ายยา</a></p>
    </div>
    <div class="w3-bar-item mydata w3-hover-gray">
      <p class="p2"><a href="data_user.php"style="color: purple;">ข้อมูลส่วนตัว</a></p>
   </div>
    <div class="w3-bar-item w3-right">
      <p class="p2"><a href="data_user.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
   </div>
  </div>
  <div class="w3-bar-2">
    <div class="w3-bar-item"><img src="images/SUTHLOGO-01.png" width="180"></div>
  </div>
    <div class="header">
        <h2 class="h2">ข้อมูลส่วนตัว</h2>
    </div>

    <form action="data_user_edit.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; 
                                    unset($_GET['error']);?>
             </p>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
             <p class="success"><?php echo $_GET['success']; 
                                    unset($_GET['success']);?>
             </p>
        <?php } ?>
        <div class="input-group">       
           <center><input type="hidden" name="id" value="<?php echo $row["id"];?>" readonly></center>
        </div>
        <div class="input-group">
           <center><label for="user_id" class="form-label- mt-3">ชื่อผู้ใช้งาน:</label></center>       
           <center><input type="text" name="user_id" value="<?php echo $row["user_id"];?>" readonly></center>
        </div>
        <div class="input-group"> 
           <center><label for="ph_id" class="form-label- mt-3">เลขใบประกอบ:</label></center>    
           <center><input type="text" name="ph_id" value="<?php echo $row["ph_id"];?>" required></center>
        </div>
        <div class="input-group">
           <center><label for="first_name" class="form-label- mt-3">ชื่อจริง:</label></center>       
           <center><input type="text" name="first_name" value="<?php echo $row["first_name"];?>" required></center>
        </div>
        <div class="input-group">
           <center><label for="last_name" class="form-label- mt-3">นามสกุล:</label></center>         
           <center><input type="text" name="last_name" value="<?php echo $row["last_name"];?>" required></center>
        </div>
        <div class="input-group"> 
           <center><label for="job_ad" class="form-label- mt-3">สถานที่ทำงาน:</label></center>        
           <center><input type="text" name="job_ad" value="<?php echo $row["job_ad"];?>" required></center>
        </div>
        <div class="input-group">  
           <center><label for="tel" class="form-label- mt-3">เบอร์โทร:</label></center>    
           <center><input type="text" name="tel" value="<?php echo $row["tel"];?>" required></center>
        </div>
        <div class="input-group">   
           <center><label for="email" class="form-label- mt-3">อีเมลล์:</label></center>    
           <center><input type="email" name="email" value="<?php echo $row["email"];?>" required></center>
        </div>
        <div class="input-group">  
           <center><label for="id_num" class="form-label- mt-3">เลขบัตรประชาชน:</label></center>     
           <center><input type="text" name="id_num" value="<?php echo $row["id_num"];?>" required></center>
        </div>
        <br>
        <div class="input-group">
           <center><button type="submit" name="edit_data" class="btn">แก้ไขข้อมูล</button></center>
        </div>
        <p class="p2"><a href="email_user_form.php">ย้อนกลับ</a></p>
    </form>

</body>
</html>