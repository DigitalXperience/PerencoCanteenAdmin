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
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Entrees</th>
                    <th>Plats Chauds</th>
                    <th>Desserts</th>
                    <th>Entrees (cfa)</th>
                    <th>Plats (cfa)</th>
                    <th>Desserts (cfa)</th>
                    <th>Terminal</th>
                  </tr>
                </thead>
                <tbody>
                     <?php if($liste){
							$sum_entree = 0;
							$sum_repas = 0;
							$sum_dessert = 0;
							$sum_entreef = 0;
							$sum_repasf = 0;
							$sum_dessertf = 0;
                            foreach ($liste as $row){
                                echo '<tr id="row-'.$row->id.'">
                                        <td>'.$row->dat.'</td>
                                        <td>'.abs($row->starters) .'</td>
                                        <td>'.abs($row->meals).'</td>
                                        <td>'.abs($row->desserts).'</td>
                                        <td>'.(abs($row->starters) * $params['starter_price']) .'</td>
                                        <td>'.(abs($row->meals) * $params['meal_price']).'</td>
                                        <td>'.(abs($row->desserts) * $params['dessert_price']).'</td>
                                        <td>'.$row->place.'</td>
                                      </tr>';
								$sum_entree += abs($row->starters);
								$sum_repas += abs($row->meals);
								$sum_dessert += abs($row->desserts);
								$sum_entreef += (abs($row->starters) * $params['starter_price']);
								$sum_repasf += (abs($row->meals) * $params['meal_price']);
								$sum_dessertf += (abs($row->desserts) * $params['dessert_price']);
                            }
                    } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <th>Total : <?php echo $sum_entree; ?></th>
                    <th>Total : <?php echo $sum_repas; ?></th>
                    <th>Total : <?php echo $sum_dessert; ?></th>
					 <th>Total : <?php echo $sum_entreef; ?></th>
                    <th>Total : <?php echo $sum_repasf; ?></th>
                    <th>Total : <?php echo $sum_dessertf; ?></th>
					
                    <th>Terminal</th>
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
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
    
 function deleteUser(id){
	var r=confirm(" Voulez vous vraiment supprimer cet utilisateur?");
	if(r){
		$.post( "users/deleteuser", { id_user: id }).done(function( data ) {
            if(data == 'true') {
                setTimeout(function(){
                    $('#'+id).remove();
                    return false;
                }, 2000);
            } else {
                alert(data);
            }
        });
	}
}
</script>