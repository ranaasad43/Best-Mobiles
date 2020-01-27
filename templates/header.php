<?php 
	session_start(); 

	$name = $_SESSION['uname'] ?? 'Guset';

	if(isset($_POST['logout'])){
		session_destroy();
		header('Location: ./index.php');
	}

	
?>


<head>
	<title>Best Mobiles</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body >
	<?php if($_SESSION): ?>
		<nav class="navbar navbar-expand-lg navbar-light best-nav" >
	  	<div class="container">
		  	<a class="navbar-brand" href="./home.php">Best Mobiles</a>
		  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    	<span class="navbar-toggler-icon"></span>
		  	</button>
		  <div class="collapse navbar-collapse navbar-right" id="navbarNav">	    
		    
		  </div>

		  <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item"><a href="" class="nav-link active">Welcome: <?php echo $name; ?></a></li>
		      <a class="btn btn-large btn-success" href="./addmobile.php">Add Mobile</a>
		      
		      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">					
						<input type="submit" name="logout" value="Logout" class="mx-3 btn btn-danger btn-large">
					</form>	      
		  </ul>
	  </div>
	</nav>
<?php endif; ?>