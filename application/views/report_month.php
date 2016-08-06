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
            <div class="col-md-6">
              <!-- AREA CHART -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Dépenses sur le mois</h3>
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

              <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Consommation par type du mois</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col (LEFT) -->
            <div class="col-md-6">
              <!-- LINE CHART -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Consommation sur le mois en cours</h3>
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

              <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Statistique Graphique en barre</h3>
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
          labels: ["Semaine 1", "Semaine 2", "Semaine 3", "Semaine 4"],
          datasets: [
            {
				label: "Entrees",
				fillColor: "rgba(244, 166, 41, 0.9)",
				strokeColor: "rgba(244, 166, 41, 0.8)",
				pointColor: "rgba(244, 166, 41,1)",
				pointStrokeColor: "#F4A629",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(244, 166, 41,1)",
				data: [<?php 
					foreach($consomonth as $c)
						echo abs($c->starters) .',';
				?>]
			  },
			  {
				label: "Plats chauds",
				fillColor: "rgba(0, 192, 239,0.9)",
				strokeColor: "rgba(0, 192, 239),0.8)",
				pointColor: "#00C0EF",
				pointStrokeColor: "rgba(0, 192, 239),1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(0, 192, 239),1)",
				data: [<?php 
					foreach($consomonth as $c)
						echo abs($c->meals) .',';
				?>]
			  },
			  {
				label: "Desserts",
				fillColor: "rgba(0, 166, 90, 0.9)",
				strokeColor: "rgba(0, 166, 90,0.8)",
				pointColor: "#00A65A",
				pointStrokeColor: "rgba(0, 166, 90,1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(0, 166, 90,1)",
				data: [<?php 
					foreach($consomonth as $c)
						echo abs($c->desserts) .',';
				?>]
			  }
          ]
        };
		
		var areaChartData4 = {
          labels: ["Semaine 1", "Semaine 2", "Semaine 3", "Semaine 4"],
          datasets: [
            {
				label: "Entrees",
				fillColor: "rgba(244, 166, 41, 0.9)",
				strokeColor: "rgba(244, 166, 41, 0.8)",
				pointColor: "rgba(244, 166, 41,1)",
				pointStrokeColor: "#F4A629",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(244, 166, 41,1)",
				data: [<?php 
					foreach($consomonth as $c)
						echo abs($c->starters) .',';
				?>]
			  },
			  {
				label: "Plats chauds",
				fillColor: "rgba(0, 192, 239,0.9)",
				strokeColor: "rgba(0, 192, 239),0.8)",
				pointColor: "#00C0EF",
				pointStrokeColor: "rgba(0, 192, 239),1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(0, 192, 239),1)",
				data: [<?php 
					foreach($consomonth as $c)
						echo abs($c->meals) .',';
				?>]
			  },
			  {
				label: "Desserts",
				fillColor: "rgba(0, 166, 90, 0.9)",
				strokeColor: "rgba(0, 166, 90,0.8)",
				pointColor: "#00A65A",
				pointStrokeColor: "rgba(0, 166, 90,1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(0, 166, 90,1)",
				data: [<?php 
					foreach($consomonth as $c)
						echo abs($c->desserts) .',';
				?>]
			  }
          ]
        };
		
		var areaChartData3 = {
          labels: ["Semaine 1", "Semaine 2", "Semaine 3", "Semaine 4"],
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
			foreach($consomonth as $c)
				echo abs($c->starters*500)+abs($c->meals*2000)+abs($c->desserts*500) .',';
		?>]
            }
          ]
        };
		
        var areaChartData = {
          labels: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
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
          responsive: true
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
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          {
            value: <?php echo abs($conso->meals); ?>,
            color: "#00C0EF",
            highlight: "#00C0EF",
            label: "Plats Chauds"
          },
          {
            value: <?php echo abs($conso->desserts); ?>,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Dessert"
          },
          {
            value: <?php echo abs($conso->starters); ?>,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Entrees"
          }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData4;
        barChartData.datasets[1].fillColor = "#00C0EF";
        barChartData.datasets[1].strokeColor = "#00C0EF";
        barChartData.datasets[1].pointColor = "#00C0EF";
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
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
    </script>