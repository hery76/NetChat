<?php
	if (file_exists("php\DB_connect.php")){
		require_once "php\DB_connect.php";
		$conn=DB_connect();
		$row=mysqli_fetch_array(mysqli_query($conn,"select database()"));
		$db_name=$row['database()'];
		mysqli_query($conn,"drop database ".$db_name.";");
		unlink("php\DB_connect.php");
		echo "<script>self.location=\"install.php\"</script>";
	}else{
		echo "<script>self.location=\"install.php\"</script>";
	}
?>