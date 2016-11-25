<?php
	if (!is_numeric($_GET['id']) || !is_numeric($_GET['aid'])){
		echo "Error URL";
		exit;
	};
	$conn=mysqli_connect('localhost','root','205455','chat');
	$sql='delete from chat_article_'.$_GET['aid'].' where id='.$_GET['id'].';';
	mysqli_query($conn,$sql);
	mysqli_close($conn);
?>