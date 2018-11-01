function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function changeColor(num){
	switch (num){
		case 1: 
			document.getElementById("a1").style.backgroundColor = "#4CAF50";
			document.getElementById("a1").style.color = "white";
			document.getElementById("a2").style.backgroundColor = "#707070";
			document.getElementById("a3").style.backgroundColor = "#707070";
			document.getElementById("a4").style.backgroundColor = "#707070";
			document.getElementById("a5").style.backgroundColor = "#707070";
			break;
		case 2:
			document.getElementById("a2").style.backgroundColor = "#4CAF50";
			document.getElementById("a2").style.color = "white";
			document.getElementById("a1").style.backgroundColor = "#707070";
			document.getElementById("a3").style.backgroundColor = "#707070";
			document.getElementById("a4").style.backgroundColor = "#707070";	
			document.getElementById("a5").style.backgroundColor = "#707070";		
			break;
		case 3: 
			document.getElementById("a3").style.backgroundColor = "#4CAF50";
			document.getElementById("a3").style.color = "white";
			document.getElementById("a2").style.backgroundColor = "#707070";
			document.getElementById("a1").style.backgroundColor = "#707070";
			document.getElementById("a4").style.backgroundColor = "#707070";	
			document.getElementById("a5").style.backgroundColor = "#707070";		
			break;
		case 4:
			document.getElementById("a4").style.backgroundColor = "#4CAF50";
			document.getElementById("a4").style.color = "white";
			document.getElementById("a2").style.backgroundColor = "#707070";
			document.getElementById("a1").style.backgroundColor = "#707070";
			document.getElementById("a3").style.backgroundColor = "#707070";
			document.getElementById("a5").style.backgroundColor = "#707070";
			break;
		case 5:
			document.getElementById("a5").style.backgroundColor = "#4CAF50";
			document.getElementById("a5").style.color = "white";
			document.getElementById("a2").style.backgroundColor = "#707070";
			document.getElementById("a1").style.backgroundColor = "#707070";
			document.getElementById("a3").style.backgroundColor = "#707070";
			document.getElementById("a4").style.backgroundColor = "#707070";
			break;
	}
}

function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

function myFunction() {
					 
   alert("Review submitted successfully");
}
