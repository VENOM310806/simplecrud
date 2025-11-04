<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar jenis bank
    public function getBank(){
        $query = "SELECT * FROM tb_jenis_bank";
        $result = $this->conn->query($query);
        $bank = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $bank[] = [
                    'id' => $row['kode_bank'],
                    'nama' => $row['nm_bank']
                ];
            }
        }
        return $bank;
    }

    // Method untuk mendapatkan daftar provinsi
    public function getProvinsi(){
        $query = "SELECT * FROM tb_provinsi";
        $result = $this->conn->query($query);
        $provinsi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $provinsi[] = [
                    'id' => $row['id_provinsi'],
                    'nama' => $row['nm_provinsi']
                ];
            }
        }
        return $provinsi;
    }

    // Method untuk mendapatkan daftar status nasabah menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Aktif'],
            ['id' => 2, 'nama' => 'Tidak Aktif'],
            ['id' => 3, 'nama' => 'Cuti'],
            ['id' => 4, 'nama' => 'Lulus']
        ];
    }

    // Method untuk input data jenis bank
    public function inputBank($data){
        $kodeBank = $data['kode'];
        $namaBank = $data['nama'];
        $query = "INSERT INTO tb_jenis_bank (kode_bank, nm_bank) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeBank, $namaBank);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data bank berdasarkan kode
    public function getUpdateBank($id){
        $query = "SELECT * FROM tb_jenis_bank WHERE kode_bank = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $bank = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $bank = [
                'id'   => $row['kode_bank'],
                'nama' => $row['nm_bank']
            ];
        }
        $stmt->close();
        return $bank;
    }

    // Method untuk mengedit data jenis bank
    public function updateBank($data){
        $kodeBank = $data['kode'];
        $namaBank = $data['nama'];
        $query = "UPDATE tb_jenis_bank SET nm_bank = ? WHERE id_bank = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaBank, $kodeBank);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data jenis bank
    public function deleteBank($id){
        $query = "DELETE FROM tb_jenis_bank WHERE kode_bank = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nm_provinsi) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdateProvinsi($id){
        $query = "SELECT * FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $provinsi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $provinsi = [
                'id' => $row['id_provinsi'],
                'nama' => $row['nm_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Method untuk mengedit data provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nm_provinsi = ? WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaProvinsi, $idProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
    public function deleteProvinsi($id){
        $query = "DELETE FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>