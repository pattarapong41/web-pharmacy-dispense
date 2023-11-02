<?php 
    include('server.php');
    session_start();

    //$errors = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
    <title>Login Page</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h2 class="h2">กรุณาเข้าสู่ระบบ</h2>
    </div>
    <form action="login_db.php" method="post">
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
           <input type="text" name="user_id" placeholder="กรุณากรอกชื่อผู้ใช้" required>
        </div>
        <div class="input-group">          
           <input type="password" name="password" placeholder="กรุณากรอกรหัสผ่าน" required>
        </div>
        <div class="input-group">
           <center><button type="submit" name="login" class="btn">เข้าสู่ระบบ</button></center>
        </div>
        <br>
        <hr>
        <br>
        <p class="p1">ท่านยังไม่ได้เป็นสมาชิกใช่หรือไม่? <a href="register.php">สมัครสมาชิก</a></p>
    </form>

</body>
</html>