<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include ('inc/head.php'); ?>
<?php include ('inc/menu.php'); ?>
<?php 
$dates = $this->input->get('dates');
$poste = $this->input->get('poste');
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
		<form role="form" action="<?php echo base_url().'index.php/report/logs'; ?>" method="get">
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
                   <div class="form-group">
						<label>Dates:</label>
						<div class="input-group">
						  <div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						  </div>
						  <input type="text" class="form-control pull-right" id="reservation" name="dates" value="<?php echo $dates; ?>">
						</div><!-- /.input group -->
					</div><!-- /.form group -->
                <!-- checkbox -->
					<div class="form-group">
						<label>Terminal</label>
						<select name="poste" aria-controls="example1" class="form-control">
							<option value="">Tous</option>
							<option value="client" <?php if($poste=="client") echo "selected"; ?>>TPV</option>
							<option value="server" <?php if($poste=="server") echo "selected"; ?>>Serveur</option>
						</select>
					</div>
                </div><!-- /.col -->
                
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="float:right;margin-left:10px" onClick="window.location.href = '<?php echo base_url('index.php/report/logs'); ?>'; return false;">Affichage par défaut</button>
		  
			  <button type="submit" class="btn btn-primary" style="float:right;">Appliquer les parametres</button>  
            </div>
          </div><!-- Parametre du filtre -->
		</form>
		
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
					<th>#</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Entree</th>
                    <th>Repas</th>
                    <th>Dessert</th>
                    <th>Boisson</th>
                    <th>Solde</th>
                    <th>Transaction</th>
                    <th>Date et Heure</th>
                  </tr>
                </thead>
                <tbody>
                     <?php if(!empty($liste)){
							$sum_entree = 0;
							$sum_repas = 0;
							$sum_dessert = 0;
							
                            foreach ($liste as $row){
								if($row->place == 'client1' || $row->place == 'client2') $trans = 'Débit'; else $trans = 'Crédit';
                                echo '<tr id="row-'.$row->id_user.'">
                                        <td>'.$row->id_user.'</td>
                                        <td>'.$row->firstname.'</td>
                                        <td>'.$row->lastname.'</td>
                                        <td>'.abs($row->starter).'</td>
                                        <td>'.abs($row->meal).'</td>
                                        <td>'.abs($row->dessert).'</td>
                                        <td>'.abs($row->expenses).'</td>
                                        <td>'.$row->balance.'</td>
                                        <td>'.$trans.'</td>
                                        <td>'.$row->date.'</td>
                                      </tr>';
								$sum_entree += abs($row->starter);
								$sum_repas += abs($row->meal);
								$sum_dessert += abs($row->dessert);
                            }
                    }
						else {
							$sum_entree = 0;
							$sum_repas = 0;
							$sum_dessert = 0;
						}
					?>
                </tbody>
                <tfoot>
                  <tr>
                     <th>#</th>
                     <th>Prénom</th>
                    <th>Nom</th>
                    <th>Entree</th>
                    <th>Repas</th>
                    <th>Dessert</th>
                    <th>Boisson</th>
                    <th>Solde</th>
                    <th>Transaction</th>
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
   $("#example1").DataTable(
   {
      "order": [[ 9, "desc" ]]
    });
    
  });
 $(function () {

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
      
      });
    </script>