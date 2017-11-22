var str = '<i class="fa icon-bookmark tranquilo-bookmark-property-checked" title="you bookmark this"></i>';

function bookmarkThis(deal,url){

	$.post(url,{deal:deal},function(){
		$('#tranquilo-bookmark-'+deal).html(str);
	});
}