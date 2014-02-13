$(document).ready(function(){
	$('#UFform').submit(function () {
		var data = $(this).serialize();
		var $input_size = $('input[name="size"]');
		var $input_connections = $('input[name="connections"]');
		$.ajax({
			url:'/ajax/setConnections',
			dataType: 'json',
			type : 'POST',
			data: data,
			success: function ($response) {

				if ( typeof $response.errors != 'undefined')
				{
					for ( f in $response.errors)
					{
						var message = '';
						for ( e in $response.errors[f] )
						{
							message += $response.errors[f][e] + '; ';
						}
						$('input[name="' + f + '"]').attr('data-content', message);
					}
					$input_size.popover('show');
					$input_connections.popover('show');
				}
				else
				{
					document.location.reload();
				}

			}
		});


		return false;
	});
});