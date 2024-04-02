
<?php
session_start();
include('includes/config.php');
$uid = $_SESSION['id'];
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
	$pid=intval($_GET['id']);
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

	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$pid/".$_FILES["productimage1"]["name"]);
	move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$pid/".$_FILES["productimage2"]["name"]);
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$pid/".$_FILES["productimage3"]["name"]);
	
$sql=mysqli_query($con,"update  products set category='$category',subCategory='$subcat',users='$uid',productName='$productname',productCompany='$productcompany',productPrice='$productprice',productDescription='$productdescription',productAvailability='$productavailability',productImage1='$productimage1',productImage2='$productimage2',productImage3='$productimage3' where id='$pid' ");
$_SESSION['msg']="Product Updated Successfully !!";

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

<?php 

$query=mysqli_query($con,"select products.*,category.categoryName as catname,category.id as cid,subcategory.subcategory as subcatname,subcategory.id as subcatid from products join category on category.id=products.category join subcategory on subcategory.id=products.subCategory where products.id='$pid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  


?>

<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Category</label>
</div>
<div class="form-group col-md-8">
<select name="category" class="form-control" onChange="getSubcat(this.value);"  required>
<option value="<?php echo htmlentities($row['cid']);?>"><?php echo htmlentities($row['catname']);?></option> 
<?php $query=mysqli_query($con,"select * from category");
while($rw=mysqli_fetch_array($query))
{
	if($row['catname']==$rw['categoryName'])
	{
		continue;
	}
	else{
	?>

<option value="<?php echo $rw['id'];?>"><?php echo $rw['categoryName'];?></option>
<?php }} ?>
</select>
</div>
</div>

<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Sub Category</label>
</div>
<div class="form-group col-md-8">
<select   name="subcategory"  id="subcategory" class="form-control" required>
<option value="<?php echo htmlentities($row['subcatid']);?>"><?php echo htmlentities($row['subcatname']);?></option>
</select>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Name</label>
</div>
<div class="form-group col-md-8">
<input type="text"    name="productName"  placeholder="Enter Product Name" value="<?php echo htmlentities($row['productName']);?>" class="form-control" >
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Company</label>
</div>
<div class="form-group col-md-8">
<input type="text"    name="productCompany"  placeholder="Enter Product Comapny Name" value="<?php echo htmlentities($row['productCompany']);?>" class="form-control" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Price</label>
</div>
<div class="form-group col-md-8">
<input type="text"    name="productprice"  placeholder="Enter Product Price" value="<?php echo htmlentities($row['productPrice']);?>" class="form-control" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Description</label>
</div>
<div class="form-group col-md-8">
<textarea  name="productDescription"  placeholder="Enter Product Description" rows="6" class="form-control">
<?php echo htmlentities($row['productDescription']);?>
</textarea>  
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Availability</label>
</div>
<div class="form-group col-md-8">
<select   name="productAvailability"  id="productAvailability" class="form-control" required>
<option value="<?php echo htmlentities($row['productAvailability']);?>"><?php echo htmlentities($row['productAvailability']);?></option>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
</select>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Image1</label>
</div>
<div class="form-group col-md-8">
<img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage1']);?>" width="200" height="100"><input type="file" name="productimage1" id="productimage1" value="" class="form-control">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Image2</label>
</div>
<div class="form-group col-md-8">
<img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage2']);?>" width="200" height="100"> <input type="file" name="productimage2" id="productimage1" value="" class="form-control">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-3">
<label  for="basicinput">Product Image3</label>
</div>
<div class="form-group col-md-8">
<img src="productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage3']);?>" width="200" height="100"><input type="file" name="productimage3" id="productimage1" value="" class="form-control">
</div>
</div>
<?php } ?>
	<div class="form-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>
							</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/jquery/jquery-1.9.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
<?php } ?>