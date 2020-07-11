<?php

$connect = new PDO('mysql:host=localhost;dbname=id11190967_localhost', 'id11190967_users', 'password123');

$data = array();

$query = "SELECT * FROM events ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
    
    'id'   => $row["id"],
    'resourceId' => $row['resourceId'],
    'title'   => $row["title"],
    'start'   => $row["start_event"],
    'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>
