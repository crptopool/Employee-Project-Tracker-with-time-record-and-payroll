var datefield=document.createElement("input")
datefield.setAttribute("type", "date")
if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
	/*document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
	document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
	document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
	*/
	document.write('<link href="https://code.jquery.com/ui/1.10.4/themes/black-tie/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
	document.write('<script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"><\/script>\n')
	document.write('<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js" integrity="sha256-oTyWrNiP6Qftu4vs2g0RPCKr3g1a6QTlITNgoebxRc4=" crossorigin="anonymous"><\/script>\n') 
}

if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
	$(function($){ //on document.ready
		$('.date-calendar').datepicker();
	})
}

if (datefield.type!="date"){
	$('.date-calendar').datepicker({ 
		showOn: 'button', 
		buttonImageOnly: true, 
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: "-0:+1"  
	})
}
