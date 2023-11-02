<?php 
    include('server.php');
    session_start();

    $errors = array();

    
        $user_id = $_SESSION['user_name'];

        $sql = "SELECT * FROM users_db WHERE user_id = '$user_id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
    <title>Phamarcy</title>
    <link rel="stylesheet" href="style.css">
    <style>

          .w3-bar-2 {height: 90px;
                     padding: 10px;}    

    </style>
</head>
<body>
<div class="w3-bar-2">
      <div class="w3-bar-item"><center><img src="images/SUTHLOGO-01.png" width="220"></center></div>
   </div>
    <div class="header">
        <h2 class="h2">เปลี่ยนรหัสผ่าน</h2>
    </div>
    <form action="password_de_chg.php" method="post">
    <?php if (isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; 
                                    unset($_GET['error']);?>
             </p>
        <?php } ?>
        <div class="input-group">       
           <center><input type="hidden" name="old_password" value="<?php echo $row["password"]; ?>" readonly></center>
        </div>
        <div class="input-group"> 
           <center><label for="new_password" class="form-label- mt-3">รหัสผ่านใหม่:</label></center>    
           <center><input type="password" name="new_password" placeholder="กรุณากรอกรหัสผ่านใหม่" required></center>
        </div>
        <div class="input-group">
           <center><label for="c_password" class="form-label- mt-3">ยืนยันรหัสผ่าน:</label></center>       
           <center><input type="password" name="c_password" placeholder="กรุณากรอกรหัสผ่านอีกครั้ง" required></center>
        </div>
        <div class="input-group">
           <button type="submit" name="confirm" class="btn">ยืนยัน</button>
        </div>
    </form>

</body>
</html>