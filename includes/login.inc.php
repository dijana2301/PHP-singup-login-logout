<?php

if(isset($_POST['login-submit'])){

    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if(empty($mailuid) || empty($password)){
        header("Location: http://localhost:8080/loginPHP/index.php?error=emptyfields");
        exit();
    }
    else {
         $sql = "SELECT * FROM users WHERE uid=? OR email=?;";
         $stmt = mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: http://localhost:8080/loginPHP/index.php?error=sqlerror");
            exit();
         }
         else{

            mysqli_stmt_bind_param($stmt,"ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwd']);
                if( $pwdCheck == false){
                    header("Location: http://localhost:8080/loginPHP/index.php?error=wrongpwd");
                    exit();
                }
                else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userID'] = $row['id'];
                    $_SESSION['userUID'] = $row['uid'];

                    header("Location: http://localhost:8080/loginPHP/index.php?login=succes");
                    exit();
                } else {
                    header("Location: http://localhost:8080/loginPHP/index.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: http://localhost:8080/loginPHP/index.php?error=nouser");
                exit();
            }
         }
    }
}
else{
    header("Location: http://localhost:8080/loginPHP/index.php?errror");
        exit();
}