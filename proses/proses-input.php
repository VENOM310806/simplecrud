<?php

// Memasukkan file class-nasabah.php untuk mengakses class Nasabah
include '../config/class-mahasiswa.php';
// Membuat objek dari class Nasabah
$nasabah = new Nasabah();
// Mengambil data nasabah dari form input menggunakan metode POST dan menyimpannya dalam array
$dataNasabah = [
    'norek'    => $_POST['norek'],
    'nama'     => $_POST['nama'],
    'bank'     => $_POST['bank'],
    'alamat'   => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email'    => $_POST['email'],
    'telp'     => $_POST['telp'],
    'status'   => $_POST['status']
];
// Memanggil method inputNasabah untuk memasukkan data nasabah dengan parameter array $dataNasabah
$input = $nasabah->inputNasabah($dataNasabah);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>