<div class="container">
	<div id="container">
		<p>
			<span class="article-header">Dashboard</span>
		</p>
		<br />
		<div>
			<div class="row">
				<div class="col-md-6">
					<div class="graph-container">
						<div class="caption">User meetings total</div>
						<div id="myfirstchart" style="height: 250px;"></div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="graph-container">
						<div class="caption">Most chaired meetings</div>
						<div id="mysecondchart" style="height: 250px;"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="graph-container">
						<div class="caption">No. of meetings by day</div>
						<div id="mythirdchart" style="height: 250px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	/**
	 * Get data
	 */
	var arrDay = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
	var arrData = null;
	$(document).ready(function(){          
	     $.ajax({
	         type: "POST",
	         url: base_url + "home/get_graph_data", 
	         data: "1",
	         dataType: "json",  
	         success: 
	              function(data){
	                alert(data);  //as a debugging message.
	                arrData = data;
	              }
 		});
	});

	new Morris.Bar({
	    element: 'myfirstchart',
	    data: [
	      {device: 'testuser', geekbench: 136},
	      {device: 'nobuhle', geekbench: 137},
	      {device: 'nobrega', geekbench: 275},
	      {device: 'samaras', geekbench: 380},
	      {device: 'vusi', geekbench: 655},
	      {device: 'ishmael', geekbench: 1571}
	    ],
	    xkey: 'device',
	    ykeys: ['geekbench'],
	    labels: ['Geekbench'],
	    barRatio: 0.4,
	    xLabelAngle: 35,
	    hideHover: 'auto'
	});

	new Morris.Donut({
    	element: 'mysecondchart',
	    data: [
	      {label: 'samaras', value: 25 },
	      {label: 'nobuhle', value: 40 },
	      {label: 'testuser', value: 25 },
	      {label: 'test', value: 10 }
	    ],
	    formatter: function (y) { return y + "%" }
	});

	new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'mythirdchart',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: [
	    { day: '1', value: 20 },
	    { day: '2', value: 10 },
	    { day: '3', value: 5 },
	    { day: '4', value: 5 },
	    { day: '5', value: 20 }
	  ],
	  formatter: function (x) { return arrDay[x]; },
	  // The name of the data record attribute that contains x-values.
	  xkey: 'day',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['value'],
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Value']
	});
</script>