window.onload = setDates();

//Start and ending of balance

function currentDay() {
	n =  new Date();
	let d = n.getDate();
	return d}
	
function currentMonth() {
	n =  new Date();
	let m = n.getMonth() + 1;
	return m}

function currentYear() {
	n =  new Date();
	let y = n.getFullYear();
	return y}

function isThisYearLeap(year) {
  if ((year % '4' == '0' && year % '100' != '0') || year % '400' == '0')
    return true;
  else
    return false; }

function checkNumberOfDays (year, month) {
 switch (month) {
   case '01':
   case '03':
   case '05':
   case '07':
   case '08':
   case '10':
   case '12': 
       return '31';
   
   case '04':
   case '06':
   case '09':
   case '11': 
       return '30';

   case '02': 
       if (isThisYearLeap(year)) return '29';
       else                      return '28';
   }
}


function setStartDate() {
	let range = document.getElementById("range");
	let value= range.options[range.selectedIndex].value;
	
	if (value==1){
		d = '01';
		m = currentMonth();
			if(m<10) m = '0'+m;
		y = currentYear();
		return y + "-" + m + "-" + d}
	
	else if (value==2){
		d = '01';
		if( currentMonth()==1){
			m = 12
			y = currentYear()-1;
		}
		else{
			m = currentMonth()-1;
			if(m<10) m = '0'+m;
			y = currentYear();
		}
		return y + "-" + m + "-" + d}
		
	else if (value==3){
		d = '01';
		m = '01';
		y = currentYear();
		return y + "-" + m + "-" + d}
		
	else 
		return ''
}

function setEndDate() {
	let sel = document.getElementById("range");
	let value= sel.options[sel.selectedIndex].value;
	
	if (value==1){
		d = currentDay();
			if(d<10) d = '0'+d;
		m = currentMonth();
			if(m<10) m = '0'+m;
		y = currentYear();
		return y + "-" + m + "-" + d}
	
	else if (value==2){
		if( currentMonth()==1){
			m = 12
			y = currentYear()-1;
		}
		else{
			m = currentMonth()-1;
			if(m<10) m = '0'+m;
		}
		d = checkNumberOfDays(y, m);

		return y + "-" + m + "-" + d}
		
	else if (value==3){
		d = currentDay();
			if(d<10) d = '0'+d;
		m = currentMonth();
			if(m<10) m = '0'+m;
		y = currentYear();
		return y + "-" + m + "-" + d}
		
	else 
		return ''
}

function setDates() {
	document.getElementById("date_start").value = setStartDate();
	document.getElementById("date_end").value = setEndDate();
}

// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart1);
google.charts.setOnLoadCallback(drawChart2);

// Draw the chart and set the chart values
function drawChart1() {
  var data = google.visualization.arrayToDataTable([
  ['Ktegoria', 'Kwota'],
  ['Wynagrodzenie', 8],
  ['Odsetki bankowe', 5],
  ['Allegro', 2],
  ['Inne', 2],
]);

  var options = {
	  'width':500, 
	  'height':300,
	  is3D: true,
	  backgroundColor: '#0066cc',
	  legend: {position: 'right', alignment:'center' , textStyle: {color: 'white', fontSize: 16}},
	  chartArea:{width:'90%',height:'90%'},
	  pieSliceText: 'percentage',
	  pieSliceBorderColor: 'grey',
	  sliceVisibilityThreshold: .07,
	  pieSliceTextStyle: {color:'white', fontSize: 16}
	};

  var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
  chart.draw(data, options);
}

function drawChart2() {
  var data = google.visualization.arrayToDataTable([
  ['Ktegoria', 'Kwota'],
  ['Jedzenie', 8],
  ['Mieszkanie', 5],
  ['Transport', 2],
  ['Telekomunikacja', 2],
  ['Opieka zdrowotna', 2]
]);

  var options = {
	  'width':480, 
	  'height':300,
	  is3D: true,
	  backgroundColor: '#0066cc',
	  legend: {position: 'right', alignment:'center' , textStyle: {color: 'white', fontSize: 16}},
	  chartArea:{width:'90%',height:'90%'},
	  pieSliceText: 'percentage',
	  pieSliceBorderColor: 'grey',
	  sliceVisibilityThreshold: .07,
	  pieSliceTextStyle: {color:'white', fontSize: 16}
	};

  var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
  chart.draw(data, options);
}