<?php 

    include('server.php');
    session_start();

    $errors = array();

    if (isset($_POST['edit_data'])) {
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $ph_id = $_POST['ph_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $job_ad = $_POST['job_ad'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $id_num = $_POST['id_num'];

        $update = "UPDATE users_db SET ph_id = '$ph_id' , first_name = '$first_name' , last_name = '$last_name' , 
                                       job_ad = '$job_ad' , tel = '$tel' , email = '$email' , id_num = '$id_num' 
                                   WHERE id = '$id' ";
                                
        $query_run = mysqli_query($conn,$update);
        
        if ($query_run) {
            header("location: data_user.php?success=แก้ไขข้อมูลสำเร็จ");
            exit();
       } else {
            header("location: data_user.php?error=กรุณาลองใหม่อีกครั้ง");
            exit();
       }
    };

?>