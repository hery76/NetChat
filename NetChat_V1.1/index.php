<?php session_start();?>
<html>
<head>
<title>TwTOnlineChat</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/public.css">
<script src="js/public.js" type="text/javascript"></script>
<script>
	add_load_event(content("content_home.php",0));
</script>
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
<div class="content" id="content">
</body>
</html>