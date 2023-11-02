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

    
        $user_id = $_SESSION['admin_name'];

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
    <title>Data Dispense</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script defer src="JS/script_admin.js"></script>
    <style>

        .w3-bar {height: 66px;}

        .p2 {font-family: Arial, Helvetica, sans-serif;
             font-size: 20px;
             padding: 8px;}

        p {font-family: Arial, Helvetica, sans-serif;
           font-size: 20px;
           padding: 10px;}     

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
   <p><a href="data_admin.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
 </div>
 <div class="w3-bar-item w3-right">
   <p><a href="change_pass_admin.php?logout='1'" style="color: yellow;">เปลี่ยนรหัสผ่าน</a></p>
 </div>
 </div>
    <div class="header">
        <h2 class="h2">ข้อมูลส่วนตัว</h2>
    </div>

    <form action="data_admin_edit.php" method="post">
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
           <center><label for="first_name" class="form-label- mt-3">ชื่อจริง:</label></center>       
           <center><input type="text" name="first_name" value="<?php echo $row["first_name"];?>"></center>
        </div>
        <div class="input-group">
           <center><label for="last_name" class="form-label- mt-3">นามสกุล:</label></center>         
           <center><input type="text" name="last_name" value="<?php echo $row["last_name"];?>"></center>
        </div>
        <div class="input-group"> 
           <center><label for="job_ad" class="form-label- mt-3">สถานที่ทำงาน:</label></center>        
           <center><input type="text" name="job_ad" value="<?php echo $row["job_ad"];?>"></center>
        </div>
        <div class="input-group">  
           <center><label for="tel" class="form-label- mt-3">เบอร์โทร:</label></center>    
           <center><input type="text" name="tel" value="<?php echo $row["tel"];?>" ></center>
        </div>
        <div class="input-group">   
           <center><label for="email" class="form-label- mt-3">อีเมลล์:</label></center>    
           <center><input type="email" name="email" value="<?php echo $row["email"];?>"></center>
        </div>
        <div class="input-group">  
           <center><label for="id_num" class="form-label- mt-3">เลขบัตรประชาชน:</label></center>     
           <center><input type="text" name="id_num" value="<?php echo $row["id_num"];?>"></center>
        </div>
        <br>
        <div class="input-group">
           <center><button type="submit" name="edit_data" class="btn">แก้ไขข้อมูล</button></center>
        </div>
        <p class="p2"><a href="email_admin_form.php">ย้อนกลับ</a></p>
    </form>

</body>
</html>