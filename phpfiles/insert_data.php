<?php
  include('connection.php');
    if(isset($_POST['submit'])) 
    {   
        $name = $_POST['fname'];
        $last = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $note = $_POST['note'];

        $check = mysqli_query($connection, "SELECT id FROM client WHERE email = '$email'");
        if($check->num_rows == 0 ) 
        {
            mysqli_query($connection, "INSERT INTO client (fname, lname, email, phone, note) VALUES ('$name', '$last', '$email', '$phone', '$note')");
            header('Location: https://myfullcalendar.000webhostapp.com/phpfiles/clients.php#');
        }
        else 
        {
           echo "User with email '$email' already exist, Add new email";
           echo "Go back to <a href='http://localhost/Calendar/phpfiles/clients.php'>Clients</a>";
        }
    }

?>
