<?php 
 
     session_start();

    // error_reporting(0);

     $errors = array();

     if (isset($_GET['logout'])){
          session_destroy();
          header('location: login.php');
     };
     

     $con = mysqli_connect('localhost', 'root', '', 'registration_system','4306');
     if ($con) {
      //echo "Connect succses";
     } else {
      echo "Failed to connect" . mysqli_connect_error();
     }

     if (isset($_GET['select'])) {
          $urole = $_GET['urole'];

          if ($urole == 'user') {
            header('location: admin_index.php');
          } else if($urole == 'admin') {
            header('location: admin_data_index.php');
          }
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

      .w3-bar {height: 70px;}
      
      .p1 {font-family: Arial, Helvetica, sans-serif;
           font-size: 30px;}

      .modal-title {font-family: Arial, Helvetica, sans-serif;
           font-size: 30px;}

      .activeLink {background-color: #FFFFFF; color: #fef3f3;}     

   </style>
</head>

<body>
<div class="w3-bar w3-black">
 <div class="w3-bar-item">
  <P>ยินดีต้อนรับ : <strong><?php echo $_SESSION['admin_name']; ?></strong></P>
 </div>
 <div class="w3-bar-item home w3-hover-gray">
   <p><a href="admin_index.php" style="color: green;">ข้อมูลผู้ใช้</a></p>
 </div>
 <div class="w3-bar-item dispense w3-hover-gray">
   <p><a href="search_dispense.php" style="color: blue;">ข้อมูลประวัติการจ่ายยา</a></p>
 </div>
 <div class="w3-bar-item mydata w3-hover-gray">
   <p><a href="email_admin_form.php" style="color: yellow;">ข้อมูลส่วนตัว</a></p>
 </div>
 <div class="w3-bar-item">
   <p><a href="admin_index.php?logout='1'" style="color: red;">ออกจากระบบ</a></p>
 </div>
  <div class="w3-bar-item"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <form action="admin_de_data.php" method="POST">
          <div class="modal-body">

              <input type="hidden" name="update_id" id="update_id" class="form-control">

              <label for="user_id" class="form-label- mt-3">ชื่อผู้ใช้:</label>
              <input type="text" name="user_id" id="user_id" class="form-control" placeholder="กรุณากรอกชื่อผู้ใช้">

              <label for="ph_id" class="form-label- mt-3">เลขใบประกอบ:</label>
              <input type="text" name="ph_id" id="ph_id" class="form-control" placeholder="กรุณากรอกเลขใบประกอบ">

              <label for="first_name" class="form-label- mt-3">ชื่อจริง:</label>
              <input type="text" name="first_name" id="first_name" class="form-control" placeholder="กรุณากรอกชื่อจริง">

              <label for="last_name" class="form-label- mt-3">นามสกุล:</label>
              <input type="text" name="last_name" id="last_name" class="form-control" placeholder="กรุณากรอกนามสกุล">

              <label for="job_ad" class="form-label- mt-3">สถานที่ทำงาน:</label>
              <input type="text" name="job_ad" id="job_ad" class="form-control" placeholder="กรุณากรอกสถานที่ทำงาน">

              <label for="tel" class="form-label- mt-3">เบอร์โทร:</label>
              <input type="text" name="tel" id="tel" class="form-control" placeholder="กรุณากรอกเบอร์โทร">

              <label for="email" class="form-label- mt-3">อีเมลล์:</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="กรุณากรอกอีเมลล์">

              <label for="id_num" class="form-label- mt-3">เลขบัตรประชาชน:</label>
              <input type="text" name="id_num" id="id_num" class="form-control" placeholder="กรุณากรอกเลขบัตรประชาชน">

              <label for="password" class="form-label- mt-3">รหัสผ่าน:</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="กรุณากรอกรหัสผ่าน">

              <label for="urole" class="form-label- mt-3">สถานะผู้ใช้งาน:</label>
              <select class="form-select" name="urole" aria-label="Default select example">
                       <option value="user">user</option>
                       <option value="admin">admin</option>
              </select>       
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
              <button type="submit" name="update" class="btn btn-primary">บันทึก</button>
          </div>
      </form>
      </div>
  </div>
  </div>
   
  <div class="container">
    <p class="p1">ข้อมูลผู้ใช้ทั้งหมด</p>
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
     <div class="container">
      
         <center>
   <table class="table table-striped">
      <form action="admin_de_data.php" method="post">
            <tr>
               <td colspan="12">
                  <button class="btn btn-danger" name="delete">ลบข้อมูล</button>    
               </td>
            </tr>
            <tr>
               <td>
                  <input type="checkbox" class="form-check-input" id="select_all">
                  <label class="form-check-label">เลือกทั้งหมด</label>
               </td>
               <td><center><b>User ID</b></center></td>
               <td><center><b>License number</b></center></td>
               <td><center><b>Firstname</b></center></td>
               <td><center><b>Lastname</b></center></td>
               <td><center><b>Job Address</b></center></td>
               <td><center><b>Tel number</b></center></td>
               <td><center><b>Email</b></center></td>
               <td><center><b>ID Card</b></center></td>
               <td><center><b>Password</b></center></td>
               <td><center><b>Urole</b></center></td>
            </tr>
            <tr>

                 <?php 
                 
                     $query = mysqli_query($con, "SELECT * FROM users_db ORDER BY ph_id");
                     $totalcnt = mysqli_num_rows($query);
                     if ($totalcnt > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                           if ($row['urole'] == 'admin') {
                     
                  ?>

                  <tr>
                     <td><center><input type="checkbox" class="checkbox" name="ids[]" 
                     value=<?php echo $row['id']?>></center></td>
                     <td><center><?php echo $row['user_id']?></center></td>
                     <td><center><?php echo $row['ph_id']?></center></td>
                     <td><center><?php echo $row['first_name']?></center></td>
                     <td><center><?php echo $row['last_name']?></center></td>
                     <td><center><?php echo $row['job_ad']?></center></td>
                     <td><center><?php echo $row['tel']?></center></td>
                     <td><center><?php echo $row['email']?></center></td>
                     <td><center><?php echo $row['id_num']?></center></td>
                     <td><center><?php echo $row['password']?></center></td>
                     <td><center><?php echo $row['urole']?></center></td>
                     <td><center><button type="button" class="btn btn-warning editbtn">แก้ไขข้อมูล</button></td>
                  </tr>
                 
               <?php       
                    }     
                        } } else {

                                    
               ?>
                  <tr>
                     <td colspan="11">ไม่มีข้อมูลอยู่ในนี้</td>
                  </tr>

               <?php      } ?>

            </tr>
      </form>
         <form method="GET">
            <tr>
               <td colspan="12">
                  <select class="form-select" name="urole" aria-label="Default select example">
                     <option value="user">user</option>
                     <option value="admin">admin</option>
                  </select>
                    <button class="btn btn-primary" name="select">เลือก</button>
               </td>
            </tr>
         </form>
   </table>
         </center>
      

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

$(document).ready(function() {
   $('#select_all').on('click', function() {
      if (this.checked) {
         $('.checkbox').each(function() {
            this.checked = true;
         })
      } else {
         $('.checkbox').each(function() {
            this.checked = false;
         })
      }
   })

    $('.checkbox').on('click', function() {
      if ($('.checkbox:checked').length == $('.checkbox').length) {
         $('#select_all').prop('checked', true);
      } else {
         $('#select_all').prop('checked', false);
      }
    })
});

$(document).ready(function(){
   $('.editbtn').on('click', function() {

      $('#editUserModal').modal('show');

           $tr = $(this).closest('tr');

           var data = $tr.children("td").map(function() {
               return $(this).text();
           }).get();

           console.log(data);

           $('#update_id').val(data[0]);
           $('#user_id').val(data[1]);
           $('#ph_id').val(data[2]);
           $('#first_name').val(data[3]);
           $('#last_name').val(data[4]);
           $('#job_ad').val(data[5]);
           $('#tel').val(data[6]);
           $('#email').val(data[7]);
           $('#id_num').val(data[8]);
           $('#password').val(data[9]);
           $('#urole').val(data[10]);
   });

});

</script>
</body>
</html>

