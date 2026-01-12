<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengajuan Disetujui - Dashboard Kaprodi</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:#f5f7fa;}
    .navbar{background:#8E44AD;color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 4px rgba(0,0,0,0.1);}
    .navbar h2{font-size:20px;}
    .container{max-width:1200px;margin:30px auto;padding:0 20px;}
    .card{background:white;border-radius:10px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,0.06);margin-bottom:20px}
    .card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #eee}
    table{width:100%;border-collapse:collapse}
    thead{background:#f4f6f7}
    th,td{padding:12px;border-bottom:1px solid #ecf0f1;text-align:left;font-size:14px}
    tbody tr:hover{background:#fbfcfd}
    .badge{display:inline-block;padding:6px 10px;border-radius:999px;font-weight:600;font-size:12px}
    .badge-approved{background:#d4edda;color:#155724}
    .badge-pending{background:#fff3cd;color:#856404}
    .badge-rejected{background:#f8d7da;color:#721c24}
    .btn{padding:6px 10px;border-radius:6px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s}
    .btn:hover{transform:scale(1.05)}
    
    /* Search & Filter Container */
    .search-filter-container{display:flex;align-items:center;gap:15px;margin-bottom:20px;flex-wrap:wrap;background:#f8f9fa;padding:15px;border-radius:10px;border:1px solid #e9ecef}
    .search-box{position:relative;flex:1;min-width:300px}
    .search-input{width:100%;padding:12px 45px 12px 15px;border:1px solid #ddd;border-radius:8px;font-size:14px;transition:all 0.3s;background:white}
    .search-input:focus{outline:none;border-color:#8E44AD;box-shadow:0 0 0 2px rgba(142,68,173,0.1)}
    .search-icon{position:absolute;right:15px;top:50%;transform:translateY(-50%);color:#6c757d}
    .filter-select{padding:12px 15px;border:1px solid #ddd;border-radius:8px;font-size:14px;background:white;color:#495057;min-width:180px;cursor:pointer;transition:all 0.3s}
    .filter-select:focus{outline:none;border-color:#8E44AD;box-shadow:0 0 0 2px rgba(142,68,173,0.1)}
    .btn-primary{padding:10px 20px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;background:#8E44AD;color:#fff;text-decoration:none}
    .btn-primary:hover{background:#7d3c98;transform:translateY(-2px)}
    .btn-secondary{padding:10px 20px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;background:#95a5a6;color:#fff;text-decoration:none}
    .btn-secondary:hover{background:#7f8c8d}
    
    /* Back Button */
    .back-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#3498db;color:white;text-decoration:none;border-radius:8px;font-weight:600;transition:all 0.3s;margin-bottom:20px}
    .back-btn:hover{background:#2980b9;transform:translateY(-2px)}
    
    /* Pagination Info */
    .pagination-info {
        color: #7f8c8d;
        font-size: 13px;
        margin-top: 10px;
        text-align: right;
    }
    
    /* Tombol Eviden - WARNA HIJAU */
    .btn-eviden {
        background: #28a745 !important;
        color: white !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 6px 10px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: 0.2s ease-in-out;
        font-size: 14px;
        height: 32px;
        min-width: 32px;
    }

    .btn-eviden i {
        font-size: 14px;
    }

    .btn-eviden:hover {
        background: #218838 !important;
        transform: scale(1.05);
    }
    
    /* Container tombol aksi untuk membuat semua tombol sejajar */
    .action-buttons {
        display: flex !important;
        flex-wrap: nowrap !important;
        gap: 6px !important;
        align-items: center !important;
        justify-content: flex-start !important;
        width: 100% !important;
        min-width: 120px !important;
    }
    
    /* Tombol Aksi dalam sel tabel */
    .action-buttons > * {
        flex-shrink: 0 !important;
    }
    
    /* Clickable Row Styles */
    .clickable-row:hover {
        background-color: #f0f8ff !important;
        box-shadow: inset 0 0 0 2px #3498db;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .clickable-row:active {
        background-color: #e3f2fd !important;
        transform: scale(0.995);
    }
    
    /* PERBAIKAN: Modal Stack Container - MAKSIMAL 2 MODAL */
    .modal-stack {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1050;
    }

    .modal-stack .modal-item {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: auto;
        transition: all 0.3s ease;
        min-width: 300px;
    }

    /* Modal pertama - di tengah */
    .modal-item:nth-child(1) {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1051;
    }

    /* Modal kedua - kanan atas */
    .modal-item:nth-child(2) {
        top: 50px;
        right: 50px;
        transform: none;
        z-index: 1052;
    }

    /* Modal aktif */
    .modal-item.active {
        z-index: 1053;
    }

    /* Modal number badge */
    .modal-number-badge {
        position: absolute;
        top: -10px;
        left: -10px;
        background: #e74c3c;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        z-index: 1060;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    /* Modal yang baru ditambahkan */
    .modal-item.new {
        animation: modalAppear 0.3s ease;
    }

    @keyframes modalAppear {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Modal yang akan dihapus */
    .modal-item.removing {
        animation: modalDisappear 0.3s ease;
    }

    @keyframes modalDisappear {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }
    }

    /* Responsive positioning untuk 2 modal */
    @media (max-width: 1200px) {
        .modal-item {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            bottom: auto !important;
            transform: none !important;
            margin: 10px;
        }
        
        .modal-stack {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            overflow-y: auto;
            padding: 20px;
            background: rgba(0,0,0,0.5);
            pointer-events: auto;
        }
        
        .modal-item {
            position: relative;
            margin-bottom: 15px;
            width: 95%;
        }
        
        .modal-number-badge {
            top: -8px;
            left: -8px;
        }
    }

    /* Tabel tetap bisa diakses saat modal terbuka */
    body.modal-open .container {
        pointer-events: auto !important;
    }

    body.modal-open .main-content {
        pointer-events: auto !important;
        opacity: 1 !important;
    }

    /* Scroll tetap aktif di latar belakang */
    body.modal-open {
        overflow: auto !important;
    }

    /* Modal close button */
    .modal-close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0,0,0,0.1);
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        font-size: 18px;
        z-index: 10;
        transition: background 0.2s;
    }

    .modal-close-btn:hover {
        background: rgba(0,0,0,0.2);
    }
    
    /* Detail Modal Styles */
    .modal{display:none !important;position:fixed;z-index:1050;background:rgba(0,0,0,0.45);align-items:center;justify-content:center}
    .modal.show{display:flex !important}
    .modal-content{background:white;padding:0;border-radius:15px;animation:slideIn 0.3s ease;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
    @keyframes slideIn{from{transform:translateY(-50px);opacity:0}to{transform:translateY(0);opacity:1}}
    .modal-header{background:#8E44AD;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
    .modal-header h3{margin:0;font-size:20px;font-weight:600}
    .close-modal{background:none;border:0;color:white;font-size:28px;cursor:pointer;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .close-modal:hover{background:rgba(255,255,255,0.2)}
    
    /* Detail Content Styles */
    .detail-content{padding:30px;max-height:calc(90vh - 80px);overflow-y:auto}
    .detail-section{margin-bottom:30px;background:#f8f9fa;border-radius:12px;padding:25px;border:1px solid #e9ecef}
    .detail-section:last-child{margin-bottom:0}
    .detail-section-title{font-size:18px;font-weight:700;color:#8E44AD;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #8E44AD;display:flex;align-items:center;gap:12px}
    .detail-section-title i{font-size:20px}
    .detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
    .detail-row{display:flex;flex-direction:column;margin-bottom:15px}
    .detail-label{font-weight:600;color:#495057;font-size:14px;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px}
    .detail-value{color:#212529;font-size:15px;background:white;padding:12px 18px;border-radius:8px;border:1px solid #e9ecef;min-height:45px;display:flex;align-items:center;word-break:break-word}
    .detail-value-empty{color:#6c757d;font-style:italic}
    
    /* Dosen list in detail */
    .dosen-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .dosen-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 15px;
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }

    .dosen-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #8E44AD;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        font-weight: 600;
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
    }

    .dosen-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .dosen-avatar-initial {
        position: relative;
        z-index: 1;
    }

    .dosen-info {
        flex: 1;
    }

    .dosen-name {
        font-weight: 600;
        color: #212529;
        font-size: 16px;
        margin-bottom: 4px;
    }

    .dosen-details {
        font-size: 13px;
        color: #6c757d;
        line-height: 1.4;
    }
    
    /* File Evidence Styles */
    .file-evidence{margin-top:15px}
    .file-item{display:flex;align-items:center;gap:15px;padding:15px 18px;background:white;border:1px solid #e9ecef;border-radius:8px;transition:all 0.2s;margin-bottom:10px}
    .file-item:hover{background:#f5eef8;border-color:#8E44AD}
    .file-icon{width:32px;height:32px;display:flex;align-items:center;justify-content:center;color:#8E44AD;font-size:20px;flex-shrink:0}
    .file-info{flex:1;min-width:0}
    .file-name{font-weight:600;color:#212529;font-size:15px;cursor:pointer;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .file-name:hover{color:#8E44AD}
    .file-size{font-size:13px;color:#6c757d;margin-top:4px}
    .preview-btn{background:#3498db;color:white;border:none;padding:10px 18px;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:8px;text-decoration:none;flex-shrink:0}
    .preview-btn:hover{background:#2980b9;color:white;text-decoration:none}
    .preview-btn.disabled{background:#bdc3c7;cursor:not-allowed;opacity:0.6}
    .preview-btn.disabled:hover{background:#bdc3c7}
    .download-btn{background:#8E44AD;color:white;border:none;padding:10px 18px;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:8px;text-decoration:none;flex-shrink:0;margin-left:10px}
    .download-btn:hover{background:#7D3C98;color:white;text-decoration:none}

    /* Preview Modal Styles */
    .preview-modal{display:none !important;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:1050;justify-content:center;align-items:center;padding:20px}
    .preview-modal.show{display:flex !important}
    .preview-content{background:white;border-radius:12px;width:90%;max-width:900px;max-height:90vh;overflow:hidden;display:flex;flex-direction:column}
    .preview-header{background:#8E44AD;color:white;padding:15px 20px;display:flex;justify-content:space-between;align-items:center}
    .preview-header h3{margin:0;font-size:16px;font-weight:600}
    .preview-close{background:none;border:none;color:white;font-size:24px;cursor:pointer;padding:0;width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .preview-close:hover{background:rgba(255,255,255,0.2)}
    .preview-body{flex:1;padding:0;display:flex;justify-content:center;align-items:center;background:#f8f9fa;min-height:400px}
    .preview-iframe{width:100%;height:70vh;border:none}
    .preview-image{max-width:100%;max-height:70vh;object-fit:contain}
    .preview-unsupported{text-align:center;padding:40px;color:#6c757d}
    .preview-unsupported i{font-size:48px;margin-bottom:15px;color:#8E44AD}
    .preview-unsupported h4{font-size:18px;margin-bottom:10px;color:#495057}
    .preview-unsupported p{font-size:14px;margin-bottom:20px}
    
    /* Action Buttons in Modal */
    .modal-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:25px;padding-top:25px;border-top:1px solid #e9ecef}
    .modal-btn{padding:12px 24px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:15px;transition:all 0.2s;display:flex;align-items:center;gap:10px}
    .modal-btn-close{background:#6c757d;color:white}
    .modal-btn-close:hover{background:#5a6268;transform:translateY(-2px)}
    
    /* Rejection Notes Styles */
    .rejection-notes{background:#fff5f5;border:1px solid #f8d7da;border-radius:8px;padding:25px;margin-top:20px}
    .rejection-notes .detail-label{color:#dc3545;font-weight:700;font-size:16px}
    .rejection-notes .detail-value{background:#fff5f5;border-color:#f8d7da;color:#721c24;font-size:15px;line-height:1.6;min-height:auto;padding:15px;border-radius:6px}
    
    /* Eviden Modal Styles */
    .eviden-modal .modal-content {
        max-width: 800px;
        width: 95%;
        max-height: 85vh;
    }
    
    /* Return Modal Styles */
    .return-modal .modal-content {
        max-width: 600px;
        width: 95%;
        max-height: 85vh;
    }
    
    /* Detail Modal Lebar Besar */
    .detail-modal .modal-content {
        max-width: 1100px !important;
        width: 95% !important;
        max-height: 90vh !important;
    }
    
    /* Tombol Return - WARNA ORANGE/KUNING */
    .btn-return {
        background: #ff9800 !important;
        color: white !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 6px 10px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        transition: 0.2s ease-in-out;
        font-size: 14px;
        height: 32px;
        min-width: 32px;
    }

    .btn-return i {
        font-size: 14px;
    }

    .btn-return:hover {
        background: #f57c00 !important;
        transform: scale(1.05);
    }
    
    /* Alert Styling */
    .alert-modal {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #f8d7da;
        color: #721c24;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1060;
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 400px;
        animation: slideInRight 0.3s ease;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .alert-icon {
        font-size: 20px;
        color: #721c24;
    }
    
    .alert-content {
        flex: 1;
    }
    
    .alert-close {
        background: none;
        border: none;
        color: #721c24;
        cursor: pointer;
        font-size: 18px;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: background 0.2s;
    }
    
    .alert-close:hover {
        background: rgba(0,0,0,0.1);
    }
    
    /* Responsive */
    @media (max-width:992px){
        .detail-grid{grid-template-columns:1fr}
        .modal-content{width:95%;margin:10px}
        .detail-content{padding:20px}
        .search-filter-container{flex-direction:column}
        .search-box{width:100%;min-width:100%}
        .filter-select{width:100%}
        .modal-actions{flex-direction:column}
        .modal-btn{justify-content:center;width:100%}
        
        .file-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        
        .file-info {
            width: 100%;
        }
        
        .preview-btn, .download-btn {
            width: 100%;
            margin-left: 0;
            margin-top: 8px;
            justify-content: center;
        }
        
        /* Table responsive */
        .clickable-row {
            display: block;
            margin-bottom: 10px;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .clickable-row td {
            display: block;
            text-align: right;
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }
        
        .clickable-row td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            color: #7f8c8d;
        }
        
        .clickable-row td:last-child {
            border-bottom: none;
        }
        
        /* Responsive untuk action buttons */
        .action-buttons {
            flex-wrap: wrap !important;
            gap: 4px !important;
        }
    }
    
    @media (max-width:768px){
        .container{max-width:100%;padding:0 15px}
        .card{padding:15px}
        .modal-header{padding:15px 20px}
        .modal-header h3{font-size:18px}
        .detail-section{padding:18px}
        .dosen-item{padding:10px;gap:12px}
        .dosen-avatar{width:40px;height:40px}
        .dosen-name{font-size:15px}
        
        /* Detail modal khusus di mobile */
        .detail-modal .modal-content {
            max-width: 95% !important;
            width: 95% !important;
        }
        
        /* Tombol aksi di mobile */
        .action-buttons {
            flex-direction: row !important;
            justify-content: center !important;
            gap: 4px !important;
        }
        
        /* Alert di mobile */
        .alert-modal {
            left: 10px;
            right: 10px;
            top: 10px;
            max-width: calc(100% - 20px);
        }
    }
</style>
</head>
<body>

<div class="navbar">
    <h2><i class="fa-solid fa-user-tie"></i> Dashboard Kaprodi - Pengajuan Disetujui</h2>
    <div></div>
</div>

<div class="container">
    <!-- Tombol Kembali -->
    <a href="<?= base_url('kaprodi') ?>" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    <?php if($this->session->flashdata('success')): ?>
    <div class="card" style="border-left:4px solid #27ae60;margin-bottom:18px">
        <div style="color:#155724;font-weight:700"><?php echo $this->session->flashdata('success'); ?></div>
    </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
    <div class="card" style="border-left:4px solid #e74c3c;margin-bottom:18px">
        <div style="color:#721c24;font-weight:700"><?php echo $this->session->flashdata('error'); ?></div>
    </div>
    <?php endif; ?>

    <!-- Tabel Pengajuan Disetujui -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Pengajuan Disetujui</h3>
            <div>
                <span style="color:#7f8c8d;font-size:13px" id="totalInfo">
                    Total: <?= isset($total_surat) ? $total_surat : '0' ?> data
                </span>
            </div>
        </div>
        
        <!-- Form Filter - TANPA FILTER STATUS -->
        <form method="get" action="<?= base_url('kaprodi/setujui') ?>" id="filterForm">
            <div class="search-filter-container">
                <div class="search-box">
                    <input 
                        type="text" 
                        name="search" 
                        class="search-input"
                        placeholder="Cari nama kegiatan atau penyelenggara..."
                        value="<?= $this->input->get('search') ?>"
                        autocomplete="off"
                    >
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                
                <!-- HANYA Filter Jenis Penugasan (tanpa filter status) -->
                <select name="jenis_penugasan" class="filter-select" onchange="submitFilter()">
                    <option value="all">Semua Jenis</option>
                    <option value="Perorangan" <?= ($this->input->get('jenis_penugasan') == 'Perorangan') ? 'selected' : '' ?>>Perorangan</option>
                    <option value="Kelompok" <?= ($this->input->get('jenis_penugasan') == 'Kelompok') ? 'selected' : '' ?>>Kelompok</option>
                </select>
                
                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-filter"></i> Terapkan
                </button>
                
                <a href="<?= base_url('kaprodi/setujui') ?>" class="btn-secondary">
                    <i class="fa-solid fa-refresh"></i> Reset
                </a>
            </div>
        </form>
        
        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Penyelenggara</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Nama Dosen</th>
                        <th>Status</th>
                        <th style="min-width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($surat_list) && is_array($surat_list) && !empty($surat_list)): 
                        $no = 1; 
                        foreach($surat_list as $s): 
                            $st_l = strtolower($s->status ?? '');
                            
                            // Tentukan warna berdasarkan kata kunci
                            if (strpos($st_l, 'setuju') !== false || strpos($st_l, 'disetujui') !== false) {
                                $st_key = 'approved';
                                $badge = '<span class="badge badge-approved">'.ucwords($s->status ?? '').'</span>';
                            } elseif (strpos($st_l, 'tolak') !== false || strpos($st_l, 'ditolak') !== false) {
                                $st_key = 'rejected';
                                $badge = '<span class="badge badge-rejected">'.ucwords($s->status ?? '').'</span>';
                            } else {
                                $st_key = 'pending';
                                $badge = '<span class="badge badge-pending">'.ucwords($s->status ?? '').'</span>';
                            }

                            $tgl_pengajuan = isset($s->created_at) && $s->created_at? date('d M Y', strtotime($s->created_at)) : '-';
                            $tgl_kegiatan = isset($s->tanggal_kegiatan) && $s->tanggal_kegiatan ? date('d M Y', strtotime($s->tanggal_kegiatan)) : '-';
                            
                            // Ambil nama dosen dengan format yang lebih baik
                            $dosen_display_list = [];
                            $dosen_display_html = '';
                            
                            // Cek 1: Apakah ada field nama_dosen langsung?
                            if (!empty($s->nama_dosen) && $s->nama_dosen != '-' && $s->nama_dosen != 'null') {
                                $dosen_display_list = [$s->nama_dosen];
                            }
                            // Cek 2: Apakah ada data dosen_list (JSON string)?
                            elseif (!empty($s->dosen_list) && $s->dosen_list != '-' && $s->dosen_list != 'null') {
                                // Coba decode JSON
                                $dosen_data = null;
                                
                                if (is_string($s->dosen_list)) {
                                    $decoded = json_decode($s->dosen_list, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $dosen_data = $decoded;
                                    } else {
                                        // Jika bukan JSON, coba sebagai string biasa
                                        $dosen_display_list = [$s->dosen_list];
                                    }
                                } elseif (is_array($s->dosen_list)) {
                                    $dosen_data = $s->dosen_list;
                                }
                                
                                // Proses array dosen_data
                                if (is_array($dosen_data) && !empty($dosen_data)) {
                                    foreach ($dosen_data as $item) {
                                        if (is_array($item) && isset($item['nama'])) {
                                            $dosen_display_list[] = $item['nama'];
                                        } elseif (is_string($item)) {
                                            $dosen_display_list[] = $item;
                                        } elseif (is_object($item) && isset($item->nama)) {
                                            $dosen_display_list[] = $item->nama;
                                        }
                                    }
                                }
                            }
                            
                            // Cek 3: Apakah ada NIP dan perlu diambil dari database?
                            elseif (!empty($s->nip) && $s->nip != '-' && $s->nip != 'null') {
                                // Jika NIP adalah string JSON
                                $nip_data = $s->nip;
                                if (is_string($nip_data)) {
                                    // Coba decode JSON terlebih dahulu
                                    $decoded_nip = json_decode($nip_data, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_nip) && !empty($decoded_nip)) {
                                        // Ini adalah array NIP dalam format JSON
                                        $nip_array = $decoded_nip;
                                    } else {
                                        // Ini adalah string NIP biasa
                                        $nip_array = [$nip_data];
                                    }
                                } elseif (is_array($nip_data)) {
                                    // Sudah dalam format array
                                    $nip_array = $nip_data;
                                } else {
                                    // Format lainnya
                                    $nip_array = [];
                                }
                                
                                // Jika ada NIP array, ambil data dosen dari database
                                if (!empty($nip_array)) {
                                    // Pastikan semua elemen adalah string untuk query
                                    $valid_nips = [];
                                    foreach ($nip_array as $nip_item) {
                                        if (is_string($nip_item) && !empty($nip_item) && $nip_item != '-' && $nip_item != 'null') {
                                            $valid_nips[] = $nip_item;
                                        } elseif (is_numeric($nip_item)) {
                                            $valid_nips[] = (string)$nip_item;
                                        }
                                    }
                                    
                                    if (!empty($valid_nips)) {
                                        $this->db->select('nama_dosen');
                                        $this->db->from('list_dosen');
                                        $this->db->where_in('nip', $valid_nips);
                                        $dosen_db = $this->db->get()->result_array();
                                        
                                        if (!empty($dosen_db)) {
                                            $dosen_display_list = array_column($dosen_db, 'nama_dosen');
                                        }
                                    }
                                }
                            }
                            
                            // Cek 4: Apakah ada field lain yang mungkin berisi nama dosen?
                            if (empty($dosen_display_list)) {
                                // Coba cek field-field lain yang mungkin berisi nama dosen
                                $possible_fields = ['dosen', 'nama_pengaju', 'pengaju', 'user_nama', 'created_by'];
                                foreach ($possible_fields as $field) {
                                    if (isset($s->$field) && !empty($s->$field) && $s->$field != '-' && $s->$field != 'null') {
                                        $dosen_display_list[] = $s->$field;
                                        break;
                                    }
                                }
                            }
                            
                            // Generate HTML untuk tampilan nama dosen
                            if (!empty($dosen_display_list)) {
                                $dosen_display_html = '<div style="display: flex; flex-direction: column; gap: 6px;">';
                                foreach ($dosen_display_list as $index => $nama) {
                                    $dosen_display_html .= '
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="
                                                background: #8E44AD;
                                                color: white;
                                                border-radius: 50%;
                                                width: 24px;
                                                height: 24px;
                                                display: inline-flex;
                                                align-items: center;
                                                justify-content: center;
                                                font-size: 12px;
                                                font-weight: 600;
                                                flex-shrink: 0;
                                            ">' . ($index + 1) . '</span>
                                            <span style="
                                                font-size: 14px;
                                                color: #2c3e50;
                                                line-height: 1.4;
                                            ">' . htmlspecialchars($nama) . '</span>
                                        </div>';
                                }
                                $dosen_display_html .= '</div>';
                            } else {
                                $dosen_display_html = '<span style="color: #95a5a6; font-style: italic;">Data dosen tidak tersedia</span>';
                            }
                    ?>
                    <!-- BARIS TABEL BISA DIKLIK UNTUK DETAIL -->
                    <tr onclick="showRowDetail(<?= $s->id ?? 0 ?>)" style="cursor: pointer;" class="clickable-row">
                        <td data-label="No"><?= $no++ ?></td>
                        <td data-label="Nama Kegiatan"><strong><?= htmlspecialchars($s->nama_kegiatan ?? '-') ?></strong></td>
                        <td data-label="Penyelenggara"><?= htmlspecialchars($s->penyelenggara ?? '-') ?></td>
                        <td data-label="Tanggal Pengajuan"><?= $tgl_pengajuan ?></td>
                        <td data-label="Tanggal Kegiatan"><?= $tgl_kegiatan ?></td>
                        <td data-label="Nama Dosen">
                            <?= $dosen_display_html ?>
                        </td>
                        <td data-label="Status"><?= $badge ?></td>
                        <!-- TOMBOL AKSI DALAM CONTAINER FLEX -->
                        <td data-label="Aksi">
                            <div class="action-buttons">
                                <!-- Tombol Eviden (Hijau) -->
                                <button class="btn btn-eviden" onclick="event.stopPropagation(); handleEvidenClick(<?= $s->id ?? 0 ?>, '<?= htmlspecialchars($s->nama_kegiatan ?? '', ENT_QUOTES) ?>')" title="Lihat Eviden">
                                    <i class="fas fa-file-image"></i>
                                </button>

                                <?php if(in_array($s->status ?? '', ['disetujui KK', 'ditolak KK'])): ?>
                                    <!-- Tombol Return: Kembalikan ke status awal -->
                                    <button class="btn btn-return" onclick="event.stopPropagation(); showReturnModal(<?= $s->id ?? 0 ?>, '<?= htmlspecialchars($s->nama_kegiatan ?? '', ENT_QUOTES) ?>')" title="Kembalikan Pengajuan">
                                        <i class="fa-solid fa-undo"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;color:#7f8c8d">
                            <i class="fa-solid fa-check-circle" style="font-size:48px;margin-bottom:10px;display:block;opacity:0.3"></i>
                            <strong>Belum ada pengajuan yang disetujui</strong>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Info Filter - TANPA INFO STATUS -->
        <div class="pagination-info">
            Menampilkan: Semua Data (<?= isset($total_surat) ? $total_surat : '0' ?> data)
        </div>
    </div>
</div>

<!-- Modal Stack Container -->
<div id="modalStack" class="modal-stack"></div>

<!-- Modal Templates -->
<template id="detailModalTemplate">
    <div class="modal-content detail-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-file-alt"></i> Detail Pengajuan Surat Tugas</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="detail-content">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</template>

<template id="evidenModalTemplate">
    <div class="modal-content eviden-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-file-image"></i> File Evidence</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="detail-content">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</template>

<template id="previewModalTemplate">
    <div class="preview-content">
        <div class="preview-header">
            <h3>Preview File</h3>
            <button class="preview-close">&times;</button>
        </div>
        <div class="preview-body"></div>
    </div>
</template>

<template id="returnModalTemplate">
    <div class="modal-content return-modal">
        <div class="modal-header" style="background: #ff9800;">
            <h3><i class="fa-solid fa-undo"></i> Konfirmasi Pengembalian</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div style="padding:25px">
            <div style="background:#fff3e0; border:1px solid #ff9800; border-radius:8px; padding:15px; margin-bottom:20px">
                <strong style="color:#ff9800; display:block; margin-bottom:5px">
                    <i class="fa-solid fa-exclamation-triangle"></i> Peringatan
                </strong>
                <span class="return-nama-kegiatan">-</span>
            </div>
            
            <p style="margin-bottom:20px; color:#e65100; font-weight:600">
                ⚠️ Pengajuan ini akan dikembalikan ke status sebelumnya dan dapat diajukan ulang.
            </p>
            
            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:25px; padding-top:20px; border-top:1px solid #e9ecef">
                <button type="button" class="btn btn-cancel" style="background:#95a5a6; color:white">
                    <i class="fa-solid fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-confirm-return" style="background:#ff9800; color:white">
                    <i class="fa-solid fa-undo"></i> Ya, Kembalikan
                </button>
            </div>
        </div>
    </div>
</template>

<script>
// ===== MULTI MODAL MANAGEMENT SYSTEM =====

// Global variables
let modalManager;
let currentReturnId = null;
let currentReturnNamaKegiatan = null;

// PERBAIKAN: Fungsi untuk menampilkan alert
function showAlert(message, type = 'warning') {
    // Hapus alert sebelumnya jika ada
    const existingAlert = document.querySelector('.alert-modal');
    if (existingAlert) {
        existingAlert.remove();
    }
    
    const alert = document.createElement('div');
    alert.className = `alert-modal ${type}`;
    
    let icon = 'fa-info-circle';
    if (type === 'error') icon = 'fa-exclamation-circle';
    if (type === 'success') icon = 'fa-check-circle';
    if (type === 'warning') icon = 'fa-exclamation-triangle';
    
    alert.innerHTML = `
        <div class="alert-icon">
            <i class="fas ${icon}"></i>
        </div>
        <div class="alert-content">
            <strong>${type === 'error' ? 'Error' : type === 'success' ? 'Sukses' : 'Peringatan'}</strong>
            <div>${message}</div>
        </div>
        <button class="alert-close">&times;</button>
    `;
    
    document.body.appendChild(alert);
    
    // Event listener untuk tombol close
    alert.querySelector('.alert-close').addEventListener('click', () => {
        alert.remove();
    });
    
    // Auto remove setelah 5 detik
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
}

// Modal Manager Class
class ModalManager {
    constructor() {
        this.modals = [];
        this.activeModal = null;
        this.modalStack = document.getElementById('modalStack');
        this.modalZIndex = 1050;
    }

    // Create a new modal
    createModal(type, data = {}) {
        // PERBAIKAN: Cek jika sudah ada 2 modal terbuka (MAKSIMAL 2)
        if (this.modals.length >= 2) {
            showAlert('Maksimal hanya dapat membuka 2 modal sekaligus. Tutup salah satu modal terlebih dahulu.', 'warning');
            return null;
        }
        
        const modalId = `modal_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
        const modalItem = document.createElement('div');
        modalItem.className = 'modal-item';
        modalItem.id = modalId;
        modalItem.style.zIndex = this.modalZIndex++;
        
        // Create modal content based on type
        let modalContent;
        switch(type) {
            case 'detail':
                modalContent = this.createDetailModal(data);
                break;
            case 'eviden':
                modalContent = this.createEvidenModal(data);
                break;
            case 'preview':
                modalContent = this.createPreviewModal(data);
                break;
            case 'return':
                modalContent = this.createReturnModal(data);
                break;
            default:
                modalContent = this.createGenericModal(data);
        }
        
        modalItem.innerHTML = modalContent;
        this.modalStack.appendChild(modalItem);
        
        // PERBAIKAN: Tambahkan nomor badge pada modal
        const modalNumber = this.modals.length + 1;
        const numberBadge = document.createElement('div');
        numberBadge.className = 'modal-number-badge';
        numberBadge.textContent = modalNumber;
        modalItem.appendChild(numberBadge);
        
        // Add to modals array
        const modalObj = {
            id: modalId,
            type: type,
            element: modalItem,
            data: data,
            number: modalNumber
        };
        
        this.modals.push(modalObj);
        this.setActiveModal(modalId);
        
        // Update modal positions
        this.updateModalPositions();
        
        // Add event listeners
        this.attachEventListeners(modalItem, modalId, type, data);
        
        // Animate appearance
        setTimeout(() => {
            modalItem.classList.add('active', 'new');
            setTimeout(() => modalItem.classList.remove('new'), 300);
        }, 10);
        
        // Update body class
        document.body.classList.add('modal-open');
        
        return modalId;
    }

    // Update positions of all modals
    updateModalPositions() {
        this.modals.forEach((modal, index) => {
            const modalElement = modal.element;
            const numberBadge = modalElement.querySelector('.modal-number-badge');
            
            if (numberBadge) {
                numberBadge.textContent = index + 1;
            }
            
            // Reset transform first
            modalElement.style.transform = 'none';
            
            if (this.modals.length === 1) {
                // Jika hanya 1 modal, posisi di tengah
                modalElement.style.top = '50%';
                modalElement.style.left = '50%';
                modalElement.style.transform = 'translate(-50%, -50%)';
            } else if (this.modals.length === 2) {
                if (index === 0) {
                    // Modal pertama pindah ke kiri atas
                    modalElement.style.top = '50px';
                    modalElement.style.left = '50px';
                    modalElement.style.transform = 'none';
                } else if (index === 1) {
                    // Modal kedua di kanan atas
                    modalElement.style.top = '50px';
                    modalElement.style.right = '50px';
                    modalElement.style.left = 'auto';
                    modalElement.style.transform = 'none';
                }
            }
        });
    }

    // Create detail modal
    createDetailModal(data) {
        const template = document.getElementById('detailModalTemplate');
        return template.content.cloneNode(true).querySelector('.modal-content').outerHTML;
    }

    // Create eviden modal
    createEvidenModal(data) {
        const template = document.getElementById('evidenModalTemplate');
        return template.content.cloneNode(true).querySelector('.modal-content').outerHTML;
    }

    // Create preview modal
    createPreviewModal(data) {
        const template = document.getElementById('previewModalTemplate');
        return template.content.cloneNode(true).querySelector('.preview-content').outerHTML;
    }

    // Create return modal
    createReturnModal(data) {
        const template = document.getElementById('returnModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.namaKegiatan) {
            modalContent.querySelector('.return-nama-kegiatan').textContent = data.namaKegiatan;
        }
        
        return modalContent.outerHTML;
    }

    // Create generic modal
    createGenericModal(data) {
        return `
            <div class="modal-content">
                <div class="modal-header">
                    <h3>${data.title || 'Modal'}</h3>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="detail-content">
                    ${data.content || ''}
                </div>
            </div>
        `;
    }

    // Set active modal
    setActiveModal(modalId) {
        // Deactivate all modals
        this.modals.forEach(modal => {
            modal.element.classList.remove('active');
        });
        
        // Activate selected modal
        const modal = this.modals.find(m => m.id === modalId);
        if (modal) {
            modal.element.classList.add('active');
            modal.element.style.zIndex = this.modalZIndex++;
            this.activeModal = modal;
        }
    }

    // Close modal
    closeModal(modalId) {
        const modalIndex = this.modals.findIndex(m => m.id === modalId);
        if (modalIndex === -1) return;
        
        const modal = this.modals[modalIndex];
        modal.element.classList.add('removing');
        
        setTimeout(() => {
            if (modal.element.parentNode) {
                modal.element.parentNode.removeChild(modal.element);
            }
            this.modals.splice(modalIndex, 1);
            
            // Update positions of remaining modals
            this.updateModalPositions();
            
            // If no modals left, remove modal-open class
            if (this.modals.length === 0) {
                document.body.classList.remove('modal-open');
                this.activeModal = null;
            } else {
                // Set the last modal as active
                this.setActiveModal(this.modals[this.modals.length - 1].id);
            }
        }, 300);
    }

    // Attach event listeners to modal
    attachEventListeners(modalElement, modalId, type, data) {
        // Close button
        const closeBtn = modalElement.querySelector('.close-modal');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeModal(modalId));
        }
        
        // Preview close button
        const previewCloseBtn = modalElement.querySelector('.preview-close');
        if (previewCloseBtn) {
            previewCloseBtn.addEventListener('click', () => this.closeModal(modalId));
        }
        
        // Cancel buttons
        const cancelBtns = modalElement.querySelectorAll('.btn-cancel');
        cancelBtns.forEach(btn => {
            btn.addEventListener('click', () => this.closeModal(modalId));
        });
        
        // Type-specific event listeners
        switch(type) {
            case 'detail':
                this.attachDetailModalListeners(modalElement, modalId, data);
                break;
            case 'eviden':
                this.attachEvidenModalListeners(modalElement, modalId, data);
                break;
            case 'return':
                this.attachReturnModalListeners(modalElement, modalId, data);
                break;
        }
        
        // Click on modal to bring to front
        modalElement.addEventListener('mousedown', (e) => {
            if (e.target.closest('button') && e.target.closest('button').classList.contains('close-modal')) return;
            if (e.target.closest('button') && e.target.closest('button').classList.contains('preview-close')) return;
            this.setActiveModal(modalId);
        });
        
        // Prevent clicks inside modal from propagating to table
        modalElement.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }

    // Attach detail modal listeners
    attachDetailModalListeners(modalElement, modalId, data) {
        // Load detail content if data provided
        if (data.suratId) {
            this.loadDetailContent(modalElement, data.suratId);
        }
    }

    // Attach eviden modal listeners
    attachEvidenModalListeners(modalElement, modalId, data) {
        // Load eviden content if data provided
        if (data.suratId) {
            this.loadEvidenContent(modalElement, data.suratId, data.namaKegiatan || '');
        }
    }

    // Attach return modal listeners
    attachReturnModalListeners(modalElement, modalId, data) {
        const confirmBtn = modalElement.querySelector('.btn-confirm-return');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', () => {
                this.submitReturnForm(data.suratId);
            });
        }
    }

    // Load detail content
    async loadDetailContent(modalElement, suratId) {
        try {
            const detailContent = modalElement.querySelector('.detail-content');
            if (!detailContent) return;
            
            detailContent.innerHTML = `
                <div style="text-align:center;padding:60px;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size:32px;color:#8E44AD"></i>
                    <p style="margin-top:15px;color:#7f8c8d;font-size:16px">Memuat detail pengajuan...</p>
                </div>
            `;
            
            const data = await getSuratDetail(suratId);
            if (!data) {
                throw new Error('Data tidak ditemukan');
            }
            
            const detailHtml = generateDetailContent(data);
            detailContent.innerHTML = detailHtml;
            
        } catch (error) {
            console.error('Error loading detail:', error);
            const detailContent = modalElement.querySelector('.detail-content');
            if (detailContent) {
                detailContent.innerHTML = `
                    <div style="text-align:center;padding:50px;color:#e74c3c">
                        <i class="fa-solid fa-exclamation-triangle" style="font-size:56px;margin-bottom:15px"></i>
                        <p style="font-size:16px;margin-bottom:20px">Gagal memuat detail: ${error.message}</p>
                        <button class="modal-btn modal-btn-close" onclick="modalManager.closeModal('${modalElement.closest('.modal-item').id}')" style="margin-top:20px;padding:12px 24px;font-size:15px">
                            <i class="fa-solid fa-times"></i> Tutup
                        </button>
                    </div>
                `;
            }
        }
    }

    // Load eviden content - DIPERBAIKI: Langsung preview jika hanya 1 file
    async loadEvidenContent(modalElement, suratId, namaKegiatan = '') {
        try {
            const detailContent = modalElement.querySelector('.detail-content');
            if (!detailContent) return;
            
            detailContent.innerHTML = `
                <div style="text-align:center;padding:40px;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#8E44AD"></i>
                    <p style="margin-top:10px;color:#7f8c8d">Memuat eviden...</p>
                </div>
            `;
            
            const item = await getSuratDetail(suratId);
            if (!item) {
                throw new Error('Data tidak ditemukan');
            }
            
            const evidenFiles = getEvidenFilesFromData(item);
            
            // PERBAIKAN: Jika hanya ada 1 file eviden, langsung preview
            if (evidenFiles.length === 1) {
                // Tutup modal eviden
                this.closeModal(modalElement.closest('.modal-item').id);
                
                // Langsung buka preview file
                const singleFile = evidenFiles[0];
                setTimeout(() => {
                    previewFile(singleFile.url, singleFile.name);
                }, 100);
                return;
            }
            
            // Jika lebih dari 1 file, tampilkan daftar file
            const content = generateMultipleEvidenContent(item, evidenFiles, namaKegiatan);
            detailContent.innerHTML = content;
            
        } catch (error) {
            console.error('Error loading eviden:', error);
            const detailContent = modalElement.querySelector('.detail-content');
            if (detailContent) {
                detailContent.innerHTML = `
                    <div style="text-align:center;padding:40px;color:#e74c3c">
                        <i class="fa-solid fa-exclamation-triangle" style="font-size:48px;margin-bottom:10px"></i>
                        <p>Gagal memuat eviden: ${error.message}</p>
                        <button class="modal-btn modal-btn-close" onclick="modalManager.closeModal('${modalElement.closest('.modal-item').id}')" style="margin-top:20px">
                            <i class="fa-solid fa-times"></i> Tutup
                        </button>
                    </div>
                `;
            }
        }
    }

    // Submit return form
    submitReturnForm(suratId) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= base_url("kaprodi/return_pengajuan/") ?>' + suratId;
        
        const csrfName = '<?= $this->security->get_csrf_token_name() ?>';
        const csrfHash = '<?= $this->security->get_csrf_hash() ?>';
        
        // Tambahkan CSRF token
        const inpCsrf = document.createElement('input');
        inpCsrf.type = 'hidden';
        inpCsrf.name = csrfName;
        inpCsrf.value = csrfHash;
        form.appendChild(inpCsrf);
        
        document.body.appendChild(form);
        form.submit();
    }

    // Get modal by ID
    getModal(modalId) {
        return this.modals.find(m => m.id === modalId);
    }

    // Close all modals
    closeAllModals() {
        while (this.modals.length > 0) {
            this.closeModal(this.modals[0].id);
        }
    }
}

// ===== FUNGSI UTAMA =====

// Initialize modal manager
modalManager = new ModalManager();

// Data dari controller
const suratList = <?= isset($surat_list) && !empty($surat_list) ? json_encode($surat_list) : '[]' ?>;

// Fungsi untuk submit filter secara otomatis
function submitFilter() {
    document.getElementById('filterForm').submit();
}

// ============================================
// FUNGSI UNTUK MEMBUKA MODAL
// ============================================

// Fungsi untuk menampilkan detail saat baris diklik
function showRowDetail(id) {
    modalManager.createModal('detail', { suratId: id });
}

// PERBAIKAN: Handle klik button eviden - langsung preview jika hanya 1 file
async function handleEvidenClick(suratId, namaKegiatan = '') {
    try {
        // Cek jumlah modal yang terbuka
        if (modalManager.modals.length >= 2) {
            showAlert('Maksimal hanya dapat membuka 2 modal sekaligus. Tutup salah satu modal terlebih dahulu.', 'warning');
            return;
        }
        
        // Ambil data untuk cek jumlah file
        const item = await getSuratDetail(suratId);
        if (!item) {
            showAlert('Data tidak ditemukan', 'error');
            return;
        }
        
        const evidenFiles = getEvidenFilesFromData(item);
        
        if (evidenFiles.length === 0) {
            showAlert('Tidak ada file eviden untuk pengajuan ini', 'info');
            return;
        }
        
        // Jika hanya ada 1 file, langsung preview
        if (evidenFiles.length === 1) {
            const singleFile = evidenFiles[0];
            previewFile(singleFile.url, singleFile.name);
        } else {
            // Jika lebih dari 1 file, buka modal eviden
            modalManager.createModal('eviden', { 
                suratId: suratId, 
                namaKegiatan: namaKegiatan 
            });
        }
        
    } catch (error) {
        console.error('Error handling eviden click:', error);
        showAlert('Gagal memuat file eviden', 'error');
    }
}

// Fungsi untuk menampilkan return modal
function showReturnModal(id, namaKegiatan) {
    modalManager.createModal('return', { 
        suratId: id, 
        namaKegiatan: namaKegiatan 
    });
}

// ============================================
// FUNGSI PREVIEW FILE
// ============================================

function previewFile(fileUrl, fileName) {
    // Cek jumlah modal yang terbuka
    if (modalManager.modals.length >= 2) {
        showAlert('Maksimal hanya dapat membuka 2 modal sekaligus. Tutup salah satu modal terlebih dahulu.', 'warning');
        return;
    }
    
    // Create preview modal
    const modalId = modalManager.createModal('preview');
    const modal = modalManager.getModal(modalId);
    
    if (!modal) return;
    
    const modalElement = modal.element;
    const previewBody = modalElement.querySelector('.preview-body');
    const previewTitle = modalElement.querySelector('h3');
    
    if (previewTitle) previewTitle.textContent = 'Preview: ' + fileName;
    
    if (previewBody) {
        previewBody.innerHTML = `
            <div style="text-align: center; padding: 40px;">
                <i class="fas fa-spinner fa-spin" style="font-size: 48px; color: #8E44AD;"></i>
                <p style="margin-top: 15px; color: #6c757d;">Memuat preview...</p>
            </div>
        `;
        
        const fileExtension = fileName.split('.').pop().toLowerCase();
        const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        const pdfExtensions = ['pdf'];
        
        setTimeout(() => {
            if (imageExtensions.includes(fileExtension)) {
                const img = new Image();
                img.onload = function() {
                    previewBody.innerHTML = `<img src="${fileUrl}" class="preview-image" alt="${fileName}">`;
                };
                img.onerror = function() {
                    showUnsupportedPreview(previewBody, fileUrl, fileName);
                };
                img.src = fileUrl;
            } else if (pdfExtensions.includes(fileExtension)) {
                previewBody.innerHTML = `
                    <iframe 
                        src="${fileUrl}" 
                        class="preview-iframe" 
                        frameborder="0"
                    ></iframe>
                `;
            } else {
                showUnsupportedPreview(previewBody, fileUrl, fileName);
            }
        }, 100);
    }
}

function showUnsupportedPreview(previewBody, fileUrl, fileName) {
    previewBody.innerHTML = `
        <div class="preview-unsupported">
            <i class="fas fa-eye-slash"></i>
            <h4>Preview Tidak Tersedia</h4>
            <p>File "${escapeHtml(fileName)}" tidak dapat dipreview di browser.</p>
            <a href="${fileUrl}" class="download-btn" download="${fileName}" target="_blank" style="margin-top: 15px;">
                <i class="fas fa-download"></i> Download File
            </a>
        </div>
    `;
}

// ============================================
// FUNGSI HELPER
// ============================================

// PERBAIKAN: Fungsi untuk mengambil data detail via AJAX
function getSuratDetail(id) {
    return fetch('<?= site_url("kaprodi/getDetailPengajuan/") ?>' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                return data.data;
            } else {
                throw new Error(data.message || 'Gagal memuat data');
            }
        })
        .catch(error => {
            console.error('Error fetching detail:', error);
            throw error;
        });
}

// Fungsi helper untuk mendapatkan array file eviden dari data
function getEvidenFilesFromData(item) {
    const getVal = (k) => {
        const value = (item[k] !== undefined && item[k] !== null && item[k] !== '' ? item[k] : '-');
        return value;
    };

    const evidenValue = getVal('eviden');
    const baseUrl = '<?= base_url() ?>';
    let evidenFiles = [];
    
    if (evidenValue && evidenValue !== '-') {
        try {
            // Coba parse JSON jika eviden adalah array
            if (Array.isArray(evidenValue)) {
                evidenValue.forEach(file => {
                    if (file && file !== '-' && file !== 'null') {
                        const fileName = getFileNameFromPath(file);
                        const fileUrl = getFileUrl(file, baseUrl);
                        evidenFiles.push({
                            name: fileName,
                            url: fileUrl,
                            ext: fileName.split('.').pop().toLowerCase()
                        });
                    }
                });
            } else if (typeof evidenValue === 'string' && evidenValue.startsWith('[')) {
                const parsed = JSON.parse(evidenValue);
                if (Array.isArray(parsed)) {
                    parsed.forEach(file => {
                        if (file && file !== '-' && file !== 'null') {
                            const fileName = getFileNameFromPath(file);
                            const fileUrl = getFileUrl(file, baseUrl);
                            evidenFiles.push({
                                name: fileName,
                                url: fileUrl,
                                ext: fileName.split('.').pop().toLowerCase()
                            });
                        }
                    });
                }
            } else {
                // Single file string
                const fileName = getFileNameFromPath(evidenValue);
                const fileUrl = getFileUrl(evidenValue, baseUrl);
                evidenFiles.push({
                    name: fileName,
                    url: fileUrl,
                    ext: fileName.split('.').pop().toLowerCase()
                });
            }
        } catch (e) {
            // Fallback: treat as single file
            const fileName = getFileNameFromPath(evidenValue);
            const fileUrl = getFileUrl(evidenValue, baseUrl);
            evidenFiles.push({
                name: fileName,
                url: fileUrl,
                ext: fileName.split('.').pop().toLowerCase()
            });
        }
    }
    
    return evidenFiles;
}

// Helper function untuk mendapatkan nama file dari path
function getFileNameFromPath(path) {
    if (!path) return 'file';
    return path.split('/').pop().split('\\').pop();
}

// Helper function untuk mendapatkan URL file yang lengkap
function getFileUrl(filePath, baseUrl) {
    if (!filePath) return '#';
    
    // Jika sudah URL lengkap
    if (filePath.startsWith('http://') || filePath.startsWith('https://') || filePath.startsWith('<?= base_url() ?>')) {
        return filePath;
    }
    
    // Coba beberapa kemungkinan path
    const fileName = getFileNameFromPath(filePath);
    const possiblePaths = [
        'uploads/eviden/' + fileName,
        'eviden/' + fileName,
        'assets/eviden/' + fileName,
        'uploads/' + fileName,
        filePath  // original path
    ];
    
    // Gunakan path pertama
    return baseUrl + possiblePaths[0];
}

// Fungsi untuk generate konten multiple eviden (lebih dari 1 file)
function generateMultipleEvidenContent(item, evidenFiles, namaKegiatan = '') {
    // Generate file evidence HTML untuk multiple files
    let fileEvidenceHtml = '';
    
    if (evidenFiles.length > 0) {
        fileEvidenceHtml = `
        <div class="detail-section">
            <div class="detail-section-title">
                <i class="fa-solid fa-paperclip"></i> File Evidence (${evidenFiles.length} file)
            </div>
            <div class="file-evidence">`;
        
        evidenFiles.forEach((file, index) => {
            const ext = file.ext;
            let fileIcon = 'fa-file';
            let canPreview = false;
            
            if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(ext)) {
                fileIcon = 'fa-file-image';
                canPreview = true;
            } else if (ext === 'pdf') {
                fileIcon = 'fa-file-pdf';
                canPreview = true;
            } else if (['doc', 'docx'].includes(ext)) {
                fileIcon = 'fa-file-word';
            } else if (['xls', 'xlsx'].includes(ext)) {
                fileIcon = 'fa-file-excel';
            }
            
            fileEvidenceHtml += `
                <div class="file-item">
                    <div class="file-icon">
                        <i class="fa-solid ${fileIcon}"></i>
                    </div>
                    <div class="file-info" ${canPreview ? `onclick="previewFile('${file.url}', '${file.name}')" style="cursor: pointer;"` : ''}>
                        <div class="file-name" ${canPreview ? 'title="Klik untuk preview"' : ''}>${escapeHtml(file.name)}</div>
                        <div class="file-size">File ${index + 1} - ${ext.toUpperCase()}</div>
                    </div>
                    ${canPreview ? 
                        `<button class="preview-btn" onclick="previewFile('${file.url}', '${file.name}')">
                            <i class="fa-solid fa-eye"></i> Preview
                        </button>` :
                        `<button class="preview-btn disabled" disabled title="Preview tidak tersedia">
                            <i class="fa-solid fa-eye-slash"></i> Preview
                        </button>`
                    }
                    <a href="${file.url}" target="_blank" class="download-btn" download="${file.name}">
                        <i class="fa-solid fa-download"></i> Download
                    </a>
                </div>`;
        });
        
        fileEvidenceHtml += `
            </div>
        </div>`;
    } else {
        fileEvidenceHtml = `
        <div class="detail-section">
            <div class="detail-section-title">
                <i class="fa-solid fa-paperclip"></i> File Evidence
            </div>
            <div style="text-align:center;padding:40px;color:#6c757d">
                <i class="fa-solid fa-file" style="font-size:48px;margin-bottom:15px;opacity:0.3"></i>
                <p>Tidak ada file eviden untuk pengajuan ini.</p>
            </div>
        </div>`;
    }

    const currentModalId = modalManager.activeModal?.id || '';
    
    return `       
        ${fileEvidenceHtml}
        
        <div class="modal-actions">
            <button class="modal-btn modal-btn-close" onclick="modalManager.closeModal('${currentModalId}')">
                <i class="fa-solid fa-times"></i> Tutup
            </button>
        </div>
    `;
}

// ============================================
// FUNGSI GENERATE DETAIL CONTENT
// ============================================

function generateDetailContent(item) {
    // Helper function untuk mendapatkan nilai
    const getVal = (k) => {
        const value = (item[k] !== undefined && item[k] !== null && item[k] !== '' ? item[k] : '-');
        return value;
    };
    
    // Format status badge
    let statusBadge = '';
    const status = getVal('status').toLowerCase();
    
    if (status.includes('setuju')) {
        statusBadge = `<span class="badge badge-approved">${getVal('status')}</span>`;
    } else if (status.includes('tolak')) {
        statusBadge = `<span class="badge badge-rejected">${getVal('status')}</span>`;
    } else {
        statusBadge = `<span class="badge badge-pending">${getVal('status')}</span>`;
    }
    
    // Ambil data dosen
    const dosenData = item.dosen_data || [];
    
    // ✅ Generate HTML untuk data dosen DENGAN FOTO (TANPA INITIAL)
    let dosenHtml = '';
    if (dosenData && dosenData.length > 0) {
        dosenHtml = `
        <div class="dosen-list">
            ${dosenData.map((dosen, index) => {
                const initial = dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?';
                const foto = dosen.foto || '';
                const hasFoto = foto && foto.trim() !== '' && foto !== 'null';
                
                return `
            <div class="dosen-item">
                <div class="dosen-avatar" style="width: 45px; height: 45px; border-radius: 50%; background: #8E44AD; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; font-weight: 600; overflow: hidden; position: relative; flex-shrink: 0;">
                    ${hasFoto ? `
                        <img src="${escapeHtml(foto)}" 
                             alt="${escapeHtml(dosen.nama)}" 
                             style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 2;"
                             onerror="console.error('Image load error:', this.src); this.style.display='none'; this.parentElement.style.background='#8E44AD';">
                    ` : `
                        <span style="position: relative; z-index: 1; font-size: 18px;">${initial}</span>
                    `}
                </div>
                <div class="dosen-info">
                    <div class="dosen-name">${escapeHtml(dosen.nama)}</div>
                    <div class="dosen-details">
                        NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)} | Divisi: ${escapeHtml(dosen.divisi)}
                    </div>
                </div>
            </div>
                `;
            }).join('')}
        </div>`;
    } else {
        dosenHtml = `
        <div class="dosen-item">
            <div class="dosen-avatar" style="width: 45px; height: 45px; border-radius: 50%; background: #8E44AD; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: 600;">
                <span>?</span>
            </div>
            <div class="dosen-info">
                <div class="dosen-name">Data dosen tidak tersedia</div>
                <div class="dosen-details">Informasi dosen tidak ditemukan</div>
            </div>
        </div>`;
    }
    
    // Tampilkan catatan penolakan jika ada
    let rejectionHtml = '';
    if (getVal('catatan_penolakan') && getVal('catatan_penolakan') !== '-') {
        rejectionHtml = `
        <div class="rejection-notes">
            <div class="detail-label">
                <i class="fa-solid fa-comment-dots"></i> Catatan Penolakan
            </div>
            <div class="detail-value">
                ${escapeHtml(getVal('catatan_penolakan'))}
            </div>
        </div>`;
    }
    
    // LOGIKA BARU: Tentukan tampilan berdasarkan jenis_date
    const jenisDate = getVal('jenis_date');
    const periodeValue = getVal('periode_value');
    const tanggalKegiatan = getVal('tanggal_kegiatan');
    const akhirKegiatan = getVal('akhir_kegiatan');
    
    // Tentukan tampilan untuk Periode dan Tanggal Mulai
    let periodeDisplay = '-';
    let tanggalMulaiDisplay = '-';
    let tanggalAkhirDisplay = '-';
    
    if (jenisDate === 'Periode') {
        // Jika Periode: tampilkan periode_value, kosongkan tanggal
        periodeDisplay = periodeValue !== '-' && periodeValue ? periodeValue : '-';
        tanggalMulaiDisplay = '-';
        tanggalAkhirDisplay = '-';
    } else if (jenisDate === 'Custom') {
        // Jika Custom: tampilkan tanggal, kosongkan periode
        periodeDisplay = '-';
        if (tanggalKegiatan !== '-' && tanggalKegiatan) {
            tanggalMulaiDisplay = formatDate(tanggalKegiatan);
        }
        if (akhirKegiatan !== '-' && akhirKegiatan) {
            tanggalAkhirDisplay = formatDate(akhirKegiatan);
        }
    } else {
        // Fallback jika jenis_date tidak ada (data lama)
        if (periodeValue && periodeValue !== '-') {
            periodeDisplay = periodeValue;
        } else if (tanggalKegiatan && tanggalKegiatan !== '-') {
            tanggalMulaiDisplay = formatDate(tanggalKegiatan);
            if (akhirKegiatan && akhirKegiatan !== '-') {
                tanggalAkhirDisplay = formatDate(akhirKegiatan);
            }
        }
    }

    const currentModalId = modalManager.activeModal?.id || '';
    
    return `
    <div class="detail-section">
        <div class="detail-section-title">
            <i class="fa-solid fa-info-circle"></i> Informasi Utama
        </div>
        <div class="detail-grid">
            <div class="detail-row">
                <div class="detail-label">Nama Kegiatan</div>
                <div class="detail-value">${escapeHtml(getVal('nama_kegiatan'))}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Status Pengajuan</div>
                <div class="detail-value">${statusBadge}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Jenis Pengajuan</div>
                <div class="detail-value">${escapeHtml(getVal('jenis_pengajuan'))}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Lingkup Penugasan</div>
                <div class="detail-value">${escapeHtml(getVal('lingkup_penugasan'))}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Jenis Penugasan</div>
                <div class="detail-value">${escapeHtml(getVal('jenis_penugasan'))}</div>
            </div>
        </div>
    </div>
    
    <div class="detail-section">
        <div class="detail-section-title">
            <i class="fa-solid fa-users"></i> Dosen Terkait
        </div>
        ${dosenHtml}
    </div>
    
    <div class="detail-section">
        <div class="detail-section-title">
            <i class="fa-solid fa-calendar-alt"></i> Informasi Waktu & Tempat
        </div>
        <div class="detail-grid">
            <div class="detail-row">
                <div class="detail-label">Penyelenggara</div>
                <div class="detail-value">${escapeHtml(getVal('penyelenggara'))}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Jenis Tanggal</div>
                <div class="detail-value">${escapeHtml(jenisDate !== '-' ? jenisDate : '-')}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Periode Kegiatan</div>
                <div class="detail-value ${periodeDisplay === '-' ? 'detail-value-empty' : ''}">${escapeHtml(periodeDisplay)}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal Mulai</div>
                <div class="detail-value ${tanggalMulaiDisplay === '-' ? 'detail-value-empty' : ''}">${tanggalMulaiDisplay}</div>
            </div>
            ${tanggalAkhirDisplay !== '-' ? `
            <div class="detail-row">
                <div class="detail-label">Tanggal Akhir</div>
                <div class="detail-value">${tanggalAkhirDisplay}</div>
            </div>
            ` : ''}
            <div class="detail-row">
                <div class="detail-label">Tempat Kegiatan</div>
                <div class="detail-value">${escapeHtml(getVal('tempat_kegiatan'))}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal Pengajuan</div>
                <div class="detail-value">${formatDate(getVal('created_at'))}</div>
            </div>
        </div>
    </div>
    
    ${rejectionHtml}
    
    <div class="modal-actions">
        <button class="modal-btn modal-btn-close" onclick="modalManager.closeModal('${currentModalId}')">
            <i class="fa-solid fa-times"></i> Tutup
        </button>
        ${in_array(getVal('status'), ['disetujui KK', 'ditolak KK']) ? `
        <button class="modal-btn" style="background: #ff9800;" onclick="event.stopPropagation(); showReturnModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
            <i class="fa-solid fa-undo"></i> Kembalikan
        </button>
        ` : ''}
        <button class="btn btn-eviden" style="background: #28a745 !important;" onclick="event.stopPropagation(); handleEvidenClick(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
            <i class="fas fa-file-image"></i> Lihat Eviden
        </button>
    </div>`;
}

// Helper functions
function formatDate(d) {
    if (!d || d === '-' || d === '0000-00-00') return '-';
    const t = new Date(d);
    if (isNaN(t)) return d;
    return t.toLocaleDateString('id-ID', { day:'2-digit', month: 'short', year:'numeric' });
}

function escapeHtml(unsafe) {
    if (unsafe === null || unsafe === undefined) return '-';
    return String(unsafe)
       .replace(/&/g, "&amp;")
       .replace(/</g, "&lt;")
       .replace(/>/g, "&gt;")
       .replace(/"/g, "&quot;")
       .replace(/'/g, "&#039;");
}

function in_array(value, array) {
    return array.includes(value);
}

// Close all modals with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modalManager.modals.length > 0) {
        modalManager.closeModal(modalManager.modals[modalManager.modals.length - 1].id);
    }
});
</script>
</body>
</html>