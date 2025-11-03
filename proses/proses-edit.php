<?php

// Memasukkan file class-nasabah.php untuk mengakses class Nasabah
include_once '../config/class-mahasiswa.php';
// Membuat objek dari class Nasabah
$nasabah = new Nasabah();
// Mengambil data nasabah dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataNasabah = [
    'id'       => $_POST['id'],
    'norek'    => $_POST['norek'],
    'nama'     => $_POST['nama'],
    'bank'     => $_POST['bank'],
    'alamat'   => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email'    => $_POST['email'],
    'telp'     => $_POST['telp'],
    'status'   => $_POST['status']
];
// Memanggil method editNasabah untuk mengupdate data nasabah dengan parameter array $dataNasabah
$edit = $nasabah->editNasabah($dataNasabah);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id nasabah
    header("Location: ../data-edit.php?id=".$dataNasabah['id']."&status=failed");
}

?>