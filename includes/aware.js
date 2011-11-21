intervalId = 0;

function startAwareness()
{	
	intervalId = setInterval("doLightAwareness()", 60000);
}

function doLightAwareness(){
	clearInterval(intervalId);
	document.getElementById("udmeldelse").style.color = "#aa1122";
	intervalId = setInterval("doMoreAwareness()", 12000);
}

function doMoreAwareness(){
	clearInterval(intervalId);
	document.getElementById("udmeldelse").style.fontWeight = "bold";
	document.getElementById("udmeldelse").style.color = "#dd0000";
}


