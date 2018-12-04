<?php 
require_once "config/db.php"
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="wrapper_index">
		<header class="header">
			<h1><?php echo $config['title']; ?></h1>
		</header>

		<a href="/blog/views/addNewPost.php" class="addNewPost">Add new post</a>

		<div class="articles">

			<?php
				$articles = mysqli_query($db, "SELECT * 
												FROM articles 
												ORDER BY id DESC");
				while($article=mysqli_fetch_assoc($articles))
				{
					?>
						<div class=art>
							<?php	echo $article['title'];	?>
								<br>
							<?php	echo mb_substr($article['text'],0,300);	?>...
								<a href="/blog/views/articles.php?id=<?php echo $article['id']; ?>" class="read_more">Read more</a>
								<br>
								<br>
							<div id="editPost">
								<a href="/blog/views/editPost.php?id=<?php echo $article['id']; ?>" class="editPost">edit</a>
								<a href="/blog/views/deletePost.php?id=<?php echo $article['id']; ?>" class="delete">delete</a>
				
							</div>
						</div>
					<?php
				}
			?>
		</div>
	</div>
</body>
</html>