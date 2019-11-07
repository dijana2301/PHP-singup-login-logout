<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
.center{
    margin: auto;
    width: 50%;
    height: 50%;
    border: 3px solid green;
    padding: 20px;
    text-align:center;
    color: red;
    font-size: 30px;
}
</style>
<?php

if(isset($_POST['singup-submit'])){

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if(empty($username)||empty($email)||empty($password)||empty($passwordRepeat)){
        header("Location: http://localhost:8080/loginPHP/singup.php?emptyfields&uid".$username."&mail=".$email);
        exit();
    }
    else if(!filter_var( $email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: http://localhost:8080/loginPHP/singup.php?error=invalidmail&uid");
        exit();
    }
    else if (!filter_var( $email, FILTER_VALIDATE_EMAIL)){
        header("Location: http://localhost:8080/loginPHP/singup.php?error=invalidmail".$username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: http://localhost:8080/loginPHP/singup.php?error=invaliduid&mail".$email);
        exit();
    }
    else if ($password !== $passwordRepeat){
        header("Location: http://localhost:8080/loginPHP/singup.php?error=passwordcheck&uid=".$username."&mail".$email);
        exit();
    }
    else {

        $sql = "SELECT uid FROM users WHERE uid=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: http://localhost:8080/loginPHP/singup.php?error=sqlerror");
            exit();
        } 
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: http://localhost:8080/loginPHP/singup.php?error=usertaken&mail".$email);
                exit();
            }
            else {

                $sql = "INSERT INTO users ( uid, email, pwd) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: http://localhost:8080/loginPHP/singup.php?error=sqlERROR");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    
                    header('Refresh:5; url= http://localhost:8080/loginPHP/singup.php?singup=succes');
                    echo '<p class=center>You have Successfully Signed Up!<br>You will be automatically back on page!<p>';
                    exit();
                }
            }
        }

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
    else{
        header("Location: http://localhost:8080/loginPHP/singup.php");
        exit();
    }


