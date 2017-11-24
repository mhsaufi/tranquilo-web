var update_url = $('#update_url').val();

$('#profile-name').click(function(){

	var str = '<input type="text" name="name" class="form-control" id="name">';

	$(this).html(str);
	$('#name').focus();

	$('#name').blur(function(){

		var name = $('#name').val();
		var col = 'name';

		$.post(update_url,{name:name,col:col},function(data){

			$('#profile-name').html(data);

		});
	});
});

$('#profile-email').click(function(){

	var str = '<input type="text" name="email" class="form-control" id="email">';

	$(this).html(str);
	$('#email').focus();

	$('#email').blur(function(){

		var email = $('#email').val();
		var col = 'email';

		$.post(update_url,{email:email,col:col},function(data){

			$('#profile-email').html(data);

		});
	});
});


