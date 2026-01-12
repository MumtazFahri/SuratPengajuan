<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Disetujui - Dashboard Dekan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* ============================================
           STYLE DASAR (SAMA SEPERTI halaman_total.php)
        ============================================ */
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
        .badge-pending{background:#fff3cd;color:#856404}
        .badge-approved{background:#d4edda;color:#155724}
        .badge-rejected{background:#f8d7da;color:#721c24}
        .badge-sekretariat{background:#d1ecf1;color:#0c5460}
        .btn{padding:6px 10px;border-radius:6px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s}
        .btn:hover{transform:scale(1.05)}
        
        /* ============================================
           TOMBOL AKSI (SAMA SEPERTI TOTAL)
        ============================================ */
        .btn-detail{background:#3498db;color:#fff}
        .btn-detail:hover{background:#2980b9}
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
        .btn-eviden i {font-size:14px}
        .btn-eviden:hover {background:#218838 !important;transform:scale(1.05)}
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
        }
        .btn-return i {font-size:14px}
        .btn-return:hover {background:#f57c00 !important;transform:scale(1.05)}
        
        /* ============================================
           SEARCH BOX STYLES
        ============================================ */
        .search-container{margin-bottom:20px}
        .search-label{display:block;margin-bottom:8px;color:#6c757d;font-size:14px;font-weight:500}
        .search-box{display:flex;gap:10px;align-items:center;width:100%}
        .search-input-wrapper{position:relative;flex:1}
        .search-input{width:100%;padding:12px 45px 12px 15px;border:1px solid #e9ecef;border-radius:8px;font-size:14px;transition:all 0.3s;background:white;color:#495057}
        .search-input:focus{outline:none;border-color:#8E44AD;box-shadow:0 0 0 2px rgba(142,68,173,0.1)}
        .search-input::placeholder{color:#6c757d}
        .search-icon{position:absolute;right:15px;top:50%;transform:translateY(-50%);color:#6c757d;font-size:16px}
        .btn-cari{padding:12px 24px;border-radius:8px;border:0;cursor:pointer;font-weight:600;transition:all 0.2s;display:inline-flex;align-items:center;gap:8px;background:#8E44AD;color:#fff;white-space:nowrap}
        .btn-cari:hover{background:#7D3C98;transform:translateY(-1px)}
        .back-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#8E44AD;color:white;text-decoration:none;border-radius:8px;font-weight:600;transition:all 0.3s;margin-bottom:20px}
        .back-btn:hover{background:#7D3C98;transform:translateY(-2px)}
        
        /* ============================================
           MULTI MODAL STYLES (SAMA SEPERTI TOTAL)
        ============================================ */
        /* Clickable Row Styles */
        .clickable-row {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .clickable-row:hover {
            background-color: #f5eef8 !important;
            box-shadow: inset 0 0 0 2px #8E44AD;
        }
        .clickable-row:active {
            background-color: #e8daef !important;
            transform: scale(0.995);
        }
        
        /* Modal Stack Container - MAKSIMAL 2 MODAL */
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
        .modal-item:nth-child(1) {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1051;
        }
        .modal-item:nth-child(2) {
            top: 50px;
            right: 50px;
            transform: none;
            z-index: 1052;
        }
        .modal-item.active {z-index:1053}
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
        .modal-item.new {animation:modalAppear 0.3s ease}
        @keyframes modalAppear {
            from {opacity:0;transform:scale(0.9) translateY(-20px)}
            to {opacity:1;transform:scale(1) translateY(0)}
        }
        .modal-item.removing {animation:modalDisappear 0.3s ease}
        @keyframes modalDisappear {
            from {opacity:1;transform:scale(1)}
            to {opacity:0;transform:scale(0.9) translateY(20px)}
        }
        
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
        body.modal-open {overflow:auto !important}
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
        .modal-close-btn:hover {background:rgba(0,0,0,0.2)}
        
        /* Detail Modal Styles */
        .detail-modal .modal-content {
            max-width: 1100px !important;
            width: 95% !important;
            max-height: 90vh !important;
        }
        .modal-content{background:white;padding:0;border-radius:15px;animation:slideIn 0.3s ease;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
        @keyframes slideIn{from{transform:translateY(-50px);opacity:0}to{transform:translateY(0);opacity:1}}
        .modal-header{background:#8E44AD;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
        .modal-header h3{margin:0;font-size:20px;font-weight:600}
        .close-modal{background:none;border:0;color:white;font-size:28px;cursor:pointer;width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
        .close-modal:hover{background:rgba(255,255,255,0.2)}
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
        .dosen-avatar-initial {position:relative;z-index:1}
        .dosen-info {flex:1}
        .dosen-name {font-weight:600;color:#212529;font-size:16px;margin-bottom:4px}
        .dosen-details {font-size:13px;color:#6c757d;line-height:1.4}
        
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
        .modal-btn-return{background:#ff9800;color:white}
        .modal-btn-return:hover{background:#f57c00;transform:translateY(-2px)}
        
        /* Rejection Notes Styles */
        .rejection-notes{background:#fff5f5;border:1px solid #f8d7da;border-radius:8px;padding:25px;margin-top:20px}
        .rejection-notes .detail-label{color:#dc3545;font-weight:700;font-size:16px}
        .rejection-notes .detail-value{background:#fff5f5;border-color:#f8d7da;color:#721c24;font-size:15px;line-height:1.6;min-height:auto;padding:15px;border-radius:6px}
        
        /* Surat Modal Styles - LEBAR BESAR */
        .surat-modal .modal-content {
            max-width: 1400px !important;
            width: 98% !important;
            max-height: 95vh !important;
            min-width: 1000px;
        }
        .surat-preview-container {
            width: 100%;
            height: calc(95vh - 150px);
            display: flex;
            flex-direction: column;
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
        }
        .surat-preview-header {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }
        .surat-toolbar {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .surat-iframe {
            width: 100%;
            height: 100%;
            border: none;
            flex: 1;
            background: white;
        }
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
            background: #8E44AD;
            color: white;
        }
        .surat-btn-download:hover {
            background: #7D3C98;
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
        .surat-iframe.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background: white;
        }
        
        /* Return Modal Styles */
        .return-modal .modal-content {
            max-width: 600px;
            width: 95%;
            max-height: 85vh;
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
            from {transform:translateX(100%);opacity:0}
            to {transform:translateX(0);opacity:1}
        }
        .alert-icon {font-size:20px;color:#721c24}
        .alert-content {flex:1}
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
        .alert-close:hover {background:rgba(0,0,0,0.1)}
        
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
            .modal-actions{flex-direction:column}
            .modal-btn{justify-content:center;width:100%}
            .file-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .file-info {width:100%}
            .preview-btn, .download-btn {
                width: 100%;
                margin-left: 0;
                margin-top: 8px;
                justify-content: center;
            }
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
            .clickable-row td:last-child {border-bottom:none}
            .surat-preview-container {height:calc(85vh - 150px)}
            .surat-toolbar {flex-wrap:wrap;justify-content:center}
            .surat-btn {padding:8px 15px;font-size:13px}
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
            .detail-modal .modal-content,
            .surat-modal .modal-content {
                max-width: 95% !important;
                width: 95% !important;
            }
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
            .alert-modal {
                left: 10px;
                right: 10px;
                top: 10px;
                max-width: calc(100% - 20px);
            }
        }
        
        /* Pagination Info */
        .pagination-info{margin-top:15px;color:#7f8c8d;font-size:14px;text-align:right}
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
    </style>
</head>
<body>

<div class="navbar">
    <h2><i class="fa-solid fa-user-tie"></i> Dashboard Dekan</h2>
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

    <!-- Tabel Pengajuan Disetujui -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Pengajuan Disetujui</h3>
            <div>
                <span id="filterInfo" style="color:#7f8c8d;font-size:13px">
                    <?php
                    $total_data = isset($total_surat) ? $total_surat : (isset($surat_list) ? count($surat_list) : (isset($data_pengajuan) ? count($data_pengajuan) : '0'));
                    echo "Menampilkan: Semua Data (" . $total_data . " data)";
                    ?>
                </span>
            </div>
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
                        value="<?= htmlspecialchars($this->input->get('search') ?? '') ?>"
                    >
                    <div class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <button type="button" class="btn-cari" onclick="handleSearch()">
                    <i class="fa-solid fa-search"></i> Cari
                </button>
            </div>
        </div>
        
        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
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
                            $st_raw = isset($s['status']) ? trim($s['status']) : '';
                            $st_l = strtolower($st_raw);
                            
                            if ($st_l === 'disetujui sekretariat') {
                                $badge = '<span class="badge badge-sekretariat">Disetujui Sekretariat</span>';
                            } elseif ($st_l === 'disetujui dekan') {
                                $badge = '<span class="badge badge-approved">Disetujui Dekan</span>';
                            } else {
                                $badge = '<span class="badge badge-approved">Disetujui</span>';
                            }
                            
                            $tgl_pengajuan = isset($s['created_at']) && $s['created_at'] ? date('d M Y', strtotime($s['created_at'])) : '-';
                            $tgl_kegiatan = isset($s['tanggal_kegiatan']) && $s['tanggal_kegiatan'] ? date('d M Y', strtotime($s['tanggal_kegiatan'])) : '-';
                    ?>
                    <tr data-id="<?= (int)$s['id'] ?>" style="cursor: pointer;" class="clickable-row" data-search="<?= htmlspecialchars(strtolower(($s['nama_kegiatan'] ?? '') . ' ' . ($s['penyelenggara'] ?? '') . ' ' . ($s['jenis_pengajuan'] ?? ''))) ?>">
                        <td><?= $i ?></td>
                        <td><strong><?= htmlspecialchars($s['nama_kegiatan'] ?? '-') ?></strong></td>
                        <td><?= htmlspecialchars($s['penyelenggara'] ?? '-') ?></td>
                        <td><?= $tgl_pengajuan ?></td>
                        <td><?= $tgl_kegiatan ?></td>
                        <td><?= htmlspecialchars($s['jenis_pengajuan'] ?? '-') ?></td>
                        <td><?= $badge ?></td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <!-- Tombol Eviden -->
                                <button class="btn btn-eviden" onclick="event.stopPropagation(); handleEvidenClick(<?= (int)$s['id'] ?>)" title="Lihat Eviden">
                                    <i class="fas fa-file-image"></i>
                                </button>

                                <!-- Tombol Mata (Surat Tugas) -->
                                <button class="btn btn-detail" onclick="event.stopPropagation(); showSuratModal(<?= (int)$s['id'] ?>)" title="Lihat Surat Tugas">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                
                                <!-- Tombol Return -->
                                <?php if(in_array($s['status'], ['disetujui dekan', 'ditolak dekan'])): ?>
                                    <button class="btn btn-return" onclick="event.stopPropagation(); showReturnModalNew(<?= $s['id'] ?>, '<?= htmlspecialchars(addslashes($s['nama_kegiatan'] ?? '')) ?>')" title="Kembalikan Pengajuan">
                                        <i class="fa-solid fa-undo"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <!-- Data statis fallback -->
                        <?php if(isset($data_pengajuan) && is_array($data_pengajuan)): ?>
                            <?php $i = 1; foreach($data_pengajuan as $s): ?>
                            <tr data-id="<?= (int)$s['id'] ?>" style="cursor: pointer;" class="clickable-row" data-search="<?= htmlspecialchars(strtolower(($s['nama_kegiatan'] ?? '') . ' ' . ($s['penyelenggara'] ?? '') . ' ' . ($s['jenis_pengajuan'] ?? ''))) ?>">
                                <td><?= $i ?></td>
                                <td><strong><?= htmlspecialchars($s['nama_kegiatan'] ?? '-') ?></strong></td>
                                <td><?= htmlspecialchars($s['penyelenggara'] ?? '-') ?></td>
                                <td><?= isset($s['created_at']) ? date('d M Y', strtotime($s['created_at'])) : '-' ?></td>
                                <td><?= isset($s['tanggal_kegiatan']) ? date('d M Y', strtotime($s['tanggal_kegiatan'])) : '-' ?></td>
                                <td><?= htmlspecialchars($s['jenis_pengajuan'] ?? '-') ?></td>
                                <td>
                                    <span class="badge badge-approved">Disetujui Dekan</span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px">
                                        <button class="btn btn-eviden" onclick="event.stopPropagation(); handleEvidenClick(<?= (int)$s['id'] ?>)" title="Lihat Eviden">
                                            <i class="fas fa-file-image"></i>
                                        </button>
                                        <button class="btn btn-detail" onclick="event.stopPropagation(); showSuratModal(<?= (int)$s['id'] ?>)" title="Lihat Surat Tugas">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button class="btn btn-return" onclick="event.stopPropagation(); showReturnModalNew(<?= $s['id'] ?>, '<?= htmlspecialchars(addslashes($s['nama_kegiatan'] ?? '')) ?>')" title="Kembalikan Pengajuan">
                                            <i class="fa-solid fa-undo"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" style="text-align:center;padding:40px;color:#7f8c8d">
                                    <i class="fa-solid fa-check-circle" style="font-size:48px;margin-bottom:10px;display:block;opacity:0.3"></i>
                                    <strong>
                                        Belum ada pengajuan yang disetujui
                                    </strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-info">
            <span id="paginationText">
                <?php
                $total_data = isset($total_surat) ? $total_surat : (isset($surat_list) ? count($surat_list) : (isset($data_pengajuan) ? count($data_pengajuan) : '0'));
                $search_term = $this->input->get('search') ?? '';
                
                if($search_term) {
                    echo "Menampilkan hasil pencarian untuk: \"" . htmlspecialchars($search_term) . "\" (" . $total_data . " data)";
                } else {
                    echo "Menampilkan: Semua Data (" . $total_data . " data)";
                }
                ?>
            </span>
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

<script>
// ===== MULTI MODAL MANAGEMENT SYSTEM =====

// Global variables
let modalManager;
let currentReturnId = null;
let currentReturnNamaKegiatan = null;
let currentSuratPdfUrl = '';
let isFullscreen = false;

// Fungsi untuk menampilkan alert
function showAlert(message, type = 'warning') {
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
    
    alert.querySelector('.alert-close').addEventListener('click', () => {
        alert.remove();
    });
    
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

    createModal(type, data = {}) {
        if (this.modals.length >= 2) {
            showAlert('Maksimal hanya dapat membuka 2 modal sekaligus. Tutup salah satu modal terlebih dahulu.', 'warning');
            return null;
        }
        
        const modalId = `modal_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
        const modalItem = document.createElement('div');
        modalItem.className = 'modal-item';
        modalItem.id = modalId;
        modalItem.style.zIndex = this.modalZIndex++;
        
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
            case 'return':
                modalContent = this.createReturnModal(data);
                break;
            default:
                modalContent = this.createGenericModal(data);
        }
        
        modalItem.innerHTML = modalContent;
        this.modalStack.appendChild(modalItem);
        
        const modalNumber = this.modals.length + 1;
        const numberBadge = document.createElement('div');
        numberBadge.className = 'modal-number-badge';
        numberBadge.textContent = modalNumber;
        modalItem.appendChild(numberBadge);
        
        const modalObj = {
            id: modalId,
            type: type,
            element: modalItem,
            data: data,
            number: modalNumber
        };
        
        this.modals.push(modalObj);
        this.setActiveModal(modalId);
        
        this.updateModalPositions();
        this.attachEventListeners(modalItem, modalId, type, data);
        
        setTimeout(() => {
            modalItem.classList.add('active', 'new');
            setTimeout(() => modalItem.classList.remove('new'), 300);
        }, 10);
        
        document.body.classList.add('modal-open');
        
        return modalId;
    }

    updateModalPositions() {
        this.modals.forEach((modal, index) => {
            const modalElement = modal.element;
            const numberBadge = modalElement.querySelector('.modal-number-badge');
            
            if (numberBadge) {
                numberBadge.textContent = index + 1;
            }
            
            modalElement.style.transform = 'none';
            
            if (this.modals.length === 1) {
                modalElement.style.top = '50%';
                modalElement.style.left = '50%';
                modalElement.style.transform = 'translate(-50%, -50%)';
            } else if (this.modals.length === 2) {
                if (index === 0) {
                    modalElement.style.top = '50px';
                    modalElement.style.left = '50px';
                    modalElement.style.transform = 'none';
                } else if (index === 1) {
                    modalElement.style.top = '50px';
                    modalElement.style.right = '50px';
                    modalElement.style.left = 'auto';
                    modalElement.style.transform = 'none';
                }
            }
        });
    }

    createDetailModal(data) {
        const template = document.getElementById('detailModalTemplate');
        return template.content.cloneNode(true).querySelector('.modal-content').outerHTML;
    }

    createSuratModal(data) {
        const template = document.getElementById('suratModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        return modalContent.outerHTML;
    }

    createEvidenModal(data) {
        const template = document.getElementById('evidenModalTemplate');
        return template.content.cloneNode(true).querySelector('.modal-content').outerHTML;
    }

    createPreviewModal(data) {
        const template = document.getElementById('previewModalTemplate');
        return template.content.cloneNode(true).querySelector('.preview-content').outerHTML;
    }

    createReturnModal(data) {
        const template = document.getElementById('returnModalTemplate');
        const content = template.content.cloneNode(true);
        const modalContent = content.querySelector('.modal-content');
        
        if (data.namaKegiatan) {
            modalContent.querySelector('.return-nama-kegiatan').textContent = data.namaKegiatan;
        }
        if (data.suratId) {
            modalContent.querySelector('.return-form').action = '<?= base_url("dekan/return_pengajuan/") ?>' + data.suratId;
        }
        
        return modalContent.outerHTML;
    }

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

    setActiveModal(modalId) {
        this.modals.forEach(modal => {
            modal.element.classList.remove('active');
        });
        
        const modal = this.modals.find(m => m.id === modalId);
        if (modal) {
            modal.element.classList.add('active');
            modal.element.style.zIndex = this.modalZIndex++;
            this.activeModal = modal;
        }
    }

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
            
            this.updateModalPositions();
            
            if (this.modals.length === 0) {
                document.body.classList.remove('modal-open');
                this.activeModal = null;
            } else {
                this.setActiveModal(this.modals[this.modals.length - 1].id);
            }
        }, 300);
    }

    attachEventListeners(modalElement, modalId, type, data) {
        const closeBtn = modalElement.querySelector('.close-modal');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeModal(modalId));
        }
        
        const previewCloseBtn = modalElement.querySelector('.preview-close');
        if (previewCloseBtn) {
            previewCloseBtn.addEventListener('click', () => this.closeModal(modalId));
        }
        
        const cancelBtns = modalElement.querySelectorAll('.btn-cancel');
        cancelBtns.forEach(btn => {
            btn.addEventListener('click', () => this.closeModal(modalId));
        });
        
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
            case 'return':
                this.attachReturnModalListeners(modalElement, modalId, data);
                break;
        }
        
        modalElement.addEventListener('mousedown', (e) => {
            if (e.target.closest('button') && e.target.closest('button').classList.contains('close-modal')) return;
            if (e.target.closest('button') && e.target.closest('button').classList.contains('preview-close')) return;
            this.setActiveModal(modalId);
        });
        
        modalElement.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }

    attachDetailModalListeners(modalElement, modalId, data) {
        if (data.suratId) {
            this.loadDetailContent(modalElement, data.suratId);
        }
    }

    attachSuratModalListeners(modalElement, modalId, data) {
        if (data.suratId) {
            this.loadSuratContent(modalElement, data.suratId);
        }
        
        const fullscreenBtn = modalElement.querySelector('.surat-btn-fullscreen');
        if (fullscreenBtn) {
            fullscreenBtn.addEventListener('click', () => {
                const iframe = modalElement.querySelector('.surat-iframe');
                if (iframe) {
                    toggleIframeFullscreen(iframe);
                }
            });
        }
        
        const downloadBtn = modalElement.querySelector('.surat-btn-download');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (currentSuratPdfUrl) {
                    downloadPDF(currentSuratPdfUrl);
                }
            });
        }
        
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

    attachEvidenModalListeners(modalElement, modalId, data) {
        if (data.suratId) {
            this.loadEvidenContent(modalElement, data.suratId, data.namaKegiatan || '');
        }
    }

    attachReturnModalListeners(modalElement, modalId, data) {
        const form = modalElement.querySelector('.return-form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitReturnForm(form, data.suratId);
            });
        }
    }

    async loadDetailContent(modalElement, suratId) {
        try {
            const detailContent = modalElement.querySelector('.detail-content');
            if (!detailContent) return;
            
            detailContent.innerHTML = `
                <div style="text-align:center;padding:60px;">
                    <i class="fa-solid fa-spinner fa-spin" style="font-size:32px;color:#8E44AD"></i>
                    <p style="margin-top:15px;color:#7f8c8d">Memuat detail pengajuan...</p>
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

    async loadSuratContent(modalElement, suratId) {
        try {
            const iframe = modalElement.querySelector('.surat-iframe');
            const downloadBtn = modalElement.querySelector('.surat-btn-download');
            const printBtn = modalElement.querySelector('.surat-btn-print');
            
            if (!iframe) return;
            
            iframe.src = 'about:blank';
            iframe.onload = null;
            
            const viewUrl = "<?= base_url('dekan/view_surat_pengajuan/') ?>" + suratId;
            currentSuratPdfUrl = "<?= base_url('dekan/download_pdf/') ?>" + suratId;
            
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
            
            iframe.src = viewUrl;
            
            iframe.onload = function() {
                adjustIframeHeight(iframe);
            };
            
        } catch (error) {
            console.error('Error loading surat:', error);
            showAlert('Gagal memuat surat: ' + error.message, 'error');
        }
    }

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
            
            if (evidenFiles.length === 1) {
                this.closeModal(modalElement.closest('.modal-item').id);
                
                setTimeout(() => {
                    previewFile(evidenFiles[0].url, evidenFiles[0].name);
                }, 100);
                return;
            }
            
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

    submitReturnForm(form, suratId) {
        form.submit();
    }

    getModal(modalId) {
        return this.modals.find(m => m.id === modalId);
    }

    closeAllModals() {
        while (this.modals.length > 0) {
            this.closeModal(this.modals[0].id);
        }
    }
}

// ===== FUNGSI UTAMA =====

modalManager = new ModalManager();

function showRowDetail(id) {
    modalManager.createModal('detail', { suratId: id });
}

function showSuratModal(id) {
    modalManager.createModal('surat', { suratId: id });
}

async function handleEvidenClick(suratId, namaKegiatan = '') {
    try {
        if (modalManager.modals.length >= 2) {
            showAlert('Maksimal hanya dapat membuka 2 modal sekaligus. Tutup salah satu modal terlebih dahulu.', 'warning');
            return;
        }
        
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
        
        if (evidenFiles.length === 1) {
            const singleFile = evidenFiles[0];
            previewFile(singleFile.url, singleFile.name);
        } else {
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

function showReturnModalNew(id, namaKegiatan = '') {
    modalManager.createModal('return', { 
        suratId: id, 
        namaKegiatan: namaKegiatan 
    });
}

function previewFile(fileUrl, fileName) {
    if (modalManager.modals.length >= 2) {
        showAlert('Maksimal hanya dapat membuka 2 modal sekaligus. Tutup salah satu modal terlebih dahulu.', 'warning');
        return;
    }
    
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
            const suratList = <?= isset($surat_list) && !empty($surat_list) ? json_encode($surat_list) : (isset($data_pengajuan) ? json_encode($data_pengajuan) : '[]') ?>;
            const localData = suratList.find(s => Number(s.id) === Number(id));
            if (localData) {
                console.log('Menggunakan data dari array lokal');
                return Promise.resolve(localData);
            }
            throw error;
        });
}

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
                const fileName = getFileNameFromPath(evidenValue);
                const fileUrl = getFileUrl(evidenValue, baseUrl);
                evidenFiles.push({
                    name: fileName,
                    url: fileUrl,
                    ext: fileName.split('.').pop().toLowerCase()
                });
            }
        } catch (e) {
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

function getFileNameFromPath(path) {
    if (!path) return 'file';
    return path.split('/').pop().split('\\').pop();
}

function getFileUrl(filePath, baseUrl) {
    if (!filePath) return '#';
    
    if (filePath.startsWith('http://') || filePath.startsWith('https://') || filePath.startsWith('<?= base_url() ?>')) {
        return filePath;
    }
    
    const fileName = getFileNameFromPath(filePath);
    const possiblePaths = [
        'uploads/eviden/' + fileName,
        'eviden/' + fileName,
        'assets/eviden/' + fileName,
        'uploads/' + fileName,
        filePath
    ];
    
    return baseUrl + possiblePaths[0];
}

function generateMultipleEvidenContent(item, evidenFiles, namaKegiatan = '') {
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

function generateDetailContent(item) {
    const getVal = (k) => {
        const value = (item[k] !== undefined && item[k] !== null && item[k] !== '' ? item[k] : '-');
        return value;
    };
    
    let statusBadge = '';
    const status = getVal('status').toLowerCase();
    
    if (status === 'disetujui dekan') {
        statusBadge = `<span class="badge badge-approved">Disetujui Dekan</span>`;
    } else if (status === 'disetujui sekretariat') {
        statusBadge = `<span class="badge badge-sekretariat">Disetujui Sekretariat</span>`;
    } else if (status.includes('ditolak')) {
        statusBadge = `<span class="badge badge-rejected">Ditolak</span>`;
    } else {
        statusBadge = `<span class="badge badge-pending">${getVal('status')}</span>`;
    }
    
    const dosenData = item.dosen_data || [];
    
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
    
    let nomorSuratHtml = '';
    if (getVal('nomor_surat') && getVal('nomor_surat') !== '-') {
        nomorSuratHtml = `
        <div style="background:#f5eef8;border:2px solid #8E44AD;border-radius:10px;padding:15px;margin-bottom:20px;text-align:center">
            <div style="font-size:14px;font-weight:600;color:#8E44AD;margin-bottom:5px;text-transform:uppercase;letter-spacing:1px">
                <i class="fa-solid fa-file-signature"></i> Nomor Surat
            </div>
            <div style="font-size:18px;font-weight:700;color:#6c3483;font-family:'Courier New',monospace">
                ${escapeHtml(getVal('nomor_surat'))}
            </div>
        </div>`;
    }
    
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
    
    const jenisDate = getVal('jenis_date');
    const periodeValue = getVal('periode_value');
    const tanggalKegiatan = getVal('tanggal_kegiatan');
    const akhirKegiatan = getVal('akhir_kegiatan');

    let periodeDisplay = '-';
    let tanggalMulaiDisplay = '-';
    let tanggalAkhirDisplay = '-';

    if (jenisDate === 'Periode') {
        periodeDisplay = periodeValue !== '-' && periodeValue ? periodeValue : '-';
        tanggalMulaiDisplay = '-';
        tanggalAkhirDisplay = '-';
    } else if (jenisDate === 'Custom') {
        periodeDisplay = '-';
        if (tanggalKegiatan !== '-' && tanggalKegiatan) {
            tanggalMulaiDisplay = formatDate(tanggalKegiatan);
        }
        if (akhirKegiatan !== '-' && akhirKegiatan) {
            tanggalAkhirDisplay = formatDate(akhirKegiatan);
        }
    } else {
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
        ${getVal('status') === 'disetujui dekan' || getVal('status') === 'ditolak dekan' ? `
        <div style="display:flex;gap:10px;margin-left:auto">
            <button class="modal-btn modal-btn-return" onclick="event.stopPropagation(); modalManager.closeModal('${currentModalId}'); showReturnModalNew(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
                <i class="fa-solid fa-undo"></i> Kembalikan
            </button>
        </div>
        ` : ''}
    </div>`;
}

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

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modalManager.modals.length > 0) {
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
// FUNGSI SEARCHING
// ============================================

let currentSearchTerm = '<?= htmlspecialchars($this->input->get('search') ?? '') ?>';

function handleSearch() {
    const searchInput = document.getElementById('searchInput');
    currentSearchTerm = searchInput.value.toLowerCase().trim();
    
    if (!currentSearchTerm) {
        window.location.href = '<?= base_url("dekan/halaman_disetujui") ?>';
        return;
    }
    
    const url = new URL(window.location.href);
    url.searchParams.set('search', currentSearchTerm);
    window.location.href = url.toString();
}

function updatePaginationInfo(visibleCount, totalCount) {
    const paginationText = document.getElementById('paginationText');
    const filterInfo = document.getElementById('filterInfo');
    
    if (currentSearchTerm) {
        paginationText.textContent = `Menampilkan hasil pencarian untuk: "${currentSearchTerm}" (${visibleCount} data)`;
        filterInfo.textContent = `Menampilkan hasil pencarian untuk: "${currentSearchTerm}" (${visibleCount})`;
    } else {
        paginationText.textContent = `Menampilkan: Semua Data (${totalCount} data)`;
        filterInfo.textContent = `Menampilkan: Semua Data (${totalCount})`;
    }
}

// ============================================
// FUNGSI UNTUK MEMBUAT ROWS CLICKABLE
// ============================================

function initializeClickableRows() {
    const rows = document.querySelectorAll('#tableBody tr.clickable-row');
    
    rows.forEach(row => {
        // Hapus atribut onclick yang ada
        row.removeAttribute('onclick');
        
        // Tambahkan event listener baru
        row.addEventListener('click', function(e) {
            // Cegah event jika mengklik tombol atau link
            if (e.target.closest('button') || 
                e.target.closest('a') || 
                e.target.closest('select') ||
                e.target.closest('textarea') ||
                e.target.closest('input')) {
                return;
            }
            
            // Dapatkan ID dari data-id attribute
            const suratId = this.getAttribute('data-id');
            
            if (suratId) {
                showRowDetail(suratId);
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    initializeClickableRows();
    
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                handleSearch();
            }
        });
    }
    
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam && searchInput) {
        searchInput.value = searchParam;
        currentSearchTerm = searchParam;
    }
    
    const totalCount = <?= isset($total_surat) ? $total_surat : (isset($surat_list) ? count($surat_list) : (isset($data_pengajuan) ? count($data_pengajuan) : '0')) ?>;
    updatePaginationInfo(totalCount, totalCount);
});
</script>
</body>
</html>