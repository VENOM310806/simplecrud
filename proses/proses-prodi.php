<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputbank'){
    // Mengambil data bank dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataBank = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputBank untuk memasukkan data bank dengan parameter array $dataBank
    $input = $master->inputBank($databank);
    if($input){
        // Jika berhasil, redirect ke halaman master-bank-list.php dengan status inputsuccess
        header("Location: ../master-prodi-list.php?status=inputsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-bank-input.php dengan status failed
        header("Location: ../master-prodi-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatebank'){
    // Mengambil data bank dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataBank = [
        'id'   => $_POST['id'],
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateBank untuk mengupdate data bank dengan parameter array $dataBank
    $update = $master->updateBank($dataBank);
    if($update){
        // Jika berhasil, redirect ke halaman master-bank-list.php dengan status editsuccess
        header("Location: ../master-prodi-list.php?status=editsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-bank-edit.php dengan status failed dan membawa id bank
        header("Location: ../master-prodi-edit.php?id=".$dataBank['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletebank'){
    // Mengambil id bank dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deletebank untuk menghapus data bank berdasarkan id
    $delete = $master->deleteBank($id);
    if($delete){
        // Jika berhasil, redirect ke halaman master-bank-list.php dengan status deletesuccess
        header("Location: ../master-prodi-list.php?status=deletesuccess");
    } else {
        // Jika gagal, redirect ke halaman master-bank-list.php dengan status delete failed
        header("Location: ../master-prodi-list.php?status=deletefailed");
    }
}

?>