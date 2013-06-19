$(document).ready(function()
{
	//Display Loading Image
	function displayLoading()
	{
		$("#loading").fadeIn(900,0);
		$("#loading").html("<img src='images/loader.gif' />");
	}
	
	//Hide Loading Image
	function hideLoading()
	{
		$("#loading").fadeOut('slow');
	};
	
	function hide()
	{
		
	}
	
	function show()
	{
		
	}
	
	function getFilter()
	{
		var tuin =	 $('#Tuin').is(':checked');
		var balkon = $('#Balkon').is(':checked');
		var lift =   $('#Lift').is(':checked');
		var makelaar =   $('#sorteer_0').is(':checked');
		var adres =   $('#sorteer_1').is(':checked');
		
		var filter='';
		if(tuin)	filter = filter + 'tuin/';
		if(balkon)	filter = filter + 'balkon/';
		if(lift)	filter = filter + 'lift/';
		if(makelaar)filter = filter + 'sorteer-makelaar-op/';
		if(adres)	filter = filter + 'sorteer-adres-op/';
		filter=filter.slice(0,-1);
		return filter;
	}
	
	function getCurrentPage()
	{
		return $('#currentPage').val();
	}
	
	function setCurrentPage(currentPage)
	{
		return $('#currentPage').val(currentPage);
	}
	
	displayLoading();
	$("#prev").hide();
	$("#objects").load("index.php?r=site/loadAPIResponse&page=1", hideLoading());
	
	//Pagination Click
	$("#prev").click(function(){
		filter=getFilter();
		var currentPage = getCurrentPage();
		currentPage = parseInt(currentPage)-1;
		if(currentPage <= 1) $("#prev").hide();
		setCurrentPage(currentPage);
		displayLoading();
		$("#objects").load("index.php?r=site/loadAPIResponse&page="+currentPage+"&filter="+filter, hideLoading());
	});
	
	$("#next").click(function(){
		$("#prev").show();
		filter=getFilter();
		var currentPage = getCurrentPage();
		currentPage = parseInt(currentPage)+1;
		setCurrentPage(currentPage);
		displayLoading();
		$("#objects").load("index.php?r=site/loadAPIResponse&page="+currentPage+"&filter="+filter, hideLoading());
	});
	
	$("#verversen").click(function(){
		filter=getFilter();
		var currentPage = 1;
		setCurrentPage(currentPage);
		displayLoading();
		$("#objects").load("index.php?r=site/loadAPIResponse&page=1&filter="+filter, hideLoading());
	});

});