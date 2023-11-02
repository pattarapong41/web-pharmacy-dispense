<?php 

     include('server.php');
     session_start();

     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;

     //Load Composer's autoloader
     require 'vendor/autoload.php';

    function sendemail_verify($user_id,$email,$pass_rand,$verify_token) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Host       = 'smtp.gmail.com';
        $mail->Username   = 'teerapol.t@g.sut.ac.th';                     //SMTP username
        $mail->Password   = 'vuxqjioxwjiaqogx';                               //SMTP password
        $mail->SMTPSecure = 'tls';                                        //Enable implicit TLS encryption
        $mail->Port       =  587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom('teerapol.t@g.sut.ac.th','e-Medication Reconciliation Account');
        $mail->addAddress($email);

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Verified Rrgister e-Medication Reconciliation System";

        $email_template = "
               <h2> $user_id คุณได้ทำการสมัครสมาชิกเป็นที่เรียบร้อยแล้ว</h2>
               <h2>รหัสผ่านของคุณ: $pass_rand</h2>
               <br/>
               <h2>กรุณา<a href='http://localhost/Phamacy_webapp/login.php?token=$verify_token'>คลิ๊กที่นี่</a>เพื่อเข้าสู่ระบบ</h2> 
        ";

        $mail->Body = $email_template;
        $mail->send();
        //echo 'Message has been sent';
    };
    
//////////////////////////////////////////////////////// User register ////////////////////////////////////////////////////

     $errors = array();

     if (isset($_POST['signup'])) {
        $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
        $ph_id = mysqli_real_escape_string($conn,$_POST['ph_id']);
        $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
        $job_ad = mysqli_real_escape_string($conn,$_POST['job_ad']);
        $tel = mysqli_real_escape_string($conn,$_POST['tel']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $id_num = mysqli_real_escape_string($conn,$_POST['id_num']);
        $password = "123456789abcdefghjklmnpqrtuvwxyABCDEFGHJKLMNPQRSTUVWXYZ"; 
                     srand((double)microtime()*1000000); 
                     for($i=0; $i<7; $i++) { 
                       $pass_rand .= $password[rand()%strlen($password)]; 
                     }              
        $urole = "user";
        $verify_token = md5(rand());

        $select = "SELECT * FROM users_db WHERE user_id = '$user_id' OR ph_id = '$ph_id' OR tel = '$tel' 
                                             OR email = '$email' OR id_num = '$id_num'";

        $result = mysqli_query($conn,$select);

        
            if (empty($user_id)) {
                array_push($errors, "ยังไม่ได้กรอกชื่อผู้ใช้");
                $_SESSION['error'] = "ยังไม่ได้กรอกชื่อผู้ใช้";
                header('location: register.php');
            }  else if (empty($ph_id)) {
                array_push($errors, "ยังไม่ได้กรอกเลขใบประกอบ");
                $_SESSION['error'] = "ยังไม่ได้กรอกเลขใบประกอบ";
                header('location: register.php');
            }  else if (empty($first_name)) {
                array_push($errors, "ยังไม่ได้กรอกชื่อจริง");
                $_SESSION['error'] = "ยังไม่ได้กรอกชื่อจริง";
                header('location: register.php');
            } else if (empty($last_name)) {
                array_push($errors, "ยังไม่ได้กรอกนามสกุล");
                $_SESSION['error'] = "ยังไม่ได้กรอกนามสกุล";
                header('location: register.php');
            } else if (empty($job_ad)) {
                array_push($errors, "ยังไม่ได้กรอกสถานที่ทำงาน");
                $_SESSION['error'] = "ยังไม่ได้กรอกสถานที่ทำงาน";
                header('location: register.php');
            } else if (empty($tel)) {
                array_push($errors, "ยังไม่ได้กรอกเบอร์โทร");
                $_SESSION['error'] = "ยังไม่ได้กรอกเบอร์โทร";
                header('location: register.php');
            } else if (empty($email)) {
                array_push($errors, "ยังไม่ได้กรอกอีเมลล์");
                $_SESSION['error'] = "ยังไม่ได้กรอกอีเมลล์";
                header('location: register.php');
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "รูปแบบอีเมลไม่ถูกต้อง");
                $_SESSION['error'] = "รูปแบบอีเมลไม่ถูกต้อง";
                header('location: register.php');
            } else if (empty($id_num)) {
                array_push($errors, "ยังไม่ได้กรอกเลขบัตรประชาชน");
                $_SESSION['error'] = "ยังไม่ได้กรอกเลขบัตรประชาชน";
                header('location: register.php');
            } else if (mysqli_num_rows($result) > 0) {
                array_push($errors, "มีข้อมูลที่สมัครไว้แล้ว");
                $_SESSION['error'] = "มีข้อมูลที่สมัครไว้แล้ว";
                header('location: register.php');
            } else {
                //$password = md5($pass_rand);
                $insert = "INSERT INTO users_db(user_id,ph_id,first_name,last_name,job_ad,
                                                tel,email,id_num,password,urole,verify_token)

                                       VALUES('$user_id','$ph_id','$first_name','$last_name','$job_ad',
                                              '$tel','$email','$id_num','$pass_rand','$urole','$verify_token')";

                $query_run = mysqli_query($conn,$insert);

                if ($query_run) {
                      sendemail_verify("$user_id","$email","$pass_rand","$verify_token");
                      $_SESSION['success'] = "คุณได้ทำการสมัครสมาชิกเรียบร้อยแล้วกรุณาตรวจสอบอีเมลล์ของคุณ";
                      header('location: register.php');
                } else { 
                    array_push($errors, "สมัครสมาชิกไม่สำเร็จ");
                    $_SESSION['error'] = "สมัครสมาชิกไม่สำเร็จ";
                    header('location: register.php');
                }

                //$_SESSION['success'] = "สมัครสมาชิกสำเร็จแล้ว";
                //header('location: login.php');
            }      
    };

    //////////////////////////////////////////////////////// Admin register ////////////////////////////////////////////////////



    if (isset($_POST['signup_admin'])) {
        $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
        $first_name = mysqli_real_escape_string($conn,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
        $job_ad = mysqli_real_escape_string($conn,$_POST['job_ad']);
        $tel = mysqli_real_escape_string($conn,$_POST['tel']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $id_num = mysqli_real_escape_string($conn,$_POST['id_num']);
        $urole = "admin";

        $select = "SELECT * FROM users_db WHERE user_id = '$user_id' OR tel = '$tel' 
                                             OR email = '$email' OR password = '$password' 
                                             OR id_num = '$id_num'";

        $result = mysqli_query($conn,$select);

        
            if (empty($user_id)) {
                array_push($errors, "ยังไม่ได้กรอกชื่อผู้ใช้");
                $_SESSION['error'] = "ยังไม่ได้กรอกชื่อผู้ใช้";
                header('location: register_admin.php');
            }  else if (empty($first_name)) {
                array_push($errors, "ยังไม่ได้กรอกชื่อจริง");
                $_SESSION['error'] = "ยังไม่ได้กรอกชื่อจริง";
                header('location: register_admin.php');
            } else if (empty($last_name)) {
                array_push($errors, "ยังไม่ได้กรอกนามสกุล");
                $_SESSION['error'] = "ยังไม่ได้กรอกนามสกุล";
                header('location: register_admin.php');
            } else if (empty($job_ad)) {
                array_push($errors, "ยังไม่ได้กรอกสถานที่ทำงาน");
                $_SESSION['error'] = "ยังไม่ได้กรอกสถานที่ทำงาน";
                header('location: register_admin.php');
            } else if (empty($tel)) {
                array_push($errors, "ยังไม่ได้กรอกเบอร์โทร");
                $_SESSION['error'] = "ยังไม่ได้กรอกเบอร์โทร";
                header('location: register_admin.php');
            } else if (empty($email)) {
                array_push($errors, "ยังไม่ได้กรอกอีเมลล์");
                $_SESSION['error'] = "ยังไม่ได้กรอกอีเมลล์";
                header('location: register_admin.php');
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "รูปแบบอีเมลไม่ถูกต้อง");
                $_SESSION['error'] = "รูปแบบอีเมลไม่ถูกต้อง";
                header('location: register_admin.php');
            } else if (empty($password)) {
                array_push($errors, "ยังไม่ได้กรอกรหัสผ่าน");
                $_SESSION['error'] = "ยังไม่ได้กรอกรหัสผ่าน";
                header('location: register_admin.php');
            } else if (empty($id_num)) {
                array_push($errors, "ยังไม่ได้กรอกเลขบัตรประชาชน");
                $_SESSION['error'] = "ยังไม่ได้กรอกเลขบัตรประชาชน";
                header('location: register_admin.php');
            } else if (mysqli_num_rows($result) > 0) {
                array_push($errors, "มีข้อมูลที่สมัครไว้แล้ว");
                $_SESSION['error'] = "มีข้อมูลที่สมัครไว้แล้ว";
                header('location: register_admin.php');
            } else {
                //$password = md5($pass_rand);
                $insert = "INSERT INTO users_db(user_id,first_name,last_name,job_ad,
                                                tel,email,id_num,password,urole)

                                       VALUES('$user_id','$first_name','$last_name','$job_ad',
                                              '$tel','$email','$id_num','$password','$urole')";

                $query_run = mysqli_query($conn,$insert);

                if ($query_run) {
                      //sendemail_verify("$user_id","$email","$verify_token");
                      $_SESSION['success'] = "สมัครสมาชิกสำเร็จแล้ว";
                      header('location: login.php');
                } else { 
                    array_push($errors, "สมัครสมาชิกไม่สำเร็จ");
                    $_SESSION['error'] = "สมัครสมาชิกไม่สำเร็จ";
                    header('location: register_admin.php');
                }

            }
            
        
    };


?>