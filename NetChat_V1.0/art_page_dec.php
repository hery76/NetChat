<?php
	session_start();
	if ($_SESSION['article_page']>1){
		$_SESSION['article_page']--;
	}
?>;