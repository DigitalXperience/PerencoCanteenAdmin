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
            <?php if(isset($alert)) echo $alert; ?>
			<!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Entrez les informations de l'utilisateur</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url().'index.php/users/newuser'; ?>" method="post">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                                <div class="form-group">
                                  <label>Nom </label>
                                  <input type="text" name="lastname" value="<?php if(isset($current)) echo $current->lastname; ?>" required class="form-control" placeholder="Entrez son nom ">
                                </div>
                                <div class="form-group">
                                  <label>Prénom (falcutatif)</label>
                                  <input type="text" class="form-control" value="<?php if(isset($current)) echo $current->firstname; ?>" name="firstname" placeholder="Entrez son prénom">
                                </div>
                           </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" name="email" value="<?php if(isset($current)) echo $current->email; ?>" class="form-control" placeholder="Entrez son email">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Statut </label>
                                  <select class="form-control" name="status" required>
                                    <option value="">Sélectionnez un status</option>
                                    <option <?php if(isset($current) and ($current->status=='organic')) echo 'selected'; ?> value="organic">Organique</option>
                                    <option <?php if(isset($current) and ($current->status=='visitor')) echo 'selected'; ?> value="visitor">Visiteur</option>
                                    <option <?php if(isset($current) and ($current->status=='contracted')) echo 'selected'; ?> value="contracted">Contractuel</option>
                                  </select>
                                </div>
                           </div>
                       </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <?php if(isset($current)) echo '<input type="hidden" name="id_user" value="'.$current->id_user.'">'; ?>
                    <button type="submit" class="btn btn-primary">Enregistrer</button> <button type="reset" class="btn btn-default">Annuler</button>
                  </div>
                </form>
              </div><!-- /.box -->
         
		 
		 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include ('inc/footer.php'); ?>
