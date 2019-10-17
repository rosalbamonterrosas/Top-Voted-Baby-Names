$('document').ready(function() { 
	/* handling form validation */
	$("#babyName-form").validate({
		rules: {
			nameDescription: {
		      required: true,
              correct_input: true   // Input validation method
			},
		},
		messages: {
			nameDescription:{
			  required: ""
			 },			
		},
		submitHandler: submitForm	
	});	   
	/* Handling login functionality */
  
	function submitForm() {		
		var data = $("#babyName-form").serialize();				
		$.ajax({				
			type : 'POST',
			url  : 'vote.php',
			dataType:'json',
			data : data,
			beforeSend: function(){	
				$("#vote").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; voting ...');
			},
			success : function(response){
              let $display_boys = $('#display_boys');
              let $display_girls = $('#display_girls');
              let $confirm_msg = $('#confirm_msg');

              if(response.error == '2'){    // Database Error
                $confirm_msg.empty();
                $confirm_msg.html('<div class="alert alert-danger">Database error</div>');
                $("#vote").html('VOTE');
              }
              else if(response.error == '0'){   // Success
                $confirm_msg.empty();
                $confirm_msg.html('<div class="alert alert-success text-center">Thank you. Your vote has been recorded.</div>');
                $display_girls.empty();
                $display_boys.empty();
                
                
                // Inserting boys and girls response tables into index.php 
                
                let $tablestm = '<thead><tr><th scope="col">Rank</th><th scope="col">Name</th><th scope="col">Votes</th></tr></thead><tbody class="table_body"></tbody></table>';
                
                $display_boys.append($tablestm);
                $display_girls.append($tablestm);
                
                let $boys_rank = 0;
                let $girls_rank = 0;
              
                
                for(let $row of response.girls){
                  $girls_rank += 1; $display_girls.children(".table_body").append('<tr><td>' + $girls_rank + '</td>' + '<td>' + $row.name + '</td>' + '<td>' + $row.count + '</td></tr>');
                }
                for(let $row of response.boys){
                 $boys_rank += 1; $display_boys.children(".table_body").append('<tr><td>' + $boys_rank + '</td>' + '<td>' + $row.name + '</td>' + '<td>' + $row.count + '</td></tr>');
                }
                $("#vote").html('VOTE');
              }
			}
		});
		return false;
	}
  
  // Input validation: only allow letters, apostrophe, exclamation mark, and spaces
  
  $.validator.addMethod( "correct_input", function( value, element ) {
	return this.optional( element ) || /^[a-zA-Z'!\s]+$/i.test( value );
}, '<div class="alert alert-danger text-center">Error: Please enter a valid name.</div>');

});