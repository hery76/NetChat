<?php
	require_once "php/DB_connect.php"
	if (!is_numeric($_GET['id'])){
		echo "Error URL";
		exit;
	};
	$conn=DB_connect();
	$sql='delete from chat_article where id='.$_GET['id'].';';
	mysqli_query($conn,$sql);
	$sql='drop database chat_article_'.$GET['id'].';';
	mysqli_query($conn,$sql);
	mysqli_close($conn);
?>