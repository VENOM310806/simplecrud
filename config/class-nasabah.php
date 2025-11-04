<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Nasabah extends Database {

    // Method untuk input data nasabah
    public function inputNasabah($data){
        // Mengambil data dari parameter $data
        $norek      = $data['norek'];
        $nama       = $data['nama'];
        $bank       = $data['bank'];
        $alamat     = $data['alamat'];
        $provinsi   = $data['provinsi'];
        $email      = $data['email'];
        $telp       = $data['telp'];
        $status     = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_nasabah (no_rekening, nm_nsb, jenis_bank, alamat, provinsi, email, telp, status_nsb) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $norek, $nama, $bank, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data nasabah
    public function getAllNasabah(){
        // Menyiapkan query SQL untuk mengambil data nasabah beserta bank dan provinsi
        $query = "SELECT id_nsb, no_rekening, nm_nsb, nm_bank, alamat, nm_provinsi, email, telp, status_nsb
                  FROM tb_nasabah
                  JOIN tb_jenis_bank ON jenis_bank = kode_bank
                  JOIN tb_provinsi ON provinsi = id_provinsi";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data nasabah
        $nasabah = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $nasabah[] = [
                    'id'       => $row['id_nsb'],
                    'norek'    => $row['no_rekening'],
                    'nama'     => $row['nm_nsb'],
                    'bank'     => $row['nm_bank'],
                    'alamat'   => $row['alamat'],
                    'provinsi' => $row['nm_provinsi'],
                    'email'    => $row['email'],
                    'telp'     => $row['telp'],
                    'status'   => $row['status_nsb']
                ];
            }
        }
        // Mengembalikan array data nasabah
        return $nasabah;
    }

    // Method untuk mengambil data nasabah berdasarkan ID
    public function getUpdateNasabah($id){
        // Menyiapkan query SQL untuk mengambil data nasabah berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_nasabah WHERE id_nsb = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data nasabah  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id'         => $row['id_nsb'],
                'norek'      => $row['no_rekening'],
                'nama'       => $row['nm_nsb'],
                'bank'       => $row['jenis_bank'],
                'alamat'     => $row['alamat'],
                'provinsi'   => $row['provinsi'],
                'email'      => $row['email'],
                'telp'       => $row['telp'],
                'status'     => $row['status_nsb']
            ];
        }
        $stmt->close();
        // Mengembalikan data nasabah
        return $data;
    }

    // Method untuk mengedit data nasabah
    public function editNasabah($data){
        // Mengambil data dari parameter $data
        $id         = $data['id'];
        $norek      = $data['norek'];
        $nama       = $data['nama'];
        $bank       = $data['bank'];
        $alamat     = $data['alamat'];
        $provinsi   = $data['provinsi'];
        $email      = $data['email'];
        $telp       = $data['telp'];
        $status     = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_nasabah SET no_rekening = ?, nm_nsb = ?, jenis_bank = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_nsb = ? WHERE id_nsb = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssssi", $norek, $nama, $bank, $alamat, $provinsi, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data nasabah
    public function deleteNasabah($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_nasabah WHERE id_nsb = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data nasabah berdasarkan kata kunci
    public function searchNasabah($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data nasabah menggunakan prepared statement
        $query = "SELECT id_nsb, no_rekening, nm_nsb, nm_bank, alamat, provinsi, email, telp, status_nsb 
                  FROM tb_nasabah
                  JOIN tb_jenis_bank ON jenis_bank = kode_bank
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE no_rekening LIKE ? OR nm_nsb LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data nasabah
        $nasabah = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data nasabah dalam array
                $nasabah[] = [
                    'id'       => $row['id_nsb'],
                    'norek'    => $row['no_rekening'],
                    'nama'     => $row['nm_nsb'],
                    'bank'     => $row['nm_bank'],
                    'alamat'   => $row['alamat'],
                    'provinsi' => $row['provinsi'],
                    'email'    => $row['email'],
                    'telp'     => $row['telp'],
                    'status'   => $row['status_nsb']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data nasabah yang ditemukan
        return $nasabah;
    }

}

?>