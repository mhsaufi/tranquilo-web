
var str = '<i class="icon-star icon-2x rate rate-checked"></i>';

$('#rate-1').hover(function(){
	$(this).css("color", "orange");
},function(){
	$(this).css("color", "grey");
});

$('#rate-1').click(function(){
	$(this).html(str);
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
});
