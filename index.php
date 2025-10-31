<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; // Menyertakan header template ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; // Menyertakan navbar template ?>

			<?php include 'template/sidebar.php'; // Menyertakan sidebar template ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">GROOVE PASS</h3>
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
										<h3 class="card-title">Selamat Datang!</h3>
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

									<div class="card-body">
										<p>Groove Pass adalah sebuah website pemesanan tiket konser yang dirancang untuk memberikan pengalaman praktis dan menyenangkan bagi para pecinta musik. Melalui platform ini, pengguna dapat dengan mudah menemukan berbagai konser dari beragam band dan artis favorit mereka, serta melakukan pemesanan tiket hanya dalam beberapa langkah. Tampilan yang sederhana namun interaktif membuat pengguna dapat menjelajahi jadwal konser, harga tiket, dan detail acara dengan nyaman dan efisien.</p>
										<p>Groove Pass dilengkapi dengan fitur CRUD (Create, Read, Update, Delete) yang memungkinkan pengelola sistem untuk menambahkan, menampilkan, mengubah, dan menghapus data pemesan tiket, nama konser, serta nama band.</p>
										<a href="data-input.php" class="btn btn-primary btn-lg"><i class="bi bi-clipboard-data-fill"></i> Input Data Mahasiswa</a>
										<a href="data-list.php" class="btn btn-success btn-lg"><i class="bi bi-card-list"></i> Lihat Daftar Mahasiswa</a>
										<a href="data-search.php" class="btn btn-warning btn-lg"><i class="bi bi-search-heart-fill"></i> Cari Mahasiswa</a>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; // Menyertakan footer template ?>

		</div>
		
		<?php include 'template/script.php'; // Menyertakan script template ?>

	</body>
</html>