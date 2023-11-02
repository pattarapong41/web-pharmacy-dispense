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
    }
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

         .w3-bar {height: 66px;}

         .p2 {font-family: Arial, Helvetica, sans-serif;
              font-size: 20px;
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
        <p class="p2"><a href="index.php"style="color: lime;" >หน้าหลัก</a></p>
    </div>
    <div class="w3-bar-item dispense w3-hover-gray">
      <p class="p2"><a href="web.php"style="color: purple;">ประวัติการจ่ายยา</a></p>
    </div>
    <div class="w3-bar-item mydata w3-hover-gray">
        <p class="p2"><a href="email_user_form.php"style="color: yellow;" >ข้อมูลส่วนตัว</a></p>
    </div>
    <div class="w3-bar-item">
        <p class="p2"><a href="email_user_form.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
    </div>
 </div>
 <div class="w3-bar-2">
    <div class="w3-bar-item"><img src="images/SUTHLOGO-01.png" width="180"></div>
 </div>
    <div class="header">
        <h2 class="h2">ข้อมูลส่วนตัว</h2>
    </div>

    <form method= "post" action="data_user.php">
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
           <center><input type="email" name="email" placeholder="กรุณากรอกอีเมลล์"></center>
        </div>
        <div class="input-group">
           <center><button type="submit" name="confirm_e"  class="btn">ยืนยัน</button></center>
        </div>
        
        <br>
        <p class="p1"><a href="web.php">ย้อนกลับ</a></p>
    </form>

</body>
</html>