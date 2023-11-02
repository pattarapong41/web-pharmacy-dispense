<?php 

    session_start();

    if(!isset($_SESSION['user_name'])){
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phamarcy</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style.css">
    <style>

          .p1 {font-family: Arial, Helvetica, sans-serif;
               font-size: 20px;}

          .w3-bar-2 {height: 90px;
                     padding: 10px;}    

    </style>
</head>
<body>
   <div class="w3-bar-2">
      <div class="w3-bar-item"><center><img src="images/SUTHLOGO-01.png" width="220"></center></div>
   </div>
   <div class="header">
      <h2>หน้าหลัก</h2>
   </div>
   <div class="content">
        <?php if (isset($_SESSION['success1'])): ?>
            <div class="success">
                <h3>
                  <?php 
                      echo $_SESSION['success1'];
                      unset($_SESSION['success1']);
                  ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_GET['success'])) { ?>
             <p class="success"><?php echo $_GET['success']; 
                                    unset($_GET['success']);?>
             </p>
        <?php } ?>
        <?php if (isset($_SESSION['user_name'])) : ?>
           <P class="p1">ยินดีต้อนรับ : <strong><?php echo $_SESSION['user_name']; ?></strong></P>
           <br>
           <center><p class="p1"><a href="web.php" class="btn btn-success">เข้าสู่ด้านใน</a></p></center>
           <center><p class="p1"><a href="change_pass_form.php" class="btn btn-success">เปลี่ยนรหัสผ่าน</a></p></center>
           <p class="p1"><a href="index.php?logout='1'" style="color: red;">ออกจากระบบ</p>
        <?php endif ?>
   </div>

</body>
</html>