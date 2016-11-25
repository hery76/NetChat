<?php session_start();
require_once "DB_connect.php";?>
<html>
<head>
<title>TwTOnlineChat</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/public.css">
<script src="js/public.js" type="text/javascript"></script>
</head>
<body>
<div class="header">
	<?php
		if (isset($_SESSION['user'])){
			$row='<span>';
			if ($_SESSION['sex']=='male'){
				$row.="TwT欧尼桑!";
			}else{
				$row.="TwT欧内桑!";
			};
			$row.=$_SESSION['user'].'</span>';
			echo $row;
			echo '<div class="exit" onclick="work(\'exit_session.php\')">退出</div>';
		}else{
			echo '<span>TwT欧尼桑/欧内桑！</span>';
			echo '<div class="log_reg"><a href="log.php">登陆</a>/<a href="reg.php">注册</a></div>';
		};
	?>
</div>
<div class="menu">
	<ul>	
		<?php
			if (isset($_SESSION['user'])){
				echo '<li><span onclick="new_room()">新建聊天室</span></li>';
			}else{
				echo '<li><span onclick="self.location=\'log.php\'">新建聊天室</span></li>';
			}
		?>
	</ul>
</div>
<div id="new_room">
	<span class="exit" onclick="hide_room()"><<返回</span>
	<form action="new_room.php" method="post">
		<table>
			<tr>
				<td><span>聊天室名:</span></td>
				<td><input type="text" name="room_name" required="required" /></td>
			</tr>
		</table>
		<button type="submit">新建</button>
	</form>
</div>
<div id="mask_frame">
</div>
<div class="content">
<?php 
	$page_size=4;
	$conn=DB_connect();
	if (empty($_SESSION['page'])){
		$_SESSION['page']=1;
	};
	$result=mysqli_query($conn,'select * from chat_article order by id desc limit '.($_SESSION['page']-1)*$page_size.','.$page_size.";");
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
	$result = mysqli_fetch_array(mysqli_query($conn,"select count(*) from chat_article"));
	$_SESSION['total_page'] = ceil($result[0]/$page_size);
	if ($_SESSION['total_page']==0){
		$_SESSION['total_page']=1;
	};
	echo '<div class="article_foot"><a onclick="work(\'page_dec.php\');">上一页</a>&nbsp;&nbsp;<a onclick="work(\'page_add.php\')">下一页</a>&nbsp;&nbsp;当前页:'.$_SESSION['page'].'&nbsp;&nbsp;总页数:'.$_SESSION['total_page'].'</div>';
	mysqli_close($conn);
?>
</div>
</body>
</html>