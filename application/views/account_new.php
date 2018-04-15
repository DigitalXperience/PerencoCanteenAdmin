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
            <li class="active">Ajouter un compte</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php if(isset($alert)) echo $alert; ?>
			
			
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Créer un compte utilisateur</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="<?php echo base_url(); ?>index.php/account/newaccount">
                  <div class="box-body">
					<div class="col-md-6">
						<div class="form-group">
						  <label>Selectionner utilisateur</label>
						  <select class="form-control" name="id_user" id="id_user">
							<?php foreach($users as $user) { ?>
							<option value="<?php echo $user->id_user ?>"><?php echo $user->lastname . ' ' . $user->firstname; ?></option>
							<?php } ?>
						  </select>
						</div>
					
						<div class="form-group" style="display:none">
						  <label for="PIN">PIN</label>
						  <input type="text" class="form-control" id="PIN" name="PIN" value="<?php echo $pin; ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Status</label>
						  <select class="form-control" name="blocked">
							<option value="0">Activé</option>
							<option value="1">Bloqué</option>
						  </select>
						</div>
						<div class="form-group">
						<label>Envoyer un mail</label>
						 <div class="input-group">
							
							<span class="input-group-addon">
							  <input type="checkbox">
							</span>
							<input type="text" id="email" name="email" class="form-control">
						  </div><!-- /input-group -->
						 </div>
					</div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            <!--/.col (left) -->
            <!-- right column -->
            	 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include ('inc/footer.php'); ?>
<script>
	$('#id_user').on('change', function() {
	  // alert( this.value ); // or $(this).val()
	  var server="<?php echo base_url(); ?>index.php/account/get_email/"+this.value+"?";
	  $.ajax({
			url: server+"&callback=?",
			data: "place=client1",
			type: 'GET',
			success: function (resp) { 
			 //alert( resp );
				$('#email').val(resp);	
			},
			error: function(e) {
				//alert('Error: '+e);
			}  
		});
	});
     
</script>