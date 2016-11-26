<?php session_start();?>
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
if (!empty($_POST['username']) && !preg_match("/^[a-zA-Z \177-\377]*$/",$_POST['username'])){
	$username_error="*非法字符";
};
if (!isset($_SESSION['user'])){
if (!isset($_POST['username']) || $username_error!=""){
echo '
<form id="reg_form" action="reg.php" method="post">
<table>
	<tr>
		<td>用户名:</td>
		<td><input type="text" name="username" required="required" /></td>
';
if ($username_error!=""){
	echo '<td class="error">'.$username_error.'</td>';
}
echo '
	</tr>
	<tr>
		<td>密码:</td>
		<td><input type="password" name="password" required="required" /></td>
	</tr>
	<tr>
		<td>确认密码:</td>
		<td><input type="password" name="verfy_password" required="required" /></td>
	</tr>
	<tr>
		<td>如何称呼您？</td>
		<td>欧尼桑<input type="radio" name="sex" required="required" value="male"/></td>
		<td>欧内桑<input type="radio" name="sex" required="required" value="female"/></td>
	</tr>
</table>
<button type="submit">注册</button>
</form>';
}else{
	//连接数据库
	require_once "php/DB_connect.php";
	if ($_POST['password']!=$_POST['verfy_password']){
		echo "<script>alert('密码不一致');self.location='/reg.php';</script>";
		exit;
	};
	$conn=DB_connect();
	$result=mysqli_query($conn,"SELECT name from chat_user where name='".$_POST['username']."';");
		$row=mysqli_fetch_array($result);
		if (!empty($row)){
			unset($_POST['username']);
			mysqli_close($conn);
			echo "<script>alert('该用户已被注册');window.history.back(-1);</script>";
			exit;
		}else{
			$result=mysqli_query($conn,"insert into chat_user (name,password,sex) values ('".$_POST['username']."','".md5($_POST['password'])."','".$_POST["sex"]."');");
			$_SESSION['user']=$_POST['username'];
			$_SESSION['sex']=$_POST['sex'];
			mysqli_close($conn);
			echo "<script>alert('注册成功');self.location='/';</script>";
		}
};
};
?>
</div>
</body>
</html>