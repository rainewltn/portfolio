/* @desc Find all the images on the page with class 'viewable'.  Give them an onclick function that will pass their src to the main viewer funciton.
*  @param i - the index of how many images are on the page.
*  @param images[array] - An array of all the image's sources.
*  @param displayCount - The index of the image currently being viewed.
*  @param displayTotal - The total number of images.
*/
var i =0;
$(document).ready(function(){
var images = $('.viewable').find('img').map(function() { return this.src; }).get();
$('viewable img').css('cursor','pointer');
$('#displayCount').append(i + 1);
$('#displayTotal').append(images.length);

});

//Set the height of the somethign..
function afterFunction()
{
	
	var heightEq = (window.innerHeight - $('#img' + i).height())/2;
	//console.log(document.body.scrollHeight + ", " + $('#img' + i).height() + ", " + heightEq );
	$('#imageFancy').css('padding-top',heightEq);
}

$('viewable img').click(function(){
	
	
	var images = $('#main').find('img').map(function() { return this.src; }).get();
	var obj = $('#imageFancy');
	var i = 0;
	obj.append("<img id='img"+ i +"' src='" + images[i] + "'>");
	//$('#displayTotal') = ;
	
	obj.css('display','block');
	//afterFunction();	
	
});


function closeImageFancy()
{
	var obj = $('#imageFancy');
	var images = $('#main').find('img').map(function() { return this.src; }).get();
	for(var img = 0; img < images.length; img++)
	{
		$("#img" + img).detach();
	}
	obj.css('display','none');
}



function goLeft()
{
	
	
	
	if(i > 0)
	{
		
		var obj = $('#imageFancy');
		$("#img" + i).detach();
		i--;
		$('#displayCount').detach();
		$('#imageFancy').append("<div id='displayCount'>" + (i + 1) + "</div>"); 
		var images = $('#main').find('img').map(function() { return this.src; }).get();
		var obj = $('#imageFancy');
		obj.append("<img id='img"+ i +"' src='" + images[i] + "'>");
	}
	
	

}
function goRight()
{
	var images = $('#main').find('img').map(function() { return this.src; }).get();
	
	if(i < images.length -1)
	{
		
		var obj = $('#imageFancy');
		$("#img" + i).detach();
		i++;
		$('#displayCount').detach();
		$('#imageFancy').append("<div id='displayCount'>" + (i + 1) + "</div>"); 
		var images = $('#main').find('img').map(function() { return this.src; }).get();
		var obj = $('#imageFancy');
		obj.append("<img id='img"+ i +"' src='" + images[i] + "'>");
	}
}