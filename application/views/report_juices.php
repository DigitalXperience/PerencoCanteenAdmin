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
		<form role="form" action="<?php echo base_url().'index.php/juices/report'; ?>" method="get">
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
				<?php 
					// On divise le tableau des boissons en 2 tableaux
					$i = 1;
					list($listeboissons1, $listeboissons2) = array_chunk($listeboissons, ceil(count($listeboissons) / 2));
					
				  ?>
                  <div class="form-group" style="width:49%; float:left">
				 <?php foreach($listeboissons1 as $boisson) { ?>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="jus<?php echo $boisson->id; ?>" value="yes" id="jus<?php echo $boisson->id; ?>" <?php if($this->input->get("jus{$boisson->id}")) echo "checked"; ?>>
                          <?php echo $boisson->name . "(Boisson " . $i . ")"; ?>
                        </label>
                      </div>
				 <?php $i++; } ?>
                      
                    </div>
					<div class="form-group" style="width:49%; float:right">
                      <?php foreach($listeboissons2 as $boisson) { ?>
						  <div class="checkbox">
							<label>
							  <input type="checkbox" name="jus<?php echo $boisson->id; ?>" value="yes" id="jus<?php echo $boisson->id; ?>" <?php if($this->input->get("jus{$boisson->id}")) echo "checked"; ?>>
							  <?php echo $boisson->name . "(Boisson " . $i . ")"; ?>
							</label>
						  </div>
					 <?php $i++; } ?>

                      

                      
                    </div>
                
              </div><!-- /.row -->
			  <div class="col-md-6">
                   <!-- Date and time range -->
					
                
                
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            <div class="box-footer" style="padding-bottom:0">
              
			   <button type="submit" class="btn btn-primary" style="float:right;margin-left:10px" onClick="window.location.href = '<?php echo base_url('index.php/juices/report'); ?>'; return false;">Affichage par défaut</button>
		  
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
					<?php foreach($listeboissons as $b) { ?>
					<?php if($this->input->get("jus{$b->id}")) echo '<th>' . "Boisson " . $b->id . '</th>'; ?>
					<?php } ?>
                    
                  </tr>
                </thead>
                <tbody>
                     <?php 
					 if($this->input->get("jus1")) $somj1 = 0;
					 if($this->input->get("jus2")) $somj2 = 0;
					 if($this->input->get("jus3")) $somj3 = 0;
					 if($this->input->get("jus4")) $somj4 = 0;
					 if($this->input->get("jus5")) $somj5 = 0;
					 if($liste){
							
                            foreach ($liste as $row){
								$bs = json_decode($row->boissons);
								
								echo '<tr><td>'.$row->date.'</td>';
								// for($x = 1; $x <= count($listeboissons); $x++) {
									// echo '<td>'; echo isset($bs->{'jus'.$x}) ? $bs->{'jus'.$x} : 0; echo '</td>';
								// }
								
								if($this->input->get("jus1")) { echo '<td>'; if(isset($bs->jus1)) {echo $bs->jus1; $somj1 = $somj1 + $bs->jus1; } else {echo "0";} echo '</td>'; }
								if($this->input->get("jus2")) { echo '<td>'; if(isset($bs->jus2)) {echo $bs->jus2; $somj2 = $somj2 + $bs->jus2; } else {echo "0";} echo '</td>'; }
								if($this->input->get("jus3")) { echo '<td>'; if(isset($bs->jus3)) {echo $bs->jus3; $somj3 = $somj3 + $bs->jus3; } else {echo "0";} echo '</td>'; }
								if($this->input->get("jus4")) { echo '<td>'; if(isset($bs->jus4)) {echo $bs->jus4; $somj4 = $somj4 + $bs->jus4; } else {echo "0";} echo '</td>'; }
								if($this->input->get("jus5")) { echo '<td>'; if(isset($bs->jus5)) {echo $bs->jus5; $somj5 = $somj5 + $bs->jus5; } else {echo "0";} echo '</td>'; }
								
                                echo '</tr>';
                            }
							
                    } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <?php foreach($listeboissons as $b) { ?>
					<?php if($this->input->get("jus{$b->id}")) echo '<th>'. ${'somj'.$b->id} . '</th>'; ?>
					<?php } ?>
                    <?php if($this->input->get('sboisson') && $liste) { ?><th>
					
					<?php } ?>
					
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
    $("#example1").DataTable({
      "order": [[ 0, "desc"]]
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

        
      });
</script>