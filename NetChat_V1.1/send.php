<?php
	session_start();
	require_once "php/DB_connect.php";
	if (!is_numeric($_GET['id'])){
		echo "Error URL";
		exit;
	};
	$conn=DB_connect();
	function replace(&$str){	
		$str=str_replace(";","&#".ord(';').";",$str);
		for ($j=1;$j<127;++$j){
			$i=chr($j);
			if (!(($i>='a' && $i<='z') || ($i>='A' && $i<='Z') || ($i>='0'&& $i<='9') || ($i=='&') || ($i=='#') || ($i==';')) ){
				$str=str_replace($i,"&#".$j.";", $str);
			};
		};
	};
	replace($_POST['content']);
	$sql="insert into chat_article_".$_GET['id']." (author,content,time) values ('";
	$sql.=$_SESSION['user']."','".$_POST['content']."',".time().");";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
	echo "<script>self.location='/article.php?id=".$_GET['id']."';</script>";
?>