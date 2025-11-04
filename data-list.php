<?php

include_once 'config/class-nasabah.php';
$nasabah = new Nasabah();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data nasabah berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data nasabah berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data nasabah berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data nasabah. Silakan coba lagi.');</script>";
	}
}
$dataNasabah = $nasabah->getAllNasabah();

?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; ?>

			<?php include 'template/sidebar.php'; ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Daftar Nasabah</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Beranda</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Tabel Nasabah</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>No</th>
													<th>No Rekening</th>
													<th>Nama</th>
													<th>Jenis Bank</th>
													<th>Alamat</th>
													<th>Provinsi</th>
													<th>Telp</th>
													<th>Email</th>
													<th class="text-center">Status</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($dataNasabah) == 0){
													    echo '<tr class="align-middle">
															<td colspan="10" class="text-center">Tidak ada data nasabah.</td>
														</tr>';
													} else {
														foreach ($dataNasabah as $index => $nasabah){
															if($nasabah['status'] == 1){
															    $nasabah['status'] = '<span class="badge bg-success">Aktif</span>';
															} elseif($nasabah['status'] == 2){
															    $nasabah['status'] = '<span class="badge bg-danger">Tidak Aktif</span>';
															} elseif($nasabah['status'] == 3){
															    $nasabah['status'] = '<span class="badge bg-warning text-dark">Cuti</span>';
															} elseif($nasabah['status'] == 4){
															    $nasabah['status'] = '<span class="badge bg-primary">Lulus</span>';
															} 
															echo '<tr class="align-middle">
																<td>'.($index + 1).'</td>
																<td>'.$nasabah['norek'].'</td>
																<td>'.$nasabah['nama'].'</td>
																<td>'.$nasabah['bank'].'</td>
																<td>'.$nasabah['alamat'].'</td>
																<td>'.$nasabah['provinsi'].'</td>
																<td>'.$nasabah['telp'].'</td>
																<td>'.$nasabah['email'].'</td>
																<td class="text-center">'.$nasabah['status'].'</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$nasabah['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data nasabah ini?\')){window.location.href=\'proses/proses-delete.php?id='.$nasabah['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Nasabah</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; ?>

		</div>
		
		<?php include 'template/script.php'; ?>

	</body>
</html>