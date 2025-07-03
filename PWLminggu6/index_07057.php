<?php include 'db_07057.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    #sidebar {
      min-width: 200px; max-width: 200px;
      background: #f8f9fa; padding: 1rem; height: 100vh;
    }
    #sidebar .nav-link.active {
      background: #e9ecef; font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar" class="d-none d-md-block">
      <h5>Menu</h5>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="index_07057.php">
            <i class="fa fa-table me-1"></i>Data Mahasiswa
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create_07057.php">
            <i class="fa fa-plus me-1"></i>Tambah Mahasiswa
          </a>
        </li>
      </ul>
    </nav>

    <!-- Main -->
    <main class="flex-fill p-4">
      <h2><i class="fa fa-graduation-cap me-2"></i>Data Mahasiswa</h2>

      <div class="row mb-3">
        <div class="col-md-6">
          <input type="text" id="search" class="form-control" placeholder="Cari NIM atau Nama...">
        </div>
        <div class="col-md-6 text-end">
          <a href="export_excel_07057.php" id="btnExcel" class="btn btn-success me-2">
            <i class="fa fa-file-excel"></i> Excel
          </a>
          <a href="export_pdf_07057.php" id="btnPdf" class="btn btn-danger">
            <i class="fa fa-file-pdf"></i> PDF
          </a>
        </div>
      </div>

      <div id="loading" class="mb-2" style="display:none;">Mencari...</div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead class="table-light">
            <tr>
              <th>NIM</th><th>Nama</th><th>Jurusan</th><th>Jenis Kelamin</th>
            </tr>
          </thead>
          <tbody id="result">
            <!-- akan terisi via JS -->
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <script>
    const search  = document.getElementById('search'),
          result  = document.getElementById('result'),
          loading = document.getElementById('loading'),
          btnExcel = document.getElementById('btnExcel'),
          btnPdf   = document.getElementById('btnPdf');

    function setExportLinks(q) {
      if (!q) {
        // default: export semua data
        btnExcel.href = 'export_excel_07057.php';
        btnPdf.href   = 'export_pdf_07057.php';
      } else {
        const p = '?keyword=' + encodeURIComponent(q);
        btnExcel.href = 'export_excel_07057.php' + p;
        btnPdf.href   = 'export_pdf_07057.php'   + p;
      }
    }

    function fetchData(q) {
      loading.style.display = 'block';
      fetch('search_07057.php?keyword=' + encodeURIComponent(q))
        .then(r => r.json())
        .then(data => {
          loading.style.display = 'none';
          if (!data.length) {
            result.innerHTML = '<tr><td colspan="4" class="text-center">Tidak ditemukan</td></tr>';
          } else {
            result.innerHTML = data.map(r =>
              `<tr>
                 <td>${r.nim}</td>
                 <td>${r.nama}</td>
                 <td>${r.jurusan}</td>
                 <td>${r.jenis_kelamin}</td>
               </tr>`
            ).join('');
          }
        });
    }

    search.addEventListener('keyup', () => {
      const q = search.value.trim();
      setExportLinks(q);
      fetchData(q);
    });

    // muat semua data & export semua saat halaman pertama dibuka
    document.addEventListener('DOMContentLoaded', () => {
      setExportLinks('');
      fetchData('');
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
