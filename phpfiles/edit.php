<?php 
  include('connection.php');
  

    // employees
    if(isset($_POST['email'])){
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $add = $_POST['add'];
        $note = $_POST['note'];
    
      //  query to update data 
       
      $result  = mysqli_query($connection , "UPDATE user SET firstName='$firstName' , lastName='$lastName' , email = '$email', phone = '$phone', address = '$add' WHERE id='$id'");
      $result  = mysqli_query($connection , "UPDATE client SET fname='$firstName' , lname='$lastName' , email = '$email', phone = '$phone', note = '$note' WHERE id='$id'");
      if($result){
          echo 'data updated';
      }

  }

  // Clients
//   if(isset($_POST['email'])){
//     $id = $_POST['id'];
//     $firstName = $_POST['firstName'];
//     $lastName = $_POST['lastName'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $note = $_POST['note'];

//   //  query to update data 
   
//   $result  = mysqli_query($connection , "UPDATE client SET fname='$firstName' , lname='$lastName' , email = '$email', phone = '$phone', note = '$note' WHERE id='$id'");
//   if($result){
//       echo 'data updated';
//   }

// }
?> 
