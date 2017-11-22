
var str = '<i class="icon-star icon-2x rate rate-checked"></i>';

var rate_url = $('#rate_url').val();
var user_id = $('#user_id').val();
var model_id = $('#model_id').val();

$('#rate-1').hover(function(){
	$(this).css("color", "orange");
},function(){
	$(this).css("color", "grey");
});

$('#rate-1').click(function(){
	$(this).html(str);

	$.post(rate_url,{rate:1,model:model_id,user:user_id},function(){

		$(this).off("click mouseenter");
		$('#rate-2').off("click mouseenter");
		$('#rate-3').off("click mouseenter");
		$('#rate-4').off("click mouseenter");
		$('#rate-5').off("click mouseenter");

	});
});


$('#rate-2').hover(function(){
	$(this).css("color", "orange");
	$('#rate-1').css("color", "orange");
},function(){
	$(this).css("color", "grey");
	$('#rate-1').css("color", "grey");
});

$('#rate-2').click(function(){
	$(this).html(str);
	$('#rate-1').html(str);

	$.post(rate_url,{rate:2,model:model_id,user:user_id},function(){

		$('#rate-1').off("click mouseenter");
		$(this).off("click mouseenter");
		$('#rate-3').off("click mouseenter");
		$('#rate-4').off("click mouseenter");
		$('#rate-5').off("click mouseenter");

	});
});


$('#rate-3').hover(function(){
	$(this).css("color", "orange");
	$('#rate-1').css("color", "orange");
	$('#rate-2').css("color", "orange");
},function(){
	$(this).css("color", "grey");
	$('#rate-1').css("color", "grey");
	$('#rate-2').css("color", "grey");
});

$('#rate-3').click(function(){
	$(this).html(str);
	$('#rate-1').html(str);
	$('#rate-2').html(str);

	$.post(rate_url,{rate:3,model:model_id,user:user_id},function(){

		$('#rate-1').off("click mouseenter");
		$('#rate-2').off("click mouseenter");
		$(this).off("click mouseenter");
		$('#rate-4').off("click mouseenter");
		$('#rate-5').off("click mouseenter");

	});
});


$('#rate-4').hover(function(){
	$(this).css("color", "orange");
	$('#rate-1').css("color", "orange");
	$('#rate-2').css("color", "orange");
	$('#rate-3').css("color", "orange");
},function(){
	$(this).css("color", "grey");
	$('#rate-1').css("color", "grey");
	$('#rate-2').css("color", "grey");
	$('#rate-3').css("color", "grey");
});

$('#rate-4').click(function(){
	$(this).html(str);
	$('#rate-1').html(str);
	$('#rate-2').html(str);
	$('#rate-3').html(str);

	$.post(rate_url,{rate:4,model:model_id,user:user_id},function(){

		$('#rate-1').off("click mouseenter");
		$('#rate-2').off("click mouseenter");
		$('#rate-3').off("click mouseenter");
		$(this).off("click mouseenter");
		$('#rate-5').off("click mouseenter");

	});
});


$('#rate-5').hover(function(){
	$(this).css("color", "orange");
	$('#rate-1').css("color", "orange");
	$('#rate-2').css("color", "orange");
	$('#rate-3').css("color", "orange");
	$('#rate-4').css("color", "orange");
},function(){
	$(this).css("color", "grey");
	$('#rate-1').css("color", "grey");
	$('#rate-2').css("color", "grey");
	$('#rate-3').css("color", "grey");
	$('#rate-4').css("color", "grey");
});

$('#rate-5').click(function(){
	$(this).html(str);
	$('#rate-1').html(str);
	$('#rate-2').html(str);
	$('#rate-3').html(str);
	$('#rate-4').html(str);

	$.post(rate_url,{rate:5,model:model_id,user:user_id},function(){

		$('#rate-1').off("click mouseenter");
		$('#rate-2').off("click mouseenter");
		$('#rate-3').off("click mouseenter");
		$('#rate-4').off("click mouseenter");
		$(this).off("click mouseenter");

	});
});
