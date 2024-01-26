<?php include "header.php"; 
include "config.php";
$id = $_GET['id'];
if (empty($id)){
	header("location:index.php");
}
$sql = "SELECT * FROM blog WHERE blog_id='$id'";
$query = mysqli_query($con, $sql);
$post = mysqli_fetch_assoc($query);
?>

<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div class="card shadow">
				<div class="card-body" >
					<div id="single_img">
						<?php $img = $post['blog_img'] ?>
						<a href="admin/upload/<?=$img?>">
							<img src="admin/upload/<?=$img?>" alt="..">
						</a>
					</div>
					<hr>
					<div>
						<h5><?= ucfirst($post['blog_title']) ?></h5>
						<p><?= $post['blog_body'] ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php include 'sidebar.php' ?>
	</div>
</div>

<?php include "footer.php" ?>