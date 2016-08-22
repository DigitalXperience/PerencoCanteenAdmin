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
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                     <?php if($liste){
                            foreach ($liste as $row){
                                echo '<tr id="row-'.$row->id.'">
                                        <td>'.$row->id.'</td>
                                        <td>'.$row->name.'</td>
                                        <td>'.$row->price.'</td>
                                        <td>'.$row->status.'</td>
                                        <td><a href="juices/updatejuice/'.$row->id.'" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Modifier"><i class="fa fa-pencil"></i></a>
                                            <a href="#" onclick="deleteJuice('.$row->id.')" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Supprimer"><i class="fa fa-trash"></i></a>
                                        </td>
                                      </tr>';
                            }
                    } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Actions</th>
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
    
 function deleteJuice(id){
	var r=confirm(" Voulez vous vraiment supprimer cette boisson ?");
	if(r){
		$.post( "juices/deletejuice", { id: id }).done(function( data ) {
            if(data == 'true') {
                setTimeout(function(){
                    $('#row-'+id).remove();
                    return false;
                }, 2000);
            } else {
                alert(data);
            }
        });
	}
}
</script>