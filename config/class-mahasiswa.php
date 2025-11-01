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
    public function getAllMahasiswa(){
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
        // Mengembalikan array data mahasiswa
        return $pesanan;
    }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateMahasiswa($id){
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
    public function editMahasiswa($data){
        // Mengambil data dari parameter $data
        $id       = $data['id_pesanan'];
        $nm_pelanggan      = $data['nm_pelanggan'];
        $email     = $data['email'];
        $nm_konser    = $data['nm_konser'];
        $artis   = $data['artis'];
        $lokasi = $data['lokasi'];
        $tanggal    = $data['tanggal'];
        $qty_tiket     = $data['Tiket'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_pesanan p
          JOIN tb_pelanggan pl ON p.id_pelanggan = pl.id_pelanggan
          JOIN tb_konser k ON p.id_konser = k.id_konser
          SET  
              pl.nm_pelanggan = ?,
              pl.email = ?,
              k.nm_konser = ?,
              k.artis = ?,
              k.lokasi =?,
              k.tanggal =?,
              k.qty_tiket = ?

          WHERE p.id_pesanan = ?";
$stmt = $this->conn->prepare($query);

if(!$stmt){
            return false;
        }

        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $nm_pelanggan, $nm_konser, $artis, $lokasi, $tanggal, $qty_tiket, $id_pesanan);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
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
    public function searchMahasiswa($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_mhs, nim_mhs, nama_mhs, nama_prodi, nama_provinsi, alamat, email, telp, status_mhs 
                  FROM tb_mahasiswa
                  JOIN tb_prodi ON prodi_mhs = kode_prodi
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE nim_mhs LIKE ? OR nama_mhs LIKE ?";
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
        $mahasiswa = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $mahasiswa[] = [
                    'id' => $row['id_mhs'],
                    'nim' => $row['nim_mhs'],
                    'nama' => $row['nama_mhs'],
                    'prodi' => $row['nama_prodi'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_mhs']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $mahasiswa;
    }

}

?>