<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include ('inc/head.php'); ?>
<?php include ('inc/menu.php'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Créditer un compte
            <!--<small>Control panel</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li class="active">Créditer un compte</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php if(isset($alert)) echo $alert; ?>
			<div class="row">
			<div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Créer le comptes d'un utilisateur</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="<?php echo base_url(); ?>index.php/account/credit/<?php echo $user->id_user; ?>">
                  <div class="box-body">
					<div class="form-group">
                      <label for="user">Utilisateur</label>
                      <input type="text" disabled class="form-control" value="<?php echo $user->lastname . ' ' . $user->firstname; ?>">
                    </div>
                    <div class="form-group">
                      <label for="entree">Entrees (Actuellement <?php echo ($user->starter) ? : 0; ?>)</label>
                      <input type="text" class="form-control" id="starter" name="starter" value="">
                      <div class="radio">
                        
						<label>
                          <input type="radio" checked="" value="cash" >
                          Payé
                        </label>
                      </div>
                    </div>
					<?php if($user->status == 'visitor') { ?>
					<div class="form-group">
                      <label for="entree">Plat chaud (Actuellement <?php echo ($user->meal) ? : 0; ?>)</label>
                      <input type="text" class="form-control" id="meal" name="meal" value="">
                    </div>
					<?php } ?>
					<div class="form-group">
                      <label for="entree">Dessert (Actuellement <?php echo ($user->dessert) ? : 0; ?>)</label>
                      <input type="text" class="form-control" id="dessert" name="dessert" value="">
					  <div class="radio">
                        
						<label>
                          <input type="radio" checked="" value="cash" />
                          Payé
                        </label>
                      </div>
                    </div>
					
                  </div><!-- /.box-body -->
                  <div class="box-footer">
					<input type="hidden" id="id_user" name="id_user" value="<?php echo $user->id_user; ?>">
					<input type="hidden" id="old_starter" name="old_starter" value="<?php echo $user->starter; ?>">
					<?php if($user->status == 'visitor') { ?><input type="hidden" id="old_meal" name="old_meal" value="<?php echo $user->meal; ?>"><?php } ?>
					<input type="hidden" id="old_dessert" name="old_dessert" value="<?php echo $user->dessert; ?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div><!--/.col (left) -->
            <!-- right column -->
		   </div>		 
		 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2016 <a href="http://www.perenco.com">Perenco</a>.</strong> All rights reserved.
      </footer>

      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

   <!-- jQuery 2.1.4 -->
   <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
   
  </body>
</html>
