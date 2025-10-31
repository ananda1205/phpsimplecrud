<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-mahasiswa.php';
// Membuat objek dari class Mahasiswa
$pesanan = new Pesanan();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataPesanan = [
    'id_pelanggan' => $_POST['id_pelanggan'],
    'id_konser' => $_POST['id_konser'],
    'qty_tiket' => $_POST['qty_tiket']
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $pesanan->inputPesanan($dataPesanan);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>