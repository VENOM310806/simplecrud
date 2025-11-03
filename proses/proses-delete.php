<?php

// Memasukkan file class-nasabah.php untuk mengakses class Nasabah
include_once '../config/class-mahasiswa.php';
// Membuat objek dari class Nasabah
$nasabah = new Nasabah();
// Mengambil id nasabah dari parameter GET
$id = $_GET['id'];
// Memanggil method deleteNasabah untuk menghapus data nasabah berdasarkan id
$delete = $nasabah->deleteNasabah($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>