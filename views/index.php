<?php include ROOT.'/views/header.php';?>
<section class="wrap">
		<?php foreach ($camagruList as $foto): ?>
		<a href="/camagru/<?php echo $foto['id'] ?>" class="foto"><div class="autor">autor:<span class="name"><?php echo $foto['autor'] ?></span></div><img src="<?php echo $foto['img']?>"></a>
		<?php endforeach; ?>
</section>
<?php include ROOT.'/views/footer.php';?>
</body>
</html>