<?php
include("navbar.php");
include("footer.php");
include ("includes/database.php");

?>

<head>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>



<body>
<div class="container-fluid " style="background-image: url('water.jpg');  background-size:1000px 700px; height:700px;">
<div class="row justify-content-center">

<div class="col-10">

<div class="row" style="background-color:white;">

<div class="col">
<h4>Here are all your past billings</h4></div>

</div>

<div class="row" style="border:solid; height:500px; background-color:white;">

<div class="col-2" style="border:solid;">
<h5>USER BILL ID</h5>
<!-- This will echo the user bill id -->

<?php 

$idarray= (database::query("SELECT id FROM bills ORDER BY id ASC"));
print_r ($idarray);

?>

</div>
<div class="col-5" style="border:solid;">
<h5>USER BILL OBJECT/VALUE</h5>
<!-- This will echo the user bill value -->

<?php 

$objectarray= (database::query("SELECT bill_value FROM bills ORDER BY user_id ASC"));
print_r ($objectarray); 

?>


</div>

<div class="col-5" style="border:solid;">
<h5>USER BILL AMOUNT/COST</h5>
<!-- This will echo the user bill cost -->

<?php


$amountarray= (database::query("SELECT bill_amount FROM bills ORDER BY user_id ASC"));
print_r ($amountarray);
?>

</div>
</div>

</div>

</div>
</div>

</body>