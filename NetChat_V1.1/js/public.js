
function initXTML(){
	var xhr=null;
	if (window.XMLHttpRequest){
		xhr=new XMLHttpRequest();
	}else{
		xhr=new ActiveXObject("Microsoft.XMLHTTP");
	};
	return xhr;
}

function work(str){
	var xhr=initXTML();
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

function add_load_event(func){
	var oldonload=window.onload;
	if (typeof window.onload!="function"){
		window.onload=func;
	}else{
		window.onload=function(){
			oldonload();
			func();
		};
	};
}

function content(url,num){
	var page=1;

	if (document.getElementById('page')!=undefined){

		page=parseInt(document.getElementById('page').innerHTML);
		
	};

	page+=num;

	var xhr=initXTML();

	xhr.onreadystatechange=function(){

		if (xhr.readyState==4 && xhr.status==200){
			
			document.getElementById('content').innerHTML=xhr.responseText;
		};
	};
	xhr.open("POST","php/"+url,true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("page="+page);
	
}




