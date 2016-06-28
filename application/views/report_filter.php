<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include ('inc/head.php'); ?>
<?php include ('inc/menu.php'); ?>
<?php 
$dates = $this->input->get('dates');
?>
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
		<form role="form" action="<?php echo base_url().'index.php/report/filter'; ?>" method="get">
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
						<label>Dates:</label>
						<div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right" value="<?php echo $dates; ?>" placeholder="MOIS EN COURS PAR DEFAUT" id="reservation" name="dates">
						</div><!-- /.input group -->
					</div><!-- /.form group -->
                <!-- checkbox -->
                  <div class="form-group" style="width:49%; float:left">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="starter" value="yes" id="starter" <?php if($this->input->get('starter')) echo "checked"; ?>>
                          Entrées
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="meal" value="yes" id="meal" <?php if($this->input->get('meal')) echo "checked"; ?>>
                          Plats chauds
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="dessert" value="yes" id="dessert" <?php if($this->input->get('dessert')) echo "checked"; ?>>
                          Desserts
                        </label>
                      </div>
					  <div class="checkbox">
                        <label>
                          <input type="checkbox" name="pdf" value="yes" id="pdf" />
                          Exporter le résultat en PDF
                        </label>
                      </div>
                    </div>
					<div class="form-group" style="width:49%; float:right">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="sstarter" value="yes" id="starter" <?php if($this->input->get('starter')) echo "checked"; ?>>
                          Somme des entrées
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="smeal" value="yes" id="meal" <?php if($this->input->get('meal')) echo "checked"; ?>>
                          Somme des plats chauds
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="sdessert" value="yes" id="dessert" <?php if($this->input->get('dessert')) echo "checked"; ?>>
                          Somme des desserts
                        </label>
                      </div>
                    </div>
                
              </div><!-- /.row -->
			  <div class="col-md-6">
                   <!-- Date and time range -->
					
                
                
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="box-footer" style="padding-bottom:0">
              
			   <button type="submit" class="btn btn-primary" style="float:right;margin-left:10px" onClick="window.location.href = '<?php echo base_url('index.php/report/filter'); ?>'; return false;">Affichage par défaut</button>
		  
			  <button type="submit" class="btn btn-primary" style="float:right;">Appliquer les parametres</button>  
            </div>
          </div><!-- Parametre du filtre -->
		  </div><!-- /.content-wrapper -->
		</form>
		  
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <?php if($this->input->get('starter')) { ?><th>Entrees</th><?php } ?>
                    <?php if($this->input->get('meal')) { ?><th>Plats Chauds</th><?php } ?>
                    <?php if($this->input->get('dessert')) { ?><th>Desserts</th><?php } ?>
                    <?php if($this->input->get('sstarter')) { ?> <th>Entrees (cfa)</th><?php } ?>
                     <?php if($this->input->get('smeal')) { ?><th>Plats (cfa)</th><?php } ?>
                    <?php if($this->input->get('sdessert')) { ?><th>Desserts (cfa)</th><?php } ?>
                    <th>Total (cfa)</th>
                  </tr>
                </thead>
                <tbody>
                     <?php if($liste){
							if($this->input->get('starter')) { $sum_entree = 0; }
							if($this->input->get('meal')) { $sum_repas = 0; }
							if($this->input->get('dessert')) { $sum_dessert = 0; }
							if($this->input->get('sstarter')) { $sum_entreef = 0; }
							if($this->input->get('smeal')) { $sum_repasf = 0; }
							if($this->input->get('sdessert')) { $sum_dessertf = 0; }
                            foreach ($liste as $row){
								$sumday = 0;
								if($this->input->get('starter') && $this->input->get('sstarter')) $sumday += (abs($row->starters) * $params['starter_price']);
								if($this->input->get('meal') && $this->input->get('smeal')) $sumday += (abs($row->meals) * $params['meal_price']);
								if($this->input->get('dessert') && $this->input->get('sdessert')) $sumday += (abs($row->desserts) * $params['dessert_price']);
                                echo '<tr>
                                        <td>'.$row->dat.'</td>';
                                        if($this->input->get('starter')) {  echo '<td>'.abs($row->starters) .'</td>'; }
                                        if($this->input->get('meal')) { echo '<td>'.abs($row->meals).'</td>'; }
                                        if($this->input->get('dessert')) { echo '<td>'.abs($row->desserts).'</td>'; }
                                       if($this->input->get('sstarter')) {  echo '<td>'.(abs($row->starters) * $params['starter_price']) .'</td>'; }
                                        if($this->input->get('smeal')) { echo '<td>'.(abs($row->meals) * $params['meal_price']).'</td>'; }
                                        if($this->input->get('sdessert')) { echo '<td>'.(abs($row->desserts) * $params['dessert_price']).'</td>'; }
                                        echo '<td>'.$sumday.'</td>';
                                      echo '</tr>';
								if($this->input->get('starter')) { $sum_entree += abs($row->starters); }
								if($this->input->get('meal')) { $sum_repas += abs($row->meals); }
								if($this->input->get('dessert')) { $sum_dessert += abs($row->desserts); }
								if($this->input->get('sstarter')) { $sum_entreef += (abs($row->starters) * $params['starter_price']); }
								if($this->input->get('smeal')) { $sum_repasf += (abs($row->meals) * $params['meal_price']); }
								if($this->input->get('sdessert')) { $sum_dessertf += (abs($row->desserts) * $params['dessert_price']); }
                            }
                    } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <?php if($this->input->get('starter') && $liste) { ?> <th>Total : <?php echo $sum_entree; ?></th><?php } ?>
                   <?php if($this->input->get('meal') && $liste) { ?> <th>Total : <?php echo $sum_repas; ?></th><?php } ?>
                    <?php if($this->input->get('dessert') && $liste) { ?><th>Total : <?php echo $sum_dessert; ?></th><?php } ?>
					 <?php if($this->input->get('sstarter') && $liste) { ?><th>Total : <?php echo $sum_entreef; ?></th><?php } ?>
                    <?php if($this->input->get('smeal') && $liste) { ?><th>Total : <?php echo $sum_repasf; ?></th><?php } ?>
                    <?php if($this->input->get('sdessert') && $liste) { ?><th>Total : <?php echo $sum_dessertf; ?></th><?php } ?>
					
                    <th>Total cfa</th>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div>


    </section><!-- /.content -->
</div>
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