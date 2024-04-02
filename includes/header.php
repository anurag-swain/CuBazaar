	<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php"><img src="images/cubazaar.png" style="height: 40px; width: 100px" alt="logo"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive
			">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                    	<?php $sql=mysqli_query($con,"select id,categoryName  from category limit 6");
while($row=mysqli_fetch_array($sql))
{
    ?>
                        <li><a href="categories.php?cid=<?php echo $row['id'];?>"> <?php echo $row['categoryName'];?></a>
			
			</li>
			<?php } ?>
                    </ul>
                </li>
					<li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Contact</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<?php if(strlen($_SESSION['login']))
						{   ?>
					<li class="nav-item">
					<a class="nav-link" href="#"><i class="icon fa fa-user"></i>Welcome -<?php echo htmlentities($_SESSION['username']);?></a></li>
				     <?php } ?>
					<li class="nav-item">
					<?php if(strlen($_SESSION['login'])==0)
                     {   ?>
                     </li>
					<li class="nav-item">
						<a class="btn btn-success" href="login.php">Login/Signup</a>
					</li>
					<?php }
					else { ?>
					<li class="nav-item">
						<a class="btn btn-danger" href="logout.php">Logout</a>
					</li>
					<?php } ?>	
				
				<li><a href="category.php" class="btn btn-info">Manage Products</a><li>
				</ul>		
		</div>
	</div>
	</nav>