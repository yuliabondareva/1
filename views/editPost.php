<?php 
require_once "../config/db.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
	<div class="wrapper_addNewPost">
		<h3>Add/Edit Post</h3>
			
			<?php
				$id = $_GET['id'];
					$articles = mysqli_query($db, "	SELECT `title`,`text` 
													FROM `articles` 
													WHERE id='$id'");
					$article = mysqli_fetch_assoc($articles);
					if(isset($_POST['edit_post']))
					{
						$title = strip_tags(trim($_POST['title']));
						$text = strip_tags(trim($_POST['text']));
						mysqli_query($db,"	UPDATE `articles`
											SET title = '$title', text = '$text'
											WHERE id='$id'");
					}
				?>
			<form method="post" action="/blog/views/editPost.php?id=<?php echo $id; ?>" name="edit_post" id="edit_post">
				<input type="text" name="title" value="<?php echo $article['title']; ?>">
				<br>
				<br>
				<textarea name="text"><?php echo $article['text']; ?></textarea>
				<div class="btn">
					<input type="button" name="cansel" value="cansel" id="cansel" onClick="location.href='../index.php'">
					<input type="submit" name="edit_post" value="save" id="edit_post">
				</div>	
			</form>


	</div>
</body>
</html>