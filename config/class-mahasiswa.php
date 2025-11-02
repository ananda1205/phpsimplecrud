<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Pesanan extends Database {

    // Method untuk input data mahasiswa
    public function inputPesanan($data){
        // Mengambil data dari parameter $data
        $id_pelanggan      = $data['id_pelanggan'];
        $id_konser     = $data['id_konser'];
        $qty_tiket    = $data['qty_tiket'];
        
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_pesanan (id_pelanggan, id_konser, qty_tiket) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sss", $id_pelanggan, $id_konser, $qty_tiket);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data mahasiswa
    public function getAllPesanan(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT p.id_pesanan, pl.nm_pelanggan, pl.email, k.nm_konser, k.artis, k.lokasi, k.tanggal, p.qty_tiket AS Tiket
          FROM tb_pesanan p
          JOIN tb_pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
          JOIN tb_konser k ON p.id_konser = k.id_konser";
        $result = $this->conn->query($query);

        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $pesanan = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $pesanan[] = [
                    'id' => $row['id_pesanan'],
                    'nm_pelanggan' => $row['nm_pelanggan'],
                    'email' => $row['email'],
                    'nm_konser' => $row['nm_konser'],
                    'artis' => $row['artis'],
                    'lokasi' => $row['lokasi'],
                    'tanggal' => $row['tanggal'],
                    'qty_tiket' => $row['Tiket']
                ];
            }
        }
        // Mengembalikan array data pesanan
        return $pesanan;
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdatePesanan($id){
        // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT p.id_pesanan, pl.nm_pelanggan, pl.email, k.nm_konser, k.artis, k.lokasi, k.tanggal, p.qty_tiket AS Tiket
          FROM tb_pesanan p
          JOIN tb_pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
          JOIN tb_konser k ON p.id_konser = k.id_konser
          WHERE p.id_pesanan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data mahasiswa  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                    'id' => $row['id_pesanan'],
                    'nm_pelanggan' => $row['nm_pelanggan'],
                    'email' => $row['email'],
                    'nm_konser' => $row['nm_konser'],
                    'artis' => $row['artis'],
                    'lokasi' => $row['lokasi'],
                    'tanggal' => $row['tanggal'],
                    'qty_tiket' => $row['Tiket']
            ];
        }
        $stmt->close();
        // Mengembalikan data mahasiswa
        return $data;
    }

    // Method untuk mengedit data mahasiswa
    public function editPesanan($data){
    // Ambil data dari parameter $data
    $id_pesanan   = $data['id_pesanan'];
    $id_pelanggan = $data['id_pelanggan'];
    $id_konser    = $data['id_konser'];
    $qty_tiket    = $data['qty_tiket'];

    // Query update tb_pesanan
    $query = "UPDATE tb_pesanan 
              SET id_pelanggan = ?, 
                  id_konser = ?, 
                  qty_tiket = ?
              WHERE id_pesanan = ?";

    $stmt = $this->conn->prepare($query);
    if (!$stmt) {
        return false;
    }

    // 3 string (id_pelanggan, id_konser, qty_tiket) + 1 integer (id_pesanan)
    $stmt->bind_param("sssi", $id_pelanggan, $id_konser, $qty_tiket, $id_pesanan);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}


    // Method untuk menghapus data mahasiswa
    public function deleteMahasiswa($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_pesanan WHERE id_pesanan = ?";
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

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchPesanan($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $kataKunci = trim($kataKunci);
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT p.id_pesanan, pl.nm_pelanggan, pl.email, k.nm_konser, k.artis, k.lokasi, k.tanggal, p.qty_tiket AS Tiket
          FROM tb_pesanan p
          JOIN tb_pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
          JOIN tb_konser k ON p.id_konser = k.id_konser
                  WHERE pl.nm_pelanggan LIKE ? OR k.nm_konser LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $pesanan = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $pesanan[] = [
                'id' => $row['id_pesanan'],
                'nm_pelanggan' => $row['nm_pelanggan'],
                'email' => $row['email'],
                'nm_konser' => $row['nm_konser'],
                'artis' => $row['artis'],
                'lokasi' => $row['lokasi'],
                'tanggal' => $row['tanggal'],
                'qty_tiket' => $row['Tiket']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $pesanan;
    }

}

?>