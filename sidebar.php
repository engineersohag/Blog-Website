<?php include "config.php"; 
$select = "SELECT * FROM categories";
$querys = mysqli_query($con, $select);
// --- Recent Post ---
$select2 = "SELECT * FROM blog ORDER BY publish_date DESC limit 5";
$querys2 = mysqli_query($con, $select2);
?>
<div class="col-lg-4">
	<div class="card">
		<div class="card-body d-flex right-section">
			<div id="categories">
				<h6>Categories</h6>
				<ul>
					<?php while ($cats=mysqli_fetch_assoc($querys)){?>
					<li>
						<a href="category.php?id=<?= $cats['cat_id']?>" class="text-primary fw-blod">
							<?= $cats['cat_name'] ?>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		    <div id="posts">
				<h6>Recent Posts</h6>
				<ul>
					<?php while ($posts=mysqli_fetch_assoc($querys2)){?>
					<li>
						<a href="single_post.php?id=<?= $posts['blog_id'] ?>" class="text-dark fw-bold"><?= ucfirst($posts['blog_title']) ?></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>