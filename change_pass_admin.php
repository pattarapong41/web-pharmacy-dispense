<?php 
    include('server.php');
    session_start();

    $errors = array();

    
        $user_id = $_SESSION['admin_name'];

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
    <style>

        *{margin: 0;
          padding: 0;}

        body {font-size: 110%;
              background: #fffbf2;}

        .header {
            width: 30%;
            margin: 50px auto 0;
            color: white;
            background: #00BFFF;
            text-align: center;
            border: 1px solid #bab6b6;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;}

        form, .content {
            width: 30%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #bab6b6;
            background: white;
            border-radius: 0px 0px 10px 10px;}

        .input-group {margin: 10px 0px 10px 0px;}

        .input-group label {display: block;text-align: left;margin: 3px;}

        .input-group input {
            height: 30px;
            width: 93%;
            padding: 5px 10px;
            font-size: 15px;
            border: 1px solid #808080 ;
            border-radius: 5px;
            text-align: center; }

        .input-group select {
            height: 30px;
            width: 93%;
            padding: 5px 10px;
            font-size: 15px;
            border: 1px solid #808080 ;
            border-radius: 5px;
            text-align: center;}

        .container {
            padding: 20px;
            height: 30px;}

        .btn  {
            padding: 10px;
            font-size: 15px;
            height: 40px;
            width: 43%;
            padding: 5px 10px;
            color: black;
            background: #FFD700;
            border: none;
            border-radius: 5px;
            align-items: center;}

        .btn_gnr {
            padding: 10px;
            font-size: 15px;
            height: 30px;
            width: 33%;
            padding: 5px 10px;
            color: white;
            background: #4bc4a3;
            border: none;
            border-radius: 5px;
            align-items: center; }

        .error {
            width: 92%;
            margin: 0px auto;
            padding: 10px;
            border: 1px solid #a81818;
            color: #a81818;
            background: #fef3f3;
            border-radius: 5px;
            text-align: center;}

        .success {
            color: #32714a;
            background: #dff9d8;
            border: 1px solid #32714a;
            margin-bottom: 20px;
            text-align: center;}

        .p1 {font-family: Arial, Helvetica, sans-serif;}

        .h2 {font-family: Arial, Helvetica, sans-serif;} 

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
           <button type="submit" name="confirm_admin" class="btn">ยืนยัน</button>
        </div>
    </form>

</body>
</html>