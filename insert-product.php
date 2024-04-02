<?php
session_start();
include('includes/config.php');
$uid = $_SESSION['id'];
if(strlen($_SESSION['login'])==0)
	{	
header('location:login.php');
}
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productdescription=$_POST['productDescription'];
	$productavailability=$_POST['productAvailability'];
	$productimage1=$_FILES["productimage1"]["name"];
	$productimage2=$_FILES["productimage2"]["name"];
	$productimage3=$_FILES["productimage3"]["name"];
//for getting product id
$query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
	 $productid=$result['pid']+1;
	$dir="productimages/$productid";
	mkdir($dir);
	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);
$sql="insert into products(category,subCategory,users,productName,productCompany,productprice,productDescription,productAvailability,productImage1,productImage2,productImage3) values('$category','$subcat','$uid','$productname','$productcompany','$productprice','$productdescription','$productavailability','$productimage1','$productimage2','$productimage3')";
mysqli_query($con,$sql);
$_SESSION['msg']="Product Inserted Successfully !!";

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

   <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>
<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>
<div class="col-md-1"></div>
<div class="col-md-7">
		<div class="form-group row"></div>
	<h2 class="panel-heading">Insert Product</h2>

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Category</label>
</div>
<div class="form-group col-md-8">
<select name="category" class="form-control" onChange="getSubcat(this.value);"  required>
<option value="">Select Category</option> 
<?php $query=mysqli_query($con,"select * from category");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
<?php } ?>
</select>
</div></div>

									
<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Sub Category</label>
</div>
<div class="form-group col-md-8">
<select   name="subcategory"  id="subcategory" class="form-control" required>
</select>
</div></div>


<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Product Name</label>
</div>
<div class="form-group col-md-8">
<input type="text"    name="productName"  placeholder="Enter Product Name" class="form-control" required>
</div></div>

<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Product Company</label>
</div>
<div class="form-group col-md-8">
<input type="text"    name="productCompany"  placeholder="Enter Product Company Name" class="form-control" required>
</div></div>
<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Product Price</label>
</div>
<div class="form-group col-md-8">
<input type="text"    name="productprice"  placeholder="Enter Product Price" class="form-control" required>
</div></div>
<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Product Description</label>
</div>
<div class="form-group col-md-8">
<textarea  name="productDescription"  placeholder="Enter Product Description" rows="6" class="form-control">
</textarea>
</div></div>
<div class="form-row">
<div class="form-group col-md-3">
	<label for="basicinput">Product Availability</label>
</div>
<div class="form-group col-md-8">
<select   name="productAvailability"  id="productAvailability" class="form-control" required>
<option value="">Select</option>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
</select>
</div></div>

<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Product Image1</label>
</div>
<div class="form-group col-md-4">
<input type="file" name="productimage1" id="productimage1" value="" class="form-control" required >
</div></div>
<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Product Image2</label>
</div>
<div class="form-group col-md-4">
<input type="file" name="productimage2"  class="form-control" required>
</div></div>
<div class="form-row">
<div class="form-group col-md-3">
<label for="basicinput">Product Image3</label>
</div>
<div class="form-group col-md-4">
<input type="file" name="productimage3"  class="form-control">
</div></div>

	<div class="form-group">
											<div class="form-group">
												<button type="submit" name="submit" class="btn">Insert</button>
											</div>
										</div>
									</form>
								</div>
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