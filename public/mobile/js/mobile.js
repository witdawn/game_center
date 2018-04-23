$(function(){
	var h = $(window).height();
	var h2 = $('.actIndex').height();
	if(h2<h){
		$('.actIndex').css({position:'fixed',width:'100%',height:'100%'});
	}else{
		$('.actIndex').css({position:'relative',height:'auto'})
	}
})

