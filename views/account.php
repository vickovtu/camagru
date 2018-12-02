<?php include ROOT.'/views/header.php';?>

<section class="wrap">
	<div class="user">
		<div class="foto"><img src="
			<?php if( isset($fotoList[0])):
			echo $fotoList[0]['img'];
			else:
			echo "/template/img/un.jpg";
			endif ?>"></div>
		<div class="info">
			<div class="name">User Name: <?php echo $user['name']?> </div>
			<div class="email">User Email: <?php echo $user['email']?></div>
			<div class="edit"><a href="/account/edit">Изменить данные</a></div>
			<div class="edit"><a href="/account/delete">Удалить аккаунт</a></div>
		</div>
	</div>
	</section>
	<section class="wrap">
			<?php if (!empty($fotoList)): ?>
			<?php foreach ($fotoList as $foto): ?>
    <div class="foto_ac" >
             <a href="/camagru/<?php echo $foto['id'] ?>">  <img src="<?php echo $foto['img']?>"></a>
			<img name="delete"  class="delete" id="<?php echo $foto['id'] ?>" src="/template/img/delete.svg">
    </div>
        	<?php endforeach; ?>
        <?php endif; ?>

</section>
</div>
	<?php include ROOT.'/views/footer.php';?>
	<script type="text/javascript" src="/template/js/delete.js"></script>
    </body>
</html>
