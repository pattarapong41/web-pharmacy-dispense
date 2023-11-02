<?php 
    include('server.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password Page</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <h2 class="h2">Send Reset Password</h2>
    </div>

    <form method= "post" action="password-reset-token.php">
        <?php if (isset($_GET['error'])) { ?>
             <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="input-group">          
           <input type= "email" name= "email" placeholder= "Please add email">
        </div>
        <div class="input-group">
           <center><button type= "submit"  class= "btn">Send</button></center>
        </div>
        
        <br>
        <p class="p1"><a href="login.php">BACK</a></p>
    </form>

</body>
</html>