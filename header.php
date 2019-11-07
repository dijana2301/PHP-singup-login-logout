<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Login PHP</title>

</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">


<div class="collapse navbar-collapse">
<ul class="navbar-nav mr-auto">
<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
<li class="nav-item active"><a class="nav-link" href="">Portfolio</a></li>
<li class="nav-item active"><a class="nav-link" href="">About me</a></li>
<li class="nav-item active"><a class="nav-link" href="">Contact</a></li>
</ul>

<?php
    if(isset($_SESSION['userID'])){
        echo '<form class="form-inline my-2 my-lg-0" action="includes/logout.inc.php" action="post">
        <button class="btn btn-outline-success my-2 my-sm-0" type ="submit" name="logout-submit">Logout</button>
        </form>';
         } 
        else {
        echo '<form class="form-inline my-2 my-lg-0" action="includes/login.inc.php" method="post">
        <input class="form-control mr-sm-2" type="text" name="mailuid" placeholder="Username/E-mail...">
        <input class="form-control mr-sm-2" type="password" name="pwd" placeholder="Password...">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="login-submit">Login</button>
        </form>
        <button class="btn btn-outline-success my-2 my-sm-0"><a href="singup.php">Singup</a></button>';
         }
?>



</div>
</nav>
</header>
