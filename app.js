
	
	$( document ).ready(function() {
		
		$('#search').keyup( function() {
			if( this.value.length < 2 ) return;
			/* code to run below */
			showResult(this.value); 
		});
		
		
		// get Author list
		function showResult(str) {
			
			if (str.length<2) { 
				$("#search_result").html('');
				return;
			}

			$.ajax({
				type:"POST",
				url: "action.php",
				data: {key : str, type : 'ajaxCall'},
				success: function(data) {
					console.log(data);
					$("#search_result").html(data);
				},
				error: function(data) {
					let message = 'Ops! Something went wrong.....!';
					alert(message);
				},
			});
		
		}
		
	});


	