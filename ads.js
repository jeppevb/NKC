var myAdImages = ["underarmour.png", "budoexperten.png", "choker.png", "Fairtex.png", "FIGHTERSPORT.png", "friluftsland.png", "gymbutikken.png", "houseofwellness.png", "kettlebelllshop.png", "kwon.png", "matsuru.png", "nippon.png", "shakk.png", "soegaardsbryghus.png", "streetman.png", "aalborgbudoshop.png", "aalborghelsekost.png", "itox.png"];
var myAdURLs = ["http://www.underarmour.dk", "http://budoxperten.dk/", "http://www.choker.dk/", "http://www.fairtex.dk/", "http://fightersport.dk/", "http://friluftsland.dk/", "http://gymbutikken.dk/", "http://houseofwellness.dk/", "http://www.kettlebellshop.dk/", ".", "http://matsuru.dk", "http://www.nippon.dk/", "http://www.shakk.dk/", "http://soegaardsbryghus.dk/", "http://www.streetman.dk/", "http://budoshop.dk/", "http://aalborghelsekost.dk/", "http://itox.dk"];
var thisIndex = Math.floor(myAdImages.length*Math.random());

setInterval("setAd()", 5000);

function setAd()
{	
  thisIndex = Math.floor(myAdImages.length*Math.random());
	
  document.getElementById("footer").innerHTML = "<a href=\"" + myAdURLs[thisIndex] + "\"><img src=\"images/" + myAdImages[thisIndex] + "\" /></a>";
}
