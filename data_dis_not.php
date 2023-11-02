
<?php 

    include('server.php');
    session_start();

    if (isset($_GET['logout'])){
         session_destroy();
         unset($_SESSION['user_name']);
         header('location: login.php');
    }

    $errors = array();

    if (isset($_POST['search_data'])) {
        $id_num_sc = mysqli_real_escape_string($conn, $_POST['id_num_sc']);
        $user_id = $_SESSION['user_name'];
        //if ($id_num_sc != $id_num) {
           // array_push($errors, "เลขที่ใบอนุญาติไม่ถูกต้อง");
           // $_SESSION['error'] = "เลขที่ใบอนุญาติไม่ถูกต้อง";
           // header('location: web.php');
      //  }

        if (empty($id_num_sc)) {
            array_push($errors, "ยังไม่ได้กรอกเลขบัตรประชาชน");
            $_SESSION['error'] = "ยังไม่ได้กรอกเลขบัตรประชาชน";
            header('location: web.php');
        }

        if (count($errors) == 0) {
            $query = "SELECT * FROM users_db WHERE id_num = '$id_num_sc' && user_id = '$user_id' ";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                //$_SESSION['id_num_sc'] = $id_num_sc;
               // $_SESSION['success'] = "Data is already";
                //header('location: web.php');
                
            } else {
               array_push($errors, "เลขบัตรประชาชนไม่ถูกต้อง");
                $_SESSION['error'] = "เลขบัตรประชาชนไม่ถูกต้อง";
                header('location: web.php');
            }
        }

        $select = "SELECT first_name , last_name FROM users_db WHERE id_num = '$id_num_sc'";
        $result2 = mysqli_query($conn,$select);

        if (mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_array($result2);
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
        }
     };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Language" content="th">
    <meta http-equiv="content-Type" content="text/html; charset=window-874">
    <meta http-equiv="content-Type" content="text/html; charset=tis-620">
    <title>Phamarcy</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
   integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
   crossorigin="anonymous">
   <style>

      body {background: #fffbf2;}

      p {font-family: Arial, Helvetica, sans-serif;
         font-size: 30px;
         padding: 10px;}

      .p2 {font-family: Arial, Helvetica, sans-serif;
           font-size: 20px;}
      
      .btn {background: #a81818;
            color: white;}

      .w3-bar {height: 70px;}

      .b2 {font-family: Arial, Helvetica, sans-serif;
           font-size: 30px;}
      

   </style>
</head>
<body>
<div class="w3-bar w3-orange">
  <div class="w3-bar-item"><P class="p2">ยินดีต้อนรับ : <strong><?php echo $_SESSION['user_name']; ?></strong></P></div>
  <div class="w3-bar-item w3-hover-white"><p class="p2"><a href="index.php"style="color: blue;" >หน้าหลัก</a></p></div>
  <div class="w3-bar-item w3-hover-white"><p class="p2"><a href="email_user_form.php"style="color: green;" >ข้อมูลส่วนตัว</a></p></div>
  <div class="w3-bar-item w3-hover-white"><p class="p2"><a href="data_dis_seh.php?logout='1'" style="color: red;">ออกจากระบบ</a></p></div>
</div> 
<div class="container">
    <center><p> ข้อมูลประวัติการจ่ายยา</p></center>
  </div>
<div class="container">
      <form action="export_pdf.php" method="post">
         <table class="table table-striped">
            <tr>
               <td colspan="4"><center><b class="b2"><?php echo $_SESSION['first_name'] . "  " . $_SESSION['last_name'];?></b></center></td>
            </tr>          
            <tr>           
               <td><center><b> Pharmacy name      </b></center></td>
               <td><center><b> Count pills        </b></center></td>
               <td><center><b> Organize           </b></center></td>
               <td><center><b> Date               </b></center></td>
            </tr>
            <tr>                                                                   
               <td colspan="4"><center>ไม่พบข้อมูลในนี้</center></td>
            </tr>
            <tr>
                <?php 

                     if (isset($_POST['id_num_sc'])) {
                        $filtervalues = $_POST['id_num_sc'];
                        $query = "SELECT * FROM users_dispense WHERE CONCAT(id_num,user_id,ph_id,firstn_lastn,
                                                                            ph_name,num_pills,org_name,ex_date)
                                                               LIKE '%$filtervalues%' ORDER BY ex_date";
                        $query_run = mysqli_query($conn,$query);                                       
                        
                        if (mysqli_num_rows($query_run) < 0) {
                            foreach($query_run as $item) {

                ?>
                                  
                <?php
                            }

                        } else {

                ?>                            
                
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
</body>
</html>