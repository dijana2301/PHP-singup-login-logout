<?php
require 'header.php';

?>
<style>
.center{
    margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}
.error {
    text-align:center;
    color: red;
    margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}
h1{
    margin: auto;
    text-align:center;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}
</style>
<main>

    <h1>Signup</h1>
    
<div class="form-group center">

<form action="includes/singup.inc.php" method="post">

<?php
if (isset($_GET['uid'])) {
    $uid =$_GET['uid'];
    echo'<input type="text" class="form-control" name="uid" placeholder="Username" value="'.$uid.'">';
} else{
    echo'<input type="text" class="form-control" name="uid" placeholder="Username">';
}
if(isset($_GET['mail'])){
    $mail =$_GET['mail'];
    echo '<input type="text" class="form-control" name="mail" placeholder="E-mail" value="'.$mail.'">';
} else{
    echo'<input type="text" class="form-control" name="mail" placeholder="E-mail">';
}
?>

<input type="password" class="form-control" name="pwd" placeholder="Password">
<input type="password" class="form-control" name="pwd-repeat" placeholder="Repeat password">
<button type="submit" class="btn btn-outline-success my-2 my-sm-0" name="singup-submit"Signup>Signup</button>

</form>

</div>
</main>

<?php

$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

 if(strpos($fullUrl, "emptyfields&uid") == true){
echo "<br><p class=error>You did not fill in all fields!</p>";
 } else if(strpos($fullUrl, "error=invalidmail&uid") == true){
    echo "<br><p class=error>Invalid Email and Username!</p>";
     }
     else if(strpos($fullUrl, "error=invalidmail") == true){
        echo "<br><p class=error>Invalid Email!</p>";
         }
         else if(strpos($fullUrl, "error=invaliduid&mail") == true){
            echo "<br><p class=error>Invalid Username!</p>";
             }
             else if(strpos($fullUrl, "error=passwordcheck&uid=") == true){
                echo "<br><p class=error>Password do not match!!</p>";
                 }
                 else if(strpos($fullUrl, "error=sqlerror") == true){
                    echo "<br><p class=error'>This Username already exist!</p>";
                     }
                     else if(strpos($fullUrl, "error=usertaken&mail") == true){
                        echo "<br><p class=error>Username already taken!</p>";
                         }
                         else if(strpos($fullUrl, "error=sqlERROR") == true){
                            echo "<br><p class=error>EROR!</p>";
                             }

require 'footer.php';
?>
