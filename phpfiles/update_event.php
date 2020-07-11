<?php

$connect = new PDO('mysql:host=localhost;dbname=id11190967_localhost', 'id11190967_users', 'password123');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events 
 SET resourceId=:resourceId, title=:title, start_event=:start_event, end_event=:end_event 
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
    ':resourceId' => $_POST['resourceId'],
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>