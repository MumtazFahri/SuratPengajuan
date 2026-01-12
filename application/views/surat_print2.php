<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $surat->nama_kegiatan ?? '-' ?></title>

    <style>
        /* HILANGKAN SCROLL BAR DI SEMUA ELEMEN */
        html, body {
            overflow: hidden !important;
            overflow-x: hidden !important;
            overflow-y: hidden !important;
            -ms-overflow-style: none !important; /* IE and Edge */
            scrollbar-width: none !important; /* Firefox */
        }
        
        /* Untuk browser Webkit (Chrome, Safari, Opera) */
        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        
        /* Pastikan semua kontainer tidak membuat scroll */
        * {
            max-height: 100vh !important;
            overflow: visible !important;
        }
        @page {
            margin: 80px 80px 120px 80px;
        }
        
        body {
            font-family: Calibri, Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.15;
            color: #000;
        }

        /* === HEADER === */
        .header {
            position: fixed;
            top: -70px;
            left: 0;
            right: -90px;
            height: 100px;
            text-align: right;
            padding-right: 40px;
        }

        .header-logo {
            height: 80px;
            margin-top: 10px;
        }

        /* === FOOTER CONTAINER === */
        .footer {
            position: fixed;
            left: -80px;
            right: -80px;
            bottom: -120px;
            height: 90px;
            width: calc(100% + 160px);
        }

        /* Footer Text as Image */
        .footer-text-img {
            position: absolute;
            bottom: 52px;
            left: 50%;
            transform: translateX(-50%);
            width: auto;
            max-width: 95%;
            height: 85px;
            object-fit: contain;
            margin-bottom: -20px;
        }

        /* Footer Wave Background */
        .footer-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            object-fit: fill;
        }
        /* === CONTENT === */
        .content {
            margin: 0;
            position: relative;
            z-index: 1;
        }

        /* Judul Surat */
        .surat-title {
        text-align: center;
        text-transform: uppercase;
        font-size: 25px;        /* sedikit lebih besar */
        font-weight: bold;
        margin-bottom: 2px;     /* lebih rapat ke nomor */
        text-decoration: underline; 
        text-underline-offset: 4px;   /* jarak garis ke teks */
    }
        .surat-number {
        text-align: center;
        font-size: 13px;        /* sedikit lebih besar dari sebelumnya */
        margin-top: -2px;       /* menaikkan sedikit agar lebih dekat */
        margin-bottom: 25px;    /* jarak ke isi */
    }

        /* Paragraf styling - TANPA INDENT */
        .content p {
            margin-bottom: 10px;
            text-align: justify;
            text-indent: 0;
        }

        /* List dengan indent khusus */
        .list-item {
            margin-left: 20px;
            margin-bottom: 8px;
            text-indent: -15px;
            padding-left: 15px;
        }

        /* Identity section */
        .identity {
            margin: 15px 0;
            line-height: 1.6;
        }

        .identity-row {
            display: table;
            width: 100%;
            margin-bottom: 3px;
        }

        .identity-label {
            display: table-cell;
            width: 100px;
        }

        .identity-separator {
            display: table-cell;
            width: 20px;
        }

        .identity-value {
            display: table-cell;
        }

        /* Tabel styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #ffffff;
            font-weight: bold;
            text-align: center;
        }

        td {
            text-align: left;
        }

        .table-number {
            width: 35px;
            text-align: center !important;
        }

        .table-nip {
            width: 90px;
        }

        .table-prodi {
            width: 80px;
        }
        
        /* Tambahan untuk kolom peran */
        .table-peran {
            width: 80px;
        }

        /* Section title */
        .section-title {
            margin: 15px 0 10px 0;
            font-weight: normal;
        }

        /* Tanda tangan */
        .signature-bottom-text {
        margin-top: 5px;
        font-weight: bold;
        text-decoration: underline;
        line-height: 1;      /* jarak vertikal lebih rapat */
        margin-bottom: 2px;   
        }
        .signature-position {
        margin-top: 2px;
        font-weight: bold;
    }

        .qr-centered {
            width: 90px;
            margin-bottom: 6px; /* jarak QR ke nama */
            margin-top: 20px;
        }

        .qr-box {
            position: absolute;
            right: 0;
            top: 0;
            width: 100px;
            page-break-inside: avoid;
        }
        .qr-bottom-box {
        margin-top: 5px;
        }

        .qr-bottom {
            width: 90px;   /* ukuran sama seperti QR atas */
            margin-bottom: 6px;
        }

        img.qr-img {
            width: 100px;
            height: auto;
        }

        b {
            font-weight: bold;
        }

        .date {
            margin-top: 20px;
            margin-bottom: 60px;
        }
        
        /* Spesifik untuk jarak Demikian ke Bandung */
        .demikian-to-bandung {
            margin-bottom: 1px; /* 1 spasi */
        }
        
        /* Tambahan untuk jarak nama dekan dan jabatan di tanda tangan */
        .nama-dekan-tanda-tangan {
            line-height: 1;
            margin-bottom: 1px; /* 1 spasi antara nama dan jabatan */
            text-decoration: underline;
        }
        
        .jabatan-dekan-tanda-tangan {
            line-height: 1;
            margin-top: 0;
        }
        
        /* Tembusan styling */
        .tembusan-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .tembusan-item {
            margin-bottom: 4px;
        }
    </style>

</head>
<?php
function tgl_indo($tanggal) {
    if(empty($tanggal) || $tanggal == '-') return '-';
    
    $tanggal = substr($tanggal, 0, 10); 
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $pecah = explode('-', $tanggal);
    if(count($pecah) == 3) {
        return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
    }
    return $tanggal;
}

// Fungsi untuk mengonversi singkatan divisi ke nama lengkap
function getNamaDivisiLengkap($singkatan) {
    $mapping = [
        // Desain Komunikasi Visual
        'DKV' => 'Desain Komunikasi Visual',
        'dkv' => 'Desain Komunikasi Visual',
        'Desain Komunikasi Visual' => 'Desain Komunikasi Visual',
        
        // Desain Interior
        'DI' => 'Desain Interior',
        'di' => 'Desain Interior',
        'Desain Interior' => 'Desain Interior',
        
        // Desain Produk
        'DP' => 'Desain Produk',
        'dp' => 'Desain Produk',
        'Desain Produk' => 'Desain Produk',
        
        // Kriya
        'KRIYA' => 'Kriya',
        'kriya' => 'Kriya',
        'Kriya' => 'Kriya',
        
        // Manajemen
        'MAN' => 'Manajemen',
        'man' => 'Manajemen',
        'Manajemen' => 'Manajemen',
        
        // Akuntansi
        'AKT' => 'Akuntansi',
        'akt' => 'Akuntansi',
        'Akuntansi' => 'Akuntansi',
        
        // Teknik Informatika
        'TI' => 'Teknik Informatika',
        'ti' => 'Teknik Informatika',
        'Teknik Informatika' => 'Teknik Informatika',
        
        // Sistem Informasi
        'SI' => 'Sistem Informasi',
        'si' => 'Sistem Informasi',
        'Sistem Informasi' => 'Sistem Informasi',
        
        // Teknik Elektro
        'TE' => 'Teknik Elektro',
        'te' => 'Teknik Elektro',
        'Teknik Elektro' => 'Teknik Elektro',
        
        // Teknik Industri
        'TIN' => 'Teknik Industri',
        'tin' => 'Teknik Industri',
        'Teknik Industri' => 'Teknik Industri',
        
        // Fakultas Industri Kreatif
        'FIK' => 'Fakultas Industri Kreatif',
        'fik' => 'Fakultas Industri Kreatif',
        'Fakultas Industri Kreatif' => 'Fakultas Industri Kreatif',
        
        // Fakultas Ekonomi dan Bisnis
        'FEB' => 'Fakultas Ekonomi dan Bisnis',
        'feb' => 'Fakultas Ekonomi dan Bisnis',
        'Fakultas Ekonomi dan Bisnis' => 'Fakultas Ekonomi dan Bisnis',
        
        // Fakultas Informatika
        'FIF' => 'Fakultas Informatika',
        'fif' => 'Fakultas Informatika',
        'Fakultas Informatika' => 'Fakultas Informatika',
        
        // Fakultas Teknik
        'FTE' => 'Fakultas Teknik',
        'fte' => 'Fakultas Teknik',
        'Fakultas Teknik' => 'Fakultas Teknik',
        
        // Admin
        'ADMIN' => 'Administrasi',
        'admin' => 'Administrasi',
        'Administrasi' => 'Administrasi',
        'Ketua KK' => 'Ketua KK',
        'Admin' => 'Administrasi',
        
        // Lain-lain - tambahkan sesuai kebutuhan
        'BAAK' => 'Biro Administrasi Akademik dan Kemahasiswaan',
        'baak' => 'Biro Administrasi Akademik dan Kemahasiswaan',
        
        'BAA' => 'Biro Administrasi Akademik',
        'baa' => 'Biro Administrasi Akademik',
        
        'BK' => 'Biro Keuangan',
        'bk' => 'Biro Keuangan',
        
        'SDM' => 'Sumber Daya Manusia',
        'sdm' => 'Sumber Daya Manusia',
    ];
    
    // Trim dan cek apakah ada di mapping
    $singkatan = trim($singkatan);
    
    // Jika ada di mapping, kembalikan nama lengkap
    if (isset($mapping[$singkatan])) {
        return $mapping[$singkatan];
    }
    
    // Jika tidak ditemukan, kembalikan aslinya (mungkin sudah nama lengkap)
    return $singkatan;
}

// Tentukan jenis penugasan yang akan ditampilkan
$jenis_penugasan_kelompok_tampil = $surat->jenis_penugasan_kelompok ?? '-';
if (isset($jenis_penugasan_kelompok_tampil) && $jenis_penugasan_kelompok_tampil === 'Lainnya') {
    $jenis_penugasan_kelompok_tampil = $surat->penugasan_lainnya_kelompok ?? 'Lainnya';
}

// Fungsi untuk cek apakah nilai kosong/null/dash
function isValueEmpty($value) {
    return empty($value) || $value === '-' || $value === 'null' || $value === 'NULL';
}

// ===== PARSING DATA DOSEN DENGAN JABATAN & PERAN DARI JSON =====
// Decode peran data dari database (JSON array)
$peran_array = [];
if (!empty($surat->peran)) {
    if (is_string($surat->peran)) {
        $peran_array = json_decode($surat->peran, true);
        if ($peran_array === null) {
            $peran_array = [];
        }
    } elseif (is_array($surat->peran)) {
        $peran_array = $surat->peran;
    }
}

// Proses data dosen dengan mengambil jabatan dan peran dari JSON
$dosen_data_dengan_jabatan_peran = [];
if (!empty($dosen_data)) {
    foreach ($dosen_data as $index => $dosen) {
        $dosen_info = $dosen;
        
        // Default values
        $jabatan_value = $dosen['jabatan'] ?? '-';
        $peran_value = '-';
        
        // Coba ambil jabatan dan peran dari peran_array jika ada
        if (isset($peran_array[$index])) {
            $peran_item = $peran_array[$index];
            
            if (is_string($peran_item)) {
                // Decode string JSON
                $decoded = json_decode($peran_item, true);
                if (is_array($decoded)) {
                    $jabatan_value = $decoded['jabatan'] ?? $dosen['jabatan'] ?? '-';
                    $peran_value = $decoded['peran'] ?? '-';
                } else {
                    // Jika bukan JSON, mungkin hanya peran saja
                    $peran_value = $peran_item;
                }
            } elseif (is_array($peran_item)) {
                // Sudah dalam bentuk array
                $jabatan_value = $peran_item['jabatan'] ?? $dosen['jabatan'] ?? '-';
                $peran_value = $peran_item['peran'] ?? '-';
            }
        }
        
        $dosen_info['jabatan'] = $jabatan_value;
        $dosen_info['peran'] = $peran_value;
        $dosen_data_dengan_jabatan_peran[] = $dosen_info;
    }
}

// Kode baru: Mengambil divisi unik dari data dosen untuk tembusan
$divisi_tembusan = [];
if (!empty($dosen_data_dengan_jabatan_peran)) {
    foreach ($dosen_data_dengan_jabatan_peran as $dosen) {
        if (!empty($dosen['divisi'])) {
            $divisi_singkatan = trim($dosen['divisi']);
            $divisi_lengkap = getNamaDivisiLengkap($divisi_singkatan);
            $divisi_tembusan[] = $divisi_lengkap;
        }
    }
}
// Hapus duplikat dan urutkan
$divisi_tembusan = array_unique($divisi_tembusan);
sort($divisi_tembusan);
?>

<body>
    
    <br><br>
    <!-- CONTENT -->
    <div class="content">
        <!-- Judul Surat -->
        <div class="surat-title">SURAT TUGAS</div>
        <div class="surat-number">Nomor : <?= $surat->nomor_surat ?? '-' ?></div>

    
        <p>Saya yang bertanda tangan di bawah ini :</p>
        
        <div class="identity">
            <div class="identity-row">
                <div class="identity-label">Nama</div>
                <div class="identity-separator">:</div>
                <div class="identity-value">Dandi Yunidar, S.Sn., M.Ds., Ph.D.</div>
            </div>
            <div class="identity-row">
                <div class="identity-label">NIP</div>
                <div class="identity-separator">:</div>
                <div class="identity-value">14760039</div>
            </div>
            <div class="identity-row">
                <div class="identity-label">Jabatan</div>
                <div class="identity-separator">:</div>
                <div class="identity-value">Dekan Fakultas Industri Kreatif</div>
            </div>
        </div>

        <!-- Menugaskan Kepada -->
        <p class="section-title">Menugaskan kepada :</p>

        <!-- Tabel Dosen dari list_dosen - DENGAN KOLOM PERAN -->
        <table class="tabel-dosen">
            <thead>
                <tr>
                    <th class="table-number">No</th>
                    <th>Nama</th>
                    <th class="table-nip">NIP</th>
                    <th>Jabatan</th>
                    <th class="table-prodi">Prodi/Unit</th>
                    <th class="table-peran">Peran</th> <!-- KOLOM BARU -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dosen_data_dengan_jabatan_peran)): ?>
                    <?php $no = 1; foreach ($dosen_data_dengan_jabatan_peran as $dosen): ?>
                        <tr>
                            <td class="table-number"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($dosen['nama'] ?? 'Tidak ada data dosen') ?></td>
                            <td class="table-nip"><?= htmlspecialchars($dosen['nip'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($dosen['jabatan'] ?? '-') ?></td>
                            <td class="table-prodi"><?= htmlspecialchars($dosen['divisi'] ?? '-') ?></td>
                            <td class="table-peran"><?= htmlspecialchars($dosen['peran'] ?? '-') ?></td> <!-- DATA PERAN -->
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data dosen</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Untuk Menghadiri Kegiatan -->
 <p>
            <?= $surat->customize ?? '-' ?> <b><?= $jenis_penugasan_kelompok_tampil ?></b>
            dalam kegiatan <b><?= $surat->nama_kegiatan ?? '-' ?></b>
            
            <?php if (!isValueEmpty($surat->penyelenggara)): ?>
                yang diselenggarakan oleh <b><?= $surat->penyelenggara ?></b>
            <?php endif; ?>

            <?php if (isset($surat->jenis_date) && $surat->jenis_date == 'Custom'): ?>
                <?php
                // Format tanggal
                $tanggal_mulai = $surat->tanggal_kegiatan ?? '-';
                $tanggal_akhir = $surat->akhir_kegiatan ?? '-';
                
                // Format menjadi tgl_indo
                $tgl_mulai_formatted = tgl_indo($tanggal_mulai);
                $tgl_akhir_formatted = tgl_indo($tanggal_akhir);
                
                // Cek apakah tanggal sama
                if ($tanggal_mulai === $tanggal_akhir && $tanggal_mulai !== '-') {
                    // Jika tanggal sama, tampilkan hanya satu tanggal
                    echo "pada tanggal <b>$tgl_mulai_formatted</b>";
                } else {
                    // Jika tanggal berbeda, tampilkan rentang tanggal
                    echo "pada tanggal <b>$tgl_mulai_formatted</b> - <b>$tgl_akhir_formatted</b>";
                }
                ?>
            <?php else: ?>
                selama <b>Periode <?= $surat->periode_value ?? '-' ?></b>
            <?php endif; ?>

            <?php if (!isValueEmpty($surat->tempat_kegiatan)): ?>
                di <b><?= $surat->tempat_kegiatan ?>.</b>
            <?php endif; ?>
        </p>

        <p>Surat tugas ini berlaku sesuai tanggal kegiatan di atas.</p>

        <!-- Penutup -->
        <p class="demikian-to-bandung">Demikian penugasan ini untuk dilaksanakan dengan penuh tanggung jawab.</p>

        <!-- Tanggal -->
        <p class="date">Bandung, <?php
        // Default tanggal
        $tanggalPengesahan = $surat->created_at ?? date('Y-m-d');
        
        // Jika approval_status berisi data mentah seperti contoh
        if (!empty($surat->approval_status)) {
            // Cari pattern tanggal (YYYY-MM-DD) setelah "dekan"
            if (preg_match('/dekan["\']?\s*:\s*["\']?(\d{4}-\d{2}-\d{2})/', $surat->approval_status, $matches)) {
                $tanggalPengesahan = $matches[1];
            }
        }
        
        // Format tanggal
        $timestamp = strtotime($tanggalPengesahan);
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        echo date('d', $timestamp) . ' ' . $bulan[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
        ?></p><br><br><br>

         <!-- SIGNATURE + QR -->
         <div class="signature-bottom">

        <?php if (!empty($qr_base64)): ?>
        <div class="qr-bottom-box">
            <img class="qr-bottom" src="data:image/png;base64,<?= $qr_base64 ?>" alt="QR Code">
        </div>
        <?php endif; ?>

        <div class="nama-dekan-tanda-tangan">
            <b>Dandi Yunidar, S.Sn., M.Ds., Ph.D.</b>
        </div>
        <div class="jabatan-dekan-tanda-tangan">
            Dekan Fakultas Industri Kreatif
        </div>
    </div>

        <!-- TEMBUSAN dengan divisi dinamis dan penomoran terpisah -->
        <p><b>Tembusan</b></p>
        <div class="tembusan-list">
            <div class="tembusan-item">1. Wakil Dekan Bidang Akademik dan Dukungan Penelitian FIK</div>
            <div class="tembusan-item">2. Wakil Dekan Bidang Keuangan dan Sumber Daya dan Kemahasiswaan FIK</div>
            
            <?php if (!empty($divisi_tembusan)): ?>
                <?php $counter = 3; ?>
                <?php foreach ($divisi_tembusan as $divisi): ?>
                    <div class="tembusan-item"><?= $counter ?>. Kaprodi S1 <?= htmlspecialchars($divisi) ?></div>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="tembusan-item">3. Kaprodi -</div>
            <?php endif; ?>
        </div>
        </div>
</body>
</html>