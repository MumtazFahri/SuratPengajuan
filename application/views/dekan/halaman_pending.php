<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengajuan Menunggu Persetujuan - Dashboard Dekan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    /* STYLE UTAMA (DITAMBAHKAN DARI MULTI MODAL SYSTEM) */
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:#f5f7fa;}
    .navbar{background:#FB8C00;color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 4px rgba(0,0,0,0.1);}
    .navbar h2{font-size:20px;}
    .container{max-width:1200px;margin:30px auto;padding:0 20px;}
    
    /* Back Button */
    .back-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#FB8C00;color:white;text-decoration:none;border-radius:8px;font-weight:600;transition:all 0.3s;margin-bottom:20px}
    .back-btn:hover{background:#e67e22;transform:translateY(-2px)}
    
    /* Card Styles */
    .card{background:white;border-radius:10px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,0.06);margin-bottom:20px}
    .card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid #eee}
    
    /* Table Styles */
    table{width:100%;border-collapse:collapse}
    thead{background:#f4f6f7}
    th,td{padding:12px;border-bottom:1px solid #ecf0f1;text-align:left;font-size:14px}
    tbody tr:hover{background:#fbfcfd}
    
    /* Badge Styles */
    .badge{display:inline-block;padding:6px 10px;border-radius:999px;font-weight:600;font-size:12px}
    .badge-pending{background:#fff3cd;color:#856404}
    .badge-approved{background:#d4edda;color:#155724}
    .badge-rejected{background:#f8d7da;color:#721c24}
    
    /* Button Styles */
    .btn{padding:6px 10px;border-radius:6px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s}
    .btn:hover{transform:scale(1.05)}
    .btn-approve{background:#27ae60;color:#fff}
    .btn-approve:hover{background:#229954}
    .btn-reject{background:#e74c3c;color:#fff}
    .btn-reject:hover{background:#c0392b}
    .btn-detail{background:#3498db;color:#fff}
    .btn-detail:hover{background:#2980b9}
    
    /* Tombol Eviden Hijau */
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
    }

    .btn-eviden i {
        font-size: 14px;
    }

    .btn-eviden:hover {
        background: #218838 !important;
        transform: scale(1.05);
    }
    
    /* Pagination Info */
    .pagination-info{margin-top:15px;color:#7f8c8d;font-size:14px;text-align:right}
    
    /* ============================================
       MULTI MODAL STYLES (DARI halaman_total.php)
    ============================================ */
    /* Clickable Row Styles */
    .clickable-row:hover {
        background-color: #fef9e7 !important;
        box-shadow: inset 0 0 0 2px #FB8C00;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .clickable-row:active {
        background-color: #fdebd0 !important;
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
    .modal-header{background:#FB8C00;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
    .modal-header h3{margin:0;font-size:20px;font-weight:600}
    .close-modal{background:none;border:0;color:white;font-size:28px;cursor:pointer;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .close-modal:hover{background:rgba(255,255,255,0.2)}
    
    /* Detail Content Styles */
    .detail-content{padding:30px;max-height:calc(90vh - 80px);overflow-y:auto}
    .detail-section{margin-bottom:30px;background:#f8f9fa;border-radius:12px;padding:25px;border:1px solid #e9ecef}
    .detail-section:last-child{margin-bottom:0}
    .detail-section-title{font-size:18px;font-weight:700;color:#FB8C00;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #FB8C00;display:flex;align-items:center;gap:12px}
    .detail-section-title i{font-size:20px}
    .detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}
    .detail-row{display:flex;flex-direction:column;margin-bottom:15px}
    .detail-label{font-weight:600;color:#495057;font-size:14px;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px}
    .detail-value{color:#212529;font-size:15px;background:white;padding:12px 18px;border-radius:8px;border:1px solid #e9ecef;min-height:45px;display:flex;align-items:center;word-break:break-word}
    .detail-value-empty{color:#6c757d;font-style:italic}
    
    /* ============================================
       SURAT MODAL STYLES - DIUBAH: LEBAR MAKSIMAL LEBIH BESAR
    ============================================ */
    .surat-modal .modal-content {
        max-width: 1400px !important;
        width: 98% !important;
        max-height: 95vh !important;
        min-width: 1000px;
    }
    
    /* Container khusus untuk preview surat agar lebih lebar */
    .surat-preview-container {
        width: 100%;
        height: calc(95vh - 150px);
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
        background: #FB8C00;
        color: white;
    }
    
    .surat-btn-download:hover {
        background: #E67E22;
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
        background: #FB8C00;
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
    .file-item:hover{background:#fef9e7;border-color:#FB8C00}
    .file-icon{width:32px;height:32px;display:flex;align-items:center;justify-content:center;color:#FB8C00;font-size:20px;flex-shrink:0}
    .file-info{flex:1;min-width:0}
    .file-name{font-weight:600;color:#212529;font-size:15px;cursor:pointer;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .file-name:hover{color:#FB8C00}
    .file-size{font-size:13px;color:#6c757d;margin-top:4px}
    .preview-btn{background:#3498db;color:white;border:none;padding:10px 18px;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:8px;text-decoration:none;flex-shrink:0}
    .preview-btn:hover{background:#2980b9;color:white;text-decoration:none}
    .preview-btn.disabled{background:#bdc3c7;cursor:not-allowed;opacity:0.6}
    .preview-btn.disabled:hover{background:#bdc3c7}
    .download-btn{background:#FB8C00;color:white;border:none;padding:10px 18px;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:8px;text-decoration:none;flex-shrink:0;margin-left:10px}
    .download-btn:hover{background:#E67E22;color:white;text-decoration:none}

    /* Preview Modal Styles */
    .preview-modal{display:none !important;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:1050;justify-content:center;align-items:center;padding:20px}
    .preview-modal.show{display:flex !important}
    .preview-content{background:white;border-radius:12px;width:90%;max-width:900px;max-height:90vh;overflow:hidden;display:flex;flex-direction:column}
    .preview-header{background:#FB8C00;color:white;padding:15px 20px;display:flex;justify-content:space-between;align-items:center}
    .preview-header h3{margin:0;font-size:16px;font-weight:600}
    .preview-close{background:none;border:none;color:white;font-size:24px;cursor:pointer;padding:0;width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .preview-close:hover{background:rgba(255,255,255,0.2)}
    .preview-body{flex:1;padding:0;display:flex;justify-content:center;align-items:center;background:#f8f9fa;min-height:400px}
    .preview-iframe{width:100%;height:70vh;border:none}
    .preview-image{max-width:100%;max-height:70vh;object-fit:contain}
    .preview-unsupported{text-align:center;padding:40px;color:#6c757d}
    .preview-unsupported i{font-size:48px;margin-bottom:15px;color:#FB8C00}
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
    
    /* ============================================
       STYLE BARU UNTUK REJECT MODAL YANG LEBIH BAGUS
    ============================================ */
    .reject-modal .modal-content {
        max-width: 550px;
        width: 95%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(231, 76, 60, 0.15);
    }
    
    .reject-modal .modal-header {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        padding: 20px 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .reject-modal .modal-header h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .reject-modal .modal-header h3 i {
        font-size: 20px;
    }
    
    .reject-modal .modal-body {
        padding: 25px;
    }
    
    /* Warning Box */
    .warning-box {
        background: #fff5f5;
        border: 1px solid #f8cccc;
        border-left: 4px solid #e74c3c;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 25px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    
    .warning-icon {
        color: #e74c3c;
        font-size: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .warning-content {
        flex: 1;
    }
    
    .warning-title {
        font-weight: 600;
        color: #721c24;
        margin-bottom: 5px;
        font-size: 15px;
    }
    
    .warning-text {
        color: #721c24;
        font-size: 14px;
        line-height: 1.5;
    }
    
    .reject-item-highlight {
        background: #fff9f9;
        border: 1px solid #ffe6e6;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .reject-item-name {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .reject-item-id {
        font-size: 13px;
        color: #7f8c8d;
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 4px;
        display: inline-block;
    }
    
    /* Form Area */
    .reject-form-group {
        margin-bottom: 25px;
    }
    
    .reject-form-label {
        display: block;
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .reject-form-label i {
        color: #6c757d;
        font-size: 14px;
    }
    
    /* Textarea yang lebih baik - DIHAPUS BATASAN KATA */
    .reject-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-family: inherit;
        font-size: 14px;
        line-height: 1.5;
        resize: vertical;
        min-height: 120px;
        transition: all 0.3s ease;
        background: #fdfdfd;
        color: #495057;
    }
    
    .reject-textarea:focus {
        outline: none;
        border-color: #e74c3c;
        background: white;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.15);
    }
    
    .reject-textarea::placeholder {
        color: #adb5bd;
        font-style: italic;
    }
    
    /* Action Buttons untuk reject modal */
    .reject-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }
    
    .reject-btn-cancel {
        padding: 12px 24px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #495057;
    }
    
    .reject-btn-cancel:hover {
        background: #f8f9fa;
        border-color: #adb5bd;
        transform: translateY(-1px);
    }
    
    .reject-btn-submit {
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        box-shadow: 0 2px 6px rgba(231, 76, 60, 0.3);
    }
    
    .reject-btn-submit:hover {
        background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(231, 76, 60, 0.4);
    }
    
    .reject-btn-submit:active {
        transform: translateY(0);
        box-shadow: 0 1px 3px rgba(231, 76, 60, 0.3);
    }
    
    /* Info box */
    .info-box {
        background: #e8f4f8;
        border: 1px solid #c5e4f2;
        border-radius: 8px;
        padding: 12px 15px;
        margin-top: 15px;
        font-size: 13px;
        color: #2c3e50;
        line-height: 1.5;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    
    .info-box i {
        color: #3498db;
        font-size: 14px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    /* ============================================
       STYLE UNTUK MULTI SELECT (BULK ACTIONS)
    ============================================ */
    .select-checkbox {
        cursor: pointer;
        width: 18px;
        height: 18px;
        accent-color: #FB8C00;
    }

    .select-checkbox:focus {
        outline: 2px solid #FB8C00;
        outline-offset: 2px;
    }

    /* Style untuk row yang dipilih */
    tr.clickable-row.selected {
        background-color: rgba(251, 140, 0, 0.1) !important;
        box-shadow: inset 3px 0 0 #FB8C00;
    }

    /* Style untuk checkbox di dalam row yang dipilih */
    tr.clickable-row.selected .row-checkbox {
        accent-color: #FB8C00;
    }

    /* Bulk Action Toolbar */
    .bulk-action-toolbar {
        background: linear-gradient(135deg, #fef9e7 0%, #fdebd0 100%);
        border: 1px solid #FB8C00;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 15px;
        align-items: center;
        gap: 15px;
        animation: slideDown 0.3s ease;
        box-shadow: 0 2px 8px rgba(251, 140, 0, 0.1);
        display: none;
        flex-wrap: wrap;
    }

    .bulk-action-toolbar.show {
        display: flex;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .selected-count {
        font-weight: 600;
        color: #FB8C00;
        background: white;
        padding: 6px 12px;
        border-radius: 20px;
        border: 1px solid #FB8C00;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .bulk-btn {
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .bulk-approve {
        background: #27ae60;
        color: white;
    }

    .bulk-approve:hover {
        background: #229954;
        transform: translateY(-1px);
    }

    .bulk-reject {
        background: #e74c3c;
        color: white;
    }

    .bulk-reject:hover {
        background: #c0392b;
        transform: translateY(-1px);
    }

    .bulk-clear {
        background: #95a5a6;
        color: white;
    }

    .bulk-clear:hover {
        background: #7f8c8d;
        transform: translateY(-1px);
    }

    /* Select all checkbox */
    .select-all-container {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
        padding: 10px 15px;
        background: #fef9e7;
        border-radius: 8px;
        border: 1px solid #FB8C00;
    }

    /* Search Box Styles */
    .search-container{margin-bottom:20px}
    .search-label{display:block;margin-bottom:8px;color:#6c757d;font-size:14px;font-weight:500}
    .search-box{display:flex;gap:10px;align-items:center;width:100%}
    .search-input-wrapper{position:relative;flex:1}
    .search-input{width:100%;padding:12px 45px 12px 15px;border:1px solid #e9ecef;border-radius:8px;font-size:14px;transition:all 0.3s;background:white;color:#495057}
    .search-input:focus{outline:none;border-color:#FB8C00;box-shadow:0 0 0 2px rgba(251,140,0,0.1)}
    .search-input::placeholder{color:#6c757d}
    .search-icon{position:absolute;right:15px;top:50%;transform:translateY(-50%);color:#6c757d;font-size:16px}
    .btn-cari{padding:12px 24px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;background:#FB8C00;color:#fff;white-space:nowrap}
    .btn-cari:hover{background:#e67e22;transform:translateY(-1px)}
    .btn-reset{padding:12px 24px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;background:#95a5a6;color:#fff;white-space:nowrap;text-decoration:none}
    .btn-reset:hover{background:#7f8c8d;transform:translateY(-1px);color:white;text-decoration:none}
    
    /* Bulk Modal Styles */
    .bulk-modal-content {
        background: white;
        padding: 0;
        border-radius: 15px;
        max-width: 600px;
        width: 95%;
        max-height: 85vh;
        overflow: hidden;
        animation: slideIn 0.3s ease;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    
    /* Bulk reject modal specific styles */
    .bulk-reject-modal-content {
        background: white;
        padding: 0;
        border-radius: 15px;
        max-width: 600px;
        width: 95%;
        max-height: 85vh;
        overflow: hidden;
        animation: slideIn 0.3s ease;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .bulk-reject-body {
        padding: 25px;
        max-height: 60vh;
        overflow-y: auto;
    }

    .bulk-item {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 12px;
    }

    .bulk-item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .bulk-item-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
    }

    .bulk-item-details {
        font-size: 12px;
        color: #7f8c8d;
    }

    .bulk-reject-textarea {
        width: 100%;
        padding: 10px 12px;
        border: 2px solid #f8cccc;
        border-radius: 6px;
        font-family: inherit;
        font-size: 13px;
        resize: vertical;
        min-height: 80px;
        margin-top: 8px;
    }

    .bulk-reject-textarea:focus {
        outline: none;
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
    }

    /* Success modal untuk bulk actions */
    .success-modal-content {
        background: white;
        padding: 0;
        border-radius: 15px;
        max-width: 500px;
        width: 95%;
        animation: slideIn 0.3s ease;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .success-modal-header {
        background: #27ae60;
        color: white;
        padding: 20px 25px;
        border-radius: 15px 15px 0 0;
        text-align: center;
    }

    .success-modal-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .success-modal-body {
        padding: 25px;
        text-align: center;
    }

    .success-icon {
        font-size: 48px;
        color: #27ae60;
        margin-bottom: 15px;
    }

    .success-items {
        margin-top: 20px;
        text-align: left;
        max-height: 200px;
        overflow-y: auto;
    }

    .success-item {
        padding: 8px 12px;
        border-bottom: 1px solid #eee;
        font-size: 13px;
    }

    .success-item:last-child {
        border-bottom: none;
    }
    
    /* Responsive */
    @media (max-width:1400px) {
        .surat-modal .modal-content {
            max-width: 95% !important;
            min-width: auto !important;
        }
    }
    
    @media (max-width:768px){
        .detail-grid{grid-template-columns:1fr}
        .modal-content{width:95%;margin:10px}
        .detail-content{padding:20px}
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
        .bulk-action-toolbar {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .bulk-btn {
            width: 100%;
            justify-content: center;
        }
        
        .selected-count {
            width: 100%;
            justify-content: center;
        }
        
        .search-box{flex-direction:column}
        
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
        
        /* Reject modal responsive */
        .reject-modal .modal-content {
            max-width: 95%;
            margin: 10px;
        }
        
        .reject-modal-actions {
            flex-direction: column;
        }
        
        .reject-btn-cancel, .reject-btn-submit {
            width: 100%;
            justify-content: center;
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
        
        /* Reject modal di mobile */
        .reject-modal .modal-body {
            padding: 20px;
        }
        
        .warning-box {
            padding: 12px 15px;
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
    <h2><i class="fa-solid fa-university"></i> Dashboard Dekan</h2>
    <div></div>
</div>

<div class="container">
    <!-- Tombol Kembali -->
    <a href="<?= base_url('dekan') ?>" class="back-btn">
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

    <!-- Tabel Pengajuan Menunggu -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Pengajuan Menunggu Persetujuan</h3>
            <div>
                <span id="filterInfo" style="color:#7f8c8d;font-size:13px">
                    Menampilkan: Semua Data (<?= isset($total_surat) ? $total_surat : '0' ?>)
                </span>
            </div>
        </div>
        
        <!-- Toolbar Aksi Massal -->
        <div id="bulkActionToolbar" class="bulk-action-toolbar">
            <div class="selected-count">
                <i class="fa-solid fa-check-circle"></i>
                <span id="selectedCount">0</span> dipilih
            </div>
            <button class="bulk-btn bulk-approve" onclick="showBulkApproveModal()">
                <i class="fa-solid fa-check"></i> Setujui yang Dipilih
            </button>
            <button class="bulk-btn bulk-reject" onclick="showBulkRejectModal()">
                <i class="fa-solid fa-times"></i> Tolak yang Dipilih
            </button>
            <button class="bulk-btn bulk-clear" onclick="clearAllSelection()">
                <i class="fa-solid fa-times-circle"></i> Hapus Pilihan
            </button>
        </div>

        <!-- Checkbox Select All -->
        <div class="select-all-container">
            <input type="checkbox" id="selectAll" class="select-checkbox" onchange="toggleSelectAll(this)">
            <label for="selectAll" style="font-weight:600;color:#2c3e50;cursor:pointer">
                Pilih Semua
            </label>
            <span style="margin-left:auto;font-size:13px;color:#7f8c8d">
                <i class="fa-solid fa-info-circle"></i> Centang untuk memilih beberapa pengajuan
            </span>
        </div>
        
        <!-- Search Box -->
        <div class="search-container">
            <label class="search-label">Cari berdasarkan nama kegiatan, penyelenggara, atau jenis pengajuan...</label>
            <div class="search-box">
                <div class="search-input-wrapper">
                    <input 
                        type="text" 
                        id="searchInput"
                        class="search-input"
                        placeholder="Ketik untuk mencari..."
                        value="<?= $this->input->get('search') ?>"
                    >
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <button type="button" class="btn-cari" onclick="handleSearch()">
                    <i class="fa-solid fa-search"></i> Cari
                </button>
                
                <?php if($this->input->get('search')): ?>
                <a href="<?= base_url('dekan/halaman_pending') ?>" class="btn-reset">
                    <i class="fa-solid fa-refresh"></i> Reset
                </a>
                <?php endif; ?>
            </div>
        </div>
        
        <div style="overflow-x:auto">
            <table>
                <thead>
                <tr>
                    <th style="width:40px">
                        <input type="checkbox" id="selectAllHeader" class="select-checkbox" onclick="handleSelectAllHeader(this)">
                        </th>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Penyelenggara</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php 
                    if (isset($surat_list) && is_array($surat_list) && count($surat_list) > 0): 
                        $i = 1; 
                        foreach ($surat_list as $s): 
                            // Format tanggal
                            $tgl_pengajuan = isset($s['created_at']) && $s['created_at'] ? date('d M Y', strtotime($s['created_at'])) : '-';
                            $tgl_kegiatan = isset($s['tanggal_kegiatan']) && $s['tanggal_kegiatan'] ? date('d M Y', strtotime($s['tanggal_kegiatan'])) : '-';
                    ?>
                    <tr onclick="showRowDetail(<?= $s['id'] ?>)" style="cursor: pointer;" class="clickable-row" id="row-<?= $s['id'] ?>">
                       <!-- GANTI bagian checkbox di setiap baris -->
                        <td onclick="event.stopPropagation();">
                            <input type="checkbox" class="select-checkbox row-checkbox" 
                                value="<?= $s['id'] ?? 0 ?>" 
                                data-nama="<?= htmlspecialchars($s['nama_kegiatan'] ?? '') ?>"
                                data-details="<?= htmlspecialchars($tgl_kegiatan) ?> | <?= htmlspecialchars($s['penyelenggara'] ?? '') ?>"
                                onchange="toggleRowCheckbox(this)"
                                onclick="event.stopPropagation();">
                        </td>
                        <td><?= $i ?></td>
                        <td><strong><?= htmlspecialchars($s['nama_kegiatan'] ?? '-') ?></strong></td>
                        <td><?= htmlspecialchars($s['penyelenggara'] ?? '-') ?></td>
                        <td><?= $tgl_pengajuan ?></td>
                        <td><?= $tgl_kegiatan ?></td>
                        <td><?= htmlspecialchars($s['jenis_pengajuan'] ?? '-') ?></td>
                        <td>
                            <span class="badge badge-pending">
                                Menunggu
                            </span>
                        </td>
                        <td onclick="event.stopPropagation()">
                            <div style="display:flex;gap:6px">
                                <!-- Tombol Eviden Hijau -->
                                <button class="btn btn-eviden" onclick="event.stopPropagation(); handleEvidenClick(<?= $s['id'] ?? 0 ?>, '<?= htmlspecialchars($s['nama_kegiatan'] ?? '', ENT_QUOTES) ?>')" title="Lihat Eviden">
                                    <i class="fas fa-file-image"></i>
                                </button>
                                
                                <!-- PERBAIKAN: Tombol Mata untuk Preview Surat -->
                                <button class="btn btn-detail" onclick="event.stopPropagation(); showSuratModal(<?= $s['id'] ?>)" title="Lihat Surat">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                
                                <!-- Tombol Approve & Reject -->
                                <button class="btn btn-approve" onclick="event.stopPropagation(); showApproveModal(<?= (int)$s['id'] ?>, '<?= htmlspecialchars(addslashes($s['nama_kegiatan'])) ?>')" title="Setujui">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="btn btn-reject" onclick="event.stopPropagation(); showRejectModal(<?= (int)$s['id'] ?>, '<?= htmlspecialchars(addslashes($s['nama_kegiatan'])) ?>')" title="Tolak">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align:center;padding:40px;color:#7f8c8d">
                                <i class="fa-solid fa-clock" style="font-size:48px;margin-bottom:10px;display:block;opacity:0.3"></i>
                                <strong>Tidak ada pengajuan yang menunggu persetujuan</strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-info">
            <?php
            echo "Menampilkan: Semua Data (" . (isset($total_surat) ? $total_surat : '0') . " data)";
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

<!-- ============================================
   TEMPLATE REJECT MODAL TANPA BATASAN KATA
============================================ -->
<template id="rejectModalTemplate">
    <div class="modal-content reject-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-ban"></i> Konfirmasi Penolakan</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Warning Box -->
            <div class="warning-box">
                <div class="warning-icon">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                </div>
                <div class="warning-content">
                    <div class="warning-title">Anda akan menolak pengajuan ini</div>
                    <div class="warning-text">Tindakan ini tidak dapat dibatalkan. Pastikan alasan penolakan sudah jelas dan dapat diterima.</div>
                </div>
            </div>
            
            <!-- Item yang akan ditolak -->
            <div class="reject-item-highlight">
                <div class="reject-item-name" id="rejectItemName">-</div>
                <div class="reject-item-id">ID: <span id="rejectItemId">-</span></div>
            </div>
            
            <!-- Form Penolakan -->
            <form class="reject-form" method="POST" action="">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div class="reject-form-group">
                    <label class="reject-form-label">
                        <i class="fa-solid fa-comment-dots"></i>
                        Alasan Penolakan
                    </label>
                    <textarea 
                        class="reject-textarea" 
                        id="rejectReasonTextarea"
                        name="rejection_notes"
                        placeholder="Jelaskan secara detail alasan penolakan pengajuan ini..."
                        required
                    ></textarea>
                </div>
                
                <!-- Informasi tambahan -->
                <div class="info-box">
                    <i class="fa-solid fa-lightbulb"></i>
                    <div>
                        <strong>Tips:</strong> Berikan alasan yang jelas dan konstruktif. 
                        Alasan penolakan akan dikirimkan kepada pengaju dan dapat dilihat dalam riwayat pengajuan.
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="reject-modal-actions">
                    <button type="button" class="reject-btn-cancel">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="reject-btn-submit">
                        <i class="fa-solid fa-ban"></i> Konfirmasi Penolakan
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<template id="bulkApproveModalTemplate">
    <div class="modal-content approve-modal">
        <div class="modal-header">
            <h3><i class="fa-solid fa-check-circle"></i> Setujui Pengajuan Terpilih</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div style="padding:25px">
            <div class="approve-info-box">
                <strong><i class="fa-solid fa-info-circle"></i> Informasi</strong>
                <span id="bulkApproveCount">0 pengajuan</span> akan disetujui
            </div>
            
            <div id="bulkApproveItems" style="max-height:200px;overflow-y:auto;margin-bottom:20px">
                <!-- Daftar pengajuan akan diisi oleh JavaScript -->
            </div>
            
            <p style="margin-bottom:20px;color:#7f8c8d">
                <i class="fa-solid fa-exclamation-triangle"></i> 
                Apakah Anda yakin ingin menyetujui semua pengajuan yang dipilih?
            </p>
            
            <form class="bulk-approve-form" method="POST" action="<?= base_url('dekan/process_multi_approve') ?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <input type="hidden" name="selected_ids" id="bulkApproveIds">
                
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:25px;padding-top:20px;border-top:1px solid #e9ecef">
                    <button type="button" class="btn btn-cancel" style="background:#95a5a6;color:white">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-submit" style="background:#27ae60;color:white">
                        <i class="fa-solid fa-check"></i> Ya, Setujui Semua
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<template id="bulkRejectModalTemplate">
    <div class="modal-content bulk-reject-modal-content">
        <div class="modal-header" style="background:#e74c3c;">
            <h3><i class="fa-solid fa-ban"></i> Tolak Pengajuan Terpilih</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="bulk-reject-body">
            <div class="reject-info-box">
                <strong><i class="fa-solid fa-exclamation-triangle"></i> Anda akan menolak:</strong>
                <span id="bulkRejectCount">0 pengajuan</span>
            </div>
            
            <p style="margin-bottom:15px;color:#7f8c8d">
                <i class="fa-solid fa-info-circle"></i> 
                Berikan alasan penolakan untuk masing-masing pengajuan:
            </p>
            
            <form class="bulk-reject-form" method="POST" action="<?= base_url('dekan/process_multi_reject') ?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div id="bulkRejectItems">
                    <!-- Item pengajuan dengan textarea akan diisi oleh JavaScript -->
                </div>
                
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:20px;padding-top:20px;border-top:1px solid #e9ecef">
                    <button type="button" class="btn btn-cancel" style="background:#95a5a6;color:white">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-submit-reject" style="background:#e74c3c;color:white">
                        <i class="fa-solid fa-ban"></i> Ya, Tolak Semua
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<!-- Success Modal untuk Bulk Actions -->
<template id="successModalTemplate">
    <div class="modal-content success-modal-content">
        <div class="success-modal-header">
            <h3><span id="successModalTitle">Pengajuan Berhasil Disetujui</span></h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="success-modal-body">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h3 style="color:#27ae60;margin-bottom:10px" id="successMainTitle">Berhasil Disetujui</h3>
            <p style="color:#666;margin-bottom:5px">
                <i class="fa-solid fa-clock"></i> Disetujui pada: <strong id="successTimestamp">-</strong>
            </p>
            
            <div style="background:#d4edda;border:1px solid #c3e6cb;border-radius:8px;padding:15px;margin:20px 0">
                <div style="font-weight:600;color:#155724;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between">
                    <span>Daftar Pengajuan</span>
                    <span id="successItemCount" style="background:#27ae60;color:white;padding:4px 12px;border-radius:20px;font-size:12px">0 item</span>
                </div>
                <div id="successList" style="max-height:250px;overflow-y:auto;text-align:left">
                    <!-- List akan diisi oleh JavaScript -->
                </div>
            </div>
            
            <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
                <button class="bulk-btn" onclick="refreshPage()" style="background:#27ae60;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                    <i class="fa-solid fa-rotate"></i> Refresh Halaman
                </button>
                <button class="bulk-btn" onclick="modalManager.closeModal(modalManager.activeModal.id)" style="background:#6c757d;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                    <i class="fa-solid fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</template>

<script>
// ===== MULTI MODAL MANAGEMENT SYSTEM (SAMA DENGAN halaman_total.php) =====

// Global variables
let modalManager;
let currentRejectId = null;
let currentApproveId = null;
let selectedSurat = null;
let selectedItems = new Set();
let isSelectAll = false;
let currentSearchTerm = '';
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
            case 'bulk_approve':
                modalContent = this.createBulkApproveModal(data);
                break;
            case 'bulk_reject':
                modalContent = this.createBulkRejectModal(data);
                break;
            case 'success':
                modalContent = this.createSuccessModal(data);
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
            modalContent.querySelector('.approve-form').action = '<?= base_url("dekan/approve/") ?>' + data.suratId;
        }
        
        return modalContent.outerHTML;
    }

    // Create reject modal - DIUBAH: Template tanpa batasan kata
    createRejectModal(data) {
        const template = document.getElementById('rejectModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.namaKegiatan) {
            modalContent.querySelector('#rejectItemName').textContent = data.namaKegiatan;
        }
        if (data.suratId) {
            modalContent.querySelector('#rejectItemId').textContent = data.suratId;
            modalContent.querySelector('.reject-form').action = '<?= base_url("dekan/reject/") ?>' + data.suratId;
        }
        
        return modalContent.outerHTML;
    }

    // Create bulk approve modal
    createBulkApproveModal(data) {
        const template = document.getElementById('bulkApproveModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.count) {
            modalContent.querySelector('#bulkApproveCount').textContent = data.count + ' pengajuan';
        }
        if (data.ids) {
            modalContent.querySelector('#bulkApproveIds').value = data.ids;
        }
        
        // Isi daftar pengajuan
        if (data.items && modalContent.querySelector('#bulkApproveItems')) {
            const itemsContainer = modalContent.querySelector('#bulkApproveItems');
            itemsContainer.innerHTML = '';
            
            data.items.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'bulk-item';
                itemDiv.innerHTML = `
                    <div class="bulk-item-header">
                        <div class="bulk-item-name">${escapeHtml(item.nama)}</div>
                    </div>
                    <div class="bulk-item-details">${escapeHtml(item.details)}</div>
                `;
                itemsContainer.appendChild(itemDiv);
            });
        }
        
        return modalContent.outerHTML;
    }

    // Create bulk reject modal
    createBulkRejectModal(data) {
        const template = document.getElementById('bulkRejectModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.count) {
            modalContent.querySelector('#bulkRejectCount').textContent = data.count + ' pengajuan';
        }
        
        // Isi daftar pengajuan dengan textarea
        if (data.items && modalContent.querySelector('#bulkRejectItems')) {
            const itemsContainer = modalContent.querySelector('#bulkRejectItems');
            itemsContainer.innerHTML = '';
            
            data.items.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'bulk-item';
                itemDiv.innerHTML = `
                    <div class="bulk-item-header">
                        <div class="bulk-item-name">${escapeHtml(item.nama)}</div>
                    </div>
                    <div class="bulk-item-details">${escapeHtml(item.details)}</div>
                    <textarea 
                        name="rejection_notes[]" 
                        class="bulk-reject-textarea" 
                        placeholder="Masukkan alasan penolakan untuk pengajuan ini..."
                        required
                    ></textarea>
                    <input type="hidden" name="selected_ids[]" value="${item.id}">
                `;
                itemsContainer.appendChild(itemDiv);
            });
        }
        
        return modalContent.outerHTML;
    }

    // Create success modal
    createSuccessModal(data) {
        const template = document.getElementById('successModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.title) {
            modalContent.querySelector('#successModalTitle').textContent = data.title;
            modalContent.querySelector('#successMainTitle').textContent = data.title;
        }
        
        if (data.count) {
            modalContent.querySelector('#successItemCount').textContent = data.count + ' item';
        }
        
        if (data.timestamp) {
            modalContent.querySelector('#successTimestamp').textContent = data.timestamp;
        }
        
        // Isi daftar pengajuan
        if (data.items && modalContent.querySelector('#successList')) {
            const listContainer = modalContent.querySelector('#successList');
            listContainer.innerHTML = '';
            
            data.items.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'success-item';
                itemDiv.textContent = `${index + 1}. ${escapeHtml(item.nama)}`;
                listContainer.appendChild(itemDiv);
            });
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
        const cancelBtns = modalElement.querySelectorAll('.reject-btn-cancel, .btn-cancel');
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
            case 'bulk_approve':
                this.attachBulkApproveModalListeners(modalElement, modalId, data);
                break;
            case 'bulk_reject':
                this.attachBulkRejectModalListeners(modalElement, modalId, data);
                break;
            case 'success':
                // No special listeners needed for success modal
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

    // Attach reject modal listeners - DIUBAH: untuk template tanpa batasan
    attachRejectModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.reject-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const notes = form.querySelector('#rejectReasonTextarea').value.trim();
                if (!notes) { 
                    showAlert('Alasan penolakan harus diisi', 'error');
                    const textarea = form.querySelector('#rejectReasonTextarea');
                    textarea.focus();
                    textarea.style.borderColor = '#e74c3c';
                    return; 
                }
                
                // Tampilkan konfirmasi akhir
                if (confirm('Apakah Anda yakin ingin menolak pengajuan ini? Tindakan ini tidak dapat dibatalkan.')) {
                    this.submitRejectForm(form, data.suratId, notes);
                }
            });
        }
    }

    // Attach bulk approve modal listeners
    attachBulkApproveModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.bulk-approve-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Validasi
                if (selectedItems.size === 0) {
                    showAlert('Tidak ada pengajuan yang dipilih.', 'error');
                    return;
                }
                
                // Tampilkan loading
                const submitBtn = form.querySelector('.btn-submit');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
                
                // Submit form
                form.submit();
            });
        }
    }

    // Attach bulk reject modal listeners
    attachBulkRejectModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.bulk-reject-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Validasi textarea
                const textareas = form.querySelectorAll('.bulk-reject-textarea');
                let isValid = true;
                textareas.forEach(textarea => {
                    if (!textarea.value.trim()) {
                        isValid = false;
                        textarea.style.borderColor = '#e74c3c';
                        textarea.focus();
                    } else {
                        textarea.style.borderColor = '';
                    }
                });
                
                if (!isValid) {
                    showAlert('Semua alasan penolakan harus diisi.', 'error');
                    return false;
                }
                
                // Tampilkan loading
                const submitBtn = form.querySelector('.btn-submit-reject');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
                
                // Submit form
                form.submit();
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
                    <i class="fa-solid fa-spinner fa-spin" style="font-size:32px;color:#FB8C00"></i>
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
            const viewUrl = "<?= base_url('dekan/view_surat_pengajuan/') ?>" + suratId;
            currentSuratPdfUrl = "<?= base_url('dekan/download_pdf/') ?>" + suratId;
            
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
                    <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#FB8C00"></i>
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
        formToSubmit.action = '<?= base_url("dekan/reject/") ?>' + suratId;
        
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

// PERBAIKAN: Fungsi untuk menampilkan modal surat (tombol mata)
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

// Fungsi untuk menampilkan modal reject - DIUBAH: template tanpa batasan
function showRejectModal(id, namaKegiatan = '') {
    modalManager.createModal('reject', { 
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
                <i class="fas fa-spinner fa-spin" style="font-size: 48px; color: #FB8C00;"></i>
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
// FUNGSI BULK ACTIONS
// ============================================

// Fungsi untuk update selection
function updateSelection() {
    const checkboxes = document.querySelectorAll('.row-checkbox:checked');
    selectedItems.clear();
    
    checkboxes.forEach(checkbox => {
        selectedItems.add(checkbox.value);
    });
    
    const selectedCount = selectedItems.size;
    document.getElementById('selectedCount').textContent = selectedCount;
    
    // Tampilkan/sembunyikan toolbar
    const toolbar = document.getElementById('bulkActionToolbar');
    if (selectedCount > 0) {
        toolbar.classList.add('show');
    } else {
        toolbar.classList.remove('show');
    }
    
    // Update select all checkbox
    const allCheckboxes = document.querySelectorAll('.row-checkbox');
    const allChecked = allCheckboxes.length > 0 && Array.from(allCheckboxes).every(cb => cb.checked);
    document.getElementById('selectAll').checked = allChecked;
    document.getElementById('selectAllHeader').checked = allChecked;
    
    // Tambah/hapus class selected pada baris
    allCheckboxes.forEach(checkbox => {
        const row = checkbox.closest('tr');
        if (checkbox.checked) {
            row.classList.add('selected');
        } else {
            row.classList.remove('selected');
        }
    });
}

// Fungsi untuk select semua
function toggleSelectAll(checkbox) {
    const isChecked = checkbox.checked;
    const allCheckboxes = document.querySelectorAll('.row-checkbox');
    
    allCheckboxes.forEach(cb => {
        cb.checked = isChecked;
    });
    
    updateSelection();
}

// Fungsi untuk select semua dari header
function handleSelectAllHeader(checkbox) {
    const isChecked = checkbox.checked;
    const allCheckboxes = document.querySelectorAll('.row-checkbox');
    
    allCheckboxes.forEach(cb => {
        cb.checked = isChecked;
    });
    
    document.getElementById('selectAll').checked = isChecked;
    updateSelection();
}

// Fungsi untuk toggle individual checkbox
function toggleRowCheckbox(checkbox) {
    updateSelection();
}

// Fungsi untuk clear semua selection
function clearAllSelection() {
    const allCheckboxes = document.querySelectorAll('.row-checkbox');
    allCheckboxes.forEach(cb => {
        cb.checked = false;
    });
    updateSelection();
}

// Fungsi untuk menampilkan modal bulk approve
function showBulkApproveModal() {
    const selectedCount = selectedItems.size;
    if (selectedCount === 0) {
        showAlert('Pilih setidaknya satu pengajuan untuk disetujui.', 'warning');
        return;
    }
    
    // Kumpulkan data items
    const items = [];
    selectedItems.forEach(id => {
        const checkbox = document.querySelector(`.row-checkbox[value="${id}"]`);
        if (checkbox) {
            items.push({
                id: id,
                nama: checkbox.dataset.nama || 'Tanpa Nama',
                details: checkbox.dataset.details || ''
            });
        }
    });
    
    modalManager.createModal('bulk_approve', { 
        count: selectedCount,
        ids: Array.from(selectedItems).join(','),
        items: items
    });
}

// Fungsi untuk menampilkan modal bulk reject
function showBulkRejectModal() {
    const selectedCount = selectedItems.size;
    if (selectedCount === 0) {
        showAlert('Pilih setidaknya satu pengajuan untuk ditolak.', 'warning');
        return;
    }
    
    // Kumpulkan data items
    const items = [];
    selectedItems.forEach(id => {
        const checkbox = document.querySelector(`.row-checkbox[value="${id}"]`);
        if (checkbox) {
            items.push({
                id: id,
                nama: checkbox.dataset.nama || 'Tanpa Nama',
                details: checkbox.dataset.details || ''
            });
        }
    });
    
    modalManager.createModal('bulk_reject', { 
        count: selectedCount,
        items: items
    });
}

// Fungsi untuk refresh halaman
function refreshPage() {
    window.location.reload();
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

// Fungsi untuk toggle fullscreen
function toggleFullscreen() {
    const iframe = document.querySelector('.surat-iframe');
    if (iframe) {
        toggleIframeFullscreen(iframe);
    }
}

// ============================================
// FUNGSI HELPER
// ============================================

// PERBAIKAN: Fungsi untuk mengambil data detail via AJAX
function getSuratDetail(id) {
    return fetch('<?= site_url("dekan/getDetailPengajuan/") ?>' + id)
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
                <div class="dosen-avatar" style="width: 45px; height: 45px; border-radius: 50%; background: #FB8C00; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; font-weight: 600; overflow: hidden; position: relative; flex-shrink: 0;">
                    ${hasFoto ? `
                        <img src="${escapeHtml(foto)}" 
                             alt="${escapeHtml(dosen.nama)}" 
                             style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 2;"
                             onerror="console.error('Image load error:', this.src); this.style.display='none'; this.parentElement.style.background='#FB8C00';">
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
            <div class="dosen-avatar" style="width: 45px; height: 45px; border-radius: 50%; background: #FB8C00; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; font-weight: 600;">
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
        <div style="background:#fef9e7;border:2px solid #FB8C00;border-radius:10px;padding:15px;margin-bottom:20px;text-align:center">
            <div style="font-size:14px;font-weight:600;color:#FB8C00;margin-bottom:5px;text-transform:uppercase;letter-spacing:1px">
                <i class="fa-solid fa-file-signature"></i> Nomor Surat
            </div>
            <div style="font-size:18px;font-weight:700;color:#E67E22;font-family:'Courier New',monospace">
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
        ${getVal('status') === 'disetujui sekretariat' ? `
<div style="display:flex;gap:10px;margin-left:auto">
    <button class="modal-btn modal-btn-reject" onclick="event.stopPropagation(); modalManager.closeModal('${currentModalId}'); showRejectModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
        <i class="fa-solid fa-times"></i> Tolak
    </button>
    <button class="modal-btn modal-btn-approve" onclick="event.stopPropagation(); modalManager.closeModal('${currentModalId}'); showApproveModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
        <i class="fa-solid fa-check"></i> Setujui
    </button>
</div>
` : ''}
    </div>`;
}

// ============================================
// SEARCH FUNCTIONALITY
// ============================================

function handleSearch() {
    const searchInput = document.getElementById('searchInput');
    currentSearchTerm = searchInput.value.toLowerCase();
    applyFilters();
}

function applyFilters() {
    const rows = document.querySelectorAll('#tableBody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        if (row.cells.length < 9) return; // Skip empty row
        
        const text = row.textContent.toLowerCase();
        
        let matchesSearch = true;
        
        // Filter by search
        if (currentSearchTerm && !text.includes(currentSearchTerm)) {
            matchesSearch = false;
        }
        
        if (matchesSearch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update pagination info
    updatePaginationInfo(visibleCount);
}

function updatePaginationInfo(visibleCount) {
    const paginationInfo = document.querySelector('.pagination-info');
    const filterInfo = document.getElementById('filterInfo');
    
    if (paginationInfo && filterInfo) {
        if (currentSearchTerm) {
            paginationInfo.textContent = `Menampilkan: ${visibleCount} data (difilter)`;
            filterInfo.textContent = `Menampilkan: ${visibleCount} data (difilter)`;
        } else {
            paginationInfo.textContent = `Menampilkan: Semua Data (${visibleCount} data)`;
            filterInfo.textContent = `Menampilkan: Semua Data (${visibleCount})`;
        }
    }
}

// ============================================
// HELPER FUNCTIONS
// ============================================

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
// INISIALISASI SETELAH DOM LOADED
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize modal manager
    modalManager = new ModalManager();
    
    // Apply filters
    applyFilters();
    
    // Enter key support for search
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            handleSearch();
        }
    });
    
    // Auto reset when input is cleared
    document.getElementById('searchInput').addEventListener('input', function(e) {
        if (e.target.value === '') {
            currentSearchTerm = '';
            applyFilters();
        }
    });
    
    // Check if there's success data from session
    <?php if($this->session->flashdata('approved_items')): ?>
        const approvedItems = <?= json_encode($this->session->flashdata('approved_items')) ?>;
        const isSingle = <?= json_encode($this->session->flashdata('is_single_approve')) ?>;
        setTimeout(function() {
            // Tampilkan success modal
            const now = new Date();
            const timestamp = now.toLocaleDateString('id-ID', { 
                day: '2-digit', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }) + ' WIB';
            
            modalManager.createModal('success', {
                title: isSingle ? 'Pengajuan Berhasil Disetujui' : 'Pengajuan Berhasil Disetujui (Multiple)',
                count: approvedItems.length,
                timestamp: timestamp,
                items: approvedItems.map(item => ({ nama: item.nama }))
            });
        }, 500);
    <?php endif; ?>
    
    // Check for success reject modal data
    <?php if($this->session->flashdata('rejected_items')): ?>
        const rejectedItems = <?= json_encode($this->session->flashdata('rejected_items')) ?>;
        const isSingleReject = <?= json_encode($this->session->flashdata('is_single_reject')) ?>;
        setTimeout(function() {
            // Tampilkan success modal untuk reject
            const now = new Date();
            const timestamp = now.toLocaleDateString('id-ID', { 
                day: '2-digit', 
                month: 'long', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }) + ' WIB';
            
            modalManager.createModal('success', {
                title: isSingleReject ? 'Pengajuan Berhasil Ditolak' : 'Pengajuan Berhasil Ditolak (Multiple)',
                count: rejectedItems.length,
                timestamp: timestamp,
                items: rejectedItems.map(item => ({ nama: item.nama }))
            });
        }, 500);
    <?php endif; ?>
    
    // Inisialisasi toolbar bulk actions
    const toolbar = document.getElementById('bulkActionToolbar');
    if (toolbar) {
        toolbar.classList.remove('show');
    }
    
    // Inisialisasi selectedItems
    if (typeof selectedItems === 'undefined') {
        selectedItems = new Set();
    }
});

// ============================================
// EVENT LISTENER TAMBAHAN UNTUK MENCEGAH SELECTION
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