<?php 
require_once "../config/db.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="../style.css">	
</head>
<body>
	<div class="wrapper_addNewPost">
		<h3>Delete Post</h3>
			
			<?php
				$id = $_GET['id'];
					$articles = mysqli_query($db, "	SELECT `title`,`text` 
													FROM `articles` 
													WHERE id='$id'");
					$article = mysqli_fetch_assoc($articles);
					if(isset($_POST['delete_post']))
					{
				
						mysqli_query($db,"	DELETE
											FROM `articles`
											WHERE id='$id'");

						echo "Пост удален";
						echo '<script>setTimeout("location.replace(/blog/)", 1000);</script>'; exit;

					}
				?>
			<form method="post" action="/blog/views/deletePost.php?id=<?php echo $id; ?>" name="delete_post" id="delete_post">
				<div name="title"><?php echo $article['title']; ?></div>
				<br>
				<br>
				<div name="text"><?php echo $article['text']; ?></div>
				<div class="btn">
					<input type="button" name="cansel" value="cansel" id="cansel" onClick="location.href='../index.php'">
					<input type="submit" name="delete_post" value="delete" id="delete_post">
				</div>	
			</form>


	</div>
</body>
</html>