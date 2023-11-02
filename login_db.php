<?php 

     include('server.php');
     session_start();

     $errors = array();


     if (isset($_POST['login'])) {
        $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
        $password = mysqli_real_escape_string($conn,$_POST['password']); 
        $urole = $_POST['urole'];


        //$password = md5($password);
        $select = "SELECT * FROM users_db WHERE user_id = '$user_id' && password = '$password' ";
        //$select = "SELECT * FROM users_db WHERE user_id = '$user_id' ";

        $result = mysqli_query($conn,$select);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
              if ($row['urole'] == 'admin') {
                $_SESSION['admin_name'] = $row['user_id'];
                header('location: admin_index.php');

            } else if ($row['urole'] == 'user') {
                $_SESSION['user_name'] = $row['user_id'];
                header('location: index.php');
            }
        } else {
            header("location: login.php?error=กรุณาลองใหม่อีกครั้ง");
            exit();      
        }

     };



?>