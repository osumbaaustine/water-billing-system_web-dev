<?php
// include the database
include ("includes/database.php");


// preg_replace('/\s+/','',$string);

if (isset($_POST['submit'])){
    $username=$_POST["username"];
    $email=$_POST["email"];
    $phonenumbber=preg_replace('/\s+/','',$_POST["phonenumber"]);
    $password=$_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];

    if (!database::query('SELECT username FROM userdetails WHERE username=:username', array(':username'=>$username))) {

      if (strlen($username) >= 3 && strlen($username) <= 32) {

              if (preg_match('/[a-zA-Z0-9_]+/', $username)) {

                      if (strlen($password) >= 6 && strlen($password) <= 60) {

                      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      
                      

                        if (!database::query('SELECT email FROM userdetails WHERE email=:email', array(':email'=>$email))) {

                                database::query('INSERT INTO userdetails VALUES (\'\', :username, :email, :phonenumber, :password)', array(':username'=>$username, ':email'=>$email,':phonenumber'=>$phonenumbber, ':password'=>password_hash($password, PASSWORD_BCRYPT)));
                                // to email the user let them know the account has been created 
                                // Mail::sendMail('Welcome to our Arrow Real Estate Property!', 'Your account has been created!', $email);
                                header("Location: login.php");
                        } else {
                                echo 'Email in use!';
                        }
                      
                      
              } else {
                              echo 'Invalid email!';
                      }
              } else {
                      echo 'Invalid password!';
              }
              } else {
                      echo 'Invalid username';
              }
      } else {
              echo 'Invalid username';
      }

} else {
      echo 'User already exists!';
}
  

}


?>

<head>
<title>Arrow |Sign-in</title>

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
  <div class="row justify-content-center my-row" style="padding-top:5%;">


  <!-- Forms -->
  <form  action="signup.php" method="post">
  <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Username" method="post">
      <small id="emailHelp" class="form-text text-muted">Your Official name would be prefferable.</small>
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email"  method="post">
     
    </div>
  <div class="form-group">
      <label for="phonenumber">Phone Number</label>
      <input type="text" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="emailHelp" placeholder="+123 700 000 000"  method="post">
     </div>
    <div class="form-group">
      <label for="password1">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password"  method="post">
    </div>
    <div class="form-group">
      <label for="confirmpassword">Confirm Password</label>
      <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Password" >
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="seepassword" name="seepassword" onclick="myFunction()" value="yes">
      <label class="form-check-label" for="seepassword">See password</label>
    </div><br>
    
    <button id="submit" name="submit" type="submit" class="btn btn-primary" method="post" action="signup.php">Submit</button>
    <a href="login.php">Login</a>
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