<?php 

include_once 'config/class-master.php';
include_once 'config/class-mahasiswa.php';
$master = new MasterData();
// Mengambil daftar program studi, provinsi, dan status mahasiswa
$listKonser = $master->getKonser();
$listPelanggan = $master->getPelanggan();



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
								<h3 class="mb-0">Input Pesanan</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Input Data</li>
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
										<h3 class="card-title">Formulir Pemesanan Tiket</h3>
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
                                    <form action="proses/proses-input.php" method="POST">
    <div class="card-body">

        <!-- Nama Pelanggan -->
        <div class="mb-3">
            <label for="id_pelanggan" class="form-label">Nama Lengkap</label>
            <select class="form-select" id="id_pelanggan" name="id_pelanggan" required>
                <option value="" selected disabled>Nama Pelanggan</option>
                <?php 
                // Menampilkan daftar pelanggan dari array $listPelanggan
                foreach ($listPelanggan as $pelanggan){
                    echo '<option value="'.$pelanggan['id_pelanggan'].'">'.$pelanggan['nm_pelanggan'].'</option>';
                }
                ?>
            </select>
        </div>

        <!-- Nama Konser -->
        <div class="mb-3">
            <label for="id_konser" class="form-label">Nama Konser</label>
            <select class="form-select" id="id_konser" name="id_konser" required>
                <option value="" selected disabled>Pilih Konser</option>
                <?php 
                // Menampilkan daftar konser dari array $listKonser
                foreach ($listKonser as $konser){
                    echo '<option value="'.$konser['id_konser'].'">'.$konser['nm_konser'].'</option>';
                }
                ?>
            </select>
        </div>

        <!-- Jumlah Tiket -->
        <div class="mb-3">
        <label for="qty_tiket" class="form-label">Jumlah Tiket</label>
        <input type="number" class="form-control" id="qty_tiket" name="qty_tiket" placeholder="Masukkan jumlah tiket" required>
    </div>

    </div>

    <div class="card-footer">
        <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
        <button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
        <button type="submit" class="btn btn-primary float-end">Submit</button>
    </div>
</form>

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