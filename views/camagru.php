<?php include ROOT.'/views/header.php';?>
<section class="wrap">
		<div class="item">
				<span class="name">video</span>
				<video id="video" width="320" height="240" autoplay="autoplay"></video>
				<button type="button" id="button" name="button"><img  width="50px" src="/template/img/foto.png"></button>
		</div>
		<div class="item">
			<span class="name">foto</span>
				<canvas id="canvas" width="320" height="240"></canvas>
				<div class="conteiner">
					<button type="button" id="button1" name="button1">sepia</button>
					<button type="button" id="button2" name="button2"><img  width="50px" src="/template/img/w.png"></button>
					<button type="button" id="frame" name="frame"><img  height="50px" src="/template/img/r1.png"></button>
					<button type="button" id="frame2" name="frame"><img  height="50px" src="/template/img/r4.png"></button>
					<button type="button" id="frame3" name="frame"><img  width="50px" src="/template/img/r5.png"></button>
					<button type="button" id="reset" name="frame">reset</button>
					<button type="button" id="save" name="save">save</button>
				</div>
			</div>
</section>
<section class="wrap">
	<div id="output"></div>
</section>
<?php include ROOT.'/views/footer.php';?>
	
</body>
<script type="text/javascript" src="/template/js/putfoto.js"></script>
</html>