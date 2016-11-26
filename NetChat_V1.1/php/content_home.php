<?php
	session_start();
	require_once "DB_connect.php";
	$conn=DB_connect();
	$page_size=5;
	$result = mysqli_fetch_array(mysqli_query($conn,"select count(*) from chat_article"));
	$tot_page= ceil($result[0]/$page_size);
	if ($tot_page==0) $tot_page=1;
	if ($_POST['page']>$tot_page) $_POST['page']--;
	if ($_POST['page']<1) $_POST['page']++;
	$result=mysqli_query($conn,'select * from chat_article order by id desc limit '.($_POST['page']-1)*$page_size.','.$page_size.";");
	while ($row =mysqli_fetch_assoc($result)){
		$show='<div class="article"><span>'.$row['author'].'的聊天室</span>';
		$show.='</br><a href="article.php?id='.$row['id'].'">'.$row['title'].'</a><span>'.date("Y.m.d",$row['time']).'</span>';
		if (isset($_SESSION['user']) && ($_SESSION['user']==$row['author'] || $_SESSION['user']=='admin')){
			$show.='[<span class="delete" onclick="work(\'delete_room.php?id=';
			$show.=$row['id'].'\')">删除</span>]';
		};
		$show.='</div>';
		echo $show;
	};
	mysqli_free_result($result);
	echo '<div class="article_foot"><a onclick="content(\'content_home.php\',-1)">上一页</a>&nbsp;&nbsp;<a onclick="content(\'content_home.php\',1);">下一页</a>&nbsp;&nbsp;当前页:<span id="page">'.$_POST['page'].'</span>&nbsp;&nbsp;总页数:'.$tot_page.'</div>';
	mysqli_close($conn);
?>