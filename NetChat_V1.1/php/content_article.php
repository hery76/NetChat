<?php
		session_start();
		require_once "DB_connect.php";
		$page_size=10;
		$conn=DB_connect();
		$result = mysqli_fetch_array(mysqli_query($conn,"select count(*) from chat_article_".$_GET['id'].";"));	
		$total_page= ceil($result[0]/$page_size);
		if ($total_page==0) $total_page=1;
		if ($_POST['page']<1) $_POST['page']=1;
		if ($_POST['page']>$total_page) $_POST['page']=$total_page;
		
		$result=mysqli_query($conn,'select * from chat_article_'.$_GET['id'].' order by id desc limit '.($_POST['page']-1)*$page_size.','.$page_size.";");
		while ($row =mysqli_fetch_assoc($result)){
			$show='<pre>'.$row['content'].'</br>';
			$show.='[@'.$row['author'].' '.date('Y.m.d',$row['time']);
			if (isset($_SESSION['user']) && ($_SESSION['user']=='admin' || $_SESSION['user']==$row['author'])){
				$show.=' <span class="delete" onclick="work(\'delete_content.php?aid='.$_GET['id']."&id=".$row['id'].'\')">撤销</span>';
			};
			$show.=']</pre>';
			echo $show;
		};
		echo '<div class="article_foot"><a onclick="content(\'content_article.php?id='.$_GET['id'].'\',-1)">上一页</a><a onclick="content(\'content_article.php?id='.$_GET['id'].'\',1)">下一页</a>当前页:'.$_POST['page'].' 总页数'.$total_page.'</div>';
		mysqli_free_result($result);
		mysqli_close($conn);
	?>