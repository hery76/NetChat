<?php
	session_start();
	require_once "php/DB_connect.php";
	function replace(&$str){
		$str=str_replace(";","&#".ord(';').";",$str);
		for ($j=1;$j<127;++$j){
			$i=chr($j);
			if (!(($i>='a' && $i<='z') || ($i>='A' && $i<='Z') || ($i>='0'&& $i<='9') || ($i=='&') || ($i=='#') || ($i==';')) ){
				$str=str_replace($i,"&#".$j.";", $str);
			};
		};
		return $str;
	};
	replace($_POST['room_name']);
	$conn=DB_connect();
	$sql="insert into chat_article (author,title,time) values ('";
	$now_time=time();
	$sql.=$_SESSION['user']."','".$_POST['room_name']."','".$now_time."');";
	mysqli_query($conn,$sql);
	$result=mysqli_query($conn,"select id from chat_article where author='".$_SESSION['user']."' and time=".$now_time.";");
	$row=mysqli_fetch_array($result);
	$sql="create table chat_article_".$row['id']." (id INT NOT NULL AUTO_INCREMENT,author VARCHAR(255),content text,time BIGINT,PRIMARY KEY (id));";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
	echo "<script>self.location='/';</script>";
?>
	
