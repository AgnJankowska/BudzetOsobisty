



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