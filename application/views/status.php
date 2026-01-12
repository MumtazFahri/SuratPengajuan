<!DOCTYPE html>
<html lang="en-id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Tracking - Surat Tugas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    body {
        background-color: #f6f9fb;
        font-family: 'Poppins', sans-serif;
        padding: 30px 0;
    }

    .tracking-container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 40px;
    }

    .tracking-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .tracking-header h2 {
        color: #333;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .tracking-header p {
        color: #666;
        font-size: 14px;
    }

    .progress-track {
        position: relative;
        padding: 20px 0;
    }

    .progress-line {
        position: absolute;
        top: 65px;
        left: 12%;
        right: 12%;
        height: 4px;
        background: #e0e0e0;
        z-index: 1;
    }

    .progress-line-fill {
        height: 100%;
        background: #4CAF50;
        transition: width 0.5s ease;
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }

    .step {
        flex: 1;
        text-align: center;
        position: relative;
    }

    .step-circle {
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .step-circle i {
        font-size: 36px;
    }

    /* Status Colors */
    .step.pending .step-circle {
        background: #FFC107;
        color: white;
    }

    .step.approved .step-circle {
        background: #4CAF50;
        color: white;
    }

    .step.rejected .step-circle {
        background: #F44336;
        color: white;
    }

    .step.waiting .step-circle {
        background: #FF9800;
        color: white;
    }

    .step.inactive .step-circle {
        background: #e0e0e0;
        color: #999;
    }

    .step-label {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .step-status {
        font-size: 12px;
        color: #666;
        font-weight: 500;
    }

    .step.approved .step-status {
        color: #4CAF50;
    }

    .step.rejected .step-status {
        color: #F44336;
    }

    .step.pending .step-status,
    .step.waiting .step-status {
        color: #FF9800;
    }

    .step-date {
        font-size: 11px;
        color: #999;
        margin-top: 5px;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #FB8C00;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        margin-bottom: 20px;
    }

    .back-button:hover {
        background: #e67e00;
        color: white;
        transform: translateX(-5px);
    }

    .document-info {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin-top: 40px;
    }

    .document-info h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .info-row {
        display: flex;
        padding: 10px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #666;
        width: 200px;
        flex-shrink: 0;
    }

    .info-value {
        color: #333;
        flex: 1;
    }

    @media (max-width: 768px) {
        .tracking-container {
            padding: 20px;
        }

        .progress-steps {
            flex-direction: column;
            gap: 30px;
        }

        .progress-line {
            display: none;
        }

        .step-circle {
            width: 70px;
            height: 70px;
        }

        .step-circle i {
            font-size: 30px;
        }

        .info-row {
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <div class="tracking-container">
        <a href="<?= site_url('list-surat-tugas') ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali ke List
        </a>

        <div class="tracking-header">
            <h2>Status Tracking Surat Tugas</h2>
            <p>Lacak status persetujuan surat tugas Anda secara real-time</p>
        </div>

        <div class="progress-track">
            <div class="progress-line">
                <div class="progress-line-fill" style="width: 75%;"></div>
            </div>

            <div class="progress-steps">
                <!-- Step 1: Mengirim -->
                <div class="step approved">
                    <div class="step-circle">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-label">Mengirim</div>
                    <div class="step-status">Terkirim</div>
                    <div class="step-date">18 Nov 2025, 10:30</div>
                </div>

                <!-- Step 2: Persetujuan KK -->
                <div class="step approved">
                    <div class="step-circle">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-label">Persetujuan KK</div>
                    <div class="step-status">Disetujui</div>
                    <div class="step-date">18 Nov 2025, 14:20</div>
                </div>

                <!-- Step 3: Persetujuan Sekretariat -->
                <div class="step waiting">
                    <div class="step-circle">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="step-label">Persetujuan Sekretariat</div>
                    <div class="step-status">Menunggu Persetujuan</div>
                    <div class="step-date">-</div>
                </div>

                <!-- Step 4: Persetujuan Dekan -->
                <div class="step inactive">
                    <div class="step-circle">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="step-label">Persetujuan Dekan</div>
                    <div class="step-status">Belum Diproses</div>
                    <div class="step-date">-</div>
                </div>
            </div>
        </div>

        <!-- Document Information -->
        <div class="document-info">
            <h4><i class="fas fa-file-alt"></i> Informasi Dokumen</h4>
            <div class="info-row">
                <div class="info-label">Nama Kegiatan</div>
                <div class="info-value">Carnaval</div>
            </div>
            <div class="info-row">
                <div class="info-label">Jenis Pengajuan</div>
                <div class="info-value">Perorangan</div>
            </div>
            <div class="info-row">
                <div class="info-label">Nama Dosen</div>
                <div class="info-value">Dr. Moh Isa Pramana Koesoemadinata</div>
            </div>
            <div class="info-row">
                <div class="info-label">Divisi</div>
                <div class="info-value">DKV</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Pengajuan</div>
                <div class="info-value">18 November 2025</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status Saat Ini</div>
                <div class="info-value"><span style="color: #FF9800; font-weight: 600;">Menunggu Persetujuan Sekretariat</span></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Contoh untuk status yang berbeda - bisa diganti sesuai data dari backend
    
    // Status: Ditolak KK
    function showRejectedByKK() {
        $('.progress-steps').html(`
            <div class="step approved">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Mengirim</div>
                <div class="step-status">Terkirim</div>
                <div class="step-date">18 Nov 2025, 10:30</div>
            </div>
            <div class="step rejected">
                <div class="step-circle"><i class="fas fa-times"></i></div>
                <div class="step-label">Persetujuan KK</div>
                <div class="step-status">Ditolak</div>
                <div class="step-date">18 Nov 2025, 14:20</div>
            </div>
            <div class="step inactive">
                <div class="step-circle"><i class="fas fa-hourglass-half"></i></div>
                <div class="step-label">Persetujuan Sekretariat</div>
                <div class="step-status">Belum Diproses</div>
                <div class="step-date">-</div>
            </div>
            <div class="step inactive">
                <div class="step-circle"><i class="fas fa-hourglass-half"></i></div>
                <div class="step-label">Persetujuan Dekan</div>
                <div class="step-status">Belum Diproses</div>
                <div class="step-date">-</div>
            </div>
        `);
        $('.progress-line-fill').css('width', '25%');
    }

    // Status: Semua Disetujui
    function showAllApproved() {
        $('.progress-steps').html(`
            <div class="step approved">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Mengirim</div>
                <div class="step-status">Terkirim</div>
                <div class="step-date">18 Nov 2025, 10:30</div>
            </div>
            <div class="step approved">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Persetujuan KK</div>
                <div class="step-status">Disetujui</div>
                <div class="step-date">18 Nov 2025, 14:20</div>
            </div>
            <div class="step approved">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Persetujuan Sekretariat</div>
                <div class="step-status">Disetujui</div>
                <div class="step-date">19 Nov 2025, 09:15</div>
            </div>
            <div class="step approved">
                <div class="step-circle"><i class="fas fa-check"></i></div>
                <div class="step-label">Persetujuan Dekan</div>
                <div class="step-status">Disetujui</div>
                <div class="step-date">19 Nov 2025, 15:30</div>
            </div>
        `);
        $('.progress-line-fill').css('width', '100%');
    }
    </script>
</body>
</html>