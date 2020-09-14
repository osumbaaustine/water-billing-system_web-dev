<?php
include("navbar.php");
include("footer.php");
include ("includes/database.php");
session_start();


if (isset($_POST['submit'])){
    $object=$_POST['object'];
    $rate=$_POST['rate'];
    $value=$_POST['value'];
    $indexrate=(int)substr($rate,0,3);
    $indexvalue=(int)$value;
    $totalamount=$indexrate*$indexvalue;
    database::query('INSERT INTO bills VALUES (\'\', :user_id, :bill_value, :bill_amount)', array(':user_id'=>$_SESSION["user_id"], ':bill_value'=>$object,':bill_amount'=>$totalamount));
    
}



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
<div class="container-fluid" style="background-image: url('water.jpg'); background-size:1000px 700px; height:700px;">

<div class="row justify-content-center" style="height:50%;">
<div class="col-6" style="border:solid; margin:100px;  background-color:white;">

<form method="post">
<div class="form-group" id="value" style="margin:10px;" method="post">
<label for="object">Metre Object/Value</label>
<div>
<input type="text" class="form-control" name="object" id="object"  aria-describedby="objecline" placeholder="Metre Object/value" method="post">
<small id="objectline" class="form-text text-muted">This is the account name or meter name.</small>
</div>
</div>

<div class="form-group" id="rated" style="margin:10px;" method="post">
<label for="rate">Current Water rate</label>
<div>
<input type="text" class="form-control" name="rate" id="rate" placeholder="Water Rate" method="post" readonly="readonly">
<div>
<buttom onclick="ratethis()" type="button" id="refresh" class="btn btn-dark" style=" margin-top:20px;">Refresh rate</button>
</div>
</div>  
</div>

<div class="form-group" id="metrevalue" style="margin:10px;" method="post">
<label for="value">Metre Value</label>
<div>
<input type="text" class="form-control" name="value" id="value" placeholder="Metre Value" method="post">
</div>  
</div>

<button id="submit" name="submit" type="submit" class="btn btn-dark" style="margin:10px;" method="post" action="signup.php">Submit</button>

<h5>You're bill is <?php if (isset($_POST['submit'])){ echo $totalamount;}?> RWF<h5>

</form>
</div>
</div>

</div>
<script>
// Javascript for the rate that will keep on updating itself
function ratethis(){
document.getElementById("rate").value=200+(Math.floor((Math.random()*5)+1))+" RWF";

}
</script>
</body>

