<?php 
    include('connection.php');
    // clients.php
    extract($_POST);
    if(isset($_POST['id']))
    {
        $status = $_POST['status'];
        $client = $connection->real_escape_string($id);
        $status = $connection->real_escape_string($status);
        $sql = $connection->query("UPDATE client SET st='$status' WHERE id='$id'");
        $sql = $connection->query("UPDATE user SET active_users='$status' WHERE id='$id'");
        echo 1;
    }
    // employees.php
    // extract($_POST);
    // if(isset($_POST['id']))
    // {
    //     $status = $_POST['active_users'];
    //     $client = $connection->real_escape_string($id);
    //     $status = $connection->real_escape_string($status);
    //     $sql = $connection->query("UPDATE user SET active_users='$status' WHERE id='$id'");
    //     echo 1;
    // }
    
?>