<?php 

// edit_surat.php - Versi Revisi dengan tampilan dan fitur sama seperti edit.php sekretariat
defined('BASEPATH') OR exit('No direct script access allowed');

$can_edit_dosen = true; // SELALU izinkan edit untuk sekretariat
// Tentukan mode revisi
$current_status = isset($surat['status']) ? strtolower($surat['status']) : '';
$is_revision = false;
$rejected_by = '';
$alert_class = 'alert-info';
$alert_icon = 'fa-info-circle';
$alert_title = 'Edit Pengajuan Surat';
$alert_message = 'Anda sedang mengedit pengajuan surat.';
$additional_message = '';

if ($current_status === 'ditolak kk') {
    $is_revision = true;
    $rejected_by = 'Kepala Kelompok (Kaprodi)';
    $alert_class = 'alert-warning';
    $alert_icon = 'fa-exclamation-triangle';
    $alert_title = 'Mode Revisi - Pengajuan Ulang';
    $alert_message = 'Surat ini ditolak oleh ' . $rejected_by . '.';
    $additional_message = 'Setelah Anda mengedit dan menyimpan, pengajuan akan dikirim kembali ke ' . $rejected_by . ' untuk disetujui ulang.';
} elseif ($current_status === 'ditolak sekretariat') {
    $is_revision = true;
    $rejected_by = 'Sekretariat';
    $alert_class = 'alert-warning';
    $alert_icon = 'fa-exclamation-triangle';
    $alert_title = 'Mode Revisi - Pengajuan Ulang';
    $alert_message = 'Surat ini ditolak oleh ' . $rejected_by . '.';
    $additional_message = 'Setelah Anda mengedit dan menyimpan, pengajuan akan dikirim kembali ke ' . $rejected_by . ' untuk disetujui ulang.';
} elseif ($current_status === 'ditolak dekan') {
    $is_revision = true;
    $rejected_by = 'Dekan';
    $alert_class = 'alert-warning';
    $alert_icon = 'fa-exclamation-triangle';
    $alert_title = 'Mode Revisi - Pengajuan Ulang';
    $alert_message = 'Surat ini ditolak oleh ' . $rejected_by . '.';
    $additional_message = 'Setelah Anda mengedit dan menyimpan, pengajuan akan dikirim kembali ke ' . $rejected_by . ' untuk disetujui ulang.';
}

// Tentukan form action
$form_action = site_url('sekretariat/edit_surat/' . ($surat['id'] ?? ''));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat - Pengajuan</title>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
        }

        /* Header */
        .header-title {
            background: #FF8C00;
            color: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 700;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }

        /* Form Container */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Form Sections */
        .form-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 5px solid #FF8C00;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .form-section h5 {
            color: #FF8C00;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #FF8C00;
            box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.2);
        }

        /* Required Field */
        .required-field::after {
            content: " *";
            color: #e74c3c;
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead {
            background: #fff3e0;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            text-align: left;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: #FF8C00;
            color: white;
        }

        .btn-primary:hover {
            background: #e67e00;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #7f8c8d;
            color: white;
        }

        .btn-secondary:hover {
            background: #6c757d;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        .remove-row {
            color: #e74c3c;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .remove-row:hover {
            background: #f8d7da;
            transform: scale(1.1);
        }

        /* Dosen Button */
        .btn-add-dosen {
            background: linear-gradient(135deg, #FF8C00 0%, #e67e00 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            font-family: inherit;
            font-size: 14px;
        }

        .btn-add-dosen:hover {
            background: linear-gradient(135deg, #e67e00 0%, #d35400 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
        }

        .btn-remove-dosen {
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            background: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-remove-dosen:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
            background: #c0392b;
        }

        /* File Evidence Styles - SEKRETARIAT STYLE */
        .existing-file-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .existing-file-item:hover {
            background: #fff3e0;
            border-color: #FF8C00;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.1);
        }

        .file-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #FF8C00 0%, #e67e00 100%);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .file-info {
            flex: 1;
            min-width: 0;
        }

        .file-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-size {
            font-size: 12px;
            color: #7f8c8d;
        }

        .file-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        .btn-view-file,
        .btn-delete-existing {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-view-file {
            background: #3498db;
            color: white;
        }

        .btn-view-file:hover {
            background: #2980b9;
            transform: scale(1.05);
        }

        .btn-delete-existing {
            background: #e74c3c;
            color: white;
        }

        .btn-delete-existing:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        /* Upload Area Styles - SEKRETARIAT STYLE */
        .upload-area {
            border: 2px dashed #ddd;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            background: #f8f9fa;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .upload-area:hover {
            border-color: #FF8C00;
            background: #fff3e0;
        }

        .upload-area.drag-over {
            border-color: #FF8C00;
            background: #fff3e0;
            transform: scale(1.01);
        }

        .upload-area.uploading {
            border-color: #FF8C00;
            background: #fff3e0;
        }

        .upload-icon {
            font-size: 48px;
            color: #6c757d;
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .upload-area:hover .upload-icon {
            color: #FF8C00;
            transform: translateY(-5px);
        }

        .upload-text {
            font-size: 16px;
            color: #495057;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .upload-or {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .choose-file-btn {
            display: inline-block;
            padding: 10px 24px;
            background: #FF8C00;
            color: white;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-family: inherit;
            font-size: 14px;
        }

        .choose-file-btn:hover {
            background: #e67e00;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
        }

        /* Loading Bar Styles */
        .loading-bar-container {
            display: none;
            margin-top: 15px;
            background: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            height: 30px;
            position: relative;
        }

        .loading-bar {
            height: 100%;
            background: linear-gradient(90deg, #FF8C00, #e67e00);
            width: 0%;
            transition: width 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading-text {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: 600;
            font-size: 12px;
            white-space: nowrap;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .upload-success {
            display: none;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 15px;
            text-align: center;
            font-weight: 600;
            animation: fadeIn 0.5s;
        }

        .upload-success.show {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Uploaded Files Preview */
        .uploaded-files-preview {
            display: none;
            margin-top: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e9ecef;
        }

        .uploaded-files-preview.show {
            display: block;
        }

        .uploaded-file-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            margin-bottom: 8px;
            border: 1px solid #e9ecef;
        }

        .uploaded-file-name {
            flex: 1;
            font-weight: 600;
            color: #2c3e50;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .uploaded-file-size {
            font-size: 11px;
            color: #6c757d;
        }

        .uploaded-file-status {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        .status-success {
            background: #d4edda;
            color: #155724;
        }

        .status-error {
            background: #f8d7da;
            color: #721c24;
        }

        .status-uploading {
            background: #d1ecf1;
            color: #0c5460;
        }

        /* New File Input Container */
        .new-files-container {
            margin-top: 20px;
            display: none;
        }

        .new-files-container.show {
            display: block;
        }

        .new-file-input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .new-file-input-wrapper .form-control {
            flex: 1;
            background: white;
        }

        .btn-remove-new-file {
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-remove-new-file:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        /* Hidden file inputs container */
        .hidden-files-container {
            display: none;
        }

        /* Info Alert */
        .info-alert {
            background: #fff3e0;
            border: 1px solid #FF8C00;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-alert i {
            color: #FF8C00;
        }

        /* Error Message */
        .upload-error {
            display: none;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 15px;
            text-align: center;
            font-weight: 600;
        }

        .upload-error.show {
            display: block;
        }

        .file-deleted {
            opacity: 0.5;
            background: #f8d7da !important;
            border-color: #f5c6cb !important;
            text-decoration: line-through;
            pointer-events: none;
        }

        /* Modal Preview */
        .preview-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 10000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .preview-modal.show {
            display: flex;
        }

        .preview-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .preview-header {
            background: #FF8C00;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .preview-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        .preview-close {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .preview-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .preview-body {
            flex: 1;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
            min-height: 400px;
        }

        .preview-iframe {
            width: 100%;
            height: 70vh;
            border: none;
        }

        .preview-image {
            max-width: 100%;
            max-height: 70vh;
            object-fit: contain;
        }

        .preview-unsupported {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }

        .preview-unsupported i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #FF8C00;
        }

        /* Alert Box for Revision Mode */
        .alert-revision {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
        }

        .alert-revision-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .alert-revision-icon {
            background: #ffc107;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .alert-revision-icon i {
            color: #856404;
            font-size: 24px;
        }

        .rejection-reason {
            margin-top: 12px;
            padding: 12px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #dc3545;
        }

        /* Alert Box for Normal Edit Mode */
        .alert-normal {
            background: #fff3e0;
            border: 2px solid #FF8C00;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(255, 140, 0, 0.2);
        }

        .alert-normal-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .alert-normal-icon {
            background: #FF8C00;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .alert-normal-icon i {
            color: white;
            font-size: 24px;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .badge-warning { background: #ffc107; color: #000; }
        .badge-success { background: #28a745; color: white; }
        .badge-danger { background: #dc3545; color: white; }
        .badge-info { background: #17a2b8; color: white; }
        .badge-secondary { background: #6c757d; color: white; }

        /* Optional Field Styling */
        .optional-field {
            color: #6c757d;
            font-weight: normal;
        }

        .optional-field::after {
            content: " (Opsional)";
            font-size: 12px;
            color: #6c757d;
            font-weight: normal;
        }

        /* Customize field styling */
        .customize-note {
            font-size: 11px;
            color: #6c757d;
            margin-top: 4px;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }

            .form-section {
                padding: 15px;
            }

            .existing-file-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .file-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .btn-view-file,
            .btn-delete-existing {
                flex: 1;
                justify-content: center;
            }

            .file-name {
                white-space: normal;
                word-break: break-all;
            }
        }

        /* ========== AUTCOMPLETE STYLES SAMA SEPERTI STEP 1 ========== */
        .dosen-row { 
            transition: all 0.3s ease; 
            opacity: 1; 
            transform: translateY(0); 
        }
        .dosen-row.removing { 
            opacity: 0; 
            transform: translateX(20px); 
        }

        /* PERBAIKAN AUTCOMPLETE: Lebih jelas dan tebal */
        .autocomplete-box-fixed {
            position: fixed;
            background: #fff;
            border: none;
            z-index: 9999999;
            max-height: 400px;
            overflow-y: auto;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            font-size: 14px;
            padding: 8px 0;
            margin-top: 5px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-width: 320px;
            border: 1px solid #e0e0e0;
        }

        .autocomplete-item {
            padding: 0;
            cursor: pointer;
            transition: background-color 0.1s ease;
            border: none;
            line-height: 1.4;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            border-bottom: 1px solid #f5f5f5;
        }

        .autocomplete-item:last-child {
            border-bottom: none;
        }

        .autocomplete-item:hover,
        .autocomplete-item.active {
            background: #f1f8ff;
        }

        .autocomplete-item.autocomplete-item-active {
            background: #e8f0fe !important;
        }

        .autocomplete-icon {
            width: 20px;
            height: 20px;
            margin-left: 16px;
            flex-shrink: 0;
            opacity: 0.7;
        }

        .autocomplete-icon svg {
            width: 20px;
            height: 20px;
            fill: #FF8C00;
        }

        .autocomplete-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 14px 16px 14px 0;
            flex: 1;
            min-width: 0;
        }

        .autocomplete-item .item-primary {
            font-size: 15px;
            color: #202124;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
        }

        .autocomplete-item .item-secondary {
            font-size: 13px;
            color: #5f6368;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 2px;
        }

        .query-match {
            font-weight: 700;
            color: #FF8C00;
            background-color: #fff3e0;
            padding: 0 2px;
            border-radius: 2px;
        }

        .autocomplete-item:first-child {
            border-left: 4px solid #FF8C00;
            background-color: #f8f9fa;
        }

        .autocomplete-item:first-child:hover {
            background-color: #f1f8ff;
        }

        .autocomplete-loading,
        .autocomplete-empty {
            padding: 20px;
            text-align: center;
            color: #70757a;
            font-size: 14px;
            font-weight: 500;
        }

        .autocomplete-box-fixed::-webkit-scrollbar {
            width: 10px;
        }

        .autocomplete-box-fixed::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .autocomplete-box-fixed::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
            border: 2px solid #fff;
        }

        .autocomplete-box-fixed::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Additional Styles for Editable Dosen Fields */
        .table-dosen .form-control-sm {
            padding: 8px 10px;
            font-size: 13px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .table-dosen .form-control-sm:focus {
            border-color: #e67e00 !important;
            background: #ffffff !important;
            box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.15);
            transform: scale(1.02);
        }

        .table-dosen .form-control-sm:hover {
            border-color: #e67e00;
        }

        /* Styling untuk kolom peran */
        .peran-column.hidden {
            display: none !important;
        }

        .peran-column.visible {
            display: table-cell !important;
        }

        /* Styling untuk tombol aksi */
        .aksi-cell {
            width: 60px;
            text-align: center;
        }

        .btn-tambah {
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-tambah:hover {
            background: #219653;
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(39, 174, 96, 0.3);
        }

        .btn-hapus {
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-hapus:hover {
            background: #c0392b;
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
        }

        /* Responsive adjustments untuk autocomplete */
        @media (max-width: 768px) {
            .autocomplete-box-fixed {
                position: absolute !important;
                width: 90% !important;
                left: 5% !important;
                right: 5% !important;
                max-height: 300px;
            }
        }
        /* Disabled Button State */
        .btn-disabled {
            background: #95a5a6 !important;
            cursor: not-allowed !important;
            pointer-events: none;
        }

        .btn-disabled:hover {
            transform: none !important;
            box-shadow: none !important;
        }
        /* New File Item Styles */
.new-file-item {
    background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%) !important;
    border: 2px solid #4caf50 !important;
    animation: pulse-green 2s infinite;
}

@keyframes pulse-green {
    0% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(76, 175, 80, 0); }
    100% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0); }
}

.new-file-badge {
    background: #4caf50;
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 10px;
    font-weight: bold;
    margin-left: 8px;
}
    </style>
</head>
<body>

    <div class="container">
        <div class="header-title">
            <i class="fas fa-edit"></i> Edit Pengajuan Surat - Sekretariat
            <?php if(isset($surat['status'])): ?>
                <div style="font-size: 14px; margin-top: 10px; opacity: 0.9;">
                    <i class="fas fa-tag"></i> Status: 
                    <span class="status-badge <?= 
                        strpos($current_status, 'disetujui kk') !== false ? 'badge-info' : 
                        (strpos($current_status, 'disetujui sekretariat') !== false ? 'badge-success' : 
                        (strpos($current_status, 'ditolak sekretariat') !== false ? 'badge-danger' : 'badge-warning')) 
                    ?>">
                        <?= htmlspecialchars($surat['status']) ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Alert Info untuk Mode Sekretariat -->
        <div class="alert-sekretariat">
            <div class="alert-sekretariat-content">
                <div class="alert-sekretariat-icon">
                    <i class="fas <?= $alert_icon ?>"></i>
                </div>
                <div style="flex: 1;">
                    <h4 style="margin: 0 0 8px 0; color: #0c5460; font-size: 18px; font-weight: 700;">
                        <i class="fas fa-user-cog"></i> <?= $alert_title ?>
                    </h4>
                    <p style="margin: 0; color: #0c5460; font-size: 14px; line-height: 1.6;">
                        <strong><?= $alert_message ?></strong>
                        <?= $additional_message ?>
                    </p>
                    
                    <?php if(in_array($current_status, ['disetujui sekretariat', 'ditolak sekretariat'])): ?>
                        <div style="margin-top: 10px; padding: 8px 12px; background: rgba(22, 160, 133, 0.1); border-radius: 6px;">
                            <small style="color: #138D75;">
                                <i class="fas fa-sync-alt"></i> 
                                <strong>Status akan direset ke:</strong> "Disetujui KK"
                            </small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <form action="<?= $form_action ?>" method="post" enctype="multipart/form-data" id="mainForm">
            <!-- Informasi Kegiatan -->
            <div class="form-section">
                <h5><i class="fas fa-info-circle"></i> Informasi Kegiatan</h5>
                
                <?php if(in_array($current_status, ['disetujui sekretariat'])): ?>
                <div class="form-group">
                    <label>Nomor Surat <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="nomor_surat" class="form-control" value="<?= htmlspecialchars($surat['nomor_surat'] ?? ''); ?>" required>
                    <small style="color: #6c757d; font-size: 12px;">Format: XXX/SKT/FT/Tahun</small>
                </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label>Nama Kegiatan <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="nama_kegiatan" class="form-control" value="<?= htmlspecialchars($surat['nama_kegiatan'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Pengajuan</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($surat['created_at'] ?? '-'); ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Jenis Tanggal</label>
                    <select name="jenis_date" id="jenis_date" class="form-control">
                        <option value="Custom" <?= (isset($surat['jenis_date']) && $surat['jenis_date'] == 'Custom') ? 'selected' : '' ?>>Custom</option>
                        <option value="Periode" <?= (isset($surat['jenis_date']) && $surat['jenis_date'] == 'Periode') ? 'selected' : '' ?>>Periode</option>
                    </select>
                </div>

                <!-- SECTION CUSTOM DATE -->
                <div id="custom_date" class="date-section <?= (isset($surat['jenis_date']) && ($surat['jenis_date'] == 'Custom' || $surat['jenis_date'] == 'custom')) ? 'active' : '' ?>">
                    <div class="row">
                        <!-- Tanggal Kegiatan (Date Range) -->
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <label>Tanggal Kegiatan (opsional)</label>
                                <input type="text" id="datepicker" class="form-control flatpickr-input"
                                       autocomplete="off" inputmode="none" readonly
                                       placeholder="Klik untuk pilih tanggal (opsional)">
                                <label id="lbl_mulai">Tanggal Awal s/d Akhir</label>

                                <!-- Hidden input -->
                                <input type="hidden" id="tanggal_awal_kegiatan" name="tanggal_kegiatan" 
                                       value="<?= htmlspecialchars($surat['tanggal_kegiatan'] ?? '') ?>">
                                <input type="hidden" id="tanggal_akhir_kegiatan" name="akhir_kegiatan"
                                       value="<?= htmlspecialchars($surat['akhir_kegiatan'] ?? '') ?>">

                                <!-- Konfirmasi tanggal -->
                                <div id="konfirmasi_tanggal" class="small mt-2" style="display: none;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="text-success">✓ Tanggal dipilih:</span>
                                        <span id="day_counter" class="badge bg-info"></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span id="konfirmasi_awal" class="text-muted small"></span>
                                        <span id="konfirmasi_akhir" class="text-muted small"></span>
                                    </div>
                                </div>

                                <div class="info-message small mt-1" id="range_info">
                                    Klik tanggal awal, lalu klik tanggal akhir (opsional)
                                </div>
                                
                                <!-- Pesan error untuk validasi tanggal -->
                                <div id="date_error" class="error-message" style="display: none;">
                                    <i class="fas fa-exclamation-triangle"></i> <span id="error_text"></span>
                                </div>
                                
                                <!-- Info batas 60 hari -->
                                <div id="day_limit_info" class="info-message small" style="display: none;">
                                    <i class="fas fa-info-circle"></i> Maksimal 60 hari dari tanggal awal
                                </div>
                            </div>
                        </div>

                        <!-- Periode penugasan -->
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <input type="text" name="periode_penugasan" id="datepicker3"
                                       class="form-control flatpickr-input"
                                       autocomplete="off" inputmode="none" readonly
                                       placeholder="Otomatis terisi">

                                <label id="lbl_mulai1">Periode Penugasan</label>
                                <div class="info-message small" id="info_periode">Akan terisi otomatis</div>
                            </div>
                        </div>

                        <!-- Akhir penugasan -->
                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <input type="text" name="akhir_periode_penugasan" id="datepicker4"
                                       class="form-control flatpickr-input"
                                       autocomplete="off" inputmode="none" readonly
                                       placeholder="Otomatis terisi">

                                <label id="lbl_akhir1">Akhir Penugasan</label>
                                <div class="info-message small" id="info_akhir">Akan terisi otomatis</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="periode_date" style="<?= (isset($surat['jenis_date']) && $surat['jenis_date'] == 'Periode') ? '' : 'display:none;'; ?>">
                    <div class="form-group">
                        <label>Pilih Periode</label>
                        <select name="periode_value" class="form-control">
                            <?php
                            $years = ["2024/2025", "2025/2026", "2026/2027", "2027/2028", "2028/2029", "2029/2030"];
                            foreach ($years as $y) {
                                $g = $y . ' Ganjil';
                                $p = $y . ' Genap';
                                echo '<option value="' . htmlspecialchars($g) . '" ' . ((isset($surat['periode_value']) && $surat['periode_value'] == $g) ? 'selected' : '') . '>' . htmlspecialchars($g) . '</option>';
                                echo '<option value="' . htmlspecialchars($p) . '" ' . ((isset($surat['periode_value']) && $surat['periode_value'] == $p) ? 'selected' : '') . '>' . htmlspecialchars($p) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tempat Kegiatan</label>
                    <input type="text" name="tempat_kegiatan" class="form-control" value="<?= htmlspecialchars($surat['tempat_kegiatan'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label>Penyelenggara</label>
                    <input type="text" name="penyelenggara" class="form-control" value="<?= htmlspecialchars($surat['penyelenggara'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>Customize</label>
                    <input type="text" name="customize" class="form-control" value="<?= htmlspecialchars($surat['customize'] ?? ''); ?>">
                </div>
            </div>

            <!-- Jenis Pengajuan -->
            <div class="form-section">
                <h5><i class="fas fa-tasks"></i> Jenis Pengajuan</h5>
                <div class="form-group">
                    <label>Jenis Pengajuan</label>
                    <select name="jenis_pengajuan" id="jenis_pengajuan" class="form-control">
                        <option value="Perorangan" <?= (isset($surat['jenis_pengajuan']) && $surat['jenis_pengajuan'] == 'Perorangan') ? 'selected' : '' ?>>Perorangan</option>
                        <option value="Kelompok" <?= (isset($surat['jenis_pengajuan']) && $surat['jenis_pengajuan'] == 'Kelompok') ? 'selected' : '' ?>>Kelompok</option>
                    </select>
                </div>

                <!-- Lingkup Penugasan -->
                <div class="form-group">
                    <label>Lingkup Penugasan</label>
                    <select name="lingkup_penugasan" class="form-control">
                        <option value="Dosen" <?= (isset($surat['lingkup_penugasan']) && $surat['lingkup_penugasan'] == 'Dosen') ? 'selected' : '' ?>>Dosen</option>
                        <option value="TPA" <?= (isset($surat['lingkup_penugasan']) && $surat['lingkup_penugasan'] == 'TPA') ? 'selected' : '' ?>>TPA</option>
                        <option value="Dosen dan TPA" <?= (isset($surat['lingkup_penugasan']) && $surat['lingkup_penugasan'] == 'Dosen dan TPA') ? 'selected' : '' ?>>Dosen dan TPA</option>
                    </select>
                </div>

                <div id="perorangan_box" style="<?= (isset($surat['jenis_pengajuan']) && $surat['jenis_pengajuan'] == 'Perorangan') ? '' : 'display:none;'; ?>">
                    <div class="form-group">
                        <label>Jenis Penugasan (Perorangan)</label>
                        <select name="jenis_penugasan_perorangan" id="jenis_penugasan_perorangan" class="form-control">
                            <?php 
                            $opsi_per = ["Juri", "Pembicara", "Narasumber", "Lainnya"];
                            foreach ($opsi_per as $o) {
                                $selected = (isset($surat['jenis_penugasan_perorangan']) && $surat['jenis_penugasan_perorangan'] == $o) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($o) . '" ' . $selected . '>' . htmlspecialchars($o) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="lainnya_perorangan_box" style="<?= (isset($surat['jenis_penugasan_perorangan']) && $surat['jenis_penugasan_perorangan'] == 'Lainnya') ? '' : 'display:none;'; ?>">
                        <label>Isi Penugasan Lainnya</label>
                        <input type="text" name="penugasan_lainnya_perorangan" class="form-control" value="<?= htmlspecialchars($surat['penugasan_lainnya_perorangan'] ?? ''); ?>">
                    </div>
                </div>

                <div id="kelompok_box" style="<?= (isset($surat['jenis_pengajuan']) && $surat['jenis_pengajuan'] == 'Kelompok') ? '' : 'display:none;'; ?>">
                    <div class="form-group">
                        <label>Jenis Penugasan (Kelompok)</label>
                        <select name="jenis_penugasan_kelompok" id="jenis_penugasan_kelompok" class="form-control">
                            <?php 
                            $opsi_kel = ["Tim", "Kepanitiaan", "Lainnya"];
                            foreach ($opsi_kel as $o) {
                                $selected = (isset($surat['jenis_penugasan_kelompok']) && $surat['jenis_penugasan_kelompok'] == $o) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($o) . '" ' . $selected . '>' . htmlspecialchars($o) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="lainnya_kelompok_box" style="<?= (isset($surat['jenis_penugasan_kelompok']) && $surat['jenis_penugasan_kelompok'] == 'Lainnya') ? '' : 'display:none;'; ?>">
                        <label>Isi Penugasan Lainnya</label>
                        <input type="text" name="penugasan_lainnya_kelompok" class="form-control" value="<?= htmlspecialchars($surat['penugasan_lainnya_kelompok'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <!-- Ubah bagian tabel dosen menjadi: -->
<div class="form-section">
    <h5><i class="fas fa-users"></i> Dosen Terkait</h5>
    
    <div class="table-responsive">
        <table class="table-dosen">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>Jabatan</th>
                    <th>Prodi/Unit</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="dosenTableBody">
                <?php if (!empty($dosen_data)): ?>
                    <?php foreach ($dosen_data as $index => $dosen): ?>
                        <tr class="dosen-row" data-index="<?= $index ?>">
                            <td>
                                <input type="text" 
                                       name="nip[]" 
                                       value="<?= htmlspecialchars($dosen['nip']) ?>" 
                                       class="form-control form-control-sm nip-input" 
                                       data-index="<?= $index ?>"
                                       placeholder="Ketik NIP"
                                       required>
                            </td>
                            <td>
                                <input type="text" 
                                       name="nama_dosen[]" 
                                       value="<?= htmlspecialchars($dosen['nama']) ?>" 
                                       class="form-control form-control-sm nama-dosen-input" 
                                       placeholder="Ketik Nama Dosen">
                            </td>
                            <td>
                                <input type="text" 
                                       name="jabatan[]" 
                                       value="<?= htmlspecialchars($dosen['jabatan']) ?>" 
                                       class="form-control form-control-sm jabatan-input" 
                                       placeholder="Contoh: Lektor">
                            </td>
                            <td>
                                <input type="text" 
                                       name="divisi[]" 
                                       value="<?= htmlspecialchars($dosen['divisi']) ?>" 
                                       class="form-control form-control-sm divisi-input" 
                                       placeholder="Contoh: DI">
                            </td>
                            <td>
                                <input type="text" 
                                       name="peran[]" 
                                       value="<?= htmlspecialchars($dosen['peran']) ?>" 
                                       class="form-control form-control-sm peran-input" 
                                       placeholder="Contoh: Ketua Tim">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm btn-remove-dosen" onclick="removeDosen(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada dosen terkait</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <button type="button" class="btn-add-dosen" onclick="addDosenRow()">
        <i class="fas fa-plus"></i> Tambah Dosen
    </button>
</div>

            <!-- File Eviden -->
            <div class="form-section">
                <h5><i class="fas fa-file-alt"></i> File Eviden</h5>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label class="font-weight-bold">Upload File Eviden</label>
                        <small class="text-muted">Anda dapat menambah atau menghapus file eviden yang sudah diupload.</small>
                    </div>
                    
                    <div class="info-alert">
                        <i class="fas fa-info-circle"></i>
                        <span><strong><?= count($eviden ?? []) ?> file telah diupload.</strong></span>
                    </div>
                    
                    <div class="mb-3">
                        <label class="font-weight-bold mb-2">Tambah File Baru</label>
                        <div style="color: #6c757d; font-size: 14px; margin-bottom: 8px;">
                            <i class="fas fa-arrow-up"></i> drag & drop file atau klik untuk memilih
                        </div>
                        
                        <!-- Upload Area -->
                        <div id="uploadArea" class="upload-area">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">
                                drag & drop any files
                            </div>
                            <div class="upload-or">
                                or
                            </div>
                            <div class="choose-file-btn" id="chooseFileBtn">
                                Choose a local file!
                            </div>
                            <input type="file" id="fileInput" name="new_eviden[]" multiple style="display: none;" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
                        </div>
                        
                        <!-- Container untuk input file baru -->
                        <div id="newFilesContainer" class="new-files-container"></div>
                        
                        <!-- Container untuk file yang di-drag & drop -->
                        <div id="hiddenFilesContainer" class="hidden-files-container"></div>
                        
                        <!-- Loading Bar -->
                        <div id="loadingBarContainer" class="loading-bar-container">
                            <div id="loadingBar" class="loading-bar">
                                <div id="loadingText" class="loading-text">0%</div>
                            </div>
                        </div>
                        
                        <!-- Upload Success Message -->
                        <div id="uploadSuccess" class="upload-success">
                            <i class="fas fa-check-circle"></i> File berhasil ditambahkan!
                        </div>
                        
                        <!-- Upload Error Message -->
                        <div id="uploadError" class="upload-error">
                            <i class="fas fa-exclamation-triangle"></i> <span id="errorMessage"></span>
                        </div>
                        
                        <!-- Uploaded Files Preview -->
                        <div id="uploadedFilesPreview" class="uploaded-files-preview">
                            <h6 style="color: #16A085; margin-bottom: 15px; font-size: 14px;">
                                <i class="fas fa-list"></i> File yang akan diupload
                            </h6>
                            <div id="filesList"></div>
                        </div>
                        
                        <div style="text-align: center; margin-top: 15px;">
                            <a href="#" id="showFilesLink" style="color: #16A085; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-eye"></i> Show files
                            </a>
                            <div id="fileCounter" style="color: #6c757d; font-size: 13px; margin-top: 5px;">
                                You've chosen 0 files.
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- File yang sudah diupload -->
                <div class="mb-4">
                    <label class="font-weight-bold mb-3">File yang sudah diupload (<?= count($eviden ?? []) ?>):</label>
                    
                    <div id="existingFilesContainer">
                        <?php
                        if (!empty($eviden) && is_array($eviden) && count($eviden) > 0):
                            foreach ($eviden as $idx => $fileRaw):
                                if (empty($fileRaw)) continue;

                                $file = $fileRaw;
                                if (is_array($fileRaw)) {
                                    $candidates = ['file', 'filename', 'nama', 'nama_file', 'name', 0];
                                    $file = null;
                                    foreach ($candidates as $k) {
                                        if (isset($fileRaw[$k]) && is_string($fileRaw[$k]) && trim($fileRaw[$k]) !== '') {
                                            $file = $fileRaw[$k];
                                            break;
                                        }
                                    }
                                    if ($file === null) {
                                        foreach ($fileRaw as $v) {
                                            if (is_string($v) && trim($v) !== '') {
                                                $file = $v;
                                                break;
                                            }
                                        }
                                    }
                                }

                                if (!is_string($file) || trim($file) === '') continue;
                                $file = trim($file);

                                $is_external = filter_var($file, FILTER_VALIDATE_URL) ? true : false;
                                $contains_uploads = (strpos($file, 'uploads/') !== false) || (strpos($file, '/uploads/') !== false);

                                if ($is_external) {
                                    $label = basename($file);
                                    $view_link = $file;
                                } else {
                                    if ($contains_uploads) {
                                        $clean_path = ltrim($file, '/');
                                        $label = basename($clean_path);
                                        $view_link = base_url($clean_path);
                                    } else {
                                        $label = basename($file);
                                        $view_link = base_url('uploads/eviden/' . $file);
                                    }
                                }

                                $ext = strtolower(pathinfo($label, PATHINFO_EXTENSION) ?: '');
                                $icon = 'fa-file';
                                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) $icon = 'fa-file-image';
                                elseif ($ext == 'pdf') $icon = 'fa-file-pdf';
                                elseif (in_array($ext, ['doc', 'docx'])) $icon = 'fa-file-word';
                                elseif (in_array($ext, ['xls', 'xlsx'])) $icon = 'fa-file-excel';

                                $filesize = 'N/A';
                                if (!$is_external) {
                                    $filepath = './uploads/eviden/' . $file;
                                    if (file_exists($filepath)) {
                                        $filesize = round(filesize($filepath) / 1048576, 2) . ' MB';
                                    } else {
                                        $filesize = 'N/A';
                                    }
                                } else {
                                    $filesize = 'External';
                                }
                        ?>
                                <div class="existing-file-item" data-file-index="<?= htmlspecialchars($idx) ?>" data-filename="<?= htmlspecialchars($file) ?>">
                                    <div class="file-icon">
                                        <i class="fas <?= htmlspecialchars($icon) ?>"></i>
                                    </div>
                                    <div class="file-info">
                                        <div class="file-name" title="<?= htmlspecialchars($file) ?>"><?= htmlspecialchars($label) ?></div>
                                        <div class="file-size"><?= htmlspecialchars($filesize) ?></div>
                                    </div>
                                    <div class="file-actions">
                                        <button type="button" class="btn-view-file" data-src="<?= htmlspecialchars($view_link) ?>" data-type="<?= htmlspecialchars($ext) ?>">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                        <button type="button" class="btn-delete-existing" onclick="deleteExistingFile(<?= htmlspecialchars($idx) ?>,'<?= htmlspecialchars($file, ENT_QUOTES) ?>')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>

                                    <input type="hidden" name="existing_eviden[]" value="<?= htmlspecialchars($file) ?>" class="existing-file-input">
                                    <input type="hidden" name="delete_eviden[]" value="" class="delete-flag">
                                </div>
                            <?php
                            endforeach;
                        else:
                            ?>
                            <div class="existing-file-item">
                                <div class="file-icon">
                                    <i class="fas fa-file"></i>
                                </div>
                                <div class="file-info">
                                    <div class="file-name">
                                        46s406206fef8acdf19b7aa56703d2ff.png
                                    </div>
                                    <div class="file-size">0.01 MB</div>
                                </div>
                                <div class="file-actions">
                                    <button type="button" class="btn-view-file" data-src="#" data-type="png">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    <button type="button" class="btn-delete-existing" onclick="deleteExistingFile(0, '46s406206fef8acdf19b7aa56703d2ff.png')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <input type="hidden" name="existing_eviden[]" value="46s406206fef8acdf19b7aa56703d2ff.png" class="existing-file-input">
                                <input type="hidden" name="delete_eviden[]" value="" class="delete-flag">
                            </div>
                            <div class="existing-file-item">
                                <div class="file-icon">
                                    <i class="fas fa-file"></i>
                                </div>
                                <div class="file-info">
                                    <div class="file-name">
                                        197a6da58dcb4a0787cd2444c8ccdebf.png
                                    </div>
                                    <div class="file-size">0.01 MB</div>
                                </div>
                                <div class="file-actions">
                                    <button type="button" class="btn-view-file" data-src="#" data-type="png">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                    <button type="button" class="btn-delete-existing" onclick="deleteExistingFile(1, '197a6da58dcb4a0787cd2444c8ccdebf.png')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                                <input type="hidden" name="existing_eviden[]" value="197a6da58dcb4a0787cd2444c8ccdebf.png" class="existing-file-input">
                                <input type="hidden" name="delete_eviden[]" value="" class="delete-flag">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-section">
                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('sekretariat') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </form>
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

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // ===== FILE UPLOAD FUNCTIONALITY - WITH LOADING PROGRESS BAR =====
        document.addEventListener('DOMContentLoaded', function() {
            const uploadArea = document.getElementById('uploadArea');
            const chooseFileBtn = document.getElementById('chooseFileBtn');
            const fileInput = document.getElementById('fileInput');
            const newFilesContainer = document.getElementById('newFilesContainer');
            const hiddenFilesContainer = document.getElementById('hiddenFilesContainer');
            const fileCounter = document.getElementById('fileCounter');
            const showFilesLink = document.getElementById('showFilesLink');
            const loadingBarContainer = document.getElementById('loadingBarContainer');
            const loadingBar = document.getElementById('loadingBar');
            const loadingText = document.getElementById('loadingText');
            const uploadSuccess = document.getElementById('uploadSuccess');
            const uploadError = document.getElementById('uploadError');
            const errorMessage = document.getElementById('errorMessage');
            const uploadedFilesPreview = document.getElementById('uploadedFilesPreview');
            const filesList = document.getElementById('filesList');
            const submitBtn = document.getElementById('submitBtn');
            const mainForm = document.getElementById('mainForm');
            
            let fileCounterNumber = 0;
            let uploadedFiles = [];
            let totalFiles = 0;
            let uploadedCount = 0;
            let isProcessing = false; // Flag untuk mencegah duplikasi

            // Click on upload area
            uploadArea.addEventListener('click', function() {
                fileInput.click();
            });
            
            // Click on choose file button
            chooseFileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.click();
            });
            

            // File input change
            fileInput.addEventListener('change', function(e) {
                if (isProcessing) return;
                isProcessing = true;
                
                const files = Array.from(e.target.files);
                handleFiles(files);
                
                // Reset input untuk memungkinkan upload file yang sama lagi
                setTimeout(() => {
                    fileInput.value = '';
                    isProcessing = false;
                }, 100);
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });
            
            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadArea.classList.add('drag-over');
            }

            function unhighlight() {
                uploadArea.classList.remove('drag-over');
            }

            uploadArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            });
            
            // Handle selected files
            function handleFiles(files) {
                // Reset previous uploads
                uploadSuccess.classList.remove('show');
                uploadError.classList.remove('show');
                uploadedFilesPreview.classList.remove('show');
                filesList.innerHTML = '';
                uploadedFiles = [];
                
                totalFiles = files.length;
                uploadedCount = 0;
                
                if (totalFiles === 0) return;
                
                // Validate files
                let validFiles = [];
                let invalidFiles = [];
                
                for (let i = 0; i < totalFiles; i++) {
                    const file = files[i];
                    const sizeMB = (file.size / 1024 / 1024);
                    
                    // Check file size (max 10MB)
                    if (sizeMB > 10) {
                        invalidFiles.push(`${file.name} (terlalu besar: ${sizeMB.toFixed(2)}MB, maks 10MB)`);
                        continue;
                    }
                    
                    // Check file type
                    const allowed = [
                        'image/jpeg', 'image/jpg', 'image/png', 'image/gif',
                        'application/pdf',
                        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    
                    if (!allowed.includes(file.type)) {
                        invalidFiles.push(`${file.name} (tipe file tidak diizinkan)`);
                        continue;
                    }
                    
                    validFiles.push(file);
                }
                
                if (invalidFiles.length > 0) {
                    errorMessage.textContent = `File berikut tidak valid:\n${invalidFiles.join('\n')}`;
                    uploadError.classList.add('show');
                    return;
                }
                
                if (validFiles.length === 0) {
                    return;
                }
                
                totalFiles = validFiles.length;
                
                // Update file counter
                fileCounterNumber += totalFiles;
                fileCounter.textContent = `You've chosen ${fileCounterNumber} file${fileCounterNumber !== 1 ? 's' : ''}.`;
                
                // Show preview
                uploadedFilesPreview.classList.add('show');
                
                // Process each valid file
                for (let i = 0; i < totalFiles; i++) {
                    const file = validFiles[i];
                    
                    // Create preview item
                    const fileItem = document.createElement('div');
                    fileItem.className = 'uploaded-file-item';
                    fileItem.id = `file-${i}`;
                    
                    const fileName = file.name.length > 30 ? file.name.substring(0, 27) + '...' : file.name;
                    const fileSize = (file.size / 1048576).toFixed(2) + ' MB';
                    
                    fileItem.innerHTML = `
                        <div style="flex-shrink: 0;">
                            <i class="fas fa-file" style="color: #6c757d;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div class="uploaded-file-name">${fileName}</div>
                            <div class="uploaded-file-size">${fileSize}</div>
                        </div>
                        <div class="uploaded-file-status status-uploading">
                            <i class="fas fa-spinner fa-spin"></i> Menunggu
                        </div>
                    `;
                    
                    filesList.appendChild(fileItem);
                    
                    // Simulate upload with progress
                    simulateUpload(file, i);
                }
                
                // Show loading bar
                loadingBarContainer.style.display = 'block';
                loadingBar.style.width = '0%';
                loadingText.textContent = '0%';
            }
            
            // Simulate file upload with progress
            function simulateUpload(file, index) {
                const fileItem = document.getElementById(`file-${index}`);
                const statusDiv = fileItem.querySelector('.uploaded-file-status');
                
                // Show uploading status
                statusDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
                statusDiv.className = 'uploaded-file-status status-uploading';
                
                // Simulate progress (in real app, this would be actual upload progress)
                let progress = 0;
                const interval = setInterval(() => {
                    progress += Math.random() * 20;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(interval);
                        
                        // Update status to success
                        statusDiv.innerHTML = '<i class="fas fa-check"></i> Selesai';
                        statusDiv.className = 'uploaded-file-status status-success';
                        
                        // Add file to uploaded files array
                        uploadedFiles.push(file);
                        uploadedCount++;
                        
                        // Update overall progress
                        const overallProgress = Math.round((uploadedCount / totalFiles) * 100);
                        loadingBar.style.width = `${overallProgress}%`;
                        loadingText.textContent = `${overallProgress}%`;
                        
                        // If all files uploaded
                        if (uploadedCount === totalFiles) {
                            setTimeout(() => {
                                loadingBarContainer.style.display = 'none';
                                uploadSuccess.classList.add('show');
                                
                                // Add files to form as actual file inputs
                                addFilesToForm();
                                
                                // Hide preview after 3 seconds
                                setTimeout(() => {
                                    uploadedFilesPreview.classList.remove('show');
                                }, 3000);
                            }, 500);
                        }
                    } else {
                        loadingBar.style.width = `${progress}%`;
                        loadingText.textContent = `${Math.round(progress)}%`;
                    }
                }, 200);
            }
            
              // Add files to form as actual file inputs
function addFilesToForm() {
    // Clear existing new file inputs
    newFilesContainer.innerHTML = '';
    newFilesContainer.classList.remove('show');
    hiddenFilesContainer.innerHTML = '';
    
    // Create a new input for each uploaded file
    uploadedFiles.forEach((file, index) => {
        // Create wrapper for display
        const wrapper = document.createElement('div');
        wrapper.className = 'new-file-input-wrapper new-file-item'; // Tambahkan class new-file-item
        wrapper.id = `file-wrapper-${index}`;
        
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.value = file.name;
        input.readOnly = true;
        input.style.borderLeft = '4px solid #4caf50'; // Tambahkan border kiri hijau
        
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn-remove-new-file';
        removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
        removeBtn.title = 'Hapus file';
        
        // Create hidden file input for form submission
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'new_eviden[]';
        fileInput.style.display = 'none';
        fileInput.id = `hidden-file-${index}`;
        
        // Store the file in a data attribute
        fileInput.dataset.fileName = file.name;
        fileInput.dataset.fileSize = file.size;
        fileInput.dataset.fileType = file.type;
        
        // Add event listener to remove button
        removeBtn.addEventListener('click', function() {
            // Remove from displayed list
            wrapper.remove();
            
            // Remove from hidden inputs
            const hiddenInput = document.getElementById(`hidden-file-${index}`);
            if (hiddenInput) hiddenInput.remove();
            
            // Update counter
            fileCounterNumber--;
            fileCounter.textContent = `Anda memilih ${fileCounterNumber} file${fileCounterNumber !== 1 ? 's' : ''}.`;
            
            // Remove from uploadedFiles array
            uploadedFiles = uploadedFiles.filter(f => f !== file);
            
            // If no more files, hide the container
            if (newFilesContainer.children.length === 0) {
                newFilesContainer.classList.remove('show');
            }
        });
        
        wrapper.appendChild(input);
        wrapper.appendChild(removeBtn);
        newFilesContainer.appendChild(wrapper);
        hiddenFilesContainer.appendChild(fileInput);
    });
    
    // Show the container
    if (uploadedFiles.length > 0) {
        newFilesContainer.classList.add('show');
        
        // Tambahkan pesan bahwa file baru akan ditambahkan
        const infoMessage = document.createElement('div');
        infoMessage.className = 'info-alert';
        infoMessage.style.marginTop = '10px';
        infoMessage.style.background = '#e8f5e9';
        infoMessage.style.borderColor = '#4caf50';
         infoMessage.innerHTML = `
            <i class="fas fa-info-circle" style="color: #4caf50;"></i>
            <span><strong>${uploadedFiles.length} file baru akan ditambahkan setelah disimpan.</strong> File baru ditandai dengan warna hijau.</span>
        `;
    }
    
    console.log('Files ready for upload:', uploadedFiles);
    setTimeout(() => {
        if (window.updateFormButtonState) {
            window.updateFormButtonState();
        }
    }, 500);
}
            
            // Show files link
            showFilesLink.addEventListener('click', function(e) {
                e.preventDefault();
                if (uploadedFiles.length > 0) {
                    alert(`${uploadedFiles.length} file(s) ready for upload:\n` + 
                          uploadedFiles.map(f => f.name).join('\n'));
                } else {
                    alert('Belum ada file yang dipilih untuk diupload.');
                }
            });
            
            // Form submission
            mainForm.addEventListener('submit', function(e) {
                // Update the file input with all files before submitting
                const dataTransfer = new DataTransfer();
                
                // Get files from regular file input
                for (let i = 0; i < fileInput.files.length; i++) {
                    dataTransfer.items.add(fileInput.files[i]);
                }
                
                // Add dragged files
                uploadedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });
                
                // Update the file input
                fileInput.files = dataTransfer.files;
                
                // Update counter
                fileCounter.textContent = `You've chosen ${dataTransfer.files.length} file${dataTransfer.files.length !== 1 ? 's' : ''}.`;
                
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
                submitBtn.disabled = true;
            });
        });

        // ===== AUTOCOMPLETE FUNCTIONALITY =====
        const BASE_URL = '<?= rtrim(base_url(), "/") ?>';
        let currentAutocompleteBox = null;
        let currentKeydownHandler = null;
        let currentClickHandler = null;
        let currentInputElement = null;

        // Debounce function
        function debounce(fn, delay = 300) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        // Highlight matching text
        function highlightMatch(text, query) {
            if (!query || !text) return text;
            const escapedQuery = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const regex = new RegExp(`(${escapedQuery})`, 'gi');
            return text.replace(regex, '<span class="query-match">$1</span>');
        }

        // Remove existing autocomplete box
        function removeAutocompleteBox() {
            if (currentAutocompleteBox) {
                currentAutocompleteBox.remove();
                currentAutocompleteBox = null;
            }
            if (currentKeydownHandler) {
                document.removeEventListener('keydown', currentKeydownHandler);
                currentKeydownHandler = null;
            }
            if (currentClickHandler) {
                document.removeEventListener('click', currentClickHandler);
                currentClickHandler = null;
            }
            currentInputElement = null;
        }

        // Fetch suggestions from database
        async function fetchSuggestions(query, fieldType = 'nip') {
            if (!query) return [];

            try {
                const response = await fetch(`${BASE_URL}/sekretariat/autocomplete_nip?q=${encodeURIComponent(query)}&field=${fieldType}`);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                return Array.isArray(data) ? data : [];
            } catch (error) {
                console.error('Autocomplete error:', error);
                return [];
            }
        }

        // Show suggestion box
        function showSuggestionBox(inputEl, items, onSelect, fieldType) {
            removeAutocompleteBox();

            const rect = inputEl.getBoundingClientRect();
            const box = document.createElement('div');
            box.className = 'autocomplete-box-fixed';
            box.style.left = rect.left + 'px';
            box.style.top = (rect.bottom + 4) + 'px';
            box.style.width = Math.max(rect.width, 300) + 'px';

            if (!items || !items.length) {
                const empty = document.createElement('div');
                empty.className = 'autocomplete-empty';
                empty.textContent = 'Tidak ada data ditemukan';
                box.appendChild(empty);
                document.body.appendChild(box);
                currentAutocompleteBox = box;
                currentInputElement = inputEl;
                setTimeout(() => removeAutocompleteBox(), 2000);
                return;
            }

            const query = inputEl.value.trim();
            let selectedIndex = -1;

            items.forEach((item, idx) => {
                const option = document.createElement('div');
                option.className = `autocomplete-item type-${fieldType}`;

                let primaryText, secondaryText;

                switch (fieldType) {
                    case 'nip':
                        primaryText = highlightMatch(item.nip, query);
                        secondaryText = item.nama_dosen;
                        break;
                    case 'nama_dosen':
                        primaryText = highlightMatch(item.nama_dosen, query);
                        secondaryText = `NIP: ${item.nip}`;
                        break;
                    case 'jabatan':
                        primaryText = highlightMatch(item.jabatan, query);
                        secondaryText = `${item.nama_dosen} (${item.nip})`;
                        break;
                    case 'divisi':
                        primaryText = highlightMatch(item.divisi, query);
                        secondaryText = `${item.nama_dosen} (${item.nip})`;
                        break;
                    default:
                        primaryText = highlightMatch(item.nip, query);
                        secondaryText = item.nama_dosen;
                }

                option.innerHTML = `
                    <div class="autocomplete-icon">
                        <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                    <div class="autocomplete-content">
                        <div class="item-primary">${primaryText || '-'}</div>
                        ${secondaryText ? '<div class="item-secondary">' + secondaryText + '</div>' : ''}
                    </div>
                `;

                option.addEventListener('click', (e) => {
                    e.stopPropagation();
                    onSelect(item);
                    removeAutocompleteBox();
                });

                box.appendChild(option);
            });

            document.body.appendChild(box);
            currentAutocompleteBox = box;
            currentInputElement = inputEl;

            // Keyboard navigation
            currentKeydownHandler = function(e) {
                if (!currentAutocompleteBox) return;

                const opts = currentAutocompleteBox.querySelectorAll('.autocomplete-item');
                if (!opts.length) return;

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    selectedIndex = Math.min(selectedIndex + 1, opts.length - 1);
                    opts.forEach((o, i) => o.classList.toggle('active', i === selectedIndex));
                    if (opts[selectedIndex]) {
                        opts[selectedIndex].scrollIntoView({
                            block: 'nearest'
                        });
                    }
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    selectedIndex = Math.max(selectedIndex - 1, 0);
                    opts.forEach((o, i) => o.classList.toggle('active', i === selectedIndex));
                    if (opts[selectedIndex]) {
                        opts[selectedIndex].scrollIntoView({
                            block: 'nearest'
                        });
                    }
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    if (selectedIndex >= 0 && opts[selectedIndex]) {
                        opts[selectedIndex].click();
                    }
                } else if (e.key === 'Escape') {
                    removeAutocompleteBox();
                }
            };

            document.addEventListener('keydown', currentKeydownHandler);

            // Close on outside click
            currentClickHandler = function(ev) {
                if (currentAutocompleteBox && !currentAutocompleteBox.contains(ev.target) && ev.target !== currentInputElement) {
                    removeAutocompleteBox();
                }
            };
            document.addEventListener('click', currentClickHandler);
        }

        // Initialize autocomplete for a row
        function initAutocompleteForRow(rowEl) {
            const inputNip = rowEl.querySelector('.nip-input');
            const inputNama = rowEl.querySelector('.nama-dosen-input');
            const inputJabatan = rowEl.querySelector('.jabatan-input');
            const inputDivisi = rowEl.querySelector('.divisi-input');

            if (!inputNip || !inputNama || !inputJabatan || !inputDivisi) {
                return;
            }

            // Fill all fields when item is selected
            function fillRowWith(item) {
                if (!item) return;

                inputNip.value = item.nip || '';
                inputNama.value = item.nama_dosen || '';
                inputJabatan.value = item.jabatan || '';
                inputDivisi.value = item.divisi || '';
            }

            // Create autocomplete handlers for each field
            function createAutocompleteHandler(fieldType, inputElement) {
                const handler = debounce(async function() {
                    const val = this.value.trim();

                    if (val.length < 2 || document.activeElement !== this) {
                        removeAutocompleteBox();
                        return;
                    }

                    const suggestions = await fetchSuggestions(val, fieldType);
                    showSuggestionBox(inputElement, suggestions, fillRowWith, fieldType);
                }, 300);

                // Remove old event listener if exists
                if (inputElement._currentHandler) {
                    inputElement.removeEventListener('input', inputElement._currentHandler);
                }

                // Save reference to new handler
                inputElement._currentHandler = handler;
                // Attach new event listener
                inputElement.addEventListener('input', handler);

                // Focus handlers
                inputElement.addEventListener('focus', () => {
                    removeAutocompleteBox();
                });

                inputElement.addEventListener('blur', () => {
                    setTimeout(() => {
                        if (document.activeElement !== inputElement &&
                            (!currentAutocompleteBox || !currentAutocompleteBox.contains(document.activeElement))) {
                            removeAutocompleteBox();
                        }
                    }, 150);
                });
            }

            // Initialize autocomplete for all fields
            createAutocompleteHandler('nip', inputNip);
            createAutocompleteHandler('nama_dosen', inputNama);
            createAutocompleteHandler('jabatan', inputJabatan);
            createAutocompleteHandler('divisi', inputDivisi);
        }

        // ===== DOSEN FUNCTIONS =====
        function addDosenRow() {
            const tbody = document.getElementById('dosenTableBody');
            const index = tbody.querySelectorAll('tr.dosen-row').length;
            
            const emptyRow = tbody.querySelector('tr td[colspan="6"]');
            if (emptyRow) {
                emptyRow.closest('tr').remove();
            }
            
            const newRow = document.createElement('tr');
            newRow.className = 'dosen-row';
            newRow.dataset.index = index;
            newRow.innerHTML = `
                <td>
                    <input type="text" 
                           name="nip[]" 
                           class="form-control form-control-sm nip-input" 
                           data-index="${index}"
                           placeholder="Ketik NIP"
                           required
                           style="border: 2px solid #16A085; background: #e8f6f3;">
                </td>
                <td>
                    <input type="text" 
                           name="nama_dosen[]" 
                           class="form-control form-control-sm nama-dosen-input" 
                           placeholder="Ketik Nama Dosen"
                           style="border: 2px solid #16A085; background: #e8f6f3;">
                </td>
                <td>
                    <input type="text" 
                           name="jabatan[]" 
                           class="form-control form-control-sm jabatan-input" 
                           placeholder="Contoh: Lektor"
                           style="border: 2px solid #16A085; background: #e8f6f3;">
                </td>
                <td>
                    <input type="text" 
                           name="divisi[]" 
                           class="form-control form-control-sm divisi-input" 
                           placeholder="Contoh: DI"
                           style="border: 2px solid #16A085; background: #e8f6f3;">
                </td>
                <td>
                    <input type="text" 
                           name="peran[]" 
                           class="form-control form-control-sm peran-input" 
                           placeholder="Contoh: Ketua Tim"
                           style="border: 2px solid #16A085; background: #e8f6f3;">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btn-remove-dosen" onclick="removeDosen(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            
            tbody.appendChild(newRow);
            
            // Initialize autocomplete for the new row
            setTimeout(() => {
                initAutocompleteForRow(newRow);
                
                // Animation
                newRow.style.opacity = '0';
                newRow.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    newRow.style.transition = 'all 0.3s ease';
                    newRow.style.opacity = '1';
                    newRow.style.transform = 'translateY(0)';
                }, 10);
            }, 10);
            setTimeout(() => {
        if (window.updateFormButtonState) {
            window.updateFormButtonState();
        }
    }, 500);
        }

        function removeDosen(button) {
            const row = button.closest('tr');
            const tbody = document.getElementById('dosenTableBody');
            
            row.style.opacity = '0';
            row.style.transform = 'translateX(20px)';
            
            setTimeout(() => {
                row.remove();
                
                if (tbody.querySelectorAll('tr.dosen-row').length === 0) {
                    const emptyRow = document.createElement('tr');
                    emptyRow.innerHTML = '<td colspan="6" class="text-center text-muted">Belum ada dosen terkait</td>';
                    tbody.appendChild(emptyRow);
                }
            }, 300);
            setTimeout(() => {
        if (window.updateFormButtonState) {
            window.updateFormButtonState();
        }
    }, 500);
        }

        // ===== EXISTING FUNCTIONS =====
        function deleteExistingFile(index, filename) {
            if (!confirm('Yakin ingin menghapus file "' + filename + '"?')) return;
            const fileItem = document.querySelector(`.existing-file-item[data-file-index="${index}"]`);
            if (!fileItem) return;
            const deleteFlag = fileItem.querySelector('.delete-flag');
            const existingInput = fileItem.querySelector('.existing-file-input');
            if (deleteFlag) deleteFlag.value = filename;
            if (existingInput) existingInput.remove();
            fileItem.classList.add('file-deleted');
            fileItem.style.opacity = '0';
            fileItem.style.transform = 'translateX(-20px)';
            setTimeout(() => fileItem.style.display = 'none', 300);
            setTimeout(() => {
            if (window.updateFormButtonState) {
                window.updateFormButtonState();
            }
        }, 500);
        }

        // Preview File Functions
        function previewFile(fileUrl, fileName) {
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
                        previewBody.innerHTML = `<img src="${fileUrl}" class="preview-image" alt="${fileName}">`;
                    };
                    img.onerror = function() {
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
                    <a href="${fileUrl}" class="btn btn-primary" download="${fileName}" target="_blank" style="margin-top: 15px;">
                        <i class="fas fa-download"></i> Download File
                    </a>
                </div>
            `;
        }

        function closePreviewModal() {
            document.getElementById('previewModal').classList.remove('show');
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

        // ===== FLATPICKR INITIALIZATION =====
        let selectedStartDate = null;
        const MAX_DAYS_LIMIT = 60;

        function getMinAllowedDate() {
            const today = new Date();
            const minDate = new Date(today);
            minDate.setDate(today.getDate() - 30);
            return minDate;
        }

        function formatDateIndonesian(date) {
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                           'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const dayName = days[date.getDay()];
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            
            return `${dayName}, ${day} ${month} ${year}`;
        }

        function formatDateLocal(date) {
            const y = date.getFullYear();
            const m = (date.getMonth() + 1).toString().padStart(2, "0");
            const d = date.getDate().toString().padStart(2, "0");
            return `${y}-${m}-${d}`;
        }

        function calculateDayDifference(startDate, endDate) {
            const oneDay = 24 * 60 * 60 * 1000;
            const diffDays = Math.round(Math.abs((endDate - startDate) / oneDay));
            return diffDays;
        }

        // Set initial dates jika ada
        const tanggalAwal = document.getElementById('tanggal_awal_kegiatan').value;
        const tanggalAkhir = document.getElementById('tanggal_akhir_kegiatan').value;
        let initialDate = [];

        if (tanggalAwal && tanggalAkhir) {
            initialDate = [tanggalAwal, tanggalAkhir];
            
            document.getElementById('datepicker').value = `${tanggalAwal} s/d ${tanggalAkhir}`;
            
            const konfirmasiDiv = document.getElementById("konfirmasi_tanggal");
            const dayCounter = document.getElementById("day_counter");
            const rangeInfo = document.getElementById("range_info");
            
            const awal = new Date(tanggalAwal);
            const akhir = new Date(tanggalAkhir);
            const dayDifference = calculateDayDifference(awal, akhir);
            
            dayCounter.textContent = `${dayDifference} hari`;
            document.getElementById("konfirmasi_awal").innerHTML = `<strong>Awal:</strong> ${formatDateIndonesian(awal)}`;
            document.getElementById("konfirmasi_akhir").innerHTML = `<strong>Akhir:</strong> ${formatDateIndonesian(akhir)}`;
            konfirmasiDiv.style.display = 'block';
            rangeInfo.style.display = 'none';
            
            document.getElementById("datepicker3").value = tanggalAwal;
            document.getElementById("datepicker4").value = tanggalAkhir;
            document.getElementById("info_periode").innerHTML = "Terisi otomatis ✓";
            document.getElementById("info_akhir").innerHTML = "Terisi otomatis ✓";
            
            document.getElementById("datepicker3").classList.add("auto-filled");
            document.getElementById("datepicker4").classList.add("auto-filled");
        }

        // Inisialisasi flatpickr
        const minAllowedDate = getMinAllowedDate();

        const datepicker = flatpickr("#datepicker", {
            mode: "range",
            dateFormat: "Y-m-d",
            allowInput: false,
            minDate: minAllowedDate,
            locale: {
                firstDayOfWeek: 1
            },
            defaultDate: initialDate,
            onChange: function(selectedDates, dateStr, instance) {
                const konfirmasiDiv = document.getElementById("konfirmasi_tanggal");
                const dayCounter = document.getElementById("day_counter");
                const rangeInfo = document.getElementById("range_info");
                const dayLimitInfo = document.getElementById("day_limit_info");
                
                if (selectedDates.length === 1) {
                    dayLimitInfo.style.display = 'block';
                    selectedStartDate = selectedDates[0];
                } else {
                    dayLimitInfo.style.display = 'none';
                    selectedStartDate = null;
                }
                
                if (selectedDates.length === 2) {
                    const awal = selectedDates[0];
                    const akhir = selectedDates[1];
                    const dayDifference = calculateDayDifference(awal, akhir);
                    
                    selectedStartDate = awal;
                    
                    const awalFormatted = formatDateLocal(awal);
                    const akhirFormatted = formatDateLocal(akhir);
                    
                    const awalDisplay = formatDateIndonesian(awal);
                    const akhirDisplay = formatDateIndonesian(akhir);
                    
                    document.getElementById("tanggal_awal_kegiatan").value = awalFormatted;
                    document.getElementById("tanggal_akhir_kegiatan").value = akhirFormatted;
                    
                    document.getElementById("datepicker3").value = awalFormatted;
                    document.getElementById("datepicker4").value = akhirFormatted;
                    
                    dayCounter.textContent = `${dayDifference} hari`;
                    
                    document.getElementById("konfirmasi_awal").innerHTML = `<strong>Awal:</strong> ${awalDisplay}`;
                    document.getElementById("konfirmasi_akhir").innerHTML = `<strong>Akhir:</strong> ${akhirDisplay}`;
                    konfirmasiDiv.style.display = 'block';
                    rangeInfo.style.display = 'none';
                    dayLimitInfo.style.display = 'none';
                    
                    document.getElementById("info_periode").innerHTML = "Terisi otomatis ✓";
                    document.getElementById("info_akhir").innerHTML = "Terisi otomatis ✓";
                    
                    document.getElementById("datepicker3").classList.add("auto-filled", "highlight-animation");
                    document.getElementById("datepicker4").classList.add("auto-filled", "highlight-animation");
                    
                    setTimeout(() => {
                        document.getElementById("datepicker3").classList.remove("highlight-animation");
                        document.getElementById("datepicker4").classList.remove("highlight-animation");
                    }, 1000);
                    
                } else if (selectedDates.length === 1) {
                    const awalDisplay = formatDateIndonesian(selectedDates[0]);
                    
                    selectedStartDate = selectedDates[0];
                    document.getElementById("konfirmasi_awal").innerHTML = `<strong>Tanggal awal:</strong> ${awalDisplay}`;
                    document.getElementById("konfirmasi_akhir").innerHTML = `<strong>Tanggal akhir:</strong> Pilih tanggal akhir (maks ${MAX_DAYS_LIMIT} hari)`;
                    konfirmasiDiv.style.display = 'block';
                    dayCounter.textContent = '';
                    rangeInfo.style.display = 'none';
                    dayLimitInfo.style.display = 'block';
                    
                    instance.redraw();
                } else {
                    selectedStartDate = null;
                    konfirmasiDiv.style.display = 'none';
                    dayCounter.textContent = '';
                    rangeInfo.style.display = 'block';
                    dayLimitInfo.style.display = 'none';
                    
                    document.getElementById("datepicker3").value = "";
                    document.getElementById("datepicker4").value = "";
                    document.getElementById("info_periode").innerHTML = "Akan terisi otomatis";
                    document.getElementById("info_akhir").innerHTML = "Akan terisi otomatis";
                    
                    document.getElementById("datepicker3").classList.remove("auto-filled");
                    document.getElementById("datepicker4").classList.remove("auto-filled");
                    
                    instance.redraw();
                }
            }
        });

        flatpickr("#datepicker3", {
            dateFormat: "Y-m-d",
            allowInput: false
        });

        flatpickr("#datepicker4", {
            dateFormat: "Y-m-d",
            allowInput: false
        });

        document.getElementById("jenis_date").addEventListener("change", function () {
            const customSection = document.getElementById("custom_date");
            const periodeSection = document.getElementById("periode_date");
            
            const isCustom = this.value === "Custom";
            const isPeriode = this.value === "Periode";
            
            customSection.classList.toggle('active', isCustom);
            periodeSection.classList.toggle('active', isPeriode);
            customSection.style.display = isCustom ? 'block' : 'none';
            periodeSection.style.display = isPeriode ? 'block' : 'none';
            
            if (isCustom) {
                const rangeInfo = document.getElementById("range_info");
                if (rangeInfo) {
                    const minDate = getMinAllowedDate();
                    rangeInfo.innerHTML = `Klik tanggal awal, lalu klik tanggal akhir (opsional)<br>
                                          <small style="color: #666;">• Tidak bisa memilih tanggal sebelum ${formatDateIndonesian(minDate)}</small><br>
                                          <small style="color: #666;">• Maksimal ${MAX_DAYS_LIMIT} hari dari tanggal awal</small>`;
                }
            }
        });

        // ===== INITIALIZE ON DOM READY =====
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize autocomplete for existing rows
            document.querySelectorAll('.dosen-row').forEach(row => {
                initAutocompleteForRow(row);
            });

            // Toggle sections based on selections
            document.getElementById('jenis_pengajuan').addEventListener('change', function() {
                document.getElementById('perorangan_box').style.display = this.value === 'Perorangan' ? 'block' : 'none';
                document.getElementById('kelompok_box').style.display = this.value === 'Kelompok' ? 'block' : 'none';
            });

            if (document.getElementById('jenis_penugasan_perorangan')) {
                document.getElementById('jenis_penugasan_perorangan').addEventListener('change', function() {
                    document.getElementById('lainnya_perorangan_box').style.display = this.value === 'Lainnya' ? 'block' : 'none';
                });
            }

            if (document.getElementById('jenis_penugasan_kelompok')) {
                document.getElementById('jenis_penugasan_kelompok').addEventListener('change', function() {
                    document.getElementById('lainnya_kelompok_box').style.display = this.value === 'Lainnya' ? 'block' : 'none';
                });
            }

            // Preview file handlers
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-view-file')) {
                    const btn = e.target.closest('.btn-view-file');
                    const src = btn.dataset.src || '';
                    const fileName = btn.closest('.existing-file-item').querySelector('.file-name').textContent.trim() || 'file';

                    if (!src) {
                        alert('File tidak ditemukan');
                        return;
                    }

                    let finalSrc = src;
                    if (!/^https?:\/\//i.test(src)) {
                        finalSrc = BASE_URL + '/' + src.replace(/^\/+/, '');
                    }

                    previewFile(finalSrc, fileName);
                }
            });

            // Close autocomplete when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.autocomplete-box-fixed') &&
                    !e.target.closest('.nip-input') &&
                    !e.target.closest('.nama-dosen-input') &&
                    !e.target.closest('.jabatan-input') &&
                    !e.target.closest('.divisi-input')) {
                    removeAutocompleteBox();
                }
            });

            // Close autocomplete on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    removeAutocompleteBox();
                }
            });
        });
    </script>
    <script>
// ===== CHANGE DETECTION - PREVENT SAVE IF NO CHANGES =====
(function() {
    const initialData = <?= $initial_data ?? '{}' ?>;
    const submitBtn = document.getElementById('submitBtn');
    const mainForm = document.getElementById('mainForm');
    let hasChanges = false;
    
    // Normalize value untuk comparison
    function normalizeValue(val) {
        if (val === null || val === undefined || val === '') return '-';
        if (typeof val === 'string') return val.trim();
        return val;
    }
    
    // Check if arrays are equal
    function arraysEqual(arr1, arr2) {
        if (!Array.isArray(arr1) || !Array.isArray(arr2)) return false;
        if (arr1.length !== arr2.length) return false;
        
        for (let i = 0; i < arr1.length; i++) {
            if (typeof arr1[i] === 'object' && typeof arr2[i] === 'object') {
                if (JSON.stringify(arr1[i]) !== JSON.stringify(arr2[i])) return false;
            } else {
                if (normalizeValue(arr1[i]) !== normalizeValue(arr2[i])) return false;
            }
        }
        return true;
    }
    
    // Get current form data
    function getCurrentFormData() {
        const formData = new FormData(mainForm);
        const currentData = {
            nama_kegiatan: normalizeValue(formData.get('nama_kegiatan')),
            jenis_date: normalizeValue(formData.get('jenis_date')),
            tanggal_kegiatan: normalizeValue(formData.get('tanggal_kegiatan')),
            akhir_kegiatan: normalizeValue(formData.get('akhir_kegiatan')),
            tempat_kegiatan: normalizeValue(formData.get('tempat_kegiatan')),
            penyelenggara: normalizeValue(formData.get('penyelenggara')),
            jenis_pengajuan: normalizeValue(formData.get('jenis_pengajuan')),
            lingkup_penugasan: normalizeValue(formData.get('lingkup_penugasan')),
            jenis_penugasan_perorangan: normalizeValue(formData.get('jenis_penugasan_perorangan')),
            penugasan_lainnya_perorangan: normalizeValue(formData.get('penugasan_lainnya_perorangan')),
            jenis_penugasan_kelompok: normalizeValue(formData.get('jenis_penugasan_kelompok')),
            penugasan_lainnya_kelompok: normalizeValue(formData.get('penugasan_lainnya_kelompok')),
            periode_value: normalizeValue(formData.get('periode_value')),
            nip: formData.getAll('nip[]').filter(v => v).map(v => normalizeValue(v)),
            peran: formData.getAll('peran[]').filter(v => v).map(v => normalizeValue(v))
        };
        
        // Get eviden data
        const existingEviden = [];
        document.querySelectorAll('.existing-file-input').forEach(input => {
            if (input.value && !input.closest('.file-deleted')) {
                existingEviden.push(normalizeValue(input.value));
            }
        });
        
        const deletedEviden = [];
        document.querySelectorAll('.delete-flag').forEach(input => {
            if (input.value) {
                deletedEviden.push(normalizeValue(input.value));
            }
        });
        
        // Check if there are new files
        const hasNewFiles = document.querySelectorAll('.new-file-item').length > 0;
        
        currentData.eviden = existingEviden;
        currentData.hasDeletedFiles = deletedEviden.length > 0;
        currentData.hasNewFiles = hasNewFiles;
        
        return currentData;
    }
    
    // Check for changes
    function checkForChanges() {
        const current = getCurrentFormData();
        let changes = [];
        
        // Check basic fields
        const basicFields = [
            'nama_kegiatan', 'jenis_date', 'tanggal_kegiatan', 'akhir_kegiatan',
            'tempat_kegiatan', 'penyelenggara', 'jenis_pengajuan', 'lingkup_penugasan',
            'jenis_penugasan_perorangan', 'penugasan_lainnya_perorangan',
            'jenis_penugasan_kelompok', 'penugasan_lainnya_kelompok', 'periode_value'
        ];
        
        basicFields.forEach(field => {
            const initialVal = normalizeValue(initialData[field]);
            const currentVal = normalizeValue(current[field]);
            if (initialVal !== currentVal) {
                changes.push(field);
            }
        });
        
        // Check NIP array
        if (!arraysEqual(initialData.nip || [], current.nip || [])) {
            changes.push('nip');
        }
        
        // Check Peran array
        const initialPeran = (initialData.peran || []).map(p => {
            if (typeof p === 'string') {
                try {
                    const parsed = JSON.parse(p);
                    return normalizeValue(parsed.peran || '-');
                } catch {
                    return normalizeValue(p);
                }
            }
            return normalizeValue(p.peran || '-');
        });
        
        const currentPeran = current.peran || [];
        
        if (!arraysEqual(initialPeran, currentPeran)) {
            changes.push('peran');
        }
        
        // Check eviden
        const initialEviden = (initialData.eviden || []).map(e => normalizeValue(e)).sort();
        const currentEviden = (current.eviden || []).map(e => normalizeValue(e)).sort();
        
        if (!arraysEqual(initialEviden, currentEviden)) {
            changes.push('eviden');
        }
        
        // Check deleted files
        if (current.hasDeletedFiles) {
            changes.push('deleted_files');
        }
        
        // Check new files
        if (current.hasNewFiles) {
            changes.push('new_files');
        }
        
        hasChanges = changes.length > 0;
        
        console.log('Changes detected:', changes);
        console.log('Has changes:', hasChanges);
        
        return hasChanges;
    }
    
    // Update button state
    function updateButtonState() {
        const hasChanges = checkForChanges();
        
        if (hasChanges) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Simpan Perubahan';
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
            submitBtn.classList.remove('btn-disabled');
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-ban"></i> Tidak Ada Perubahan';
            submitBtn.style.opacity = '0.5';
            submitBtn.style.cursor = 'not-allowed';
            submitBtn.classList.add('btn-disabled');
        }
    }
    
    // Add event listeners to all form inputs
    function attachChangeListeners() {
        // Text inputs, selects, textareas
        mainForm.querySelectorAll('input, select, textarea').forEach(element => {
            element.addEventListener('input', updateButtonState);
            element.addEventListener('change', updateButtonState);
        });
        
        // File inputs
        document.getElementById('fileInput')?.addEventListener('change', updateButtonState);
        
        // Observer for dynamic elements (dosen rows, file items)
        const observer = new MutationObserver(function(mutations) {
            updateButtonState();
        });
        
        observer.observe(document.getElementById('dosenTableBody'), {
            childList: true,
            subtree: true
        });
        
        observer.observe(document.getElementById('existingFilesContainer'), {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class']
        });
        
        observer.observe(document.getElementById('newFilesContainer'), {
            childList: true,
            subtree: true
        });
    }
    
    // Prevent form submission if no changes
    mainForm.addEventListener('submit', function(e) {
        if (!checkForChanges()) {
            e.preventDefault();
            alert('⚠️ Tidak ada perubahan yang perlu disimpan!');
            return false;
        }
    });
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        attachChangeListeners();
        updateButtonState();
        
        // Check for changes every 2 seconds (fallback)
        setInterval(updateButtonState, 2000);
    });
    
    // Make functions globally accessible
    window.checkFormChanges = checkForChanges;
    window.updateFormButtonState = updateButtonState;
})();
</script>
</body>
</html>