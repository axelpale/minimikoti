var t; // timing
var home
var slogan;

function onSlogan( home_title, slogan_text ) {
   home = home_title;
	slogan = slogan_text;
	clearTimeout(t);
	t=setTimeout("showSlogan()",0);
}

function offSlogan() {
	clearTimeout(t);
	t=setTimeout("hideSlogan()",300);
}

function showSlogan() {
   document.getElementById("hometitle").innerHTML = home;
	document.getElementById("slogantext").innerHTML = slogan;
	/*document.getElementById("slogan").className = "onslogan";*/
}

function hideSlogan() {
	document.getElementById("hometitle").innerHTML = "";
	document.getElementById("slogantext").innerHTML = "";
	/*document.getElementById("slogan").className = "";*/
}


