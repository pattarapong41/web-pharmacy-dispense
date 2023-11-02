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
    <title>Phamarcy</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h2 class="h2">เปลี่ยนรหัสผ่าน</h2>
    </div>

    <form method= "post" action="change_pass_form.php">
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
           <label for="email" class="form-label- mt-3"><center>กรุณากรอกอีเมลล์</center></label>       
           <input type="email" name="email" placeholder="กรอกอีเมลล์ในนี้">
        </div>
        <div class="input-group">
           <center><button type="submit" name="confirm_e"  class="btn">ยืนยัน</button></center>
        </div>
        
        <br>
        <p class="p1"><a href="login.php">ย้อนกลับ</a></p>
    </form>

</body>
</html>