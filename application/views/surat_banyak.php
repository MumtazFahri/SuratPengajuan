<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $surat->nama_kegiatan ?? '-' ?></title>

    <style>
        @page {
            margin: 80px 80px 120px 80px;
        }
        
        /* === GLOBAL FONT: CALIBRI === */
        body {
            font-family: Calibri, Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            line-height: 1.25;
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

        h5 {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .surat-title {
            text-align: center;
            text-transform: uppercase;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 2px;
            text-decoration: underline; 
            text-underline-offset: 4px;
        }
        
        .surat-number {
            text-align: center;
            font-size: 13px;
            margin-top: -2px;
            margin-bottom: 25px;
        }

        /* Paragraf styling - TANPA INDENT */
        .content p {
            margin-bottom: 10px;
            text-align: justify;
            text-indent: 0;
        }

        p, th, td, b {
            font-family: Calibri, Arial, sans-serif;
        }
        
        /* List dengan indent khusus */
        .list-item {
            margin-bottom: 8px;
            text-indent: -15px;
            padding-left: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px 10px;
        }

        th {
            background: #f0f0f0;
        }

        .section-title {
            margin: 15px 0 10px 0;
            font-weight: normal;
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

        .qr-bottom-box {
            margin-top: 5px;
        }

        .qr-bottom {
            width: 90px;
            margin-bottom: 6px;
        }

        .signature-bottom-text {
            margin-top: 5px;
            font-weight: bold;
            text-decoration: underline;
            line-height: 1;
            margin-bottom: 2px;   
        }
        
        .signature-position {
            margin-top: 2px;
            font-weight: bold;
        }

        .date {
            margin-top: 15px;
            margin-bottom: 60px;
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
        'Admin KK' => 'Administrasi KK',
        'Admin' => 'Administrasi',
        
        // Lain-lain
        'BAAK' => 'Biro Administrasi Akademik dan Kemahasiswaan',
        'baak' => 'Biro Administrasi Akademik dan Kemahasiswaan',
        
        'BAA' => 'Biro Administrasi Akademik',
        'baa' => 'Biro Administrasi Akademik',
        
        'BK' => 'Biro Keuangan',
        'bk' => 'Biro Keuangan',
        
        'SDM' => 'Sumber Daya Manusia',
        'sdm' => 'Sumber Daya Manusia',
    ];
    
    $singkatan = trim($singkatan);
    
    if (isset($mapping[$singkatan])) {
        return $mapping[$singkatan];
    }
    
    return $singkatan;
}

// Fungsi untuk cek apakah nilai kosong/null/dash
function isValueEmpty($value) {
    return empty($value) || $value === '-' || $value === 'null' || $value === 'NULL';
}
// Kode baru: Mengambil divisi unik dari data dosen untuk tembusan
$divisi_tembusan = [];
$dosen_data_dengan_divisi_lengkap = [];

if (!empty($surat->dosen_data)) {
    foreach ($surat->dosen_data as $dosen) {
        if (!empty($dosen['divisi'])) {
            $divisi_singkatan = trim($dosen['divisi']);
            $divisi_lengkap = getNamaDivisiLengkap($divisi_singkatan);
            $divisi_tembusan[] = $divisi_lengkap;
            
            // Salin data dosen dengan divisi lengkap
            $dosen_copy = $dosen;
            $dosen_copy['divisi'] = $divisi_lengkap;
            $dosen_data_dengan_divisi_lengkap[] = $dosen_copy;
        }
    }
}

// Hapus duplikat dan urutkan
$divisi_tembusan = array_unique($divisi_tembusan);
sort($divisi_tembusan);

$jenis_penugasan_kelompok_tampil = $surat->jenis_penugasan_kelompok ?? '-';
if (isset($jenis_penugasan_kelompok_tampil) && $jenis_penugasan_kelompok_tampil === 'Lainnya') {
    $jenis_penugasan_kelompok_tampil = $surat->penugasan_lainnya_kelompok ?? 'Lainnya';
}
?>

<body>
    <!-- HEADER -->
    <div class="header">
        <?php if (!empty($logo_base64)): ?>
            <img src="data:image/jpeg;base64,<?= $logo_base64 ?>" class="header-logo" alt="Telkom University Logo">
        <?php else: ?>
            <img src="<?= base_url('assets/Tel-U_logo.png') ?>" class="header-logo" alt="Telkom University Logo">
        <?php endif; ?>
    </div>

    <!-- FOOTER dengan Text Info -->
    <div class="footer">
        <!-- Text Info Kampus -->
        <?php if (!empty($footer_text_base64)): ?>
            <img src="data:image/png;base64,<?= $footer_text_base64 ?>" class="footer-text-img" alt="Footer Text">
        <?php else: ?>
            <img src="<?= base_url('assets/footer_text.png') ?>" class="footer-text-img" alt="Footer text">
        <?php endif; ?>
        <!-- Wave Merah -->
        <?php if (!empty($footer_bg_base64)): ?>
            <img src="data:image/jpeg;base64,<?= $footer_bg_base64 ?>" class="footer-wave" alt="Footer Wave">
        <?php else: ?>
            <img src="<?= base_url('assets/footer_asset.jpg') ?>" class="footer-wave" alt="Footer Wave">
        <?php endif; ?>
    </div>

    <!-- CONTENT -->
    <br><br>
    <div class="content">
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

        <p class="section-title">Menugaskan kepada Dosen dan TPA yang tercantum dalam lampiran surat tugas ini, <?= $surat->customize ?? '-' ?> <b><?= $jenis_penugasan_kelompok_tampil ?></b>
            di kegiatan <b><?= $surat->nama_kegiatan ?? '-' ?></b>
            
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
            <?php endif; ?></p>

        <p>Surat tugas ini berlaku mulai tanggal sesuai tanggal kegiatan.</p>
        <p>Demikian penugasan ini untuk dilaksanakan dengan penuh tanggung jawab.</p>

        <p class="date">Bandung, <?php
        $tanggalPengesahan = $surat->created_at ?? date('Y-m-d');
        
        if (!empty($surat->approval_status)) {
            if (preg_match('/dekan["\']?\s*:\s*["\']?(\d{4}-\d{2}-\d{2})/', $surat->approval_status, $matches)) {
                $tanggalPengesahan = $matches[1];
            }
        }
        
        $timestamp = strtotime($tanggalPengesahan);
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        echo date('d', $timestamp) . ' ' . $bulan[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
        ?></p>

        <!-- SIGNATURE + QR -->
        <div class="signature-bottom">
            <?php if (!empty($qr_base64)): ?>
            <div class="qr-bottom-box">
                <img class="qr-bottom" src="data:image/png;base64,<?= $qr_base64 ?>" alt="QR Code">
            </div>
            <?php endif; ?>

            <div class="signature-bottom-text">
                <b>Dandi Yunidar, S.Sn., M.Ds., Ph.D.</b><br>
            </div>
            <div class="signature-position">Dekan Fakultas Industri Kreatif</div>
        </div><br><br>

        <!-- TEMBUSAN dengan divisi dinamis -->
        <div class="tembusan-list">
            <p><b>Tembusan</b></p>
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
        <br><br>
        <p><b>Lampiran Surat Tugas Nomor <?= $surat->nomor_surat ?? '-' ?></b></p>
    </div>

    <!-- PAGE BREAK untuk halaman lampiran -->
    <div style="page-break-before: always;"></div>

    <!-- LAMPIRAN TABEL -->
    <div class="content">
        <h5><b><?= $jenis_penugasan_kelompok_tampil ?>
         kegiatan <?= $surat->nama_kegiatan ?? '-' ?></b></h5>
        
        <table>
            <thead>
                <tr>
                    <th style="width:40px;">No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Prodi/Unit</th>
                    <th>Sebagai</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dosen_data_dengan_divisi_lengkap)): ?>
                    <?php foreach ($dosen_data_dengan_divisi_lengkap as $i => $d): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($d['nip'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($d['nama'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($d['jabatan'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($d['divisi'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($d['peran'] ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">Tidak ada data dosen</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <p class="date">Bandung, <?php
        $tanggalPengesahan = $surat->created_at ?? date('Y-m-d');
        
        if (!empty($surat->approval_status)) {
            if (preg_match('/dekan["\']?\s*:\s*["\']?(\d{4}-\d{2}-\d{2})/', $surat->approval_status, $matches)) {
                $tanggalPengesahan = $matches[1];
            }
        }
        
        $timestamp = strtotime($tanggalPengesahan);
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        echo date('d', $timestamp) . ' ' . $bulan[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
        ?></p>

        <div class="signature-bottom">
            <?php if (!empty($qr_base64)): ?>
            <div class="qr-bottom-box">
                <img class="qr-bottom" src="data:image/png;base64,<?= $qr_base64 ?>" alt="QR Code">
            </div>
            <?php endif; ?>

            <div class="signature-bottom-text">
                <b>Dandi Yunidar, S.Sn., M.Ds., Ph.D.</b><br>
            </div>
            <div class="signature-position">Dekan Fakultas Industri Kreatif</div>
        </div>
    </div>
</body>
</html>