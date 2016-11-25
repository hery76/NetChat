<?php
	session_start();
	if ($_SESSION['article_page']<$_SESSION['article_total_page']){
		$_SESSION['article_page']++;
	};
?>