<?php
	session_start();
	if ($_SESSION['page']<$_SESSION['total_page']){
		$_SESSION['page']++;
	};
?>