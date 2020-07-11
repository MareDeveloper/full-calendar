<?php

$connect = new PDO('mysql:host=localhost;dbname=id11190967_localhost', 'id11190967_users', 'password123');

if(isset($_POST["title"]))
{
 $query = "
 INSERT INTO events 
 (resourceId, title, start_event, end_event) 
 VALUES (:resourceId, :title, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
    'resourceId' => $_POST['resourceId'],
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>
