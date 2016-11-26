<?php session_start();?>
<html>
<head>
<title>TwTOnlineChat</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/public.css">
<script src="js/public.js" type="text/javascript"></script>
</head>
<body>
<?php
if (!is_numeric($_GET['id'])){
		echo "<span class='error'>Error URL</span>";
		exit;
	}else{
		echo "<script>add_load_event(content(\"content_article.php?id=".$_GET['id']."\",0));</script>";
	}
?>
<div class="header">
	<?php
		if (isset($_SESSION['user'])){
			$row='<span>';
			if ($_SESSION['sex']=='male'){
				$row.="欧尼桑!";
			}else{
				$row.="欧内桑!";
			};
			$row.=$_SESSION['user'].'</span>';
			echo $row;
			echo '<div class="exit" onclick="work(\'exit_session.php\')">退出</div>';
		}else{
			echo '<span>欢迎欧尼桑/欧内桑！</span>';
			echo '<div class="log_reg"><a href="log.php">登陆</a>/<a href="reg.php">注册</a></div>';
		};
	?>
</div>
<div class="menu">
	<ul>
		<li><span><a href="/">返回首页>></a></span></li>
		<li><span onclick="new_content()">发言</span></li>
	</ul>
</div>
<div id="article_send">
	<div class="exit" onclick="close_content()"><<返回</div>
	<div>
		<?php echo '<form action="send.php?id='.$_GET['id'].'" method="post">';?>
		<?php 
			if (isset($_SESSION['user'])){
				echo '<textarea name="content"></textarea><button type="submit">发言</button>';
			}else{
				echo '<script>self.location="log.php"</script>';
			}
		?>
		</form>
		
	</div>
</div>
<div id="mask_article_send">
</div>
<div class="article_content" id="content">
</div>
</body>
</html>