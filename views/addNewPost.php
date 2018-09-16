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
	<?php
		if(isset($_POST['add_new_post']))
		{
			$title = strip_tags(trim($_POST['title']));
			$text = strip_tags(trim($_POST['text']));
			$now = date('Y-m-d H:i:s');
			mysqli_query($db,"	INSERT INTO `articles` 
								(`title`,`text`,`publdate`) 
								VALUES ('$title','$text','$now')");
		}
	?>
	<div class="wrapper_addNewPost">
		<h3>Add/Edit Post</h3>
			<form action="/blog/views/addNewPost.php" method="post" name="add_new_post" id="add_new_post">
				<input type="text" name="title" placeholder="Post Title">
				<br>
				<br>
				<textarea placeholder="Post content" name="text"></textarea>
				<div class="btn">
					<input type="button" name="cansel" value="cansel" id="cansel" onClick="location.href='../index.php'">
					<input type="submit" name="add_new_post" value="save" id="send_new_post">
				</div>	
			</form>


	</div>
</body>
</html>