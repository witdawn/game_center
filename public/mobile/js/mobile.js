$(function(){
	var h = document.documentElement.clientHeight || document.body.clientHeight;
	var h2 = $('.actIndex').height();
	if(h2<h){
		$('.actIndex').height(h-40);
		// $('.actIndex').css({overflowY:hidden})
	}else{
		$('.actIndex').height()
	}
})
