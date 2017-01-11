<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $name->firstname; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu">
            <li class="header">NAVIGATION</li>
            
			<li <?php if($this->uri->uri_string() == 'dashboard') { ?> class="active" <?php } ?>> <a href="<?php echo base_url(); ?>index.php/dashboard"> <i class="fa fa-dashboard"></i> <span>Tableau de Bord</span> </a></li>
            <li class="treeview <?php if($this->uri->uri_string() == 'users' || $this->uri->uri_string() == 'account' || $this->uri->uri_string() == 'account/newaccount' || $this->uri->uri_string() == 'users/newuser') { echo "active"; } ?>">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Utilisateurs & Comptes</span>
                <!--<span class="label label-primary pull-right">4</span>-->
              </a>
              <ul class="treeview-menu ">
                <li <?php if($this->uri->uri_string() == 'users') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/users"><i class="fa fa-users"></i> Liste Utilisateurs</a></li>
				<li <?php if($this->uri->uri_string() == 'users/newuser') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/users/newuser"><i class="fa fa-user-plus"></i> Nouvel Utilisateur</a></li>
				<li <?php if($this->uri->uri_string() == 'account/newaccount') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/account/newaccount"><i class="fa fa-user"></i> Créer Compte</a></li>
				<li <?php if($this->uri->uri_string() == 'account') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/account"><i class="fa fa-circle-o"></i> Solde des Comptes</a></li>
              </ul>
            </li>
            <li <?php if($this->uri->uri_string() == 'parameters') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/parameters"><i class="fa fa-gears"></i> Parametres</a></li>
            <li class="treeview <?php if($this->uri->uri_string() == 'juices' || $this->uri->uri_string() == 'juices/newjuice') { echo "active"; } ?>">
              <a href="#">
                <i class="fa fa-coffee"></i>
                <span>Gestion Boissons</span>
                <!--<span class="label label-primary pull-right">4</span>-->
              </a>
              <ul class="treeview-menu ">
                <li <?php if($this->uri->uri_string() == 'juices') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/juices"><i class="fa fa-coffee"></i> Liste des boissons</a></li>
				<li <?php if($this->uri->uri_string() == 'juices/newjuice') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/juices/newjuice"><i class="fa fa-user-plus"></i> Nouvelle Boisson</a></li>
              </ul>
            </li>
			<li <?php if($this->uri->uri_string() == 'report/logs') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/report/logs"><i class="fa fa-file-text-o"></i> Historiques</a></li>
			<li <?php if($this->uri->uri_string() == 'report/filter') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/report/filter"><i class="fa fa-files-o"></i> Rapports</a></li>
			<li <?php if($this->uri->uri_string() == 'report') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>index.php/report/weekstats"><i class="fa fa-pie-chart"></i> Statistiques</a></li>
			
			
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>