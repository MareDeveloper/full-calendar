<?php
include('edit.php');
include('delete.php');
include('status.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    
    #table-container 
    {
      top: 50px;
      position: relative;
    }
    #table-container #del_btn
    {
      margin-right: 4%;
    }
    #table-container .link
      {
        position: relative;
        top: 3px;
        background-color: blue;
        border: 1px solid white;
        border-radius: 2px;
        padding: 10px;
      }
      #table-container .link a 
      {
        text-decoration: none;
        color: white;
      }
  </style>
  <title>Document</title>
</head>
<body>

<div class="container">

<!-- Button for removing all users from the table -->
  <div id="table-container">
    <div align="right">
          <button type="button" name="del_btn" id="del_btn" class="btn delete_btn btn-danger">Delete</button>
          <button type="button" class="link"><a href="https://myfullcalendar.000webhostapp.com/index.php">Calendar</a></button>
          <button type="button" class="link"><a href="clients.php">Clients</a></button>
    </div>


      <!-- Table data -->
    <table class="table">
      <thead>
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Action</th>
          <th>Remove</th>
          <th>Active employees</th>
        </tr>
      </thead>


      <tbody>
        <?php
        // List of all users in the table
            $table  = mysqli_query($connection ,'SELECT * FROM user');
            
            while($row  = mysqli_fetch_array($table))
            { ?>
            
              <tr id="<?php echo $row['id'];?>">
                    <td data-target="firstName"><?php echo $row['firstName']; ?></td>

                    <td data-target="lastName"><?php echo $row['lastName']; ?></td>
                    
                    <td data-target="email"><?php echo $row['email']; ?></td>

                    <td data-target="phone"><?php echo $row['phone'];?></td>
                    
                    <td data-target="add"><?php echo $row['address'];?></td>
                    
                    <td><a href="#" data-role="update" data-id="<?php echo $row['id'];?>">Update</a></td>
                    
                    <td><input type="checkbox" user_id[] class="delete_user" value="<?php echo $row['id']; ?>"></td>

                    <td><i data="<?php echo $row['id']; ?>" class="check-status btn <?php echo ($row['active_users']) ? 'btn-success' : 'btn-danger' ?>"><?php echo ($row['active_users'])? 'Active' : 'Incactive' ?></i></td>
              </tr>
                
    <?php } ?>
      </tbody>

    </table>

  
    </div>

   <!-- Bootstrap Modal -->
      <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Edit data</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" id="firstName" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" id="lastName" class="form-control">
                      </div>

                      <div class="form-group">
                          <label>Email</label>
                          <input type="email" id="email" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Phone</label>
                          <input type="number" id="phone" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Address</label>
                          <input type="text" id="address" class="form-control">
                      </div>
                      <input type="hidden" id="userId" class="form-control">
                  </div>
                  <div class="modal-footer">
                      <a href="" id="save" class="btn btn-primary pull-right">Update</a>
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </div>
            </div>
        </div>
  </div> 
</div>

    <script>
    $(document).ready(function(){

        //  append values in input fields in modal
        $(document).on('click','a[data-role=update]',function(){
                var id  = $(this).data('id');
                var firstName  = $('#'+id).children('td[data-target=firstName]').text();
                var lastName  = $('#'+id).children('td[data-target=lastName]').text();
                var email  = $('#'+id).children('td[data-target=email]').text();
                var phone  = $('#'+id).children('td[data-target=phone]').text();
                var add  = $('#'+id).children('td[data-target=add]').text();

                $('#firstName').val(firstName);
                $('#lastName').val(lastName);
                $('#email').val(email);
                $('#phone').val(phone);
                $('#address').val(add);
                $('#userId').val(id);
                $('#myModal').modal('toggle');
        });

        // create event to get data from fields and update in database 

        $('#save').click(function(){
                var id  = $('#userId').val(); 
                var firstName =  $('#firstName').val();
                var lastName =  $('#lastName').val();
                var email =   $('#email').val();
                var phone = $('#phone').val();
                var add = $('#address').val();

            $.ajax({
                url      : 'edit.php',
                method   : 'post', 
                data     : {firstName : firstName , lastName: lastName , email : email , phone : phone , add : add , id: id},
                success  : function(response){
                        // update user record in table 
                        $('#'+id).children('td[data-target=firstName]').text(firstName);
                        $('#'+id).children('td[data-target=lastName]').text(lastName);
                        $('#'+id).children('td[data-target=email]').text(email);
                        $('#'+id).children('td[data-target=phone]').text(phone);
                        $('#'+id).children('td[data-target=add]').text(add);
                        $('#myModal').modal('toggle');
                        }
            });
        });
       
        // Delete user from table
        $('#del_btn').click(function(){
              if(confirm("Are you sure about this?")) 
              {
                  var id = [];

                  $(':checkbox:checked').each(function(i){
                    id[i] = $(this).val();
                  }); 
                  if(id.length === 0) 
                  {
                    alert("You must select last one checkbox");
                  }
                  else 
                  {
                      $.ajax({
                          url     :   'delete.php',
                          method  :   'post',
                          data    :   {id:id},
                          success :   function()
                          {
                            for(let i = 0; i<id.length; i++) 
                            {
                              $('tr#'+id[i]+'').css('background-color', 'red');
                              $('tr#'+id[i]+'').hide('slow');
                            }
                          }
                      });
                  }
              }
              else 
              {
                return false;
              }
          });
          // Show or hide table 
          $('.text-show').click(function(){
              $('#table-container').toggle();          
          });

          // Status Active : Inactive
          $(document).on('click', '.check-status', function(){
              var status = ($(this).hasClass('btn-success')) ? '0' : '1';
              var message = (status === '0')? 'Deactivate' : 'Activate';
              if(confirm('Are you sure ' + message)) 
              {
                var current_element = $(this);
                $.ajax({
                  type: 'POST',
                  url: 'status.php',
                  data: {id:$(current_element).attr('data'), status : status},
                  success: function(data) 
                  {
                    location.reload();  
                  }
                });
              }
          });
    });
</script>
</body>
</html>