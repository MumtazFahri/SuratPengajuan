<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Total Pengajuan - Dashboard Sekretariat</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    /* ============================================
       STYLE DASAR (SAMA SEPERTI DASHBOARD)
    ============================================ */
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:#f5f7fa;}
    .navbar{background:#16A085;color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 4px rgba(0,0,0,0.1);}
    .navbar h2{font-size:20px;}
    .container{max-width:1200px;margin:30px auto;padding:0 20px;}
    .card{background:white;border-radius:10px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,0.06);margin-bottom:20px}
    .card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #eee}
    table{width:100%;border-collapse:collapse}
    thead{background:#f4f6f7}
    th,td{padding:12px;border-bottom:1px solid #ecf0f1;text-align:left;font-size:14px}
    tbody tr:hover{background:#fbfcfd}
    .badge{display:inline-block;padding:6px 10px;border-radius:999px;font-weight:600;font-size:12px}
    .badge-pending{background:#fff3cd;color:#856404}
    .badge-approved{background:#d4edda;color:#155724}
    .badge-rejected{background:#f8d7da;color:#721c24}
    .badge-completed{background:#d1ecf1;color:#0c5460}
    .btn{padding:6px 10px;border-radius:6px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s}
    .btn:hover{transform:scale(1.05)}
    .btn-approve{background:#27ae60;color:#fff}
    .btn-approve:hover{background:#229954}
    .btn-reject{background:#e74c3c;color:#fff}
    .btn-reject:hover{background:#c0392b}
    .btn-detail{background:#3498db;color:#fff}
    .btn-detail:hover{background:#2980b9}
    .filter-container{display:flex;gap:15px;margin-bottom:20px;flex-wrap:wrap}
    .filter-select{padding:10px 15px;border-radius:8px;border:2px solid #ddd;font-weight:600;cursor:pointer;min-width:200px}
    
    /* ============================================
       TOMBOL DASHBOARD (SAMA SEPERTI DASHBOARD)
    ============================================ */
    
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
    
    /* Tombol Edit - WARNA KUNING */
    .btn-warning {
        background: #ffc107 !important;
        color: #000 !important;
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
        text-decoration: none !important;
    }

    .btn-warning:hover {
        background: #e0a800 !important;
        transform: scale(1.05);
        color: #000 !important;
        text-decoration: none !important;
    }
    
    /* Tombol Masukkan Nomor Surat - WARNA BIRU */
    .btn-nomor {
        background: #3498db !important;
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

    .btn-nomor i {
        font-size: 14px;
    }

    .btn-nomor:hover {
        background: #2980b9 !important;
        transform: scale(1.05);
    }

    /* Tombol Cetak - WARNA UNGU */
    .btn-cetak {
        background: #9b59b6 !important;
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

    .btn-cetak i {
        font-size: 14px;
    }

    .btn-cetak:hover {
        background: #8e44ad !important;
        transform: scale(1.05);
    }

    /* Tombol Download PDF - WARNA HIJAU */
    .btn-download {
        background: #2ecc71 !important;
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
        text-decoration: none !important;
    }

    .btn-download:hover {
        background: #27ae60 !important;
        transform: scale(1.05);
        text-decoration: none !important;
    }
    
    /* Container tombol aksi untuk membuat semua tombol sejajar */
    .action-buttons {
        display: flex !important;
        flex-wrap: nowrap !important;
        gap: 6px !important;
        align-items: center !important;
        justify-content: flex-start !important;
        width: 100% !important;
        min-width: 160px !important;
    }
    
    /* Tombol Aksi dalam sel tabel */
    .action-buttons > * {
        flex-shrink: 0 !important;
    }
    
    /* ============================================
       DISPOSISI STYLES (SAMA SEPERTI DASHBOARD)
    ============================================ */
    .btn-disposisi {
        background:#f1c40f;
        color:#000;
        border:none;
        padding:6px 12px;
        border-radius:5px;
        cursor:pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .disposisi-card {
        background: #ffffff;
        padding: 18px 20px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.12);
        margin-top: 10px;
        border: 1px solid #eee;
        display: none;
    }
    
    .label-disposisi {
        font-weight: 600;
        color: #333;
        font-size: 14px;
        margin-bottom: 6px;
        display: block;
    }
    
    .select-disposisi {
        width: 100%;
        padding: 10px 12px;
        border-radius: 10px;
        border: 2px solid #ddd;
        background: #fafafa;
        font-size: 15px;
        outline: none;
        transition: .2s;
    }
    
    .textarea-disposisi {
        width: 100%;
        padding: 12px;
        height: 100px;
        border-radius: 10px;
        border: 2px solid #ddd;
        background: #fafafa;
        resize: vertical;
        font-size: 14px;
        transition: .2s;
        margin-top: 5px;
        display: none;
    }
    
    /* Disposisi Info Box dengan timestamp */
    .disposisi-info-box {
        margin-top: 8px;
        padding: 8px;
        background: #f8f9fa;
        border-radius: 6px;
        border-left: 3px solid #16A085;
    }

    .disposisi-status-text {
        display: block;
        margin-bottom: 4px;
    }

    .disposisi-status-text strong {
        color: #16A085;
    }

    .disposisi-status-text span {
        color: #2c3e50;
        font-weight: 600;
    }

    .disposisi-timestamp {
        display: block;
        color: #7f8c8d;
        font-size: 11px;
        margin-bottom: 4px;
    }

    .disposisi-catatan-text {
        display: block;
        color: #7f8c8d;
        font-size: 11px;
        font-style: italic;
        margin-top: 4px;
        padding: 4px 6px;
        background: white;
        border-radius: 4px;
    }

    .approval-status-box {
        margin-top: 8px;
        padding: 6px 8px;
        border-radius: 4px;
    }

    .approval-status-box.approved {
        background: #d4edda;
        color: #155724;
    }

    .approval-status-box.rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .approval-timestamp-small {
        display: block;
        color: #6c757d;
        font-size: 10px;
        margin-top: 2px;
    }
    
    /* ============================================
       SEARCH & FILTER (SAMA SEPERTI DASHBOARD)
    ============================================ */
    .search-filter-container{display:flex;align-items:center;gap:15px;margin-bottom:20px;flex-wrap:wrap;background:#f8f9fa;padding:15px;border-radius:10px;border:1px solid #e9ecef}
    .search-box{position:relative;flex:1;min-width:300px}
    .search-input{width:100%;padding:12px 45px 12px 15px;border:1px solid #ddd;border-radius:8px;font-size:14px;transition:all 0.3s;background:white}
    .search-input:focus{outline:none;border-color:#16A085;box-shadow:0 0 0 2px rgba(22,160,133,0.1)}
    .search-icon{position:absolute;right:15px;top:50%;transform:translateY(-50%);color:#6c757d}
    .btn-primary{padding:10px 20px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;background:#16A085;color:#fff}
    .btn-primary:hover{background:#138D75;transform:translateY(-2px)}
    .btn-secondary{padding:10px 20px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;background:#95a5a6;color:#fff}
    .btn-secondary:hover{background:#7f8c8d}
    .back-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#16A085;color:white;text-decoration:none;border-radius:8px;font-weight:600;transition:all 0.3s;margin-bottom:20px}
    .back-btn:hover{background:#138D75;transform:translateY(-2px)}
    
    /* ============================================
       MULTI MODAL STYLES (SAMA DENGAN KAPRODI)
    ============================================ */
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
    body.modal-open #tableBody {
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
    .modal-header{background:#16A085;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
    .modal-header h3{margin:0;font-size:20px;font-weight:600}
    .close-modal{background:none;border:0;color:white;font-size:28px;cursor:pointer;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .close-modal:hover{background:rgba(255,255,255,0.2)}
    
    /* Detail Content Styles */
    .detail-content{padding:30px;max-height:calc(90vh - 80px);overflow-y:auto}
    .detail-section{margin-bottom:30px;background:#f8f9fa;border-radius:12px;padding:25px;border:1px solid #e9ecef}
    .detail-section:last-child{margin-bottom:0}
    .detail-section-title{font-size:18px;font-weight:700;color:#16A085;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #16A085;display:flex;align-items:center;gap:12px}
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
        background: #16A085;
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
    .file-item:hover{background:#e8f6f3;border-color:#16A085}
    .file-icon{width:32px;height:32px;display:flex;align-items:center;justify-content:center;color:#16A085;font-size:20px;flex-shrink:0}
    .file-info{flex:1;min-width:0}
    .file-name{font-weight:600;color:#212529;font-size:15px;cursor:pointer;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .file-name:hover{color:#16A085}
    .file-size{font-size:13px;color:#6c757d;margin-top:4px}
    .preview-btn{background:#3498db;color:white;border:none;padding:10px 18px;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:8px;text-decoration:none;flex-shrink:0}
    .preview-btn:hover{background:#2980b9;color:white;text-decoration:none}
    .preview-btn.disabled{background:#bdc3c7;cursor:not-allowed;opacity:0.6}
    .preview-btn.disabled:hover{background:#bdc3c7}
    .download-btn{background:#16A085;color:white;border:none;padding:10px 18px;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:8px;text-decoration:none;flex-shrink:0;margin-left:10px}
    .download-btn:hover{background:#138D75;color:white;text-decoration:none}

    /* Preview Modal Styles */
    .preview-modal{display:none !important;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:1050;justify-content:center;align-items:center;padding:20px}
    .preview-modal.show{display:flex !important}
    .preview-content{background:white;border-radius:12px;width:90%;max-width:900px;max-height:90vh;overflow:hidden;display:flex;flex-direction:column}
    .preview-header{background:#16A085;color:white;padding:15px 20px;display:flex;justify-content:space-between;align-items:center}
    .preview-header h3{margin:0;font-size:16px;font-weight:600}
    .preview-close{background:none;border:none;color:white;font-size:24px;cursor:pointer;padding:0;width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .preview-close:hover{background:rgba(255,255,255,0.2)}
    .preview-body{flex:1;padding:0;display:flex;justify-content:center;align-items:center;background:#f8f9fa;min-height:400px}
    .preview-iframe{width:100%;height:70vh;border:none}
    .preview-image{max-width:100%;max-height:70vh;object-fit:contain}
    .preview-unsupported{text-align:center;padding:40px;color:#6c757d}
    .preview-unsupported i{font-size:48px;margin-bottom:15px;color:#16A085}
    .preview-unsupported h4{font-size:18px;margin-bottom:10px;color:#495057}
    .preview-unsupported p{font-size:14px;margin-bottom:20px}
    
    /* Action Buttons in Modal */
    .modal-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:25px;padding-top:25px;border-top:1px solid #e9ecef}
    .modal-btn{padding:12px 24px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:15px;transition:all 0.2s;display:flex;align-items:center;gap:10px}
    .modal-btn-close{background:#6c757d;color:white}
    .modal-btn-close:hover{background:#5a6268;transform:translateY(-2px)}
    .modal-btn-approve{background:#27ae60;color:white}
    .modal-btn-approve:hover{background:#229954;transform:translateY(-2px)}
    .modal-btn-reject{background:#e74c3c;color:white}
    .modal-btn-reject:hover{background:#c0392b;transform:translateY(-2px)}
    
    /* Rejection Notes Styles */
    .rejection-notes{background:#fff5f5;border:1px solid #f8d7da;border-radius:8px;padding:25px;margin-top:20px}
    .rejection-notes .detail-label{color:#dc3545;font-weight:700;font-size:16px}
    .rejection-notes .detail-value{background:#fff5f5;border-color:#f8d7da;color:#721c24;font-size:15px;line-height:1.6;min-height:auto;padding:15px;border-radius:6px}
    
    /* Detail Modal Lebar Besar */
    .detail-modal .modal-content {
        max-width: 1100px !important;
        width: 95% !important;
        max-height: 90vh !important;
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
    
    /* ============================================
       SURAT MODAL STYLES - DIUBAH: LEBAR MAKSIMAL LEBIH BESAR
    ============================================ */
    .surat-modal .modal-content {
        max-width: 1400px !important; /* DIPERBESAR DARI 1100px */
        width: 98% !important; /* DIPERBESAR DARI 95% */
        max-height: 95vh !important; /* DIPERBESAR DARI 90vh */
        min-width: 1000px; /* MINIMAL WIDTH AGAR TIDAK TERLALU KECIL */
    }
    
    /* Container khusus untuk preview surat agar lebih lebar */
    .surat-preview-container {
        width: 100%;
        height: calc(95vh - 150px); /* DIPERBESAR TINGGINYA */
        display: flex;
        flex-direction: column;
        background: #f8f9fa;
        border-radius: 10px;
        overflow: hidden;
    }
    
    /* Header untuk surat preview */
    .surat-preview-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }
    
    /* Toolbar untuk tombol download/print */
    .surat-toolbar {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    /* Iframe untuk surat - DIPERBESAR */
    .surat-iframe {
        width: 100%;
        height: 100%;
        border: none;
        flex: 1;
        background: white;
    }
    
    /* Style khusus untuk tombol dalam surat modal */
    .surat-btn {
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none !important;
    }
    
    .surat-btn-download {
        background: #16A085;
        color: white;
    }
    
    .surat-btn-download:hover {
        background: #138D75;
        transform: translateY(-2px);
    }
    
    .surat-btn-print {
        background: #2c3e50;
        color: white;
    }
    
    .surat-btn-print:hover {
        background: #1a252f;
        transform: translateY(-2px);
    }
    
    .surat-btn-fullscreen {
        background: #3498db;
        color: white;
    }
    
    .surat-btn-fullscreen:hover {
        background: #2980b9;
        transform: translateY(-2px);
    }
    
    /* Fullscreen mode untuk surat */
    .surat-iframe.fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        background: white;
    }
    
    /* Eviden Modal Styles */
    .eviden-modal .modal-content {
        max-width: 800px;
        width: 95%;
        max-height: 85vh;
    }
    
    /* Approve Modal Styles */
    .approve-modal .modal-content {
        max-width: 500px;
        width: 95%;
    }
    
    /* Reject Modal Styles */
    .reject-modal .modal-content {
        max-width: 600px;
        width: 95%;
    }
    
    /* Return Modal Styles */
    .return-modal .modal-content {
        max-width: 600px;
        width: 95%;
        max-height: 85vh;
    }
    
    /* ============================================
       NOMOR SURAT MODAL STYLES - DIUBAH MENJADI LEBIH BAGUS
    ============================================ */
    .nomor-surat-modal .modal-content {
        max-width: 650px !important;
        width: 95% !important;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border: none;
    }
    
    .nomor-surat-modal .modal-header {
        background: linear-gradient(135deg, #16A085 0%, #138D75 100%);
        padding: 25px 30px;
        border-radius: 15px 15px 0 0;
        position: relative;
        overflow: hidden;
    }
    
    .nomor-surat-modal .modal-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.3;
        animation: float 20s linear infinite;
    }
    
    @keyframes float {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .nomor-surat-modal .modal-header h3 {
        font-size: 22px;
        font-weight: 700;
        position: relative;
        z-index: 1;
    }
    
    .nomor-surat-modal .modal-header h3 i {
        margin-right: 12px;
        font-size: 24px;
    }
    
    .nomor-surat-content {
        padding: 35px 40px;
        background: #f8fafc;
        position: relative;
    }
    
    /* Info Box yang lebih menarik */
    .nomor-surat-info-box {
        background: linear-gradient(to right, #e8f6f3 0%, #f0f9f7 100%);
        border: 2px solid #a2d9ce;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 8px 20px rgba(22, 160, 133, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .nomor-surat-info-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: #16A085;
    }
    
    .nomor-surat-info-box h4 {
        color: #16A085;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .nomor-surat-info-box h4 i {
        font-size: 22px;
    }
    
    .nomor-surat-info-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }
    
    .info-detail-item {
        background: white;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #16A085;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    
    .info-detail-label {
        font-size: 13px;
        color: #7f8c8d;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-detail-value {
        font-size: 16px;
        color: #2c3e50;
        font-weight: 600;
    }
    
    .info-detail-value .badge {
        font-size: 12px;
        padding: 5px 12px;
    }
    
    /* Form styling yang lebih baik */
    .nomor-surat-form-container {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }
    
    .form-header {
        margin-bottom: 25px;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }
    
    .form-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 25%;
        width: 50%;
        height: 3px;
        background: linear-gradient(to right, transparent, #16A085, transparent);
        border-radius: 3px;
    }
    
    .form-header h4 {
        color: #2c3e50;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .form-header p {
        color: #7f8c8d;
        font-size: 14px;
        margin: 0;
    }
    
    /* Input field yang lebih menarik */
    .input-group-nomor-surat {
        margin-bottom: 25px;
    }
    
    .input-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: #2c3e50;
        font-size: 15px;
        margin-bottom: 12px;
    }
    
    .input-label i {
        color: #16A085;
        font-size: 18px;
    }
    
    .required-star {
        color: #e74c3c;
        margin-left: 4px;
    }
    
    .nomor-surat-input-container {
        position: relative;
    }
    
    .nomor-surat-input {
        width: 100%;
        padding: 16px 20px;
        font-size: 17px;
        font-weight: 600;
        color: #2c3e50;
        background: #f8fafc;
        border: 2px solid #d5dbdb;
        border-radius: 10px;
        transition: all 0.3s ease;
        outline: none;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
    }
    
    .nomor-surat-input:focus {
        border-color: #16A085;
        background: white;
        box-shadow: 0 0 0 4px rgba(22, 160, 133, 0.15);
        transform: translateY(-2px);
    }
    
    .nomor-surat-input::placeholder {
        color: #aab7b8;
        font-weight: normal;
        letter-spacing: normal;
    }
    
    .input-hint {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7f8c8d;
        font-size: 13px;
        margin-top: 8px;
        padding: 10px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 3px solid #3498db;
    }
    
    .input-hint i {
        color: #3498db;
    }
    
    .format-example {
        display: inline-block;
        background: #2c3e50;
        color: white;
        padding: 4px 10px;
        border-radius: 5px;
        font-family: 'Courier New', monospace;
        font-size: 12px;
        margin-left: 5px;
    }
    
    /* Error message styling */
    .nomor-surat-error {
        background: #fdf2f2;
        color: #e74c3c;
        padding: 12px 15px;
        border-radius: 8px;
        margin-top: 10px;
        font-size: 13px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border-left: 4px solid #e74c3c;
        animation: shake 0.5s ease;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    .nomor-surat-error i {
        font-size: 16px;
        margin-top: 2px;
    }
    
    /* Tombol yang lebih menarik */
    .nomor-surat-actions {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #e9ecef;
    }
    
    .btn-nomor-cancel {
        background: #95a5a6;
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 140px;
        justify-content: center;
    }
    
    .btn-nomor-cancel:hover {
        background: #7f8c8d;
        transform: translateY(-3px);
        box-shadow: 0 7px 15px rgba(149, 165, 166, 0.3);
    }
    
    .btn-nomor-submit {
        background: linear-gradient(135deg, #16A085 0%, #138D75 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 180px;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .btn-nomor-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }
    
    .btn-nomor-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(22, 160, 133, 0.4);
    }
    
    .btn-nomor-submit:hover::before {
        left: 100%;
    }
    
    .btn-nomor-submit:disabled {
        background: #bdc3c7;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }
    
    .btn-nomor-submit:disabled:hover::before {
        left: -100%;
    }
    
    /* Loading spinner */
    .btn-nomor-submit .spinner {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1400px) {
        .surat-modal .modal-content {
            max-width: 95% !important;
            min-width: auto !important;
        }
    }
    
    @media (max-width: 992px){
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
        
        /* Surat modal responsive */
        .surat-preview-container {
            height: calc(85vh - 150px);
        }
        
        .surat-toolbar {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .surat-btn {
            padding: 8px 15px;
            font-size: 13px;
        }
        
        /* Nomor surat modal responsive */
        .nomor-surat-modal .modal-content {
            max-width: 95% !important;
            margin: 10px;
        }
        
        .nomor-surat-content {
            padding: 25px;
        }
        
        .nomor-surat-info-details {
            grid-template-columns: 1fr;
        }
        
        .nomor-surat-form-container {
            padding: 20px;
        }
        
        .nomor-surat-actions {
            flex-direction: column;
        }
        
        .btn-nomor-cancel, .btn-nomor-submit {
            width: 100%;
            min-width: auto;
        }
    }
    
    @media (max-width: 768px){
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
        
        /* Surat modal di mobile */
        .surat-modal .modal-content {
            max-width: 100% !important;
            width: 100% !important;
            height: 100vh !important;
            max-height: 100vh !important;
            border-radius: 0;
            margin: 0;
        }
        
        .surat-preview-container {
            height: calc(100vh - 140px);
            border-radius: 0;
        }
        
        .surat-preview-header {
            flex-direction: column;
            gap: 10px;
            padding: 10px 15px;
        }
        
        .surat-toolbar {
            width: 100%;
            justify-content: space-between;
        }
        
        .surat-btn {
            flex: 1;
            justify-content: center;
            padding: 10px 5px;
            font-size: 12px;
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
        
        /* Nomor surat modal di mobile */
        .nomor-surat-modal .modal-content {
            max-width: 100% !important;
            width: 100% !important;
            border-radius: 0;
            margin: 0;
            min-height: 100vh;
        }
        
        .nomor-surat-modal .modal-header {
            padding: 20px;
        }
        
        .nomor-surat-content {
            padding: 20px 15px;
        }
        
        .nomor-surat-info-box {
            padding: 20px 15px;
        }
        
        .nomor-surat-input {
            font-size: 16px;
            padding: 14px;
        }
        
        .nomor-surat-actions {
            padding-top: 20px;
        }
    }
    /* ============================================
   SURAT MODAL STYLES - PERBAIKAN UNTUK SCROLLBAR
============================================ */
.surat-modal .modal-content {
    max-width: 1400px !important;
    width: 98% !important;
    max-height: 95vh !important;
    min-width: 1000px;
    display: flex;
    flex-direction: column;
}

/* Container khusus untuk preview surat dengan scrollbar */
.surat-preview-container {
    width: 100%;
    height: calc(95vh - 150px);
    display: flex;
    flex-direction: column;
    background: #f8f9fa;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

/* Header untuk surat preview */
.surat-preview-header {
    background: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
    z-index: 10;
}

/* Toolbar untuk tombol download/print */
.surat-toolbar {
    display: flex;
    gap: 10px;
    align-items: center;
}

/* Container untuk iframe dengan scrollbar */
.surat-iframe-container {
    flex: 1;
    overflow: auto;
    background: white;
    position: relative;
}

/* Iframe untuk surat - DIPERBAIKI untuk scroll */
.surat-iframe {
    width: 100%;
    min-height: 100%;
    border: none;
    display: block;
    background: white;
}

/* Style scrollbar untuk container iframe */
.surat-iframe-container::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

.surat-iframe-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 5px;
}

.surat-iframe-container::-webkit-scrollbar-thumb {
    background: #FB8C00;
    border-radius: 5px;
}

.surat-iframe-container::-webkit-scrollbar-thumb:hover {
    background: #E67E22;
}

/* Fullscreen mode untuk surat */
.surat-iframe.fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    background: white;
}

/* Style untuk detail content dalam modal surat */
.surat-modal .detail-content {
    padding: 0 !important;
    overflow: hidden;
    flex: 1;
    display: flex;
    flex-direction: column;
}
/* ============================================
   SURAT MODAL STYLES - PERBAIKAN JARAK KE TEPI
============================================ */
.surat-modal .modal-content {
    max-width: 1400px !important;
    width: 98% !important;
    max-height: 95vh !important;
    min-width: 1000px;
    display: flex;
    flex-direction: column;
}

/* Container untuk konten surat dengan padding */
.surat-content-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 20px; /* Tambahkan padding di sini */
}

/* Container khusus untuk preview surat dengan scrollbar */
.surat-preview-container {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    border: 1px solid #e9ecef;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* Header untuk surat preview */
.surat-preview-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 18px 25px;
    border-bottom: 2px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-shrink: 0;
    z-index: 10;
}

/* Toolbar untuk tombol download/print */
.surat-toolbar {
    display: flex;
    gap: 12px;
    align-items: center;
}

/* Container untuk iframe dengan scrollbar dan padding */
.surat-iframe-container {
    flex: 1;
    overflow: auto;
    background: white;
    position: relative;
    padding: 30px; /* TAMBAHKAN PADDING DI SINI */
}

/* Iframe untuk surat - DIPERBAIKI untuk scroll dengan margin */
.surat-iframe {
    width: 100%;
    min-height: 100%;
    border: none;
    display: block;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-radius: 8px; /* Tambahkan border radius */
}

/* Styling untuk konten dalam iframe */
.surat-iframe body {
    margin: 0;
    padding: 40px !important; /* Beri padding pada konten surat */
    font-family: 'Times New Roman', Times, serif;
    background: white;
}

/* Style scrollbar untuk container iframe */
.surat-iframe-container::-webkit-scrollbar {
    width: 12px;
    height: 12px;
}

.surat-iframe-container::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 6px;
}

.surat-iframe-container::-webkit-scrollbar-thumb {
    background: #FB8C00;
    border-radius: 6px;
    border: 3px solid #f8f9fa;
}

.surat-iframe-container::-webkit-scrollbar-thumb:hover {
    background: #E67E22;
}

/* Fullscreen mode untuk surat */
.surat-iframe.fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    background: white;
    padding: 40px; /* Padding saat fullscreen */
}

/* Style untuk detail content dalam modal surat */
.surat-modal .detail-content {
    padding: 0 !important;
    overflow: hidden;
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* Tombol surat dengan spacing yang lebih baik */
.surat-btn {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    text-decoration: none !important;
    min-width: 110px;
    justify-content: center;
}

.surat-btn-download {
    background: linear-gradient(135deg, #FB8C00 0%, #F57C00 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(251, 140, 0, 0.3);
}

.surat-btn-download:hover {
    background: linear-gradient(135deg, #E67E22 0%, #EF6C00 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(251, 140, 0, 0.4);
}

.surat-btn-print {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(44, 62, 80, 0.3);
}

.surat-btn-print:hover {
    background: linear-gradient(135deg, #1a252f 0%, #2c3e50 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(44, 62, 80, 0.4);
}

.surat-btn-fullscreen {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    box-shadow: 0 2px 5px rgba(52, 152, 219, 0.3);
}

.surat-btn-fullscreen:hover {
    background: linear-gradient(135deg, #2980b9 0%, #1c6ea4 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.4);
}
</style>
</head>
<body>

<div class="navbar">
    <h2><i class="fa-solid fa-clipboard-list"></i> Dashboard Sekretariat</h2>
    <div></div>
</div>

<div class="container">
    <!-- Tombol Kembali -->
    <a href="<?= base_url('sekretariat') ?>" class="back-btn">
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

    <!-- Tabel Total Pengajuan -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-table"></i> Total Pengajuan Surat - Sekretariat</h3>
            <div>
                <span id="filterInfo" style="color:#7f8c8d;font-size:13px">
                    Menampilkan: 
                    <?php 
                    $filter_info = "Semua Data";
                    if($this->input->get('status') == 'pending') $filter_info = "Menunggu";
                    if($this->input->get('status') == 'approved') $filter_info = "Disetujui";
                    if($this->input->get('status') == 'rejected') $filter_info = "Ditolak";
                    if($this->input->get('status') == 'dekan_approved') $filter_info = "Disetujui Dekan";
                    if($this->input->get('status') == 'dekan_rejected') $filter_info = "Ditolak Dekan";
                    
                    // Filter Jenis Penugasan
                    $jenis_penugasan_info = "";
                    if($this->input->get('jenis_penugasan') == 'perorangan') {
                        $jenis_penugasan_info = " [Perorangan]";
                    } elseif($this->input->get('jenis_penugasan') == 'kelompok') {
                        $jenis_penugasan_info = " [Kelompok]";
                    } elseif($this->input->get('jenis_penugasan') == 'lainnya') {
                        $jenis_penugasan_info = " [Lainnya]";
                    }
                    
                    echo $filter_info . $jenis_penugasan_info . " (" . (isset($total_surat) ? $total_surat : '0') . " data)";
                    ?>
                </span>
            </div>
        </div>
        
        <!-- Search + Filter -->
        <form method="get" action="<?= base_url('sekretariat/semua') ?>">
            <input type="hidden" name="from" value="semua">
            
            <div class="search-filter-container">
                <div class="search-box">
                    <input 
                        type="text" 
                        name="search" 
                        class="search-input"
                        placeholder="Cari nama kegiatan atau penyelenggara..."
                        value="<?= $this->input->get('search') ?>"
                    >
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                
                <!-- Filter Status -->
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" <?= ($this->input->get('status')=='pending') ? 'selected' : '' ?>>Menunggu</option>
                    <option value="approved" <?= ($this->input->get('status')=='approved') ? 'selected' : '' ?>>Disetujui</option>
                    <option value="rejected" <?= ($this->input->get('status')=='rejected') ? 'selected' : '' ?>>Ditolak</option>
                    <option value="dekan_approved" <?= ($this->input->get('status')=='dekan_approved') ? 'selected' : '' ?>>Disetujui Dekan</option>
                    <option value="dekan_rejected" <?= ($this->input->get('status')=='dekan_rejected') ? 'selected' : '' ?>>Ditolak Dekan</option>
                </select>
                
                <!-- FILTER BARU: Jenis Penugasan -->
                <select name="jenis_penugasan" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Jenis Penugasan</option>
                    <option value="perorangan" <?= ($this->input->get('jenis_penugasan') == 'perorangan') ? 'selected' : '' ?>>Perorangan</option>
                    <option value="kelompok" <?= ($this->input->get('jenis_penugasan') == 'kelompok') ? 'selected' : '' ?>>Kelompok</option>
                    <option value="lainnya" <?= ($this->input->get('jenis_penugasan') == 'lainnya') ? 'selected' : '' ?>>Lainnya</option>
                </select>
                
                <button type="submit" class="btn-primary" style="white-space:nowrap">
                    <i class="fa-solid fa-filter"></i> Terapkan
                </button>
                
                <a href="<?= base_url('sekretariat/semua') ?>" class="btn-secondary" style="white-space:nowrap">
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
                        <th>Nomor Surat</th>
                        <th>Penyelenggara</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Jenis</th>
                        <th>Disposisi</th>
                        <th style="min-width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php 
                    if(isset($surat_list) && is_array($surat_list) && !empty($surat_list)): 
                        $no = 1; 
                        foreach($surat_list as $s): 
                            // LOGIKA STATUS YANG DIPERBAIKI (SAMA SEPERTI DASHBOARD)
                            $status = $s->status ?? '';
                            $st_key = 'unknown';
                            $badge_text = ucwords($status);
                            
                            if ($status == 'disetujui KK') {
                                $st_key = 'pending';
                                $badge = '<span class="badge badge-pending">Menunggu Sekretariat</span>';
                            } elseif ($status == 'disetujui sekretariat') {
                                $st_key = 'approved';
                                $badge = '<span class="badge badge-approved">Disetujui Sekretariat</span>';
                            } elseif ($status == 'ditolak sekretariat') {
                                $st_key = 'rejected';
                                $badge = '<span class="badge badge-rejected">Ditolak Sekretariat</span>';
                            } elseif ($status == 'disetujui dekan') {
                                $st_key = 'completed';
                                $badge = '<span class="badge badge-completed">Disetujui Dekan</span>';
                            } elseif ($status == 'ditolak dekan') {
                                $st_key = 'rejected';
                                $badge = '<span class="badge badge-rejected">Ditolak Dekan</span>';
                            } elseif (strpos($status, 'pengajuan') !== false || strpos($status, 'pending') !== false || strpos($status, 'menunggu') !== false) {
                                $st_key = 'pending';
                                $badge = '<span class="badge badge-pending">' . $badge_text . '</span>';
                            } elseif (strpos($status, 'setuju') !== false || strpos($status, 'approved') !== false) {
                                $st_key = 'approved';
                                $badge = '<span class="badge badge-approved">' . $badge_text . '</span>';
                            } elseif (strpos($status, 'tolak') !== false || strpos($status, 'rejected') !== false) {
                                $st_key = 'rejected';
                                $badge = '<span class="badge badge-rejected">' . $badge_text . '</span>';
                            } else {
                                $st_key = 'other';
                                $badge = '<span class="badge badge-pending">' . $badge_text . '</span>';
                            }

                            $tgl_pengajuan = isset($s->created_at) && $s->created_at ? date('d M Y', strtotime($s->created_at)) : '-';
                            // REVISI: Kolom Tanggal Kegiatan - Tampilkan Periode atau Tanggal (SAMA SEPERTI DASHBOARD)
                            $jenis_date = isset($s->jenis_date) ? $s->jenis_date : '';
                            $tanggal_kegiatan_display = '-';
                            
                            if ($jenis_date === 'Periode') {
                                $periode_value = isset($s->periode_value) && !empty($s->periode_value) ? $s->periode_value : '-';
                                $tanggal_kegiatan_display = '<span class="badge" style="background: #e3f2fd; color: #1976d2; padding: 6px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">';
                                $tanggal_kegiatan_display .= '<i class="fas fa-calendar-alt"></i> ' . htmlspecialchars($periode_value);
                                $tanggal_kegiatan_display .= '</span>';
                            } else {
                                $tanggal_kegiatan = '';
                                if (isset($s->tanggal_kegiatan) && !empty($s->tanggal_kegiatan)) {
                                    $tanggal_kegiatan = $s->tanggal_kegiatan;
                                } elseif (isset($s->tanggal_awal_kegiatan) && !empty($s->tanggal_awal_kegiatan)) {
                                    $tanggal_kegiatan = $s->tanggal_awal_kegiatan;
                                } elseif (isset($s->tanggal_mulai) && !empty($s->tanggal_mulai)) {
                                    $tanggal_kegiatan = $s->tanggal_mulai;
                                } elseif (isset($s->created_at) && !empty($s->created_at)) {
                                    $tanggal_kegiatan = $s->created_at;
                                }
                                
                                if (!empty($tanggal_kegiatan) && $tanggal_kegiatan !== '-') {
                                    try {
                                        $tanggal_obj = new DateTime($tanggal_kegiatan);
                                        $hari = $tanggal_obj->format('j');
                                        $bulan = $tanggal_obj->format('n');
                                        
                                        $bulan_indonesia = [
                                            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                                            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
                                            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
                                        ];
                                        
                                        $bulan_nama = $bulan_indonesia[$bulan] ?? 'Desember';
                                        $tahun = $tanggal_obj->format('Y');
                                        
                                        $tanggal_kegiatan_display = htmlspecialchars($hari . ' ' . $bulan_nama . ' ' . $tahun);
                                    } catch (Exception $e) {
                                        $tanggal_kegiatan_display = htmlspecialchars($tanggal_kegiatan);
                                    }
                                } else {
                                    $tanggal_kegiatan_display = '-';
                                }
                            }
                    ?>
                    <!-- BARIS TABEL BISA DIKLIK UNTUK DETAIL -->
                    <tr onclick="showRowDetail(<?= $s->id ?? 0 ?>)" style="cursor: pointer;" class="clickable-row">
                        <td data-label="No"><?= $no++ ?></td>
                        <td data-label="Nama Kegiatan"><strong><?= htmlspecialchars($s->nama_kegiatan ?? '-') ?></strong></td>
                        <td data-label="Nomor Surat"><?= htmlspecialchars($s->nomor_surat ?? '-') ?></td>
                        <td data-label="Penyelenggara"><?= htmlspecialchars($s->penyelenggara ?? '-') ?></td>
                        <td data-label="Tanggal Pengajuan"><?= $tgl_pengajuan ?></td>
                        <td data-label="Tanggal Kegiatan"><?= $tanggal_kegiatan_display ?></td>
                        <td data-label="Jenis"><?= htmlspecialchars($s->jenis_pengajuan ?? '-') ?></td>
                        <td data-label="Disposisi" onclick="event.stopPropagation()">
                            <!-- Tombol Tentukan Disposisi -->
                            <button 
                                class="btn-disposisi" 
                                onclick="openPinModal(<?= $s->id ?>, event)"
                                style="background:#f1c40f;color:#000;border:none;padding:6px 12px;border-radius:5px;cursor:pointer"
                            >
                                <i class="fas fa-shuffle"></i> Tentukan
                            </button>

                            <!-- Dropdown Disposisi (disembunyikan sampai PIN benar) -->
                            <div id="disposisiBox<?= $s->id ?>" class="disposisi-card" style="display:none;">
                                <label class="label-disposisi">Pilih Disposisi</label>
                                <select id="disposisiSelect<?= $s->id ?>"
                                        class="select-disposisi"
                                        onchange="onDisposisiChange(<?= $s->id ?>)">
                                    <option value="">-- Pilih Disposisi --</option>
                                    <option value="Lanjut Proses ✔">Lanjut Proses</option>
                                    <option value="Hold/Pending">Hold/Pending</option>
                                    <option value="Batal">Batal</option>
                                </select>

                                <label id="labelCatatan<?= $s->id ?>" 
                                    class="label-disposisi" 
                                    style="display:none;margin-top:10px;">
                                    Catatan
                                </label>

                                <textarea id="catatanDisposisi<?= $s->id ?>"
                                        class="textarea-disposisi"
                                        placeholder="Catatan diperlukan..."
                                        style="display:none;">
                                </textarea>

                                <button class="btn-disposisi" 
                                        onclick="saveDisposisi(<?= $s->id ?>)" 
                                        id="btnSaveDisposisi<?= $s->id ?>"
                                        style="display:none; width: 100%; margin-top: 10px;">
                                    Simpan
                                </button>
                            </div>
                            <br>

                             <!-- Info Disposisi -->
                            <?php if (!empty($s->disposisi_status)): ?>
                                <div class="disposisi-info-box">
                                    <?php if (in_array($s->disposisi_status, ['Modify By Sekretariat', 'Modify By User'])): ?>
                                        <small class="disposisi-status-text">
                                            <strong style="color:#16A085;">Status :</strong> 
                                            <span style="color:#2c3e50;font-weight:600;">none</span>
                                        </small>
                                    <?php else: ?>
                                        <small class="disposisi-status-text">
                                            <strong style="color:#16A085;">Status :</strong> 
                                            <span style="color:#2c3e50;font-weight:600;"><?= htmlspecialchars($s->disposisi_status) ?></span>
                                        </small>
                                    <?php endif; ?>
                                    
                                    <?php if (in_array($s->disposisi_status, ['Modify By Sekretariat', 'Modify By User'])): ?>
                                        <small style="display:block;color:#ff9800;font-size:11px;margin-bottom:4px;">
                                            <i class="fas fa-pen"></i> 
                                            <strong><?= htmlspecialchars($s->disposisi_status) ?></strong><br>
                                            <?= date('d M Y H:i', strtotime($s->updated_at)) ?>
                                        </small>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($s->disposisi_updated_at)): ?>
                                        <small class="disposisi-timestamp">
                                            <i class="far fa-clock"></i> 
                                            <?= date('d M Y H:i', strtotime($s->disposisi_updated_at)) ?>
                                        </small>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($s->disposisi_catatan) && !in_array($s->disposisi_status, ['Modify By Sekretariat', 'Modify By User'])): ?>
                                        <small class="disposisi-catatan-text">
                                            <i class="far fa-comment"></i> 
                                            <?= htmlspecialchars($s->disposisi_catatan) ?>
                                        </small>
                                    <?php endif; ?>
                                    
                                    <?php if (($s->disposisi_status === 'Lanjut Proses ✔' || $s->disposisi_status === 'Batal') && !empty($s->status)): ?>
                                        <?php if (in_array($s->status, ['disetujui sekretariat', 'ditolak sekretariat', 'disetujui dekan', 'ditolak dekan'])): ?>
                                            <div class="approval-status-box <?= in_array($s->status, ['disetujui sekretariat', 'disetujui dekan']) ? 'approved' : 'rejected' ?>">
                                                <small style="display:block;font-weight:700;color:<?= in_array($s->status, ['disetujui sekretariat', 'disetujui dekan']) ? '#155724' : '#721c24' ?>;">
                                                    <i class="fas fa-<?= in_array($s->status, ['disetujui sekretariat', 'disetujui dekan']) ? 'check-circle' : 'times-circle' ?>"></i>
                                                    <?= $s->status === 'disetujui sekretariat' ? 'Telah Disubmit' : 
                                                    ($s->status === 'ditolak sekretariat' ? 'Ditolak Sekretariat' : 
                                                    ($s->status === 'disetujui dekan' ? 'Disetujui Dekan' : 
                                                    ($s->status === 'ditolak dekan' ? 'Ditolak Dekan' : $s->status))) ?>
                                                </small>
                                                <?php if (!empty($s->updated_at)): ?>
                                                    <small class="approval-timestamp-small">
                                                        <?= date('d M Y H:i', strtotime($s->updated_at)) ?>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <!-- TOMBOL AKSI DALAM CONTAINER FLEX -->
                        <td data-label="Aksi">
                            <div class="action-buttons">
                                <!-- Tombol Eviden (Hijau) -->
                                <button class="btn btn-eviden" onclick="event.stopPropagation(); handleEvidenClick(<?= $s->id ?? 0 ?>, '<?= htmlspecialchars($s->nama_kegiatan ?? '', ENT_QUOTES) ?>')" title="Lihat Eviden">
                                    <i class="fas fa-file-image"></i>
                                </button>

                                <!-- TOMBOL MATA: Untuk menampilkan preview surat (iframe) -->
                                <button class="btn btn-detail" onclick="event.stopPropagation(); showSuratModal(<?= $s->id ?>)" title="Lihat Surat">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                
                                <!-- TOMBOL EDIT (untuk disetujui KK, disetujui sekretariat, ditolak sekretariat) -->
                                <?php if(in_array($s->status, ['disetujui KK', 'disetujui sekretariat', 'ditolak sekretariat'])): ?>
                                    <a href="<?= site_url('sekretariat/edit_surat_sekretariat/' . $s->id) ?>" 
                                    class="btn btn-warning" 
                                    title="Edit Pengajuan"
                                    onclick="event.stopPropagation(); return true;">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <!-- LOGIKA BARU: Tombol Approve hanya untuk status "disetujui KK" dengan disposisi "Lanjut Proses" -->
                                <?php if($status == 'disetujui KK' && $s->disposisi_status == 'Lanjut Proses ✔'): ?>
                                    <button class="btn btn-approve" onclick="event.stopPropagation(); showApproveModal(<?= $s->id ?>, '<?= htmlspecialchars(addslashes($s->nama_kegiatan ?? '')) ?>')" title="Approve">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    
                                <!-- LOGIKA BARU: Tombol Return untuk status "disetujui sekretariat" atau "ditolak sekretariat" -->
                                <?php elseif(in_array($s->status, ['disetujui sekretariat', 'ditolak sekretariat'])): ?>
                                    <button class="btn btn-return" onclick="event.stopPropagation(); showReturnModal(<?= $s->id ?>, '<?= htmlspecialchars($s->nama_kegiatan ?? '', ENT_QUOTES) ?>')" title="Return">
                                        <i class="fa-solid fa-undo"></i>
                                    </button>
                                <?php endif; ?>
                                
                                <!-- Tombol edit khusus untuk ditolak dekan -->
                                <?php if($status == 'ditolak dekan' && $s->disposisi_status == 'Lanjut Proses ✔'): ?>
                                    <a href="<?= site_url('sekretariat/edit_surat/' . $s->id) ?>" 
                                    class="btn btn-warning" 
                                    title="Edit & Ajukan Ulang ke Dekan"
                                    onclick="event.stopPropagation(); return true;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <!-- TOMBOL: TAMBAH NOMOR SURAT (hanya untuk status disetujui dekan) -->
                                <?php if($status == 'disetujui dekan'): ?>
                                    <button class="btn btn-nomor" 
                                            onclick="event.stopPropagation(); openNomorSuratModal(<?= $s->id ?>, '<?= htmlspecialchars(addslashes($s->nama_kegiatan ?? '')) ?>')"
                                            title="Masukkan Nomor Surat">
                                        <i class="fa-solid fa-hashtag"></i>
                                    </button>
                                <?php endif; ?>
                                
                                <!-- TOMBOL: CETAK SURAT (hanya jika nomor surat sudah terisi) -->
                                <?php if($status == 'disetujui dekan' && !empty($s->nomor_surat) && $s->nomor_surat !== '-' && $s->nomor_surat !== 'null'): ?>
                                    <button class="btn btn-cetak" 
                                            onclick="event.stopPropagation(); window.open('<?= site_url('surat/cetak/' . $s->id) ?>', '_blank')"
                                            title="Cetak Surat">
                                        <i class="fa-solid fa-print"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="9" style="text-align:center;padding:40px;color:#7f8c8d">
                            <i class="fa-solid fa-inbox" style="font-size:48px;margin-bottom:10px;display:block;opacity:0.3"></i>
                            <strong>
                                <?php if(!isset($surat_list)): ?>
                                    Variabel $surat_list tidak terdefinisi
                                <?php elseif(empty($surat_list)): ?>
                                    Tidak ada data pengajuan yang sesuai dengan filter
                                <?php else: ?>
                                    Data tidak valid
                                <?php endif; ?>
                            </strong>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-info" style="margin-top: 20px; text-align: center; color: #7f8c8d; font-size: 13px;">
            Menampilkan: 
            <?php 
            $filter_info = "Semua Data";
            if($this->input->get('status') == 'pending') $filter_info = "Menunggu";
            if($this->input->get('status') == 'approved') $filter_info = "Disetujui";
            if($this->input->get('status') == 'rejected') $filter_info = "Ditolak";
            if($this->input->get('status') == 'dekan_approved') $filter_info = "Disetujui Dekan";
            if($this->input->get('status') == 'dekan_rejected') $filter_info = "Ditolak Dekan";
            
            // Filter Jenis Penugasan
            $jenis_penugasan_info = "";
            if($this->input->get('jenis_penugasan') == 'perorangan') {
                $jenis_penugasan_info = " [Perorangan]";
            } elseif($this->input->get('jenis_penugasan') == 'kelompok') {
                $jenis_penugasan_info = " [Kelompok]";
            } elseif($this->input->get('jenis_penugasan') == 'lainnya') {
                $jenis_penugasan_info = " [Lainnya]";
            }
            
            echo $filter_info . $jenis_penugasan_info . " (" . (isset($total_surat) ? $total_surat : '0') . " data)";
            ?>
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

<template id="suratModalTemplate">
    <div class="modal-content surat-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-file-pdf"></i> Preview Surat Tugas</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="detail-content">
            <div class="surat-preview-container">
                <div class="surat-preview-header">
                    <div style="font-weight:600;color:#2c3e50;font-size:14px">
                        <i class="fa-solid fa-file-contract"></i> Preview Surat Tugas
                    </div>
                    <div class="surat-toolbar">
                        <button class="surat-btn surat-btn-download" onclick="downloadPDF('')" title="Download PDF">
                            <i class="fa-solid fa-download"></i> Download
                        </button>
                        <button class="surat-btn surat-btn-print" onclick="printPDF('')" title="Print Surat">
                            <i class="fa-solid fa-print"></i> Print
                        </button>
                        <button class="surat-btn surat-btn-fullscreen" onclick="toggleFullscreen()" title="Fullscreen">
                            <i class="fa-solid fa-expand"></i> Fullscreen
                        </button>
                    </div>
                </div>
                <div class="surat-iframe-container">
                    <iframe class="surat-iframe" id="suratIframe" style="width:100%;min-height:100%;border:none"></iframe>
                </div>
            </div>
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

<template id="approveModalTemplate">
    <div class="modal-content approve-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-check-circle"></i> Konfirmasi Persetujuan</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div style="padding:25px">
            <div style="text-align:center;margin-bottom:20px">
                <i class="fa-solid fa-question-circle" style="font-size:48px;color:#27ae60;margin-bottom:15px"></i>
                <h4 style="color:#2c3e50;margin-bottom:10px">Setujui Pengajuan?</h4>
                <p class="approve-nama-kegiatan" style="font-weight:600;color:#7f8c8d;margin-bottom:20px"></p>
            </div>
            
            <form class="approve-form" method="POST" action="">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:25px;padding-top:20px;border-top:1px solid #e9ecef">
                    <button type="button" class="btn btn-cancel" style="background:#95a5a6;color:white">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-submit" style="background:#27ae60;color:white">
                        <i class="fa-solid fa-check"></i> Ya, Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<template id="rejectModalTemplate">
    <div class="modal-content reject-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-ban"></i> Konfirmasi Penolakan</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div style="padding:25px">
            <div class="reject-info-box">
                <strong><i class="fa-solid fa-exclamation-triangle"></i> Anda akan menolak pengajuan:</strong>
                <span class="reject-nama-kegiatan">-</span>
            </div>
            
            <p style="margin-bottom:15px;color:#7f8c8d">
                <i class="fa-solid fa-info-circle"></i> 
                Berikan alasan penolakan untuk pengajuan ini:
            </p>
            
            <form class="reject-form" method="POST" action="">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <textarea 
                    class="reject-textarea" 
                    placeholder="Masukkan alasan penolakan pengajuan ini..."
                    required
                ></textarea>
                
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:12px">
                    <button type="button" class="btn btn-cancel" style="background:#95a5a6;color:white">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-submit-reject" style="background:#e74c3c;color:white">
                        <i class="fa-solid fa-ban"></i> Ya, Tolak
                    </button>
                </div>
            </form>
        </div>
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
            
            <form class="return-form" method="POST" action="">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:25px; padding-top:20px; border-top:1px solid #e9ecef">
                    <button type="button" class="btn btn-cancel" style="background:#95a5a6; color:white">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-confirm-return" style="background:#ff9800; color:white">
                        <i class="fa-solid fa-undo"></i> Ya, Kembalikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<!-- ============================================
   TEMPLATE BARU: MODAL NOMOR SURAT YANG LEBIH BAGUS
============================================ -->
<template id="nomorSuratModalTemplate">
    <div class="modal-content nomor-surat-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-hashtag"></i> Tambahkan Nomor Surat</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="nomor-surat-content">
            <!-- Informasi Surat -->
            <div class="nomor-surat-info-box">
                <h4><i class="fa-solid fa-info-circle"></i> Informasi Surat Tugas</h4>
                <div id="nomorSuratInfoDetails" class="nomor-surat-info-details">
                    <!-- Content akan diisi oleh JavaScript -->
                </div>
            </div>
            
            <!-- Form Input Nomor Surat -->
            <div class="nomor-surat-form-container">
                <div class="form-header">
                    <h4><i class="fa-solid fa-file-signature"></i> Input Nomor Surat</h4>
                    <p>Masukkan nomor surat resmi untuk pengajuan ini</p>
                </div>
                
                <form class="nomor-surat-form">
                    <input type="hidden" class="nomor-surat-id" value="">
                    
                    <div class="input-group-nomor-surat">
                        <div class="input-label">
                            <i class="fa-solid fa-hashtag"></i>
                            Nomor Surat
                            <span class="required-star">*</span>
                        </div>
                        
                        <div class="nomor-surat-input-container">
                            <input 
                                type="text" 
                                class="nomor-surat-input" 
                                placeholder="Contoh: 001/SKT/FT/2025" 
                                required
                                autocomplete="off"
                                maxlength="50"
                            >
                        </div>
                        
                        <div class="input-hint">
                            <i class="fa-solid fa-lightbulb"></i>
                            Format yang disarankan: 
                            <span class="format-example">XXX/SKT/FT/Tahun</span>
                            atau
                            <span class="format-example">Nomor/SK/Unit/Tahun</span>
                        </div>
                        
                        <div class="nomor-surat-error" style="display:none">
                            <i class="fa-solid fa-exclamation-circle"></i>
                            <span class="error-message"></span>
                        </div>
                    </div>

                    <div class="nomor-surat-actions">
                        <button type="button" class="btn-nomor-cancel">
                            <i class="fa-solid fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-nomor-submit">
                            <i class="fa-solid fa-save"></i> Simpan Nomor Surat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<!-- Modal PIN (tetap seperti sebelumnya) -->
<div id="pinModal" 
    style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
    background:rgba(0,0,0,0.45);backdrop-filter:blur(3px);
    align-items:center;justify-content:center;z-index:9999">

    <div style="
        background:#ffffff;
        padding:28px;
        border-radius:14px;
        width:360px;
        text-align:center;
        animation: fadeIn 0.25s ease;
        box-shadow:0 12px 30px rgba(0,0,0,0.25);
    ">
        <h3 style="margin-bottom:18px;color:#333;font-weight:700;font-size:20px;">
            <i class="fas fa-shield-alt" style="margin-right:8px;color:#16A085;"></i>
            Verifikasi PIN
        </h3>

        <!-- Input PIN -->
        <div class="pin-input-container" style="position:relative;display:flex;justify-content:center;">
            <i class="fas fa-key pin-icon" 
            style="position:absolute;left:30px;top:50%;transform:translateY(-50%);color:#16A085;"></i>

            <input type="password"
                id="pinInput"
                maxlength="6"
                style="
                    width:220px;
                    padding:12px 40px;
                    border:2px solid #16A085;
                    border-radius:8px;
                    font-size:18px;
                    text-align:center;
                    letter-spacing:6px;
                    outline:none;
                "
                placeholder="••••••"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>

        <!-- Tombol -->
        <div style="display:flex;gap:12px;justify-content:center;margin-top:25px;">
            <button onclick="checkPin()" 
                style="
                    background:#16A085;
                    color:white;
                    border:none;
                    padding:10px 22px;
                    border-radius:7px;
                    cursor:pointer;
                    font-weight:600;
                ">
                <i class="fas fa-check"></i> Lanjut
            </button>

            <button onclick="closePinModal()"
                style="
                    background:#7f8c8d;
                    color:white;
                    border:none;
                    padding:10px 22px;
                    border-radius:7px;
                    cursor:pointer;
                    font-weight:600;
                ">
                <i class="fas fa-times"></i> Batal
            </button>
        </div>
<button onclick="openUbahPinModal()" 
        style="background:none;border:none;color:#16A085;margin-top:10px;cursor:pointer;font-weight:600;">
    Ubah PIN?
</button>

        <p style="margin-top:15px;font-size:12px;color:#7f8c8d;">
            <i class="fas fa-info-circle"></i> PIN terdiri dari 6 digit angka
        </p>
    </div>
</div>

<!-- Modal Ubah PIN -->
<div id="ubahPinModal" 
    style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
    background:rgba(0,0,0,0.5);align-items:center;justify-content:center;z-index:9999">

    <div style="background:#fff;width:380px;padding:25px;border-radius:14px;
        box-shadow:0 15px 35px rgba(0,0,0,0.25);text-align:center;">

        <h2 style="margin-bottom:10px;color:#333;font-weight:700;">
            <i class="fas fa-key" style="color:#16A085;margin-right:8px;"></i>
            Ubah PIN
        </h2>

        <p style="font-size:13px;color:#777;margin-bottom:20px;">
            Masukkan PIN lama dan PIN baru (6 digit).
        </p>

        <div style="text-align:left;margin-bottom:12px;">
            <label>PIN Lama</label>
            <input type="password" id="oldPin" maxlength="6"
                style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;margin-top:5px;"
                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
        </div>

        <div style="text-align:left;">
            <label>PIN Baru</label>
            <input type="password" id="newPin" maxlength="6"
                style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;margin-top:5px;"
                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
        </div>

        <div style="display:flex;gap:10px;margin-top:25px;justify-content:center;">
            <button onclick="submitUbahPin()" 
                style="background:#16A085;color:white;border:none;padding:10px 20px;
                border-radius:8px;cursor:pointer;font-weight:600;">
                Simpan
            </button>

            <button onclick="closeUbahPinModal()" 
                style="background:#7f8c8d;color:white;border:none;padding:10px 20px;
                border-radius:8px;cursor:pointer;font-weight:600;">
                Batal
            </button>
        </div>

        <p id="pinMsg" style="margin-top:12px;color:red;font-size:13px;"></p>

    </div>
</div>

<script>
// ===== MULTI MODAL MANAGEMENT SYSTEM (SAMA DENGAN KAPRODI) =====

// Global variables
let modalManager;
let currentRejectId = null;
let currentApproveId = null;
let currentReturnId = null;
let currentReturnNamaKegiatan = null;
let currentNomorSuratId = null;
let currentNomorSuratNama = null;
let selectedSurat = null;
let currentSuratPdfUrl = '';
let isFullscreen = false;

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
            case 'surat':
                modalContent = this.createSuratModal(data);
                break;
            case 'eviden':
                modalContent = this.createEvidenModal(data);
                break;
            case 'preview':
                modalContent = this.createPreviewModal(data);
                break;
            case 'approve':
                modalContent = this.createApproveModal(data);
                break;
            case 'reject':
                modalContent = this.createRejectModal(data);
                break;
            case 'return':
                modalContent = this.createReturnModal(data);
                break;
            case 'nomor_surat':
                modalContent = this.createNomorSuratModal(data);
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

    // Create surat modal - DIUBAH: menggunakan template baru dengan toolbar
    createSuratModal(data) {
        const template = document.getElementById('suratModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        return modalContent.outerHTML;
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

    // Create approve modal
    createApproveModal(data) {
        const template = document.getElementById('approveModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.namaKegiatan) {
            modalContent.querySelector('.approve-nama-kegiatan').textContent = data.namaKegiatan;
        }
        if (data.suratId) {
            modalContent.querySelector('.approve-form').action = '<?= base_url("sekretariat/approve/") ?>' + data.suratId;
        }
        
        return modalContent.outerHTML;
    }

    // Create reject modal
    createRejectModal(data) {
        const template = document.getElementById('rejectModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.namaKegiatan) {
            modalContent.querySelector('.reject-nama-kegiatan').textContent = data.namaKegiatan;
        }
        if (data.suratId) {
            modalContent.querySelector('.reject-form').action = '<?= base_url("sekretariat/reject/") ?>' + data.suratId;
        }
        
        return modalContent.outerHTML;
    }

    // Create return modal
    createReturnModal(data) {
        const template = document.getElementById('returnModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.namaKegiatan) {
            modalContent.querySelector('.return-nama-kegiatan').textContent = data.namaKegiatan;
        }
        if (data.suratId) {
            modalContent.querySelector('.return-form').action = '<?= base_url("sekretariat/return_pengajuan/") ?>' + data.suratId;
        }
        
        return modalContent.outerHTML;
    }

    // Create nomor surat modal - DIUBAH: template baru yang lebih bagus
    createNomorSuratModal(data) {
        const template = document.getElementById('nomorSuratModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        // Set ID
        if (data.suratId) {
            modalContent.querySelector('.nomor-surat-id').value = data.suratId;
        }
        
        // Generate info box content
        const infoDetails = modalContent.querySelector('#nomorSuratInfoDetails');
        if (infoDetails && data.namaKegiatan) {
            infoDetails.innerHTML = `
                <div class="info-detail-item">
                    <div class="info-detail-label">Nama Kegiatan</div>
                    <div class="info-detail-value">${escapeHtml(data.namaKegiatan)}</div>
                </div>
                <div class="info-detail-item">
                    <div class="info-detail-label">Status</div>
                    <div class="info-detail-value">
                        <span class="badge badge-approved">Disetujui Dekan</span>
                    </div>
                </div>
                <div class="info-detail-item">
                    <div class="info-detail-label">Aksi</div>
                    <div class="info-detail-value">
                        <i class="fa-solid fa-keyboard" style="color:#16A085"></i> 
                        Input Nomor Surat Resmi
                    </div>
                </div>
            `;
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
        const cancelBtns = modalElement.querySelectorAll('.btn-nomor-cancel, .btn-cancel');
        cancelBtns.forEach(btn => {
            btn.addEventListener('click', () => this.closeModal(modalId));
        });
        
        // Type-specific event listeners
        switch(type) {
            case 'detail':
                this.attachDetailModalListeners(modalElement, modalId, data);
                break;
            case 'surat':
                this.attachSuratModalListeners(modalElement, modalId, data);
                break;
            case 'eviden':
                this.attachEvidenModalListeners(modalElement, modalId, data);
                break;
            case 'approve':
                this.attachApproveModalListeners(modalElement, modalId, data);
                break;
            case 'reject':
                this.attachRejectModalListeners(modalElement, modalId, data);
                break;
            case 'return':
                this.attachReturnModalListeners(modalElement, modalId, data);
                break;
            case 'nomor_surat':
                this.attachNomorSuratModalListeners(modalElement, modalId, data);
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

    // Attach surat modal listeners - DIUBAH: untuk modal yang lebih lebar
    attachSuratModalListeners(modalElement, modalId, data) {
        // Load surat content if data provided
        if (data.suratId) {
            this.loadSuratContent(modalElement, data.suratId);
        }
        
        // Setup fullscreen toggle button
        const fullscreenBtn = modalElement.querySelector('.surat-btn-fullscreen');
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', () => {
                const iframe = modalElement.querySelector('.surat-iframe');
                if (iframe) {
                    toggleIframeFullscreen(iframe);
                }
            });
        }
        
        // Setup download button
        const downloadBtn = modalElement.querySelector('.surat-btn-download');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentSuratPdfUrl) {
                    downloadPDF(currentSuratPdfUrl);
                }
            });
        }
        
        // Setup print button
        const printBtn = modalElement.querySelector('.surat-btn-print');
        if (printBtn) {
            printBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentSuratPdfUrl) {
                    printPDF(currentSuratPdfUrl);
                }
            });
        }
    }

    // Attach eviden modal listeners
    attachEvidenModalListeners(modalElement, modalId, data) {
        // Load eviden content if data provided
        if (data.suratId) {
            this.loadEvidenContent(modalElement, data.suratId, data.namaKegiatan || '');
        }
    }

    // Attach approve modal listeners
    attachApproveModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.approve-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitApproveForm(form, data.suratId);
            });
        }
    }

    // Attach reject modal listeners
    attachRejectModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.reject-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const notes = form.querySelector('.reject-textarea').value.trim();
                if (!notes) { 
                    showAlert('Alasan penolakan harus diisi', 'error');
                    return; 
                }
                this.submitRejectForm(form, data.suratId, notes);
            });
        }
    }

    // Attach return modal listeners
    attachReturnModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.return-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitReturnForm(form, data.suratId);
            });
        }
    }

    // Attach nomor surat modal listeners - DIUBAH: untuk template baru
    attachNomorSuratModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.nomor-surat-form');
        if (form) {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const id = form.querySelector('.nomor-surat-id').value;
                const nomorSuratInput = form.querySelector('.nomor-surat-input');
                const nomorSurat = nomorSuratInput.value.trim();
                const errorDiv = form.querySelector('.nomor-surat-error');
                const errorMessage = errorDiv.querySelector('.error-message');
                const submitBtn = form.querySelector('.btn-nomor-submit');
                
                // Reset error
                errorDiv.style.display = 'none';
                errorMessage.textContent = '';
                
                // Validasi input
                if (!nomorSurat) {
                    errorMessage.textContent = 'Nomor surat harus diisi!';
                    errorDiv.style.display = 'flex';
                    nomorSuratInput.focus();
                    return;
                }
                
                // Validasi format dasar
                if (nomorSurat.length < 5) {
                    errorMessage.textContent = 'Nomor surat terlalu pendek!';
                    errorDiv.style.display = 'flex';
                    nomorSuratInput.focus();
                    return;
                }
                
                // Disable submit button dan tampilkan loading
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<div class="spinner"></div> Menyimpan...';
                submitBtn.disabled = true;
                
                try {
                    // Kirim data via AJAX
                    const formData = new FormData();
                    formData.append('nomor_surat', nomorSurat);
                    formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
                    
                    const response = await fetch('<?= site_url("sekretariat/tambah_nomor_surat_ajax/") ?>' + id, {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        // Tutup modal
                        this.closeModal(modalId);
                        
                        // Tampilkan alert sukses
                        showAlert('✅ Nomor surat berhasil disimpan!', 'success');
                        
                        // Refresh halaman setelah 1 detik
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        // Tampilkan error
                        errorMessage.textContent = result.message || 'Gagal menyimpan nomor surat.';
                        errorDiv.style.display = 'flex';
                        
                        // Enable button kembali
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        
                        // Fokus ke input
                        nomorSuratInput.focus();
                    }
                    
                } catch (error) {
                    console.error('Error saving nomor surat:', error);
                    errorMessage.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    errorDiv.style.display = 'flex';
                    
                    // Enable button kembali
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    
                    // Fokus ke input
                    nomorSuratInput.focus();
                }
            });
        }
        
        // Auto-focus ke input field saat modal terbuka
        setTimeout(() => {
            const inputField = modalElement.querySelector('.nomor-surat-input');
            if (inputField) {
                inputField.focus();
            }
        }, 100);
    }

    // Load detail content
    async loadDetailContent(modalElement, suratId) {
        try {
            const detailContent = modalElement.querySelector('.detail-content');
            if (!detailContent) return;
            
            detailContent.innerHTML = `
                <div style="text-align:center;padding:60px;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size:32px;color:#16A085"></i>
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

    // Load surat content - DIUBAH: untuk modal yang lebih lebar
    async loadSuratContent(modalElement, suratId) {
        try {
            const iframe = modalElement.querySelector('.surat-iframe');
            const downloadBtn = modalElement.querySelector('.surat-btn-download');
            const printBtn = modalElement.querySelector('.surat-btn-print');
            
            if (!iframe) return;
            
            // Set loading state
            iframe.src = 'about:blank';
            iframe.onload = null;
            
            // Set URLs
            const viewUrl = "<?= base_url('sekretariat/view_surat_pengajuan/') ?>" + suratId;
            currentSuratPdfUrl = "<?= base_url('sekretariat/download_pdf/') ?>" + suratId;
            
            // Update button actions
            if (downloadBtn) {
                downloadBtn.onclick = (e) => {
                    e.preventDefault();
                    downloadPDF(currentSuratPdfUrl);
                };
            }
            
            if (printBtn) {
                printBtn.onclick = (e) => {
                    e.preventDefault();
                    printPDF(currentSuratPdfUrl);
                };
            }
            
            // Load the content
            iframe.src = viewUrl;
            
            // Set iframe height adjustment
            iframe.onload = function() {
                adjustIframeHeight(iframe);
            };
            
        } catch (error) {
            console.error('Error loading surat:', error);
            showAlert('Gagal memuat surat: ' + error.message, 'error');
        }
    }

    // Load eviden content - DIPERBAIKI: Langsung preview jika hanya 1 file
    async loadEvidenContent(modalElement, suratId, namaKegiatan = '') {
        try {
            const detailContent = modalElement.querySelector('.detail-content');
            if (!detailContent) return;
            
            detailContent.innerHTML = `
                <div style="text-align:center;padding:40px;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#16A085"></i>
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

    // Submit approve form
    submitApproveForm(form, suratId) {
        form.submit();
    }

    // Submit reject form
    submitRejectForm(form, suratId, notes) {
        const formToSubmit = document.createElement('form');
        formToSubmit.method = 'POST';
        formToSubmit.action = '<?= base_url("sekretariat/reject/") ?>' + suratId;
        
        const csrfName = '<?= $this->security->get_csrf_token_name() ?>';
        const csrfHash = '<?= $this->security->get_csrf_hash() ?>';
        const inpCsrf = document.createElement('input');
        inpCsrf.type='hidden'; 
        inpCsrf.name=csrfName; 
        inpCsrf.value=csrfHash;
        formToSubmit.appendChild(inpCsrf);
        
        const inpNotes = document.createElement('input');
        inpNotes.type='hidden'; 
        inpNotes.name='rejection_notes'; 
        inpNotes.value=notes;
        formToSubmit.appendChild(inpNotes);
        
        document.body.appendChild(formToSubmit);
        formToSubmit.submit();
    }

    // Submit return form
    submitReturnForm(form, suratId) {
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

// ============================================
// FUNGSI UNTUK MEMBUKA MODAL
// ============================================

// Fungsi untuk menampilkan detail saat baris diklik
function showRowDetail(id) {
    modalManager.createModal('detail', { suratId: id });
}

// Fungsi untuk menampilkan modal surat (tombol mata)
function showSuratModal(id) {
    modalManager.createModal('surat', { suratId: id });
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

// Fungsi untuk menampilkan modal approve
function showApproveModal(id, namaKegiatan = '') {
    modalManager.createModal('approve', { 
        suratId: id, 
        namaKegiatan: namaKegiatan 
    });
}

// Fungsi untuk menampilkan modal reject
function showRejectModal(id, namaKegiatan = '') {
    modalManager.createModal('reject', { 
        suratId: id, 
        namaKegiatan: namaKegiatan 
    });
}

// Fungsi untuk menampilkan return modal
function showReturnModal(id, namaKegiatan) {
    modalManager.createModal('return', { 
        suratId: id, 
        namaKegiatan: namaKegiatan 
    });
}

// Fungsi untuk membuka modal nomor surat - DIUBAH: menggunakan template baru
async function openNomorSuratModal(id, namaKegiatan = '') {
    modalManager.createModal('nomor_surat', { 
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
                <i class="fas fa-spinner fa-spin" style="font-size: 48px; color: #16A085;"></i>
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

// Fungsi untuk toggle fullscreen pada iframe - DIUBAH
function toggleIframeFullscreen(iframe) {
    if (!isFullscreen) {
        iframe.classList.add('fullscreen');
        isFullscreen = true;
        
        // Update fullscreen button text
        const fullscreenBtn = document.querySelector('.surat-btn-fullscreen');
        if (fullscreenBtn) {
            fullscreenBtn.innerHTML = '<i class="fa-solid fa-compress"></i> Keluar Fullscreen';
            fullscreenBtn.title = 'Keluar Fullscreen';
        }
        
        // Hide other elements
        document.querySelector('.surat-preview-header').style.display = 'none';
    } else {
        iframe.classList.remove('fullscreen');
        isFullscreen = false;
        
        // Update fullscreen button text
        const fullscreenBtn = document.querySelector('.surat-btn-fullscreen');
        if (fullscreenBtn) {
            fullscreenBtn.innerHTML = '<i class="fa-solid fa-expand"></i> Fullscreen';
            fullscreenBtn.title = 'Fullscreen';
        }
        
        // Show header again
        document.querySelector('.surat-preview-header').style.display = 'flex';
    }
}

// Fungsi untuk menyesuaikan tinggi iframe - DIUBAH
function adjustIframeHeight(iframe) {
    if (!iframe) return;
    
    try {
        // Tunggu untuk konten selesai dimuat
        setTimeout(() => {
            try {
                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                const body = iframeDoc.body;
                const html = iframeDoc.documentElement;
                
                // Hitung tinggi konten
                const height = Math.max(
                    body.scrollHeight,
                    body.offsetHeight,
                    html.clientHeight,
                    html.scrollHeight,
                    html.offsetHeight
                );
                
                // Set tinggi minimum untuk iframe
                const minHeight = 800;
                const calculatedHeight = Math.max(minHeight, height);
                
                iframe.style.minHeight = calculatedHeight + 'px';
                
                // Scroll ke atas
                iframe.contentWindow.scrollTo(0, 0);
                
            } catch (e) {
                console.error('Error adjusting iframe height:', e);
                // Fallback: set tinggi tetap
                iframe.style.minHeight = '800px';
            }
        }, 1000); // Tunggu 1 detik untuk konten selesai dimuat
    } catch (e) {
        console.error('Error accessing iframe content:', e);
        iframe.style.minHeight = '800px';
    }
}

// Fungsi untuk print PDF
function printPDF(url) {
    if (!url) {
        showAlert('URL PDF tidak tersedia', 'error');
        return;
    }
    
    fetch(url)
        .then(res => res.blob())
        .then(blob => {
            const blobUrl = URL.createObjectURL(blob);
            const iframe = document.createElement("iframe");
            iframe.style.display = "none";
            iframe.src = blobUrl;
            document.body.appendChild(iframe);

            iframe.onload = function () {
                setTimeout(() => {
                    iframe.contentWindow.print();
                    // Cleanup setelah 10 detik
                    setTimeout(() => {
                        if (iframe.parentNode) {
                            iframe.parentNode.removeChild(iframe);
                        }
                        URL.revokeObjectURL(blobUrl);
                    }, 10000);
                }, 500);
            };
        })
        .catch(error => {
            console.error('Error printing PDF:', error);
            showAlert('Gagal mencetak PDF: ' + error.message, 'error');
        });
}

// Fungsi untuk download PDF
function downloadPDF(url) {
    if (!url) {
        showAlert('URL PDF tidak tersedia', 'error');
        return;
    }
    
    window.location.href = url;
}

// ============================================
// FUNGSI HELPER
// ============================================

// PERBAIKAN: Fungsi untuk mengambil data detail via AJAX
function getSuratDetail(id) {
    return fetch('<?= site_url("sekretariat/getDetailPengajuan/") ?>' + id)
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
                <div class="dosen-avatar" style="width: 45px; height: 45px; border-radius: 50%; background: #16A085; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; font-weight: 600; overflow: hidden; position: relative; flex-shrink: 0;">
                    ${hasFoto ? `
                        <img src="${escapeHtml(foto)}" 
                             alt="${escapeHtml(dosen.nama)}" 
                             style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 2;"
                             onerror="console.error('Image load error:', this.src); this.style.display='none'; this.parentElement.style.background='#16A085';">
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
            <div class="dosen-avatar" style="width: 45px; height: 45px; border-radius: 50%; background: #16A085; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: 600;">
                <span>?</span>
            </div>
            <div class="dosen-info">
                <div class="dosen-name">Data dosen tidak tersedia</div>
                <div class="dosen-details">Informasi dosen tidak ditemukan</div>
            </div>
        </div>`;
    }
    
    let nomorSuratHtml = '';
    if (getVal('nomor_surat') && getVal('nomor_surat') !== '-') {
        nomorSuratHtml = `
        <div style="background:#e8f6f3;border:2px solid #16A085;border-radius:10px;padding:15px;margin-bottom:20px;text-align:center">
            <div style="font-size:14px;font-weight:600;color:#16A085;margin-bottom:5px;text-transform:uppercase;letter-spacing:1px">
                <i class="fa-solid fa-file-signature"></i> Nomor Surat
            </div>
            <div style="font-size:18px;font-weight:700;color:#117864;font-family:'Courier New',monospace">
                ${escapeHtml(getVal('nomor_surat'))}
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
    ${nomorSuratHtml}
    
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

// Close all modals with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modalManager.modals.length > 0) {
        // Jika dalam mode fullscreen, keluar dulu
        if (isFullscreen) {
            const iframe = document.querySelector('.surat-iframe.fullscreen');
            if (iframe) {
                toggleIframeFullscreen(iframe);
                return;
            }
        }
        modalManager.closeModal(modalManager.modals[modalManager.modals.length - 1].id);
    }
});

// ============================================
// FUNGSI DISPOSISI (SAMA SEPERTI SEBELUMNYA)
// ============================================

// OPEN PIN POPUP
function openPinModal(id, event) {
    if (event) event.stopPropagation();
    selectedSurat = id;
    document.getElementById("pinModal").style.display = "flex";
    document.getElementById("pinInput").focus();
}

// CLOSE PIN POPUP
function closePinModal() {
    document.getElementById("pinModal").style.display = "none";
    document.getElementById("pinInput").value = "";
}

function checkPin() {
    let pin = document.getElementById("pinInput").value;

    // Validasi input
    if (!pin) {
        showAlert("PIN harus diisi!", "error");
        return;
    }

    if (pin.length !== 6) {
        showAlert("PIN harus 6 digit!", "error");
        return;
    }

    if (!/^[0-9]{6}$/.test(pin)) {
        showAlert("PIN harus berupa angka!", "error");
        return;
    }

    // Kirim request
    fetch("<?= base_url('sekretariat/cek_pin') ?>", {
        method: "POST",
        headers: { 
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({ pin: pin })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.status === "success") {
            
            // Tampilkan dropdown disposisi
            if (selectedSurat) {
                document.getElementById("disposisiBox" + selectedSurat).style.display = "block";
            }
            
            // Tutup modal PIN
            closePinModal();
        } else {
            // PIN salah
            showAlert(data.message || "PIN salah!", "error");
            document.getElementById("pinInput").value = "";
            document.getElementById("pinInput").focus();
        }
    })
    .catch(error => {
        console.error("Fetch Error:", error);
        showAlert("Terjadi kesalahan: " + error.message, "error");
    });
}

// PADA SAAT MEMILIH DISPOSISI
function onDisposisiChange(id) {
    let val = document.getElementById("disposisiSelect" + id).value;
    let catatanLabel = document.getElementById("labelCatatan" + id);
    let catatanTextarea = document.getElementById("catatanDisposisi" + id);
    let btnSave = document.getElementById("btnSaveDisposisi" + id);

    // Reset dulu
    btnSave.style.display = "none";
    catatanLabel.style.display = "none";
    catatanTextarea.style.display = "none";
    
    // Kosongkan textarea setiap kali pilihan berubah
    if (catatanTextarea) catatanTextarea.value = "";
    
    // Untuk disposisi yang memerlukan catatan
    if (val === "Hold/Pending" || val === "Batal" ) {
        if (catatanLabel) catatanLabel.style.display = "block";
        if (catatanTextarea) {
            catatanTextarea.style.display = "block";
            btnSave.style.display = "block";

        // Set placeholder berdasarkan pilihan
        if (val === "Hold/Pending") {
            catatanTextarea.placeholder = "Berikan alasan mengapa perlu ditahan/ditunda...";
        } else if (val === "Batal") {
            catatanTextarea.placeholder = "Berikan alasan pembatalan...";
        }
        // Fokus ke textarea
        setTimeout(() => {
            if (catatanTextarea) catatanTextarea.focus();
        }, 100);
        }
    } else if (val === "Lanjut Proses ✔"){
        if (btnSave) btnSave.style.display = "block";
    }
}

// SIMPAN DISPOSISI
function saveDisposisi(id) {
    let disposisi = document.getElementById("disposisiSelect" + id).value;
    let catatanTextarea = document.getElementById("catatanDisposisi" + id);
    let catatan = catatanTextarea ? catatanTextarea.value : "";

    if (!disposisi) {
        showAlert("Pilih disposisi dulu!", "warning");
        return;
    }

    if ((disposisi === "Hold/Pending" || disposisi === "Batal") && catatan === "") {
        showAlert("Wajib Mengisi Catatan!", "warning");
        return;
    }

    // Konfirmasi khusus untuk disposisi Batal
    if (disposisi === "Batal") {
        if (!confirm("⚠️ Pengajuan ini akan DITOLAK oleh Sekretariat.\n\nLanjutkan?")) {
            return;
        }
    }

    fetch("<?= base_url('sekretariat/set_disposisi') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            id: id,
            disposisi: disposisi,
            catatan: catatan
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            if (disposisi === "Batal") {
                showAlert("✅ Disposisi tersimpan!\n\n📌 Status pengajuan diubah menjadi: DITOLAK SEKRETARIAT", "success");
            } else {
                showAlert("✅ Disposisi tersimpan!", "success");
            }
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showAlert("❌ Gagal menyimpan disposisi. Silakan coba lagi.", "error");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        showAlert("❌ Terjadi kesalahan. Silakan coba lagi.", "error");
    });
}

// ============================================
// FUNGSI UBAH PIN
// ============================================

function openUbahPinModal() {
    document.getElementById("ubahPinModal").style.display = "flex";
}

function closeUbahPinModal() {
    document.getElementById("ubahPinModal").style.display = "none";
    document.getElementById("pinMsg").innerHTML = "";
}

function submitUbahPin() {
    let oldPin = document.getElementById("oldPin").value;
    let newPin = document.getElementById("newPin").value;

    if (oldPin.length !== 6 || newPin.length !== 6) {
        document.getElementById("pinMsg").innerHTML = "PIN harus 6 digit!";
        return;
    }

    fetch("<?= base_url('sekretariat/updatePin') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `old_pin=${encodeURIComponent(oldPin)}&new_pin=${encodeURIComponent(newPin)}`
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("pinMsg").innerHTML = data.message;

        if (data.status) {
            setTimeout(() => {
                closeUbahPinModal();
                location.reload();
            }, 800);
        }
    })
    .catch(() => {
        document.getElementById("pinMsg").innerHTML = "Terjadi kesalahan!";
    });
}

// ============================================
// EVENT LISTENERS TAMBAHAN
// ============================================

// Tambahkan CSS untuk mencegah selection pada klik
document.head.insertAdjacentHTML('beforeend', `
    <style>
        #tableBody button, #tableBody a, #tableBody select, #tableBody textarea, #tableBody input {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        
        .clickable-row {
            position: relative;
        }
        
        .clickable-row::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            pointer-events: none;
        }
        
        .clickable-row td > * {
            position: relative;
            z-index: 2;
        }
    </style>
`);
</script>
</body>
</html>