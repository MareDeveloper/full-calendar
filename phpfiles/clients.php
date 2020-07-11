<?php
  include('edit.php');
  include('delete.php');
  include('insert_data.php');
  include('status.php');
//   include('google_contacts.php');
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Web Application</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script src="https://apis.google.com/js/client.js"></script>
    
  	
    <style>
      #table-container #del_btn
      {
        position: absolute;
        margin-left: 4%;
        margin-top: 10%;
      }
      #table-container .link
      {
        position: relative;
        top: 70px;
        background-color: blue;
        padding: 10px;
        border: 1px solid white;
        border-radius: 2px;
      }
      #table-container .link a 
      {
        text-decoration: none;
        color: white;
      }
      #text 
      {
        position: relative;
        left: 40px !important;
        top: 10px;
      }
      #google 
      {
          position: relative;
          margin-right: 10px;
          margin-top: 135px;
      }
      
    </style>
 
</head>
<body>

<!-- Main container start -->
<div class="container"><br><br>
<!-- Add new client -->
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">New Client</button>
    <div id="demo" class="collapse">
      <h2>New Client</h2>
      <p>Please input fields to add new client into the table</p>
    <form class="form-inline" action="insert_data.php" method="POST">
      <div class="form-group">
        <label for="name">First Name:</label>
        <input type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname">
      </div>
      <div class="form-group">
        <label for="name">Last Name:</label>
        <input type="text" class="form-control" id="lname" placeholder="Enter last name" name="lname">
      </div>
      <div class="form-group">
        <label for="name">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
      <div class="form-group">
        <label for="pwd">Phone:</label>
        <input type="text" class="form-control" id="num" placeholder="Enter phone number" name="phone">
      </div>
      <div class="form-group" id="text">
        <label for="pwd">Note:</label>
        <textarea id="note" name="note" class="sm-textarea form-control" rows="2" col="6" placehoder="Write note"></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-default pull-right">Submit</button>
    </form>
  </div>

<!-- Button for removing all users from the table -->
  <div id="table-container">
    <div align="right">
        <button onclick="auth();" id="google" class="btn btn-info">Add Google Contacts</button>
          <button type="button" name="del_btn" id="del_btn" class="btn btn-danger">Delete</button>
          <button class="link btn btn-primary"><a href="https://myfullcalendar.000webhostapp.com/index.php">Calendar</a></button>
          <button class="link btn btn-primary"><a href="employees.php">Employees</a></button>
    </div><br>
    <!-- Filter -->
    <h3>Filter</h3>
    <input class="form-control" id="filter-input" type="text" placeholder="Enter name, email or phone number">
      <!-- Table data -->
    <table class="table">
      <thead>
        <tr>
          <th>First name</th>
          <th>Last name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Note</th>
          <th style="color: red;">Action</th>
          <th>Status</th>
          <th style="color: red;">Remove</th>
        </tr>
      </thead>


      <tbody class="filter-table">
        <?php
        // List of all users in the table
            $table  = mysqli_query($connection ,'SELECT * FROM client');
            
            while($row  = mysqli_fetch_array($table))
            { ?>
            
              <tr id="<?php echo $row['id'];?>">
                    <td data-target="fname"><?php echo $row['fname']; ?></td>

                    <td data-target="lname"><?php echo $row['lname']; ?></td>
                    
                    <td data-target="email"><?php echo $row['email']; ?></td>

                    <td data-target="phone"><?php echo $row['phone']; ?></td>

                    <td data-target="note"><?php echo $row['note']; ?></td>
                    
                    <td><a href="#" data-role="update" data-id="<?php echo $row['id'];?>">Update</a></td>

                    <td><i data="<?php echo $row['id']; ?>" class="check-status btn <?php echo ($row['st']) ? 'btn-success' : 'btn-danger' ?>"><?php echo ($row['st'])? 'Active' : 'Inactivate' ?></i></td>
                    
                    <td><input type="checkbox" user_id[] class="delete_user" value="<?php echo $row['id']; ?>"></td>
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
                          <input type="text" id="email" class="form-control">
                      </div>

                      <div class="form-group">
                          <label>Phone</label>
                          <input type="text" id="phone" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Note</label>
                          <input type="text" id="note" class="form-control">
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
  <br>
  <div class="google-clients">
      <h3>Google Contacts List</h3>
  </div>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
     <?php
     $table  = mysqli_query($connection ,'SELECT * FROM google_clients');
            
        while($row  = mysqli_fetch_array($table))
        { ?>
    
      <tr id="<?php echo $row['id'];?>">
            <td data-target="name"><?php echo $row['gname']; ?></td>

            <td data-target="phone"><?php echo $row['gphone']; ?></td>
            
            <td data-target="email"><?php echo $row['gmail']; ?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>

    <script>
    $(document).ready(function(){

        //  append values in input fields in modal
        $(document).on('click','a[data-role=update]',function(){
                var id  = $(this).data('id');
                var firstName  = $('#'+id).children('td[data-target=fname]').text();
                var lastName  = $('#'+id).children('td[data-target=lname]').text();
                var email  = $('#'+id).children('td[data-target=email]').text();
                var phone  = $('#'+id).children('td[data-target=phone]').text();
                var note  = $('#'+id).children('td[data-target=note]').text();

                $('#firstName').val(firstName);
                $('#lastName').val(lastName);
                $('#email').val(email);
                $('#phone').val(phone);
                $('#note').val(note);
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
                var note = $('#note').val();

            $.ajax({
                url      : 'edit.php',
                method   : 'post', 
                data     : {firstName : firstName , lastName: lastName , email : email , phone : phone, note : note, id: id},
                success  : function(response){
                        // update user record in table 
                        $('#'+id).children('td[data-target=fname]').text(firstName);
                        $('#'+id).children('td[data-target=lname]').text(lastName);
                        $('#'+id).children('td[data-target=email]').text(email);
                        $('#'+id).children('td[data-target=phone]').text(phone);
                        $('#'+id).children('td[data-target=note]').text(note);
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

          // Filter
          $("#filter-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".filter-table tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
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
    
	  function auth() {
	    var config = {
	      'client_id': '575870925621-m3oi6rm4tk0453imflovvtj766lt37ff.apps.googleusercontent.com',
	      'scope': 'https://www.google.com/m8/feeds'
	    };
	    gapi.auth.authorize(config, function() {
	      fetch(gapi.auth.getToken());  
	     
	    });
	  }
	
	  function fetch(token) {
	    $.ajax({
		    url: "https://www.google.com/m8/feeds/contacts/default/full?access_token=" + token.access_token + "&alt=json",
		    dataType: "json",
		    success:function(data) 
		    {
                        
                    var entrise = data.feed.entry;
                     var contacts = [];
                     
                    
                    
                    for(var i = 0; i < entrise.length; i++) 
                    {
                        var contactEntry = entrise[i];
                        var contact = {'name':{},'phone':{},'email':{}};
                        
                        
                        if(typeof (contactEntry.title) != 'undefined') 
                        {
                            if(typeof (contactEntry.title.$t) != 'undefined') 
                            {
                                contact.name = contactEntry.title.$t;
                                
                                
                            }
                        }
                        
                        if(typeof (contactEntry['gd$phoneNumber']) != 'undefined') 
                        {
                            var phoneNumber = contactEntry['gd$phoneNumber'];
                            for(var j = 0; j < phoneNumber.length; j++) 
                            {
                                if(typeof (phoneNumber[j]['$t']) != 'undefined') 
                                {
                                    var phone = phoneNumber[j]['$t'];
                                    contact.phone = phone;
                                    
                                    
                                }
                            }
                        }
                        
                        if(typeof (contactEntry['gd$email']) != 'undefined') 
                        {
                            var emailAddress = contactEntry['gd$email'];
                            for(var j = 0; j < emailAddress.length; j++) 
                            {
                                if(typeof (emailAddress[j]['address']) != 'undefined') 
                                {
                                    var emailAddresses = emailAddress[j]['address'];
                                    contact.email = emailAddresses;
                                    
                                }
                            }
                        }
                           
                         if(contact != null) 
                        {
                        
                          contacts.push(contact);
                          var json = JSON.stringify(contacts);
                          
                        }
                        
                    }
                   
                        
                        
                          $.post( "google.php", { json:json })
                            .done(function( json ) {
                                dataType: 'json';
                                location.reload();
                                alert( "Data added");
                                
                            });
                          
                       
                      }         
                        });
                        
                    
                       
		    };
		          
                           
                        
		    
		
		  

</script>

</body>
</html>
