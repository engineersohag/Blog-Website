<?php include 'header.php';
if ($admin != 1) {
   header("location:index.php");
} 

if (isset($_SESSION['user_data'])) {
	$author_id = $_SESSION['user_data']['0'];
}

$sql = "SELECT * FROM categories";
$query = mysqli_query($con, $sql);

?>

	<div class="container">
		<!-- Page Heading -->
      <h5 class="mb-2 text-gray-800">Blogs</h5>

      <div class="row">
      	<div class="col-xl-7 col-lg-5">
      		<div class="card">
      			<div class="card-header">
      				<h6 class="font-weight-bold text-primary mt-2">Publish Blogs/Article</h6>
      			</div>
      			<div class="card-body">
      				<form action="" method="POST" enctype="multipart/form-data">
      					<div class="mb-3">
      						<input type="text" name="blog_title" placeholder="Title" class="form-control" required>
      					</div>
      					<div class="mb-3">
      						<label for="">Body/Description:</label>
      						<textarea name="blog_body" id="blog" class="form-control" rows="2" required></textarea>
      					</div>
      					<div class="mb-3">
      						<input type="file" name="blog_image" class="form-control" required>
      					</div>
      					<div class="mb-3">
      						<select name="category" class="form-control" required id="">
      							<option value="">Select Category</option>
      							<?php while ($cats = mysqli_fetch_assoc($query)) { ?>
      							<option value="<?= $cats['cat_id'] ?>"><?= $cats['cat_name'] ?></option>
	      						<?php } ?>
      						</select>
      					</div>
      					<div class="mb-3">
      						<input type="submit" name="add_blog" value="Add" class="btn btn-primary">
      						<a href="index.php" class="btn btn-secondary">Back</a>
      					</div>
      				</form>
      			</div>
      		</div>
      	</div>
      </div>
	</div>

<?php include 'footer.php'; 

if (isset($_POST['add_blog'])) {
	$title = mysqli_real_escape_string($con, $_POST['blog_title']);
	$body = mysqli_real_escape_string($con, $_POST['blog_body']);
	$file_name = $_FILES['blog_image']['name'];
	$tmp_name = $_FILES['blog_image']['tmp_name'];
	$size = $_FILES['blog_image']['size'];
	$image_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
	$allow_type = ['jpg','png','jpeg'];
	$destination = "upload/".$file_name;
	$category = mysqli_real_escape_string($con,$_POST['category']);

	if(in_array($image_ext, $allow_type)){
		if ($size <= 2000000){
			move_uploaded_file($tmp_name, $destination);
			$sql2 = "INSERT INTO `blog`(`blog_title`, `blog_body`, `blog_img`, `category`, `author_id`) VALUES ('$title','$body','$file_name','$category','$author_id')";
			$query2 = mysqli_query($con, $sql2);
			if($query2){
				$msg = ['😊 Post published successfully.', 'alert-success'];
				$_SESSION['msg'] = $msg;
				header("location:add_blog.php");
			}else{
				$msg = ['⚠ Failed, Pleace try again!!😕', 'alert-danger'];
				$_SESSION['msg'] = $msg;
				header("location:add_blog.php");
			}
		}else{
			$msg = ['Image size should not be greater than 2MB', 'alert-danger'];
			$_SESSION['msg'] = $msg;
			header("location:add_blog.php");
		}
	}else{
		$msg = ['File type is not allowed (only jpg,png and jpeg)', 'alert-danger'];
		$_SESSION['msg'] = $msg;
		header("location:add_blog.php");
	}
}


?>