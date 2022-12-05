<?php 
    session_start();
    unset($_SESSION["korisnik"]);
    header("location: /prijava.php");
?>