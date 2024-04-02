<!--dummy login page-->

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$contactno=$_POST['contactno'];
$password=md5($_POST['password']);
$check_email = mysqli_query($con,"SELECT email FROM users WHERE email='$email'");
	$count=mysqli_num_rows($check_email);
	if ($count==0) {
$query = mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
if($query)
{
	echo "<script>alert('You are successfully register');</script>";
}
else{
echo "<script>alert('Not register something went worng');</script>";
}
}
else {	
	echo "<script>alert('sorry email already taken !');</script>";
			
	}
}
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
header('location:index.php');
exit();
}
else
{
$_SESSION['errmsg']="Invalid email id or Password";
header('location:login.php');
exit();
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Or Signup</title>

    <script type="text/javascript">
function valid()
{
 if(document.register.password.value!= document.register.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.register.confirmpassword.focus();
return false;
}
return true;
}
</script>
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
   ></script>
   <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
  	<div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
            <p>Wonderful! Lets Sigin</p>
          
			<label id="label-register" for="log-reg-show">Login</label>
			<input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>
							
		<div class="register-info-box">
			<h2>Don't have an account?</h2>
			<p>Lorem ipsum dolor sit amet</p>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
			<div class="login-show">
                <h2>LOGIN</h2>
                <span style="color:red;" >
                <?php
                    echo htmlentities($_SESSION['errmsg']);
                ?>
                <?php
                    echo htmlentities($_SESSION['errmsg']="");
                ?>
	</span>
                <input type="text" name="email" placeholder="Email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
				<input type="password" placeholder="Password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
				<input type="button" name="login" value="Login">
				<a href="forgot-password.php">Forgot password?</a>
			</div>
			<div class="register-show">
                <h2>REGISTER</h2>
<form class="register-form" role="form" method="post" name="register" onSubmit="return valid();">
                <input type="text" placeholder="Full Name" id="fullname" name="fullname" required="required" class="form-control unicase-form-control text-input">
                <input type="text" placeholder="Email">
                <input type="text" placeholder="Mobile Number" class="form-control unicase-form-control text-input" id="contactno" name="contactno" maxlength="10" required>
				<input type="password" placeholder="Password" class="form-control unicase-form-control text-input" id="password" name="password"  required >
				<input type="password" placeholder="Confirm Password" class="form-control unicase-form-control text-input" id="confirmpassword" name="confirmpassword" required >
                <input type="button" value="Register" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">
</form>
			</div>
		</div>
	</div>
  <script>
    $(document).ready(function(){
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});


$('.login-reg-panel input[type="radio"]').on('change', function() {
    if($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut(); 
        $('.login-info-box').fadeIn();
        
        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');
        
    }
    else if($('#log-reg-show').is(':checked')) {
        $('.register-info-box').fadeIn();
        $('.login-info-box').fadeOut();
        
        $('.white-panel').removeClass('right-log');
        
        $('.login-show').addClass('show-log-panel');
        $('.register-show').removeClass('show-log-panel');
    }
});



    
    
</script>
</body>
</html>