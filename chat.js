window.onload = function() {
	lastMessages();
	document.getElementById('refresh').addEventListener('click', lastMessages);
	document.getElementById('envoyez').addEventListener('click', sendMessage);
};

function lastMessages() {
	var http = new XMLHttpRequest();
	http.onreadystatechange = function() {
		if (http.readyState == XMLHttpRequest.DONE && http.status == 200 ) {
			var response = JSON.parse(http.responseText);
			for (var i=0;i<response.length;i++) {
				var row = createRow(response[i]);
				document.getElementById('panel_body').append(row);
			}				
		}
	};
	http.open('GET', 'http://localhost/chat/save_message.php');
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.send();	
}

function sendMessage()
{
	var pseudo 	= document.getElementById('pseudo').value;
	var	message = document.getElementById('message').value;
	var http 	= new XMLHttpRequest();
	http.onreadystatechange = function() {
		if (http.readyState == XMLHttpRequest.DONE && http.status == 200 ) {
			var response = JSON.parse(http.responseText);
			for (var i=0;i<response.length;i++) {
				var row = createRow(response[i]);
				document.getElementById('panel_body').prepend(row);
			}				
		}
	};
	http.open('POST', 'http://localhost/chat/save_message.php');
	http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	http.send("pseudo="+pseudo+"&message="+message);		
}

function createRow(object) 
{
	var row = document.createElement('tr');
	for (prop in object) {
		var td = document.createElement('td');
		td.textContent = object[prop];
		row.append(td);	
	}
	return row;	
}