<?php 

    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'registration_system','4306');

    $errors = array();

    if (isset($_POST['delete'])) {
        if (count($_POST['ids']) > 0) {
           $all = implode(",", $_POST['ids']);
           $sql = mysqli_query($con, "DELETE FROM users_db WHERE id in ($all)");
           if ($sql) {
             // echo "<script>alert('Data delete succesful');</script>";
                 // $_SESSION['admin_name'] = $admin_name;
                  $_SESSION['success1'] = "ลบข้อมูลสำเร็จ";
                  header('location: admin_index.php');
           } else {
             // echo "<script>alert('Something went wrong');</script>";
                  array_push($errors, "กรุณาลองใหม่อีกครั้ง");
                  $_SESSION['error'] = "กรุณาลองใหม่อีกครั้ง";
                  header('location: admin_index.php');
           }
        } else {
               array_push($errors, "ท่านต้องเลือกข้อมูลที่จะลบ");
               $_SESSION['error'] = "ท่านต้องเลือกข้อมูลที่จะลบ";
               header('location: admin_index.php');
        }
    };

    if (isset($_POST['update'])) {
         $id = $_POST['update_id'];
         $user_id = $_POST['user_id'];
         $ph_id = $_POST['ph_id'];
         $first_name = $_POST['first_name'];
         $last_name = $_POST['last_name'];
         $job_ad = $_POST['job_ad'];
         $tel = $_POST['tel'];
         $email = $_POST['email'];
         $id_num = $_POST['id_num'];
         $password = $_POST['password'];
         $urole = $_POST['urole'];

         $query = " UPDATE users_db SET user_id = '$user_id' , ph_id = '$ph_id' , first_name = '$first_name' , 
                                       last_name = '$last_name' , job_ad = '$job_ad' , tel = '$tel' , email = '$email' , 
                                       id_num = '$id_num' , password = '$password' ,urole = '$urole'
                                    WHERE password = '$password' ";

         $query_run = mysqli_query($con,$query);

      if ($query_run) {
           $_SESSION['success1'] = "แก้ไขข้อมูลเรียบร้อย";
           header('location: admin_index.php');
      } else {
           array_push($errors, "กรุณาลองใหม่อีกครั้ง");
           $_SESSION['error'] = "กรุณาลองใหม่อีกครั้ง";
           header('location: admin_index.php');
      }
    };

    if (isset($_POST['select'])) {
         $urole = $_POST['urole'];

         if ($urole == 'user') {
              header('location: admin_index.php');
         } else if ($urole == 'admin') {
              header('location: admin_data_index.php');
         } 
    };


?>