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
</style>

<main class="center">
    <?php
   
    if (isset($_SESSION['userID'])) {
        echo '<p>You are logged in!</p>';
    } else{
        echo '<p>You are logged out!</p>';
    }
    ?>
</main>
    
<?php
require 'footer.php';
?>
