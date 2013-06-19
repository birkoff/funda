// Create the tooltips only on document load
$(document).ready(function() 
{
	$('#objects .map-btn').each(function(){
		$(this).click(function(){ return false }); // this prevents something really nasty
		$(this).qtip({
	      // Simply use an HTML img tag within the HTML string
	      content: {
		      url: 'index.php?r=site/ShowImageMap', // render site => actionShowMap
		      data: { 
		      	center: $(this).attr('center'), // center of the map for the markers
		      	adres: $(this).attr('adres')
		      },
		      method: 'get'
		   },
	      position: {
		      corner: {
		         target: 'topRight',
		         tooltip: 'bottomLeft'
		      }
	      },
	      style: { 
		      width: 350,
		      height:280,
		      padding: 3,
		      background: '#8190FF',
		      color: 'black',
		      textAlign: 'center',
		      border: {
		         width: 4,
		         radius: 5,
		         color: '#8190FF'
		      },
		      name: 'dark' // Inherit the rest of the attributes from the preset dark style
		   },
		   show: {
			    when: 'click', // Show it on click...
			    solo: true // ...and hide all others when its shown
		   },
		   hide: 'unfocus', // Hide it when inactive...
	   });
	});
});
