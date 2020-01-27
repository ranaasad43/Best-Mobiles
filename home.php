<?php  
	
	include('config/conn.php');

	$sql = 'SELECT * FROM mobiles ORDER BY created_at';

	$result = mysqli_query($conn,$sql);

	$mobiles = mysqli_fetch_all($result,MYSQLI_ASSOC);

	mysqli_free_result($result);

	mysqli_close($conn);
 

?>
<!DOCTYPE html>
<html>

	<?php  include('templates/header.php'); ?>
		<div class="container my-5">
			<h1 class="text-center">Mobiles</h1>
			<div class="row">
				<?php foreach($mobiles as $mobile): ?>
				<div class="col-md-6 " >
					<div class="card my-3" style="">
						<img src="gallery/<?php $model = str_replace(' ', '', $mobile['model']); echo $model.'.'.'jpg'; ?>" class="card-img-top" alt="" style="height: 300px;">
						<h3 class="card-header text-center"><?php echo htmlspecialchars($mobile['brand']); ?></h3>
						<div class="card-body">							
							<h4 class="card-title"><?php echo htmlspecialchars($mobile['model']); ?></h4>				
							<?php foreach(explode(',', $mobile['features']) as $ing): ?>
                <ul class="list-group my-2">
                	<li class="list-group-item list-group-item-info"><?php echo htmlspecialchars($ing); ?></li>
                </ul>
						  <?php endforeach; ?>
							<a href="details.php?id=<?php echo $mobile['id'] ?>" class="btn btn-danger btn-large ">Read More</a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>		
		</div>
	


	<?php  include('templates/footer.php'); ?>


</html>