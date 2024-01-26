<?php 
include 'header.php';
include 'config.php';
$id=$_GET['id'];
if(empty($id)){
	header("location:index.php");
}
$sql = "SELECT * FROM blog LEFT JOIN categories ON blog.category=categories.cat_id LEFT JOIN user ON blog.author_id=user.user_id WHERE cat_id='$id' ORDER BY blog.publish_date DESC";
$run = mysqli_query($con, $sql);
$rows = mysqli_num_rows($run);


?>

	<div class="container mt-2">
		<div class="row">
			<div class="col-lg-8">
				<?php  
				if($rows){
					while($result = mysqli_fetch_assoc($run)){
				?>
				<div class="card shadow">
					<div class="card-body d-flex blog_flex">
						<div class="flex-part1">
							<a href="single_post.php?id=<?= $result['blog_id']?>"> 
								<?php $img=$result['blog_img'];?>
								<img src="admin/upload/<?= $img ?>"> 
							</a>
						</div>
						<div class="flex-grow-1 flex-part2">
							  <a href="single_post.php?id=<?= $result['blog_id']?>" id="title" class="text-dark">
							  	<?= ucfirst($result['blog_title']) ?>
							  </a>
							<p>
							  <a href="single_post.php?id=<?= $result['blog_id']?>" id="body">
							  	<?= strip_tags(substr($result['blog_body'], 0,200))."..." ?>
							  </a> <span><br>
	                          <a href="single_post.php?id=<?= $result['blog_id']?>" class="btn mt-2 btn-sm btn-outline-primary">Continue Reading
	                          </a></span>
	                        </p>
							<ul>
								<li class="me-2"><a href="" class="text-secondary"> <span>
	                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></span><?= $result['username'] ?></a>
								</li>
								<li class="me-2">
									<a href="" class="text-dark"> <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span> <?= date('d-M-Y',strtotime($result['publish_date'])) ?> </a>
								</li>
								<li>
									<a href="" class="text-primary"> <span><i class="fa fa-tag" aria-hidden="true"></i></span> <?= $result['cat_name'] ?> </a>
							    </li>
							</ul>
						</div>
					</div>
				</div>
				<?php } } ?>
			</div>
			<?php include "sidebar.php" ?>
		</div>
	</div>

<?php include 'footer.php' ?>