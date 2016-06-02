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
		<form role="form" action="<?php echo base_url().'index.php/report/logs'; ?>" method="get">
		<div class="row">
			<div class="col-sm-6">
				<div class="dataTables_length" id="example1_length">
					<label>Poste </label>
					<select name="poste" aria-controls="example1" class="">
						<option value="">Tous</option>
						<option value="client1">Client 1</option>
						<option value="server">Serveur</option>
					</select> 
					<div class="form-group">
						<label>Dates:</label>
						<div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right" id="reservation" name="dates">
						</div><!-- /.input group -->
					</div><!-- /.form group -->
					<button type="submit" class="btn btn-primary">Afficher</button> 
				</div>
			</div>
			<div class="col-sm-6">
			</div>
		</div>
		</form>
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Entree</th>
                    <th>Repas</th>
                    <th>Dessert</th>
                    <th>Poste</th>
                    <th>Date et Heure</th>
                  </tr>
                </thead>
                <tbody>
                     <?php if($liste){
                            foreach ($liste as $row){
                                echo '<tr id="row-'.$row->id_user.'">
                                        <td>'.$row->firstname.'</td>
                                        <td>'.$row->lastname.'</td>
                                        <td>'.$row->starter.'</td>
                                        <td>'.$row->meal.'</td>
                                        <td>'.$row->dessert.'</td>
                                        <td>'.$row->place.'</td>
                                        <td>'.$row->date.'</td>
                                      </tr>';
                            }
                    } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Entree</th>
                    <th>Repas</th>
                    <th>Dessert</th>
                    <th>Poste</th>
                    <th>Date et Heure</th>
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
<script>
      $(function () {

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