<?php
    include('connection.php');
    
     if(isset($_POST)) 
     {
         
        $json = $_POST['json'];
        $decode = json_decode($json, JSON_UNESCAPED_SLASHES);
        foreach($decode as $key => $user)
        {
            
            $name = $user['name'];
            $name = $name == "" ? "No name" : $name;
            $phone =$user['phone'];
            $phone = $phone ==null ? "No phone" : $phone;
            $email = $user['email'];
            $email = $email == null ? "No email" : $email;
            
             $check = mysqli_query($connection, "SELECT id FROM google_clients WHERE gname = '$name'");
            if($check->num_rows == 0 ) 
            {
                mysqli_query($connection, "INSERT INTO google_clients (gname, gphone, gmail) VALUES ('$name', '$phone', '$email')");
                header('Location: https://myfullcalendar.000webhostapp.com/phpfiles/clients.php#');
            }
            else 
            {
              echo "User with email '$email' already exist, Add new email";
              echo "Go back to <a href='http:https://myfullcalendar.000webhostapp.com/phpfiles/clients.php#'>Clients</a>";
            }
        }
            
            
         
       
     }
    

     
   
 

    
   
?>