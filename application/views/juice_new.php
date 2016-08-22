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
                  <h3 class="box-title">Entrez les informations de la boisson</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url().'index.php/juices/newjuice'; ?>" method="post">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                                <div class="form-group">
                                  <label>Nom </label>
                                  <input type="text" name="name" value="<?php if(isset($current)) echo $current->name; ?>" required class="form-control" placeholder="Entrez son nom ">
                                </div>
								<div class="form-group">
                                  <label for="exampleInputPassword1">Statut </label>
                                  <select class="form-control" name="status" required>
                                    <option value="">Sélectionnez un status</option>
                                    <option <?php if(isset($current) and ($current->status=='actif')) echo 'selected'; ?> value="actif">Actif</option>
                                    <option <?php if(isset($current) and ($current->status=='non-actif')) echo 'selected'; ?> value="non-actif">Non actif</option>
                                  </select>
                                </div>
                                
                           </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                  <label>Prix</label>
                                  <input type="text" class="form-control" value="<?php if(isset($current)) echo $current->price; ?>" name="price" placeholder="Entrez son prix">
                                </div>
                                
                           </div>
                       </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <?php if(isset($current)) echo '<input type="hidden" name="id" value="'.$current->id.'">'; ?>
                    <button type="submit" class="btn btn-primary">Enregistrer</button> <button type="reset" class="btn btn-default">Annuler</button>
                  </div>
                </form>
              </div><!-- /.box -->
         
		 
		 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include ('inc/footer.php'); ?>
