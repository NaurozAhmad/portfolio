// JavaScript Document
$(document).ready(function(){

		 
				$('div#result').hide();
		// hide div with id RAS .. after 5 seconds		
	
   //$('#test').css("display","none");
	
// for symptoms submissions.... 
//For adding Symptoms 



//------------- end .... for adding symptoms 
$('#cat_id').change( function(e){
	var test=$('#cat_id').val();

 get_sub(test);
 		});		

		
		
	});
	
	
function get_sub(test){
	var string='id='+test;
	$.ajax({
			type: 'POST',
			url : '../books/select_books.php',
			data: string,
			dataType: '',
			cache: false,
			timeout: 7000,
			success: function(data){
				$('div #result').show();
					$('div #result').html(data);
				}
				/*error: function(XMLHttpRequest, textstatus,errorThrown){
					$('#result').html(errorThrown);
					
					} */
		});
	}
	
