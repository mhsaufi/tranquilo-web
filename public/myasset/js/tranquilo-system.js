$('#tranquilo_headereee').ready(function(){
	
	function pullNotification()
	{
		var url = '';
		if(location.hostname == 'localhost'){
			url = 'http://'+location.hostname+':7777/tranquilo-web/public/pullnotificationnumber';
		}else{
			url = 'http://'+location.hostname+'/pullnotificationnumber';
		}

		$.ajax({
            url: url,
            type: 'get',
            success: function(response){

		        	var str = '';

		            if(response > 0){
		            	
		            	$("#tranquilo_badge").html(response);

		            }

          	},error: function(){
          	}
        });
	}

	setInterval(pullNotification,9000);

});

