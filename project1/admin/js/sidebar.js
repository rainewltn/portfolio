$(document).ready(function(){
/* 
  * @desc This set of function moves the div out and changes the display arrow.
*/
$( "#sidebar_arrow_admin1" ).click(function() {
	
		$( "#sidebar_admin" ).animate({
		left: '-205px'
		}, 200, function() {
		
		});
		$('#sidebar_arrow_admin1').attr('style','display:none;');
		$('#sidebar_arrow_admin2').attr('style','display:inline;');
});
$( "#sidebar_arrow_admin2" ).click(function() {
	
		$( "#sidebar_admin" ).animate({
		left: '0px'
		}, 200, function() {
		
		});
		$('#sidebar_arrow_admin1').attr('style','display:inline;');
		$('#sidebar_arrow_admin2').attr('style','display:none;');
});

	

});

function profile_image(url)
{

	$('#profile_picture').css('background-image','url(' + url + ')');
}