<?php //var_dump($liste); die; ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include ('inc/head.php'); ?>
<?php include ('inc/menu.php'); ?> 
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!--<small>Preview sample</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li><a href="#"><?php echo $title; ?></a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<div class="callout callout-info">
            <h4>Selectionner une periode définie</h4>
            <p><a href="<?php echo base_url().'index.php/report/weekstats'; ?>">Graphes semaine en cours</a> | 
				<a href="<?php echo base_url().'index.php/report/monthstats'; ?>">Graphes mois en cours</a> | 
				<a href="<?php echo base_url().'index.php/report/yearstats'; ?>">Graphes année en cours</a></p>
          </div>
          <div class="row">
            <div class="col-md-12">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Couts de l'année</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="areaChart" style="height:250px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              

            </div><!-- /.col (LEFT) -->
			
		
			
			<div class="col-md-12">
			 <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Consommation sur l'année en cours</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" style="height:250px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			 </div><!-- /.box -->
			 
            <div class="col-md-12">
             

              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Statistique Graphique en bare (Consommation annuelle)</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      

    <?php include ('inc/footer_chart.php'); ?>
  
    <script>
      $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);
		var areaChartData2 = {
          labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
          datasets: [
            {
              label: "Entrees",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [<?php 
					for($i = 0; $i <= 12; $i++) {
						$conso = "0";
						foreach($consoyear as $c) {
							if((int) $c->month == $i)
								$conso = $c->starters;
						}
						echo abs($conso) . ",";
					}
				?>]
            },
			{
              label: "Desserts",
              fillColor: "rgba(210, 48, 222, 1)",
              strokeColor: "rgba(210, 48, 222, 1)",
              pointColor: "rgba(210, 48, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,20,220,1)",
              data: [<?php 
					for($i = 0; $i <= 12; $i++) {
						$conso = "0";
						foreach($consoyear as $c) {
							if((int) $c->month == $i)
								$conso = $c->desserts;
						}
						echo abs($conso) . ",";
					}
				?>]
            },
            {
              label: "Plats chauds",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php 
					for($i = 0; $i <= 12; $i++) {
						$conso = "0";
						foreach($consoyear as $c) {
							if((int) $c->month == $i)
								$conso = $c->meals;
						}
						echo abs($conso) . ",";
					}
				?>]
            }
          ]
        };
		
		var areaChartData4 = {
          labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
          datasets: [
            {
              label: "Entrees",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [<?php 
					for($i = 0; $i <= 12; $i++) {
						$conso = "0";
						foreach($consoyear as $c) {
							if((int) $c->month == $i)
								$conso = $c->starters;
						}
						echo abs($conso) . ",";
					}
				?>]
            },
			{
              label: "Desserts",
              fillColor: "rgba(210, 48, 222, 1)",
              strokeColor: "rgba(210, 48, 222, 1)",
              pointColor: "rgba(210, 48, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,20,220,1)",
              data: [<?php 
					for($i = 0; $i <= 12; $i++) {
						$conso = "0";
						foreach($consoyear as $c) {
							if((int) $c->month == $i)
								$conso = $c->desserts;
						}
						echo abs($conso) . ",";
					}
				?>]
            },
            {
              label: "Plats chauds",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php 
					for($i = 0; $i <= 12; $i++) {
						$conso = "0";
						foreach($consoyear as $c) {
							if((int) $c->month == $i)
								$conso = $c->meals;
						}
						echo abs($conso) . ",";
					}
				?>]
            }
          ]
        };
		
		var areaChartData3 = {
          labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [<?php 
					for($i = 0; $i <= 12; $i++) {
						$conso = "0";
						foreach($consoyear as $c) {
							if((int) $c->month == $i)
								$conso = $c->starters*500 + $c->meals*2000 + $c->desserts*500;
						}
						echo abs($conso) . ",";
					}
				?>]
            }
          ]
        };
		
        var areaChartData = {
          labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40, 80, 60, 46, 50, 37]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [280, 408, 400, 190, 860, 270, 490, 280, 408, 400, 190, 86]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
		  multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
        };

        //Create the line chart
        areaChart.Line(areaChartData3, areaChartOptions);

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        var lineChartOptions = areaChartOptions;
        lineChartOptions.datasetFill = false;
        lineChart.Line(areaChartData2, lineChartOptions);

        

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData4;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true,
		  multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
    </script>