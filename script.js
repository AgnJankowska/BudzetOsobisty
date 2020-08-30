function setStartDate() {
	let n =  new Date();
	let y = n.getFullYear();
	let m = n.getMonth() + 1;
	if(m<10) m = '0'+m;
	d = n.getDate();
	if(d<10) d = '0'+d;
	
	return y + "-" + m + "-" + d
}

document.getElementById("currentDate").value = setStartDate();

function active1(){
	document.getElementById("active1").style.background = "#0066cc";
	document.getElementById("active2").style.background = "grey";
	document.getElementById("active3").style.background = "grey";
}

function active2(){
	document.getElementById("active2").style.background = "#0066cc";
	document.getElementById("active1").style.background = "grey";
	document.getElementById("active3").style.background = "grey";
}

function active3(){
	document.getElementById("active3").style.background = "#0066cc";
	document.getElementById("active1").style.background = "grey";
	document.getElementById("active2").style.background = "grey";
}