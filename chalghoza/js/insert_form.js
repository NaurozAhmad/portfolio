// JavaScript Document
$(document).ready(function(){

		 
				$('div#ahmar').hide();
		// hide div with id RAS .. after 5 seconds		
	
   //$('#test').css("display","none");
	
// for symptoms submissions.... 
//For adding Symptoms 



//------------- end .... for adding symptoms 

 
	$('a#dialog').click(function(){
    var test = $(this), data = test.data('params');
    //console.log(data);
});
     get_sub(test);
	  // gets the data-bodytext attribute value
	
		
		
	});
	
	////////////////////////
	
	
	
	//////////////////////
function get_sub(test){
	var string='id='+test;
	
	$.ajax({
			type: 'POST',
			url : 'select_data.php',
			data: string,
			dataType: '',
			cache: false,
			timeout: 7000,
			success: function(data){
				$('div #ahmar').show();
					$('div #ahmar').html(data);
				}
				/*error: function(XMLHttpRequest, textstatus,errorThrown){
					$('#result').html(errorThrown);
					
					} */
		});
	}
	
