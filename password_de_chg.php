<?php 

    include('server.php');
    session_start();

    $errors = array();

    if (isset($_POST['confirm'])) {
        $user_id = $_SESSION['user_name'];
        $old_password = $_POST['old_password'];
        $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
        $c_password = mysqli_real_escape_string($conn,$_POST['c_password']);

        if ($c_password != $new_password) {
            header("location: change_pass_form.php?error=รหัสผ่านไม่ตรงกัน");
            exit();          
        }

       // $select = mysqli_query($conn);

        //$query = "UPDATE users_db SET password = '$new_password' WHERE email = '$email' ";

        //$query_run = mysqli_query($conn,$query);

        $select = " SELECT * FROM users_db WHERE password = '$new_password' ";

        $result = mysqli_query($conn,$select);

        if (mysqli_num_rows($result) > 0) {
             header("location: change_pass_form.php?error=มีผู้ใช้รหัสผ่านนี้แล้ว");
             exit();
        } else {
            $query = "UPDATE users_db SET password = '$new_password' WHERE user_id = '$user_id' ";
            $query_run = mysqli_query($conn,$query);

            if ($query_run) {
                 header("location: index.php?success=เปลี่ยนรหัสผ่านสำเร็จแล้ว");
                 exit();
            } else {
                 header("location: change_pass_form.php?error=กรุณาลองใหม่อีกครั้ง");
                 exit();
            }
        }
    };
    

    if (isset($_POST['confirm_admin'])) {
        $user_id = $_SESSION['admin_name'];
        $old_password = $_POST['old_password'];
        $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
        $c_password = mysqli_real_escape_string($conn,$_POST['c_password']);

        if ($c_password != $new_password) {
            header("location: change_pass_admin.php?error=รหัสผ่านไม่ตรงกัน");
            exit();          
        }

       // $select = mysqli_query($conn);

        //$query = "UPDATE users_db SET password = '$new_password' WHERE email = '$email' ";

        //$query_run = mysqli_query($conn,$query);

        $select = " SELECT * FROM users_db WHERE password = '$new_password' ";

        $result = mysqli_query($conn,$select);

        if (mysqli_num_rows($result) > 0) {
             header("location: change_pass_admin.php?error=มีผู้ใช้รหัสผ่านนี้แล้ว");
             exit();
        } else {
            $query = "UPDATE users_db SET password = '$new_password' WHERE user_id = '$user_id' ";
            $query_run = mysqli_query($conn,$query);

            if ($query_run) {
                 header("location: admin_index.php?success=เปลี่ยนรหัสผ่านสำเร็จแล้ว");
                 exit();
            } else {
                 header("location: change_pass_admin.php?error=กรุณาลองใหม่อีกครั้ง");
                 exit();
            }
        }
    };

?>

