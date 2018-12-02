
<?php include ROOT . '/views/header.php'; ?>
<section class="wrap">
	<div id="foto" class="foto" name="<?php echo $foto['id'] ?>">
		<div class="autor">autor:<span class="name"><?php echo $foto['autor'] ?></span></div>
		<img src="<?php echo $foto['img']?>">
	</div>
	<div class="comment foto" >
		<div id="cont">
			<?php foreach ($commentsList as $comment): ?>
			<div class="commentin"><span class="name"><?php echo $comment['name'] ?></span>: <?php echo $comment['comment'] ?></div>
			<?php endforeach; ?>
		</div>
		<div>
			<div id="addCommentContainer">
				<input type="text"   id="comment" placeholder="Комментарий" class="textbox" required/>
				<input type="submit" id="submit" value="Отправить" class="button" required/>
			</div>
			<div id="addLikes">
				<img  id="like" src="/template/img/<?php if ($likeUser === false): ?>like.svg
				<?php else: ?>heart.svg
				<?php endif; ?>
				" alt="like">
				<p id="count" data_name="<?php echo $colLike ?>"><?php echo $colLike ?></p>
			</div>
		</div>
		
	</div>
</div>
</section>
    <?php include ROOT.'/views/footer.php';?>
    </body>
	<script type="text/javascript" src="/template/js/comment.js"></script>
	<script type="text/javascript" src="/template/js/like.js"></script>
</html>