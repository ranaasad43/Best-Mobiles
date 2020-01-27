<?php 

	include('config/conn.php');

	if(isset($_POST['delete'])){
		
		$del_id = mysqli_real_escape_string($conn,$_POST['del-id']);
		
		$sql = "DELETE FROM mobiles WHERE id = $del_id";

		if(mysqli_query($conn,$sql)){
			header('Location:home.php');
		}else{
			echo "query error: ".mysqli_error($conn);
		}
	}

	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn,$_GET['id']);

		$sql = "SELECT * FROM mobiles WHERE id = $id";

		$result = mysqli_query($conn,$sql);

		$mobile = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

		$exmobilef = explode(',',$mobile['features']);

	}
 ?>

 <!DOCTYPE html>
 <html>
 	<?php  include('templates/header.php'); ?>
		<div class="container">
			<h1 class="text-center">Details</h1>
			<div class="row">
				<div class="col-md-12">
					<?php if($mobile): ?> <!-- if started -->
					<div class="card">	<!-- card -->
						<h2 class="card-header text-center"><?php echo htmlspecialchars($mobile['brand']); ?></h2>
						<div class="card-body ">
							<h3 class="card-title text-center">Model: <?php echo htmlspecialchars($mobile['model']); ?></h3>
							<h4>Features:</h4>
							<?php foreach($exmobilef as $feature): ?> <!-- foreach started -->
							<ul class="list-group">
								<li class="list-group-item list-group-item-info"><?php echo htmlspecialchars($feature); ?></li>
							</ul>
						<?php endforeach; ?> <!-- foreach end -->

						</div>
						<div class="text-center mb-3">
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
								<input type="hidden" name="del-id" value="<?php echo htmlspecialchars($mobile['id']); ?>">
								<input type="submit" name="delete" value="Delete" class="btn btn-danger btn-large">
							</form>
						</div>
						<div class="card-footer">
							
							<span class="float-left">Uploaded By: <?php echo htmlspecialchars($mobile['email']); ?></span>
							<span class="float-right">Uploaded at: <?php echo htmlspecialchars($mobile['created_at']); ?></span>	
							</div>							
					</div> <!-- card end -->
					<?php else: ?> <!-- else -->
						<h2>Mobile not found</h2>
					<?php endif; ?>	<!-- if end -->
				</div>
			</div>
		</div>
 
	<?php  include('templates/footer.php'); ?>
 
 </html>