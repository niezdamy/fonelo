{literal}

  <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }">
  </script>
  <script type="text/javascript">
    google.setOnLoadCallback(drawChart1);
	google.setOnLoadCallback(drawChart2);

    function drawChart1() {
		
		var data = google.visualization.arrayToDataTable([
			['Workouts', 'Circruit'],
			['0',  25],
			['10',  26],
			['20',  26.5],
			['30',  28],
			['40',  30]
		]);

		var options = {
		  legend: { position: 'none'  },
		  hAxis: { title: 'Workouts' },
		  vAxis: { title: 'Circuit' },
		  curveType: 'function'
		};

		var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart'));
		chart1.draw(data, options);
	}
	
	function drawChart2() {
		
		var data = google.visualization.arrayToDataTable([
			['Workouts', 'Sales'],
			['0',  74],
			['10',  73],
			['20',  71],
			['30',  72],
			['40',  69]
		]);

		var options = {
		  legend: { position: 'none'  },
		  hAxis: { title: 'Workouts' },
		  vAxis: { title: 'Weight' },
		  curveType: 'function'
		};

		var chart2 = new google.visualization.LineChart(document.getElementById('curve_chartt'));
		chart2.draw(data, options);
	}
	
	$(window).resize(function(){
		drawChart1();
		drawChart2();
    });
  </script>
  
{/literal}

  