<?php 
//tcpdf();
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$this->load->helper('date');
$datestring = strftime('%A %d  %Y, %H:%M');
//var_dump($datestring);die;
$time = time();

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Rapport des consommations de la cantine";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, "Imprimé le $datestring");
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$obj_pdf->SetLineWidth(0.3);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();

ob_start();
?>
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped" border="1" cellpadding="2">
                <thead>
                  <tr>
                    <th>Date</th>
                    <?php if($this->input->get('starter')) { ?><th>Entrees</th><?php } ?>
                    <?php if($this->input->get('meal')) { ?><th>Plats Chauds</th><?php } ?>
                    <?php if($this->input->get('dessert')) { ?><th>Desserts</th><?php } ?>
                    <?php if($this->input->get('sstarter')) { ?> <th>Entrees (cfa)</th><?php } ?>
                     <?php if($this->input->get('smeal')) { ?><th>Plats (cfa)</th><?php } ?>
                    <?php if($this->input->get('sdessert')) { ?><th>Desserts (cfa)</th><?php } ?>
                    <th>Total cfa</th>
                  </tr>
                </thead>
                <tbody>
                     <?php if($liste){
							if($this->input->get('starter')) { $sum_entree = 0; }
							if($this->input->get('meal')) { $sum_repas = 0; }
							if($this->input->get('dessert')) { $sum_dessert = 0; }
							if($this->input->get('sstarter')) { $sum_entreef = 0; }
							if($this->input->get('smeal')) { $sum_repasf = 0; }
							if($this->input->get('sdessert')) { $sum_dessertf = 0; }
                            foreach ($liste as $row){
								$sumday = 0;
								if($this->input->get('starter') && $this->input->get('sstarter')) $sumday += (abs($row->starters) * $params['starter_price']);
								if($this->input->get('meal') && $this->input->get('smeal')) $sumday += (abs($row->meals) * $params['meal_price']);
								if($this->input->get('dessert') && $this->input->get('sdessert')) $sumday += (abs($row->desserts) * $params['dessert_price']);
                                echo '<tr>
                                        <td>'.$row->dat.'</td>';
                                        if($this->input->get('starter')) {  echo '<td>'.abs($row->starters) .'</td>'; }
                                        if($this->input->get('meal')) { echo '<td>'.abs($row->meals).'</td>'; }
                                        if($this->input->get('dessert')) { echo '<td>'.abs($row->desserts).'</td>'; }
                                       if($this->input->get('sstarter')) {  echo '<td>'.(abs($row->starters) * $params['starter_price']) .'</td>'; }
                                        if($this->input->get('smeal')) { echo '<td>'.(abs($row->meals) * $params['meal_price']).'</td>'; }
                                        if($this->input->get('sdessert')) { echo '<td>'.(abs($row->desserts) * $params['dessert_price']).'</td>'; }
                                        echo '<td>'.$sumday.'</td>';
                                      echo '</tr>';
								if($this->input->get('starter')) { $sum_entree += abs($row->starters); }
								if($this->input->get('meal')) { $sum_repas += abs($row->meals); }
								if($this->input->get('dessert')) { $sum_dessert += abs($row->desserts); }
								if($this->input->get('sstarter')) { $sum_entreef += (abs($row->starters) * $params['starter_price']); }
								if($this->input->get('smeal')) { $sum_repasf += (abs($row->meals) * $params['meal_price']); }
								if($this->input->get('sdessert')) { $sum_dessertf += (abs($row->desserts) * $params['dessert_price']); }
                            }
                    } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <?php if($this->input->get('starter') && $liste) { ?> <th>Total : <?php echo $sum_entree; ?></th><?php } ?>
                   <?php if($this->input->get('meal') && $liste) { ?> <th>Total : <?php echo $sum_repas; ?></th><?php } ?>
                    <?php if($this->input->get('dessert') && $liste) { ?><th>Total : <?php echo $sum_dessert; ?></th><?php } ?>
					 <?php if($this->input->get('sstarter') && $liste) { ?><th>Total : <?php echo $sum_entreef; ?></th><?php } ?>
                    <?php if($this->input->get('smeal') && $liste) { ?><th>Total : <?php echo $sum_repasf; ?></th><?php } ?>
                    <?php if($this->input->get('sdessert') && $liste) { ?><th>Total : <?php echo $sum_dessertf; ?></th><?php } ?>
					
                    <th>Total cfa</th>
                  </tr>
                </tfoot>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
      </div>
	  <?php
 $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');

?>