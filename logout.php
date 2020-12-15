<?php 
session_start();
if(isset($_SESSION['user']) or isset($_SESSION['userdata']) )
{
    unset($_SESSION['user']);
    unset($_SESSION['userdata']);
    session_destroy();
    echo "destroyed";
    echo "<script type='text/javascript'>
                    window.location.replace('index.php');
          </script>";
}

?>