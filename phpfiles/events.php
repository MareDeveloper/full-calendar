<?php

    include('connection.php');

    $query = mysqli_query($connection,"SELECT * FROM user");

    if(isset($_POST['event'])) 
    {
        $event = $_POST['event'];
        $start_date = $_POST['start'];
        $end_date = $_POST['end'];

        $check = mysqli_query($connection,"SELECT id FROM user WHERE event = '$event'");
        if($check->num_rows == 0) 
        {
            mysqli_query($connection, "INSERT INTO user (title, start, end) VALUES('$event', '$start_date', '$end_date')");
        }
    }

    $users = array();

// Fetch results
while ($row = mysqli_fetch_array($query)) {

    $e = array(); 
    $e['id'] = $row['id'];
    $e['title'] = $row['title'];
    $e['start'] = $row['start'];
    $e['end'] = $row['end'];

        array_push($users, $e);    

}
// Output json for our calendar
echo json_encode($users);
exit(); 
?>