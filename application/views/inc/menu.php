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
            <li class="active"> <a href="<?php echo base_url(); ?>dashboard"> <i class="fa fa-dashboard"></i> <span>Tableau de Bord</span> </a></li>
            <li><a href="<?php echo base_url(); ?>users"><i class="fa fa-users"></i> Liste Utilisateurs</a></li>
            <li><a href="<?php echo base_url(); ?>users/newuser"><i class="fa fa-circle-o"></i> Nouvel Utilisateur</a></li>
            <li><a href="<?php echo base_url(); ?>account"><i class="fa fa-circle-o"></i> Solde des Comptes</a></li>
            <li><a href="<?php echo base_url(); ?>account/newaccount"><i class="fa fa-circle-o"></i> Créer Compte</a></li>
            <li><a href="<?php echo base_url(); ?>account/reset_pin"><i class="fa fa-circle-o"></i> Reset PIN</a></li>
            <li><a href="<?php echo base_url(); ?>report"><i class="fa fa-circle-o"></i> Statistique & Rapports</a></li>
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>