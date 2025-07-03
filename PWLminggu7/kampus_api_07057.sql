-- Buat database & tabel untuk REST API Mahasiswa
CREATE DATABASE IF NOT EXISTS kampus_api_07057
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE kampus_api_07057;

CREATE TABLE IF NOT EXISTS mahasiswa (
  id            INT            NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nim           VARCHAR(20)    NOT NULL UNIQUE,
  nama          VARCHAR(100)   NOT NULL,
  jurusan       VARCHAR(100)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contoh data
INSERT INTO mahasiswa (nim, nama, jurusan) VALUES
  ('23001', 'Andi Setiawan', 'Teknik Informatika'),
  ('23002', 'Dewi Anggraini','Sistem Informasi'),
  ('23003', 'Adi Wijaya',   'Teknik Komputer');
