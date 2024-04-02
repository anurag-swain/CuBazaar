<?php 
session_start();
error_reporting(0);
include('includes/config.php');
$pid=intval($_GET['pid']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CuBazaar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
     <?php include('includes/header.php');?>
     <?php
$ret=mysqli_query($con,"select * from products where id=$pid");
while ($row=mysqli_fetch_array($ret)) 
{

?>
<div class="container">
<div class="row">
	<div class="col-md-6">
<div class="carousel slide" data-ride="carousel">
		
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" style="height: 100%; width: 100%;">
			</div>
			<div class="carousel-item">
				<img src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>" style="height: 100%; width: 100%;">
			</div>
			<div class="carousel-item">
				<img src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage3']);?>" style="height: 100%; width: 100%;">
			</div>
		</div>
	</div></div>
	<div class="col-md-6">
		<div class="row ">
			<div class="col-md-3">
				<span class="label">Availability:</span>
			</div>
			<div class="col-md-3">
				<span class="label"><?php echo htmlentities($row['productAvailability']);?></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3" style="margin-left: 8px">
				<span class="label">Product Brand:</span>
			</div>
			<div class="col-md-3" style="margin-left: 8px">
				<span class="label"><?php echo htmlentities($row['productCompany']);?></span>
			</div>
		</div><?php } ?>
		<?php
$ret=mysqli_query($con,"select users.name as uname,users.contactno as ucontact from products join users on users.id=products.users where products.id='$pid'");
while ($rw=mysqli_fetch_array($ret)) {

?>
		<div class="row" style="margin-left: 10px">
				<span class="label">Seller Discription:</span>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
					<div class="row">
						<div class="col-md-3"><span class="label">Name:</span></div>
						<div class="col-md-3"><span class="label"><?php echo htmlentities($rw['uname']);?></span></div>
					</div>
					<div class="row">
						<div class="col-md-3"><span class="label">Contact:</span></div>
						<div class="col-md-3"><span class="label"><?php echo htmlentities($rw['ucontact']);?></span></div>
					</div>
					</div>
				</div>
	</div>
</div>
</div>
<?php } ?>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>


	<div class="footer">
		<div class="container">
				<h3>Copyright :</h3>
				<p>© 2019 Buying & Selling . All rights reserved | Design by <a target ="_blank" href="https://www.youtube.com/kingofpcgames">Anurag Swain</a></p>
			
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//footer-->
</body>
</html>