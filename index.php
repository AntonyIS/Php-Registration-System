<?php
include 'header.php';
include 'config.php';
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    echo $id;
}
?>