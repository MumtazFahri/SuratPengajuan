<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Sekretariat</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:#f5f7fa;}
    .navbar{background:#16A085;color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 4px rgba(0,0,0,0.1);}
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
    .modal-header{background:#16A085;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
    .modal-header h3{margin:0;font-size:18px;font-weight:600}
    .close-modal{background:none;border:0;color:white;font-size:24px;cursor:pointer;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:background 0.2s}
    .close-modal:hover{background:rgba(255,255,255,0.2)}
    
    /* Detail Content Styles - IMPROVED (SAMA DENGAN DASHBOARD DEKAN) */
    .detail-content{padding:25px;max-height:calc(85vh - 80px);overflow-y:auto}
    .detail-section{margin-bottom:25px;background:#f8f9fa;border-radius:12px;padding:20px;border:1px solid #e9ecef}
    .detail-section:last-child{margin-bottom:0}
    .detail-section-title{font-size:16px;font-weight:700;color:#16A085;margin-bottom:15px;padding-bottom:10px;border-bottom:2px solid #16A085;display:flex;align-items:center;gap:10px}
    .detail-section-title i{font-size:18px}
    .detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:15px}
    .detail-row{display:flex;flex-direction:column;margin-bottom:12px}
    .detail-label{font-weight:600;color:#495057;font-size:13px;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.5px}
    .detail-value{color:#212529;font-size:14px;background:white;padding:10px 15px;border-radius:8px;border:1px solid #e9ecef;min-height:40px;display:flex;align-items:center}
    .detail-value-empty{color:#6c757d;font-style:italic;background:#f8f9fa !important}
    
    /* Dosen list in detail - NEW STYLES (SAMA DENGAN DASHBOARD DEKAN) */
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
        background: #16A085;
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
    
    /* File Evidence Styles (SAMA DENGAN DASHBOARD DEKAN) */
    .file-evidence{margin-top:10px}
    .file-item{display:flex;align-items:center;gap:12px;padding:12px 15px;background:white;border:1px solid #e9ecef;border-radius:8px;transition:all 0.2s}
    .file-item:hover{background:#e8f6f3;border-color:#16A085}
    .file-icon{width:24px;height:24px;display:flex;align-items:center;justify-content:center;color:#16A085;font-size:16px}
    .file-info{flex:1}
    .file-name{font-weight:600;color:#212529;font-size:14px;cursor:pointer}
    .file-name:hover{color:#16A085}
    .file-size{font-size:12px;color:#6c757d}
    .preview-btn{background:#3498db;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:6px;text-decoration:none}
    .preview-btn:hover{background:#2980b9;color:white;text-decoration:none}
    .preview-btn.disabled{background:#bdc3c7;cursor:not-allowed;opacity:0.6}
    .preview-btn.disabled:hover{background:#bdc3c7}
    .download-btn{background:#16A085;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;transition:background 0.2s;display:flex;align-items:center;gap:6px;text-decoration:none}
    .download-btn:hover{background:#138D75;color:white;text-decoration:none}

    /* Preview Modal Styles */
    .preview-modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:10000;justify-content:center;align-items:center;padding:20px}
    .preview-modal.show{display:flex}
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
    
    /* Action Buttons in Modal (SAMA DENGAN DASHBOARD DEKAN) */
    .modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:20px;padding-top:20px;border-top:1px solid #e9ecef}
    .modal-btn{padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;transition:all 0.2s;display:flex;align-items:center;gap:8px}
    .modal-btn-close{background:#6c757d;color:white}
    .modal-btn-close:hover{background:#5a6268;transform:translateY(-2px)}
    .modal-btn-approve{background:#27ae60;color:white}
    .modal-btn-approve:hover{background:#229954;transform:translateY(-2px)}
    .modal-btn-reject{background:#e74c3c;color:white}
    .modal-btn-reject:hover{background:#c0392b;transform:translateY(-2px)}
    
    /* Rejection Notes Styles (SAMA DENGAN DASHBOARD DEKAN) */
    .rejection-notes{background:#fff5f5;border:1px solid #f8d7da;border-radius:8px;padding:20px;margin-top:15px}
    .rejection-notes .detail-label{color:#dc3545;font-weight:700}
    .rejection-notes .detail-value{background:#fff5f5;border-color:#f8d7da;color:#721c24;font-size:14px;line-height:1.5;min-height:auto;padding:12px}
    
    /* Approve Modal Styles */
    .approve-modal-content{background:white;padding:0;border-radius:15px;max-width:550px;width:95%;max-height:85vh;overflow:hidden;animation:slideIn 0.3s ease;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
    .approve-modal-body{padding:25px}
    .approve-modal-header{background:#27ae60;color:white;padding:20px 25px;display:flex;justify-content:space-between;align-items:center;border-radius:15px 15px 0 0}
    .approve-modal-header h3{margin:0;font-size:18px;font-weight:600}
    .approve-info-box{background:#e8f6f3;border:1px solid #16A085;border-radius:8px;padding:15px;margin-bottom:20px}
    .approve-info-box strong{color:#16A085;display:block;margin-bottom:5px}
    .approve-info-box span{color:#2c3e50;font-weight:600}
    .form-group{margin-bottom:20px}
    .form-group label{display:block;margin-bottom:8px;font-weight:600;color:#2c3e50;font-size:14px}
    .form-control{width:100%;padding:12px 15px;border:2px solid #ddd;border-radius:8px;font-family:inherit;font-size:14px;transition:border-color 0.2s}
    .form-control:focus{outline:none;border-color:#3498db;box-shadow:0 0 0 3px rgba(52, 152, 219, 0.2)}
    .form-hint{color:#7f8c8d;font-size:12px;margin-top:5px;display:flex;align-items:center;gap:5px}
    .approve-modal-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:25px;padding-top:20px;border-top:1px solid #e9ecef}
    .approve-btn{padding:10px 20px;border-radius:8px;border:none;cursor:pointer;font-weight:600;font-size:14px;transition:all 0.2s;display:flex;align-items:center;gap:8px}
    .approve-btn-cancel{background:#95a5a6;color:white}
    .approve-btn-cancel:hover{background:#7f8c8d;transform:translateY(-2px)}
    .approve-btn-submit{background:#27ae60;color:white}
    .approve-btn-submit:hover{background:#229954;transform:translateY(-2px)}
    
    /* Tombol Eviden - WARNA HIJAU TETAP */
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

    /* Progress Bar Styles - DITAMBAHKAN UNTUK DETAIL MODAL */
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
    
    /* Nomor Surat Styles (SAMA DENGAN DASHBOARD DEKAN) */
    .nomor-surat-container {
        background: linear-gradient(135deg, #e8f6f3 0%, #d1f2eb 100%);
        border: 2px solid #16A085;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .nomor-surat-label {
        font-size: 14px;
        font-weight: 600;
        color: #16A085;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .nomor-surat-value {
        font-size: 18px;
        font-weight: 700;
        color: #117864;
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
    /* Overlay Latar Belakang */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(2px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

/* Box Modal */
.modal-box {
    background: #fff;
    padding: 30px 35px;
    width: 350px;
    border-radius: 14px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    animation: fadeIn .25s ease;
}

.modal-box h2 {
    margin-bottom: 18px;
    font-size: 22px;
    font-weight: 700;
    color: #222;
}

/* Input PIN */
.pin-input {
    width: 100%;
    padding: 12px;
    font-size: 20px;
    letter-spacing: 6px;
    text-align: center;
    border: 2px solid #dadada;
    border-radius: 8px;
    outline: none;
    transition: .2s;
}

.pin-input:focus {
    border-color: #0066ff;
    box-shadow: 0 0 6px rgba(0,102,255,0.3);
}

/* Tombol */
.modal-actions {
    margin-top: 22px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.btn-primary,
.btn-secondary {
    padding: 8px 20px;
    font-size: 15px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: .2s;
}

/* Tombol Lanjut */
.btn-primary {
    background: #0066ff;
    color: #fff;
}

.btn-primary:hover {
    background: #0052cc;
}

/* Tombol Batal */
.btn-secondary {
    background: #f0f0f0;
}

.btn-secondary:hover {
    background: #e0e0e0;
}

/* Animasi */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(.95); }
    to   { opacity: 1; transform: scale(1); }
}
/* Card wrapper */
.disposisi-card {
    background: #ffffff;
    padding: 18px 20px;
    border-radius: 12px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.12);
    margin-top: 10px;
    border: 1px solid #eee;
}

/* Label */
.label-disposisi {
    font-weight: 600;
    color: #333;
    font-size: 14px;
    margin-bottom: 6px;
    display: block;
}

/* Dropdown */
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

.select-disposisi:focus {
    border-color: #0080ff;
    background: #fff;
    box-shadow: 0 0 5px rgba(0,128,255,0.2);
}

/* Textarea */
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
}

.textarea-disposisi:focus {
    border-color: #0080ff;
    background: #fff;
    box-shadow: 0 0 5px rgba(0,128,255,0.2);
}

/* Tombol */
.btn-disposisi {
    margin-top: 10px;
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    background: #007bff;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: .2s;
}

.btn-disposisi:hover {
    background: #0066d6;
}
/* Gaya tambahan untuk PIN */
    .pin-input-container {
        position: relative;
        margin: 15px 0;
    }

    .pin-input-with-icon {
        width: 100%;
        padding: 12px 12px 12px 40px;
        font-size: 20px;
        letter-spacing: 6px;
        text-align: center;
        border: 2px solid #dadada;
        border-radius: 8px;
        outline: none;
        transition: .2s;
    }

    .pin-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 20px;
    }

    .pin-input-with-icon:focus {
        border-color: #0066ff;
        box-shadow: 0 0 6px rgba(0,102,255,0.3);
    }

    /* Gaya untuk catatan panjang */
    .catatan-container {
        margin-top: 10px;
    }

    .catatan-content {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 12px;
        max-height: 150px;
        overflow-y: auto;
        font-size: 14px;
        line-height: 1.5;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .catatan-panjang {
        display: block;
        max-height: none;
        overflow-y: visible;
    }
/* Clickable Row Styles - IMPROVED */
.clickable-row {
    cursor: pointer !important;
    transition: all 0.2s ease;
}

.clickable-row:hover {
    background-color: #f0f8ff !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.clickable-row:active {
    background-color: #e3f2fd !important;
    transform: scale(0.998);
}

/* Highlight untuk baris yang sedang dipilih */
.clickable-row.selected {
    background-color: #e8f6f3 !important;}

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
.modal-pin-box {
    background: #ffffff;
    width: 360px;
    padding: 28px;
    border-radius: 14px;
    text-align: center;
    box-shadow: 0 12px 35px rgba(0,0,0,0.18);
    animation: fadeInUp 0.25s ease-out;
}

@keyframes fadeInUp {
    from {opacity: 0; transform: translateY(15px);}
    to   {opacity: 1; transform: translateY(0);}
}

.modal-pin-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 5px;
    color: #2c3e50;
}

.modal-pin-title i {
    color: #16A085;
    margin-right: 6px;
}

.modal-pin-sub {
    font-size: 12px;
    color: #7f8c8d;
    margin-bottom: 20px;
}

.pin-field {
    margin-bottom: 12px;
}

.pin-field input {
    width: 100%;
    padding: 12px 14px;
    border: 2px solid #dfe6e9;
    border-radius: 8px;
    font-size: 15px;
    transition: 0.25s;
}

.pin-field input:focus {
    border-color: #16A085;
    outline: none;
    box-shadow: 0 0 0px 3px rgba(22,160,133,0.12);
}

.modal-pin-buttons {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-top: 18px;
}

.btn-save {
    background: #16A085;
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.btn-save:hover {
    background: #138a70;
}

.btn-cancel {
    background: #b2bec3;
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.btn-cancel:hover {
    background: #a4aeb3;
}
/* Styling untuk info disposisi dengan timestamp */
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
SUCCESS RESULT MODAL (SAMA SEPERTI DEKAN)
================================= */
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

/* Dosen List di Success Modal - WARNA UNGU */
.success-dosen-container {
background: #f5eef8;
border: 1px solid #d7bde2;
border-radius: 8px;
padding: 15px;
margin: 15px 0;
}

.success-dosen-title {
font-weight: 600;
color: #16A085;
margin-bottom: 10px;
display: flex;
align-items: center;
justify-content: space-between;
}

.success-dosen-count {
background: #16A085;
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
border: 1px solid #e8daef;
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
background: #16A085;
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
background: #8E44AD;
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
background: #16A085;
}

.success-dosen-hidden {
display: none;
}

.success-dosen-show-all .success-dosen-item {
display: flex !important;
}
/* ============================================
REJECT MODAL STYLES (SAMA SEPERTI APPROVE MODAL)
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
SUCCESS REJECT MODAL
================================= */
.success-reject-content {
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
/* Modal Nomor Surat Specific Styles */
#nomorSuratInfoBox {
background: #e8f6f3;
border: 1px solid #16A085;
border-radius: 8px;
padding: 15px;
margin-bottom: 20px;
}

#nomorSuratInfoBox strong {
color: #16A085;
display: block;
margin-bottom: 8px;
}

#nomorSuratInfoBox p {
color: #2c3e50;
margin-bottom: 4px;
font-size: 13px;
}

#nomorSuratError {
background: #fff5f5;
border: 1px solid #f8cccc;
border-radius: 6px;
padding: 10px;
margin-top: 10px;
}

/* Success Modal Nomor Surat */
#successNomorValue {
background: white;
border: 2px dashed #3498db;
border-radius: 8px;
padding: 15px;
text-align: center;
margin: 10px 0;
font-family: 'Courier New', monospace;
letter-spacing: 1px;
}
</style>
</head>
<body>

<div class="navbar">
    <h2><i class="fa-solid fa-clipboard-list"></i> Dashboard Sekretariat</h2>
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
    $pending_count = isset($pending_count) ? (int)$pending_count : 0;
    $approved_count = isset($approved_count) ? (int)$approved_count : 0;
    $rejected_count = isset($rejected_count) ? (int)$rejected_count : 0;
    ?>

<!-- Statistik Grid yang Diperkecil -->
<div class="stats-grid" style="gap: 10px; margin-bottom: 15px;">
    <!-- Total Pengajuan -->
    <a href="<?= base_url('sekretariat/semua') ?>" class="stat-card" style="
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
    <a href="<?= base_url('sekretariat/pending') ?>" class="stat-card" style="
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
    <a href="<?= base_url('sekretariat/disetujui') ?>" class="stat-card" style="
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
    <a href="<?= base_url('sekretariat/ditolak') ?>" class="stat-card" style="
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
    
    <!-- TAMBAHAN BARU: Filter Divisi -->
    <div>
        <label style="display:block;margin-bottom:5px;font-weight:600;color:#7f8c8d">
            <i class="fa-solid fa-building"></i> Filter Unit
        </label>
        <select class="filter-select" id="divisiSelect" onchange="filterByDivisi(this.value)">
            <option value="all">Semua Unit</option>
            <?php if(isset($divisi_list) && !empty($divisi_list)): ?>
                <?php foreach($divisi_list as $divisi): ?>
                    <option value="<?= htmlspecialchars($divisi) ?>" 
                        <?= (isset($divisi_filter) && $divisi_filter == $divisi ? 'selected' : '') ?>>
                        <?= htmlspecialchars($divisi) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
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
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fa-solid fa-file-alt"></i> Detail Pengajuan Surat Tugas</h3>
            <button class="close-modal" onclick="closeModalPre('detailModal')">&times;</button>
        </div>
        <div class="detail-content" id="detailContent">
            <!-- Content akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<!-- Approve Modal Sederhana -->
<div id="approveModal" class="modal">
<div class="approve-modal-content" style="max-width: 450px;">
    <div class="approve-modal-header">
        <h3><i class="fa-solid fa-check-circle"></i> Konfirmasi Persetujuan</h3>
        <button class="close-modal" onclick="closeModal('approveModal')">&times;</button>
    </div>
    <div class="approve-modal-body">
        <div style="text-align:center;margin-bottom:20px">
            <i class="fa-solid fa-question-circle" style="font-size:48px;color:#27ae60;margin-bottom:15px"></i>
            <h4 style="color:#2c3e50;margin-bottom:10px">Setujui Pengajuan?</h4>
            <p id="approveNamaKegiatan" style="font-weight:600;color:#7f8c8d;margin-bottom:20px"></p>
        </div>
        
        <div class="approve-modal-actions">
            <button type="button" class="approve-btn approve-btn-cancel" onclick="closeModal('approveModal')">
                <i class="fa-solid fa-times"></i> Batal
            </button>
            <button type="button" class="approve-btn approve-btn-submit" onclick="submitApprove()">
                <i class="fa-solid fa-check"></i> Ya, Setujui
            </button>
        </div>
    </div>
</div>
</div>
<!-- Modal Nomor Surat -->
<div id="nomorSuratModal" class="modal">
<div class="approve-modal-content" style="max-width: 500px;">
    <div class="approve-modal-header">
        <h3><i class="fa-solid fa-hashtag"></i> Masukkan Nomor Surat</h3>
        <button class="close-modal" onclick="closeModalPre('nomorSuratModal')">&times;</button>
    </div>
    <div class="approve-modal-body">
        <div class="approve-info-box" id="nomorSuratInfoBox">
            <!-- Info akan diisi oleh JavaScript -->
        </div>
        
        <form id="nomorSuratForm">
            <input type="hidden" id="nomorSuratId" value="">
            
            <div class="form-group">
                <label for="nomorSuratInput">
                    <i class="fa-solid fa-file-alt"></i> Nomor Surat <span style="color:#e74c3c">*</span>
                </label>
                <input 
                    type="text" 
                    id="nomorSuratInput" 
                    name="nomor_surat" 
                    class="form-control" 
                    placeholder="Contoh: 001/SKT/FT/2025" 
                    required
                    autocomplete="off"
                >
                <div class="form-hint">
                    <i class="fa-solid fa-exclamation-circle"></i> Format: XXX/SKT/FT/Tahun
                </div>
                <div id="nomorSuratError" style="color:#e74c3c;font-size:12px;margin-top:5px;display:none">
                    <!-- Error message -->
                </div>
            </div>

            <div class="approve-modal-actions">
                <button type="button" class="approve-btn approve-btn-cancel" onclick="closeModal('nomorSuratModal')">
                    <i class="fa-solid fa-times"></i> Batal
                </button>
                <button type="submit" class="approve-btn approve-btn-submit">
                    <i class="fa-solid fa-save"></i> Simpan Nomor Surat
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Success Modal untuk Nomor Surat -->
<div id="successNomorSuratModal" class="modal">
<div class="bulk-modal-content" style="max-width: 500px;">
    <div class="modal-header" style="background: #3498db;">
        <h3><i class="fa-solid fa-check-circle"></i> Nomor Surat Berhasil Disimpan</h3>
        <button class="close-modal" onclick="closeModal('successNomorSuratModal')">&times;</button>
    </div>
    <div style="padding:25px;text-align:center">
        <div style="width:80px;height:80px;border-radius:50%;background:#d6eaf8;margin:0 auto 20px;display:flex;align-items:center;justify-content:center">
            <i class="fas fa-check" style="font-size:40px;color:#3498db"></i>
        </div>
        
        <h3 style="color:#3498db;margin-bottom:10px" id="successNomorTitle"></h3>
        <p style="color:#666;margin-bottom:10px">
            Nomor surat berhasil disimpan untuk pengajuan:
        </p>
        
        <div style="background:#e8f4fc;border:1px solid #3498db;border-radius:8px;padding:15px;margin:15px 0">
            <div style="font-weight:600;color:#2980b9;margin-bottom:8px;display:flex;align-items:center;justify-content:space-between">
                <span>Informasi Surat</span>
                <span id="successNomorItemCount" style="background:#3498db;color:white;padding:3px 10px;border-radius:20px;font-size:11px">1 item</span>
            </div>
            <div id="successNomorList" style="text-align:left">
                <!-- List akan diisi oleh JavaScript -->
            </div>
        </div>
        
        <div style="background:#d4edda;border:1px solid #c3e6cb;border-radius:8px;padding:12px;margin:15px 0">
            <div style="font-weight:600;color:#155724;margin-bottom:5px">
                <i class="fa-solid fa-hashtag"></i> Nomor Surat
            </div>
            <div style="font-size:18px;font-weight:700;color:#117864;font-family:'Courier New',monospace" id="successNomorValue">
                <!-- Nomor surat akan diisi -->
            </div>
        </div>
        
        <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
            <button class="btn-bulk" onclick="closeModal('successNomorSuratModal'); refreshPage();" style="background:#3498db;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                <i class="fa-solid fa-rotate"></i> Tutup 
            </button>
        </div>
    </div>
</div>
</div>
        <!-- Reject Modal (BARU - MIRIP SEPERTI APPROVE MODAL) -->
        <div id="rejectConfirmModal" class="modal">
            <div class="reject-modal-content">
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
            <div class="bulk-modal-content" style="max-width: 600px;">
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
                        <button class="btn-bulk" onclick="closeModal('successRejectModal'); refreshPage();" style="background:#e74c3c;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                            <i class="fa-solid fa-rotate"></i> Tutup & Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Eviden Modal (untuk multiple files) -->
        <div id="evidenModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="fa-solid fa-file-image"></i> File Evidence</h3>
                    <button class="close-modal" onclick="closeModalPre('evidenModal')">&times;</button>
                </div>
                <div class="detail-content" id="evidenContent">
                    <!-- Content akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
        <!-- Modal PIN -->
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

        <style>
        @keyframes fadeIn {
            from { opacity:0; transform: scale(0.94); }
            to   { opacity:1; transform: scale(1); }
        }
        </style>
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


       <!-- Return Modal (SEDERHANA TANPA CATATAN) -->
        <div id="returnConfirmModal" class="modal">
            <div class="approve-modal-content">
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
            <div class="bulk-modal-content" style="max-width: 600px;">
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
                        <button class="btn-bulk" onclick="closeModal('successReturnModal'); refreshPage();" style="background:#ff9800;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                            <i class="fa-solid fa-rotate"></i> Tutup & Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Success Result Modal untuk Edit Sekretariat -->
<div id="successEditModal" class="modal">
<div class="bulk-modal-content" style="max-width: 600px;">
<div class="modal-header" style="background: #ff9800;">
    <h3><i class="fa-solid fa-pen-to-square"></i> <span id="successEditTitle">Edit Berhasil Disimpan</span></h3>
    <button class="close-modal" onclick="closeModal('successEditModal')">&times;</button>
</div>
<div style="padding:25px;text-align:center">
    <div style="width:100px;height:100px;border-radius:50%;background:#fff3e0;margin:0 auto 20px;display:flex;align-items:center;justify-content:center">
        <i class="fas fa-check" style="font-size:50px;color:#ff9800"></i>
    </div>
    
    <h3 style="color:#ff9800;margin-bottom:10px">Berhasil Diperbarui</h3>
    <p style="color:#666;margin-bottom:5px">
        <i class="fa-solid fa-clock"></i> Diperbarui pada: <strong id="editTimestamp">-</strong>
    </p>
    
    <div style="background:#fff3e0;border:1px solid #ffcc80;border-radius:8px;padding:15px;margin:20px 0">
        <div style="font-weight:600;color:#e65100;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between">
            <span>Data Pengajuan</span>
            <span id="editItemCount" style="background:#ff9800;color:white;padding:4px 12px;border-radius:20px;font-size:12px">1 item</span>
        </div>
        <div id="editList" style="max-height:250px;overflow-y:auto;text-align:left">
            <!-- List akan diisi oleh JavaScript -->
        </div>
    </div>
    
    <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
        <button class="btn-bulk" onclick="closeModal('successEditModal'); refreshPage();" style="background:#ff9800;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
            <i class="fa-solid fa-rotate"></i> Tutup & Refresh
        </button>
    </div>
</div>
</div>
</div>

<!-- Success Result Modal untuk Revisi (Ditolak Dekan) -->
<div id="successRevisionModal" class="modal">
<div class="bulk-modal-content" style="max-width: 600px;">
<div class="modal-header" style="background: #17a2b8;">
    <h3><i class="fa-solid fa-paper-plane"></i> <span id="successRevisionTitle">Revisi Berhasil Dikirim</span></h3>
    <button class="close-modal" onclick="closeModal('successRevisionModal')">&times;</button>
</div>
<div style="padding:25px;text-align:center">
    <div style="width:100px;height:100px;border-radius:50%;background:#d1ecf1;margin:0 auto 20px;display:flex;align-items:center;justify-content:center">
        <i class="fas fa-paper-plane" style="font-size:50px;color:#17a2b8"></i>
    </div>
    
    <h3 style="color:#17a2b8;margin-bottom:10px">Berhasil Dikirim ke Dekan</h3>
    <p style="color:#666;margin-bottom:5px">
        <i class="fa-solid fa-clock"></i> Dikirim pada: <strong id="revisionTimestamp">-</strong>
    </p>
    
    <div style="background:#d1ecf1;border:1px solid #bee5eb;border-radius:8px;padding:15px;margin:20px 0">
        <div style="font-weight:600;color:#0c5460;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between">
            <span>Data Pengajuan</span>
            <span id="revisionItemCount" style="background:#17a2b8;color:white;padding:4px 12px;border-radius:20px;font-size:12px">1 item</span>
        </div>
        <div id="revisionList" style="max-height:250px;overflow-y:auto;text-align:left">
            <!-- List akan diisi oleh JavaScript -->
        </div>
    </div>
    
    <div style="display:flex;gap:10px;justify-content:center;margin-top:20px">
        <button class="btn-bulk" onclick="closeModal('successRevisionModal'); refreshPage();" style="background:#17a2b8;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
            <i class="fa-solid fa-rotate"></i> Tutup & Refresh
        </button>
    </div>
</div>
</div>
</div>
        <!-- Success Result Modal - SAMA SEPERTI DEKAN -->
        <div id="successResultModal" class="modal">
            <div class="bulk-modal-content" style="max-width: 600px;">
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
                        <button class="btn-bulk" onclick="closeModal('successResultModal'); refreshPage();" style="background:#27ae60;color:white;padding:10px 24px;border:none;border-radius:6px;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px">
                            <i class="fa-solid fa-rotate"></i> Tutup & Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan juga tombol bulk style -->
        <style>
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
        </style>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
            <script>
            // Data dari controller
            const suratList = <?= isset($surat_list) && !empty($surat_list) ? json_encode($surat_list) : '[]' ?>;
            let currentRejectId = null;
            let currentRejectNamaKegiatan = null;   
            let currentApproveId = null;
            let currentNomorSuratId = null;
            let currentNomorSuratNama = null;
            let chartInstance = null;
            // Fungsi untuk membuka modal nomor surat
async function openNomorSuratModal(id, namaKegiatan) {
currentNomorSuratId = id;
currentNomorSuratNama = namaKegiatan;

// Tampilkan loading
document.getElementById('nomorSuratInfoBox').innerHTML = `
    <div style="text-align:center;padding:10px">
        <i class="fa-solid fa-spinner fa-spin" style="color:#16A085"></i>
        <p style="color:#7f8c8d;margin-top:5px">Memuat data...</p>
    </div>
`;

// Reset form
document.getElementById('nomorSuratInput').value = '';
document.getElementById('nomorSuratError').style.display = 'none';
document.getElementById('nomorSuratError').textContent = '';

// Tampilkan modal
document.getElementById('nomorSuratModal').classList.add('show');

try {
    // Ambil data surat via AJAX
    const response = await fetch('<?= site_url("sekretariat/get_data_for_nomor_surat/") ?>' + id);
    const data = await response.json();
    
    if (data.success) {
        const suratData = data.data;
        
        // Update info box
        let nomorStatus = '';
        if (suratData.nomor_surat) {
            nomorStatus = `<span style="color:#27ae60;font-weight:600">${escapeHtml(suratData.nomor_surat)}</span>`;
        } else {
            nomorStatus = '<span style="color:#e74c3c;font-weight:600">Belum diisi</span>';
        }
        
        document.getElementById('nomorSuratInfoBox').innerHTML = `
            <strong><i class="fa-solid fa-info-circle"></i> Informasi Surat</strong>
            <p style="margin:8px 0 5px 0">
                <strong>Nama Kegiatan:</strong> ${escapeHtml(suratData.nama_kegiatan)}
            </p>
            <p style="margin:5px 0">
                <strong>Status:</strong> <span class="badge badge-approved" style="display:inline-block">${escapeHtml(suratData.status)}</span>
            </p>
            <p style="margin:5px 0">
                <strong>Nomor Surat Saat Ini:</strong> ${nomorStatus}
            </p>
        `;
        
        // Isi input jika sudah ada nomor surat
        if (suratData.nomor_surat) {
            document.getElementById('nomorSuratInput').value = suratData.nomor_surat;
        }
        
        // Set hidden ID
        document.getElementById('nomorSuratId').value = id;
        
        // Focus ke input
        setTimeout(() => {
            document.getElementById('nomorSuratInput').focus();
        }, 300);
        
    } else {
        document.getElementById('nomorSuratInfoBox').innerHTML = `
            <div style="color:#e74c3c;text-align:center;padding:10px">
                <i class="fa-solid fa-exclamation-triangle"></i>
                <p>${data.message || 'Gagal memuat data surat.'}</p>
            </div>
        `;
    }
} catch (error) {
    console.error('Error loading surat data:', error);
    document.getElementById('nomorSuratInfoBox').innerHTML = `
        <div style="color:#e74c3c;text-align:center;padding:10px">
            <i class="fa-solid fa-exclamation-triangle"></i>
            <p>Terjadi kesalahan saat memuat data.</p>
        </div>
    `;
}
}

// Event listener untuk form nomor surat
document.getElementById('nomorSuratForm').addEventListener('submit', async function(e) {
e.preventDefault();

const id = document.getElementById('nomorSuratId').value;
const nomorSurat = document.getElementById('nomorSuratInput').value.trim();
const errorDiv = document.getElementById('nomorSuratError');

// Reset error
errorDiv.style.display = 'none';
errorDiv.textContent = '';

if (!nomorSurat) {
    errorDiv.textContent = 'Nomor surat harus diisi!';
    errorDiv.style.display = 'block';
    return;
}

// Disable submit button
const submitBtn = this.querySelector('.approve-btn-submit');
const originalText = submitBtn.innerHTML;
submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
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
    
    const data = await response.json();
    
    if (data.success) {

        // Tampilkan success modal
        showSuccessNomorSuratModal(currentNomorSuratNama, data.nomor_surat);
        
    } else {
        // Tampilkan error
        errorDiv.textContent = data.message || 'Gagal menyimpan nomor surat.';
        errorDiv.style.display = 'block';
        
        // Enable button kembali
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
    
} catch (error) {
    console.error('Error saving nomor surat:', error);
    errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
    errorDiv.style.display = 'block';
    
    // Enable button kembali
    submitBtn.innerHTML = originalText;
    submitBtn.disabled = false;
}
});

// Fungsi untuk menampilkan success modal nomor surat
function showSuccessNomorSuratModal(namaKegiatan, nomorSurat) {
const modal = document.getElementById('successNomorSuratModal');
const title = document.getElementById('successNomorTitle');
const listContainer = document.getElementById('successNomorList');
const nomorValue = document.getElementById('successNomorValue');

title.textContent = 'Nomor Surat Tersimpan';

// Populate list
listContainer.innerHTML = `
    <div style="display:flex;align-items:center;gap:8px;padding:10px;background:white;border-radius:6px;margin-bottom:8px">
        <i class="fas fa-file-alt" style="color:#3498db;font-size:18px;flex-shrink:0"></i>
        <div style="flex:1">
            <div style="font-weight:600;color:#212529;font-size:14px">${escapeHtml(namaKegiatan)}</div>
            <div style="font-size:12px;color:#6c757d">Status: <span class="badge badge-approved" style="display:inline-block">Disetujui Dekan</span></div>
        </div>
    </div>
`;

// Tampilkan nomor surat
nomorValue.textContent = nomorSurat;

modal.classList.add('show');
}
            // ============================================
            // SUCCESS MODAL FUNCTIONS - UNTUK APPROVAL (SAMA SEPERTI DEKAN)
            // ============================================
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
                <span class="badge badge-rejected" style="flex-shrink:0">${isSingle ? 'Ditolak Sekretariat' : 'Ditolak Sekretariat (Multi)'}</span>
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
    document.getElementById('rejectForm').action = '<?= base_url("sekretariat/reject/") ?>' + id;
    
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
    form.action = '<?= base_url("sekretariat/reject/") ?>' + currentRejectId;
    
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

// Update reject buttons saat DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    updateRejectButtons();
    
    // Check for success reject modal data from session
    <?php if($this->session->flashdata('rejected_items')): ?>
        const rejectedItems = <?= json_encode($this->session->flashdata('rejected_items')) ?>;
        const isSingleReject = <?= json_encode($this->session->flashdata('is_single_reject')) ?>;
        
        // Tunggu sebentar agar page fully loaded
        setTimeout(function() {
            showSuccessRejectModal(rejectedItems.length, rejectedItems, isSingleReject);
        }, 500);
    <?php endif; ?>
});

// Fungsi untuk refresh tabel (jika ada filter)
function refreshTable() {
    // Fungsi ini dipanggil setelah tabel di-update
    setTimeout(() => {
        updateRejectButtons();
        makeRowsClickable();
    }, 100);
}
            function refreshPage() {
                window.location.reload();
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
                
                // Populate list dengan data dosen
                listContainer.innerHTML = '';
                items.forEach((item, index) => {
                    const itemDiv = document.createElement('div');
                    itemDiv.style.cssText = 'background:white;border:1px solid #c3e6cb;border-radius:6px;margin-bottom:8px;overflow:hidden';
                    
                    // Generate HTML untuk dosen jika ada data
                    const dosenHtml = generateDosenHtmlForSuccessModal(item.dosen_data || []);
                    
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
                if (!dosenData || dosenData.length === 0 || (dosenData.length === 1 && dosenData[0].nama === 'Data dosen tidak tersedia')) {
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
                                    NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}
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
                                    NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}
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

            // Check for success modal data from session
            <?php if($this->session->flashdata('approved_items')): ?>
                document.addEventListener('DOMContentLoaded', function() {
                    const approvedItems = <?= json_encode($this->session->flashdata('approved_items')) ?>;
                    const isSingle = <?= json_encode($this->session->flashdata('is_single_approve')) ?>;
                    
                    // Tunggu sebentar agar page fully loaded
                    setTimeout(function() {
                        showSuccessModal(approvedItems.length, approvedItems, isSingle);
                    }, 500);
                });
            <?php endif; ?>
            // Plugin untuk efek 3D - SAMA SEPERTI DI DEKAN
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
                                let darkColor = datasetIndex === 0 ? 'rgba(0, 177, 253, 0.6)' : (datasetIndex === 1 ? 'rgba(46, 204, 113, 0.85)' : 'rgba(231, 76, 60, 0.85)');
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
                const chartPending = <?= json_encode(isset($chart_pending) ? $chart_pending : array_fill(0,12,0)) ?>;
                const chartApproved = <?= json_encode(isset($chart_approved) ? $chart_approved : array_fill(0,12,0)) ?>;
                const chartRejected = <?= json_encode(isset($chart_rejected) ? $chart_rejected : array_fill(0,12,0)) ?>;
                
                console.log('Data Chart Sekretariat:', {
                    total: chartTotal,
                    pending: chartPending,
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
                    
                    console.log('Filter Bulan Sekretariat:', {
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
                                    ticks: {color: '#000000ff'}
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
                    
                    console.log('Chart Sekretariat berhasil dibuat!');
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
                                    Pending=${JSON.stringify(chartPending)}, 
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
                setTimeout(initChart, 100);// CHECK FOR SUCCESS RETURN MODAL DATA
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

            // Fungsi filter berdasarkan divisi
            function filterByDivisi(divisi) {
                const tahun = document.getElementById('tahunSelect').value;
                const bulan = document.getElementById('bulanSelect').value;
                
                let url = "<?= base_url('sekretariat?tahun=') ?>" + tahun;
                
                if (bulan !== 'all') {
                    url += "&bulan=" + bulan;
                }
                
                if (divisi !== 'all') {
                    url += "&divisi=" + encodeURIComponent(divisi);
                }
                
                window.location.href = url;
            }

            // Update fungsi filterByBulan untuk mempertahankan filter divisi
            function filterByBulan(bulan) {
                const tahun = document.getElementById('tahunSelect').value;
                const divisi = document.getElementById('divisiSelect').value;
                
                let url = "<?= base_url('sekretariat?tahun=') ?>" + tahun;
                
                if (bulan !== 'all') {
                    url += "&bulan=" + bulan;
                }
                
                if (divisi !== 'all') {
                    url += "&divisi=" + encodeURIComponent(divisi);
                }
                
                window.location.href = url;
            }

            // Update fungsi updateTahun untuk mempertahankan filter divisi
            function updateTahun(year) {
                const bulan = document.getElementById('bulanSelect').value;
                const divisi = document.getElementById('divisiSelect').value;
                
                let url = "<?= base_url('sekretariat?tahun=') ?>" + year;
                
                if (bulan !== 'all') {
                    url += "&bulan=" + bulan;
                }
                
                if (divisi !== 'all') {
                    url += "&divisi=" + encodeURIComponent(divisi);
                }
                
                window.location.href = url;
            }

            // =================================================================
            // FUNGSI-FUNGSI UNTUK MODAL DETAIL DAN EVIDEN (SAMA SEPERTI DEKAN)
            // =================================================================

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
                        <i class="fas fa-spinner fa-spin" style="font-size: 48px; color: #16A085;"></i>
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
                        <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#16A085"></i>
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
            async function showDetail(id) {
                const viewUrl = "<?= base_url('sekretariat/view_surat_pengajuan/') ?>" + id; // HTML
                const pdfUrl  = "<?= base_url('sekretariat/download_pdf/') ?>" + id;        // PDF asli

                document.getElementById('detailContent').innerHTML = `
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        
                        <!-- TOMBOL DOWNLOAD -->
                        <button onclick="downloadPDF('${pdfUrl}')"
                            style="padding:8px 15px; background:#16A085; color:white; border:none; border-radius:6px; cursor:pointer;">
                            <i class="fa fa-download"></i> Download
                        </button>

                        <!-- TOMBOL PRINT -->
                        <button onclick="printPDF('${pdfUrl}')"
                            style="padding:8px 15px; background:#2c3e50; color:white; border:none; border-radius:6px; cursor:pointer;">
                            <i class="fa fa-print"></i> Print
                        </button>
                    </div>

                    <!-- VIEW HTML -->
                    <iframe id="pdfFrame"
                        src="${viewUrl}"
                        style="width:100%; height:85vh; border:none; border-radius:10px;">
                    </iframe>
                `;

                document.getElementById("detailModal").classList.add("show");
            }



            function printPDF(url) {
                fetch(url)
                    .then(res => res.blob())
                    .then(blob => {
                        const blobUrl = URL.createObjectURL(blob);
                        const iframe = document.createElement("iframe");
                        iframe.style.display = "none";
                        iframe.src = blobUrl;
                        document.body.appendChild(iframe);

                        iframe.onload = function () {
                            iframe.contentWindow.print();
                        };
                    });
            }

            function downloadPDF(url) {
                // Download langsung
                window.location.href = url;
            }

            // ============================================
            // FUNGSI GENERATE DETAIL CONTENT (untuk klik baris)
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
                ${getVal('status') === 'disetujui KK' ? `
                <div style="display:flex;gap:10px;margin-left:auto">
                    <button class="modal-btn modal-btn-reject" onclick="event.stopPropagation(); closeModal('detailModal'); showRejectModalNew(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
                        <i class="fa-solid fa-times"></i> Tolak
                    </button>
                    <button class="modal-btn modal-btn-approve" onclick="event.stopPropagation(); showApproveModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
                        <i class="fa-solid fa-check"></i> Setujui
                    </button>
                </div>
               ` : (getVal('status') === 'disetujui sekretariat' || getVal('status') === 'ditolak sekretariat') ? `
               <div style="display:flex;gap:10px;margin-left:auto">
                <button class="modal-btn" style="background: #ff9800;" onclick="event.stopPropagation(); closeModal('detailModal'); showReturnModal(${item.id}, '${escapeHtml(getVal('nama_kegiatan'))}')">
                    <i class="fa-solid fa-undo"></i> Kembalikan
                </button>
            </div>
                ` : ''}
            </div>`;
            }

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

            // Update fungsi showDetail untuk menggunakan AJAX
            async function showDetailViaClick(id) {
                try {
                    // Tampilkan loading
                    document.getElementById('detailContent').innerHTML = `
                        <div style="text-align:center;padding:40px;">
                            <i class="fa-solid fa-spinner fa-spin" style="font-size:24px;color:#16A085"></i>
                            <p style="margin-top:10px;color:#7f8c8d">Memuat detail...</p>
                        </div>
                    `;
                    
                    document.getElementById('detailModal').classList.add('show');

                    // Ambil data detail via AJAX
                    const item = await getSuratDetail(id);
                    
                    if (!item) {
                        throw new Error('Data tidak ditemukan');
                    }

                    // Generate dan tampilkan content
                    const content = generateDetailContent(item);
                    document.getElementById('detailContent').innerHTML = content;
                    
                } catch (error) {
                    console.error('Error loading detail:', error);
                    document.getElementById('detailContent').innerHTML = `
                        <div style="text-align:center;padding:40px;color:#e74c3c">
                            <i class="fa-solid fa-exclamation-triangle" style="font-size:48px;margin-bottom:15px"></i>
                            <h4>Gagal Memuat Data</h4>
                            <p>${error.message}</p>
                        </div>
                    `;
                }
            }

            // Fungsi untuk membuat baris tabel clickable
            function makeRowsClickable() {
                const rows = document.querySelectorAll('#tableBody tr:not(#emptyRow)');
                
                rows.forEach(row => {
                    // Tambahkan class clickable
                    row.classList.add('clickable-row');
                    
                    // Ambil ID dari tombol detail yang ada di row
                    const detailBtn = row.querySelector('.btn-detail');
                    if (detailBtn) {
                        const onclickAttr = detailBtn.getAttribute('onclick');
                        const match = onclickAttr.match(/showDetail\((\d+)\)/);
                        
                        if (match) {
                            const suratId = match[1];
                            
                            // Event listener untuk klik row
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
                                showDetailViaClick(suratId);
                            });
                            
                            // Hover effect
                            row.style.cursor = 'pointer';
                        }
                    }
                });
            }

            // Panggil fungsi setelah DOM loaded dan setiap kali tabel di-update
            document.addEventListener('DOMContentLoaded', function() {
                makeRowsClickable();
            });

            // Jika ada filter/reload tabel, panggil lagi
            function refreshTable() {
                // Fungsi ini dipanggil setelah tabel di-update
                setTimeout(() => {
                    makeRowsClickable();
                }, 100);
            }
            function showApproveModal(id, namaKegiatan) {
            currentApproveId = id;
            document.getElementById('approveNamaKegiatan').textContent = '"' + namaKegiatan + '"';
            document.getElementById('approveModal').classList.add('show');
        }
        function submitApprove() {
        if (!currentApproveId) return;
        
        // Kirim request tanpa nomor surat
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= base_url("sekretariat/approve/") ?>' + currentApproveId;
        
        const csrfName = '<?= $this->security->get_csrf_token_name() ?>';
        const csrfHash = '<?= $this->security->get_csrf_hash() ?>';
        
        // Tambahkan CSRF token saja
        const inpCsrf = document.createElement('input');
        inpCsrf.type = 'hidden';
        inpCsrf.name = csrfName;
        inpCsrf.value = csrfHash;
        form.appendChild(inpCsrf);
        
        document.body.appendChild(form);
        form.submit();
    }
            function showRejectModal(id) {
                currentRejectId = id;
                document.getElementById('rejectionNotes').value = '';
                document.getElementById('rejectModal').classList.add('show');
            }

            function confirmReject() {
                const notes = document.getElementById('rejectionNotes').value.trim();
                if (!notes) { 
                    alert('Alasan penolakan harus diisi'); 
                    return; 
                }
                
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url("sekretariat/reject/") ?>' + currentRejectId;
                
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

       // Fungsi untuk menampilkan return modal
        function showReturnModal(id, namaKegiatan) {
            currentReturnId = id;
            currentReturnNamaKegiatan = namaKegiatan;
            
            // Set data ke modal
            document.getElementById('returnNamaKegiatan').textContent = namaKegiatan;
            
            // Tampilkan modal yang benar (returnConfirmModal, bukan returnModal)
            document.getElementById('returnConfirmModal').classList.add('show');
        }
                    // Fungsi untuk konfirmasi return
        function confirmReturn() {
            if (!currentReturnId) return;
            
            // Buat form dan submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= base_url("sekretariat/return_pengajuan/") ?>' + currentReturnId;
            
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
                
                // Status baru setelah di-return
                const newStatusBadge = `<span class="badge badge-pending" style="background:#fff3cd;color:#856404;flex-shrink:0">${item.new_status || 'pengajuan'}</span>`;
                
                itemDiv.innerHTML = `
                    <div style="display:flex;align-items:center;gap:10px;padding:10px;border-bottom:1px solid #f0f0f0;">
                        <i class="fas fa-undo" style="color:#ff9800;font-size:20px;flex-shrink:0"></i>
                        <div style="flex:1;text-align:left">
                            <div style="font-weight:600;color:#212529;font-size:14px">${escapeHtml(item.nama)}</div>
                            <div style="font-size:12px;color:#6c757d">${item.details}</div>
                        </div>
                        ${newStatusBadge}
                    </div>
                `;
                listContainer.appendChild(itemDiv);
            });
            
            modal.classList.add('show');
        }
            
            // ============================================
            // FUNGSI CLOSE MODAL YANG DIUPDATE
            // ============================================
            
            function closeModal(id) { 
                document.getElementById(id).classList.remove('show'); 
                
                // Refresh halaman setelah modal ditutup
                setTimeout(() => {
                    window.location.reload();
                }, 300);
            }

            // Fungsi untuk menutup modal tanpa refresh (untuk preview)
                function closeModalPre(id) {
                    document.getElementById(id).classList.remove('show'); 
                }


            // Hapus fungsi modalClickOutside karena tidak ingin tutup modal dengan klik luar

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
            let selectedSurat = null;

            // OPEN PIN POPUP
            function openPinModal(id) {
                selectedSurat = id;
                document.getElementById("pinModal").style.display = "flex";
            }

            // CLOSE PIN POPUP
            function closePinModal() {
                document.getElementById("pinModal").style.display = "none";
                document.getElementById("pinInput").value = "";
            }

            function checkPin() {
                let pin = document.getElementById("pinInput").value;

                // Debug
                console.log("=== Check PIN Debug ===");
                console.log("PIN Input:", pin);
                console.log("PIN Length:", pin.length);
                console.log("Selected Surat:", selectedSurat);

                // Validasi input
                if (!pin) {
                    alert("PIN harus diisi!");
                    return;
                }

                if (pin.length !== 6) {
                    alert("PIN harus 6 digit!");
                    return;
                }

                if (!/^[0-9]{6}$/.test(pin)) {
                    alert("PIN harus berupa angka!");
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
                    console.log("Response Status:", response.status);
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Response Data:", data);

                    if (data.status === "success") {
                        
                        // Tampilkan dropdown disposisi
                        if (selectedSurat) {
                            document.getElementById("disposisiBox" + selectedSurat).style.display = "block";
                        }
                        
                        // Tutup modal PIN
                        closePinModal();
                    } else {
                        // PIN salah
                        alert(data.message || "PIN salah!");
                        document.getElementById("pinInput").value = "";
                        document.getElementById("pinInput").focus();
                    }
                })
                .catch(error => {
                    console.error("Fetch Error:", error);
                    alert("Terjadi kesalahan: " + error.message);
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
                catatanTextarea.value = "";
                
                // Untuk disposisi yang memerlukan catatan
                if (val === "Hold/Pending" || val === "Batal" ) {
                    catatanLabel.style.display = "block";
                    catatanTextarea.style.display = "block";
                    btnSave.style.display = "block";

                } else if (val === "Lanjut Proses ✔"){
                    btnSave.style.display = "block";
                }
                    // Set placeholder berdasarkan pilihan
                    if (val === "Hold/Pending") {
                        catatanTextarea.placeholder = "Berikan alasan mengapa perlu ditahan/ditunda...";
                    } else if (val === "Batal") {
                        catatanTextarea.placeholder = "Berikan alasan pembatalan...";
                    }
                    // Fokus ke textarea
                    setTimeout(() => {
                        catatanTextarea.focus();
                    }, 100);
                }
                // SIMPAN DISPOSISI - UPDATED
                function saveDisposisi(id) {
                    let disposisi = document.getElementById("disposisiSelect" + id).value;
                    let catatan = document.getElementById("catatanDisposisi" + id).value;

                    if (!disposisi) {
                        alert("Pilih disposisi dulu!");
                        return;
                    }

                    if ((disposisi === "Hold/Pending" || disposisi === "Batal") && catatan === "") {
                        alert("Wajib Mengisi Catatan!");
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
                                alert("✅ Disposisi tersimpan!\n\n📌 Status pengajuan diubah menjadi: DITOLAK SEKRETARIAT");
                            } else {
                                alert("✅ Disposisi tersimpan!");
                            }
                            location.reload();
                        } else {
                            alert("❌ Gagal menyimpan disposisi. Silakan coba lagi.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("❌ Terjadi kesalahan. Silakan coba lagi.");
                    });
                }
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
// SUCCESS EDIT MODAL FUNCTIONS
// ============================================
// Fungsi untuk menampilkan success edit modal
function showSuccessEditModal(count, items, isSingle = false) {
const modal = document.getElementById('successEditModal');
const title = document.getElementById('successEditTitle');
const timestamp = document.getElementById('editTimestamp');
const itemCount = document.getElementById('editItemCount');
const listContainer = document.getElementById('editList');

title.textContent = isSingle ? 'Edit Berhasil Disimpan' : 'Edit Berhasil Disimpan (Multiple)';

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
    
    // Status baru setelah di-edit
    const newStatusBadge = `<span class="badge badge-warning" style="background:#fff3cd;color:#856404;flex-shrink:0">${item.new_status || 'disetujui KK'}</span>`;
    
    // Generate HTML untuk dosen terlibat (seperti tampilan awal)
    const dosenHtml = generateDosenSectionHtml(item.dosen_data || [], item.changes || []);
    
    // Generate HTML untuk perubahan
    const changesHtml = generateChangesHtml(item.changes || []);
    
    itemDiv.innerHTML = `
        <div style="display:flex;align-items:center;gap:10px;padding:10px;border-bottom:1px solid #f0f0f0;">
            <i class="fas fa-pen-to-square" style="color:#ff9800;font-size:20px;flex-shrink:0"></i>
            <div style="flex:1;text-align:left">
                <div style="font-weight:600;color:#212529;font-size:14px">${escapeHtml(item.nama)}</div>
                <div style="font-size:12px;color:#6c757d">${item.details}</div>
            </div>
            ${newStatusBadge}
        </div>
        ${dosenHtml}
        ${changesHtml}
    `;
    listContainer.appendChild(itemDiv);
});

modal.classList.add('show');
}

// Generate HTML untuk section dosen terlibat (tampilan seperti awal)
function generateDosenSectionHtml(dosenData, changes) {
if (!dosenData || dosenData.length === 0 || (dosenData.length === 1 && dosenData[0].nama === 'Data dosen tidak tersedia')) {
    return '';
}

// Cek apakah ada perubahan dosen
const hasDosenChange = changes.some(c => c.field === 'nip');

const maxVisible = 3;
const isOverLimit = dosenData.length > maxVisible;
const visibleDosen = isOverLimit ? dosenData.slice(0, maxVisible) : dosenData;
const hiddenDosen = isOverLimit ? dosenData.slice(maxVisible) : [];
const uniqueId = 'dosen-edit-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

return `
<div style="background:#fff3e0;border-top:1px solid #ffcc80;padding:15px;">
    <div style="font-weight:600;color:#f57c00;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between;">
        <span style="display:flex;align-items:center;gap:8px;">
            <i class="fas fa-users"></i>
            <span>Dosen Terlibat</span>
        </span>
        <span style="background:#ff9800;color:white;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
            ${dosenData.length} Dosen
        </span>
    </div>
    
    <div id="${uniqueId}" style="display:flex;flex-direction:column;gap:6px;">
        ${visibleDosen.map((dosen, index) => `
        <div style="display:flex;align-items:center;gap:8px;padding:8px;background:white;border:1px solid #ffe082;border-radius:6px;">
            <div style="width:32px;height:32px;border-radius:50%;background:#ff9800;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:600;flex-shrink:0;">
                ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#333;font-size:13px;">${escapeHtml(dosen.nama)}</div>
                <div style="color:#666;font-size:11px;">NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}</div>
            </div>
        </div>
        `).join('')}
        
        ${hiddenDosen.map((dosen, index) => `
        <div class="dosen-hidden-edit" style="display:none;align-items:center;gap:8px;padding:8px;background:white;border:1px solid #ffe082;border-radius:6px;">
            <div style="width:32px;height:32px;border-radius:50%;background:#ff9800;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:600;flex-shrink:0;">
                ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#333;font-size:13px;">${escapeHtml(dosen.nama)}</div>
                <div style="color:#666;font-size:11px;">NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}</div>
            </div>
        </div>
        `).join('')}
    </div>
    
    ${isOverLimit ? `
    <button onclick="toggleDosenEdit('${uniqueId}', this)" 
        style="width:100%;margin-top:8px;background:#ff9800;color:white;border:none;border-radius:6px;padding:8px;cursor:pointer;font-size:12px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:6px;transition:background 0.2s;">
        <i class="fa-solid fa-chevron-down"></i>
        <span>Tampilkan ${hiddenDosen.length} Dosen Lainnya</span>
    </button>
    ` : ''}
</div>`;
}

// Toggle show/hide dosen tambahan
function toggleDosenEdit(containerId, button) {
const container = document.getElementById(containerId);
const hiddenItems = container.querySelectorAll('.dosen-hidden-edit');
const icon = button.querySelector('i');
const textSpan = button.querySelector('span');

let isExpanded = button.getAttribute('data-expanded') === 'true';

if (!isExpanded) {
    // Expand
    hiddenItems.forEach(item => {
        item.style.display = 'flex';
    });
    icon.className = 'fa-solid fa-chevron-up';
    textSpan.textContent = 'Sembunyikan';
    button.setAttribute('data-expanded', 'true');
} else {
    // Collapse
    hiddenItems.forEach(item => {
        item.style.display = 'none';
    });
    icon.className = 'fa-solid fa-chevron-down';
    const hiddenCount = hiddenItems.length;
    textSpan.textContent = `Tampilkan ${hiddenCount} Dosen Lainnya`;
    button.setAttribute('data-expanded', 'false');
}
}

// Fungsi untuk generate HTML perubahan (tanpa dosen, karena dosen sudah ditampilkan di atas)
function generateChangesHtml(changes) {
// Filter out perubahan dosen karena sudah ditampilkan di section terpisah
const filteredChanges = changes.filter(c => c.field !== 'nip');

if (!filteredChanges || filteredChanges.length === 0) {
    return ''; // Jangan tampilkan apa-apa jika tidak ada perubahan selain dosen
}

let html = `
<div style="background:#fff8e1;border-top:1px solid #ffe082;padding:15px;">
    <div style="font-weight:600;color:#e65100;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-exchange-alt"></i>
        <span>Perubahan yang Dilakukan (${filteredChanges.length} field)</span>
    </div>
    <div style="display:flex;flex-direction:column;gap:10px;">`;

filteredChanges.forEach((change, index) => {
    if (change.type === 'text') {
        html += generateTextChangeHtml(change);
    } else if (change.type === 'dosen') {
        html += generateDosenChangeHtml(change);
    } else if (change.type === 'files') {
        html += generateFilesChangeHtml(change);
    }
});

html += `
    </div>
</div>`;

return html;
}

// Generate HTML untuk perubahan text biasa
function generateTextChangeHtml(change) {
// Format tanggal jika field adalah tanggal
const isDateField = ['tanggal_kegiatan', 'akhir_kegiatan', 'periode_penugasan', 'akhir_periode_penugasan'].includes(change.field);

let oldDisplay = change.old_value;
let newDisplay = change.new_value;

if (isDateField && oldDisplay !== '-') {
    oldDisplay = formatDateForDisplay(oldDisplay);
}
if (isDateField && newDisplay !== '-') {
    newDisplay = formatDateForDisplay(newDisplay);
}

return `
<div style="background:white;border:1px solid #ffe082;border-radius:6px;padding:10px;">
    <div style="font-weight:600;color:#f57c00;font-size:13px;margin-bottom:6px;">
        <i class="fas fa-edit" style="margin-right:4px;"></i>${escapeHtml(change.label)}
    </div>
    <div style="display:flex;align-items:center;gap:8px;font-size:12px;">
        <div style="flex:1;background:#fff8e1;padding:8px 10px;border-radius:4px;border:1px solid #ffe082;">
            <div style="color:#666;font-size:10px;margin-bottom:3px;font-weight:600;">Sebelum:</div>
            <div style="color:#333;font-weight:500;">${escapeHtml(oldDisplay)}</div>
        </div>
        <i class="fas fa-arrow-right" style="color:#ff9800;font-size:16px;"></i>
        <div style="flex:1;background:#fff3e0;padding:8px 10px;border-radius:4px;border:1px solid #ffcc80;">
            <div style="color:#666;font-size:10px;margin-bottom:3px;font-weight:600;">Sesudah:</div>
            <div style="color:#e65100;font-weight:600;">${escapeHtml(newDisplay)}</div>
        </div>
    </div>
</div>`;
}
// Generate HTML untuk perubahan dosen - DENGAN JABATAN & PERAN
function generateDosenChangeHtml(change) {
const oldDosen = Array.isArray(change.old_value) ? change.old_value : [];
const newDosen = Array.isArray(change.new_value) ? change.new_value : [];

// Cari dosen yang ditambah, dihapus, dan yang berubah jabatan/perannya
const addedDosen = newDosen.filter(nd => !oldDosen.some(od => od.nip === nd.nip));
const removedDosen = oldDosen.filter(od => !newDosen.some(nd => nd.nip === od.nip));

// Dosen yang jabatan atau perannya berubah
const changedDosen = newDosen.filter(nd => {
    const old = oldDosen.find(od => od.nip === nd.nip);
    return old && (old.jabatan !== nd.jabatan || old.peran !== nd.peran);
});

const unchangedDosen = newDosen.filter(nd => {
    const old = oldDosen.find(od => od.nip === nd.nip);
    return old && old.jabatan === nd.jabatan && old.peran === nd.peran;
});

return `
<div style="background:white;border:1px solid #ffe082;border-radius:6px;padding:10px;">
    <div style="font-weight:600;color:#f57c00;font-size:13px;margin-bottom:8px;">
        <i class="fas fa-user-edit" style="margin-right:4px;"></i>${escapeHtml(change.label)} - Detail Perubahan
    </div>
    
    ${removedDosen.length > 0 ? `
    <div style="background:#ffebee;border:1px solid #ffcdd2;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#c62828;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-minus-circle"></i> Dosen Dihapus (${removedDosen.length}):
        </div>
        ${removedDosen.map(d => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <div style="width:18px;height:18px;border-radius:50%;background:#e53935;display:flex;align-items:center;justify-content:center;color:white;font-size:9px;font-weight:600;">
                ${d.nama ? d.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#c62828;font-size:11px;">${escapeHtml(d.nama)}</div>
                <div style="color:#666;font-size:9px;">NIP: ${escapeHtml(d.nip)} | ${escapeHtml(d.jabatan)} | ${escapeHtml(d.peran)}</div>
            </div>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${addedDosen.length > 0 ? `
    <div style="background:#e8f5e9;border:1px solid #c8e6c9;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#2e7d32;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-plus-circle"></i> Dosen Ditambah (${addedDosen.length}):
        </div>
        ${addedDosen.map(d => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <div style="width:18px;height:18px;border-radius:50%;background:#43a047;display:flex;align-items:center;justify-content:center;color:white;font-size:9px;font-weight:600;">
                ${d.nama ? d.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#2e7d32;font-size:11px;">${escapeHtml(d.nama)}</div>
                <div style="color:#666;font-size:9px;">NIP: ${escapeHtml(d.nip)} | ${escapeHtml(d.jabatan)} | ${escapeHtml(d.peran)}</div>
            </div>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${changedDosen.length > 0 ? `
    <div style="background:#fff3e0;border:1px solid #ffcc80;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#e65100;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-exchange-alt"></i> Jabatan/Peran Berubah (${changedDosen.length}):
        </div>
        ${changedDosen.map(d => {
            const old = oldDosen.find(od => od.nip === d.nip);
            const jabatanChanged = old.jabatan !== d.jabatan;
            const peranChanged = old.peran !== d.peran;
            
            return `
            <div style="padding:6px;margin-bottom:4px;background:white;border-radius:3px;">
                <div style="font-weight:600;color:#333;font-size:11px;margin-bottom:3px;">${escapeHtml(d.nama)}</div>
                
                ${jabatanChanged ? `
                <div style="display:flex;align-items:center;gap:6px;font-size:10px;margin-bottom:2px;">
                    <span style="color:#666;font-weight:600;">Jabatan:</span>
                    <span style="color:#e65100;background:#fff3e0;padding:2px 6px;border-radius:3px;">${escapeHtml(old.jabatan)}</span>
                    <i class="fas fa-arrow-right" style="color:#ff9800;font-size:10px;"></i>
                    <span style="color:#2e7d32;background:#e8f5e9;padding:2px 6px;border-radius:3px;font-weight:600;">${escapeHtml(d.jabatan)}</span>
                </div>
                ` : ''}
                
                ${peranChanged ? `
                <div style="display:flex;align-items:center;gap:6px;font-size:10px;">
                    <span style="color:#666;font-weight:600;">Peran:</span>
                    <span style="color:#e65100;background:#fff3e0;padding:2px 6px;border-radius:3px;">${escapeHtml(old.peran)}</span>
                    <i class="fas fa-arrow-right" style="color:#ff9800;font-size:10px;"></i>
                    <span style="color:#2e7d32;background:#e8f5e9;padding:2px 6px;border-radius:3px;font-weight:600;">${escapeHtml(d.peran)}</span>
                </div>
                ` : ''}
            </div>
            `;
        }).join('')}
    </div>
    ` : ''}
    
    ${unchangedDosen.length > 0 ? `
    <div style="background:#f5f5f5;border:1px solid #e0e0e0;border-radius:4px;padding:8px;">
        <div style="color:#616161;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-check-circle"></i> Dosen Tetap (${unchangedDosen.length}):
        </div>
        <div style="color:#757575;font-size:10px;font-style:italic;">
            ${unchangedDosen.map(d => `${d.nama} (${d.jabatan} - ${d.peran})`).join(', ')}
        </div>
    </div>
    ` : ''}
</div>`;
}
// Generate HTML untuk perubahan files
function generateFilesChangeHtml(change) {
const oldFiles = Array.isArray(change.old_value) ? change.old_value : [];
const newFiles = Array.isArray(change.new_value) ? change.new_value : [];

// Cari file yang ditambah dan dihapus
const addedFiles = newFiles.filter(nf => !oldFiles.includes(nf));
const removedFiles = oldFiles.filter(of => !newFiles.includes(of));
const unchangedFiles = newFiles.filter(nf => oldFiles.includes(nf));

return `
<div style="background:white;border:1px solid #ffe082;border-radius:6px;padding:10px;">
    <div style="font-weight:600;color:#f57c00;font-size:13px;margin-bottom:8px;">
        <i class="fas fa-file-edit" style="margin-right:4px;"></i>${escapeHtml(change.label)} - Detail Perubahan
    </div>
    
    ${removedFiles.length > 0 ? `
    <div style="background:#ffebee;border:1px solid #ffcdd2;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#c62828;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-minus-circle"></i> File Dihapus (${removedFiles.length}):
        </div>
        ${removedFiles.map(f => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <i class="fas fa-file" style="color:#e53935;font-size:12px;"></i>
            <span style="color:#c62828;font-size:11px;font-weight:500;">${getFileNameFromPath(f)}</span>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${addedFiles.length > 0 ? `
    <div style="background:#e8f5e9;border:1px solid #c8e6c9;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#2e7d32;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-plus-circle"></i> File Ditambah (${addedFiles.length}):
        </div>
        ${addedFiles.map(f => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <i class="fas fa-file" style="color:#43a047;font-size:12px;"></i>
            <span style="color:#2e7d32;font-size:11px;font-weight:600;">${getFileNameFromPath(f)}</span>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${unchangedFiles.length > 0 ? `
    <div style="background:#f5f5f5;border:1px solid #e0e0e0;border-radius:4px;padding:8px;">
        <div style="color:#616161;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-check-circle"></i> File Tetap (${unchangedFiles.length}):
        </div>
        ${unchangedFiles.map(f => `
        <div style="color:#757575;font-size:10px;">${getFileNameFromPath(f)}</div>
        `).join('')}
    </div>
    ` : ''}
</div>`;
}

// Helper function untuk format tanggal
function formatDateForDisplay(dateStr) {
if (!dateStr || dateStr === '-') return '-';
const date = new Date(dateStr);
if (isNaN(date)) return dateStr;
return date.toLocaleDateString('id-ID', { 
    day: '2-digit', 
    month: 'long', 
    year: 'numeric' 
});
}

// ============================================
// CHECK FOR SUCCESS EDIT MODAL DATA FROM SESSION
// ============================================

// Check for success edit modal data from session
<?php if($this->session->flashdata('edited_items')): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const editedItems = <?= json_encode($this->session->flashdata('edited_items')) ?>;
        const isSingleEdit = <?= json_encode($this->session->flashdata('is_single_edit')) ?>;
        
        setTimeout(function() {
            showSuccessEditModal(editedItems.length, editedItems, isSingleEdit);
        }, 800);
    });
<?php endif; ?>
// ============================================
// SUCCESS REVISION MODAL FUNCTIONS (DITOLAK DEKAN) - LENGKAP
// ============================================

// Fungsi untuk menampilkan success revision modal
function showSuccessRevisionModal(count, items, isSingle = false) {
const modal = document.getElementById('successRevisionModal');
const title = document.getElementById('successRevisionTitle');
const timestamp = document.getElementById('revisionTimestamp');
const itemCount = document.getElementById('revisionItemCount');
const listContainer = document.getElementById('revisionList');

title.textContent = isSingle ? 'Revisi Berhasil Dikirim' : 'Revisi Berhasil Dikirim (Multiple)';

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
    itemDiv.style.cssText = 'background:white;border:1px solid #bee5eb;border-radius:6px;margin-bottom:8px;overflow:hidden';
    
    // Status baru setelah di-revisi
    const newStatusBadge = `<span class="badge badge-info" style="background:#d1ecf1;color:#0c5460;flex-shrink:0">${item.new_status || 'disetujui sekretariat'}</span>`;
    
    // Generate HTML untuk dosen terlibat (seperti tampilan awal)
    const dosenHtml = generateDosenSectionRevisionHtml(item.dosen_data || [], item.changes || []);
    
    // Generate HTML untuk perubahan
    const changesHtml = generateChangesRevisionHtml(item.changes || []);
    
    itemDiv.innerHTML = `
        <div style="display:flex;align-items:center;gap:10px;padding:10px;border-bottom:1px solid #f0f0f0;">
            <i class="fas fa-paper-plane" style="color:#17a2b8;font-size:20px;flex-shrink:0"></i>
            <div style="flex:1;text-align:left">
                <div style="font-weight:600;color:#212529;font-size:14px">${escapeHtml(item.nama)}</div>
                <div style="font-size:12px;color:#6c757d">${item.details}</div>
            </div>
            ${newStatusBadge}
        </div>
        ${dosenHtml}
        ${changesHtml}
    `;
    listContainer.appendChild(itemDiv);
});

modal.classList.add('show');
}

// Generate HTML untuk section dosen terlibat (tampilan seperti awal) - REVISION
function generateDosenSectionRevisionHtml(dosenData, changes) {
if (!dosenData || dosenData.length === 0 || (dosenData.length === 1 && dosenData[0].nama === 'Data dosen tidak tersedia')) {
    return '';
}

const maxVisible = 3;
const isOverLimit = dosenData.length > maxVisible;
const visibleDosen = isOverLimit ? dosenData.slice(0, maxVisible) : dosenData;
const hiddenDosen = isOverLimit ? dosenData.slice(maxVisible) : [];
const uniqueId = 'dosen-revision-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

return `
<div style="background:#d1ecf1;border-top:1px solid #bee5eb;padding:15px;">
    <div style="font-weight:600;color:#0c5460;margin-bottom:10px;display:flex;align-items:center;justify-content:space-between;">
        <span style="display:flex;align-items:center;gap:8px;">
            <i class="fas fa-users"></i>
            <span>Dosen Terlibat</span>
        </span>
        <span style="background:#17a2b8;color:white;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
            ${dosenData.length} Dosen
        </span>
    </div>
    
    <div id="${uniqueId}" style="display:flex;flex-direction:column;gap:6px;">
        ${visibleDosen.map((dosen, index) => `
        <div style="display:flex;align-items:center;gap:8px;padding:8px;background:white;border:1px solid #b8daff;border-radius:6px;">
            <div style="width:32px;height:32px;border-radius:50%;background:#17a2b8;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:600;flex-shrink:0;">
                ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#333;font-size:13px;">${escapeHtml(dosen.nama)}</div>
                <div style="color:#666;font-size:11px;">NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}</div>
            </div>
        </div>
        `).join('')}
        
        ${hiddenDosen.map((dosen, index) => `
        <div class="dosen-hidden-revision" style="display:none;align-items:center;gap:8px;padding:8px;background:white;border:1px solid #b8daff;border-radius:6px;">
            <div style="width:32px;height:32px;border-radius:50%;background:#17a2b8;display:flex;align-items:center;justify-content:center;color:white;font-size:14px;font-weight:600;flex-shrink:0;">
                ${dosen.nama ? dosen.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#333;font-size:13px;">${escapeHtml(dosen.nama)}</div>
                <div style="color:#666;font-size:11px;">NIP: ${escapeHtml(dosen.nip)} | ${escapeHtml(dosen.jabatan)}</div>
            </div>
        </div>
        `).join('')}
    </div>
    
    ${isOverLimit ? `
    <button onclick="toggleDosenRevision('${uniqueId}', this)" 
        style="width:100%;margin-top:8px;background:#17a2b8;color:white;border:none;border-radius:6px;padding:8px;cursor:pointer;font-size:12px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:6px;transition:background 0.2s;">
        <i class="fa-solid fa-chevron-down"></i>
        <span>Tampilkan ${hiddenDosen.length} Dosen Lainnya</span>
    </button>
    ` : ''}
</div>`;
}

// Toggle show/hide dosen tambahan - REVISION
function toggleDosenRevision(containerId, button) {
const container = document.getElementById(containerId);
const hiddenItems = container.querySelectorAll('.dosen-hidden-revision');
const icon = button.querySelector('i');
const textSpan = button.querySelector('span');

let isExpanded = button.getAttribute('data-expanded') === 'true';

if (!isExpanded) {
    // Expand
    hiddenItems.forEach(item => {
        item.style.display = 'flex';
    });
    icon.className = 'fa-solid fa-chevron-up';
    textSpan.textContent = 'Sembunyikan';
    button.setAttribute('data-expanded', 'true');
    button.style.background = '#138496';
} else {
    // Collapse
    hiddenItems.forEach(item => {
        item.style.display = 'none';
    });
    icon.className = 'fa-solid fa-chevron-down';
    const hiddenCount = hiddenItems.length;
    textSpan.textContent = `Tampilkan ${hiddenCount} Dosen Lainnya`;
    button.setAttribute('data-expanded', 'false');
    button.style.background = '#17a2b8';
}
}

// Fungsi untuk generate HTML perubahan - REVISION
function generateChangesRevisionHtml(changes) {
// Filter out perubahan dosen karena sudah ditampilkan di section terpisah
const filteredChanges = changes.filter(c => c.field !== 'nip');

if (!filteredChanges || filteredChanges.length === 0) {
    return ''; // Jangan tampilkan apa-apa jika tidak ada perubahan selain dosen
}

let html = `
<div style="background:#e7f3f5;border-top:1px solid #b8daff;padding:15px;">
    <div style="font-weight:600;color:#0c5460;margin-bottom:10px;display:flex;align-items:center;gap:8px;">
        <i class="fas fa-exchange-alt"></i>
        <span>Perubahan yang Dilakukan (${filteredChanges.length} field)</span>
    </div>
    <div style="display:flex;flex-direction:column;gap:10px;">`;

filteredChanges.forEach((change, index) => {
    if (change.type === 'text') {
        html += generateTextChangeRevisionHtml(change);
    } else if (change.type === 'dosen') {
        html += generateDosenChangeRevisionHtml(change);
    } else if (change.type === 'files') {
        html += generateFilesChangeRevisionHtml(change);
    }
});

html += `
    </div>
</div>`;

return html;
}

// Generate HTML untuk perubahan text biasa - REVISION
function generateTextChangeRevisionHtml(change) {
const isDateField = ['tanggal_kegiatan', 'akhir_kegiatan', 'periode_penugasan', 'akhir_periode_penugasan'].includes(change.field);

let oldDisplay = change.old_value;
let newDisplay = change.new_value;

if (isDateField && oldDisplay !== '-') {
    oldDisplay = formatDateForDisplay(oldDisplay);
}
if (isDateField && newDisplay !== '-') {
    newDisplay = formatDateForDisplay(newDisplay);
}

return `
<div style="background:white;border:1px solid #b8daff;border-radius:6px;padding:10px;">
    <div style="font-weight:600;color:#0c5460;font-size:13px;margin-bottom:6px;">
        <i class="fas fa-edit" style="margin-right:4px;"></i>${escapeHtml(change.label)}
    </div>
    <div style="display:flex;align-items:center;gap:8px;font-size:12px;">
        <div style="flex:1;background:#e7f3f5;padding:8px 10px;border-radius:4px;border:1px solid #b8daff;">
            <div style="color:#666;font-size:10px;margin-bottom:3px;font-weight:600;">Sebelum:</div>
            <div style="color:#333;font-weight:500;">${escapeHtml(oldDisplay)}</div>
        </div>
        <i class="fas fa-arrow-right" style="color:#17a2b8;font-size:16px;"></i>
        <div style="flex:1;background:#d1ecf1;padding:8px 10px;border-radius:4px;border:1px solid #bee5eb;">
            <div style="color:#666;font-size:10px;margin-bottom:3px;font-weight:600;">Sesudah:</div>
            <div style="color:#0c5460;font-weight:600;">${escapeHtml(newDisplay)}</div>
        </div>
    </div>
</div>`;
}

// Generate HTML untuk perubahan dosen - REVISION
function generateDosenChangeRevisionHtml(change) {
const oldDosen = Array.isArray(change.old_value) ? change.old_value : [];
const newDosen = Array.isArray(change.new_value) ? change.new_value : [];

// Cari dosen yang ditambah dan dihapus
const addedDosen = newDosen.filter(nd => !oldDosen.some(od => od.nip === nd.nip));
const removedDosen = oldDosen.filter(od => !newDosen.some(nd => nd.nip === od.nip));
const unchangedDosen = newDosen.filter(nd => oldDosen.some(od => od.nip === nd.nip));

return `
<div style="background:white;border:1px solid #b8daff;border-radius:6px;padding:10px;">
    <div style="font-weight:600;color:#0c5460;font-size:13px;margin-bottom:8px;">
        <i class="fas fa-user-edit" style="margin-right:4px;"></i>${escapeHtml(change.label)} - Detail Perubahan
    </div>
    
    ${removedDosen.length > 0 ? `
    <div style="background:#ffebee;border:1px solid #ffcdd2;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#c62828;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-minus-circle"></i> Dosen Dihapus (${removedDosen.length}):
        </div>
        ${removedDosen.map(d => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <div style="width:18px;height:18px;border-radius:50%;background:#e53935;display:flex;align-items:center;justify-content:center;color:white;font-size:9px;font-weight:600;">
                ${d.nama ? d.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#c62828;font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${escapeHtml(d.nama)}</div>
                <div style="color:#666;font-size:9px;">NIP: ${escapeHtml(d.nip)}</div>
            </div>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${addedDosen.length > 0 ? `
    <div style="background:#e8f5e9;border:1px solid #c8e6c9;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#2e7d32;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-plus-circle"></i> Dosen Ditambah (${addedDosen.length}):
        </div>
        ${addedDosen.map(d => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <div style="width:18px;height:18px;border-radius:50%;background:#43a047;display:flex;align-items:center;justify-content:center;color:white;font-size:9px;font-weight:600;">
                ${d.nama ? d.nama.charAt(0).toUpperCase() : '?'}
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;color:#2e7d32;font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${escapeHtml(d.nama)}</div>
                <div style="color:#666;font-size:9px;">NIP: ${escapeHtml(d.nip)}</div>
            </div>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${unchangedDosen.length > 0 ? `
    <div style="background:#f5f5f5;border:1px solid #e0e0e0;border-radius:4px;padding:8px;">
        <div style="color:#616161;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-check-circle"></i> Dosen Tetap (${unchangedDosen.length}):
        </div>
        <div style="color:#757575;font-size:10px;font-style:italic;">
            ${unchangedDosen.map(d => d.nama).join(', ')}
        </div>
    </div>
    ` : ''}
</div>`;
}

// Generate HTML untuk perubahan files - REVISION
function generateFilesChangeRevisionHtml(change) {
const oldFiles = Array.isArray(change.old_value) ? change.old_value : [];
const newFiles = Array.isArray(change.new_value) ? change.new_value : [];

// Cari file yang ditambah dan dihapus
const addedFiles = newFiles.filter(nf => !oldFiles.includes(nf));
const removedFiles = oldFiles.filter(of => !newFiles.includes(of));
const unchangedFiles = newFiles.filter(nf => oldFiles.includes(nf));

return `
<div style="background:white;border:1px solid #b8daff;border-radius:6px;padding:10px;">
    <div style="font-weight:600;color:#0c5460;font-size:13px;margin-bottom:8px;">
        <i class="fas fa-file-edit" style="margin-right:4px;"></i>${escapeHtml(change.label)} - Detail Perubahan
    </div>
    
    ${removedFiles.length > 0 ? `
    <div style="background:#ffebee;border:1px solid #ffcdd2;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#c62828;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-minus-circle"></i> File Dihapus (${removedFiles.length}):
        </div>
        ${removedFiles.map(f => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <i class="fas fa-file" style="color:#e53935;font-size:12px;"></i>
            <span style="color:#c62828;font-size:11px;font-weight:500;">${getFileNameFromPath(f)}</span>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${addedFiles.length > 0 ? `
    <div style="background:#e8f5e9;border:1px solid #c8e6c9;border-radius:4px;padding:8px;margin-bottom:6px;">
        <div style="color:#2e7d32;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-plus-circle"></i> File Ditambah (${addedFiles.length}):
        </div>
        ${addedFiles.map(f => `
        <div style="display:flex;align-items:center;gap:6px;padding:4px;margin-bottom:2px;background:white;border-radius:3px;">
            <i class="fas fa-file" style="color:#43a047;font-size:12px;"></i>
            <span style="color:#2e7d32;font-size:11px;font-weight:600;">${getFileNameFromPath(f)}</span>
        </div>
        `).join('')}
    </div>
    ` : ''}
    
    ${unchangedFiles.length > 0 ? `
    <div style="background:#f5f5f5;border:1px solid #e0e0e0;border-radius:4px;padding:8px;">
        <div style="color:#616161;font-size:11px;font-weight:600;margin-bottom:4px;">
            <i class="fas fa-check-circle"></i> File Tetap (${unchangedFiles.length}):
        </div>
        ${unchangedFiles.map(f => `
        <div style="color:#757575;font-size:10px;">${getFileNameFromPath(f)}</div>
        `).join('')}
    </div>
    ` : ''}
</div>`;
}

// ============================================
// CHECK FOR SUCCESS REVISION MODAL DATA FROM SESSION
// ============================================

// Check for success revision modal data from session (ditolak dekan)
<?php if($this->session->flashdata('revision_items')): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const revisionItems = <?= json_encode($this->session->flashdata('revision_items')) ?>;
        const isSingleRevision = <?= json_encode($this->session->flashdata('is_single_revision')) ?>;
        
        setTimeout(function() {
            showSuccessRevisionModal(revisionItems.length, revisionItems, isSingleRevision);
        }, 800);
    });
<?php endif; ?>
            </script>
</body>
</html>