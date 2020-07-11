<?php
include('connection.php');


$query = mysqli_query($connection,"SELECT * FROM user");

$users = array();

while ($row = mysqli_fetch_assoc($query)) {

    $e = array(); 
    $e['id'] = $row['id'];
    $e['title'] = $row['firstName'];
    $e['active'] = $row['active_users'];

    if($row['active_users'] !== '0')
    {
        array_push($users, $e);
    }
    
}

echo json_encode($users);
exit(); 
