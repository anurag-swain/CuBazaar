<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['change']))
{
   $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and contactno='$contact'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($con,"update users set password='$password' WHERE email='$email' and contactno='$contact' ");
$_SESSION['errmsg']="Password Changed Successfully";
}
else
{
$_SESSION['errmsg']="Invalid email id or Contact no";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CuBazaar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style> .main-body{
	height: 100%;
	display: table;
	margin-left: 200vw;
	display: table-cell;
    vertical-align: middle;
  
  }</style>
</head>
<body>
<?php include('includes/header.php');?>
	<div class="container">
		<div class="sign-in-page>
			<div class="row">			
<div class="col-md-6 col-sm-6 sign-in main-body>
	<h4 class="">Forgot password</h4>
	<form class="register-form " name="register" method="post">
	<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>
	</span>
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" name="email" class="form-control" id="exampleInputEmail1" required >
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="exampleInputPassword1">Contact no <span>*</span></label>
		 <input type="text" name="contact" class="form-control" id="contact" required>
		</div>
<div class="form-group">
	    	<label class="info-title" for="password">Password. <span>*</span></label>
	    	<input type="password" class="form-control" id="password" name="password"  required >
	  	</div>

<div class="form-group">
	    	<label class="info-title" for="confirmpassword">Confirm Password. <span>*</span></label>
	    	<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required >
	  	</div>
		
	  	<button type="submit" class="btn-upper btn btn-primary" name="change">Change</button>
	</form>					
</div></div></div></div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/jquery/jquery-1.9.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	
<!--//footer-->
<div class="footer">
		<div class="container">
				<h3>Copyright :</h3>
				<p>© 2019 Buying & Selling . All rights reserved | Design by <a target ="_blank" href="https://www.youtube.com/kingofpcgames">Anurag Swain</a></p>
			
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//footerEnd-->
</body>
</html>