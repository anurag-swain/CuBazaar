<?php
session_start();
error_reporting(0);
include('includes/config.php');
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

	<div id="slides" class="carousel slide" data-ride="carousel">
		
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="images/slide-01.jpg">
				<div class="carousel-caption">
				</div>
			</div>
			<div class="carousel-item">
				<img src="images/slide-02.jpg">
				<div class="carousel-caption">
				</div>
			</div>
			<div class="carousel-item">
				<img src="images/slide-03.jpg">
				<div class="carousel-caption">
				</div>
			</div>
		</div>
	</div>

		<div class="container">	
		<div class="panel-heading">Feature Products</div>	
	     <div class="row">
<?php
$ret=mysqli_query($con,"select * from products");
while ($row=mysqli_fetch_array($ret)) 
{

?>
		
				<div class="col-md-3">
					<div class="products-top">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="200" height="300" alt=""></a>
				<div class="overlay">
					<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>" class="lnk btn btn-primary"><i class="fa fa-shopping-cart"></i>View Details</a>
				</div>
			</div>
			<div class="product-bottom text-center">
						<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
						<span class="price">
					Rs.<?php echo htmlentities($row['productPrice']);?>			</span>
					</div>		

			                        		   
		</div>
	<?php } ?>
			</div>
					</div>
		
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	</div>
<!--footer-->
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