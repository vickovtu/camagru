<?php

	class InstalController
	{
		public function actionIndex()
		{
			if (Db::show_bd())
			{
				Db::createData();
			}

			header("Location: /camagru/"); 
			return (true);
		}
		
	}
?>