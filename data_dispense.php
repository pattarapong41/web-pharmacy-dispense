<?php 
 
     session_start();

     error_reporting(0);

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


     if (isset($_POST['search'])) {
       $id_num_se = mysqli_real_escape_string($con, $_POST['id_num_se']);


         if (count($errors) == 0) {
            $query = "SELECT * FROM users_dispense WHERE id_num = '$id_num_se' ";

            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                 $_SESSION['id_num_se'] = $id_num_se;
            } else {
                header("location: search_dispense.php?error=ไม่พบข้อมูล");
                exit();
            }
         }
         
           // $sql = " SELECT * FROM users_db WHERE id_num = '$id_num_se' ";
           // $result = mysqli_query($con,$sql);

        // if (mysqli_num_rows($result) > 0) {
           //   $row = mysqli_fetch_array($result);
              //$_SESSION['email'] = $row['email'];
        // } else {
            //  header("location: data_dispense.php?error=กรุณาลองใหม่อีกครั้ง");
            //  exit();
        // }
     };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
   <title>Data Dispense</title>
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
   integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
   crossorigin="anonymous">
   <script defer src="JS/script_admin.js"></script>
   <style>

      body {background: #fffbf2;}

      p {font-family: Arial, Helvetica, sans-serif;
         font-size: 20px;
         padding: 10px;}

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

      .w3-bar {height: 66px;}
      
      .p1 {font-family: Arial, Helvetica, sans-serif;
           font-size: 40px;}

      .modal-title {font-family: Arial, Helvetica, sans-serif;
           font-size: 30px;}

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

  <div class="container">
    <p class="p1">ข้อมูลประวัติการจ่ายยาทั้งหมด</p>
  </div>
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
        <?php if (isset($_GET['success'])) { ?>
                  <p class="success">
                     <?php echo $_GET['success']; 
                           unset($_GET['success']);?>
                  </p>
                <?php } ?>
        <?php if (isset($_GET['error'])) { ?>
                  <p class="error">
                     <?php echo $_GET['error']; 
                           unset($_GET['error']);?>
                  </p>
                <?php } ?>
     <div class="container">
      <form action="dispen_de_data.php" method="post">
         <table class="table table-striped">
            <tr>
               <td colspan="9">
               </td>
            </tr>
            <tr>
               <td><center><b>ID</b>                 </center></td>
               <td><center><b>ID Card</b>            </center></td>
               <td><center><b>Firstname-Lastname</b> </center></td>
               <td><center><b>Pharmacy name</b>      </center></td>
               <td><center><b>Count pills</b>        </center></td>
               <td><center><b>Organize</b>           </center></td>
               <td><center><b>Date</b>               </center></td>
            </tr>
            <tr>

                 <?php 
                     if (isset($_SESSION['id_num_se'])) { 
                         $filtervalues = $_SESSION['id_num_se'];
                         $query = mysqli_query($con, "SELECT * FROM users_dispense WHERE CONCAT(id,id_num,firstn_lastn,ph_name,
                                                                                                num_pills,org_name,ex_date)
                                                               LIKE '%$filtervalues%' ORDER BY ex_date");
                         $totalcnt = mysqli_num_rows($query);
                         if ($totalcnt > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                     
                  ?>

                  <tr>
                     <td><center><?php echo $row['id']?></center></td>
                     <td><center><?php echo $row['id_num']?></center></td>
                     <td><center><?php echo $row['firstn_lastn']?></center></td>
                     <td><center><?php echo $row['ph_name']?></center></td>
                     <td><center><?php echo $row['num_pills']?></center></td>
                     <td><center><?php echo $row['org_name']?></center></td>
                     <td><center><?php echo $row['ex_date']?></center></td>
                  </tr>
                 
               <?php               
                        }

                     } else {

                                    
               ?>
                  <tr>
                     <td colspan="8">ไม่มีข้อมูลอยู่ในนี้</td>
                  </tr>

               <?php 
                    }

                  }
                ?>

            </tr>

         </table>
      </form>
     </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" 
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" 
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script>

//function returnconfirm() {
 // confirm("Are you sure to delete?");
//}


</script>
</body>
</html>

<?php  

     if ($errmsg || $sucmsg) {
          session_destroy();
     } 

?>