var MOBILE_SIZE = 640;
var noSizeChange = false;
var NavHammer;
//clicked will the object that was clicked
//I have no idea what ^^ is supposed to mean
function init()
{
	if (window.innerWidth < MOBILE_SIZE)
	{
		var nav = document.getElementById("navBar");
		NavHammer = new Hammer(nav);
		NavHammer.get('pan').set({direction: Hammer.DIRECTION_HORIZONTAL});
		NavHammer.on('panleft panright swipeleft swiperight', function(ev){
			if (ev.type == "panleft" || ev.type == "swipeleft")
			{
				nav.style.right = '1%';
			}
			if (ev.type == "panright" || ev.type == "swiperight")
			{
				nav.style.right = '-33%';
			}
		});
	}
}

/*function doCalendarTicker()
{
	var xhttp = new XMLHttpRequest();
	var xml;
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			xml = xhttp.responseXML;
		}
	};
	xhttp.open("GET", "calendar.xml", true);
	xhttp.send();
	var calTicker = document.getElementById("calendar_ticker");
	int todayNumEvents = 
}*/

function calendarRefresh()
{
	var controlPanel = document.getElementById("calendar-controls");
	var categories = [];
	for (checkBox = controlPanel.firstElementChild; checkBox != null; checkBox = checkBox.nextElementSibling)
	{
		categories[checkBox.value] = checkBox.checked;
	}
	
	var entries = getElementsByClassName(document.getElementById("calendar-container"), "calendar-item");
	for (var i in entries)
	{
		var entry = entries[i];
		var category = entry.firstElementChild.firstElementChild;
		if (!categories[category.innerHTML])
			entry.style.display="none";
		else
			entry.style.display="block";
	}
}

function toggleDateCatagory(clicked)
{
	for (element = clicked.nextElementSibling; element != null; element = element.nextElementSibling)
	{
		element.style.display = (element.style.display != "none" ? "none" : "block");
	}
	return;
}

//Helper function
function getElementsByClassName(element, name)
{
	returns = [];
	for (var child = element.firstElementChild; child != null; child = child.nextElementSibling)
	{
		if (child.getAttribute("class") == name)
			returns.push(child);
		returns = returns.concat(getElementsByClassName(child, name));
	}
	return returns;
}

function mouseEnterComments()
{
	noSizeChange = true;
}

function mouseLeaveComments()
{
	noSizeChange = false;
}

function toggleSize(element)
{
	if (window.innerWidth > MOBILE_SIZE || noSizeChange)
		return;
	if (element.getAttribute("articleSize") == "normal")
	{
		//switch size to large
		element.style.position = "static";
		element.style.width = "auto";
		element.setAttribute("size", "large");
	}
	else if (element.getAttribute("articleSize") == "large")
	{
		//switch to normal
		element.style.position = "absolute";
		element.style.width = (window.innerWidth * .9) + "px";
		element.setAttribute("size", "normal");
	}
}

function displayMoreArticles(numToDisplay)
{
	//Found this code on the W3Schools website
	var xhttp;
		if (window.XMLHttpRequest) {
		xhttp = new XMLHttpRequest();
    } else {
		// code for IE6, IE5
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.onreadystatechange = function() 
	{
		if (xhttp.readyState == 4 && xhttp.status == 200)
		{
			document.getElementById("content").innerHTML += xhttp.responseText;
		}
	}
	xhttp.open("GET", "article_printer.php?begin="+iNumDisplaying+"&count="+numToDisplay, true);
	iNumDisplaying += numToDisplay;
	xhttp.send();
}
