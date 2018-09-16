<?php 
require_once "../config/db.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="../style.css">	
	<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript">
			$(function() {
				$("#send").onclick(function() {
							var name_user = document.getElementById("name_user").value;
							var name_user = document.getElementById("email_author").value;
							var name_user = document.getElementById("text_comment").value;
							$.ajax({
								url: "articles.php",
								type: "POST",
								data: add_comm,						
								success: function(data){
							       $('#comment').html(data);
							     } 
					});
					return false;			
				});
			});
		</script>
</head>
<body>
	<div class="wrapper_articles">
		<div>
			<?php
				$id = $_GET['id'];
					$articles = mysqli_query($db, "	SELECT * 
													FROM articles 
													WHERE id='$id'");
					$article=mysqli_fetch_assoc($articles);
				if($article!=NULL){
			?>
					<hr align="center" width="100%" size="1" color="black">
						<div class=article_text>
							<h2><?php	echo $article['title'];	?></h2>
								<br>
							<img class="article_image" src="../images/<?php echo $article['image']; ?>" width="300">
								<br>
							<?php	echo $article['text'];	?>		
						</div>
					<hr align="center" width="100%" size="1" color="black">
					<br>
			<?php
				} else{
					echo "<h2>Данная статья не существует!<h2>";
					echo "<a href='../index.php'>Вернуться на главную страницу<a>";
				}
			?>
		</div>
		<div id="coment-add-form">
			<?php
				if($article!=NULL){
			?>
				<h1>Add comments</h1>
					<span>Fields markes as * is requared</span>
				<form action="/blog/views/articles.php?id=<?php echo $article['id']; ?>#coment-add-form" method="post" name="form" id="form">
					<?php 
						if(isset($_POST['add_post'])){
							$errors = array();
							if($_POST['name_user']==''){
								$errors[]='Введите Ваше имя';
							}
							if($_POST['email_author']==''){
								$errors[]='Введите Ваш email';
							}
							if($_POST['text_comment']==''){
								$errors[]='Введите текст комментария';
							}
							if(empty($errors))
							{
								mysqli_query($db,"	INSERT INTO 
													`comments` (`name_user`,`email_author`,`text_comment`,`articles_id`)
													VALUES ('".
													mysqli_real_escape_string($db,$_POST['name_user'])."','".
													mysqli_real_escape_string($db,$_POST['email_author'])."','".
													mysqli_real_escape_string($db,$_POST['text_comment'])."','".
													mysqli_real_escape_string($db,$article['id'])."')");

								echo '<span style="color:green; font-weight:bold;">Комментарий успешно добавлен</span>';
							}else{
								echo '<span style="color:red; font-weight:bold;">'. $errors['0']. '</span>';
							}
						}
					?>
					<div class="field">
						<label>name*</label>
							<input name="name_user" type="text" size= "40" id="name_user" value="<?php echo isset($_POST['name_user']) ? htmlspecialchars($_POST['name_user']) : '' ; ?>" required>
					</div>
					<div class="field">
						<label>email*</label>
							<input name="email_author" type="email" size="40" id="email_author" value="<?php echo isset($_POST['email_author']) ? htmlspecialchars($_POST['email_author']) : ''; ?>" required>
					</div>
					<div class="field">
						<label>Comment* </label>
						<br>
							<textarea wrap="off" name="text_comment" rows="3" style="width:99%;" id="text_comment" placeholder="Текст комментария" required><?php echo isset($_POST['text_comment']) ? htmlspecialchars($_POST['text_comment']) : ''; ?></textarea>
					<div>
					<div class="field">
							<input type="submit" name="add_post" value="send comment" id="send"> 
					</div>
				</form>	
			<?php
				}
			?>
		</div>

		<div>
			<?php
				if($article!=NULL){
			?>
				<h3>Comments 
					(<?php
						$view = mysqli_query($db,"	SELECT COUNT(*) AS 'count' 
													FROM comments 
													WHERE articles_id=". $_GET['id']);
						$row = mysqli_fetch_array($view, MYSQLI_ASSOC);
						echo $row['count'];
					?>)
				</h3>
					<?php
					$comments = mysqli_query($db, "	SELECT * 
													FROM comments 
													WHERE articles_id=".$_GET['id']." 
													ORDER BY id DESC");
							if(mysqli_num_rows($comments)<=0){
								echo "К этой статье нет комментариев";
							}

							while($comment=mysqli_fetch_assoc($comments))
								{
									?>
										<div id=comment>
											<div class="comment__image">
												<img src="../images/smile.jpg" width="60">
											</div>
											<div class="comment__param">
												<div class="comment__name_user">
													<?php	echo $comment['name_user'];	?>
												</div>
												<div class="comment__email_author">
													<?php	echo $comment['email_author'];	?>
												</div>
												<div class="comment__text_comment">
													<?php	echo ($comment['text_comment']);	?>
												</div>
											</div>
										</div>
									<?php
							}
					?>
			</div>
		<?php
			}
		?>	
	</div>
</body>
</html>