<?php
    session_start();
    if (isset($_SESSION['username'])){
        session_destroy();
    }
    $port = $_SERVER['SERVER_PORT'];
    $locationUrl = "http://localhost:".$port."/index.php";
    header("Location:".$locationUrl);
    exit();
?>
