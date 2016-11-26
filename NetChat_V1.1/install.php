<html>
<head>
<title>安装界面</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/default.css">
<script>
	function run_load(progress){
		var content=document.getElementById("load");
		content.innerHTML+=progress;
	}
</script>
</head>
<body >
<?php
	if (!file_exists("php\DB_connect.php")){
		if (empty($_POST['mysql_username'])){
			echo '
				<div class="form_default center normal_white">
					<span class="header">TwT INSTALL</span>
					<form action="install.php" method="post">
						<table class="normal_white">
							<tr>
								<td>MYSQL用户名:</td>
								<td><input type="text" name="mysql_username" required="required"/></td>		
							</tr>
							<tr>
								<td>MYSQL密码:</td>
								<td><input type="password" name="mysql_password" required="required"/></td>
							</tr>
							<tr>
								<td>MYSQL数据库:</td>
								<td><input type="text" name="mysql_database" required="required"/></td>
							</tr>
						</table>
						<button class="button_default">
							安装
						</button>
					</form>
				</div>
			';
		}else{
			if (@!($conn=mysqli_connect("localhost",$_POST['mysql_username'],$_POST['mysql_password']))){
				echo '<div class="pop_up_default_background"></div>
					<div class="pop_up_default error">
						<span class="normal_white exit" onclick="window.history.back(-1)">返回</span>
						</br>数据库连接错误！</br>
						请检查您的信息是否填写正确.
					</div>
					<div class="mask"></div>
				';
			}else{
				$sql="use ".$_POST['mysql_database'].";";
				if (@!mysqli_query($conn,$sql)){
					mysqli_query($conn,"create database ".$_POST['mysql_database'].";");
					mysqli_query($conn,"use ".$_POST['mysql_database'].";");
				};
				echo '<div class="pop_up_default_background"></div>
					<div id="pop_up_content" class="pop_up_default normal_white">		
						</br>数据库连接成功！</br>
						安装中</br><span id="load"></span>
					</div>
					<div class="mask"></div>
				';
				$begin_time=time();
				echo "<script>setTimeout('run_load(\"创建DB数据库连接文件</br>\")',500)</script>";
				$file=fopen("php\DB_connect.php","w");
				fwrite($file,"<?php\nfunction DB_connect(){\n  return mysqli_connect(\"localhost\",\"".$_POST['mysql_username'].'","'.$_POST['mysql_password'].'","'.$_POST['mysql_database']."\");\n};\n?>");
				fclose($file);
				echo "<script>setTimeout('run_load(\"创建用户列表</br>\")',1000)</script>";
				mysqli_query($conn,"create table chat_user (id int not null auto_increment,name varchar(255) not null,password varchar(255) not null,sex varchar(10) not null,primary key (id));");
				echo "<script>setTimeout('run_load(\"创建聊天室列表</br>\")',1500);</script>";
				mysqli_query($conn,"create table chat_article(id int not null auto_increment,author varchar(255) not null,title varchar(255) not null,time bigint(20) not null,primary key (id));");
				$tot_time=time()-$begin_time;
				echo "<script>setTimeout('run_load(\"用时:".$tot_time."毫秒</br>\")',2000);;setTimeout(\"self.location='install.php'\",5000);</script>";
			};
		};
	}else{
		echo '<div class="pop_up_default_background"></div>
				<div class="pop_up_default normal_white">		
					</br>数据库已经设置成功。</br>
					<form action="uninstall.php" method="post">
					<button class="button_default">重置</button>
					</form>
					</div>
					<div class="mask"></div>
				';
	};
?>
</body>
</html>