<?php

session_start();

if(isset($_SESSION['user_name']) && isset($_SESSION['user_uni_no'])){
    session_destroy();
    session_unset();
    header('Location:index.php');
}
else{
    header('Location:index.php');
}



?>