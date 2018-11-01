function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function changeColor(num){
	switch (num){
		case 1: document.getElementById("a1").style.color = "#707070";
			document.getElementById("a2").style.color = "white";
			document.getElementById("a3").style.color = "white";
			document.getElementById("a4").style.color = "white";
			document.getElementById("a5").style.color = "white";
			document.getElementById("a6").style.color = "white";
			break;
		case 3: 
			document.getElementById("a3").style.color = "#707070";
			document.getElementById("a1").style.color = "white";
			document.getElementById("a2").style.color = "white";
			document.getElementById("a4").style.color = "white";
			document.getElementById("a5").style.color = "white";
			document.getElementById("a6").style.color = "white";		
			break;
		case 4:
			document.getElementById("a4").style.color = "#707070";
			document.getElementById("a1").style.color = "white";
			document.getElementById("a3").style.color = "white";
			document.getElementById("a2").style.color = "white";
			document.getElementById("a5").style.color = "white";
			document.getElementById("a6").style.color = "white";		
			break;
		case 5:
			document.getElementById("a5").style.color = "#707070";
			document.getElementById("a1").style.color = "white";
			document.getElementById("a3").style.color = "white";
			document.getElementById("a2").style.color = "white";
			document.getElementById("a4").style.color = "white";
			document.getElementById("a6").style.color = "white";		
			break;
	       case 6:
			document.getElementById("a6").style.color = "#707070";
			document.getElementById("a1").style.color = "white";
			document.getElementById("a3").style.color = "white";
			document.getElementById("a2").style.color = "white";
			document.getElementById("a5").style.color = "white";
			document.getElementById("a4").style.color = "white";		
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
