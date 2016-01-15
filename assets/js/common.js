
function toDetails(id,type){
	location.href = type+'.php?id='+id;
	
}


 
function toList(type,pathid){
	
	var item = null,id = null;
	item = pathid.indexOf('path');
	id = pathid.substr(item+5);
	
	switch(type){
		case '云故乡':location.href = 'view'+'list.php?pathid='+id+'&pagename='+type;
		break;
		case '云梦乡':location.href = 'hotel'+'list.php?pathid='+id+'&pagename='+type;
		break;
		case '云厨秀':location.href = 'restaurant'+'list.php?pathid='+id+'&pagename='+type;
		break;
		case '云市集':location.href = 'shop'+'list.php?pathid='+id+'&pagename='+type;
		break;
		case '云旅社':location.href = 'travel'+'list.php?pathid='+id+'&pagename='+type;
		break;
		default:
		break;
	}
	

}

function toClear(){
	var history =location.pathname+location.search;
//	console.log('clear.php?history='+history);
	location.href = 'clear.php?history='+history;
}

