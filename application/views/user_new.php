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
          
			<!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Entrez les informations de l'utilisateur</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                                <div class="form-group">
                                  <label>Nom *</label>
                                  <input type="text" class="form-control" placeholder="Entez le nom de l'utilisateur">
                                </div>
                                <div class="form-group">
                                  <label>Prénom</label>
                                  <input type="text" class="form-control" placeholder="Entez le prénom de l'utilisateur">
                                </div>
                           </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                  <label>Email *</label>
                                  <input type="email" class="form-control" placeholder="Entrer son email">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Statut *</label>
                                  <select class="form-control">
                                    <option>Sélectionnez un status</option>
                                    <option>Organic</option>
                                    <option>Visiteur</option>
                                    <option>Contractuel</option>
                                  </select>
                                </div>
                           </div>
                       </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button> <button type="reset" class="btn btn-default">Annuler</button>
                  </div>
                </form>
              </div><!-- /.box -->
         
		 
		 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include ('inc/footer.php'); ?>

