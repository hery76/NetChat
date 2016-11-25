<?php
	if (file_exists("DB_connect.php")){
		require_once "DB_connect.php";
		$conn=DB_connect();
		$row=mysqli_fetch_array(mysqli_query($conn,"select database()"));
		$db_name=$row['database()'];
		mysqli_query($conn,"drop database ".$db_name.";");
		unlink("DB_connect.php");
		echo "<script>self.location=\"install.php\"</script>";
	}else{
		echo "<script>self.location=\"install.php\"</script>";
	}
?>