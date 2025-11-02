<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar konser
    public function getKonser(){
        $query = "SELECT * FROM tb_konser";
        $result = $this->conn->query($query);
        $konser = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $konser[] = [
                    'id_konser' => $row['id_konser'],
                    'nm_konser' => $row['nm_konser'],
                    'artis' => $row['artis'],
                    'lokasi' => $row['lokasi'],
                    'tanggal' => $row['tanggal']
                ];
            }
        }
        return $konser;
    }
    // Method untuk mendapatkan daftar pelanggan

    public function getPelanggan(){
        $query = "SELECT * FROM tb_pelanggan";
        $result = $this->conn->query($query);
        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = [
                    'id_pelanggan' => $row['id_pelanggan'],
                    'nm_pelanggan' => $row['nm_pelanggan'],
                    'telp' => $row['telp'],
                    'email' => $row['email']
                ];
            }
        }
        return $data;
    }

    // Method untuk mendapatkan daftar provinsi
    

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    

    // Method untuk input data program studi
    public function inputPelanggan($data){
        $namaPelanggan = $data['nm_pelanggan'];
        $telp = $data['telp'];
        $email = $data['email'];
        $query = "INSERT INTO tb_pelanggan (nm_pelanggan, telp, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("sss", $namaPelanggan, $telp, $email);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdatePelanggan($id){
        $query = "SELECT * FROM tb_pelanggan WHERE id_pelanggan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pelanggan = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $pelanggan = [
                'nm_pelanggan' => $row['nm_pelanggan'],
                'telp' => $row['telp'],
                'email' => $row['email']
            ];
        }
        $stmt->close();
        return $pelanggan;
    }

    // Method untuk mengedit data program studi
    public function updatePelanggan($data){
        $namaPelanggan = $data['nm_pelanggan'];
        $telp = $data['telp'];
        $email = $data['email'];
        $query = "UPDATE tb_pelanggan SET nm_pelanggan = ? WHERE id_pelanggan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("sssi", $namaPelanggan, $telp, $email);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data program studi
    public function deletePelanggan($id){
        $query = "DELETE FROM tb_pelanggan WHERE id_pelanggan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nama_provinsi) VALUES (?)";
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
                'nama' => $row['nama_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Method untuk mengedit data provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nama_provinsi = ? WHERE id_provinsi = ?";
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