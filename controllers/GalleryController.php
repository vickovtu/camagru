<?php

	class GalleryController
	{

		public function actionList($page)
		{
			if ($page == NULL)
				$page = "page-1";
			$page = intval(explode('-', $page)[1]);

			$gallery = array();
			$gallery = Gallery::getGalleryList($page);
			$total = Gallery::getTotalFoto();

			$pagination = new Pagination($total, $page, Gallery::SHOW_BY_DEFAULT, 'page-');

			require_once(ROOT.'/views/gallery.php');
			return (true);
		}
		
	}
?>