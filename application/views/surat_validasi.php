<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Letter Validation</title>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        background-color: #f5f5f5;
        margin: 0;
    }
    
    /* Loading Screen Styles */
    #loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #bdbdbeff 0%, #909090ff 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    
    .loading-logo {
        max-width: 180px;
        height: auto;
        margin-bottom: 30px;
        animation: pulse 2s infinite;
    }
    
    .loading-container {
        text-align: center;
        color: white;
    }
    
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin: 0 auto 20px;
    }
    
    .loading-text {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: bold;
    }
    
    .loading-subtext {
        font-size: 14px;
        opacity: 0.8;
        max-width: 300px;
        line-height: 1.5;
    }
    
    .loading-progress {
        width: 200px;
        height: 4px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 2px;
        margin-top: 20px;
        overflow: hidden;
    }
    
    .loading-progress-bar {
        height: 100%;
        width: 0%;
        background: #00e5ff;
        border-radius: 2px;
        animation: progress 2s ease-in-out infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.9; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    @keyframes progress {
        0% { width: 0%; transform: translateX(0); }
        50% { width: 100%; transform: translateX(0); }
        100% { width: 100%; transform: translateX(200px); }
    }
    
    .card {
        max-width: 650px;
        margin: auto;
        background: white;
        border: 1px solid #ddd;
        padding: 35px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    
    .card.show {
        opacity: 1;
        transform: translateY(0);
    }
    
    .header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 15px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
    }
    .header-logo {
        max-width: 150px;
        height: auto;
    }
    .header-title {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin: 0;
    }
    h2 { 
        text-align: center; 
        margin-bottom: 30px;
        color: #333;
        font-size: 20px;
    }
    .notfound { 
        text-align: center; 
        color: red;
        font-size: 18px;
        padding: 20px;
    }
    .info-row {
        display: flex;
        margin-bottom: 15px;
        line-height: 1.6;
    }
    .info-label {
        min-width: 150px;
        font-weight: normal;
        color: #333;
    }
    .info-separator {
        margin: 0 10px;
    }
    .info-value {
        flex: 1;
        color: #333;
    }
    .footer-text {
        text-align: center;
        font-size: 12px;
        color: #666;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
    }
    .section-title {
        font-weight: bold;
        margin-top: 25px;
        margin-bottom: 15px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    /* Dosen Card Styles */
    .dosen-section {
        margin-top: 25px;
        margin-bottom: 20px;
    }
    
    .dosen-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.2s ease;
    }
    
    .dosen-card:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-color: #d0d0d0;
    }
    
    .dosen-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
        flex-shrink: 0;
    }
    
    .dosen-info {
        flex: 1;
    }
    
    .dosen-nama {
        font-weight: bold;
        color: #333;
        margin-bottom: 4px;
        font-size: 15px;
    }
    
    .dosen-detail {
        color: #666;
        font-size: 13px;
        line-height: 1.4;
    }
    
    .dosen-nip {
        color: #888;
        font-size: 12px;
    }
    
    .icon-dosen {
        font-size: 20px;
    }
    
    /* New style for dosen list like penandatangan */
    .dosen-list-item {
        margin-bottom: 10px;
    }
    
    .dosen-nama-value {
        font-weight: bold;
        margin-bottom: 2px;
    }
    
    .dosen-nip-value {
        color: #666;
        font-size: 14px;
    }
</style>
</head>
<body>

<!-- Loading Screen -->
<div id="loading-screen">
    <div class="loading-container">
        <!-- Logo Telkom University pada loading screen -->
        <img src="<?= base_url('assets/Tel-U_logo.png') ?>" class="loading-logo" alt="Telkom University Logo">
        
        <div class="loading-spinner"></div>
        
        <div class="loading-text">Memvalidasi Dokumen</div>
        <div class="loading-subtext">Sedang memverifikasi keaslian dan validitas dokumen regulasi...</div>
        
        <div class="loading-progress">
            <div class="loading-progress-bar"></div>
        </div>
    </div>
</div>

<div class="card" id="content-card">

<!-- HEADER -->
<div class="header">
    <?php if (!empty($logo_base64)): ?>
        <img src="data:image/jpeg;base64,<?= $logo_base64 ?>" class="header-logo" alt="Telkom University Logo">
    <?php else: ?>
        <img src="<?= base_url('assets/Tel-U_logo.png') ?>" class="header-logo" alt="Telkom University Logo">
    <?php endif; ?>
    <h1 class="header-title">Letter Validation</h1>
</div>

<?php if (!$found): ?>
    <p class="notfound"><b>❌ Dokumen tidak ditemukan atau tidak valid.</b></p>

<?php else: ?>

    <div class="info-row">
        <span class="info-label">Judul</span>
        <span class="info-separator">:</span>
        <span class="info-value">SURAT TUGAS DEKAN FAKULTAS INDUSTRI KREATIF UNIVERSITAS TELKOM</span>
    </div>

    <div class="info-row">
        <span class="info-label">Nomor Dokumen</span>
        <span class="info-separator">:</span>
        <span class="info-value"><?= ($surat->nomor_surat) ?></span>
    </div>

<div class="info-row">
    <span class="info-label">Tanggal Pengesahan</span>
    <span class="info-separator">:</span>
    <span class="info-value">
        <?php
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
        ?>
    </span>
</div>

    <?php if ($surat->jenis_date === 'Custom'): ?>
    <div class="info-row">
        <span class="info-label">Tanggal Kegiatan</span>
        <span class="info-separator">:</span>
        <span class="info-value">
            <?php
            $timestamp = strtotime($surat->tanggal_kegiatan);
            echo date('d', $timestamp) . ' ' . $bulan[(int)date('n', $timestamp)] . ' ' . date('Y', $timestamp);
            ?>
        </span>
    </div>
    <?php else: ?>
    <div class="info-row">
        <span class="info-label">Periode Kegiatan</span>
        <span class="info-separator">:</span>
        <span class="info-value"><?= ($surat->periode_value ?? '-') ?></span>
    </div>
    <?php endif; ?>

    <div class="info-row">
        <span class="info-label">Perihal</span>
        <span class="info-separator">:</span>
        <span class="info-value"><?= ($surat->nama_kegiatan) ?></span>
    </div>

    <!-- DOSEN TERKAIT SECTION (UPDATED FORMAT) -->
    <?php if (!empty($dosen_list) && count($dosen_list) > 0): ?>
    <div class="info-row">
        <span class="info-label">Dosen Terkait</span>
        <span class="info-separator">:</span>
        <span class="info-value">
            <?php foreach ($dosen_list as $index => $dosen): ?>
            <div class="dosen-list-item">
                <div class="dosen-nama-value"><?= ($dosen['nama_dosen']) ?></div>
                <div class="dosen-nip-value">NIP: <?= ($dosen['nip']) ?></div>
            </div>
            <?php endforeach; ?>
        </span>
    </div>
    <?php endif; ?>

    <!-- Penandatangan Section -->
    <div class="info-row">
        <span class="info-label">Penandatangan</span>
        <span class="info-separator">:</span>
        <span class="info-value">
            Dandi Yunidar, S.Sn., M.Ds., Ph.D<br>
            (DEKAN FAKULTAS INDUSTRI KREATIF (FIK))
        </span>
    </div>

    <!-- Pekerjaan Section -->
    <div class="info-row">
        <span class="info-label">Pemilik Proses</span>
        <span class="info-separator">:</span>
        <span class="info-value">Unit Sekretariat FIK</span>
    </div>

    <div class="footer-text">
        Regulation Validation ©<?= date('Y') ?><br>
        School Of Creative Industries<br>
        Telkom University
    </div>

<?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadingScreen = document.getElementById('loading-screen');
    const contentCard = document.getElementById('content-card');
    
    // Simulasi waktu loading (bisa disesuaikan dengan kebutuhan)
    // Dalam implementasi nyata, ini bisa diganti dengan event listener
    // untuk menunggu data selesai dimuat
    
    // Minimum waktu loading untuk efek yang smooth
    const minLoadingTime = 1500; // 1.5 detik
    
    // Waktu mulai
    const startTime = Date.now();
    
    // Fungsi untuk menyembunyikan loading screen
    function hideLoadingScreen() {
        const elapsedTime = Date.now() - startTime;
        const remainingTime = Math.max(0, minLoadingTime - elapsedTime);
        
        // Tunggu sisa waktu minimum jika perlu
        setTimeout(function() {
            // Sembunyikan loading screen dengan efek fade
            loadingScreen.style.opacity = '0';
            loadingScreen.style.visibility = 'hidden';
            
            // Tampilkan konten dengan efek fade in
            setTimeout(function() {
                contentCard.classList.add('show');
            }, 300);
        }, remainingTime);
    }
    
    // Cek jika dokumen tidak ditemukan (not found)
    const notFoundElement = document.querySelector('.notfound');
    
    if (notFoundElement) {
        // Jika dokumen tidak ditemukan, sembunyikan loading lebih cepat
        setTimeout(hideLoadingScreen, 800);
    } else {
        // Jika dokumen valid, gunakan waktu normal
        // Simulasi validasi dokumen
        setTimeout(function() {
            // Update text loading untuk efek real-time
            const loadingText = document.querySelector('.loading-text');
            const loadingSubtext = document.querySelector('.loading-subtext');
            
            if (loadingText && loadingSubtext) {
                loadingText.textContent = 'Validasi Berhasil';
                loadingSubtext.textContent = 'Dokumen telah berhasil diverifikasi dan valid';
                
                // Tunggu sebentar untuk feedback visual
                setTimeout(hideLoadingScreen, 500);
            } else {
                hideLoadingScreen();
            }
        }, 1000);
    }
    
    // Fallback: Sembunyikan loading screen maksimal setelah 3 detik
    setTimeout(hideLoadingScreen, 3000);
});
</script>

</body>
</html>