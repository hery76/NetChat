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
	};
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
<div class="article_content">
	<?php
		$page_size=10;
		$conn=mysqli_connect('localhost','root','205455','chat');
		$result = mysqli_fetch_array(mysqli_query($conn,"select count(*) from chat_article_".$_GET['id'].";"));	
		$_SESSION['article_total_page'] = ceil($result[0]/$page_size);
		if ($_SESSION['article_total_page']==0){
			$_SESSION['article_total_page']=1;
		};
		if (empty($_SESSION['article_page'])){
			$_SESSION['article_page']=1;
		};
		
		$result=mysqli_query($conn,'select * from chat_article_'.$_GET['id'].' order by id desc limit '.($_SESSION['article_page']-1)*$page_size.','.$page_size.";");
		while ($row =mysqli_fetch_assoc($result)){
			$show='<pre>'.$row['content'].'</br>';
			$show.='[@'.$row['author'].' '.date('Y.m.d',$row['time']);
			if (isset($_SESSION['user']) && ($_SESSION['user']=='admin' || $_SESSION['user']==$row['author'])){
				$show.=' <span class="delete" onclick="work(\'delete_content.php?aid='.$_GET['id']."&id=".$row['id'].'\')">撤销</span>';
			};
			$show.=']</pre>';
			echo $show;
		};
		echo '<div class="article_foot"><a onclick="work(\'art_page_dec.php\')">上一页</a><a onclick="work(\'art_page_add.php\')">下一页</a>当前页:'.$_SESSION['article_page'].' 总页数'.$_SESSION['article_total_page'].'</div>';
		mysqli_free_result($result);
		mysqli_close($conn);
	?>
</div>
</body>
</html>