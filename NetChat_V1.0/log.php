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
	<a href="/">&lt;&lt;返回首页</a>
</div>
<div class="content">
<?php
$username_error="";
if (!empty($_POST['username'])){
	if (!preg_match("/^[a-zA-Z \177-\377]*$/",$_POST['username'])){
		$username_error="*非法字符";
	};
};
if (!isset($_SESSION['user'])){
if (!isset($_POST['username']) || $username_error!=""){
$show='
<form id="log_form" action="log.php" method="post">
<table>
	<tr>
		<td>用户名:</td>
		<td><input type="text" name="username" required="required" /></td>	
	';
if ($username_error!=""){
	$show.='<td class="error">*非法字符</td>';
};
$show.='</tr><tr>
		<td>密码:</td>
		<td><input type="password" name="password" required="required" /></td>
	</tr>
</table>
<button type="submit">登陆</button>
</form>';
echo $show;
}else{
	//连接数据库
	$conn=DB_connect();
	$result=mysqli_query($conn,"SELECT name,password,sex from chat_user where name='".$_POST['username']."' and password='".md5($_POST['password'])."';");
		$row=mysqli_fetch_array($result);
		if (empty($row)){
			unset($_POST['username']);
			echo "<script>alert('密码或者用户名错误');window.history.back(-1);</script>";
		}else{
			$_SESSION['user']=$row['name'];
			$_SESSION['sex']=$row['sex'];
			echo "<script>self.location='/';</script>";
		}
};
}else{
	echo "<script>self.location='/';</script>";
}
?>
</div>
</body>
</html>