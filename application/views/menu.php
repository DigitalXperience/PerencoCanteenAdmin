<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<ul class="sidebar-menu">
	<li class="header">NAVIGATION</li>
	<li class="active treeview">
	  <a href="#">
		<i class="fa fa-dashboard"></i> <span>Tableau de Bord</span> <i class="fa fa-angle-left pull-right"></i>
	  </a>
	  <ul class="treeview-menu">
		<li class="active"><a href="<?php echo base_url(); ?>users"><i class="fa fa-circle-o"></i> Liste Utilisateurs</a></li>
		<li><a href="<?php echo base_url(); ?>users/newuser"><i class="fa fa-circle-o"></i> Nouvel Utilisateur</a></li>
		<li><a href="<?php echo base_url(); ?>account"><i class="fa fa-circle-o"></i> Solde des Comptes</a></li>
		<li><a href="<?php echo base_url(); ?>account/newaccount"><i class="fa fa-circle-o"></i> Créer Compte</a></li>
		<li><a href="<?php echo base_url(); ?>account/reset_pin"><i class="fa fa-circle-o"></i> Reset PIN</a></li>
		<li><a href="<?php echo base_url(); ?>report"><i class="fa fa-circle-o"></i> Statistique & Rapports</a></li>
	  </ul>
	
           <!--
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
</ul>