function work(str){

	if (window.XMLHttpRequest){
		var xhr=new XMLHttpRequest();
	}else{
		var xhr=new ActiveXObject("Microsoft.XMLHTTP");
	};
	
	xhr.onreadystatechange=function(){
		if (xhr.readyState==4 && xhr.status==200){
			window.location.reload();
		};
	};
	xhr.open("GET",str,true);
	xhr.send();
}

function reload_page(){
	window.location.reload();
}

function toggle(id,num){
	if (num==0){
		document.getElementById(id).style.display="none";
	}else{
		document.getElementById(id).style.display="block";
	}
}

function new_room(){
	toggle('new_room',1);
	toggle('mask_frame',1);
}

function hide_room(){
	toggle('new_room',0);
	toggle('mask_frame',0);
}

function new_content(){
	toggle('article_send',1);
	toggle('mask_article_send',1);
}

function close_content(){
	toggle('article_send',0);
	toggle('mask_article_send',0);
}




