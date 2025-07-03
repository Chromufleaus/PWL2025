-- 1. Buat database dan gunakan
CREATE DATABASE IF NOT EXISTS kampus_07057
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE kampus_07057;

-- 2. Buat tabel mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
  nim           VARCHAR(20)    NOT NULL PRIMARY KEY,
  nama          VARCHAR(100)   NOT NULL,
  jurusan       VARCHAR(100)   NOT NULL,
  jenis_kelamin ENUM('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Contoh data mahasiswa
INSERT INTO mahasiswa (nim, nama, jurusan, jenis_kelamin) VALUES
  ('210001', 'Andi Setiawan', 'Teknik Informatika',        'Laki-laki'),
  ('210002', 'Budi Santoso',  'Sistem Informasi',          'Laki-laki'),
  ('210003', 'Citra Lestari', 'Desain Komunikasi Visual',  'Perempuan');
