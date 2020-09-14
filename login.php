<?php
// include the database
include ("includes/database.php");

session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  if (database::query('SELECT username FROM userdetails WHERE username=:username', array(':username'=>$username))) {

          if (password_verify($password, database::query('SELECT password FROM userdetails WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                  echo 'Logged in!';
                  $cstrong = True;
                  $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                  $user_id = database::query('SELECT user_id FROM userdetails WHERE username=:username', array(':username'=>$username))[0]['id'];
                  database::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                  // Saving the username to a session
                  $_SESSION["user_id"]=$user_id;

                  // Open the profile page
                  header("Location:billing.php");

                  setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                  setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

          } else {
                  echo 'Incorrect Password! ';
                  // echo  database::query('SELECT email FROM userdetails WHERE username=:username', array(':username'=>$username))[0]['email'];
                  echo "  ";
                  echo database::query('SELECT password FROM userdetails WHERE username=:username', array(':username'=>$username))[0]['password'];
                  echo ".  .";
                  echo password_hash($password, PASSWORD_BCRYPT);
          }

  } else {
          echo 'User not registered!';
  }

}



?>

<head>
<title>LOGIN</title>

<!-- Mete tags -->
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<!-- Stylesheets and Css files -->
<!-- <link rel="stylesheet" href="assets\css\bootstrap.css">
<link rel="stylesheet" href="assets\css\bootstrap-grid.css">
<link rel="stylesheet" href="assets\css\bootstrap-grid.min.css">
<link rel="stylesheet" href="assets\css\bootstrap-reboot.css">
<link rel="stylesheet" href="assets\css\bootstrap-reboot.min.css">
<link rel="stylesheet" href="assets\css\bootstrap.min.css"> -->


<!-- Importing Jquery and Javascript -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="extensions/resizable/bootstrap-table-resizable.js"></script>

<script src=".js/jquery-3.5.1.js"></script>
<!-- <script src=".js/bootstrap.js"></script>
<script src=".js/bootstrap.bundle.js"></script>
<script src=".js/bootstrap.bundle.min.js"></script>
<script src=".js/bootstrap.min.js"></script> -->


</head>

<body>
<div class="row justify-content-center my-row" style="padding-top:10%;">


<!-- Forms -->
<form  method="post" action="login.php">
<form>
  <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Username" method="post">

    </div>

    <div class="form-group">
      <label for="password1">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password"  method="post">
    </div>
 
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="seepassword" name="seepassword" onclick="myFunction()" value="yes">
      <label class="form-check-label" for="seepassword">See password</label>
    </div><br>
    
    <button id="login" name="login" type="submit" class="btn btn-primary" method="post" action="login.php">Submit</button>
    <a href="signup.php">Sign up</a>
  </form>

  </div>


  <script>
  // To toggle password visibility
  function myFunction() {
    var x = document.getElementById("password");
    var y = document.getElementById("confirmpassword");
    if (x.type === "password") {
      x.type = "text";
      y.type = "text";
    } else {
      x.type = "password";
      y.type = "password";
    }
  }
  </script>

</body>