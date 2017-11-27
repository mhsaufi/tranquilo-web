$(document).ready(function(){

	$('#addreviewarea').hide();

});

$('#addreview').click(function(){

	$('#addreviewarea').toggle();

});

$('#postreview').click(function(){

	var content = $('#reviewcontent').val();
	var user = $('#user_id').val();
	var url = $('#url').val();
	var deal_id = $('#deal_id').val();
	var _token = $('#_token').val();

	$.post(url,{content:content,user:user,deal:deal_id,_token:_token},function(data){

		$('#addreviewarea').hide();

		var str = '';
		var obj = JSON.parse(data);

		str += '<div id="userreview">';
		str += '<h4>'+obj.name+'</h4>';
		str += '<small><em>posted on '+ obj.review_date +'</em></small><br><br>';
		str += '<p>'+ obj.review_content +'</p><hr>';
		str += '</div>';

		$('#reviewsection').prepend(str);

	});

});