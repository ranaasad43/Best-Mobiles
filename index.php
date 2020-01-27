<?php  
	if(isset($_POST['submit'])){
		session_start();
		$_SESSION['uname'] = $_POST['name'];		
		header('Location: home.php');
	}
	// include('config/conn.php');

	// $sql = 'SELECT * FROM mobiles ORDER BY created_at';

	// $result = mysqli_query($conn,$sql);

	// $mobiles = mysqli_fetch_all($result,MYSQLI_ASSOC);

	// mysqli_free_result($result);

	// mysqli_close($conn);

	//print_r($mobiles);
?>
<!DOCTYPE html>
<html>

	<?php  include('templates/header.php'); ?>
		<div class="container my-5">
			<h1 class="text-center">Welcome to the Best Mobiles</h1>
			<div class="row">				
				<div class="container">
					<div class="col-md-12">
						<h2>Please enter your name to continue: </h2>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
							<div class="form-group">
								<label for="name " class="h3">Name:</label>
								<input type="text" name="name" class="form-control">								
							</div>
							<button type="submit" name="submit" value="submit" class="btn btn-success my-3">Enter</button>
							
						</form>
					</div>
				</div>
			</div>		
		</div>
	


	<?php  include('templates/footer.php'); ?>


</html>