<?php
session_start();
if (empty($_SESSION['username']) and empty($_SESSION['passuser'])) {
	echo "<link href=../css/style.css rel=stylesheet type=text/css>";
	echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
} else {

	$aksi = "modul/mod_carabayar/aksi_carabayar.php";
	$aksi_carabayar = "masuk/modul/mod_carabayar/aksi_carabayar.php";
	switch ($_GET['act']) {
			// Tampil Siswa
		default:


			$tampil_carabayar = $db->query("SELECT * FROM carabayar ORDER BY id_carabayar ");

?>


			<div class="card">
				<div class="card-header">
					<h3 class="card-title">JENIS PEMBAYARAN KASIR</h3>
					<div class="float-end">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div><!-- /.box-tools -->
				</div>
				<div class="card-body">
					<a class='btn btn-success' style="min-width: 100px;" href='?module=carabayar&act=tambah'>TAMBAH</a>
					<br><br>


					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Jenis</th>
								<th width="70">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							while ($r = $tampil_carabayar->fetch(PDO::FETCH_ASSOC)) {
								echo "<tr class='warnabaris' >
											<td>$no</td>           
											 <td>$r[nm_carabayar]</td>
											 <td><a href='?module=carabayar&act=edit&id=$r[id_carabayar]' title='EDIT' class='btn btn-warning btn-sm'>EDIT</a> 
											 <a href='$aksi?module=carabayar&act=hapus&id=$r[id_carabayar]' data-confirm='Anda yakin ingin menghapus?' title='HAPUS' class='btn btn-danger btn-sm'>HAPUS</a>
											 
											</td>
										</tr>";
								$no++;
							}
							echo "</tbody></table>";
							?>
				</div>
			</div>


<?php

			break;

		case "tambah":

			echo "
		  <div class='card'>
				<div class='card-header'>
					<h3 class='card-title'>TAMBAH</h3>
					<div class='float-end'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='card-body'>
				
						<form method=POST action='$aksi?module=carabayar&act=input_carabayar' enctype='multipart/form-data' class='form-horizontal'>
						
							  <div class='row mb-3'>
									<label class='col-sm-2 col-form-label'>Jenis</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nm_carabayar' class='form-control' required='required' autocomplete='off'>
									 </div>
							  </div>
							  
							  <div class='row mb-3'>
									<label class='col-sm-2 col-form-label'></label>       
										<div class='col-sm-5'>
											<input class='btn btn-primary' type=submit value=SIMPAN>
											<input class='btn btn-danger' type=button value=BATAL onclick=self.history.back()>
										</div>
								</div>
								
							  </form>
							  
				</div> 
				
			</div>";


			break;

		case "edit":
			$edit = $db->prepare("SELECT * FROM carabayar WHERE id_carabayar=?");
			$edit->execute([$_GET['id']]);
			$r = $edit->fetch(PDO::FETCH_ASSOC);

			echo "
		  <div class='card border-danger'>
				<div class='card-header bg-danger text-white'>
					<h3 class='card-title'>UBAH</h3>
					<div class='float-end'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='card-body'>
						<form method=POST method=POST action=$aksi?module=carabayar&act=update_carabayar  enctype='multipart/form-data' class='form-horizontal'>
							  <input type=hidden name=id value='$r[id_carabayar]'>
							  
							  <div class='row mb-3'>
									<label class='col-sm-2 col-form-label'>Jenis</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nm_carabayar' class='form-control' value='$r[nm_carabayar]' autocomplete='off'>
									 </div>
							  </div>
							  
							  <div class='row mb-3'>
									<label class='col-sm-2 col-form-label'></label>       
										<div class='col-sm-5'>
											<input class='btn btn-primary' type=submit value=SIMPAN>
											<input class='btn btn-danger' type=button value=BATAL onclick=self.history.back()>
										</div>
								</div>
								
							  </form>
							  
				</div> 
				
			</div>";




			break;
	}
}
?>

<script type="text/javascript">
	$(function() {
		$(".datepicker").datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
			todayHighlight: true,
		});
	});
</script>