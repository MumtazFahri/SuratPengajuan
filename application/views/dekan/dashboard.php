<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Dekan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:#f5f7fa;}
    .navbar{background:#FB8C00;color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 4px rgba(0,0,0,0.1);}
    .navbar h2{font-size:20px;}
    .container{max-width:1200px;margin:30px auto;padding:0 20px;}
    .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:20px;}
    .stat-card{background:white;padding:20px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border-left:4px solid #3498db;transition:all 0.3s ease;cursor:pointer;text-decoration:none;display:block;color:inherit}
    .stat-card:hover{transform:translateY(-5px);box-shadow:0 8px 16px rgba(0,0,0,0.12)}
    .stat-card h3{color:#7f8c8d;font-size:13px;margin-bottom:8px;text-transform:uppercase}
    .stat-card .number{font-size:28px;font-weight:700;color:#2c3e50}
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
    .chart-container{position:relative;height:450px;padding:10px;}
    .filter-container{display:flex;gap:15px;margin-bottom:20px;flex-wrap:wrap}
    .filter-select{padding:10px 15px;border-radius:8px;border:2px solid #ddd;font-weight:600;cursor:pointer;min-width:200px}
    
    /* Modal Styles */
    .modal{display:none;position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.45);align-items:center;justify-content:center}
    .modal.show{display:flex}
    .modal-content{background:white;padding:0;border-radius:15px;max-width:1100px;width:95%;max-height:85vh;overflow:hidden;animation:slideIn 0.3s ease;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
    @keyframes slideIn{from{transform:translateY(-50px);opacity:0}to{transform:translateY(0);opacity:1}}
    .modal-header{background:#FB8C00;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
    .modal-header h3{margin:0;font-size:18px;font-weight:600}
    .close-modal{background:none;border:0;color:white;font-size:24px;cursor:pointer;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .close-modal:hover{background:rgba(255,255,255,0.2)}
    
    /* Detail Content Styles - IMPROVED (SAMA DENGAN DASHBOARD SEKRETARIAT) */
    .detail-content{padding:25px;max-height:calc(85vh - 80px);overflow-y:auto}
    .detail-section{margin-bottom:25px;background:#f8f9fa;border-radius:12px;padding:20px;border:1px solid #e9ecef}
    .detail-section:last-child{margin-bottom:0}
    .detail-section-title{font-size:16px;font-weight:700;color:#FB8C00;margin-bottom:15px;padding-bottom:10px;border-bottom:2px solid #FB8C00;display:flex;align-items:center;gap:10px}
    .detail-section-title i{font-size:18px}
    .detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:15px}
    .detail-row{display:flex;flex-direction:column;margin-bottom:12px}
    .detail-label{font-weight:600;color:#495057;font-size:13px;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.5px}
    .detail-value{color:#212529;font-size:14px;background:white;padding:10px 15px;border-radius:8px;border:1px solid #e9ecef;min-height:40px;display:flex;align-items:center}
    .detail-value-empty{color:#6c757d;font-style:italic;background:#f8f9fa !important}
    
    /* Dosen list in detail - NEW STYLES (SAMA DENGAN DASHBOARD SEKRETARIAT) */
    .dosen-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .dosen-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 6px;
    }

    .dosen-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #FB8C00;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        font-weight: 600;
    }

    .dosen-info {
        flex: 1;
    }

    .dosen-name {
        font-weight: 600;
        color: #212529;
        font-size: 14px;
    }

    .dosen-details {
        font-size: 12px;
        color: #6c757d;
    }
    
    /* File Evidence Styles (SAMA DENGAN DASHBOARD SEKRETARIAT) */
    .file-evidence{margin-top:10px}
    .file-item{display:flex;align-items:center;gap:12px;padding:12px 15px;background:white;border:1px solid #e9ecef;border-radius:8px;transition:all 0.2s}
    .file-item:hover{background:#fef9e7;border-color:#FB8C00}
    .file-icon{width:24px;height:24px;display:flex;align-items:center;justify-content:center;color:#FB8C00;font-size:16px}
    .file-info{flex:1}
    .file-name{font-weight:600;color:#212529;font-size:14px;cursor:pointer}
    .file-name:hover{color:#FB8C00}
    .file-size{font-size:12px;color:#6c757d}
    .preview-btn{background:#3498db;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:6px;text-decoration:none}
    .preview-btn:hover{background:#2980b9;color:white;text-decoration:none}
    .preview-btn.disabled{background:#bdc3c7;cursor:not-allowed;opacity:0.6}
    .preview-btn.disabled:hover{background:#bdc3c7}
    .download-btn{background:#FB8C00;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:6px;text-decoration:none}
    .download-btn:hover{background:#E67E22;color:white;text-decoration:none}

    /* Preview Modal Styles */
    .preview-modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:10000;justify-content:center;align-items:center;padding:20px}
    .preview-modal.show{display:flex}
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
    
    /* Action Buttons in Modal (SAMA DENGAN DASHBOARD SEKRETARIAT) */
    .modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:20px;padding-top:20px;border-top:1px solid #e9ecef}
    .modal-btn{padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;transition:all 0.2s;display:flex;align-items:center;gap:8px}
    .modal-btn-close{background:#6c757d;color:white}
    .modal-btn-close:hover{background:#5a6268;transform:translateY(-2px)}
    .modal-btn-approve{background:#27ae60;color:white}
    .modal-btn-approve:hover{background:#229954;transform:translateY(-2px)}
    .modal-btn-reject{background:#e74c3c;color:white}
    .modal-btn-reject:hover{background:#c0392b;transform:translateY(-2px)}
    
    /* Rejection Notes Styles (SAMA DENGAN DASHBOARD SEKRETARIAT) */
    .rejection-notes{background:#fff5f5;border:1px solid #f8d7da;border-radius:8px;padding:20px;margin-top:15px}
    .rejection-notes .detail-label{color:#dc3545;font-weight:700}
    .rejection-notes .detail-value{background:#fff5f5;border-color:#f8d7da;color:#721c24;font-size:14px;line-height:1.5;min-height:auto;padding:12px}
    
    /* Approve Modal Styles */
    .approve-modal-content{background:white;padding:0;border-radius:15px;max-width:500px;width:95%;max-height:85vh;overflow:hidden;animation:slideIn 0.3s ease;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
    .approve-modal-body{padding:25px}
    .approve-modal-header{background:#27ae60;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
    .approve-modal-header h3{margin:0;font-size:18px;font-weight:600}
    .approve-info-box{background:#e8f5e9;border:1px solid #27ae60;border-radius:8px;padding:15px;margin-bottom:20px}
    .approve-info-box strong{color:#27ae60;display:block;margin-bottom:5px}
    .approve-info-box span{color:#2c3e50;font-weight:600}
    .approve-modal-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:25px;padding-top:20px;border-top:1px solid #e9ecef}
    .approve-btn{padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;transition:all 0.2s;display:flex;align-items:center;gap:8px}
    .approve-btn-cancel{background:#95a5a6;color:white}
    .approve-btn-cancel:hover{background:#7f8c8d;transform:translateY(-2px)}
    .approve-btn-submit{background:#27ae60;color:white}
    .approve-btn-submit:hover{background:#229954;transform:translateY(-2px)}
    
    /* Tombol Eviden - WARNA HIJAU TETAP */
.btn-status {
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

.btn-status i {
    font-size: 14px;
}

.btn-status:hover {
    background: #218838 !important;
    transform: scale(1.05);
}
    /* Tombol Eviden - Baru */
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

/* Eviden Modal Styles */
.eviden-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

.eviden-modal.show {
    display: flex;
}

.eviden-content {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 800px;
    padding: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.eviden-header {
    background: #28a745;
    color: white;
    padding: 20px;
    border-radius: 12px 12px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.eviden-header h3 {
    margin: 0;
    font-size: 18px;
}

.close-eviden {
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.2s;
}

.close-eviden:hover {
    background: rgba(255,255,255,0.2);
}

.eviden-body {
    padding: 25px;
    max-height: 70vh;
    overflow-y: auto;
}

.eviden-file-container {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
}

.eviden-file-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #dee2e6;
}

.eviden-file-header h4 {
    margin: 0;
    color: #28a745;
}

.eviden-preview {
    background: white;
    border-radius: 8px;
    padding: 15px;
    border: 1px solid #dee2e6;
    margin-bottom: 15px;
}

.eviden-image {
    max-width: 100%;
    max-height: 400px;
    object-fit: contain;
    border-radius: 5px;
    display: block;
    margin: 0 auto;
}

.eviden-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
}

.download-eviden-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
    font-size: 14px;
}

.download-eviden-btn:hover {
    background: #218838;
    color: white;
    text-decoration: none;
}
    /* Progress Bar Styles */
    .progress-track {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 40px 0;
    }

    .progress-track::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        width: 100%;
        height: 4px;
        background: #e0e0e0;
        z-index: 1;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 10px;
        border: 3px solid #e0e0e0;
        background: white;
    }

    .step-text {
        font-size: 12px;
        text-align: center;
        max-width: 100px;
        color: #666;
    }

    .step-date {
        font-size: 11px;
        color: #999;
        margin-top: 5px;
        display: none !important;
    }

    /* Progress Line */
    .progress-line {
        position: absolute;
        top: 20px;
        left: 0;
        height: 4px;
        background: #4caf50;
        z-index: 2;
        transition: width 0.5s ease;
    }

    /* Status Colors */
    .progress-step.completed .step-icon {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .progress-step.status-completed i {
        color: white !important;
    }

    .progress-step.in-progress .step-icon {
        background: #ffc107;
        border-color: #ffc107;
        color: white;
    }

    .progress-step.rejected .step-icon {
        background: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .progress-step.pending .step-icon {
        background: #e0e0e0;
        border-color: #e0e0e0;
        color: #666;
    }

    .progress-estimasi {
        width: 100%;
        text-align: center;
        margin-top: 5px;
        font-size: 12px;
        color: #777;
    }

    .rejection-reason {
        background: #fff5f5;
        border: 1px solid #f8cccc;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
    }

    .rejection-reason h6 {
        color: #e63946;
        font-weight: 700;
        margin-bottom: 8px;
    }

    /* Status Modal Styles */
    .status-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .status-modal.show {
        display: flex;
    }

    .status-content {
        background: white;
        border-radius: 12px;
        width: 90%;
        max-width: 600px;
        padding: 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .status-header {
        background: #FB8C00;
        color: white;
        padding: 20px;
        border-radius: 12px 12px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-header h3 {
        margin: 0;
        font-size: 18px;
    }

    .close-status {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
    }

    .status-body {
        padding: 30px;
    }
    
    /* Nomor Surat Styles (SAMA DENGAN DASHBOARD SEKRETARIAT) */
    .nomor-surat-container {
        background: linear-gradient(135deg, #fef9e7 0%, #fdebd0 100%);
        border: 2px solid #FB8C00;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .nomor-surat-label {
        font-size: 14px;
        font-weight: 600;
        color: #FB8C00;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .nomor-surat-value {
        font-size: 18px;
        font-weight: 700;
        color: #7d6608;
        font-family: 'Courier New', monospace;
    }
    
    /* Responsive */
    @media (max-width:768px){
        .detail-grid{grid-template-columns:1fr}
        .modal-content{width:95%;margin:10px}
        .detail-content{padding:15px}
        .modal-actions{flex-direction:column}
        .modal-btn{justify-content:center}
        .approve-modal-content{width:95%;margin:10px}
        .approve-modal-body{padding:15px}
        .approve-modal-actions{flex-direction:column}
        .approve-btn{justify-content:center}
        .progress-track {
            flex-direction: column;
            align-items: flex-start;
            gap: 30px;
            padding: 0 10px;
        }
        .progress-track::before {
            display: none;
        }
        .progress-step {
            flex-direction: row;
            align-items: center;
            gap: 15px;
            width: 100%;
        }
        .step-text {
            text-align: left;
            max-width: none;
            flex: 1;
        }
    }
    /* Tambahkan di bagian CSS halaman utama */
.btn-bulk {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-bulk:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

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
/* Clickable Row Styles - IMPROVED */
.clickable-row {
    cursor: pointer !important;
    transition: all 0.2s ease;
}

.clickable-row:hover {
    background-color: #fef9e7 !important;
    box-shadow: 0 2px 4px rgba(251, 140, 0, 0.1);
}

.clickable-row:active {
    background-color: #fdebd0 !important;
    transform: scale(0.998);
}

/* Highlight untuk baris yang sedang dipilih */
.clickable-row.selected {
    background-color: #fef9e7 !important;
    border-left: 4px solid #FB8C00;
}

/* Pastikan tombol di dalam row tidak ter-affected */
.clickable-row button,
.clickable-row select,
.clickable-row textarea,
.clickable-row input {
    pointer-events: all;
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
}

.btn-return i {
    font-size: 14px;
}

.btn-return:hover {
    background: #f57c00 !important;
    transform: scale(1.05);
}
/* Dosen List di Success Modal */
.success-dosen-container {
    background: #e8f5e9;
    border: 1px solid #c3e6cb;
    border-radius: 8px;
    padding: 15px;
    margin: 15px 0;
}

.success-dosen-title {
    font-weight: 600;
    color: #155724;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.success-dosen-count {
    background: #27ae60;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 12px;
}

.success-dosen-list {
    max-height: 150px;
    overflow-y: auto;
    margin-bottom: 10px;
}

.success-dosen-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 10px;
    background: white;
    border: 1px solid #d4edda;
    border-radius: 4px;
    margin-bottom: 5px;
}

.success-dosen-item:last-child {
    margin-bottom: 0;
}

.success-dosen-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #27ae60;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 11px;
    font-weight: 600;
    flex-shrink: 0;
}

.success-dosen-info {
    flex: 1;
    min-width: 0;
}

.success-dosen-name {
    font-weight: 600;
    color: #212529;
    font-size: 13px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.success-dosen-details {
    font-size: 11px;
    color: #6c757d;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.success-dosen-more-btn {
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 6px 12px;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    width: 100%;
    transition: background 0.2s;
}

.success-dosen-more-btn:hover {
    background: #229954;
}

.success-dosen-hidden {
    display: none;
}

.success-dosen-show-all .success-dosen-item {
    display: flex !important;
}
/* ============================================
   REJECT MODAL STYLES (MIRIP SEPERTI APPROVE MODAL)
================================= */
.reject-modal-content {
    background: white;
    padding: 0;
    border-radius: 15px;
    max-width: 550px;
    width: 95%;
    max-height: 85vh;
    overflow: hidden;
    animation: slideIn 0.3s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.reject-modal-body {
    padding: 25px;
}

.reject-modal-header {
    background: #e74c3c;
    color: white;
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 15px 15px 0 0;
}

.reject-modal-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.reject-info-box {
    background: #fff5f5;
    border: 1px solid #f8cccc;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

.reject-info-box strong {
    color: #e74c3c;
    display: block;
    margin-bottom: 5px;
}

.reject-info-box span {
    color: #2c3e50;
    font-weight: 600;
}

.reject-modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.reject-btn {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.reject-btn-cancel {
    background: #95a5a6;
    color: white;
}

.reject-btn-cancel:hover {
    background: #7f8c8d;
    transform: translateY(-2px);
}

.reject-btn-submit {
    background: #e74c3c;
    color: white;
}

.reject-btn-submit:hover {
    background: #c0392b;
    transform: translateY(-2px);
}

/* Textarea khusus untuk reject modal */
.reject-textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #f8cccc;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    transition: border-color 0.2s;
    resize: vertical;
    min-height: 100px;
}

.reject-textarea:focus {
    outline: none;
    border-color: #e74c3c;
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
}

.reject-textarea::placeholder {
    color: #bdc3c7;
}

.reject-form-hint {
    color: #e74c3c;
    font-size: 12px;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}
/* ============================================
   RETURN MODAL STYLES (MIRIP SEPERTI REJECT/APPROVE MODAL)
================================= */
.return-modal-content {
    background: white;
    padding: 0;
    border-radius: 15px;
    max-width: 550px;
    width: 95%;
    max-height: 85vh;
    overflow: hidden;
    animation: slideIn 0.3s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.return-modal-body {
    padding: 25px;
}

.return-modal-header {
    background: #ff9800;
    color: white;
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 15px 15px 0 0;
}

.return-modal-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.return-info-box {
    background: #fff3e0;
    border: 1px solid #ffb74d;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}

.return-info-box strong {
    color: #ff9800;
    display: block;
    margin-bottom: 5px;
}

.return-info-box span {
    color: #2c3e50;
    font-weight: 600;
}

.return-modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.return-btn {
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.return-btn-cancel {
    background: #95a5a6;
    color: white;
}

.return-btn-cancel:hover {
    background: #7f8c8d;
    transform: translateY(-2px);
}

.return-btn-submit {
    background: #ff9800;
    color: white;
}

.return-btn-submit:hover {
    background: #f57c00;
    transform: translateY(-2px);
}

/* Textarea khusus untuk return modal */
.return-textarea {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #ffcc80;
    border-radius: 8px;
    font-family: inherit;
    font-size: 14px;
    transition: border-color 0.2s;
    resize: vertical;
    min-height: 80px;
}

.return-textarea:focus {
    outline: none;
    border-color: #ff9800;
    box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.2);
}

.return-textarea::placeholder {
    color: #bdc3c7;
}

.return-form-hint {
    color: #ff9800;
    font-size: 12px;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}
</style>
</head>
<body>

<div class="navbar">
    <h2><i class="fa-solid fa-university"></i> Dashboard Dekan</h2>
    <div></div>
</div>

<div class="container">
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

    <?php
    $total_all = isset($total_surat) ? (int)$total_surat : 0;
    $approved_count = isset($approved_count) ? (int)$approved_count : 0;
    $rejected_count = isset($rejected_count) ? (int)$rejected_count : 0;
    $pending_count = isset($pending_count) ? (int)$pending_count : 0;
    ?>

  <!-- Statistik Grid yang Diperkecil -->
<div class="stats-grid" style="gap: 10px; margin-bottom: 15px;">
    <!-- Total Pengajuan -->
    <a href="<?= base_url('dekan/halaman_total') ?>" class="stat-card" style="
        border-left-color:#3498db;
        padding: 12px 15px;
        text-align: center;
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    ">
        <h3 style="font-size: 10px; margin-bottom: 4px; letter-spacing: 0.5px;">
            <i class="fa-solid fa-folder" style="font-size: 9px;"></i> TOTAL PENGAJUAN
        </h3>
        <div class="number" style="font-size: 20px; font-weight: 800; color: #5e5e5eff;">
            <?= $total_all ?>
        </div>
    </a>
    
    <!-- Menunggu Persetujuan -->
    <a href="<?= base_url('dekan/halaman_pending') ?>" class="stat-card" style="
        border-left-color:#f39c12;
        padding: 12px 15px;
        text-align: center;
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    ">
        <h3 style="font-size: 10px; margin-bottom: 4px; letter-spacing: 0.5px;">
            <i class="fa-solid fa-clock" style="font-size: 9px;"></i> MENUNGGU PERSETUJUAN
        </h3>
        <div class="number" style="font-size: 20px; font-weight: 800; color: #5e5e5eff;">
            <?= $pending_count ?>
        </div>
    </a>
    
    <!-- Disetujui -->
    <a href="<?= base_url('dekan/halaman_disetujui') ?>" class="stat-card" style="
        border-left-color:#27ae60;
        padding: 12px 15px;
        text-align: center;
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    ">
        <h3 style="font-size: 10px; margin-bottom: 4px; letter-spacing: 0.5px;">
            <i class="fa-solid fa-check-circle" style="font-size: 9px;"></i> DISETUJUI
        </h3>
        <div class="number" style="font-size: 20px; font-weight: 800; color: #5e5e5eff;">
            <?= $approved_count ?>
        </div>
    </a>
    
    <!-- Ditolak -->
    <a href="<?= base_url('dekan/halaman_ditolak') ?>" class="stat-card" style="
        border-left-color:#e74c3c;
        padding: 12px 15px;
        text-align: center;
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    ">
        <h3 style="font-size: 10px; margin-bottom: 4px; letter-spacing: 0.5px;">
            <i class="fa-solid fa-times-circle" style="font-size: 9px;"></i> DITOLAK
        </h3>
        <div class="number" style="font-size: 20px; font-weight: 800; color: #5e5e5eff;">
            <?= $rejected_count ?>
        </div>
    </a>
</div>
    <!-- Filter -->
<div class="filter-container">
    <div>
        <label style="display:block;margin-bottom:5px;font-weight:600;color:#7f8c8d">
            <i class="fa-solid fa-calendar"></i> Filter Tahun
        </label>
        <select class="filter-select" id="tahunSelect" onchange="updateTahun(this.value)">
            <?php 
                $currentYear = date('Y');
                $selectedYear = isset($tahun) ? $tahun : $currentYear;
                for ($y = $currentYear; $y >= $currentYear - 5; $y--): 
            ?>
                <option value="<?= $y ?>" <?= ($selectedYear == $y ? 'selected' : '') ?>>Tahun <?= $y ?></option>
            <?php endfor; ?>
        </select>
    </div>
    
    <div>
        <label style="display:block;margin-bottom:5px;font-weight:600;color:#7f8c8d">
            <i class="fa-solid fa-calendar-alt"></i> Filter Bulan
        </label>
        <select class="filter-select" id="bulanSelect" onchange="filterByBulan(this.value)">
            <option value="all">Semua Bulan</option>
            <option value="1" <?= (isset($bulan) && $bulan == 1 ? 'selected' : '') ?>>Januari</option>
            <option value="2" <?= (isset($bulan) && $bulan == 2 ? 'selected' : '') ?>>Februari</option>
            <option value="3" <?= (isset($bulan) && $bulan == 3 ? 'selected' : '') ?>>Maret</option>
            <option value="4" <?= (isset($bulan) && $bulan == 4 ? 'selected' : '') ?>>April</option>
            <option value="5" <?= (isset($bulan) && $bulan == 5 ? 'selected' : '') ?>>Mei</option>
            <option value="6" <?= (isset($bulan) && $bulan == 6 ? 'selected' : '') ?>>Juni</option>
            <option value="7" <?= (isset($bulan) && $bulan == 7 ? 'selected' : '') ?>>Juli</option>
            <option value="8" <?= (isset($bulan) && $bulan == 8 ? 'selected' : '') ?>>Agustus</option>
            <option value="9" <?= (isset($bulan) && $bulan == 9 ? 'selected' : '') ?>>September</option>
            <option value="10" <?= (isset($bulan) && $bulan == 10 ? 'selected' : '') ?>>Oktober</option>
            <option value="11" <?= (isset($bulan) && $bulan == 11 ? 'selected' : '') ?>>November</option>
            <option value="12" <?= (isset($bulan) && $bulan == 12 ? 'selected' : '') ?>>Desember</option>
        </select>
    </div>
</div>

<!-- Grafik 3D -->
<div class="card" style="background: linear-gradient(135deg, #ffffffff 0%, #f7f7f7ff 100%);">
    <div class="card-header" style="border-bottom-color: rgba(16, 11, 11, 0.1)">
        <strong style="color: #030707ff"><i class="fa-solid fa-chart-bar"></i> Grafik Pengajuan — 
            <?php 
                if(isset($bulan) && $bulan != 'all') {
                    $namaBulan = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                    echo $namaBulan[$bulan] . ' ';
                }
            ?>
            Tahun <?= isset($tahun) ? $tahun : date('Y') ?>
        </strong>
    </div>
    <div class="chart-container">
        <canvas id="grafikSurat"></canvas>
    </div>
</div>

    
</div>

<!-- Preview Modal -->
<div id="previewModal" class="preview-modal">
    <div class="preview-content">
        <div class="preview-header">
            <h3 id="previewTitle">Preview File</h3>
            <button class="preview-close" onclick="closePreviewModal()">&times;</button>
        </div>
        <div class="preview-body" id="previewBody">
            <!-- Preview content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="modal">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3><i class="fa-solid fa-file-alt"></i> Detail Pengajuan Surat Tugas</h3>
            <button class="close-modal" onclick="closeModal('detailModal')">&times;</button>
        </div>
        <div class="detail-content" id="detailContent">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="modal">
    <div class="approve-modal-content" onclick="event.stopPropagation()">
        <div class="approve-modal-header">
            <h3><i class="fa-solid fa-check-circle"></i> Konfirmasi Persetujuan</h3>
            <button class="close-modal" onclick="closeModal('approveModal')">&times;</button>
        </div>
        <div class="approve-modal-body">
            <div class="approve-info-box">
                <strong><i class="fa-solid fa-info-circle"></i> Anda akan menyetujui pengajuan:</strong>
                <span id="approveNamaKegiatan"></span>
            </div>
            
            <p style="color:#7f8c8d;margin-bottom:20px">
                <i class="fa-solid fa-exclamation-triangle"></i> 
                Tindakan ini tidak dapat dibatalkan. Pastikan Anda telah memeriksa semua detail pengajuan.
            </p>
            
            <form id="approveForm" method="POST" action="">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div class="approve-modal-actions">
                    <button type="button" class="approve-btn approve-btn-cancel" onclick="closeModal('approveModal')">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="approve-btn approve-btn-submit">
                        <i class="fa-solid fa-check"></i> Ya, Setujui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal (BARU - MIRIP SEPERTI APPROVE MODAL) -->
<div id="rejectConfirmModal" class="modal">
    <div class="reject-modal-content" onclick="event.stopPropagation()">
        <div class="reject-modal-header">
            <h3><i class="fa-solid fa-ban"></i> Konfirmasi Penolakan</h3>
            <button class="close-modal" onclick="closeModal('rejectConfirmModal')">&times;</button>
        </div>
        <div class="reject-modal-body">
            <div class="reject-info-box">
                <strong><i class="fa-solid fa-exclamation-triangle"></i> Anda akan menolak pengajuan:</strong>
                <span id="rejectNamaKegiatan">-</span>
            </div>
            
            <p style="margin-bottom:15px;color:#7f8c8d">
                <i class="fa-solid fa-info-circle"></i> 
                Berikan alasan penolakan untuk pengajuan ini:
            </p>
            
            <form id="rejectForm" method="POST" action="">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div class="form-group">
                    <textarea 
                        id="rejectionReason" 
                        name="rejection_notes" 
                        class="reject-textarea" 
                        placeholder="Masukkan alasan penolakan pengajuan ini..."
                        required
                    ></textarea>
                    <div class="reject-form-hint">
                        <i class="fa-solid fa-asterisk"></i> Alasan penolakan wajib diisi
                    </div>
                </div>
                
                <div class="reject-modal-actions">
                    <button type="button" class="reject-btn reject-btn-cancel" onclick="closeModal('rejectConfirmModal')">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="reject-btn reject-btn-submit">
                        <i class="fa-solid fa-ban"></i> Ya, Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Result Modal untuk Reject -->
<div id="successRejectModal" class="modal">
    <div class="bulk-modal-content" onclick="event.stopPropagation()" style="max-width: 600px;">
        <div class="modal-header" style="background: #e74c3c;">
            <h3><i class="fa-solid fa-ban"></i> <span id="successRejectTitle">Pengajuan Berhasil Ditolak</span></h3>
            <button class="close-modal" onclick="closeModal('successRejectModal')">&times;</button>
        </div>
        <div style="padding:25px;text-align:center">
            <div style="width:100px;height:100px;border-radius:50%;background:#f8d7da;margin:0 auto 20px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-times-circle" style="font-size:50px;color:#e74c3c"></i>
            </div>
            
            <h3 style="color:#e74c3c;margin-bottom:10px">Berhasil Ditolak</h3>
            <p style="color:#666;margin-bottom:5px">
                <i class="fa-solid fa-clock"></i> Ditolak pada: <strong id="rejectTimestamp">-</strong>
            </p>
            
            <div style="background:#f8d7da;border:1px solid #f5c6cb;border-radius:8px;padding:15px;margin:20px 0">
                <div style="font-weight:600;color:#721c24;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between">
                    <span>Daftar Pengajuan</span>
                    <span id="rejectItemCount" style="background:#e74c3c;color:white;padding:4px 12px;border-radius:20px;font-size:12px">0 item</span>
                </div>
                <div id="rejectList" style="max-height:250px;overflow-y:auto;text-align:left">
                    <!-- List akan diisi oleh JavaScript -->
                </div>
            </div>
            
            <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
                <button class="btn-bulk" onclick="closeModal('successRejectModal')" style="background:#6c757d;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                    <i class="fa-solid fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Success Result Modal - DIUBAH SEPERTI DI HALAMAN PENDING -->
<div id="successResultModal" class="modal">
    <div class="bulk-modal-content" onclick="event.stopPropagation()" style="max-width: 600px;">
        <div class="modal-header" style="background: #27ae60;">
            <h3><i class="fa-solid fa-check-circle"></i> <span id="successResultTitle">Pengajuan Berhasil Disetujui</span></h3>
            <button class="close-modal" onclick="closeModal('successResultModal')">&times;</button>
        </div>
        <div style="padding:25px;text-align:center">
            <div style="width:100px;height:100px;border-radius:50%;background:#d4edda;margin:0 auto 20px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-check" style="font-size:50px;color:#27ae60"></i>
            </div>
            
            <h3 style="color:#27ae60;margin-bottom:10px">Berhasil Disetujui</h3>
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
                <button class="btn-bulk" onclick="closeModal('successResultModal')" style="background:#6c757d;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                    <i class="fa-solid fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal (untuk single file preview) -->
<div id="previewModal" class="preview-modal">
    <div class="preview-content">
        <div class="preview-header">
            <h3 id="previewTitle">Preview File</h3>
            <button class="preview-close" onclick="closePreviewModal()">&times;</button>
        </div>
        <div class="preview-body" id="previewBody">
            <!-- Preview content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>
<!-- Return Modal (SEDERHANA TANPA CATATAN) -->
<div id="returnConfirmModal" class="modal">
    <div class="approve-modal-content" onclick="event.stopPropagation()">
        <div class="approve-modal-header" style="background: #ff9800;">
            <h3><i class="fa-solid fa-undo"></i> Konfirmasi Pengembalian</h3>
            <button class="close-modal" onclick="closeModal('returnConfirmModal')">&times;</button>
        </div>
        <div class="approve-modal-body">
            <div class="approve-info-box" style="background: #fff3e0; border-color: #ff9800;">
                <strong style="color: #ff9800;"><i class="fa-solid fa-exclamation-triangle"></i> Peringatan</strong>
                <span id="returnNamaKegiatan">-</span>
            </div>
            
            <p style="margin-bottom:20px;color:#e65100;font-weight:600">
                ⚠️ Pengajuan ini akan dikembalikan ke status sebelumnya dan dapat diajukan ulang.
            </p>
            
            <div class="approve-modal-actions">
                <button type="button" class="approve-btn approve-btn-cancel" onclick="closeModal('returnConfirmModal')">
                    <i class="fa-solid fa-times"></i> Batal
                </button>
                <button type="button" class="approve-btn" style="background: #ff9800;" onclick="confirmReturn()">
                    <i class="fa-solid fa-undo"></i> Ya, Kembalikan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Result Modal untuk Return -->
<div id="successReturnModal" class="modal">
    <div class="bulk-modal-content" onclick="event.stopPropagation()" style="max-width: 600px;">
        <div class="modal-header" style="background: #ff9800;">
            <h3><i class="fa-solid fa-undo"></i> <span id="successReturnTitle">Pengajuan Berhasil Dikembalikan</span></h3>
            <button class="close-modal" onclick="closeModal('successReturnModal')">&times;</button>
        </div>
        <div style="padding:25px;text-align:center">
            <div style="width:100px;height:100px;border-radius:50%;background:#fff3e0;margin:0 auto 20px;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-undo" style="font-size:50px;color:#ff9800"></i>
            </div>
            
            <h3 style="color:#ff9800;margin-bottom:10px">Berhasil Dikembalikan</h3>
            <p style="color:#666;margin-bottom:5px">
                <i class="fa-solid fa-clock"></i> Dikembalikan pada: <strong id="returnTimestamp">-</strong>
            </p>
            
            <div style="background:#fff3e0;border:1px solid #ffcc80;border-radius:8px;padding:15px;margin:20px 0">
                <div style="font-weight:600;color:#e65100;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between">
                    <span>Daftar Pengajuan</span>
                    <span id="returnItemCount" style="background:#ff9800;color:white;padding:4px 12px;border-radius:20px;font-size:12px">0 item</span>
                </div>
                <div id="returnList" style="max-height:250px;overflow-y:auto;text-align:left">
                    <!-- List akan diisi oleh JavaScript -->
                </div>
            </div>
            
            <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
                <button class="btn-bulk" onclick="closeModal('successReturnModal')" style="background:#6c757d;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                    <i class="fa-solid fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Eviden Modal (untuk multiple files) -->
<div id="evidenModal" class="modal">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3><i class="fa-solid fa-file-image"></i> File Evidence</h3>
            <button class="close-modal" onclick="closeModal('evidenModal')">&times;</button>
        </div>
        <div class="detail-content" id="evidenContent">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Data dari controller
const suratList = <?= isset($surat_list) && !empty($surat_list) ? json_encode($surat_list) : '[]' ?>;
let currentRejectId = null;
let currentRejectNamaKegiatan = null;
let currentApproveId = null;
let currentReturnNamaKegiatan = null;

// Fungsi untuk menampilkan success reject modal
function showSuccessRejectModal(count, items, isSingle = false) {
    const modal = document.getElementById('successRejectModal');
    const title = document.getElementById('successRejectTitle');
    const timestamp = document.getElementById('rejectTimestamp');
    const itemCount = document.getElementById('rejectItemCount');
    const listContainer = document.getElementById('rejectList');
    
    title.textContent = isSingle ? 'Pengajuan Berhasil Ditolak' : 'Pengajuan Berhasil Ditolak (Multiple)';
    
    // Format timestamp
    const now = new Date();
    timestamp.textContent = now.toLocaleDateString('id-ID', { 
        day: '2-digit', 
        month: 'long', 
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }) + ' WIB';
    
    itemCount.textContent = `${count} item`;
    
    // Populate list dengan data
    listContainer.innerHTML = '';
    items.forEach((item, index) => {
        const itemDiv = document.createElement('div');
        itemDiv.style.cssText = 'background:white;border:1px solid #f5c6cb;border-radius:6px;margin-bottom:8px;overflow:hidden';
        
        // Generate HTML untuk data tambahan jika ada
        let additionalInfo = '';
        if (item.rejection_notes) {
            additionalInfo = `
            <div style="background:#fff5f5;border-top:1px solid #f0f0f0;padding:10px;font-size:12px;">
                <div style="font-weight:600;color:#e74c3c;margin-bottom:5px">Alasan Penolakan:</div>
                <div style="color:#721c24">${escapeHtml(item.rejection_notes)}</div>
            </div>`;
        }
        
        itemDiv.innerHTML = `
            <div style="display:flex;align-items:center;gap:10px;padding:10px;border-bottom:1px solid #f0f0f0;">
                <i class="fas fa-times-circle" style="color:#e74c3c;font-size:20px;flex-shrink:0"></i>
                <div style="flex:1;text-align:left">
                    <div style="font-weight:600;color:#212529;font-size:14px">${escapeHtml(item.nama)}</div>
                    <div style="font-size:12px;color:#6c757d">${item.details}</div>
                </div>
                <span class="badge badge-rejected" style="flex-shrink:0">${isSingle ? 'Ditolak Dekan' : 'Ditolak Dekan (Multi)'}</span>
            </div>
            ${additionalInfo}
        `;
        listContainer.appendChild(itemDiv);
    });
    
    modal.classList.add('show');
}

// ============================================
// REJECT MODAL FUNCTIONS - VERSI BARU
// ============================================

// Fungsi untuk menampilkan reject modal baru
function showRejectModalNew(id, namaKegiatan) {
    currentRejectId = id;
    currentRejectNamaKegiatan = namaKegiatan;
    
    // Set data ke modal
    document.getElementById('rejectNamaKegiatan').textContent = namaKegiatan;
    document.getElementById('rejectionReason').value = '';
    document.getElementById('rejectForm').action = '<?= base_url("dekan/reject/") ?>' + id;
    
    // Tampilkan modal
    document.getElementById('rejectConfirmModal').classList.add('show');
}

// Fungsi untuk confirm reject dengan modal lama (untuk kompatibilitas)
function confirmRejectOld() {
    const notes = document.getElementById('rejectionNotes').value.trim();
    if (!notes) { 
        alert('Alasan penolakan harus diisi'); 
        return; 
    }
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url("dekan/reject/") ?>' + currentRejectId;
    
    const csrfName = '<?= $this->security->get_csrf_token_name() ?>';
    const csrfHash = '<?= $this->security->get_csrf_hash() ?>';
    const inpCsrf = document.createElement('input');
    inpCsrf.type='hidden'; 
    inpCsrf.name=csrfName; 
    inpCsrf.value=csrfHash;
    form.appendChild(inpCsrf);
    
    const inpNotes = document.createElement('input');
    inpNotes.type='hidden'; 
    inpNotes.name='rejection_notes'; 
    inpNotes.value=notes;
    form.appendChild(inpNotes);
    
    document.body.appendChild(form);
    form.submit();
}

// ============================================
// UPDATE TOMBOL REJECT DI TABEL
// ============================================

// Fungsi untuk meng-update tombol reject di tabel
function updateRejectButtons() {
    // Update semua tombol reject di tabel
    const rejectButtons = document.querySelectorAll('button[onclick*="showRejectModal"]');
    rejectButtons.forEach(button => {
        const onclickAttr = button.getAttribute('onclick');
        if (onclickAttr) {
            const match = onclickAttr.match(/showRejectModal\((\d+)\)/);
            if (match) {
                const id = match[1];
                const row = button.closest('tr');
                const namaKegiatan = row.querySelector('td:nth-child(2) strong')?.textContent || 'Nama Kegiatan';
                
                // Update onclick attribute ke modal baru
                button.setAttribute('onclick', `event.stopPropagation(); showRejectModalNew(${id}, '${escapeHtml(namaKegiatan)}')`);
            }
        }
    });
    
    // Update tombol reject di modal detail
    const modalRejectButtons = document.querySelectorAll('.modal-btn-reject');
    modalRejectButtons.forEach(button => {
        const onclickAttr = button.getAttribute('onclick');
        if (onclickAttr) {
            const match = onclickAttr.match(/showRejectModal\((\d+)\)/);
            if (match) {
                const id = match[1];
                // Nama kegiatan akan diambil dari modal content
                button.setAttribute('onclick', `event.stopPropagation(); closeModal('detailModal'); showRejectModalNew(${id}, document.querySelector('#detailModal .detail-row:nth-child(1) .detail-value').textContent.trim())`);
            }
        }
    });
}

// ============================================
// INISIALISASI SAAT DOM LOADED
// ============================================

// Check for success reject modal data from session
<?php if($this->session->flashdata('rejected_items')): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const rejectedItems = <?= json_encode($this->session->flashdata('rejected_items')) ?>;
        const isSingleReject = <?= json_encode($this->session->flashdata('is_single_reject')) ?>;
        
        // Tunggu sebentar agar page fully loaded
        setTimeout(function() {
            showSuccessRejectModal(rejectedItems.length, rejectedItems, isSingleReject);
        }, 500);
    });
<?php endif; ?>
// ============================================
// SUCCESS RETURN MODAL FUNCTIONS
// ============================================

// Fungsi untuk menampilkan success return modal
function showSuccessReturnModal(count, items, isSingle = false) {
    const modal = document.getElementById('successReturnModal');
    const title = document.getElementById('successReturnTitle');
    const timestamp = document.getElementById('returnTimestamp');
    const itemCount = document.getElementById('returnItemCount');
    const listContainer = document.getElementById('returnList');
    
    title.textContent = isSingle ? 'Pengajuan Berhasil Dikembalikan' : 'Pengajuan Berhasil Dikembalikan (Multiple)';
    
    // Format timestamp
    const now = new Date();
    timestamp.textContent = now.toLocaleDateString('id-ID', { 
        day: '2-digit', 
        month: 'long', 
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }) + ' WIB';
    
    itemCount.textContent = `${count} item`;
    
    // Populate list dengan data
    listContainer.innerHTML = '';
    items.forEach((item, index) => {
        const itemDiv = document.createElement('div');
        itemDiv.style.cssText = 'background:white;border:1px solid #ffcc80;border-radius:6px;margin-bottom:8px;overflow:hidden';
        
        // Generate HTML untuk data tambahan jika ada
        let additionalInfo = '';
        if (item.return_notes) {
            additionalInfo = `
            <div style="background:#fff3e0;border-top:1px solid #f0f0f0;padding:10px;font-size:12px;">
                <div style="font-weight:600;color:#ff9800;margin-bottom:5px">Catatan Pengembalian:</div>
                <div style="color:#e65100">${escapeHtml(item.return_notes)}</div>
            </div>`;
        }
        
        // Status baru setelah di-return
        const newStatusBadge = `<span class="badge badge-pending" style="background:#fff3cd;color:#856404;flex-shrink:0">${item.new_status}</span>`;
        
        itemDiv.innerHTML = `
            <div style="display:flex;align-items:center;gap:10px;padding:10px;border-bottom:1px solid #f0f0f0;">
                <i class="fas fa-undo" style="color:#ff9800;font-size:20px;flex-shrink:0"></i>
                <div style="flex:1;text-align:left">
                    <div style="font-weight:600;color:#212529;font-size:14px">${escapeHtml(item.nama)}</div>
                    <div style="font-size:12px;color:#6c757d">${item.details}</div>
                </div>
                ${newStatusBadge}
            </div>
            ${additionalInfo}
        `;
        listContainer.appendChild(itemDiv);
    });
    
    modal.classList.add('show');
}

// ============================================
// RETURN MODAL FUNCTIONS - VERSI BARU
// ============================================

// Fungsi untuk menampilkan return modal baru (TANPA CATATAN)
function showReturnModalNew(id, namaKegiatan) {
    currentReturnId = id;
    currentReturnNamaKegiatan = namaKegiatan;
    
    // Set data ke modal
    document.getElementById('returnNamaKegiatan').textContent = namaKegiatan;
    
    // Tampilkan modal
    document.getElementById('returnConfirmModal').classList.add('show');
}
// Fungsi untuk konfirmasi return (SEDERHANA TANPA CATATAN)
function confirmReturn() {
    if (!currentReturnId) return;
    
    // Buat form dan submit
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url("dekan/return_pengajuan/") ?>' + currentReturnId;
    
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

// Fungsi untuk meng-update tombol return di tabel
function updateReturnButtons() {
    // Update semua tombol return di tabel
    const returnButtons = document.querySelectorAll('button[onclick*="showReturnModal"]');
    returnButtons.forEach(button => {
        const onclickAttr = button.getAttribute('onclick');
        if (onclickAttr) {
            // Cek pattern untuk showReturnModal(id, namaKegiatan)
            const match = onclickAttr.match(/showReturnModal\((\d+),\s*'([^']+)'\)/);
            if (match) {
                const id = match[1];
                const namaKegiatan = match[2];
                
                // Update onclick attribute ke modal baru
                button.setAttribute('onclick', `event.stopPropagation(); showReturnModalNew(${id}, '${escapeHtml(namaKegiatan.replace(/'/g, "\\'"))}')`);
            } else {
                // Cek pattern lama showReturnModal(id)
                const match2 = onclickAttr.match(/showReturnModal\((\d+)\)/);
                if (match2) {
                    const id = match2[1];
                    const row = button.closest('tr');
                    const namaKegiatan = row.querySelector('td:nth-child(2) strong')?.textContent || 'Nama Kegiatan';
                    
                    // Update onclick attribute ke modal baru
                    button.setAttribute('onclick', `event.stopPropagation(); showReturnModalNew(${id}, '${escapeHtml(namaKegiatan)}')`);
                }
            }
        }
    });
    
    // Update tombol return di modal detail
    const modalReturnButtons = document.querySelectorAll('button[style*="background: #ff9800"][onclick*="showReturnModal"]');
    modalReturnButtons.forEach(button => {
        const onclickAttr = button.getAttribute('onclick');
        if (onclickAttr) {
            const match = onclickAttr.match(/showReturnModal\((\d+),\s*'([^']+)'\)/);
            if (match) {
                const id = match[1];
                const namaKegiatan = match[2];
                
                button.setAttribute('onclick', `event.stopPropagation(); closeModal('detailModal'); showReturnModalNew(${id}, '${escapeHtml(namaKegiatan.replace(/'/g, "\\'"))}')`);
            }
        }
    });
}
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

// Preview File Functions
function previewFile(fileUrl, fileName) {
    console.log('Preview File:', {
        fileName: fileName,
        fileUrl: fileUrl,
        fullUrl: fileUrl
    });
    
    const previewModal = document.getElementById('previewModal');
    const previewTitle = document.getElementById('previewTitle');
    const previewBody = document.getElementById('previewBody');
    
    previewTitle.textContent = 'Preview: ' + fileName;
    previewBody.innerHTML = `
        <div style="text-align: center; padding: 40px;">
            <i class="fas fa-spinner fa-spin" style="font-size: 48px; color: #FB8C00;"></i>
            <p style="margin-top: 15px; color: #6c757d;">Memuat preview...</p>
        </div>
    `;
    
    previewModal.classList.add('show');

    const fileExtension = fileName.split('.').pop().toLowerCase();
    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
    const pdfExtensions = ['pdf'];
    
    setTimeout(() => {
        if (imageExtensions.includes(fileExtension)) {
            const img = new Image();
            img.onload = function() {
                console.log('Image loaded successfully');
                previewBody.innerHTML = `<img src="${fileUrl}" class="preview-image" alt="${fileName}">`;
            };
            img.onerror = function() {
                console.error('Error loading image:', fileUrl);
                showUnsupportedPreview(fileUrl, fileName);
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
            showUnsupportedPreview(fileUrl, fileName);
        }
    }, 100);
}

function showUnsupportedPreview(fileUrl, fileName) {
    document.getElementById('previewBody').innerHTML = `
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

function closePreviewModal() {
    document.getElementById('previewModal').classList.remove('show');
}

// Fungsi untuk menampilkan modal eviden
async function showEvidenModal(suratId) {
    try {
        // Tampilkan loading kecil di tombol (optional)
        
        // Ambil data detail via AJAX
        const item = await getSuratDetail(suratId);
        
        if (!item) {
            alert('Data tidak ditemukan');
            return;
        }

        // Ambil dan proses data eviden
        const evidenFiles = getEvidenFilesFromData(item);
        
        if (evidenFiles.length === 0) {
            alert('Tidak ada file eviden untuk pengajuan ini.');
            return;
        }
        
        // LOGIKA BARU: Jika hanya 1 file, langsung preview
        if (evidenFiles.length === 1) {
            const file = evidenFiles[0];
            previewFile(file.url, file.name);
        } else {
            // Jika lebih dari 1 file, tampilkan modal daftar file
            showMultipleEvidenModal(item, evidenFiles);
        }
        
    } catch (error) {
        console.error('Error loading eviden:', error);
        alert('Gagal memuat eviden: ' + error.message);
    }
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

// Fungsi untuk menampilkan modal multiple eviden (lebih dari 1 file)
function showMultipleEvidenModal(item, evidenFiles) {
    // Tampilkan loading
    document.getElementById('evidenContent').innerHTML = `
        <div style="text-align:center;padding:40px;">
            <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#FB8C00"></i>
            <p style="margin-top:10px;color:#7f8c8d">Memuat eviden...</p>
        </div>
    `;
    
    document.getElementById('evidenModal').classList.add('show');
    
    // Generate content
    const content = generateMultipleEvidenContent(item, evidenFiles);
    document.getElementById('evidenContent').innerHTML = content;
}
// Fungsi untuk generate konten multiple eviden (lebih dari 1 file)
function generateMultipleEvidenContent(item, evidenFiles) {
    // Helper function
    const getVal = (k) => {
        const value = (item[k] !== undefined && item[k] !== null && item[k] !== '' ? item[k] : '-');
        return value;
    };

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

    return `       
        ${fileEvidenceHtml}
        
        <div class="modal-actions">
            <button class="modal-btn modal-btn-close" onclick="closeModal('evidenModal')">
                <i class="fa-solid fa-times"></i> Tutup
            </button>
        </div>
    `;
}
// Fungsi showDetail untuk menampilkan surat pengajuan dengan scroll lengkap
async function showDetail(id) {
    try {
        // Tampilkan loading
        document.getElementById('detailContent').innerHTML = `
            <div style="text-align:center;padding:40px;">
                <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#FB8C00"></i>
                <p style="margin-top:10px;color:#7f8c8d">Memuat surat pengajuan...</p>
            </div>
        `;
        document.getElementById('detailModal').classList.add('show');

        // Load surat pengajuan via iframe TANPA batasan tinggi
        const suratUrl = '<?= base_url("dekan/view_surat_pengajuan/") ?>' + id;
        
        document.getElementById('detailContent').innerHTML = `
            <div style="width:100%; overflow:hidden; border-radius:8px;">
                <iframe 
                    id="suratIframe"
                    src="${suratUrl}" 
                    style="width:100%; height:70vh; border:none;"
                    onload="adjustIframeHeight()"
                ></iframe>
            </div>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-close" onclick="closeModal('detailModal')">
                    <i class="fa-solid fa-times"></i> Tutup
                </button>
            </div>
        `;
        
    } catch (error) {
        console.error('Error loading surat:', error);
        document.getElementById('detailContent').innerHTML = `
            <div style="text-align:center;padding:40px;color:#e74c3c">
                <i class="fa-solid fa-exclamation-triangle" style="font-size:48px;margin-bottom:10px"></i>
                <p>Gagal memuat surat: ${error.message}</p>
                <button class="modal-btn modal-btn-close" onclick="closeModal('detailModal')" style="margin-top:20px">
                    <i class="fa-solid fa-times"></i> Tutup
                </button>
            </div>
        `;
    }
}

// Fungsi untuk menyesuaikan tinggi iframe berdasarkan konten
function adjustIframeHeight() {
    const iframe = document.getElementById('suratIframe');
    if (!iframe) return;
    
    try {
        // Tunggu sedikit untuk konten selesai dimuat
        setTimeout(() => {
            try {
                const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                const body = iframeDoc.body;
                const html = iframeDoc.documentElement;
                
                // Hitung tinggi maksimum
                const height = Math.max(
                    body.scrollHeight,
                    body.offsetHeight,
                    html.clientHeight,
                    html.scrollHeight,
                    html.offsetHeight
                );
                
                // Set tinggi iframe
                iframe.style.height = (height + 50) + 'px'; // Tambah margin
                
                console.log('Iframe height adjusted to:', height);
            } catch (e) {
                console.error('Error adjusting iframe height:', e);
                // Fallback: set tinggi tetap
                iframe.style.height = '1000px';
            }
        }, 500); // Tunggu 500ms untuk konten selesai dimuat
    } catch (e) {
        console.error('Error accessing iframe content:', e);
    }
}
// Update fungsi showApproveModal untuk kompatibilitas
function showApproveModal(id, namaKegiatan) {
    currentApproveId = id;
    document.getElementById('approveNamaKegiatan').textContent = namaKegiatan;
    document.getElementById('approveForm').action = '<?= base_url("dekan/approve/") ?>' + id;
    document.getElementById('approveModal').classList.add('show');
}

// Update fungsi showRejectModal untuk forward ke modal baru
function showRejectModal(id) {
    const row = document.querySelector(`tr[onclick*="showRowDetail(${id})"]`);
    const namaKegiatan = row ? row.querySelector('td:nth-child(2) strong')?.textContent : 'Nama Kegiatan';
    showRejectModalNew(id, namaKegiatan);
}
function confirmReject() {
    const notes = document.getElementById('rejectionNotes').value.trim();
    if (!notes) { 
        alert('Alasan penolakan harus diisi'); 
        return; 
    }
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '<?= base_url("dekan/reject/") ?>' + currentRejectId;
    
    const csrfName = '<?= $this->security->get_csrf_token_name() ?>';
    const csrfHash = '<?= $this->security->get_csrf_hash() ?>';
    const inpCsrf = document.createElement('input');
    inpCsrf.type='hidden'; 
    inpCsrf.name=csrfName; 
    inpCsrf.value=csrfHash;
    form.appendChild(inpCsrf);
    
    const inpNotes = document.createElement('input');
    inpNotes.type='hidden'; 
    inpNotes.name='rejection_notes'; 
    inpNotes.value=notes;
    form.appendChild(inpNotes);
    
    document.body.appendChild(form);
    form.submit();
}
let currentReturnId = null;

function showReturnModal(id, namaKegiatan) {
    currentReturnId = id;
    document.getElementById('returnNamaKegiatan').textContent = namaKegiatan;
    document.getElementById('returnForm').action = '<?= base_url("dekan/return_pengajuan/") ?>' + id;
    document.getElementById('returnModal').classList.add('show');
}
function closeModal(id) { 
    document.getElementById(id).classList.remove('show'); 
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

// Buat variabel global untuk chart
let chartInstance = null;

// Plugin untuk efek 3D - HARUS DITAMBAHKAN
const fusionStyle3DPlugin = {
    id: 'fusionStyle3d',
    beforeDatasetsDraw: (chart) => {
        const ctx = chart.ctx;
        chart.data.datasets.forEach((dataset, datasetIndex) => {
            const meta = chart.getDatasetMeta(datasetIndex);
            if (!meta.hidden) {
                meta.data.forEach((bar) => {
                    const x = bar.x, y = bar.y, base = bar.base, width = bar.width, height = base - y;
                    if (height <= 1) return;
                    const offsetX = 15, offsetY = -15;
                    ctx.save();
                    const rightGradient = ctx.createLinearGradient(x + width/2, y, x + width/2 + offsetX, y + offsetY);
                    let darkColor = datasetIndex === 0 ? 'rgba(0, 177, 253, 0.6)' : (datasetIndex === 1 ? 'rgba(46, 204, 113, 0.85)' : 'rgba(192, 57, 43, 0.6)');
                    rightGradient.addColorStop(0, darkColor);
                    rightGradient.addColorStop(1, 'rgba(0, 0, 0, 0.2)');
                    ctx.fillStyle = rightGradient;
                    ctx.beginPath();
                    ctx.moveTo(x + width/2, y);
                    ctx.lineTo(x + width/2 + offsetX, y + offsetY);
                    ctx.lineTo(x + width/2 + offsetX, base + offsetY);
                    ctx.lineTo(x + width/2, base);
                    ctx.closePath();
                    ctx.fill();
                    const topGradient = ctx.createLinearGradient(x - width/2, y, x + width/2 + offsetX, y + offsetY);
                    let lightColor = datasetIndex === 0 ? 'rgba(162, 217, 206, 0.9)' : (datasetIndex === 1 ? 'rgba(200, 247, 197, 0.9)' : 'rgba(245, 183, 177, 0.9)');
                    topGradient.addColorStop(0, lightColor);
                    topGradient.addColorStop(1, 'rgba(255, 255, 255, 0.2)');
                    ctx.fillStyle = topGradient;
                    ctx.beginPath();
                    ctx.moveTo(x - width/2, y);
                    ctx.lineTo(x + width/2, y);
                    ctx.lineTo(x + width/2 + offsetX, y + offsetY);
                    ctx.lineTo(x - width/2 + offsetX, y + offsetY);
                    ctx.closePath();
                    ctx.fill();
                    ctx.restore();
                });
            }
        });
    }
};

// Fungsi untuk membuat atau memperbarui grafik
function initChart() {
    const ctx = document.getElementById('grafikSurat');
    
    // Pastikan elemen canvas ada
    if (!ctx) {
        console.error('Canvas element #grafikSurat tidak ditemukan!');
        return;
    }
    
    // Pastikan context tersedia
    const chartCtx = ctx.getContext('2d');
    if (!chartCtx) {
        console.error('Tidak bisa mendapatkan context dari canvas');
        return;
    }
    
    // Hapus chart sebelumnya jika ada
    if (chartInstance) {
        chartInstance.destroy();
        chartInstance = null;
    }
    
    // Cek apakah ada filter bulan
    const bulanSelect = document.getElementById('bulanSelect');
    const selectedBulan = bulanSelect ? bulanSelect.value : 'all';
    
    // Data dari PHP (pastikan tidak null/undefined)
    const chartTotal = <?= json_encode(isset($chart_total) ? $chart_total : array_fill(0,12,0)) ?>;
    const chartApproved = <?= json_encode(isset($chart_approved) ? $chart_approved : array_fill(0,12,0)) ?>;
    const chartRejected = <?= json_encode(isset($chart_rejected) ? $chart_rejected : array_fill(0,12,0)) ?>;
    
    console.log('Data Chart:', {
        total: chartTotal,
        approved: chartApproved,
        rejected: chartRejected,
        bulan: selectedBulan
    });
    
    // Label bulan
    const monthLabels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
    
    // Jika filter bulan dipilih (bukan "all"), tampilkan hanya data bulan tersebut
    let displayLabels = monthLabels;
    let displayData = {
        labels: displayLabels,
        datasets: [
            {
                label: "Total", 
                data: chartTotal, 
                backgroundColor: 'rgba(0, 177, 253, 0.6)', 
                borderColor: 'rgba(4, 146, 207, 0.6)', 
                borderWidth: 2, 
                borderRadius: 6
            },
            {
                label: "Disetujui", 
                data: chartApproved, 
                backgroundColor: 'rgba(46, 204, 113, 0.85)', 
                borderColor: 'rgba(46, 204, 113, 1)', 
                borderWidth: 2, 
                borderRadius: 6
            },
            {
                label: "Ditolak", 
                data: chartRejected, 
                backgroundColor: 'rgba(231, 76, 60, 0.85)', 
                borderColor: 'rgba(231, 76, 60, 1)', 
                borderWidth: 2, 
                borderRadius: 6
            }
        ]
    };
    
    if (selectedBulan !== 'all') {
        const bulanIndex = parseInt(selectedBulan) - 1; // Konversi ke index 0-based
        
        // Ambil data untuk bulan yang dipilih
        const monthData = {
            total: chartTotal[bulanIndex] || 0,
            approved: chartApproved[bulanIndex] || 0,
            rejected: chartRejected[bulanIndex] || 0
        };
        
        // Buat data untuk satu bulan saja
        displayLabels = [monthLabels[bulanIndex]];
        displayData = {
            labels: displayLabels,
            datasets: [
                {
                    label: "Total", 
                    data: [monthData.total], 
                    backgroundColor: 'rgba(0, 177, 253, 0.6)', 
                    borderColor: 'rgba(4, 146, 207, 0.6)', 
                    borderWidth: 2, 
                    borderRadius: 6,
                },
                {
                    label: "Disetujui", 
                    data: [monthData.approved], 
                    backgroundColor: 'rgba(46, 204, 113, 0.85)', 
                    borderColor: 'rgba(46, 204, 113, 1)', 
                    borderWidth: 2, 
                    borderRadius: 6
                },
                {
                    label: "Ditolak", 
                    data: [monthData.rejected], 
                    backgroundColor: 'rgba(231, 76, 60, 0.85)', 
                    borderColor: 'rgba(231, 76, 60, 1)', 
                    borderWidth: 2, 
                    borderRadius: 6
                }
            ]
        };
        
        console.log('Filter Bulan:', {
            bulanIndex: bulanIndex,
            monthData: monthData,
            displayData: displayData
        });
    }
    
    try {
        // Buat chart baru
        chartInstance = new Chart(chartCtx, {
            type: 'bar',
            data: displayData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top', 
                        labels: {
                            padding: 20, 
                            font: {size: 14, weight: '700'}, 
                            color: '#000000ff'
                        }
                    }, 
                    tooltip: {
                        backgroundColor: 'rgba(44, 62, 80, 0.95)', 
                        padding: 16
                    }
                },
                scales: {
                    x: {
                        grid: {display: false}, 
                        ticks: {color: '#000000ff'},
                    }, 
                    y: {
                        beginAtZero: true, 
                        grid: {color: 'rgba(12, 7, 7, 0.08)'}, 
                        ticks: {color: '#95a5a6'}
                    }
                },
                animation: {
                    duration: 1800, 
                    easing: 'easeInOutQuart'
                }
            },
            plugins: [fusionStyle3DPlugin]
        });
        
        console.log('Chart berhasil dibuat!');
    } catch (error) {
        console.error('Error membuat chart:', error);
        
        // Fallback: tampilkan pesan error
        const container = document.querySelector('.chart-container');
        if (container) {
            container.innerHTML = `
                <div style="text-align:center;padding:40px;color:#e74c3c">
                    <i class="fa-solid fa-exclamation-triangle" style="font-size:48px;margin-bottom:10px"></i>
                    <h4>Gagal Memuat Grafik</h4>
                    <p>Error: ${error.message}</p>
                    <p style="margin-top:10px;color:#7f8c8d">
                        Data: Total=${JSON.stringify(chartTotal)}, 
                        Disetujui=${JSON.stringify(chartApproved)}, 
                        Ditolak=${JSON.stringify(chartRejected)}
                    </p>
                </div>
            `;
        }
    }
}

// Inisialisasi chart saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM siap, inisialisasi chart...');
    setTimeout(initChart, 100); // Tunggu sedikit untuk memastikan semua element siap
});

// Fungsi untuk filter berdasarkan bulan
function filterByBulan(bulan) {
    const tahun = document.getElementById('tahunSelect').value;
    
    // Jika memilih "Semua Bulan", redirect ke URL tanpa parameter bulan
    if (bulan === 'all') {
        window.location.href = "<?= base_url('dekan?tahun=') ?>" + tahun;
    } else {
        // Redirect dengan parameter tahun dan bulan
        window.location.href = "<?= base_url('dekan?tahun=') ?>" + tahun + "&bulan=" + bulan;
    }
}

// Fungsi update tahun yang sudah ada, modifikasi untuk handle bulan
function updateTahun(year) {
    const bulan = document.getElementById('bulanSelect').value;
    if (bulan === 'all') {
        window.location.href = "<?= base_url('dekan?tahun=') ?>" + year;
    } else {
        window.location.href = "<?= base_url('dekan?tahun=') ?>" + year + "&bulan=" + bulan;
    }
}
// ============================================
// SUCCESS MODAL FUNCTIONS - UNTUK APPROVAL
// ============================================

function refreshPage() {
    window.location.reload();
}

// Variabel untuk menyimpan ID approval sementara
let pendingApproveId = null;

// Process single approve WITH modal confirmation
function approveSurat(id) {
    pendingApproveId = id;
    
    // Cari data surat
    const surat = suratList.find(s => Number(s.id) === Number(id));
    
    if (surat) {
        document.getElementById('approveSingleName').textContent = surat.nama_kegiatan || '-';
        document.getElementById('approveSingleDetails').textContent = 
            `📅 ${formatDate(surat.tanggal_kegiatan)} | 📍 ${surat.penyelenggara || '-'} | ${surat.status}`;
    }
    
    document.getElementById('approveConfirmModal').classList.add('show');
}

function confirmSingleApprove() {
    if (!pendingApproveId) return;
    
    closeModal('approveConfirmModal');
    
    // Submit approval
    window.location.href = `<?= base_url("dekan/approve/") ?>${pendingApproveId}`;
}

// Fungsi untuk menampilkan success modal (dipanggil dari controller via session)
function showSuccessModal(count, items, isSingle = false) {
    const modal = document.getElementById('successResultModal');
    const title = document.getElementById('successResultTitle');
    const timestamp = document.getElementById('successTimestamp');
    const itemCount = document.getElementById('successItemCount');
    const listContainer = document.getElementById('successList');
    
    title.textContent = isSingle ? 'Pengajuan Berhasil Disetujui' : 'Pengajuan Berhasil Disetujui (Multiple)';
    
    // Format timestamp
    const now = new Date();
    timestamp.textContent = now.toLocaleDateString('id-ID', { 
        day: '2-digit', 
        month: 'long', 
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }) + ' WIB';
    
    itemCount.textContent = `${count} item`;
    
    // Populate list
    listContainer.innerHTML = '';
    items.forEach((item, index) => {
        const itemDiv = document.createElement('div');
        itemDiv.style.cssText = 'background:white;border:1px solid #c3e6cb;border-radius:6px;margin-bottom:8px;overflow:hidden';
        
        // Ambil data dosen dari item
        const dosenData = item.dosen_data || [];
        const dosenHtml = generateDosenHtmlForSuccessModal(dosenData);
        
        itemDiv.innerHTML = `
            <div style="display:flex;align-items:center;gap:10px;padding:10px;border-bottom:1px solid #f0f0f0;">
                <i class="fas fa-check-circle" style="color:#27ae60;font-size:20px;flex-shrink:0"></i>
                <div style="flex:1;text-align:left">
                    <div style="font-weight:600;color:#212529;font-size:14px">${escapeHtml(item.nama)}</div>
                    <div style="font-size:12px;color:#6c757d">${item.details}</div>
                </div>
                <span class="badge badge-approved" style="flex-shrink:0">${isSingle ? 'Disetujui' : 'Disetujui (Multi)'}</span>
            </div>
            ${dosenHtml}
        `;
        listContainer.appendChild(itemDiv);
    });
    
    modal.classList.add('show');
    
    // Inisialisasi toggle dosen setelah modal ditampilkan
    setTimeout(initSuccessDosenList, 100);
}
// Fungsi untuk generate HTML dosen di success modal
function generateDosenHtmlForSuccessModal(dosenData) {
    if (!dosenData || dosenData.length === 0) {
        return '';
    }
    
    const maxVisible = 3; // Tampilkan maksimal 3 dosen secara default
    const isOverLimit = dosenData.length > maxVisible;
    const visibleDosen = isOverLimit ? dosenData.slice(0, maxVisible) : dosenData;
    const hiddenDosen = isOverLimit ? dosenData.slice(maxVisible) : [];
    const uniqueId = 'dosen-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
    
    return `
    <div class="success-dosen-container">
        <div class="success-dosen-title">
            <span>Dosen Terlibat</span>
            <span class="success-dosen-count">${dosenData.length} Dosen</span>
        </div>
        
        <div class="success-dosen-list" id="${uniqueId}">
            ${visibleDosen.map((dosen, index) => `
            <div class="success-dosen-item" data-index="${index}">
                <div class="success-dosen-avatar">
                    ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
                </div>
                <div class="success-dosen-info">
                    <div class="success-dosen-name">${escapeHtml(dosen.nama)}</div>
                    <div class="success-dosen-details">
                        ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}
                    </div>
                </div>
            </div>
            `).join('')}
            
            ${hiddenDosen.map((dosen, index) => `
            <div class="success-dosen-item success-dosen-hidden" data-index="${maxVisible + index}">
                <div class="success-dosen-avatar">
                    ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
                </div>
                <div class="success-dosen-info">
                    <div class="success-dosen-name">${escapeHtml(dosen.nama)}</div>
                    <div class="success-dosen-details">
                        ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}
                    </div>
                </div>
            </div>
            `).join('')}
        </div>
        
        ${isOverLimit ? `
        <button class="success-dosen-more-btn" onclick="toggleSuccessDosenList('${uniqueId}', this)">
            <i class="fa-solid fa-chevron-down"></i>
            <span>Tampilkan ${hiddenDosen.length} Dosen Lainnya</span>
        </button>
        ` : ''}
    </div>`;
}
// Fungsi untuk toggle show more/less dosen di success modal
function toggleSuccessDosenList(containerId, button) {
    const container = document.getElementById(containerId);
    const hiddenItems = container.querySelectorAll('.success-dosen-hidden');
    const icon = button.querySelector('i');
    const textSpan = button.querySelector('span');
    
    if (container.classList.contains('success-dosen-show-all')) {
        // Collapse - sembunyikan dosen setelah 3
        container.classList.remove('success-dosen-show-all');
        icon.className = 'fa-solid fa-chevron-down';
        textSpan.textContent = `Tampilkan ${hiddenItems.length} Dosen Lainnya`;
    } else {
        // Expand - tampilkan semua dosen
        container.classList.add('success-dosen-show-all');
        icon.className = 'fa-solid fa-chevron-up';
        textSpan.textContent = 'Sembunyikan';
    }
}

// Fungsi untuk inisialisasi dosen list di success modal
function initSuccessDosenList() {
    const containers = document.querySelectorAll('.success-dosen-list');
    containers.forEach(container => {
        const hiddenItems = container.querySelectorAll('.success-dosen-hidden');
        const button = container.parentElement.querySelector('.success-dosen-more-btn');
        
        if (button && hiddenItems.length > 0) {
            const textSpan = button.querySelector('span');
            if (textSpan) {
                textSpan.textContent = `Tampilkan ${hiddenItems.length} Dosen Lainnya`;
            }
        }
    });
}
// Update fungsi showRowDetail untuk menggunakan generateDetailContentEnhanced
async function showRowDetail(id) {
    try {
        // Tampilkan loading
        document.getElementById('detailContent').innerHTML = `
            <div style="text-align:center;padding:40px;">
                <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#FB8C00"></i>
                <p style="margin-top:10px;color:#7f8c8d">Memuat detail pengajuan...</p>
            </div>
        `;
        
        // Tampilkan modal
        document.getElementById('detailModal').classList.add('show');
        
        // Ambil data detail via AJAX
        const data = await getSuratDetail(id);
        
        if (!data) {
            throw new Error('Data tidak ditemukan');
        }
        
        // Generate HTML untuk detail pengajuan ENHANCED
        const detailHtml = generateDetailContentEnhanced(data);
        document.getElementById('detailContent').innerHTML = detailHtml;
        
    } catch (error) {
        console.error('Error loading detail:', error);
        document.getElementById('detailContent').innerHTML = `
            <div style="text-align:center;padding:40px;color:#e74c3c">
                <i class="fa-solid fa-exclamation-triangle" style="font-size:48px;margin-bottom:10px"></i>
                <p>Gagal memuat detail: ${error.message}</p>
                <button class="modal-btn modal-btn-close" onclick="closeModal('detailModal')" style="margin-top:20px">
                    <i class="fa-solid fa-times"></i> Tutup
                </button>
            </div>
        `;
    }
}

// Fungsi untuk generate konten detail (TANPA eviden dan timeline)
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
    
    // Generate HTML untuk data dosen
    let dosenHtml = '';
    if (dosenData && dosenData.length > 0) {
        dosenHtml = `
        <div class="dosen-list">
            ${dosenData.map((dosen, index) => `
            <div class="dosen-item">
                <div class="dosen-avatar">
                    ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
                </div>
                <div class="dosen-info">
                    <div class="dosen-name">${escapeHtml(dosen.nama)}</div>
                    <div class="dosen-details">
                        NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)} | Divisi: ${escapeHtml(dosen.divisi)}
                    </div>
                </div>
            </div>
            `).join('')}
        </div>`;
    } else {
        dosenHtml = `
        <div class="dosen-item">
            <div class="dosen-avatar">
                ?
            </div>
            <div class="dosen-info">
                <div class="dosen-name">Data dosen tidak tersedia</div>
                <div class="dosen-details">Informasi dosen tidak ditemukan</div>
            </div>
        </div>`;
    }
    
    // Tampilkan nomor surat jika sudah disetujui
    let nomorSuratHtml = '';
    if (getVal('nomor_surat') && getVal('nomor_surat') !== '-') {
        nomorSuratHtml = `
        <div class="nomor-surat-container">
            <div class="nomor-surat-label">
                <i class="fa-solid fa-file-signature"></i> Nomor Surat
            </div>
            <div class="nomor-surat-value">
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
    
    // KEMBALIKAN KE FORMAT SEBELUMNYA - TANPA EVIDEN DAN TIMELINE
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
                <div class="detail-label">Periode Kegiatan</div>
                <div class="detail-value">${escapeHtml(getVal('periode_kegiatan'))}</div>
            </div>
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
    <button class="modal-btn modal-btn-close" onclick="closeModal('detailModal')">
        <i class="fa-solid fa-times"></i> Tutup
    </button>
    ${getVal('status') === 'disetujui sekretariat' ? `
    <div style="display:flex;gap:10px;margin-left:auto">
        <button class="modal-btn modal-btn-reject" onclick="event.stopPropagation(); showRejectModal(${item.id})">
            <i class="fa-solid fa-times"></i> Tolak
        </button>
        <button class="modal-btn modal-btn-approve" onclick="event.stopPropagation(); showApproveModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
            <i class="fa-solid fa-check"></i> Setujui
        </button>
    </div>
    ` : (getVal('status') === 'disetujui dekan' || getVal('status') === 'ditolak dekan') ? `
    <div style="display:flex;gap:10px;margin-left:auto">
        <button class="modal-btn" style="background: #ff9800;" onclick="event.stopPropagation(); closeModal('detailModal'); showReturnModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
            <i class="fa-solid fa-undo"></i> Kembalikan
        </button>
    </div>
    ` : ''}
</div>`;
}
// Fungsi untuk membuat baris tabel clickable
function makeRowsClickable() {
    const rows = document.querySelectorAll('#tableBody tr:not(#emptyRow)');
    
    rows.forEach(row => {
        // Tambahkan class clickable
        row.classList.add('clickable-row');
        
        // Ambil ID dari onclick attribute yang sudah ada
        const onclickAttr = row.getAttribute('onclick');
        if (onclickAttr) {
            const match = onclickAttr.match(/showRowDetail\((\d+)\)/);
            
            if (match) {
                const suratId = match[1];
                
                // Event listener untuk klik row (sebagai backup)
                row.addEventListener('click', function(e) {
                    // Jangan trigger jika yang diklik adalah tombol atau link
                    if (e.target.closest('button') || 
                        e.target.closest('a') || 
                        e.target.closest('select') ||
                        e.target.closest('textarea') ||
                        e.target.closest('input')) {
                        return;
                    }
                    
                    // Remove highlight dari row lain
                    rows.forEach(r => r.classList.remove('selected'));
                    
                    // Add highlight ke row yang diklik
                    this.classList.add('selected');
                    
                    // Buka modal detail
                    showRowDetail(suratId);
                });
                
                // Hover effect
                row.style.cursor = 'pointer';
            }
        }
    });
}

// Update DOM saat dimuat
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM siap, inisialisasi...');
    setTimeout(initChart, 100);
    
    // Inisialisasi clickable rows
    makeRowsClickable();
    
    // Update tombol reject
    updateRejectButtons();
    
    // Update tombol return
    updateReturnButtons();
    
    // Check for success modal data
    <?php if($this->session->flashdata('approved_items')): ?>
        const approvedItems = <?= json_encode($this->session->flashdata('approved_items')) ?>;
        const isSingle = <?= json_encode($this->session->flashdata('is_single_approve')) ?>;
        
        setTimeout(function() {
            showSuccessModal(approvedItems.length, approvedItems, isSingle);
        }, 500);
    <?php endif; ?>
    
    // Check for success reject modal data
    <?php if($this->session->flashdata('rejected_items')): ?>
        const rejectedItems = <?= json_encode($this->session->flashdata('rejected_items')) ?>;
        const isSingleReject = <?= json_encode($this->session->flashdata('is_single_reject')) ?>;
        
        setTimeout(function() {
            showSuccessRejectModal(rejectedItems.length, rejectedItems, isSingleReject);
        }, 500);
    <?php endif; ?>
    
    // Check for success return modal data
    <?php if($this->session->flashdata('returned_items')): ?>
        console.log('Ada data returned_items dari session');
        const returnedItems = <?= json_encode($this->session->flashdata('returned_items')) ?>;
        const isSingleReturn = <?= json_encode($this->session->flashdata('is_single_return')) ?>;
        
        setTimeout(function() {
            console.log('Menampilkan success return modal dengan data:', returnedItems);
            showSuccessReturnModal(returnedItems.length, returnedItems, isSingleReturn);
        }, 800);
    <?php else: ?>
        console.log('Tidak ada data returned_items dari session');
    <?php endif; ?>
});

// Jika ada filter/reload tabel, panggil lagi
function refreshTable() {
    setTimeout(() => {
        makeRowsClickable();
    }, 100);
}

// ============================================
// FUNGSI GENERATE DETAIL CONTENT - IMPROVED
// ============================================

function generateDetailContentEnhanced(item) {
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

    // Generate HTML untuk data dosen
    let dosenHtml = '';
    if (dosenData && dosenData.length > 0) {
        dosenHtml = `
        <div class="dosen-list">
            ${dosenData.map((dosen, index) => `
            <div class="dosen-item">
                <div class="dosen-avatar">
                    ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
                </div>
                <div class="dosen-info">
                    <div class="dosen-name">${escapeHtml(dosen.nama)}</div>
                    <div class="dosen-details">
                        NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)} | Divisi: ${escapeHtml(dosen.divisi)}
                    </div>
                </div>
            </div>
            `).join('')}
        </div>`;
    } else {
        dosenHtml = `
        <div class="dosen-item">
            <div class="dosen-avatar">
                ?
            </div>
            <div class="dosen-info">
                <div class="dosen-name">Data dosen tidak tersedia</div>
                <div class="dosen-details">Informasi dosen tidak ditemukan</div>
            </div>
        </div>`;
    }

    // Tampilkan nomor surat jika sudah disetujui
    let nomorSuratHtml = '';
    if (getVal('nomor_surat') && getVal('nomor_surat') !== '-') {
        nomorSuratHtml = `
        <div class="nomor-surat-container">
            <div class="nomor-surat-label">
                <i class="fa-solid fa-file-signature"></i> Nomor Surat
            </div>
            <div class="nomor-surat-value">
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
        <button class="modal-btn modal-btn-close" onclick="closeModal('detailModal')">
            <i class="fa-solid fa-times"></i> Tutup
        </button>
        ${getVal('status') === 'disetujui sekretariat' ? `
<div style="display:flex;gap:10px;margin-left:auto">
    <button class="modal-btn modal-btn-reject" onclick="event.stopPropagation(); closeModal('detailModal'); showRejectModalNew(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
        <i class="fa-solid fa-times"></i> Tolak
    </button>
    <button class="modal-btn modal-btn-approve" onclick="event.stopPropagation(); showApproveModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
        <i class="fa-solid fa-check"></i> Setujui
    </button>
</div>
` : ''}
    </div>`;
}
</script>
</body>
</html>