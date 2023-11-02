<?php 

    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'registration_system','4306');

    $errors = array();

    if (isset($_POST['delete'])) {
        if (count($_POST['ids']) > 0) {
           $all = implode(",", $_POST['ids']);
           $sql = mysqli_query($con, "DELETE FROM users_dispense WHERE id in ($all)");
           if ($sql) {
             // echo "<script>alert('Data delete succesful');</script>";
                 // $_SESSION['admin_name'] = $admin_name;
                 header("location: search_dispense.php?success=ลบข้อมูลเรียบร้อย");
                 exit();
           } else {
             // echo "<script>alert('Something went wrong');</script>";
                  array_push($errors, "กรุณาลองใหม่อีกครั้ง");
                  $_SESSION['error'] = "กรุณาลองใหม่อีกครั้ง";
                  header('location: search_dispense.php');
           }
        } else {
               array_push($errors, "ท่านต้องเลือกข้อมูลที่จะลบ");
               $_SESSION['error'] = "ท่านต้องเลือกข้อมูลที่จะลบ";
               header('location: search_dispense.php');
               return($row);
        }
      };


   if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $id_num = $_POST['id_num'];
      $firstn_lastn = $_POST['firstn_lastn'];
      $ph_name = $_POST['ph_name'];
      $num_pills = $_POST['num_pills'];
      $org_name = $_POST['org_name'];
      $ex_date = $_POST['ex_date'];

      $query = "UPDATE users_dispense SET id_num = '$id_num' , firstn_lastn = '$firstn_lastn' , ph_name = '$ph_name' , 
                                          num_pills = '$num_pills' , org_name = '$org_name' , ex_date = '$ex_date' 
                                      WHERE id = '$id' ";

      $query_run = mysqli_query($con,$query);

      if ($query_run) {
           $_SESSION['success1'] = "แก้ไขข้อมูลเรียบร้อย";
           header('location: data_dispense.php');
      } else {
           array_push($errors, "กรุณาลองใหม่อีกครั้ง");
           $_SESSION['error'] = "กรุณาลองใหม่อีกครั้ง";
           header('location: data_dispense.php');
      }
    };
  

?>