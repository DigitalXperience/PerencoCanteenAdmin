<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include ('inc/head.php'); ?>
<?php include ('inc/menu.php'); ?>

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active"><?php echo $title; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
		<!-- Parametre du filtre -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Options de filtre</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                   <!-- Date and time range -->
                  <div class="form-group">
                    <label>Date range button:</label>
                    <div class="input-group">
                      <button class="btn btn-default pull-right" id="daterange-btn">
                        <i class="fa fa-calendar"></i> Date range picker
                        <i class="fa fa-caret-down"></i>
                      </button>
                    </div>
                  </div><!-- /.form group -->
                <!-- checkbox -->
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal" checked>
					  Entrees
                    </label>
                    <label>
                      <input type="checkbox" class="minimal">
					  Dessert
                    </label>
                    <label>
                      <input type="checkbox" class="minimal" disabled>
						Plats Chauds
                    </label>
                  </div>
                </div><!-- /.col -->
                
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="box-footer">
              Les parametres appliqués
            </div>
          </div><!-- Parametre du filtre -->
		  
		  
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Entrees</th>
                    <th>Plats Chauds</th>
                    <th>Desserts</th>
                    <th>Entrees (cfa)</th>
                    <th>Plats (cfa)</th>
                    <th>Desserts (cfa)</th>
                    <th>Terminal</th>
                  </tr>
                </thead>
                <tbody>
                     <?php if($liste){
							$sum_entree = 0;
							$sum_repas = 0;
							$sum_dessert = 0;
							$sum_entreef = 0;
							$sum_repasf = 0;
							$sum_dessertf = 0;
                            foreach ($liste as $row){
                                echo '<tr id="row-'.$row->id.'">
                                        <td>'.$row->dat.'</td>
                                        <td>'.abs($row->starters) .'</td>
                                        <td>'.abs($row->meals).'</td>
                                        <td>'.abs($row->desserts).'</td>
                                        <td>'.(abs($row->starters) * $params['starter_price']) .'</td>
                                        <td>'.(abs($row->meals) * $params['meal_price']).'</td>
                                        <td>'.(abs($row->desserts) * $params['dessert_price']).'</td>
                                        <td>'.$row->place.'</td>
                                      </tr>';
								$sum_entree += abs($row->starters);
								$sum_repas += abs($row->meals);
								$sum_dessert += abs($row->desserts);
								$sum_entreef += (abs($row->starters) * $params['starter_price']);
								$sum_repasf += (abs($row->meals) * $params['meal_price']);
								$sum_dessertf += (abs($row->desserts) * $params['dessert_price']);
                            }
                    } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <th>Total : <?php echo $sum_entree; ?></th>
                    <th>Total : <?php echo $sum_repas; ?></th>
                    <th>Total : <?php echo $sum_dessert; ?></th>
					 <th>Total : <?php echo $sum_entreef; ?></th>
                    <th>Total : <?php echo $sum_repasf; ?></th>
                    <th>Total : <?php echo $sum_dessertf; ?></th>
					
                    <th>Terminal</th>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include ('inc/footer.php'); ?>
<!-- page script -->
<!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
	<!-- InputMask -->
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
   $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
      });
</script>