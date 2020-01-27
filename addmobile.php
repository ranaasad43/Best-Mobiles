<?php  
	function dd($var){
		echo "<pre>";
		print_r($var);
		die;
	}

	include('config/conn.php');

	$brand = $model = $features = $email =  '';

	$errors = array('brand'=>'','model'=>'','features'=>'','email'=>'','image'=>'');
	
	if(isset($_POST['submit'])){
		
		if(empty($_POST['brand'])){ ////////////////////////////brand
			$errors['brand'] = "brand is required <br/>";
		}else{
			$brand = htmlspecialchars($_POST['brand']);
			if(strlen($brand) < 3){
				$errors['brand'] = "brand must be at least 3 charactors <br/>";
			} 
		}
		if(empty($_POST['model'])){ ///////////////////////////////model
			$errors['model'] = "model is required <br/>";
		}else{
			$model = htmlspecialchars($_POST['model']);
			if(strlen($model) < 2){
				$errors['model'] = "model must be at least 2 charactors <br/>";
			}
		}
		if(empty($_POST['features'])){ ///////////////////////////////features
			$errors['features'] = "features are required <br/>";
		}else{
			$features = htmlspecialchars($_POST['features']);
			if(strlen($features) < 5){
				$errors['features'] = "features must be more than 5 char <br/>";
			}
		}

		if(empty($_POST['email'])){ //////////////////////////////email
			$errors['email'] = "email is required <br/>";
		}else{
			$email = htmlspecialchars($_POST['email']);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = "valid email is required <br/>";
			}
		}	
		//dd($errors);		
			

		if(empty($_FILES['image']['name'])){
			$errors['image'] = "image is required <br/>";
		}
			
		

		

		if(array_filter($errors)){
			//echo "error in the form";
		//dd($errors);
		}else{

			$image = $_FILES['image'];
			$imageName = $_FILES['image']['name'];
			$imageTmpName = $_FILES['image']['tmp_name'];
			$imageSize = $_FILES['image']['size'];
			$imageType = $_FILES['image']['type'];

			$imageExtT = explode('.',$imageName);
			$imageExt = strtolower(end($imageExtT));

			$allowedimage = array('jpg','jpeg','png','pdf');
			if(in_array($imageExt,$allowedimage)){
				$modelname = str_replace(' ', '', $model);

				$mobileimgname = $modelname.'.'.$imageExt;
				$gallery = 'gallery/'.$mobileimgname;				
				move_uploaded_file($imageTmpName,$gallery);
			}else{
				echo "cant upload file";
			}
			
			
			$brand = mysqli_real_escape_string($conn,$_POST['brand']);
			$model = mysqli_real_escape_string($conn,$_POST['model']);
			$features = mysqli_real_escape_string($conn,$_POST['features']);
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			

			$sql = "INSERT INTO mobiles (brand,model,features,email) VALUES ('$brand','$model','$features','$email')";
			if(mysqli_query($conn,$sql)){
				header('Location: home.php');	
			}else{
				echo "upload error".mysqli_error($conn);
			}
		}
	}

?>
<!DOCTYPE html>
<html>

	<?php  include('templates/header.php'); ?>
	
	<div class="container ">
		<h1 class="text-center" >Add Mobile</h1>
		
		<form action="addmobile.php" method="POST" enctype="multipart/form-data">
		  <div class="form-group">
		    <label for="brand">Mobile Brand</label>
		    <input type="text" class="form-control" name="brand" value="<?php echo htmlspecialchars($brand); ?>" >
		    <div class="text-danger"><?php echo $errors['brand']; ?></div>		    
		  </div>
		  <div class="form-group">
		    <label for="model">Mobile Model</label>
		    <input type="text" class="form-control" name="model" value="<?php echo htmlspecialchars($model); ?>">
		    <div class="text-danger"><?php echo $errors['model']; ?></div>		    
		  </div>
		  <div class="form-group">
		    <label for="features">Mobile Features</label>
		    <input type="text" class="form-control" name="features" value="<?php echo htmlspecialchars($features); ?>">
		    <div class="text-danger"><?php echo $errors['features']; ?></div>		    
		  </div>
		  <div class="form-group">
		    <label for="email">Your Email</label>
		    <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
		    <div class="text-danger"><?php echo $errors['email']; ?></div>		    
		  </div>
		  <div class="form-group">
		    <label for="image">Image:</label>
		    <input type="file"  name="image" >
		    <div class="text-danger"><?php echo $errors['image']; ?></div>		    		    
		  </div>		  
		  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
		</form>
	</div>	

	<?php  include('templates/footer.php'); ?>


</html>