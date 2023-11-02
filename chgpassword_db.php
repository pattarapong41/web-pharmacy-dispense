<?php 
    include('server.php');
    session_start();

   // $errors = array();

    if(isset($_POST['chg_password'])) {
        $passwordold = mysqli_real_escape_string($conn, $_POST['passwordold']);
        $passwordnew = mysqli_real_escape_string($conn, $_POST['passwordnew']);
        $password_c = mysqli_real_escape_string($conn, $_POST['password_c']);

        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $passwordold = validate($_POST['passwordold']);
        $passwordnew = validate($_POST['passwordnew']);
        $password_c = validate($_POST['password_c']);

        if (empty($passwordold)) {
            header('location: chgpassword.php?error=Old password is required');
            exit();
        } elseif (empty($passwordnew)) {
            header('location: chgpassword.php?error=New password is required');
            exit();
        } elseif ($passwordnew !== $password_c) {
            header('location: chgpassword.php?error=The confrimation password does not match');
            exit();
        } else {
            $passwordold = md5($passwordold);
            $passwordnew = md5($passwordnew);
            $ph_id = $_SESSION['ph_id'];
            
            $query = "SELECT password FROM users_db WHERE ph_id = '$ph_id' AND password = '$passwordold'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) === 1) {
                $query_2 = "UPDATE users_db SET password = '$passwordnew' 
                                          WHERE ph_id = '$ph_id'";
                mysqli_query($conn, $query_2);

                $_SESSION['success2'] = "Password has changed success";
                header('location: chgpassword.php');
                exit();
            } else {
                //array_push($errors, "Incorrect");
                //$_SESSION['error'] = "Incorrect";
                header('location: chgpassword.php?error=Incorrect');
                exit();
            }
        }

    } else {
	     header('location: login.php');
         exit();
    } 

   
?>

