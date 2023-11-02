<?php 
    include('server.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
    <title>Register Page</title>

    
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h2 class="h2">สมัครสมาชิกAdmin</h2>
    </div>

    <form action="register_db.php" method="post">
    <?php if (isset($_SESSION['success'])): ?>
            <div class="success">
                <h3>
                  <?php 
                      echo $_SESSION['success'];
                      unset($_SESSION['success']);
                  ?>
                </h3>
            </div>
        <?php endif ?>
        <?php include('errors.php'); ?>
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
        <div class="input-group">
           <center><label for="user_id" class="form-label- mt-3">ชื่อผู้ใช้งาน:</label></center>       
           <center><input type="text" name="user_id" placeholder="กรุณากรอกชื่อผู้ใช้" pattern="[a][d][m][i][n][0-9]{3}"></center>
        </div>
        <div class="input-group">
           <center><label for="first_name" class="form-label- mt-3">ชื่อจริง:</label></center>       
           <center><input type="text" name="first_name" placeholder="กรุณากรอกชื่อจริง"></center>
        </div>
        <div class="input-group">
           <center><label for="last_name" class="form-label- mt-3">นามสกุล:</label></center>         
           <center><input type="text" name="last_name" placeholder="กรุณากรอกนามสกุล"></center>
        </div>
        <div class="input-group"> 
           <center><label for="job_ad" class="form-label- mt-3">สถานที่ทำงาน:</label></center>        
           <center><input type="text" name="job_ad" placeholder="กรุณากรอกสถานที่ทำงาน"></center>
        </div>
        <div class="input-group">  
           <center><label for="tel" class="form-label- mt-3">เบอร์โทร:</label></center>    
           <center><input type="text" name="tel" placeholder="กรุณากรอกเบอร์โทร"></center>
        </div>
        <div class="input-group">   
           <center><label for="email" class="form-label- mt-3">อีเมลล์:</label></center>    
           <center><input type="email" name="email" placeholder="กรุณากรอกอีเมลล์"></center>
        </div>
        <div class="input-group">   
           <center><label for="password" class="form-label- mt-3">รหัสผ่าน:</label></center>    
           <center><input type="password" name="password" placeholder="กรุณากรอกรหัสผ่าน"></center>
        </div>
        <div class="input-group">  
           <center><label for="id_num" class="form-label- mt-3">เลขบัตรประชาชน:</label></center>     
           <center><input type="text" name="id_num" placeholder="กรุณากรอกเลขบัตรประชาชน" pattern="[0-9]{13}"></center>
        </div>
        <div class="input-group">
           <button type="submit" name="signup_admin" class="btn">สมัครสมาชิก</button>
        </div>
        <p class="p1">เป็นสมาชิกแล้วใช่หรือไม่? <a href="login.php">เข้าสู่ระบบ</a></p>
        <br>
        <hr>
        <br>
        <p class="p1">สมัครสมาชิกสำหรับผู้ใช้ทั่วไป<a href="register.php">คลิกที่นี่</a></p>
    </form>

</body>
</html>