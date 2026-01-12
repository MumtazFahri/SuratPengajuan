<!DOCTYPE html>
<html lang="en-id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PKC MEDCRAFT - List Surat Tugas</title>

    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* ===== NAVBAR & SIDEBAR STYLES ===== */
        body {
            background-color: #f6f9fb;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* HEADER/NAVBAR */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            z-index: 1030;
            height: 70px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            height: 100%;
        }

        .navbar-brand img {
            height: 40px;
        }

        .fik-navbar-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .fik-navbar-menu ul {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 10px;
        }

        .fik-navbar-menu .left img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .fik-username b {
            display: block;
            font-size: 14px;
            color: #333;
        }

        .fik-username span {
            font-size: 12px;
            color: #777;
        }

        .db-menu-trigger {
            display: none;
            width: 40px;
            height: 40px;
            cursor: pointer;
            color: #FB8C00;
            font-size: 24px;
            background: none;
            border: none;
            align-items: center;
            justify-content: center;
        }

        /* SIDEBAR MODERN STYLE */
        .fik-db-side-menu {
            position: fixed;
            left: 0;
            top: 70px;
            width: 260px;
            height: calc(100vh - 70px);
            background: linear-gradient(180deg, #FF8C00 0%, #FB8C00 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 1020;
            display: flex;
            flex-direction: column;
            transform: translateX(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fik-db-side-menu::-webkit-scrollbar {
            width: 5px;
        }

        .fik-db-side-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .fik-db-side-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .fik-db-side-menu .card.profil {
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.15);
            display: none;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .fik-db-side-menu .card.profil .img-wrapper {
            margin-bottom: 10px;
        }

        .fik-db-side-menu .card.profil .img-wrapper img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.5);
            object-fit: cover;
        }

        .fik-db-side-menu .card.profil b {
            display: block;
            color: white;
            font-size: 15px;
            margin-bottom: 3px;
        }

        .fik-db-side-menu .card.profil span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
        }

        .fik-db-side-menu .card {
            border: none;
            border-radius: 0;
            margin-bottom: 0;
            background: transparent;
        }

        .fik-db-side-menu .btn {
            width: 100%;
            text-align: left;
            padding: 16px 20px;
            border: none;
            background: transparent;
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid transparent;
            cursor: pointer;
            text-decoration: none;
        }

        .fik-db-side-menu .btn:hover,
        .fik-db-side-menu .btn:focus {
            background: rgba(255, 255, 255, 0.15);
            border-left-color: white;
            text-decoration: none;
            padding-left: 24px;
        }

        .fik-db-side-menu .btn.active {
            background: rgba(255, 255, 255, 0.2);
            border-left-color: white;
        }

        .fik-db-side-menu .btn i,
        .fik-db-side-menu .btn span.fas,
        .fik-db-side-menu .btn span.fa {
            width: 20px;
            text-align: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .menu-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .collapse-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .btn[aria-expanded="true"] .collapse-arrow {
            transform: rotate(180deg);
        }

        .fik-db-side-menu .collapse {
            background: rgba(0, 0, 0, 0.15);
        }

        .fik-db-side-menu .collapse ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .fik-db-side-menu .collapse ul li {
            padding: 0;
        }

        .fik-db-side-menu .collapse ul li a {
            display: flex;
            align-items: center;
            padding: 12px 20px 12px 52px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s;
            gap: 8px;
        }

        .fik-db-side-menu .collapse ul li a:before {
            content: '›';
            font-size: 18px;
            font-weight: bold;
        }

        .fik-db-side-menu .collapse ul li a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 56px;
        }

        .divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
            margin: 10px 20px;
        }

        .fik-db-side-menu .card.logout {
            margin-top: auto;
            padding-bottom: 20px;
        }

        .fik-db-side-menu .card.logout .btn {
            color: white;
            font-weight: 600;
        }

        .fik-db-side-menu .card.logout .btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Sidebar Overlay for Mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            width: 100%;
            height: calc(100vh - 70px);
            background: rgba(0, 0, 0, 0.5);
            z-index: 1010;
            cursor: pointer;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Body lock when sidebar is open */
        body.sidebar-open {
            overflow: hidden;
        }

        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 30px;
            transition: margin-left 0.3s ease, width 0.3s ease;
            min-height: 100vh;
            width: calc(100% - 260px);
            box-sizing: border-box;
        }

        /* ===== REVISI: Header Action Buttons ===== */
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0 10px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        /* REVISI: Action buttons group dengan layout baru */
        .action-buttons-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* REVISI: Tombol Tambah Surat - lebih mencolok */
        .btn-add-surat {
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 15px;
            background: linear-gradient(135deg, #FB8C00 0%, #FF9800 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(251, 140, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-add-surat:hover {
            background: linear-gradient(135deg, #e67e00 0%, #F57C00 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(251, 140, 0, 0.4);
            text-decoration: none;
        }

        .btn-add-surat:active {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(251, 140, 0, 0.3);
        }

        .btn-add-surat i {
            font-size: 16px;
        }

        /* REVISI: Tombol Kembali di pojok kanan */
        .btn-back {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
            background: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        /* ===== TABLE FILTER STYLES ===== */
        .filter-bar {
            width: 100%;
            background: #ffffff;
            padding: 12px 14px;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 14px;
            border: 1px solid #f0f0f0;
            flex-wrap: wrap;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            order: 1;
        }

        .filter-search {
            flex: 1 1 360px;
            min-width: 220px;
            display: flex;
            position: relative;
            order: 2;
            margin-left: auto;
        }

        .filter-search input {
            width: 100%;
            padding: 10px 40px 10px 14px;
            height: 44px;
            border-radius: 10px;
            border: 1.5px solid #FB8C00;
            outline: none;
            font-size: 14px;
        }

        .filter-search i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #FB8C00;
            pointer-events: none;
        }

        .btn-small {
            height: 44px;
            min-width: 44px;
            border-radius: 10px;
            border: 1.5px solid #FB8C00;
            padding: 0 12px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
        }

        .btn-small-add {
            background: #FB8C00;
            color: white;
        }

        .btn-reset {
            background: #FB8C00;
            color: white;
            border: 1.5px solid #FB8C00;
            border-radius: 10px;
            padding: 0 14px;
            height: 44px;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-reset[hidden] {
            display: none;
        }

        .filter-builder {
            display: flex;
            gap: 10px;
            align-items: center;
            width: 100%;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .filter-row {
            width: 100%;
            background: #ffffff;
            padding: 12px 14px;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
            display: flex;
            gap: 12px;
            align-items: center;
            border: 1px solid #f0f0f0;
            flex-wrap: wrap;
        }

        .filter-row-actions {
            display: flex;
            gap: 8px;
            align-items: center;
            order: 1;
        }

        .filter-row-search {
            flex: 1 1 360px;
            min-width: 220px;
            display: flex;
            position: relative;
            order: 2;
            margin-left: auto;
        }

        .filter-row-search input {
            width: 100%;
            padding: 10px 40px 10px 14px;
            height: 44px;
            border-radius: 10px;
            border: 1.5px solid #FB8C00;
            outline: none;
            font-size: 14px;
            background: white;
        }

        .filter-row-search i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #FB8C00;
            pointer-events: none;
        }

        .filter-row select.row-cat {
            height: 44px;
            min-width: 44px;
            border-radius: 10px;
            border: 1.5px solid #FB8C00;
            padding: 0 14px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
            outline: none;
        }

        .filter-row input[type="date"] {
            height: 44px;
            padding: 0 14px;
            border-radius: 10px;
            border: 1.5px solid #FB8C00;
            background: white;
            font-size: 14px;
            min-width: 160px;
            outline: none;
        }

        .filter-row .row-btn {
            height: 44px;
            min-width: 44px;
            border-radius: 10px;
            border: 1.5px solid #FB8C00;
            padding: 0 14px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: white;
        }

        .filter-row .row-btn.add {
            background: #FB8C00;
            color: #fff;
        }

        .filter-row .row-btn.add:hover {
            background: #e67e00;
        }

        .filter-row .row-btn.remove {
            background: #FB8C00;
            color: white;
        }

        .filter-row .row-btn.remove:hover {
            background: #e67e00;
        }

        /* ===== REVISI: Multi-action buttons (disembunyikan) ===== */
        .multi-actions {
            display: none !important;
        }

        /* Table styles */
        #tabelSurat {
            width: 100% !important;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-family: 'Montserrat', sans-serif;
            table-layout: auto;
            max-width: 100%;
        }

        #tabelSurat_wrapper {
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: auto !important;
        }

        #tabelSurat thead {
            background: #FB8C00;
            color: white;
        }

        #tabelSurat td,
        #tabelSurat th {
            padding: 12px;
            border: 1px solid #eee;
            vertical-align: middle;
            text-align: center;
            overflow: hidden;
            white-space: normal;
            word-wrap: break-word;
        }

        /* ===== REVISI: Column widths (dengan perubahan kolom) ===== */
        #tabelSurat th:nth-child(1),
        #tabelSurat td:nth-child(1) {
            width: 4%;
            max-width: 50px;
        }

        #tabelSurat th:nth-child(2),
        #tabelSurat td:nth-child(2) {
            width: 5%;
            max-width: 60px;
        }

        #tabelSurat th:nth-child(3),
        #tabelSurat td:nth-child(3) {
            width: 25%;
            min-width: 200px;
            text-align: left;
        }

        #tabelSurat th:nth-child(4),
        #tabelSurat td:nth-child(4) {
            width: 12%;
            min-width: 120px;
        }

        #tabelSurat th:nth-child(5),
        #tabelSurat td:nth-child(5) {
            width: 20%;
            min-width: 180px;
        }

        /* REVISI: Kolom 6: Status (menggantikan Divisi) */
        #tabelSurat th:nth-child(6),
        #tabelSurat td:nth-child(6) {
            width: 15%;
            min-width: 150px;
        }

        /* REVISI: Kolom 7: Tanggal Kegiatan (menggantikan Tanggal Pengajuan) */
        #tabelSurat th:nth-child(7),
        #tabelSurat td:nth-child(7) {
            width: 12%;
            min-width: 120px;
        }

        #tabelSurat th:nth-child(8),
        #tabelSurat td:nth-child(8) {
            width: 12%;
            min-width: 150px;
        }

        #tabelSurat td:nth-child(3) {
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
            cursor: pointer;
            max-height: 60px;
            overflow-y: hidden;
        }

        #tabelSurat td:nth-child(3):hover {
            background-color: #fffaf5;
        }

        #tabelSurat tbody tr.row-detail {
            cursor: pointer;
            transition: background 0.2s;
        }

        #tabelSurat tbody tr.row-detail:hover {
            background: #fffaf5;
        }

        #tabelSurat tbody tr.row-detail.selected {
            background: #fff4e6;
        }

        .row-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #FB8C00;
        }

        #checkAll {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #FB8C00;
        }

        /* ===== REVISI: Styling khusus untuk kolom nama dosen ===== */
        .dosen-container {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            align-items: center;
            justify-content: center;
            max-width: 100%;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 8px;
            border-radius: 8px;
        }

        .dosen-container:hover {
            background-color: #fff4e6;
            transform: translateY(-1px);
        }

        .dosen-container.clickable {
            cursor: pointer;
            position: relative;
        }

        .dosen-container.clickable::after {
            content: '👁️';
            font-size: 10px;
            margin-left: 5px;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .dosen-container.clickable:hover::after {
            opacity: 1;
        }

        .nama-dosen-badge {
            display: inline-block;
            background: #fff4e6;
            color: #663c00;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            border: 1px solid #FB8C00;
            white-space: nowrap;
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: all 0.2s;
            cursor: pointer;
        }

        .dosen-container:hover .nama-dosen-badge {
            background: #FB8C00;
            color: white;
            box-shadow: 0 2px 5px rgba(251, 140, 0, 0.2);
        }
        /* Style untuk dosen tunggal (tanpa modal) */
        .dosen-container.single-dosen {
            cursor: default !important;
        }

        .dosen-container.single-dosen .nama-dosen-badge {
            cursor: default !important;
            background: #e9ecef !important;
            color: #495057 !important;
            border: 1px solid #dee2e6 !important;
        }

        .dosen-container.single-dosen .nama-dosen-badge:hover {
            background: #e9ecef !important;
            color: #495057 !important;
            transform: none !important;
            box-shadow: none !important;
        }

        .dosen-container.single-dosen::after {
            content: none !important;
        }

        /* Pointer cursor hanya untuk multiple dosen */
        .dosen-container.clickable {
            cursor: pointer !important;
        }

        .dosen-container.clickable .nama-dosen-badge {
            cursor: pointer !important;
        }
        .nama-dosen-more {
            display: inline-block;
            background: #FB8C00;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s;
        }

        .nama-dosen-more:hover {
            transform: scale(1.03);
            background: #e67e00;
            box-shadow: 0 3px 8px rgba(230, 126, 0, 0.3);
        }

        /* ===== REVISI: Modal Popup Detail Dosen - NEW STYLE ===== */
        .dosen-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.3);
        }

        .dosen-modal.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .dosen-modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .dosen-modal.show .dosen-modal-content {
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .dosen-modal-header {
            background: linear-gradient(135deg, #FB8C00 0%, #FF9800 100%);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dosen-modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dosen-modal-title i {
            font-size: 20px;
        }

        .dosen-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .dosen-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .dosen-modal-body {
            padding: 25px;
            overflow-y: auto;
            max-height: 60vh;
        }

        /* ===== NEW STYLE: Format seperti contoh image.png ===== */
        .dosen-section {
            margin-bottom: 25px;
        }

        .dosen-section-title {
            font-size: 18px;
            font-weight: 700;
            color: #FB8C00;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid #FB8C00;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dosen-section-title i {
            font-size: 20px;
        }

        .dosen-item {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 10px;
            background: #f8f9fa;
        }

        .dosen-info {
            display: flex;
            flex-direction: column;
        }

        .dosen-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .dosen-details div {
            font-size: 14px;
            margin-bottom: 3px;
            color: #444;
        }


        .dosen-detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #495057;
            line-height: 1.5;
        }

        .dosen-detail-item i {
            width: 20px;
            text-align: center;
            color: #FB8C00;
            font-size: 16px;
        }

        .dosen-detail-label {
            font-weight: 600;
            color: #495057;
            min-width: 60px;
        }

        .dosen-detail-value {
            color: #212529;
        }

        .no-dosen {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .no-dosen i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #adb5bd;
        }

        .no-dosen h4 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #495057;
        }

        .dosen-modal-footer {
            padding: 15px 25px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            text-align: center;
        }

        .dosen-total {
            font-size: 14px;
            color: #6c757d;
            font-weight: 600;
        }

        .dosen-total strong {
            color: #FB8C00;
            font-size: 16px;
        }

        .dosen-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 12px;
            background: #ffffff;
        }

        .dosen-avatar {
            width: 40px;
            height: 40px;
            background: #ff9800;
            color: white;
            font-weight: bold;
            font-size: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dosen-card-info {
            display: flex;
            flex-direction: column;
        }

        .dosen-card-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .dosen-card-detail {
            font-size: 13px;
            color: #5b5b5b;
        }

        /* Hapus icon mata otomatis dari elemen dosen */
        .dosen-container::after,
        .dosen-container::before,
        .nama-dosen-badge::after,
        .nama-dosen-badge::before,
        .nama-dosen-more::after,
        .nama-dosen-more::before {
            content: none !important;
            display: none !important;
        }


        /* ===== REVISI: Status Badge Styles ===== */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
            min-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-disetujui {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-ditolak {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-proses {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* ===== REVISI: Action buttons dengan layout baru ===== */
        .action-buttons-container {
            display: flex;
            gap: 6px;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .btn-icon-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            flex-shrink: 0;
            text-decoration: none;
        }

        .btn-icon-action:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-edit {
            background: #ffa726;
            color: white;
        }

        .btn-edit:hover {
            background: #fb8c00;
        }

        .btn-edit-disabled {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
            pointer-events: auto !important;
            background: #6c757d !important;
        }

        .btn-edit-disabled:hover {
            transform: none !important;
            box-shadow: none !important;
            background: #6c757d !important;
        }

        .btn-delete {
            background: #ef5350;
            color: white;
        }

        .btn-delete:hover {
            background: #e53935;
        }

        .btn-print {
            background: #29b6f6;
            color: white;
        }

        .btn-print:hover {
            background: #039be5;
        }

        .btn-status {
            background: #66bb6a;
            color: white;
        }

        .btn-status:hover {
            background: #4caf50;
        }

        .btn-print-disabled {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            background: #6c757d !important;
        }

        .btn-print-disabled:hover {
            transform: none !important;
            box-shadow: none !important;
            background: #6c757d !important;
        }

        .btn-icon-action[disabled] {
            opacity: 0.5;
            cursor: not-allowed !important;
            pointer-events: none;
        }

        .btn-icon-action[disabled]:hover {
            transform: none !important;
            box-shadow: none !important;
        }

        /* ===== PERBAIKAN: Status Modal Styles - NO SCROLL ===== */
        .status-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.3);
        }

        .status-modal.show {
            display: flex;
        }

        .status-content {
            background: white;
            border-radius: 12px;
            width: 700px;
            max-width: 700px;
            padding: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-height: 85vh;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .status-header {
            background: #FB8C00;
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .status-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .close-status {
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

        .close-status:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .status-body {
            padding: 25px;
        }

        /* ===== REVISI: Progress Bar Layout Baru dengan 3 Waktu Estimasi - DI ATAS GARIS ===== */
        .progress-container {
            margin: 20px 0 30px;
        }

        .progress-track {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 30px;
            min-width: 650px;
        }

        /* Garis latar belakang - posisi asli */
        .progress-track::before {
            content: '';
            position: absolute;
            top: 50px; /* Lebih rendah untuk memberi ruang untuk waktu estimasi di atas */
            left: 60px;
            right: 60px;
            height: 4px;
            background: #e0e0e0;
            z-index: 1;
            border-radius: 2px;
        }

        /* Garis progress aktif */
        .progress-line {
            position: absolute;
            top: 50px; /* Sama dengan garis latar belakang */
            left: 60px;
            height: 4px;
            background: #4CAF50;
            z-index: 2;
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        /* Step Container */
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 3;
            width: 140px;
            min-width: 140px;
            flex-shrink: 0;
        }

        /* Step Icon Container */
        .step-icon-container {
            position: relative;
            margin-bottom: 8px;
        }

        .step-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            border: 3px solid #e0e0e0;
            background: white;
            position: relative;
            z-index: 4;
            transition: all 0.3s ease;
        }

        /* Step Text */
        .step-text {
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 4px;
            line-height: 1.3;
            min-height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .step-date {
            font-size: 11px;
            color: #666;
            text-align: center;
            display: block;
            width: 100%;
        }

        /* ===== PERBAIKAN: Waktu Estimasi di ATAS GARIS PROGRESS ===== */
        .step-estimasi {
            position: absolute;
            top: 25px; /* DI ATAS GARIS, bukan di tengah lingkaran */
            transform: translateX(-50%);
            background: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            color: #666;
            border: 1px solid #e0e0e0;
            white-space: nowrap;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 5;
            text-align: center;
            font-weight: 600;
            min-width: 100px;
            transition: all 0.3s ease;
        }

        /* Posisi waktu estimasi antara step 1 dan 2 */
        .step-estimasi[data-between="1-2"] {
            left: 25%; /* Tepat di tengah antara step 1 dan 2 */
        }

        /* Posisi waktu estimasi antara step 2 dan 3 */
        .step-estimasi[data-between="2-3"] {
            left: 50%; /* Tepat di tengah antara step 2 dan 3 */
        }

        /* Posisi waktu estimasi antara step 3 dan 4 */
        .step-estimasi[data-between="3-4"] {
            left: 75%; /* Tepat di tengah antara step 3 dan 4 */
        }

        /* Warna untuk waktu estimasi aktif */
        .step-estimasi.active {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }

        /* Warna untuk waktu estimasi sedang berjalan */
        .step-estimasi.in-progress {
            background: #FF9800 !important;
            color: white !important;
            border-color: #FF9800 !important;
            animation: pulse-estimasi 2s infinite;
        }

        /* Warna untuk waktu estimasi belum aktif */
        .step-estimasi.inactive {
            background: #f8f9fa;
            color: #999;
            border-color: #e0e0e0;
            opacity: 0.8;
        }

        /* Warna untuk waktu estimasi ditolak */
        .step-estimasi.ditolak {
            background: #F44336 !important;
            color: white !important;
            border-color: #F44336 !important;
            opacity: 0.7;
        }

        /* Warna untuk waktu estimasi selesai */
        .step-estimasi.selesai {
            background: #4CAF50 !important;
            color: white !important;
            border-color: #4CAF50 !important;
        }

        /* Icon di dalam waktu estimasi */
        .step-estimasi i {
            font-size: 9px;
            margin-right: 3px;
        }

        /* Status Colors */
        .progress-step.completed .step-icon {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: white;
        }

        .progress-step.in-progress .step-icon {
            background: #FF9800;
            border-color: #FF9800;
            color: white;
            animation: pulse 2s infinite;
        }

        .progress-step.rejected .step-icon {
            background: #F44336;
            border-color: #F44336;
            color: white;
        }

        .progress-step.pending .step-icon {
            background: white;
            border-color: #e0e0e0;
            color: #999;
        }

        /* Icon Colors */
        .progress-step.completed .step-icon i {
            color: white;
        }

        .progress-step.in-progress .step-icon i {
            color: white;
        }

        .progress-step.rejected .step-icon i {
            color: white;
        }

        .progress-step.pending .step-icon i {
            color: #999;
        }

        /* Style untuk catatan penolakan di bawah step */
        .step-note {
            margin-top: 5px;
            padding: 5px 10px;
            background: #ffebee;
            border-radius: 4px;
            font-size: 11px;
            border-left: 3px solid #F44336;
            max-width: 120px;
            text-align: center;
            word-break: break-word;
            white-space: normal;
            line-height: 1.3;
        }

        /* Animation for in-progress step */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.4);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(255, 152, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0);
            }
        }

        /* Animation for waktu estimasi in-progress */
        @keyframes pulse-estimasi {
            0% { 
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0.4);
                transform: translateX(-50%) scale(1);
            }
            50% { 
                transform: translateX(-50%) scale(1.03);
            }
            70% { 
                box-shadow: 0 0 0 6px rgba(255, 152, 0, 0);
            }
            100% { 
                box-shadow: 0 0 0 0 rgba(255, 152, 0, 0);
                transform: translateX(-50%) scale(1);
            }
        }

        /* Status Information */
        .status-info {
            margin-top: 30px;
            padding: 18px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            width: 100%;
            box-sizing: border-box;
        }

        .status-info h5 {
            color: #FB8C00;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-info h5 i {
            font-size: 18px;
        }

        .status-info p {
            color: #495057;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        /* Rejection Reason */
        .rejection-reason {
            background: #fff5f5;
            border: 1px solid #f8cccc;
            padding: 12px;
            border-radius: 8px;
            margin-top: 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .rejection-reason h6 {
            color: #e63946;
            font-weight: 700;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }

        .rejection-reason h6 i {
            font-size: 16px;
        }

        .rejection-reason p {
            color: #495057;
            font-size: 13px;
            line-height: 1.4;
            margin: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .progress-track {
                min-width: 100%;
                flex-wrap: nowrap;
                overflow-x: auto;
                overflow-y: hidden;
                padding-bottom: 10px;
                justify-content: flex-start;
                gap: 0;
            }
            
            .progress-track::-webkit-scrollbar {
                height: 4px;
            }
            
            .progress-track::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 2px;
            }
            
            .progress-track::-webkit-scrollbar-thumb {
                background: #FB8C00;
                border-radius: 2px;
            }

            .progress-step {
                width: 120px;
                min-width: 120px;
            }

            .step-icon {
                width: 50px;
                height: 50px;
                font-size: 18px;
                border-width: 2px;
            }

            .step-text {
                font-size: 11px;
                min-height: 30px;
            }

            .step-date {
                font-size: 10px;
            }

            .step-estimasi {
                font-size: 9px;
                padding: 3px 8px;
                min-width: 80px;
                top: 20px;
            }

            .progress-track::before {
                top: 40px;
                left: 50px;
                right: 50px;
                height: 3px;
            }

            .progress-line {
                top: 40px;
                left: 50px;
                height: 3px;
            }

            .status-info h5 {
                font-size: 15px;
            }

            .status-info p {
                font-size: 13px;
            }
        }

        @media (max-width: 576px) {
            .progress-track {
                min-width: 500px;
            }

            .progress-step {
                width: 100px;
                min-width: 100px;
            }

            .step-icon {
                width: 45px;
                height: 45px;
                font-size: 16px;
            }

            .step-text {
                font-size: 10px;
            }

            .step-date {
                font-size: 9px;
            }

            .step-estimasi {
                font-size: 8px;
                padding: 2px 6px;
                min-width: 70px;
                top: 18px;
            }

            .progress-track::before {
                top: 35px;
                left: 45px;
                right: 45px;
                height: 2.5px;
            }

            .progress-line {
                top: 35px;
                left: 45px;
                height: 2.5px;
            }

            .step-note {
                font-size: 9px;
                padding: 4px 8px;
                max-width: 100px;
            }
        }

        /* Detail Modal Styles */
        .modal-detail {
            display: none !important;
            position: fixed;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.3);
        }

        .modal-detail.show {
            display: flex !important;
        }

        .modal-content-detail {
            width: 90%;
            max-width: 800px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header-detail {
            background: #FB8C00;
            padding: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
        }

        .modal-body-detail {
            padding: 30px;
            background: #f8f9fa;
        }

        /* Form-like detail styles */
        .detail-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }

        .detail-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #FB8C00;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #FB8C00;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-section-title i {
            font-size: 18px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .detail-label {
            width: 200px;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
            flex-shrink: 0;
        }

        .detail-value {
            flex: 1;
            color: #212529;
            font-size: 14px;
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            min-height: 40px;
            display: flex;
            align-items: center;
        }

        .detail-value-empty {
            color: #6c757d;
            font-style: italic;
        }

        /* Dosen list in detail */
        .dosen-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .dosen-item-detail {
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

        .dosen-name-detail {
            font-weight: 600;
            color: #212529;
            font-size: 14px;
        }

        .dosen-details-detail {
            font-size: 12px;
            color: #6c757d;
        }

        /* ===== FILE EVIDENCE STYLES ===== */
        .file-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.2s;
            border-left: 4px solid #FB8C00;
        }

        .file-item:hover {
            background: #fffaf5;
            border-color: #FB8C00;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .file-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .file-icon-pdf {
            background: #e74c3c;
        }

        .file-icon-image {
            background: #3498db;
        }

        .file-icon-doc {
            background: #2980b9;
        }

        .file-icon-xls {
            background: #27ae60;
        }

        .file-icon-ppt {
            background: #e67e22;
        }

        .file-icon-zip {
            background: #8e44ad;
        }

        .file-icon-unknown {
            background: #95a5a6;
        }

        .file-info {
            flex: 1;
            min-width: 0;
            cursor: pointer;
        }

        .file-name {
            font-weight: 600;
            color: #212529;
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            margin-bottom: 4px;
        }

        .file-details {
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: #6c757d;
        }

        .file-type {
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        .file-size {
            color: #6c757d;
        }

        .file-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .download-btn {
            background: #FB8C00;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .download-btn:hover {
            background: #e67e00;
            text-decoration: none;
            color: white;
            transform: translateY(-1px);
        }

        .preview-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .preview-btn:hover {
            background: #2980b9;
            text-decoration: none;
            color: white;
            transform: translateY(-1px);
        }

        .preview-btn.disabled {
            background: #bdc3c7;
            cursor: not-allowed;
            transform: none;
        }

        .preview-btn.disabled:hover {
            background: #bdc3c7;
            transform: none;
        }

        /* No files message */
        .no-files {
            text-align: center;
            padding: 30px;
            color: #6c757d;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }

        .no-files i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #adb5bd;
        }

        /* Preview Modal Styles */
        .preview-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.3);
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
            background: #FB8C00;
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
            padding: 0;
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
            color: #FB8C00;
        }

        .close-modal {
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

        .close-modal:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .hide-mobile {
            display: block;
        }

        .show-mobile {
            display: none;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding: 20px 0;
            background-color: #f8f8fa;
            border-top: 1px solid #ddd;
        }

        .fik-footer {
            text-align: left;
            padding-left: 285px;
            transition: padding-left 0.3s ease;
        }

        .credit {
            color: #666;
            font-size: 14px;
        }

        /* ===== PERBAIKAN: Responsive Fixes for Status Modal ===== */
        @media (max-width: 768px) {
            .status-content {
                width: 95%;
                max-width: 95%;
                margin: 10px;
                max-height: 80vh;
            }

            .status-body {
                padding: 20px;
            }

            .progress-track {
                min-width: 100%;
                flex-wrap: nowrap;
                overflow-x: auto;
                overflow-y: hidden;
                padding-bottom: 10px;
                justify-content: flex-start;
                gap: 0;
            }

            .progress-track::-webkit-scrollbar {
                height: 4px;
            }

            .progress-track::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 2px;
            }

            .progress-track::-webkit-scrollbar-thumb {
                background: #FB8C00;
                border-radius: 2px;
            }

            .progress-step {
                width: 120px;
                min-width: 120px;
            }

            .step-icon {
                width: 50px;
                height: 50px;
                font-size: 18px;
                border-width: 2px;
            }

            .step-text {
                font-size: 11px;
                min-height: 30px;
            }

            .step-date {
                font-size: 10px;
            }

            .step-estimasi {
                font-size: 9px;
                padding: 2px 6px;
                width: 80px;
            }

            .progress-track::before {
                top: 35px;
                left: 50px;
                right: 50px;
            }

            .progress-line {
                top: 35px;
                left: 50px;
            }

            .status-info h5 {
                font-size: 15px;
            }

            .status-info p {
                font-size: 13px;
            }

            .modal-content-detail {
                width: 95%;
                margin: 10px;
            }

            .modal-body-detail {
                padding: 20px;
            }

            .detail-section {
                padding: 15px;
            }

            .detail-row {
                flex-direction: column;
                gap: 8px;
            }

            .detail-label {
                width: 100%;
            }

            .detail-value {
                width: 100%;
            }

            /* Responsive Dosen Modal */
            .dosen-modal-content {
                width: 95%;
                margin: 10px;
            }

            .dosen-modal-body {
                padding: 15px;
            }

            .dosen-item {
                padding: 15px;
            }

            .dosen-name {
                font-size: 15px;
            }

            .dosen-detail-item {
                font-size: 13px;
            }

            .nama-dosen-badge {
                max-width: 180px;
            }
        }

        @media (max-width: 576px) {
            .progress-track {
                min-width: 500px;
            }

            .progress-step {
                width: 100px;
                min-width: 100px;
            }

            .step-icon {
                width: 45px;
                height: 45px;
                font-size: 16px;
            }

            .step-text {
                font-size: 10px;
            }

            .step-date {
                font-size: 9px;
            }

            .step-estimasi {
                width: 70px;
                font-size: 8px;
            }

            .progress-track::before {
                top: 32px;
                left: 45px;
                right: 45px;
            }

            .progress-line {
                top: 32px;
                left: 45px;
            }

            .hide-mobile {
                display: none !important;
            }

            .show-mobile {
                display: block !important;
            }

            .fik-footer {
                padding-left: 20px;
                text-align: center;
            }

            /* Responsive Dosen Modal */
            .dosen-modal-header {
                padding: 15px;
            }

            .dosen-modal-title {
                font-size: 16px;
            }

            .dosen-section-title {
                font-size: 16px;
            }

            .dosen-name {
                font-size: 14px;
            }

            .dosen-detail-item {
                font-size: 12px;
            }

            .nama-dosen-badge {
                max-width: 150px;
                font-size: 11px;
            }
        }

        /* ===== RESPONSIVE STYLES ===== */
        @media (max-width: 1200px) {
            .main-content {
                padding: 20px;
                margin-left: 260px;
                width: calc(100% - 260px);
            }

            #tabelSurat th:nth-child(3),
            #tabelSurat td:nth-child(3) {
                width: 22%;
                min-width: 180px;
            }

            #tabelSurat th:nth-child(5),
            #tabelSurat td:nth-child(5) {
                width: 18%;
                min-width: 160px;
            }

            #tabelSurat th:nth-child(6),
            #tabelSurat td:nth-child(6) {
                width: 14%;
                min-width: 130px;
            }
        }

        @media (max-width: 992px) {

            /* MOBILE SIDEBAR FIX */
            .fik-db-side-menu {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .fik-db-side-menu.active {
                transform: translateX(0);
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            }

            .sidebar-overlay.active {
                display: block;
            }

            .db-menu-trigger {
                display: flex;
                margin-right: 15px;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 15px;
            }

            .main-content.shifted {
                margin-left: 260px;
                width: calc(100% - 260px);
            }

            .hide-mobile {
                display: none !important;
            }

            .show-mobile {
                display: block !important;
            }

            .fik-db-side-menu .card.profil.show-mobile {
                display: block !important;
            }

            .fik-footer {
                padding-left: 20px;
                text-align: center;
            }

            /* Responsive action buttons */
            .action-buttons-container {
                gap: 4px;
            }

            .btn-icon-action {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .header-actions {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .action-buttons-group {
                width: 100%;
                justify-content: flex-start;
            }

            .detail-row {
                flex-direction: column;
                gap: 8px;
            }

            .detail-label {
                width: 100%;
            }

            .detail-value {
                width: 100%;
            }

            .modal-content-detail {
                width: 95%;
                margin: 10px;
            }

            .modal-body-detail {
                padding: 20px;
            }

            .detail-section {
                padding: 15px;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-actions {
                order: 1;
                justify-content: space-between;
                width: 100%;
            }

            .filter-search {
                order: 2;
                margin-left: 0;
                margin-top: 10px;
            }

            .filter-bar {
                padding: 10px;
                gap: 8px;
            }

            .filter-search {
                flex-basis: 100%;
            }

            .filter-builder {
                gap: 8px;
            }

            .filter-row {
                padding: 10px;
                gap: 8px;
            }

            .filter-row .filter-row-search {
                flex-basis: 100%;
            }

            .filter-row select.row-cat {
                min-width: 140px;
            }

            .filter-row input[type="date"] {
                min-width: 140px;
            }

            #tabelSurat {
                font-size: 12px;
            }

            #tabelSurat td,
            #tabelSurat th {
                padding: 8px;
            }

            /* Table column adjustments for tablet */
            #tabelSurat th:nth-child(1),
            #tabelSurat td:nth-child(1) {
                width: 5%;
                max-width: 40px;
            }

            #tabelSurat th:nth-child(2),
            #tabelSurat td:nth-child(2) {
                width: 6%;
                max-width: 50px;
            }

            #tabelSurat th:nth-child(3),
            #tabelSurat td:nth-child(3) {
                width: 25%;
                min-width: 150px;
            }

            #tabelSurat th:nth-child(4),
            #tabelSurat td:nth-child(4) {
                width: 15%;
                min-width: 100px;
            }

            #tabelSurat th:nth-child(5),
            #tabelSurat td:nth-child(5) {
                width: 20%;
                min-width: 140px;
            }

            #tabelSurat th:nth-child(6),
            #tabelSurat td:nth-child(6) {
                width: 16%;
                min-width: 120px;
            }

            #tabelSurat th:nth-child(7),
            #tabelSurat td:nth-child(7) {
                width: 12%;
                min-width: 100px;
            }

            #tabelSurat th:nth-child(8),
            #tabelSurat td:nth-child(8) {
                width: 11%;
                min-width: 120px;
            }

            /* Responsive file items */
            .file-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .file-actions {
                width: 100%;
                justify-content: space-between;
            }

            .download-btn,
            .preview-btn {
                flex: 1;
                justify-content: center;
            }

            /* Responsive Dosen Container */
            .dosen-container {
                padding: 6px;
            }

            .nama-dosen-badge {
                max-width: 180px;
                font-size: 11px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 10px;
            }

            #tabelSurat {
                font-size: 11px;
            }

            #tabelSurat td,
            #tabelSurat th {
                padding: 6px 4px;
            }

            #tabelSurat_wrapper {
                overflow-x: auto;
            }

            .nama-dosen-badge {
                max-width: 120px;
                font-size: 10px;
                padding: 4px 8px;
            }

            .status-badge {
                min-width: 80px;
                font-size: 10px;
                padding: 4px 8px;
            }

            .btn-icon-action {
                width: 28px;
                height: 28px;
                font-size: 10px;
            }

            /* Hide checkbox column on small mobile */
            #tabelSurat th:nth-child(1),
            #tabelSurat td:nth-child(1) {
                display: none;
            }

            /* Hide jenis pengajuan column on small mobile */
            #tabelSurat th:nth-child(4),
            #tabelSurat td:nth-child(4) {
                display: none;
            }

            /* Action buttons layout for mobile */
            .action-buttons-container {
                flex-direction: column;
                gap: 3px;
            }

            /* Dosen Modal adjustments */
            .dosen-modal {
                padding: 10px;
            }

            .dosen-modal-body {
                max-height: 70vh;
            }

            .dosen-section-title {
                font-size: 15px;
            }
        }

        @media (max-width: 576px) {

            /* Very small screens */
            .fik-db-side-menu {
                width: 85%;
                max-width: 280px;
            }

            .main-content.shifted {
                margin-left: 85%;
                max-width: calc(100% - 85%);
            }

            #tabelSurat th:nth-child(5),
            #tabelSurat td:nth-child(5) {
                width: 25%;
                min-width: 100px;
            }

            #tabelSurat th:nth-child(6),
            #tabelSurat td:nth-child(6) {
                width: 18%;
                min-width: 90px;
            }

            #tabelSurat th:nth-child(7),
            #tabelSurat td:nth-child(7) {
                width: 15%;
                min-width: 80px;
            }

            .action-buttons-container {
                flex-direction: row;
                gap: 3px;
            }

            .menu-text {
                font-size: 13px;
            }

            .fik-db-side-menu .btn {
                padding: 14px 16px;
                font-size: 13px;
            }

            .fik-db-side-menu .collapse ul li a {
                padding-left: 50px;
                font-size: 11px;
            }

            /* Dosen container untuk mobile sangat kecil */
            .dosen-container {
                flex-direction: column;
                align-items: center;
                gap: 3px;
            }

            .nama-dosen-badge {
                max-width: 100px;
                font-size: 9px;
            }
        }

        /* Desktop: ensure sidebar is always visible */
        @media (min-width: 993px) {
            .fik-db-side-menu {
                transform: translateX(0) !important;
                display: block !important;
            }

            .sidebar-overlay {
                display: none !important;
            }

            .main-content {
                margin-left: 260px;
                width: calc(100% - 260px);
            }
        }

        /* Style untuk tombol dalam modal dosen */
        .dosen-modal-footer .btn-add-surat {
            padding: 8px 16px;
            font-size: 14px;
            margin-right: 8px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .dosen-modal-footer .btn-back {
            padding: 8px 16px;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Hover effect untuk tombol modal */
        .dosen-modal-footer .btn-add-surat:hover {
            transform: translateY(-2px);
        }

        .dosen-modal-footer .btn-back:hover {
            transform: translateY(-2px);
        }

        /* ===== MODAL CUSTOM STYLES ===== */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.3);
        }

        .custom-modal.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .custom-modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .custom-modal-header {
            background: linear-gradient(135deg, #FB8C00 0%, #FF9800 100%);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .custom-modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .custom-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .custom-modal-body {
            padding: 25px;
            overflow-y: auto;
            max-height: 50vh;
        }

        .custom-modal-footer {
            padding: 15px 25px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #FB8C00;
            outline: none;
        }

        .text-muted {
            color: #6c757d !important;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        /* Buttons in modal */
        .btn-submit {
            background: #FB8C00;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: #e67e00;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        /* List group for deletion */
        .list-group {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
        }

        .list-group-item {
            padding: 12px 15px;
            border-bottom: 1px solid #e9ecef;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .list-group-item.selected {
            background-color: #fff3e0;
            border-left: 4px solid #FB8C00;
        }

        .list-group-item input[type="radio"] {
            margin-right: 10px;
        }

        .list-group-item .dosen-info {
            flex: 1;
        }

        .list-group-item .dosen-name {
            font-weight: 600;
            color: #333;
        }

        .list-group-item .dosen-nip {
            font-size: 12px;
            color: #6c757d;
        }

        /* Search results */
        .search-result {
            padding: 10px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-top: 10px;
            background: #f8f9fa;
        }

        .search-result .found {
            color: #28a745;
            font-weight: 600;
        }

        .search-result .not-found {
            color: #dc3545;
            font-weight: 600;
        }

        /* Style untuk radio button yang bisa diklik */
        .radio-option {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
        }

        .radio-option:hover {
            background: #f8f9fa;
            border-color: #FB8C00;
        }

        .radio-option.selected {
            background: #fff3e0;
            border-color: #FB8C00;
            border-left: 4px solid #FB8C00;
        }

        .radio-option input[type="radio"] {
            margin-right: 12px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-option label {
            flex: 1;
            margin: 0;
            cursor: pointer;
            font-weight: 500;
        }

        .dosen-detail-small {
            font-size: 12px;
            color: #6c757d;
            margin-top: 3px;
        }

        .no-dosen-message {
            text-align: center;
            padding: 30px;
            color: #6c757d;
        }

        .no-dosen-message i {
            font-size: 48px;
            margin-bottom: 10px;
            color: #adb5bd;
        }

        .no-dosen-message p {
            margin: 5px 0;
        }

        /* ===== MULTIPLE DOSEN STYLES ===== */
        .selected-dosen-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.2s;
        }

        .selected-dosen-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
            border-color: #FB8C00;
        }

        /* Autocomplete styles */
        .autocomplete-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }

        .autocomplete-item:hover {
            background-color: #f8f9fa;
        }

        .autocomplete-item:last-child {
            border-bottom: none;
        }

        .autocomplete-item.selected {
            background-color: #e8f4ff;
            border-left: 3px solid #FB8C00;
        }

        /* Badge styles */
        .badge-primary {
            background: #FB8C00;
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Button states */
        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Progress bar in modal */
        #progressBar {
            transition: width 0.3s ease;
        }

        /* Alert customization */
        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border-left: 4px solid #ffc107;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }

        /* Scrollbar customization */
        #selectedDosenList::-webkit-scrollbar {
            width: 6px;
        }

        #selectedDosenList::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        #selectedDosenList::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        #selectedDosenList::-webkit-scrollbar-thumb:hover {
            background: #aaa;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .selected-dosen-item {
                padding: 10px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .selected-dosen-item>div:first-child {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }
        }

        /* ===== STYLES UNTUK MODAL KURANGI DOSEN (DENGAN MULTI HAPUS) ===== */
        .dosen-item-hapus {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 10px;
            background: white;
            transition: all 0.2s;
        }

        .dosen-item-hapus:hover {
            border-color: #FB8C00;
            background: #fffaf5;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .dosen-item-hapus.selected {
            background: #fff3e0;
            border-color: #FB8C00;
            border-left: 4px solid #FB8C00;
        }

        .dosen-avatar-hapus {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FB8C00 0%, #FF9800 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .dosen-info-hapus {
            flex: 1;
        }

        .dosen-nama-hapus {
            font-weight: 600;
            color: #212529;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .dosen-detail-hapus {
            font-size: 12px;
            color: #6c757d;
        }

        .checkbox-hapus {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #dc3545;
            margin-right: 10px;
        }

        /* ===== STYLE UNTUK MULTI HAPUS HEADER ===== */
        .multi-hapus-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .multi-hapus-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .multi-hapus-count {
            background: #dc3545;
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-select-all {
            background: #FB8C00;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-select-all:hover {
            background: #e67e00;
            transform: translateY(-1px);
        }

        /* ===== PERBAIKAN: Modal Konfirmasi Penghapusan (MULTI) ===== */
        .konfirmasi-hapus-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            background: rgba(0, 0, 0, 0.3);
        }

        .konfirmasi-hapus-modal.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .konfirmasi-hapus-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .konfirmasi-hapus-header {
            background: #dc3545;
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .konfirmasi-hapus-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .konfirmasi-hapus-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .konfirmasi-hapus-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .konfirmasi-hapus-body {
            padding: 25px;
            overflow-y: auto;
            max-height: 50vh;
        }

        .konfirmasi-hapus-footer {
            padding: 15px 25px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .info-dosen-hapus {
            background: #fff3e0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #FB8C00;
        }

        .info-dosen-hapus strong {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
            color: #212529;
        }

        .info-dosen-hapus div {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        /* ===== STYLE UNTUK DAFTAR MULTI HAPUS ===== */
        .dosen-list-hapus {
            max-height: 300px;
            overflow-y: auto;
            margin: 10px 0;
        }

        .dosen-hapus-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .dosen-hapus-item:last-child {
            border-bottom: none;
        }

        .dosen-hapus-initial {
            width: 30px;
            height: 30px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .dosen-hapus-info {
            flex: 1;
        }

        .dosen-hapus-nama {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        .dosen-hapus-nip {
            font-size: 12px;
            color: #666;
        }
        /* ===== MODAL STYLES UNTUK SUCCESS (DIHAPUS) ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            background: rgba(0,0,0,0.3);
        }

        .modal.show {
            display: flex;
        }

        .bulk-modal-content {
            background: white;
            border-radius: 15px;
            max-width: 600px;
            width: 95%;
            max-height: 85vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            background: #27ae60;
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 15px 15px 0 0;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .close-modal {
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

        .close-modal:hover {
            background: rgba(255,255,255,0.2);
        }

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

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 11px;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }
        /* ===== STYLE UNTUK NOTIFIKASI PERUBAHAN DOSEN ===== */
        .dosen-change-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10040;
            max-width: 400px;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        .dosen-change-notification.hiding {
            animation: slideOutRight 0.3s ease;
        }

        /* ===== STYLE UNTUK TANDA DOSEN BARU ===== */
        .dosen-new-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #4CAF50;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 10px;
            z-index: 2;
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(76, 175, 80, 0); }
            100% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0); }
        }

        /* ===== STYLE UNTUK TANDA DOSEN DIHAPUS ===== */
        .dosen-removed-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #F44336;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 10px;
            z-index: 2;
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% { box-shadow: 0 0 0 0 rgba(244, 67, 54, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(244, 67, 54, 0); }
            100% { box-shadow: 0 0 0 0 rgba(244, 67, 54, 0); }
        }

        /* ===== STYLE UNTUK ANIMASI DOSEN BARU ===== */
        .dosen-card.new-dosen {
            animation: highlightGreen 3s ease;
            border: 2px solid #4CAF50;
            position: relative;
        }

        @keyframes highlightGreen {
            0% { 
                background-color: #e8f5e9; 
                transform: scale(1.02);
                box-shadow: 0 0 15px rgba(76, 175, 80, 0.3);
            }
            70% { 
                background-color: #e8f5e9;
                transform: scale(1.01);
                box-shadow: 0 0 10px rgba(76, 175, 80, 0.2);
            }
            100% { 
                background-color: #ffffff; 
                transform: scale(1);
                box-shadow: none;
            }
        }

        /* ===== STYLE UNTUK ANIMASI DOSEN DIHAPUS ===== */
        .dosen-card.removed-dosen {
            animation: highlightRed 2s ease;
            border: 2px solid #F44336;
            position: relative;
        }

        @keyframes highlightRed {
            0% { 
                background-color: #ffebee; 
                transform: scale(0.95);
                opacity: 0.8;
                box-shadow: 0 0 15px rgba(244, 67, 54, 0.3);
            }
            70% { 
                background-color: #ffebee;
                transform: scale(0.98);
                opacity: 0.9;
                box-shadow: 0 0 10px rgba(244, 67, 54, 0.2);
            }
            100% { 
                background-color: #ffffff; 
                transform: scale(1);
                opacity: 1;
                box-shadow: none;
            }
        }
         /* Tombol Cetak - WARNA UNGU */
    .btn-cetak {
        background: #077fc0ff !important;
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
        /* Style untuk durasi dengan menit */
.step-estimasi.minutes-only {
    background: #e3f2fd !important;
    color: #1976d2 !important;
    border-color: #1976d2 !important;
    font-weight: 600;
}

/* Style untuk durasi dengan jam */
.step-estimasi.hours-minutes {
    background: #fff3e0 !important;
    color: #f57c00 !important;
    border-color: #f57c00 !important;
    font-weight: 600;
}

/* Style untuk durasi dengan hari */
.step-estimasi.days-only {
    background: #ffebee !important;
    color: #c62828 !important;
    border-color: #c62828 !important;
    font-weight: 600;
}
/* ===== PERBAIKAN: Avatar dengan Foto Support ===== */
.dosen-avatar {
    width: 40px;
    height: 40px;
    background: #ff9800;
    color: white;
    font-weight: bold;
    font-size: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
}

.dosen-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    position: absolute;
    top: 0;
    left: 0;
}

.dosen-avatar-initial {
    position: relative;
    z-index: 1;
}

/* Avatar untuk modal detail (lebih besar) */
.dosen-item-detail .dosen-avatar {
    width: 40px;
    height: 40px;
    font-size: 18px;
}

/* Avatar untuk modal tambah dosen */
.selected-dosen-item .dosen-avatar-tambah {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #FB8C00 0%, #FF9800 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
    overflow: hidden;
    flex-shrink: 0;
    position: relative;
}

.selected-dosen-item .dosen-avatar-tambah img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

/* Avatar untuk modal kurang dosen */
.dosen-avatar-hapus {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FB8C00 0%, #FF9800 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
    margin-right: 12px;
    flex-shrink: 0;
    overflow: hidden;
    position: relative;
}

.dosen-avatar-hapus img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

/* Avatar untuk autocomplete */
.autocomplete-item .dosen-avatar-auto {
    width: 32px;
    height: 32px;
    background: #FB8C00;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    overflow: hidden;
    position: relative;
}

.autocomplete-item .dosen-avatar-auto img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

/* Avatar untuk konfirmasi hapus */
.dosen-hapus-initial {
    width: 30px;
    height: 30px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 10px;
    flex-shrink: 0;
    overflow: hidden;
    position: relative;
}

.dosen-hapus-initial img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

        /* ===== STYLE UNTUK NOMOR MODAL ===== */
        .modal-number-badge {
            position: absolute;
            top: -8px;
            left: -8px;
            background: #FB8C00;
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1055;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            animation: pulse-orange 2s infinite;
        }

        .modal-number-badge.modal-1 {
            background: #FB8C00;
        }

        .modal-number-badge.modal-2 {
            background: #3498db;
        }

        @keyframes pulse-orange {
            0% { box-shadow: 0 0 0 0 rgba(251, 140, 0, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(251, 140, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(251, 140, 0, 0); }
        }

        /* Modal Stack */
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
        }

        /* Modal pertama - di tengah */
        .modal-item:first-child {
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
            z-index: 1054;
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

        /* Responsive positioning untuk multi modal */
        @media (max-width: 992px) {
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
                top: -5px;
                left: -5px;
                font-size: 10px;
                width: 20px;
                height: 20px;
            }
        }

        /* Tabel tetap bisa diakses saat modal terbuka */
        body.modal-open #tabelSurat_wrapper {
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

        /* Modal drag handle */
        .modal-drag-handle {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 40px;
            cursor: move;
            z-index: 5;
            border-radius: 12px 12px 0 0;
        }

        /* Modal resize handle */
        .modal-resize-handle {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 20px;
            height: 20px;
            cursor: nwse-resize;
            z-index: 5;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top">
        <div class="container loss">
            <a class="db-menu-trigger show-mobile" onclick="toggleSidebar()"><span class="fas fa-th-large"></span></a>
            <div class="navbar-brand akun">
                <a href="https://ifik.telkomuniversity.ac.id/"><img src="https://ifik.telkomuniversity.ac.id/assets/img/logo/logo-dummy.png" /></a>
            </div>
            <div class="fik-navbar-menu">
                <ul class="left akun fik-username hide-mobile">
                    <li>
                        <img src="https://ifik.telkomuniversity.ac.id/assets/img/profile/default.jpg" alt="Profile">
                    </li>
                    <li>
                        <b>PIC MEDCRAFT</b>
                        <span>pic kk</span>
                    </li>
                </ul>
                <ul class="right akun">
                    <div class="fik-login-dropdown hide-mobile" style="margin-right:22px">
                        <a class="btn btn-sm btn-pill btn-icon btn-icon-left" href="https://ifik.telkomuniversity.ac.id/main/helpdesk">
                            <span class="fas fa-life-ring"></span> Helpdesk
                        </a>
                    </div>
                    <div class="not-dropdown" style="margin-right:14px" id="active">
                        <a class="btn btn-icon" href="https://ifik.telkomuniversity.ac.id/Notification">
                            <span class="fas fa-bell"></span>
                        </a>
                    </div>
                    <div class="dropdown not-dropdown">
                        <a class="btn btn-icon" id="active" data-toggle="dropdown" href="#">
                            <span class="fas fa-cog"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item regisdropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#logout">
                                    <i class="fa fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 icon"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="fik-db-side-menu" id="sidebar">
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <div id="accordion">
            <!-- Profile Section (mobile only) -->
            <div class="card show-mobile profil">
                <div class="img-wrapper">
                    <img src="https://ifik.telkomuniversity.ac.id/assets/img/profile/default.jpg" alt="Profile">
                </div>
                <b>PIC MEDCRAFT</b>
                <span>pic kk</span>
            </div>
            <div class="divider show-mobile" style="margin-top:20px"></div>

            <!-- Menu Items -->
            <div class="card">
                <a href="<?= base_url('list-surat-tugas') ?>" class="btn active">
                    <span class="fas fa-palette"></span>
                    <span class="menu-text">List Pengajuan</span>
                </a>
            </div>

            <div class="card">
                <a href="https://ifik.telkomuniversity.ac.id/Pic_kk/input_surat" class="btn">
                    <span class="fas fa-envelope-open-text"></span>
                    <span class="menu-text">Surat Tugas</span>
                </a>
            </div>
            <div class="card">
            <a href="<?= base_url('whatsapp/dashboard') ?>" class="btn">
                <span class="fab fa-whatsapp"></span> 
                <span class="menu-text">Whatsapp Server Control</span> 
            </a>
        </div>

            <div class="divider"></div>

            <!-- Peminjaman Ruangan (Collapsible) -->
            <div class="card">
                <a href="#" class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapse2"
                    aria-expanded="false" aria-controls="collapse2">
                    <span class="fas fa-door-open"></span>
                    <span class="menu-text">Peminjaman Ruangan</span>
                    <span class="collapse-arrow fas fa-chevron-down"></span>
                </a>
                <div id="collapse2" class="collapse" data-bs-parent="#accordion">
                    <ul>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#termcondition">Buat Peminjaman</a></li>
                        <li><a href="https://ifik.telkomuniversity.ac.id/users/daftarsemuatempat">Daftar Ruangan</a></li>
                        <li><a href="https://ifik.telkomuniversity.ac.id/Pic_kk/riwayat">Riwayat</a></li>
                    </ul>
                </div>
            </div>

            <!-- Ticketing (Collapsible) -->
            <div class="card">
                <a href="#" class="btn collapsed" data-bs-toggle="collapse" data-bs-target="#ticketing"
                    aria-expanded="false" aria-controls="ticketing">
                    <span class="fas fa-door-open"></span>
                    <span class="menu-text">Ticketing</span>
                    <span class="collapse-arrow fas fa-chevron-down"></span>
                </a>
                <div id="ticketing" class="collapse" data-bs-parent="#accordion">
                    <ul>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#maketicketing">Input ticketing</a></li>
                        <li><a href="https://ifik.telkomuniversity.ac.id/users/daftarsemuatempat">Daftar Ruangan</a></li>
                        <li><a href="https://ifik.telkomuniversity.ac.id/pic_kk/riwayat_ticketing">Riwayat</a></li>
                    </ul>
                </div>
            </div>

            <!-- Helpdesk (mobile only) -->
            <div class="card show-mobile">
                <a href="https://ifik.telkomuniversity.ac.id/main/helpdesk" class="btn">
                    <span class="fas fa-life-ring"></span>
                    <span class="menu-text">Helpdesk</span>
                </a>
            </div>

            <!-- Logout -->
            <div class="card logout">
                <button class="btn" data-bs-toggle="modal" data-bs-target="#logout">
                    <span class="fas fa-sign-out-alt"></span>
                    <span class="menu-text">Logout</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border-left: 5px solid #28a745;">
                <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px; border-left: 5px solid #dc3545;">
                <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- REVISI: Header Actions dengan layout baru -->
        <div class="header-actions">
            <h1 class="page-title">List Pengajuan</h1>
            <div class="action-buttons-group">
                <!-- REVISI: Tombol Tambah Surat - lebih mencolok -->
                <a href="<?= site_url('surat/') ?>" class="btn-add-surat">
                    <i class="fas fa-plus-circle"></i> Tambah Surat Tugas
                </a>

                <!-- REVISI: Tombol Kembali di pojok kanan -->
                <button class="btn-back" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="filter-actions">
                <select id="filterCategory" class="btn-small">
                    <option value="jenis" selected>Jenis Pengajuan</option>
                    <option value="dosen">Nama Dosen</option>
                    <option value="status">Status</option>
                    <option value="tanggal">Tanggal Kegiatan</option>
                </select>

                <button id="btnAddFilterRow" class="btn-small btn-small-add" title="Tambah baris filter">
                    <i class="fa fa-plus"></i>
                </button>

                <button id="btnResetAll" class="btn-small btn-reset" hidden title="Reset semua filter & pencarian">
                    <i class="fa fa-times"></i>&nbsp;Reset
                </button>
            </div>

            <div class="filter-search">
                <input type="text" id="tableSearch" placeholder="Search global...">
                <i class="fa fa-search"></i>
            </div>
        </div>

        <div id="filterBuilder" class="filter-builder"></div>

        <!-- Modal Stack Container -->
        <div id="modalStack" class="modal-stack"></div>

        <!-- Table -->
        <table id="tabelSurat" class="display nowrap">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Jenis Pengajuan</th>
                    <th>Nama Dosen</th>
                    <!-- REVISI: Kolom Divisi diganti Status -->
                    <th>Status</th>
                    <!-- REVISI: Kolom Tanggal Pengajuan diganti Tanggal Kegiatan -->
                    <th>Tanggal Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($surat_list as $s):
                    // === PERUBAHAN: Ambil data dosen dari relasi ===
                    $dosen_data = isset($s->dosen_data) ? $s->dosen_data : [];

                    // Prepare detail data
                    $detail = (array) $s;

                    // Prepare arrays untuk data-detail attribute
                    $nip_array = [];
                    $nama_dosen_array = [];
                    $jabatan_array = [];
                    $divisi_array = [];
                    $foto_array = []; // ✅ TAMBAHKAN INI

                    foreach ($dosen_data as $dosen) {
                        $nip_array[] = $dosen['nip'];
                        $nama_dosen_array[] = $dosen['nama_dosen'];
                        $jabatan_array[] = $dosen['jabatan'];
                        $divisi_array[] = $dosen['divisi'];
                         $foto_array[] = $dosen['foto'] ?? ''; // ✅ TAMBAHKAN INI
                    }

                    $detail['nip'] = $nip_array;
                    $detail['nama_dosen'] = $nama_dosen_array;
                    $detail['jabatan'] = $jabatan_array;
                    $detail['divisi'] = $divisi_array;
                    $detail['foto'] = $foto_array; // ✅ TAMBAHKAN INI

                    // ===== PERBAIKAN UTAMA: Handle eviden data dengan benar =====
                    $eviden_data = [];
                    if (isset($detail['eviden'])) {
                        if (is_string($detail['eviden'])) {
                            // Coba decode JSON
                            $decoded = json_decode($detail['eviden'], true);
                            if (json_last_error() === JSON_ERROR_NONE && $decoded !== null) {
                                $eviden_data = $decoded;
                            } else {
                                // Jika bukan JSON, anggap sebagai string URL/file path
                                if (!empty($detail['eviden']) && $detail['eviden'] !== '-' && $detail['eviden'] !== '[]') {
                                    $eviden_data = [$detail['eviden']];
                                }
                            }
                        } else if (is_array($detail['eviden'])) {
                            $eviden_data = $detail['eviden'];
                        }
                    }
                    $detail['eviden'] = $eviden_data;

                    $data_detail_attr = htmlspecialchars(json_encode($detail, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8');

                    // REVISI: Tentukan class status berdasarkan nilai status
                    $status_class = 'status-proses';
                    $status_lower = strtolower($s->status);
                    if (strpos($status_lower, 'disetujui') !== false) {
                        $status_class = 'status-disetujui';
                    } elseif (strpos($status_lower, 'ditolak') !== false) {
                        $status_class = 'status-ditolak';
                    } elseif (strpos($status_lower, 'pending') !== false || strpos($status_lower, 'menunggu') !== false) {
                        $status_class = 'status-pending';
                    }
                ?>
                    <tr class="row-detail" data-detail='<?= $data_detail_attr; ?>' data-id="<?= $s->id; ?>">
                        <td><input type="checkbox" class="row-checkbox" data-id="<?= $s->id; ?>"></td>
                        <td><?= $no++; ?></td>
                        <td>
                            <?= htmlspecialchars($s->nama_kegiatan); ?>
                        </td>
                        <td><?= htmlspecialchars($s->jenis_pengajuan); ?></td>
                        <td>
                            <?php
                            $dosen_count = count($dosen_data);
                            if ($dosen_count > 0):
                                $nama = $dosen_data[0]['nama_dosen'] ?? '-';
                                $short = strlen($nama) > 30 ? substr($nama, 0, 30) . '...' : $nama;
                                
                                if ($dosen_count > 1):
                                    // Jika lebih dari 1 dosen, tampilkan dengan modal
                                    ?>
                                    <div class="dosen-container clickable"
                                        onclick="showDosenModal(event, <?= htmlspecialchars(json_encode($dosen_data), ENT_QUOTES, 'UTF-8') ?>, 
                                    '<?= htmlspecialchars($s->nama_kegiatan, ENT_QUOTES, 'UTF-8') ?>', 
                                    '<?= $s->id ?>')">
                                        <span class="nama-dosen-badge" title="<?= htmlspecialchars($nama) ?> (Klik untuk lihat semua)"><?= htmlspecialchars($short) ?></span>
                                        <span class="nama-dosen-more" title="Klik untuk lihat semua dosen">+<?= $dosen_count - 1 ?> lainnya</span>
                                    </div>
                                <?php else: ?>
                                    <!-- Jika hanya 1 dosen, tampilkan tanpa modal -->
                                    <div class="dosen-container" style="cursor: default;">
                                        <span class="nama-dosen-badge" title="<?= htmlspecialchars($nama) ?>"><?= htmlspecialchars($short) ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <!-- REVISI: Kolom Status -->
                        <td>
                            <span class="status-badge <?= $status_class ?>">
                                <?= htmlspecialchars($s->status); ?>
                            </span>
                        </td>
                        <!-- REVISI: Kolom Tanggal Kegiatan - Tampilkan Periode atau Tanggal -->
                        <td>
                            <?php
                            // LOGIKA BARU: Cek jenis_date terlebih dahulu
                            $jenis_date = isset($s->jenis_date) ? $s->jenis_date : '';
                            
                            if ($jenis_date === 'Periode') {
                                // Jika jenis_date adalah Periode, tampilkan periode_value
                                $periode_value = isset($s->periode_value) && !empty($s->periode_value) ? $s->periode_value : '-';
                                echo '<span class="badge" style="background: #e3f2fd; color: #1976d2; padding: 6px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">';
                                echo '<i class="fas fa-calendar-alt"></i> ' . htmlspecialchars($periode_value);
                                echo '</span>';
                                
                            } else {
                                // Jika jenis_date adalah Custom atau lainnya, tampilkan tanggal
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
                                
                                // Format tanggal ke "10 Desember 2025"
                                if (!empty($tanggal_kegiatan) && $tanggal_kegiatan !== '-') {
                                    try {
                                        // Coba parse tanggal
                                        $tanggal_obj = new DateTime($tanggal_kegiatan);
                                        $hari = $tanggal_obj->format('j'); // Tanggal tanpa leading zero
                                        $bulan = $tanggal_obj->format('n'); // Bulan dalam angka
                                        
                                        // Konversi angka bulan ke nama bulan Indonesia
                                        $bulan_indonesia = [
                                            1 => 'Januari',
                                            2 => 'Februari',
                                            3 => 'Maret',
                                            4 => 'April',
                                            5 => 'Mei',
                                            6 => 'Juni',
                                            7 => 'Juli',
                                            8 => 'Agustus',
                                            9 => 'September',
                                            10 => 'Oktober',
                                            11 => 'November',
                                            12 => 'Desember'
                                        ];
                                        
                                        $bulan_nama = $bulan_indonesia[$bulan] ?? 'Desember';
                                        $tahun = $tanggal_obj->format('Y');
                                        
                                        echo htmlspecialchars($hari . ' ' . $bulan_nama . ' ' . $tahun);
                                    } catch (Exception $e) {
                                        // Jika parsing gagal, tampilkan format asli
                                        echo htmlspecialchars($tanggal_kegiatan);
                                    }
                                } else {
                                    echo '-';
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <!-- REVISI: Button aksi dengan layout baru -->
                            <div class="action-buttons-container">
                                <?php
                                // Cek apakah status ditolak
                                $status_lower = strtolower($s->status);
                                $is_rejected = in_array($status_lower, ['ditolak kk', 'ditolak sekretariat', 'ditolak dekan']);
                                $is_approved_dekan = ($s->status === 'disetujui dekan');
                                ?>

                                <!-- Tombol Status -->
                                <button class="btn-icon-action btn-status" title="Lihat Status" onclick="showStatusModal(<?= $s->id; ?>)">
                                    <i class="fas fa-tasks"></i>
                                </button>

                                <!-- Tombol Edit -->
                                <?php if ($is_rejected): ?>
                                    <a href="<?= site_url('surat/edit/' . $s->id); ?>"
                                        class="btn-icon-action btn-edit"
                                        title="Edit & Ajukan Ulang - Ditolak">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                <?php else: ?>
                                    <button class="btn-icon-action btn-edit btn-edit-disabled"
                                        title="Edit hanya untuk surat ditolak"
                                        onclick="showEditAlert('<?= $s->status ?>')"
                                        style="opacity: 0.5; cursor: not-allowed;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                <?php endif; ?>

                                <!-- Tombol Print -->
                                <?php if ($is_approved_dekan && !empty($s->nomor_surat) && $s->nomor_surat !== '-' && $s->nomor_surat !== 'null'): ?>
                                   <button class="btn btn-cetak" 
                                            onclick="event.stopPropagation(); window.open('<?= site_url('surat/cetak/' . $s->id) ?>', '_blank')"
                                            title="Cetak Surat">
                                        <i class="fa-solid fa-print"></i>
                                    </button>
                                <?php else: ?>
                                    <button class="btn-icon-action btn-print btn-print-disabled"
                                        title="Cetak hanya untuk surat disetujui dekan"
                                        onclick="showPrintAlert('<?= $s->status ?>')"
                                        style="opacity: 0.5; cursor: not-allowed;">
                                        <i class="fas fa-print"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <footer class="fik-footer">
            <div class="credit">Laboratorium, Bengkel &amp; Studio FIK &copy; 2020</div>
        </footer>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda yakin akan keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="location.href='https://ifik.telkomuniversity.ac.id/auth/logout';" class="btn btn-primary" style="background: #FB8C00; border-color: #FB8C00;">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Preview Modal Template -->
    <template id="previewModalTemplate">
        <div class="preview-content">
            <div class="preview-header">
                <h3 class="preview-title">Preview File</h3>
                <button class="preview-close">&times;</button>
            </div>
            <div class="preview-body"></div>
        </div>
    </template>

    <!-- Dosen Modal Template -->
    <template id="dosenModalTemplate">
        <div class="dosen-modal-content">
            <div class="dosen-modal-header">
                <h3 class="dosen-modal-title">
                    <i class="fas fa-user-graduate"></i>
                    <span class="dosen-modal-title-text">Detail Dosen</span>
                </h3>
                <button class="dosen-modal-close">&times;</button>
            </div>
            <div class="dosen-modal-body">
                <div class="dosen-section">
                    <div class="dosen-section-title">
                        <i class="fas fa-users"></i>
                        <span class="kegiatan-title"></span>
                    </div>
                    <div class="dosen-list-container"></div>
                </div>
            </div>
            <div class="dosen-modal-footer">
                <div class="dosen-total">
                    Total: <strong class="dosen-total-count">0</strong> Dosen
                </div>
                <div class="dosen-action-buttons" style="margin-top: 10px; gap: 10px;">
                    <button class="btn-add-surat btn-tambah-dosen"
                        style="padding: 8px 16px; font-size: 14px;">
                        <i class="fas fa-plus"></i> Tambah Dosen
                    </button>
                    <button class="btn-back btn-kurang-dosen"
                        style="padding: 8px 16px; font-size: 14px;">
                        <i class="fas fa-minus"></i> Kurangi Dosen
                    </button>
                </div>
            </div>
        </div>
    </template>

    <!-- Status Modal Template -->
    <template id="statusModalTemplate">
        <div class="status-content">
            <div class="status-header">
                <h3><i class="fas fa-tasks"></i> Status Pengajuan Surat Tugas</h3>
                <button class="close-status">&times;</button>
            </div>
            <div class="status-body">
                <div class="progress-container">
                    <div class="progress-track">
                        <div class="progress-line"></div>

                        <!-- Waktu Estimasi antara Step 1 dan Step 2 - DI ATAS GARIS -->
                        <div class="step-estimasi" data-between="1-2">
                            <i class="fas fa-clock" style="margin-right: 3px;"></i> 0 hari 0 jam
                        </div>
                        
                        <!-- Waktu Estimasi antara Step 2 dan Step 3 - DI ATAS GARIS -->
                        <div class="step-estimasi" data-between="2-3">
                            <i class="fas fa-clock" style="margin-right: 3px;"></i> 0 hari 0 jam
                        </div>
                        
                        <!-- Waktu Estimasi antara Step 3 dan Step 4 - DI ATAS GARIS -->
                        <div class="step-estimasi" data-between="3-4">
                            <i class="fas fa-clock" style="margin-right: 3px;"></i> 0 hari 0 jam
                        </div>

                        <!-- Step 1: Mengirim -->
                        <div class="progress-step completed" id="step1">
                            <div class="step-icon-container">
                                <div class="step-icon">
                                    <i class="fas fa-check" id="step1-icon"></i>
                                </div>
                            </div>
                            <div class="step-text" id="step1-text">Mengirim</div>
                            <div class="step-date" id="step1-date">-</div>
                        </div>

                        <!-- Step 2: Disetujui Kaprodi -->
                        <div class="progress-step completed" id="step2">
                            <div class="step-icon-container">
                                <div class="step-icon">
                                    <i class="fas fa-check" id="step2-icon"></i>
                                </div>
                            </div>
                            <div class="step-text" id="step2-text">Disetujui Kaprodi</div>
                            <div class="step-date" id="step2-date">-</div>
                        </div>

                        <!-- Step 3: Disetujui Sekretariat -->
                        <div class="progress-step completed" id="step3">
                            <div class="step-icon-container">
                                <div class="step-icon">
                                    <i class="fas fa-check" id="step3-icon"></i>
                                </div>
                            </div>
                            <div class="step-text" id="step3-text">Disetujui Sekretariat</div>
                            <div class="step-date" id="step3-date">-</div>
                        </div>

                        <!-- Step 4: Disetujui Dekan -->
                        <div class="progress-step completed" id="step4">
                            <div class="step-icon-container">
                                <div class="step-icon">
                                    <i class="fas fa-check" id="step4-icon"></i>
                                </div>
                            </div>
                            <div class="step-text" id="step4-text">Disetujui Dekan</div>
                            <div class="step-date" id="step4-date">-</div>
                        </div>
                    </div>
                </div>

                <div class="status-info">
                    <h5><i class="fas fa-info-circle"></i> Informasi Status:</h5>
                    <p class="status-description">Memuat informasi status...</p>
                    <div class="rejection-reason" style="display: none;">
                        <h6><i class="fas fa-times-circle"></i> Alasan Penolakan:</h6>
                        <p class="rejection-text"></p>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Detail Modal Template -->
    <template id="detailModalTemplate">
        <div class="modal-content-detail">
            <div class="modal-header-detail">
                <span>Detail Surat Pengajuan</span>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body-detail">
                <div class="detail-content"></div>
            </div>
        </div>
    </template>

    <!-- Tambah Dosen Modal Template -->
    <template id="tambahDosenModalTemplate">
        <div class="custom-modal-content" style="max-width: 700px;">
            <div class="custom-modal-header">
                <h3 class="custom-modal-title">
                    <i class="fas fa-user-plus"></i>
                    Tambah Dosen
                </h3>
                <button class="custom-modal-close">&times;</button>
            </div>
            <div class="custom-modal-body">
                <div class="form-group">
                    <label for="inputNipTambah">
                        <i class="fas fa-search"></i> Cari Dosen
                    </label>
                    <div style="position: relative;">
                        <input type="text" class="input-nip-tambah form-control"
                            placeholder="Masukkan NIP atau nama dosen" 
                            autocomplete="off">
                        <div class="autocomplete-results" 
                            style="display: none; 
                                position: absolute; 
                                top: 100%; 
                                left: 0; 
                                right: 0; 
                                background: white; 
                                border: 1px solid #ddd; 
                                border-radius: 8px; 
                                max-height: 200px; 
                                overflow-y: auto; 
                                z-index: 1000; 
                                box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i> 
                        Mulai ketik NIP atau nama dosen. Pilih dosen untuk ditambahkan ke daftar.
                    </small>
                </div>

                <div class="form-group">
                    <label>
                        <i class="fas fa-list"></i> Daftar Dosen yang Akan Ditambahkan
                        <span class="selected-count badge badge-primary" style="margin-left: 10px;">0</span>
                    </label>
                    
                    <div class="selected-dosen-list" style="
                        max-height: 250px;
                        overflow-y: auto;
                        border: 1px solid #dee2e6;
                        border-radius: 8px;
                        padding: 10px;
                        margin-top: 10px;
                        background: #f8f9fa;
                    ">
                        <div class="empty-selection-message" style="
                            text-align: center;
                            padding: 30px;
                            color: #6c757d;
                        ">
                            <i class="fas fa-user-plus" style="font-size: 48px; margin-bottom: 10px;"></i>
                            <p>Belum ada dosen yang dipilih.</p>
                            <small>Pilih dosen dari kolom pencarian di atas.</small>
                        </div>
                    </div>
                    
                    <small class="text-muted" style="display: block; margin-top: 8px;">
                        <i class="fas fa-exclamation-circle"></i> 
                        Maksimal 10 dosen dapat ditambahkan dalam satu kali proses.
                    </small>
                </div>

                <div class="alert alert-info" style="margin: 15px 0;">
                    <i class="fas fa-info-circle"></i>
                    <strong>Informasi:</strong> Anda akan menambahkan dosen ke pengajuan: 
                    <strong class="current-pengajuan-name">-</strong>
                    <br>
                    <small>
                        Saat ini ada <strong class="current-dosen-count">0</strong> dosen dalam pengajuan ini.
                    </small>
                </div>

                <div class="hasil-pencarian" style="margin-top: 15px;"></div>
            </div>
            <div class="custom-modal-footer" style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <button class="btn-cancel btn-clear-all" style="display: none;">
                        <i class="fas fa-trash"></i> Hapus Semua
                    </button>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn-cancel btn-cancel-tambah">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button class="btn-submit btn-tambah-submit" disabled>
                        <i class="fas fa-plus"></i> Tambah <span class="tambah-count">0</span> Dosen
                    </button>
                </div>
            </div>
        </div>
    </template>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
// ===== MULTI MODAL MANAGEMENT SYSTEM =====

// Global variables
let modalStack = [];
let modalZIndex = 1050;
let currentSuratId = null;
let currentDosenList = [];
let selectedDosenList = [];
let currentPengajuanName = '';
let currentDosenCount = 0;
let selectedDosenToDelete = [];
let baseUrl = '<?= site_url() ?>';
let table; // Variabel untuk menyimpan instance DataTable
let newDosenList = []; // Untuk menyimpan dosen yang baru ditambahkan
let removedDosenList = []; // Untuk menyimpan dosen yang baru dihapus

// Modal Manager Class
class ModalManager {
    constructor() {
        this.modals = [];
        this.activeModal = null;
        this.modalStack = document.getElementById('modalStack');
        this.MAX_MODALS = 2; // MAKSIMAL 2 MODAL
    }

    // Create a new modal
    createModal(type, data = {}) {
        // Cek jika sudah mencapai batas maksimal modal
        if (this.modals.length >= this.MAX_MODALS) {
            this.showLimitWarning();
            return null;
        }
        
        const modalId = `modal_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
        const modalItem = document.createElement('div');
        modalItem.className = 'modal-item';
        modalItem.id = modalId;
        modalItem.style.zIndex = modalZIndex++;
        
        // Create modal content based on type
        let modalContent;
        switch(type) {
            case 'dosen':
                modalContent = this.createDosenModal(data);
                break;
            case 'status':
                modalContent = this.createStatusModal(data);
                break;
            case 'detail':
                modalContent = this.createDetailModal(data);
                break;
            case 'preview':
                modalContent = this.createPreviewModal(data);
                break;
            case 'tambahDosen':
                modalContent = this.createTambahDosenModal(data);
                break;
            default:
                modalContent = this.createGenericModal(data);
        }
        
        modalItem.innerHTML = modalContent;
        this.modalStack.appendChild(modalItem);
        
        // Add to modals array
        const modalObj = {
            id: modalId,
            type: type,
            element: modalItem,
            data: data
        };
        
        this.modals.push(modalObj);
        this.setActiveModal(modalId);
        
        // Add modal number badge
        this.addModalNumberBadge(modalItem);
        
        // Update modal positions
        this.updateModalPositions();
        
        // Add event listeners
        this.attachEventListeners(modalItem, modalId);
        
        // Animate appearance
        setTimeout(() => {
            modalItem.classList.add('active', 'new');
            setTimeout(() => modalItem.classList.remove('new'), 300);
        }, 10);
        
        // Update body class
        document.body.classList.add('modal-open');
        
        return modalId;
    }

    // Add modal number badge
    addModalNumberBadge(modalElement) {
        const modalIndex = this.modals.length;
        if (modalIndex <= 0) return;
        
        // Create number badge
        const badge = document.createElement('div');
        badge.className = `modal-number-badge modal-${modalIndex}`;
        badge.textContent = modalIndex;
        badge.style.cssText = `
            position: absolute;
            top: -8px;
            left: -8px;
            background: ${modalIndex === 1 ? '#FB8C00' : '#3498db'};
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 8px;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1055;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            animation: pulse-orange 2s infinite;
        `;
        
        modalElement.appendChild(badge);
    }

    // Update modal number badges
    updateModalNumberBadges() {
        this.modals.forEach((modal, index) => {
            const badge = modal.element.querySelector('.modal-number-badge');
            if (badge) {
                const modalNumber = index + 1;
                badge.textContent = modalNumber;
                badge.className = `modal-number-badge modal-${modalNumber}`;
                badge.style.background = modalNumber === 1 ? '#FB8C00' : '#3498db';
            }
        });
    }

    // Show warning when trying to open more than 2 modals
    showLimitWarning() {
        Swal.fire({
            icon: 'warning',
            title: 'Batas Modal',
            html: `
                <div style="text-align: center; padding: 10px;">
                    <div style="font-size: 48px; color: #FB8C00; margin-bottom: 15px;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <p style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 10px;">
                        Maksimal Hanya 2 Modal yang Dapat Dibuka
                    </p>
                    <p style="color: #6c757d; margin-bottom: 15px;">
                        Anda sudah memiliki ${this.modals.length} modal terbuka.
                        <br>
                        Tutup salah satu modal terlebih dahulu sebelum membuka modal baru.
                    </p>
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-top: 15px;">
                        <p style="margin: 0; font-size: 14px; color: #495057;">
                            <strong>Modal yang sedang aktif:</strong>
                            <br>
                            ${this.modals.map(m => {
                                const typeNames = {
                                    'dosen': 'Detail Dosen',
                                    'status': 'Status Pengajuan',
                                    'detail': 'Detail Surat',
                                    'preview': 'Preview File',
                                    'tambahDosen': 'Tambah Dosen'
                                };
                                return `• ${typeNames[m.type] || 'Modal'}`;
                            }).join('<br>')}
                        </p>
                    </div>
                </div>
            `,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#FB8C00',
            width: 500
        });
    }

    // Update positions of all modals
    updateModalPositions() {
        this.modals.forEach((modal, index) => {
            const modalElement = modal.element;
            
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
                } else if (index === 1) {
                    // Modal kedua di kanan atas
                    modalElement.style.top = '50px';
                    modalElement.style.right = '50px';
                    modalElement.style.left = 'auto';
                }
            }
        });
    }

    // Create dosen modal
    createDosenModal(data) {
        const template = document.getElementById('dosenModalTemplate');
        const content = template.content.cloneNode(true);
        
        // Update content with data
        if (data.kegiatanTitle) {
            content.querySelector('.kegiatan-title').textContent = data.kegiatanTitle;
        }
        
        return content.querySelector('.dosen-modal-content').outerHTML;
    }

    // Create status modal
    createStatusModal(data) {
        const template = document.getElementById('statusModalTemplate');
        const content = template.content.cloneNode(true);
        
        return content.querySelector('.status-content').outerHTML;
    }

    // Create detail modal
    createDetailModal(data) {
        const template = document.getElementById('detailModalTemplate');
        const content = template.content.cloneNode(true);
        
        return content.querySelector('.modal-content-detail').outerHTML;
    }

    // Create preview modal
    createPreviewModal(data) {
        const template = document.getElementById('previewModalTemplate');
        const content = template.content.cloneNode(true);
        
        return content.querySelector('.preview-content').outerHTML;
    }

    // Create tambah dosen modal
    createTambahDosenModal(data) {
        const template = document.getElementById('tambahDosenModalTemplate');
        const content = template.content.cloneNode(true);
        
        // Update content with data
        if (data.pengajuanName) {
            content.querySelector('.current-pengajuan-name').textContent = data.pengajuanName;
        }
        if (data.currentDosenCount !== undefined) {
            content.querySelector('.current-dosen-count').textContent = data.currentDosenCount;
        }
        
        return content.querySelector('.custom-modal-content').outerHTML;
    }

    // Create generic modal
    createGenericModal(data) {
        return `
            <div style="background: white; border-radius: 12px; padding: 20px; min-width: 300px; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                <div style="margin-bottom: 15px; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                    <h3 style="margin: 0;">${data.title || 'Modal'}</h3>
                </div>
                <div class="modal-body">
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
            modal.element.style.zIndex = modalZIndex++;
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
            
            // Update modal number badges
            this.updateModalNumberBadges();
            
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
    attachEventListeners(modalElement, modalId) {
        // Close button untuk dosen modal
        const closeBtnDosen = modalElement.querySelector('.dosen-modal-close');
        if (closeBtnDosen) {
            closeBtnDosen.addEventListener('click', () => this.closeModal(modalId));
        }
        
        // Close button untuk status modal
        const closeBtnStatus = modalElement.querySelector('.close-status');
        if (closeBtnStatus) {
            closeBtnStatus.addEventListener('click', () => this.closeModal(modalId));
        }
        
        // Close button untuk detail modal
        const closeBtnDetail = modalElement.querySelector('.close-modal');
        if (closeBtnDetail) {
            closeBtnDetail.addEventListener('click', () => this.closeModal(modalId));
        }
        
        // Close button untuk preview modal
        const closeBtnPreview = modalElement.querySelector('.preview-close');
        if (closeBtnPreview) {
            closeBtnPreview.addEventListener('click', () => this.closeModal(modalId));
        }
        
        // Close button untuk custom modal
        const closeBtnCustom = modalElement.querySelector('.custom-modal-close');
        if (closeBtnCustom) {
            closeBtnCustom.addEventListener('click', () => this.closeModal(modalId));
        }
        
        // Click on modal to bring to front
        modalElement.addEventListener('mousedown', (e) => {
            if (e.target.closest('button') && e.target.closest('button').classList.contains('modal-close-btn')) return;
            this.setActiveModal(modalId);
        });
        
        // Prevent clicks inside modal from propagating to table
        modalElement.addEventListener('click', (e) => {
            e.stopPropagation();
        });
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

    // Get current modal count
    getModalCount() {
        return this.modals.length;
    }
}

// Initialize modal manager
const modalManager = new ModalManager();

// ===== MODAL FUNCTIONS =====

// Show dosen modal
function showDosenModal(event, dosenList, namaKegiatan, suratId) {
    event.stopPropagation();
    
    // Validasi: hanya tampilkan modal jika ada lebih dari 1 dosen
    if (!dosenList || dosenList.length <= 1) {
        if (dosenList && dosenList.length === 1) {
            const dosen = dosenList[0];
            const initial = (dosen.nama_dosen || '?').charAt(0).toUpperCase();
            const hasFoto = dosen.foto && dosen.foto.trim() !== '';
            
            Swal.fire({
                icon: 'info',
                title: 'Informasi Dosen',
                html: `
                    <div style="text-align: left; padding: 10px;">
                        <div style="margin-bottom: 15px; font-weight: 600; color: #FB8C00;">${namaKegiatan}</div>
                        <div style="display: flex; align-items: center; gap: 15px; background: #f8f9fa; padding: 15px; border-radius: 10px;">
                            <div style="width: 50px; height: 50px; background: #FB8C00; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 20px; overflow: hidden; flex-shrink: 0;">
                                ${hasFoto ? `
                                    <img src="${dosen.foto}" alt="${dosen.nama_dosen}" 
                                         style="width: 100%; height: 100%; object-fit: cover;"
                                         onerror="this.style.display='none'; this.parentElement.innerHTML='${initial}';">
                                ` : initial}
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #212529; font-size: 16px;">${dosen.nama_dosen || '-'}</div>
                                <div style="font-size: 13px; color: #6c757d;">
                                    <div>NIP: ${dosen.nip || '-'}</div>
                                    <div>Jabatan: ${dosen.jabatan || '-'}</div>
                                    <div>Divisi: ${dosen.divisi || '-'}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `,
                showConfirmButton: true,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#FB8C00',
                showCloseButton: true,
                width: 500
            });
        }
        return;
    }

    // Simpan data ke variabel global
    currentSuratId = suratId;
    currentDosenList = dosenList || [];
    currentPengajuanName = namaKegiatan;

    // Create modal
    const modalId = modalManager.createModal('dosen', {
        kegiatanTitle: namaKegiatan || "Kegiatan"
    });

    if (!modalId) return;

    // Get modal element and update content
    const modal = modalManager.getModal(modalId);
    if (modal) {
        updateDosenModalContent(modal.element, dosenList, suratId);
    }
}

// Update dosen modal content
function updateDosenModalContent(modalElement, dosenList, suratId) {
    const container = modalElement.querySelector('.dosen-list-container');
    if (!container) return;
    
    container.innerHTML = "";

    if (dosenList.length === 0) {
        container.innerHTML = `
        <div class="no-dosen">
            <i class="fas fa-user-slash"></i>
            <h4>Tidak Ada Dosen</h4>
            <p>Belum ada dosen yang ditambahkan ke pengajuan ini.</p>
        </div>
    `;
    } else {
        dosenList.forEach((d, index) => {
            const item = document.createElement("div");
            item.className = "dosen-card";
            item.setAttribute('data-index', index);
            item.setAttribute('data-nip', d.nip || '');

            const initial = (d.nama_dosen || "-").charAt(0).toUpperCase();
            const hasFoto = d.foto && d.foto.trim() !== '';
            const isNewDosen = newDosenList.some(newDosen => newDosen.nip === d.nip);
            const isRemovedDosen = removedDosenList.some(removedDosen => removedDosen.nip === d.nip);
            
            if (isNewDosen) {
                item.classList.add('new-dosen');
            } else if (isRemovedDosen) {
                item.classList.add('removed-dosen');
            }

            item.innerHTML = `
            <div class="dosen-avatar" style="position: relative;">
                ${hasFoto ? `
                    <img src="${d.foto}" 
                         alt="${d.nama_dosen}" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    <div class="dosen-avatar-initial" style="display: none;">${initial}</div>
                ` : `
                    <div class="dosen-avatar-initial">${initial}</div>
                `}
                ${isNewDosen ? '<span class="dosen-new-badge">+</span>' : ''}
                ${isRemovedDosen ? '<span class="dosen-removed-badge">-</span>' : ''}
            </div>
            <div class="dosen-card-info">
                <div class="dosen-card-name">${d.nama_dosen || '-'}</div>
                <div class="dosen-card-detail">
                    NIP: ${d.nip || '-'} | 
                    Jabatan: ${d.jabatan || '-'} | 
                    Divisi: ${d.divisi || '-'}
                </div>
            </div>
        `;

            container.appendChild(item);
        });
    }

    // Update total dosen
    const totalCountElement = modalElement.querySelector('.dosen-total-count');
    if (totalCountElement) {
        totalCountElement.innerText = dosenList.length;
    }

    // Update tombol aksi
    const actionButtons = modalElement.querySelector('.dosen-action-buttons');
    if (actionButtons) {
        // Selalu tampilkan tombol aksi jika ada lebih dari 1 dosen
        if (dosenList.length > 1) {
            actionButtons.style.display = 'flex';
            
            // Add event listeners to action buttons
            const tambahBtn = modalElement.querySelector('.btn-tambah-dosen');
            const kurangBtn = modalElement.querySelector('.btn-kurang-dosen');
            
            if (tambahBtn) {
                tambahBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    bukaModalTambah(suratId, dosenList, currentPengajuanName);
                });
            }
            
            if (kurangBtn) {
                kurangBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    bukaModalKurang(suratId, dosenList, currentPengajuanName);
                });
            }
        } else {
            actionButtons.style.display = 'flex';
        }
    }
}

// Show status modal
window.showStatusModal = function(suratId) {
    const modalId = modalManager.createModal('status');
    
    if (!modalId) return;
    
    // Load status data
    loadStatusData(suratId, modalId);
};

// Load status data for modal
function loadStatusData(suratId, modalId) {
    const modal = modalManager.getModal(modalId);
    if (!modal) return;
    
    const modalElement = modal.element;
    
    // Reset status display
    resetAllStatus(modalElement);
    
    // Fetch status data
    fetch(baseUrl + '/surat/get_status/' + suratId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateStatusDisplay(modalElement, data.data);
                updateEstimasiWaktu(modalElement, data.data);
            }
        })
        .catch(error => {
            console.error('Error loading status data:', error);
        });
}

// Reset all status in modal
function resetAllStatus(modalElement) {
    for (let i = 1; i <= 4; i++) {
        const step = modalElement.querySelector(`#step${i}`);
        const icon = modalElement.querySelector(`#step${i}-icon`);
        const text = modalElement.querySelector(`#step${i}-text`);
        const date = modalElement.querySelector(`#step${i}-date`);

        if (step) step.className = 'progress-step pending';
        if (icon) icon.className = 'fas fa-clock';

        const defaultTexts = [
            'Mengirim',
            'Disetujui Kaprodi',
            'Disetujui Sekretariat',
            'Disetujui Dekan'
        ];
        if (text) text.textContent = defaultTexts[i - 1];
        if (date) date.textContent = '-';
    }

    // Reset waktu estimasi
    const estimasiElements = modalElement.querySelectorAll('.step-estimasi');
    estimasiElements.forEach(el => {
        el.textContent = '0 hari 0 jam';
    });

    const progressLine = modalElement.querySelector('.progress-line');
    if (progressLine) progressLine.style.width = '0%';

    const desc = modalElement.querySelector(".status-description");
    if (desc) desc.textContent = "Memuat informasi status...";
}

// Update status display in modal
function updateStatusDisplay(modalElement, statusData) {
    const steps = statusData.steps;

    steps.forEach((step, index) => {
        const stepNumber = index + 1;
        const stepElement = modalElement.querySelector(`#step${stepNumber}`);
        const iconElement = modalElement.querySelector(`#step${stepNumber}-icon`);
        const textElement = modalElement.querySelector(`#step${stepNumber}-text`);
        const dateElement = modalElement.querySelector(`#step${stepNumber}-date`);

        if (!stepElement || !iconElement || !textElement || !dateElement) return;

        stepElement.className = 'progress-step';

        // STATUS WARNA
        switch (step.status) {
            case 'completed':
            case 'approved':
                stepElement.classList.add('completed');
                iconElement.className = 'fas fa-check';
                break;

            case 'rejected':
                stepElement.classList.add('rejected');
                iconElement.className = 'fas fa-times';
                break;

            case 'in-progress':
                stepElement.classList.add('in-progress');
                iconElement.className = 'fas fa-spinner fa-spin';
                break;

            default:
                stepElement.classList.add('pending');
                iconElement.className = 'fas fa-clock';
        }

        textElement.textContent = step.step_name || step.text;
        dateElement.textContent = step.date || '-';
    });

    // Update progress bar panjang
    const progressLine = modalElement.querySelector('.progress-line');
    if (progressLine) {
        progressLine.style.width = (statusData.progress_percentage || 0) + '%';
    }

    // UPDATE INFORMASI STATUS
    const desc = modalElement.querySelector(".status-description");
    const finalStatus = statusData.current_status.toLowerCase();

    if (desc) {
        if (finalStatus === "disetujui dekan") {
            desc.textContent = "Pengajuan ini sudah disetujui.";
            desc.style.color = "green";
        } else if (finalStatus.includes("ditolak")) {
            desc.textContent = "Pengajuan ini tidak disetujui.";
            desc.style.color = "red";
        } else {
            desc.textContent = "Pengajuan ini masih dalam proses persetujuan.";
            desc.style.color = "black";
        }
    }

    // TAMPILKAN ALASAN PENOLAKAN
    const rejectionBox = modalElement.querySelector(".rejection-reason");
    const rejectionText = modalElement.querySelector(".rejection-text");

    if (rejectionBox && rejectionText) {
        if (finalStatus.includes("ditolak")) {
            rejectionBox.style.display = "block";
            rejectionText.textContent = statusData.catatan_penolakan || "Tidak ada catatan penolakan.";
        } else {
            rejectionBox.style.display = "none";
        }
    }
}

// Update estimasi waktu in modal
function updateEstimasiWaktu(modalElement, statusData) {
    const durasi = statusData.durasi || {};
    
    // Format durasi dengan fungsi
    const durasi1 = formatDuration(durasi.durasi_1 || '-');
    const durasi2 = formatDuration(durasi.durasi_2 || '-');
    const durasi3 = formatDuration(durasi.durasi_3 || '-');
    
    // Update waktu estimasi
    const estimasi1 = modalElement.querySelector('.step-estimasi[data-between="1-2"]');
    const estimasi2 = modalElement.querySelector('.step-estimasi[data-between="2-3"]');
    const estimasi3 = modalElement.querySelector('.step-estimasi[data-between="3-4"]');
    
    if (estimasi1 && durasi1 !== '0 menit' && durasi1 !== '-') {
        estimasi1.innerHTML = `<i class="fas fa-clock" style="margin-right: 3px;"></i> ${durasi1}`;
    }
    if (estimasi2 && durasi2 !== '0 menit' && durasi2 !== '-') {
        estimasi2.innerHTML = `<i class="fas fa-clock" style="margin-right: 3px;"></i> ${durasi2}`;
    }
    if (estimasi3 && durasi3 !== '0 menit' && durasi3 !== '-') {
        estimasi3.innerHTML = `<i class="fas fa-clock" style="margin-right: 3px;"></i> ${durasi3}`;
    }
}

// Format duration function
function formatDuration(durationText) {
    if (!durationText || durationText === '-' || durationText === '0 hari 0 jam') {
        return '0 menit';
    }
    
    // Parse durasi dari server
    const daysMatch = durationText.match(/(\d+)\s*hari/);
    const hoursMatch = durationText.match(/(\d+)\s*jam/);
    const minutesMatch = durationText.match(/(\d+)\s*menit/);
    
    const days = daysMatch ? parseInt(daysMatch[1]) : 0;
    const hours = hoursMatch ? parseInt(hoursMatch[1]) : 0;
    const minutes = minutesMatch ? parseInt(minutesMatch[1]) : 0;
    
    // LOGIKA SESUAI PERMINTAAN:
    
    // 1. Jika >= 1 hari, tampilkan hari saja
    if (days >= 1) {
        return days + " hari";
    }
    
    // 2. Jika ada jam (tapi < 1 hari), tampilkan jam dan menit
    if (hours > 0) {
        if (minutes > 0) {
            return hours + " jam " + minutes + " menit";
        } else {
            return hours + " jam";
        }
    }
    
    // 3. Jika < 1 jam, tampilkan menit saja
    if (minutes > 0) {
        return minutes + " menit";
    }
    
    // 4. Default
    return "Kurang dari 1 menit";
}

// Show detail modal
$(document).on('click', '#tabelSurat tbody tr.row-detail', function(e) {
    // Mencegah trigger jika klik di kolom nama dosen
    if ($(e.target).closest('.dosen-container').length) {
        return;
    }

    if ($(e.target).closest('input, a, button').length) return;

    let raw = $(this).attr('data-detail') || '{}';
    let data = {};
    try {
        data = JSON.parse(raw);
    } catch (err) {
        console.error(err);
    }
    
    // Create detail modal
    const modalId = modalManager.createModal('detail');
    
    if (!modalId) return;
    
    const modal = modalManager.getModal(modalId);
    
    if (modal) {
        updateDetailModalContent(modal.element, data);
    }
});

// Update detail modal content
function updateDetailModalContent(modalElement, data) {
    const detailContent = modalElement.querySelector('.detail-content');
    if (!detailContent) return;
    
    // Fungsi untuk menentukan jenis penugasan
    const getJenisPenugasanDisplay = function(data) {
        const jenisPengajuan = data.jenis_pengajuan || 'Perorangan';
        const jenisPenugasanPerorangan = data.jenis_penugasan_perorangan || '-';
        const jenisPenugasanKelompok = data.jenis_penugasan_kelompok || '-';
        const penugasanLainnyaPerorangan = data.penugasan_lainnya_perorangan || '-';
        const penugasanLainnyaKelompok = data.penugasan_lainnya_kelompok || '-';
        
        if (jenisPengajuan === 'Perorangan') {
            if (jenisPenugasanPerorangan === 'Lainnya' && penugasanLainnyaPerorangan !== '-') {
                return penugasanLainnyaPerorangan;
            }
            return jenisPenugasanPerorangan;
        }
        
        if (jenisPengajuan === 'Kelompok') {
            if (jenisPenugasanKelompok === 'Lainnya' && penugasanLainnyaKelompok !== '-') {
                return penugasanLainnyaKelompok;
            }
            return jenisPenugasanKelompok;
        }
        
        return jenisPenugasanPerorangan || jenisPenugasanKelompok || '-';
    };

    // Format tanggal Indonesia
    function formatTanggalIndonesia(dateString) {
        if (!dateString || dateString === '-') return '-';
        
        try {
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString;
            
            const hari = date.getDate();
            const bulan = date.getMonth() + 1;
            const tahun = date.getFullYear();
            
            const namaBulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            
            return `${hari} ${namaBulan[bulan - 1]} ${tahun}`;
        } catch (e) {
            return dateString;
        }
    }

    // Format tanggal kegiatan
    const formatTanggalKegiatan = function(data) {
        // Jika jenis_date adalah Periode
        if (data.jenis_date === 'Periode') {
            const periodeValue = data.periode_value || '-';
            return `<span class="badge" style="background: #e3f2fd; color: #1976d2; padding: 6px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                <i class="fas fa-calendar-alt"></i> ${escapeHtml(periodeValue)}
            </span>`;
        }
        
        // Jika jenis_date adalah Custom atau Single Date
        const tanggalAwal = data.tanggal_kegiatan || data.tanggal_awal_kegiatan || '-';
        const tanggalAkhir = data.akhir_kegiatan || '-';
        
        // Format tanggal awal
        const formattedAwal = formatTanggalIndonesia(tanggalAwal);
        
        // Jika ada tanggal akhir dan berbeda dari tanggal awal
        if (tanggalAkhir && tanggalAkhir !== '-' && tanggalAkhir !== tanggalAwal) {
            const formattedAkhir = formatTanggalIndonesia(tanggalAkhir);
            return `${escapeHtml(formattedAwal)} - ${escapeHtml(formattedAkhir)}`;
        }
        
        // Jika hanya ada tanggal awal (single date)
        return escapeHtml(formattedAwal);
    };

    let html = `
        <div class="detail-section">
            <div class="detail-section-title">
                <i class="fas fa-info-circle"></i>
                Informasi Kegiatan
            </div>
              <div class="detail-row">
                <div class="detail-label">Status</div>
                <div class="detail-value">${escapeHtml(data.status || '-')}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Nama Kegiatan</div>
                <div class="detail-value">${escapeHtml(data.nama_kegiatan || '-')}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Tanggal Kegiatan</div>
                <div class="detail-value">${formatTanggalKegiatan(data)}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Jenis Tanggal</div>
                <div class="detail-value">${escapeHtml(data.jenis_date || '-')}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Tempat Kegiatan</div>
                <div class="detail-value">${escapeHtml(data.tempat_kegiatan || '-')}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Penyelenggara</div>
                <div class="detail-value">${escapeHtml(data.penyelenggara || '-')}</div>
            </div>
        </div>

        <div class="detail-section">
            <div class="detail-section-title">
                <i class="fas fa-users"></i>
                Informasi Pengajuan
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Jenis Pengajuan</div>
                <div class="detail-value">${escapeHtml(data.jenis_pengajuan || '-')}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Status Kepegawaian</div>
                <div class="detail-value">${escapeHtml(data.lingkup_penugasan || '-')}</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Jenis Penugasan</div>
                <div class="detail-value">${escapeHtml(getJenisPenugasanDisplay(data))}</div>
            </div>  
        </div>
    `;

    // === Dosen Section ===
    if (data.nama_dosen && Array.isArray(data.nama_dosen) && data.nama_dosen.length > 0) {
        html += `
        <div class="detail-section">
            <div class="detail-section-title">
                <i class="fas fa-user-graduate"></i>
                Dosen Terkait
            </div>
            <div class="dosen-list">
        `;

        data.nama_dosen.forEach((nama, index) => {
            const nip = (data.nip && data.nip[index]) ? data.nip[index] : '-';
            const jabatan = (data.jabatan && data.jabatan[index]) ? data.jabatan[index] : '-';
            const divisi = (data.divisi && data.divisi[index]) ? data.divisi[index] : '-';
            const foto = (data.foto && data.foto[index]) ? data.foto[index] : '';
            
            const hasFoto = foto && foto.trim() !== '' && foto !== 'null';

            html += `
            <div class="dosen-item-detail">
                <div class="dosen-avatar" style="width: 40px; height: 40px; background: #ff9800; border-radius: 50%; overflow: hidden; position: relative; flex-shrink: 0;">
                    ${hasFoto ? `
                        <img src="${escapeHtml(foto)}" 
                             alt="${escapeHtml(nama)}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    ` : ''}
                </div>
                <div class="dosen-info">
                    <div class="dosen-name-detail">${escapeHtml(nama)}</div>
                    <div class="dosen-details-detail">
                        NIP: ${escapeHtml(nip)} | Jabatan: ${escapeHtml(jabatan)} | Divisi: ${escapeHtml(divisi)}
                    </div>
                </div>
            </div>
            `;
        });

        html += `</div></div>`;
    }

    // === File Evidence Section ===
    if (data.eviden && Array.isArray(data.eviden) && data.eviden.length > 0) {
        html += `
        <div class="detail-section">
            <div class="detail-section-title">
                <i class="fas fa-file-alt"></i>
                File Evidence (${data.eviden.length} file)
            </div>
            <div class="file-list">
        `;

        data.eviden.forEach((file, index) => {
            const fileName = getFileName(file);
            const fileUrl = getFileUrl(file);
            const fileIcon = getFileIcon(fileName);
            const fileType = getPreviewableFileType(fileName);
            const canPreview = fileType !== 'unknown';
            const fileExt = fileName.split('.').pop().toUpperCase() || 'FILE';

            html += `
            <div class="file-item">
                <div class="${fileIcon}"></div>
                <div class="file-info">
                    <div class="file-name" title="${escapeHtml(fileName)}">${escapeHtml(fileName)}</div>
                    <div class="file-details">
                        <span class="file-type">${fileExt}</span>
                        <span class="file-size">File ${index + 1}</span>
                    </div>
                </div>
                <div class="file-actions">
                    ${canPreview ? `
                        <button class="preview-btn" onclick="previewFileInModal('${escapeHtml(fileUrl)}', '${escapeHtml(fileName)}', '${fileType}')">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                    ` : `
                        <button class="preview-btn disabled" disabled title="Preview tidak tersedia untuk file ini">
                            <i class="fas fa-eye-slash"></i> Preview
                        </button>
                    `}
                </div>
            </div>
        `;
        });

        html += `</div></div>`;
    } else {
        // Tampilkan pesan jika tidak ada file
        html += `
        <div class="detail-section">
            <div class="detail-section-title">
                <i class="fas fa-file-alt"></i>
                File Evidence
            </div>
            <div class="no-files">
                <i class="fas fa-file-exclamation"></i>
                <h4>Tidak Ada File Evidence</h4>
                <p>Belum ada file yang diupload untuk pengajuan ini.</p>
            </div>
        </div>
        `;
    }

    detailContent.innerHTML = html;
}

// Helper functions for file handling
function getFileName(file) {
    if (typeof file === 'string') {
        return file.split('/').pop().split('?')[0] || 'File';
    } else if (typeof file === 'object' && file !== null) {
        return file.name || file.nama_asli || (file.url ? file.url.split('/').pop().split('?')[0] : 'File');
    }
    return 'File';
}

function getFileUrl(file) {
    const BASE_URL = '<?= rtrim(base_url(), "/"); ?>';
    let url = '';

    if (typeof file === 'string') {
        url = BASE_URL + '/uploads/eviden/' + file;
        return url;
    }

    if (typeof file === 'object' && file !== null) {
        url = file.cdnUrl || file.url || file.path || '';
    }

    if (url && !url.match(/^https?:\/\//i) && !url.startsWith('data:')) {
        url = BASE_URL + (url.startsWith('/') ? '' : '/') + url;
    }

    return url;
}

function getFileIcon(filename) {
    if (!filename) return 'fas fa-file file-icon-unknown';

    const ext = filename.split('.').pop().toLowerCase();
    const iconMap = {
        'pdf': 'fas fa-file-pdf file-icon-pdf',
        'jpg': 'fas fa-file-image file-icon-image',
        'jpeg': 'fas fa-file-image file-icon-image',
        'png': 'fas fa-file-image file-icon-image',
        'gif': 'fas fa-file-image file-icon-image',
        'bmp': 'fas fa-file-image file-icon-image',
        'webp': 'fas fa-file-image file-icon-image',
        'svg': 'fas fa-file-image file-icon-image',
        'doc': 'fas fa-file-word file-icon-doc',
        'docx': 'fas fa-file-word file-icon-doc',
        'xls': 'fas fa-file-excel file-icon-xls',
        'xlsx': 'fas fa-file-excel file-icon-xls',
        'ppt': 'fas fa-file-powerpoint file-icon-ppt',
        'pptx': 'fas fa-file-powerpoint file-icon-ppt',
        'zip': 'fas fa-file-archive file-icon-zip',
        'rar': 'fas fa-file-archive file-icon-zip',
        '7z': 'fas fa-file-archive file-icon-zip',
        'tar': 'fas fa-file-archive file-icon-zip',
        'gz': 'fas fa-file-archive file-icon-zip'
    };

    return iconMap[ext] || 'fas fa-file file-icon-unknown';
}

function getPreviewableFileType(filename) {
    if (!filename) return 'unknown';

    const ext = filename.split('.').pop().toLowerCase();
    const imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
    const documentTypes = ['pdf'];

    if (imageTypes.includes(ext)) return 'image';
    if (documentTypes.includes(ext)) return 'document';
    return 'unknown';
}

// Preview file in modal
window.previewFileInModal = function(fileUrl, fileName, fileType) {
    const modalId = modalManager.createModal('preview', {
        title: `Preview: ${fileName}`
    });
    
    if (!modalId) return;
    
    const modal = modalManager.getModal(modalId);
    if (!modal) return;
    
    const modalElement = modal.element;
    const previewBody = modalElement.querySelector('.preview-body');
    const previewTitle = modalElement.querySelector('.preview-title');
    
    if (previewTitle) previewTitle.textContent = `Preview: ${fileName}`;
    
    if (previewBody) {
        previewBody.innerHTML = `
            <div style="text-align: center; padding: 40px;">
                <i class="fas fa-spinner fa-spin" style="font-size: 48px; color: #FB8C00;"></i>
                <p style="margin-top: 15px; color: #6c757d;">Memuat preview...</p>
            </div>
        `;
        
        setTimeout(() => {
            if (fileType === 'image') {
                const img = new Image();
                img.onload = function() {
                    previewBody.innerHTML = `<img src="${fileUrl}" class="preview-image" alt="${fileName}">`;
                };
                img.onerror = function() {
                    showUnsupportedPreview(previewBody, fileUrl, fileName);
                };
                img.src = fileUrl;
            } else if (fileType === 'document') {
                previewBody.innerHTML = `
                    <iframe 
                        src="${fileUrl}" 
                        class="preview-iframe" 
                        frameborder="0"
                        onload="this.style.visibility='visible'"
                        onerror="this.style.visibility='hidden'; document.getElementById('pdf-fallback').style.display='block'"
                    ></iframe>
                    <div id="pdf-fallback" style="display: none;">
                        ${showUnsupportedPreview(previewBody, fileUrl, fileName)}
                    </div>
                `;
            } else {
                showUnsupportedPreview(previewBody, fileUrl, fileName);
            }
        }, 100);
    }
};

function showUnsupportedPreview(previewBody, fileUrl, fileName) {
    return `
        <div class="preview-unsupported">
            <i class="fas fa-eye-slash"></i>
            <h4>Preview Tidak Tersedia</h4>
            <p>File "${escapeHtml(fileName)}" tidak dapat dipreview di browser.</p>
            <p style="font-size: 14px; color: #6c757d; margin-top: 10px;">
                Silakan download file untuk melihat isinya.
            </p>
            <a href="${fileUrl}" class="download-btn" download="${fileName}" target="_blank" style="margin-top: 15px;">
                <i class="fas fa-download"></i> Download File
            </a>
        </div>
    `;
}

// Buka modal tambah dosen
function bukaModalTambah(suratId, dosenList, pengajuanName) {
    const modalId = modalManager.createModal('tambahDosen', {
        pengajuanName: pengajuanName,
        currentDosenCount: dosenList ? dosenList.length : 0
    });
    
    if (!modalId) return;
    
    // Setup autocomplete and other functionality
    const modal = modalManager.getModal(modalId);
    if (modal) {
        setupTambahDosenModal(modal.element, suratId, dosenList, pengajuanName);
    }
}

// Setup tambah dosen modal
function setupTambahDosenModal(modalElement, suratId, dosenList, pengajuanName) {
    // Reset selected dosen list
    selectedDosenList = [];
    
    // Update modal data
    const currentPengajuanNameEl = modalElement.querySelector('.current-pengajuan-name');
    const currentDosenCountEl = modalElement.querySelector('.current-dosen-count');
    
    if (currentPengajuanNameEl) currentPengajuanNameEl.textContent = pengajuanName;
    if (currentDosenCountEl) currentDosenCountEl.textContent = dosenList ? dosenList.length : 0;
    
    // Update selected dosen list display
    updateSelectedDosenListInModal(modalElement);
    
    // Setup autocomplete
    setupAutocompleteInModal(modalElement, suratId, dosenList);
    
    // Setup event listeners
    const cancelBtn = modalElement.querySelector('.btn-cancel-tambah');
    const submitBtn = modalElement.querySelector('.btn-tambah-submit');
    const clearAllBtn = modalElement.querySelector('.btn-clear-all');
    
    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            modalManager.closeModal(modalElement.closest('.modal-item').id);
        });
    }
    
    if (submitBtn) {
        submitBtn.addEventListener('click', () => {
            prosesTambahMultipleDosenInModal(modalElement, suratId, dosenList);
        });
    }
    
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', () => {
            hapusSemuaDosenInModal(modalElement);
        });
    }
    
    // Focus on search input
    setTimeout(() => {
        const searchInput = modalElement.querySelector('.input-nip-tambah');
        if (searchInput) searchInput.focus();
    }, 100);
}

// Update selected dosen list in modal
function updateSelectedDosenListInModal(modalElement) {
    const container = modalElement.querySelector('.selected-dosen-list');
    const emptyMessage = modalElement.querySelector('.empty-selection-message');
    const selectedCount = modalElement.querySelector('.selected-count');
    const tambahCount = modalElement.querySelector('.tambah-count');
    const clearAllBtn = modalElement.querySelector('.btn-clear-all');
    const submitBtn = modalElement.querySelector('.btn-tambah-submit');
    
    if (!container) return;
    
    // Update count
    if (selectedCount) selectedCount.textContent = selectedDosenList.length;
    if (tambahCount) tambahCount.textContent = selectedDosenList.length;
    
    // Toggle empty message
    if (selectedDosenList.length === 0) {
        if (emptyMessage) emptyMessage.style.display = 'block';
        if (clearAllBtn) clearAllBtn.style.display = 'none';
        if (submitBtn) submitBtn.disabled = true;
        
        container.innerHTML = '';
        if (emptyMessage) container.appendChild(emptyMessage);
        return;
    }
    
    if (emptyMessage) emptyMessage.style.display = 'none';
    if (clearAllBtn) clearAllBtn.style.display = 'inline-flex';
    if (submitBtn) submitBtn.disabled = false;
    
    // Clear container
    container.innerHTML = '';
    
    // Create list of selected dosen
    selectedDosenList.forEach((dosen, index) => {
        const item = document.createElement('div');
        item.className = 'selected-dosen-item';
        item.style.cssText = `
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.2s;
        `;
        
        const initial = (dosen.nama_dosen || '?').charAt(0).toUpperCase();
        const foto = dosen.foto || '';
        const hasFoto = foto && foto.trim() !== '' && foto !== 'null';
        
        item.innerHTML = `
            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #FB8C00 0%, #FF9800 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 16px; overflow: hidden; flex-shrink: 0; position: relative;">
                ${hasFoto ? `
                    <img src="${escapeHtml(foto)}" 
                         alt="${escapeHtml(dosen.nama_dosen)}" 
                         style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;"
                         onerror="console.error('Image load error:', this.src); this.style.display='none';">
                    <span style="position: relative; z-index: 1;">${initial}</span>
                ` : `
                    <span style="position: relative; z-index: 1;">${initial}</span>
                `}
            </div>
            <div style="flex: 1; min-width: 0;">
                <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    ${escapeHtml(dosen.nama_dosen || '-')}
                </div>
                <div style="font-size: 12px; color: #6c757d; display: flex; flex-wrap: wrap; gap: 10px;">
                    <span><i class="fas fa-id-card"></i> ${escapeHtml(dosen.nip || '-')}</span>
                    <span><i class="fas fa-briefcase"></i> ${escapeHtml(dosen.jabatan || '-')}</span>
                    <span><i class="fas fa-building"></i> ${escapeHtml(dosen.divisi || '-')}</span>
                </div>
            </div>
            <button type="button" onclick="hapusDosenDariListInModal(${index}, '${modalElement.closest('.modal-item').id}')" style="
                background: #dc3545;
                color: white;
                border: none;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                flex-shrink: 0;
                transition: background 0.2s;
            ">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.appendChild(item);
    });
}

// Hapus dosen dari list in modal
window.hapusDosenDariListInModal = function(index, modalId) {
    if (index >= 0 && index < selectedDosenList.length) {
        const dosen = selectedDosenList[index];
        selectedDosenList.splice(index, 1);
        
        const modal = modalManager.getModal(modalId);
        if (modal) {
            updateSelectedDosenListInModal(modal.element);
        }
    }
};

// Hapus semua dosen in modal
function hapusSemuaDosenInModal(modalElement) {
    if (selectedDosenList.length === 0) return;
    
    Swal.fire({
        title: 'Hapus Semua Dosen?',
        html: `
            <div style="text-align: center;">
                <div style="color: #dc3545; font-size: 48px; margin-bottom: 15px;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p>Anda akan menghapus <strong>${selectedDosenList.length} dosen</strong> dari daftar.</p>
                <p style="font-size: 14px; color: #6c757d;">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus Semua',
        cancelButtonText: 'Batal',
        width: 500
    }).then((result) => {
        if (result.isConfirmed) {
            selectedDosenList = [];
            updateSelectedDosenListInModal(modalElement);
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Semua dosen telah dihapus dari daftar',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}

// Setup autocomplete in modal
function setupAutocompleteInModal(modalElement, suratId, currentDosenList) {
    const input = modalElement.querySelector('.input-nip-tambah');
    const resultsContainer = modalElement.querySelector('.autocomplete-results');
    
    if (!input || !resultsContainer) return;
    
    let selectedIndex = -1;
    let currentResults = [];
    
    input.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        
        if (query.length < 2) {
            resultsContainer.style.display = 'none';
            return;
        }
        
        fetch(baseUrl + '/surat/autocomplete_dosen?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                if (data.success && data.results && data.results.length > 0) {
                    currentResults = data.results;
                    displayAutocompleteResultsInModal(resultsContainer, data.results, currentDosenList);
                } else {
                    resultsContainer.style.display = 'none';
                    currentResults = [];
                    
                    resultsContainer.innerHTML = `
                        <div style="padding: 15px; text-align: center; color: #6c757d;">
                            <i class="fas fa-search"></i>
                            <div style="margin-top: 5px;">Tidak ditemukan dosen yang cocok</div>
                        </div>
                    `;
                    resultsContainer.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Autocomplete error:', error);
                resultsContainer.style.display = 'none';
            });
    });
    
    function displayAutocompleteResultsInModal(container, results, currentDosenList) {
        container.innerHTML = '';
        
        // Filter out dosen yang sudah ada di pengajuan
        const filteredResults = results.filter(dosen => 
            !currentDosenList.some(current => current.nip === dosen.nip) &&
            !selectedDosenList.some(selected => selected.nip === dosen.nip)
        );
        
        if (filteredResults.length === 0) {
            container.innerHTML = `
                <div style="padding: 15px; text-align: center; color: #6c757d;">
                    <i class="fas fa-check-circle"></i>
                    <div style="margin-top: 5px;">Semua dosen yang cocok sudah dipilih atau sudah ada</div>
                </div>
            `;
            container.style.display = 'block';
            return;
        }
        
        filteredResults.forEach((dosen, index) => {
            const item = document.createElement('div');
            item.className = 'autocomplete-item';
            item.style.cssText = 'padding: 10px 15px; cursor: pointer; border-bottom: 1px solid #eee; transition: background 0.2s;';
            item.dataset.index = index;
            
            const initial = (dosen.nama_dosen || '?').charAt(0).toUpperCase();
            const hasFoto = dosen.foto && dosen.foto.trim() !== '';
            
            item.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div class="dosen-avatar-auto">
                        ${hasFoto ? `
                            <img src="${escapeHtml(dosen.foto)}" 
                                 alt="${escapeHtml(dosen.nama_dosen)}" 
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="dosen-avatar-initial" style="display: none;">${initial}</div>
                        ` : `
                            <div class="dosen-avatar-initial">${initial}</div>
                        `}
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; color: #333;">${escapeHtml(dosen.nama_dosen || '-')}</div>
                        <div style="font-size: 12px; color: #666;">
                            NIP: ${escapeHtml(dosen.nip || '-')} | 
                            ${escapeHtml(dosen.jabatan || '-')}
                        </div>
                    </div>
                    <div style="color: #28a745; font-size: 12px;">
                        <i class="fas fa-plus-circle"></i> Pilih
                    </div>
                </div>
            `;
            
            item.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
            
            item.addEventListener('click', function() {
                selectDosenFromAutocompleteInModal(dosen, modalElement);
                input.value = '';
                input.focus();
                resultsContainer.style.display = 'none';
            });
            
            container.appendChild(item);
        });
        
        container.style.display = 'block';
    }
    
    function selectDosenFromAutocompleteInModal(dosen, modalElement) {
        if (selectedDosenList.length >= 10) {
            Swal.fire({
                icon: 'warning',
                title: 'Batas Maksimum',
                text: 'Maksimal 10 dosen dapat ditambahkan dalam satu kali proses.',
                confirmButtonColor: '#FB8C00'
            });
            return;
        }
        
        if (selectedDosenList.some(d => d.nip === dosen.nip)) {
            Swal.fire({
                icon: 'info',
                title: 'Dosen Sudah Dipilih',
                text: 'Dosen ini sudah ada dalam daftar yang akan ditambahkan.',
                confirmButtonColor: '#FB8C00'
            });
            return;
        }
        
        selectedDosenList.push(dosen);
        updateSelectedDosenListInModal(modalElement);
    }
    
    // Close autocomplete when clicking outside
    document.addEventListener('click', function(e) {
        if (!input.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.style.display = 'none';
            selectedIndex = -1;
        }
    });
}

// Proses tambah multiple dosen in modal
function prosesTambahMultipleDosenInModal(modalElement, suratId, currentDosenList) {
    if (selectedDosenList.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Tidak ada dosen yang dipilih',
            confirmButtonColor: '#FB8C00'
        });
        return;
    }
    
    // Cek apakah ada dosen duplikat
    const existingNips = currentDosenList.map(d => d.nip);
    const duplicateDosen = selectedDosenList.filter(d => 
        existingNips.includes(d.nip)
    );
    
    if (duplicateDosen.length > 0) {
        const names = duplicateDosen.map(d => d.nama_dosen).join(', ');
        Swal.fire({
            icon: 'warning',
            title: 'Dosen Sudah Ada',
            html: `
                <p>Berikut dosen sudah ada dalam pengajuan:</p>
                <div style="background: #fff3cd; padding: 10px; border-radius: 5px; margin: 10px 0;">
                    <strong>${names}</strong>
                </div>
                <p>Dosen duplikat akan dilewati.</p>
                <p style="font-size: 14px; color: #6c757d;">
                    <i class="fas fa-info-circle"></i> 
                    Dosen lainnya akan tetap ditambahkan.
                </p>
            `,
            showCancelButton: true,
            confirmButtonText: 'Lanjutkan Tambah',
            cancelButtonText: 'Periksa Ulang',
            confirmButtonColor: '#FB8C00'
        }).then((result) => {
            if (result.isConfirmed) {
                const filteredDosen = selectedDosenList.filter(d => 
                    !existingNips.includes(d.nip)
                );
                doTambahMultipleDosenInModal(modalElement, suratId, filteredDosen);
            }
        });
        return;
    }
    
    doTambahMultipleDosenInModal(modalElement, suratId, selectedDosenList);
}

function doTambahMultipleDosenInModal(modalElement, suratId, dosenToAdd) {
    if (dosenToAdd.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Tidak Ada yang Baru',
            text: 'Semua dosen yang dipilih sudah ada dalam pengajuan.',
            confirmButtonColor: '#FB8C00'
        });
        return;
    }
    
    Swal.fire({
        title: 'Menambahkan Dosen...',
        html: `
            <div style="text-align: center;">
                <div style="font-size: 14px; color: #6c757d; margin-bottom: 10px;">
                    Menambahkan <strong>${dosenToAdd.length}</strong> dosen
                </div>
                <div style="width: 100%; background: #e9ecef; border-radius: 10px; height: 10px;">
                    <div id="progressBar" style="width: 0%; height: 100%; background: #FB8C00; border-radius: 10px; transition: width 0.3s;"></div>
                </div>
                <div style="margin-top: 15px; font-size: 12px; color: #6c757d;">
                    <i class="fas fa-sync fa-spin"></i> Sedang memproses...
                </div>
            </div>
        `,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            updateProgressBar(0);
        }
    });
    
    const nipList = dosenToAdd.map(d => d.nip);
    const formData = new FormData();
    formData.append('surat_id', suratId);
    formData.append('nip_list', JSON.stringify(nipList));
    
    fetch(baseUrl + '/surat/tambah_banyak_dosen', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateProgressBar(100);
            Swal.close();
            
            // Update data di tabel secara langsung tanpa refresh
            updateTableDataAfterDosenChange(suratId, 'tambah', dosenToAdd);
            
            // Close modal
            const modalId = modalElement.closest('.modal-item').id;
            modalManager.closeModal(modalId);
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: `${dosenToAdd.length} dosen berhasil ditambahkan`,
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: data.message || 'Terjadi kesalahan saat menambahkan dosen',
                confirmButtonColor: '#FB8C00'
            });
        }
    })
    .catch(error => {
        console.error('Error batch:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan: ' + error.message,
            confirmButtonColor: '#FB8C00'
        });
    });
    
    function updateProgressBar(percent) {
        const progressBar = document.getElementById('progressBar');
        if (progressBar) {
            progressBar.style.width = percent + '%';
        }
    }
}

// Buka modal kurang dosen
function bukaModalKurang(suratId, dosenList, pengajuanName) {
    if (dosenList.length <= 1) {
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Dapat Mengurangi',
            text: 'Minimal harus ada 1 dosen dalam pengajuan. Tidak dapat mengurangi dosen.',
            confirmButtonColor: '#FB8C00'
        });
        return;
    }
    
    const modalId = modalManager.createModal('tambahDosen', {
        pengajuanName: pengajuanName,
        currentDosenCount: dosenList ? dosenList.length : 0
    });
    
    if (!modalId) return;
    
    // Setup kurang dosen functionality
    const modal = modalManager.getModal(modalId);
    if (modal) {
        setupKurangDosenModal(modal.element, suratId, dosenList, pengajuanName);
    }
}

// Setup kurang dosen modal
function setupKurangDosenModal(modalElement, suratId, dosenList, pengajuanName) {
    // Update modal untuk mode kurang dosen
    const modalTitle = modalElement.querySelector('.custom-modal-title');
    const modalBody = modalElement.querySelector('.custom-modal-body');
    const modalFooter = modalElement.querySelector('.custom-modal-footer');
    
    if (modalTitle) {
        modalTitle.innerHTML = '<i class="fas fa-user-minus"></i> Kurangi Dosen';
    }
    
    if (modalBody) {
        // Update alert info
        const alertInfo = modalBody.querySelector('.alert-info');
        if (alertInfo) {
            alertInfo.innerHTML = `
                <i class="fas fa-info-circle"></i>
                <strong>Informasi:</strong> Anda akan mengurangi dosen dari pengajuan: 
                <strong class="current-pengajuan-name">${pengajuanName}</strong>
                <br>
                <small>
                    Saat ini ada <strong class="current-dosen-count">${dosenList.length}</strong> dosen dalam pengajuan ini.
                    <br>
                    Pilih dosen yang akan dihapus dari daftar. Minimal harus ada 1 dosen tersisa.
                </small>
            `;
        }
        
        // Update label
        const formGroup = modalBody.querySelectorAll('.form-group')[1];
        if (formGroup) {
            const label = formGroup.querySelector('label');
            if (label) {
                label.innerHTML = '<i class="fas fa-list"></i> Pilih Dosen yang Akan Dihapus';
            }
        }
    }
    
    if (modalFooter) {
        const submitBtn = modalFooter.querySelector('.btn-tambah-submit');
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus Dosen Terpilih';
            submitBtn.className = 'btn-delete btn-tambah-submit';
        }
    }
    
    // Setup checklist untuk memilih dosen yang akan dihapus
    setupKurangDosenChecklist(modalElement, dosenList, suratId);
    
    // Update event listeners
    const cancelBtn = modalElement.querySelector('.btn-cancel-tambah');
    const submitBtn = modalElement.querySelector('.btn-tambah-submit');
    const clearAllBtn = modalElement.querySelector('.btn-clear-all');
    
    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            modalManager.closeModal(modalElement.closest('.modal-item').id);
        });
    }
    
    if (submitBtn) {
        submitBtn.addEventListener('click', () => {
            prosesHapusMultipleDosenInModal(modalElement, suratId, dosenList);
        });
    }
    
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', () => {
            hapusSemuaDosenPilihanInModal(modalElement);
        });
    }
    
    // Focus on search input
    setTimeout(() => {
        const searchInput = modalElement.querySelector('.input-nip-tambah');
        if (searchInput) searchInput.focus();
    }, 100);
}

// Setup checklist untuk kurang dosen
function setupKurangDosenChecklist(modalElement, dosenList, suratId) {
    const container = modalElement.querySelector('.selected-dosen-list');
    const emptyMessage = modalElement.querySelector('.empty-selection-message');
    
    if (!container) return;
    
    // Clear container
    container.innerHTML = '';
    
    // Filter dosen yang bisa dihapus (semua kecuali dosen pertama)
    const dosenBisaDihapus = dosenList.slice(1);
    
    if (dosenBisaDihapus.length === 0) {
        container.innerHTML = `
            <div class="empty-selection-message" style="
                text-align: center;
                padding: 30px;
                color: #6c757d;
            ">
                <i class="fas fa-user-slash" style="font-size: 48px; margin-bottom: 10px;"></i>
                <p>Tidak ada dosen yang dapat dihapus.</p>
                <small>Minimal harus ada 1 dosen tersisa dalam pengajuan.</small>
            </div>
        `;
        return;
    }
    
    // Create checklist items
    dosenBisaDihapus.forEach((dosen, index) => {
        const item = document.createElement('div');
        item.className = 'dosen-item-hapus';
        item.dataset.nip = dosen.nip;
        
        const initial = (dosen.nama_dosen || "?").charAt(0).toUpperCase();
        const hasFoto = dosen.foto && dosen.foto.trim() !== '';
        
        item.innerHTML = `
            <input type="checkbox" class="checkbox-hapus" data-nip="${dosen.nip}" data-index="${index}">
            <div class="dosen-avatar-hapus">
                ${hasFoto ? `
                    <img src="${escapeHtml(dosen.foto)}" 
                         alt="${escapeHtml(dosen.nama_dosen)}" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                         style="width: 100%; height: 100%; object-fit: cover;">
                    <div class="dosen-avatar-initial" style="display: none;">${initial}</div>
                ` : `
                    <div class="dosen-avatar-initial">${initial}</div>
                `}
            </div>
            <div class="dosen-info-hapus">
                <div class="dosen-nama-hapus">${escapeHtml(dosen.nama_dosen || '-')}</div>
                <div class="dosen-detail-hapus">
                    NIP: ${escapeHtml(dosen.nip || '-')} | 
                    Jabatan: ${escapeHtml(dosen.jabatan || '-')} | 
                    Divisi: ${escapeHtml(dosen.divisi || '-')}
                </div>
            </div>
        `;
        
        container.appendChild(item);
    });
    
    // Update selected count
    updateSelectedHapusCount(modalElement);
    
    // Add event listeners to checkboxes
    const checkboxes = container.querySelectorAll('.checkbox-hapus');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            updateSelectedHapusCount(modalElement);
        });
    });
}

// Update selected hapus count
function updateSelectedHapusCount(modalElement) {
    const container = modalElement.querySelector('.selected-dosen-list');
    const emptyMessage = modalElement.querySelector('.empty-selection-message');
    const selectedCount = modalElement.querySelector('.selected-count');
    const tambahCount = modalElement.querySelector('.tambah-count');
    const clearAllBtn = modalElement.querySelector('.btn-clear-all');
    const submitBtn = modalElement.querySelector('.btn-tambah-submit');
    
    if (!container) return;
    
    const checkboxes = container.querySelectorAll('.checkbox-hapus:checked');
    const selectedCountValue = checkboxes.length;
    
    // Update count
    if (selectedCount) selectedCount.textContent = selectedCountValue;
    if (tambahCount) tambahCount.textContent = selectedCountValue;
    
    // Toggle empty message
    if (checkboxes.length === 0) {
        if (emptyMessage) emptyMessage.style.display = 'block';
        if (clearAllBtn) clearAllBtn.style.display = 'none';
        if (submitBtn) submitBtn.disabled = true;
    } else {
        if (emptyMessage) emptyMessage.style.display = 'none';
        if (clearAllBtn) clearAllBtn.style.display = 'inline-flex';
        if (submitBtn) submitBtn.disabled = false;
    }
}

// Hapus semua dosen pilihan in modal
function hapusSemuaDosenPilihanInModal(modalElement) {
    const container = modalElement.querySelector('.selected-dosen-list');
    if (!container) return;
    
    const checkboxes = container.querySelectorAll('.checkbox-hapus');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    
    updateSelectedHapusCount(modalElement);
}

// Proses hapus multiple dosen in modal
function prosesHapusMultipleDosenInModal(modalElement, suratId, currentDosenList) {
    const container = modalElement.querySelector('.selected-dosen-list');
    if (!container) return;
    
    const checkboxes = container.querySelectorAll('.checkbox-hapus:checked');
    if (checkboxes.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Tidak ada dosen yang dipilih',
            confirmButtonColor: '#FB8C00'
        });
        return;
    }
    
    const nipList = Array.from(checkboxes).map(checkbox => checkbox.dataset.nip);
    
    // Cek apakah masih ada dosen tersisa setelah penghapusan
    const remainingDosen = currentDosenList.filter(dosen => !nipList.includes(dosen.nip));
    
    if (remainingDosen.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Dapat Menghapus',
            text: 'Setelah penghapusan, tidak akan ada dosen tersisa. Minimal harus ada 1 dosen dalam pengajuan.',
            confirmButtonColor: '#FB8C00'
        });
        return;
    }
    
    Swal.fire({
        title: 'Konfirmasi Penghapusan',
        html: `
            <div style="text-align: center;">
                <div style="color: #dc3545; font-size: 48px; margin-bottom: 15px;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p>Anda akan menghapus <strong>${nipList.length} dosen</strong> dari pengajuan.</p>
                <p style="font-size: 14px; color: #6c757d;">
                    Setelah penghapusan, akan tersisa <strong>${remainingDosen.length} dosen</strong>.
                </p>
                <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; margin-top: 15px;">
                    <p style="margin: 0; font-size: 13px;"><strong>Perhatian:</strong> Tindakan ini tidak dapat dibatalkan!</p>
                </div>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus Sekarang',
        cancelButtonText: 'Batal',
        width: 500
    }).then((result) => {
        if (result.isConfirmed) {
            doHapusMultipleDosenInModal(modalElement, suratId, nipList);
        }
    });
}

function doHapusMultipleDosenInModal(modalElement, suratId, nipList) {
    Swal.fire({
        title: 'Menghapus Dosen...',
        html: `
            <div style="text-align: center;">
                <div style="font-size: 14px; color: #6c757d; margin-bottom: 10px;">
                    Menghapus <strong>${nipList.length}</strong> dosen
                </div>
                <div style="width: 100%; background: #e9ecef; border-radius: 10px; height: 10px;">
                    <div id="progressBarHapus" style="width: 0%; height: 100%; background: #dc3545; border-radius: 10px; transition: width 0.3s;"></div>
                </div>
                <div style="margin-top: 15px; font-size: 12px; color: #6c757d;">
                    <i class="fas fa-sync fa-spin"></i> Sedang memproses...
                </div>
            </div>
        `,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
            updateProgressBarHapus(0);
        }
    });
    
    const formData = new FormData();
    formData.append('surat_id', suratId);
    formData.append('nip_list', JSON.stringify(nipList));
    
    fetch(baseUrl + '/surat/hapus_banyak_dosen', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateProgressBarHapus(100);
            Swal.close();
            
            // Update data di tabel secara langsung tanpa refresh
            const removedDosen = currentDosenList.filter(d => nipList.includes(d.nip));
            updateTableDataAfterDosenChange(suratId, 'hapus', removedDosen);
            
            // Close modal
            const modalId = modalElement.closest('.modal-item').id;
            modalManager.closeModal(modalId);
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: `${nipList.length} dosen berhasil dihapus`,
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: data.message || 'Terjadi kesalahan saat menghapus dosen',
                confirmButtonColor: '#FB8C00'
            });
        }
    })
    .catch(error => {
        console.error('Error batch hapus:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan: ' + error.message,
            confirmButtonColor: '#FB8C00'
        });
    });
    
    function updateProgressBarHapus(percent) {
        const progressBar = document.getElementById('progressBarHapus');
        if (progressBar) {
            progressBar.style.width = percent + '%';
        }
    }
}

// ===== FUNGSI UTAMA UNTUK UPDATE DATA DI TABEL =====

// Fungsi untuk mengupdate data di tabel setelah perubahan dosen
function updateTableDataAfterDosenChange(suratId, action, dosenChanged) {
    // Ambil row yang sesuai dengan suratId
    const targetRow = $(`tr.row-detail[data-id="${suratId}"]`);
    
    if (targetRow.length === 0) return;
    
    // Ambil data detail saat ini
    let currentData = {};
    try {
        currentData = JSON.parse(targetRow.attr('data-detail'));
    } catch (err) {
        console.error('Error parsing current data:', err);
        return;
    }
    
    // Fetch data terbaru dari server
    fetch(baseUrl + '/surat/get_updated_surat_data/' + suratId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update data attribute
                const updatedData = data.data;
                targetRow.attr('data-detail', JSON.stringify(updatedData));
                
                // Update tampilan kolom dosen
                updateDosenColumnDisplay(targetRow, updatedData);
                
                // Update modal dosen jika sedang terbuka
                updateDosenModalIfOpen(suratId, updatedData.dosen_data || []);
            }
        })
        .catch(error => {
            console.error('Error fetching updated data:', error);
        });
}

// Fungsi untuk mengupdate tampilan kolom dosen di tabel
function updateDosenColumnDisplay(rowElement, data) {
    const dosenColumn = rowElement.find('td:nth-child(5)');
    const dosenData = data.dosen_data || data.nama_dosen || [];
    
    if (!dosenData || dosenData.length === 0) {
        dosenColumn.html('-');
        return;
    }
    
    // Siapkan data dosen
    let dosenList = [];
    if (Array.isArray(dosenData) && dosenData[0] && typeof dosenData[0] === 'object') {
        // Format baru: array of objects
        dosenList = dosenData;
    } else if (Array.isArray(dosenData)) {
        // Format lama: array of strings
        dosenList = dosenData.map((nama, index) => ({
            nama_dosen: nama,
            nip: (data.nip && data.nip[index]) || '-',
            jabatan: (data.jabatan && data.jabatan[index]) || '-',
            divisi: (data.divisi && data.divisi[index]) || '-',
            foto: (data.foto && data.foto[index]) || ''
        }));
    }
    
    const dosenCount = dosenList.length;
    const nama = dosenList[0]?.nama_dosen || '-';
    const short = nama.length > 30 ? nama.substring(0, 30) + '...' : nama;
    
    // Buat HTML untuk kolom dosen
    let html = '';
    if (dosenCount > 1) {
        html = `
            <div class="dosen-container clickable"
                 onclick="showDosenModal(event, ${escapeHtml(JSON.stringify(dosenList))}, 
                 '${escapeHtml(data.nama_kegiatan || '')}', 
                 '${data.id || ''}')">
                <span class="nama-dosen-badge" title="${escapeHtml(nama)} (Klik untuk lihat semua)">${escapeHtml(short)}</span>
                <span class="nama-dosen-more" title="Klik untuk lihat semua dosen">+${dosenCount - 1} lainnya</span>
            </div>
        `;
    } else {
        html = `
            <div class="dosen-container" style="cursor: default;">
                <span class="nama-dosen-badge" title="${escapeHtml(nama)}">${escapeHtml(short)}</span>
            </div>
        `;
    }
    
    dosenColumn.html(html);
}

// Fungsi untuk mengupdate modal dosen jika sedang terbuka
function updateDosenModalIfOpen(suratId, dosenList) {
    // Cari modal dosen yang sedang terbuka untuk surat ini
    const dosenModal = modalManager.modals.find(modal => 
        modal.type === 'dosen' && modal.data.kegiatanTitle === currentPengajuanName
    );
    
    if (dosenModal) {
        // Update modal content
        updateDosenModalContent(dosenModal.element, dosenList, suratId);
    }
}

// ===== DATATABLES INITIALIZATION =====
$(document).ready(function() {
    const BASE_URL = '<?= rtrim(base_url(), "/"); ?>';

    // Initialize DataTable
    table = $('#tabelSurat').DataTable({
        responsive: true,
        pageLength: 5,
        dom: 'rtp',
        scrollX: false,
        autoWidth: false,
        columnDefs: [{
                orderable: false,
                targets: [0, -1]
            },
            {
                className: 'dt-center',
                targets: [0, 1, 4, 5, 6, 7]
            },
            {
                className: 'dt-left',
                targets: [2, 3]
            },
            {
                width: '4%',
                targets: 0
            },
            {
                width: '5%',
                targets: 1
            },
            {
                width: '25%',
                targets: 2
            },
            {
                width: '12%',
                targets: 3
            },
            {
                width: '20%',
                targets: 4
            },
            {
                width: '15%',
                targets: 5
            },
            {
                width: '12%',
                targets: 6
            },
            {
                width: '12%',
                targets: 7
            }
        ],
        order: [
            [1, 'asc']
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            infoFiltered: "(disaring dari _MAX_ total entri)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        }
    });

    // ===== FILTER FUNCTIONALITY =====
    const filterData = {
        jenis: <?php
                $jenis_list = array_unique(array_map(function ($s) {
                    return $s->jenis_pengajuan;
                }, $surat_list));
                echo json_encode(array_values($jenis_list));
                ?>,
        dosen: <?php
                $dosen_list = [];
                foreach ($surat_list as $s) {
                    if (isset($s->dosen_data) && !empty($s->dosen_data)) {
                        foreach ($s->dosen_data as $dosen) {
                            $dosen_list[] = $dosen['nama_dosen'];
                        }
                    }
                }
                $dosen_list = array_unique($dosen_list);
                echo json_encode(array_values($dosen_list));
                ?>,
        status: <?php
                $status_list = array_unique(array_map(function ($s) {
                    return $s->status;
                }, $surat_list));
                echo json_encode(array_values($status_list));
                ?>
    };

    Object.keys(filterData).forEach(k => {
        filterData[k] = (filterData[k] || []).map(x => String(x || '').trim()).filter(x => x !== '');
        filterData[k] = Array.from(new Set(filterData[k])).sort((a, b) => a.localeCompare(b));
    });

    let rows = [];
    let uid = 0;

    function nextId() {
        return 'r' + (++uid);
    }

    function makeRowDOM(r) {
        const $wr = $(`<div class="filter-row" data-id="${r.id}"></div>`);

        const $filterRowActions = $(`<div class="filter-row-actions"></div>`);
        const $filterRowSearch = $(`<div class="filter-row-search"></div>`);
        const $search = $(`<input type="text" class="row-search" placeholder="Search..." />`);
        const $searchIcon = $(`<i class="fa fa-search"></i>`);

        const $dateStart = $(`<input type="date" class="row-date-start" style="display:none" />`);
        const $dateEnd = $(`<input type="date" class="row-date-end" style="display:none" />`);

        $filterRowSearch.append($search).append($searchIcon);

        const $cat = $(`<select class="row-cat">
        <option value="jenis">Jenis Pengajuan</option>
        <option value="dosen">Nama Dosen</option>
        <option value="status">Status</option>
        <option value="tanggal">Tanggal Kegiatan</option>
    </select>`);

        const $btnAdd = $(`<button class="row-btn add" title="Tambah baris"><i class="fa fa-plus"></i></button>`);
        const $btnRemove = $(`<button class="row-btn remove" title="Hapus baris"><i class="fa fa-times"></i></button>`);

        if (r.category) $cat.val(r.category);
        if (r.text) $search.val(r.text);
        if (r.dateStart) $dateStart.val(r.dateStart);
        if (r.dateEnd) $dateEnd.val(r.dateEnd);

        function refreshInputs() {
            const catVal = $cat.val();
            if (catVal === 'tanggal') {
                $filterRowSearch.hide();
                $dateStart.show();
                $dateEnd.show();
            } else {
                $filterRowSearch.show();
                $dateStart.hide();
                $dateEnd.hide();
            }
        }
        refreshInputs();

        $search.on('input', function() {
            const id = $wr.data('id');
            const obj = rows.find(x => x.id === id);
            if (!obj) return;
            obj.text = $(this).val() || '';
            applyFilters();
        });

        $dateStart.on('change', function() {
            const id = $wr.data('id');
            const obj = rows.find(x => x.id === id);
            if (!obj) return;
            obj.dateStart = $(this).val() || '';
            applyFilters();
        });
        $dateEnd.on('change', function() {
            const id = $wr.data('id');
            const obj = rows.find(x => x.id === id);
            if (!obj) return;
            obj.dateEnd = $(this).val() || '';
            applyFilters();
        });

        $cat.on('change', function() {
            const id = $wr.data('id');
            const obj = rows.find(x => x.id === id);
            if (!obj) return;
            obj.category = $(this).val();
            obj.text = '';
            obj.dateStart = '';
            obj.dateEnd = '';
            $search.val('');
            $dateStart.val('');
            $dateEnd.val('');
            refreshInputs();
            applyFilters();
        });

        $btnAdd.on('click', function() {
            const id = $wr.data('id');
            const idx = rows.findIndex(x => x.id === id);
            const cur = rows[idx] || {};
            const newRow = {
                id: nextId(),
                category: cur.category || 'jenis',
                text: '',
                dateStart: '',
                dateEnd: ''
            };
            if (idx >= 0 && idx < rows.length - 1) {
                rows.splice(idx + 1, 0, newRow);
            } else {
                rows.push(newRow);
            }
            renderRows();
            applyFilters();
        });

        $btnRemove.on('click', function() {
            const id = $wr.data('id');
            rows = rows.filter(x => x.id !== id);
            renderRows();
            applyFilters();
        });

        $filterRowActions.append($cat).append($btnAdd).append($btnRemove);
        $wr.append($filterRowActions).append($filterRowSearch).append($dateStart).append($dateEnd);
        return $wr;
    }

    function renderRows() {
        const $b = $('#filterBuilder');
        $b.empty();
        rows.forEach(r => {
            $b.append(makeRowDOM(r));
        });
        $('#btnResetAll').prop('hidden', rows.length === 0 && $('#tableSearch').val().trim() === '');
    }

    $('#btnAddFilterRow').click(function() {
        const cat = $('#filterCategory').val() || 'jenis';
        rows.push({
            id: nextId(),
            category: cat,
            text: '',
            dateStart: '',
            dateEnd: ''
        });
        renderRows();
        applyFilters();
    });

    $('#btnResetAll').click(function() {
        rows = [];
        $('#tableSearch').val('');
        renderRows();
        applyFilters();
    });

    function applyFilters() {
        // Custom filter logic here
        table.draw();
        const anyFilterActive = rows.length > 0 || $('#tableSearch').val().trim() !== '';
        $('#btnResetAll').prop('hidden', !anyFilterActive);
    }

    let debounce = null;
    $('#tableSearch').on('input', function() {
        if (debounce) clearTimeout(debounce);
        debounce = setTimeout(() => {
            applyFilters();
        }, 300);
    });

    // ===== MULTI-SELECT FUNCTIONALITY =====
    let selectedIds = [];

    function updateMultiActions() {
        selectedIds = [];
        $('.row-checkbox:checked').each(function() {
            selectedIds.push($(this).data('id'));
        });

        $('#selectedCount').text(selectedIds.length);

        const totalCheckboxes = $('.row-checkbox').length;
        const checkedCheckboxes = $('.row-checkbox:checked').length;
        $('#checkAll').prop('checked', totalCheckboxes === checkedCheckboxes && totalCheckboxes > 0);
    }

    $('#checkAll').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.row-checkbox').prop('checked', isChecked);
        if (isChecked) {
            $('tr.row-detail').addClass('selected');
        } else {
            $('tr.row-detail').removeClass('selected');
        }
        updateMultiActions();
    });

    $(document).on('change', '.row-checkbox', function(e) {
        e.stopPropagation();
        const $row = $(this).closest('tr');
        if ($(this).is(':checked')) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }
        updateMultiActions();
    });

    $(document).on('click', '.row-checkbox', function(e) {
        e.stopPropagation();
    });

    // ===== ALERT FUNCTIONS =====
    window.showEditAlert = function(status) {
        Swal.fire({
            icon: 'warning',
            title: 'Edit Tidak Diizinkan',
            html: `
            <p>Tombol edit hanya dapat digunakan untuk surat yang <strong>ditolak</strong>.</p>
            <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; margin-top: 10px;">
                <strong>Status surat ini:</strong> ${status}
            </div>
            <div style="margin-top: 15px; font-size: 14px; color: #6c757d;">
                <i class="fas fa-info-circle"></i> Hanya surat yang ditolak yang dapat diedit dan diajukan ulang.
            </div>
        `,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#FB8C00'
        });
    };

    window.showPrintAlert = function(status) {
        Swal.fire({
            icon: 'warning',
            title: 'Cetak Tidak Diizinkan',
            html: `
            <p>Tombol cetak hanya dapat digunakan untuk surat yang sudah <strong>disetujui dekan</strong>.</p>
            <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; margin-top: 10px;">
                <strong>Status surat ini:</strong> ${status}
            </div>
            <div style="margin-top: 15px; font-size: 14px; color: #6c757d;">
                <i class="fas fa-info-circle"></i> Silakan tunggu persetujuan dekan terlebih dahulu.
            </div>
        `,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#FB8C00'
        });
    };
});

// Fungsi untuk escape HTML
function escapeHtml(unsafe) {
    if (unsafe === null || unsafe === undefined) return '-';
    return String(unsafe)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// Toggle Sidebar for Mobile
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
}

// Fungsi untuk tombol Kembali
function goBack() {
    window.location.href = '<?= base_url() ?>';
}

// Close all modals with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modalManager.modals.length > 0) {
        modalManager.closeModal(modalManager.modals[modalManager.modals.length - 1].id);
    }
});
    </script>
    <!-- Loading Bar Overlay untuk Sidebar Navigation -->
<div id="sidebar-loading-overlay" class="sidebar-loading-overlay">
    <div class="sidebar-loading-container">
        <div class="sidebar-loading-spinner"></div>
        <div class="sidebar-loading-text">Memuat Halaman...</div>
        <div class="sidebar-loading-progress">
            <div class="sidebar-loading-progress-bar"></div>
        </div>
    </div>
</div>
<style>
/* ===== SIDEBAR LOADING OVERLAY ===== */
.sidebar-loading-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    z-index: 999999;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.sidebar-loading-overlay.active {
    display: flex;
    animation: fadeIn 0.3s ease forwards;
}

.sidebar-loading-container {
    text-align: center;
    max-width: 400px;
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.sidebar-loading-spinner {
    width: 60px;
    height: 60px;
    border: 5px solid rgba(251, 140, 0, 0.2);
    border-radius: 50%;
    border-top-color: #FB8C00;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
}

.sidebar-loading-text {
    font-size: 18px;
    font-weight: 600;
    color: #343a40;
    margin-bottom: 20px;
}

.sidebar-loading-progress {
    width: 100%;
    background-color: #e9ecef;
    height: 6px;
    border-radius: 3px;
    overflow: hidden;
    margin-top: 15px;
}

.sidebar-loading-progress-bar {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, #FB8C00 0%, #FFA726 100%);
    transition: width 0.3s ease;
    animation: progressAnimation 2s ease-in-out infinite;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes progressAnimation {
    0% {
        width: 0%;
    }
    50% {
        width: 70%;
    }
    100% {
        width: 100%;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar-loading-container {
        max-width: 90%;
        padding: 20px;
    }
    
    .sidebar-loading-spinner {
        width: 50px;
        height: 50px;
    }
    
    .sidebar-loading-text {
        font-size: 16px;
    }
}
</style>
<script>
// ========================================
// SIDEBAR LOADING BAR HANDLER
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Initializing sidebar loading handler...');
    
    const loadingOverlay = document.getElementById('sidebar-loading-overlay');
    
    // Fungsi untuk show loading
    function showSidebarLoading(message = 'Memuat Halaman...') {
        if (loadingOverlay) {
            const loadingText = loadingOverlay.querySelector('.sidebar-loading-text');
            if (loadingText) {
                loadingText.textContent = message;
            }
            
            loadingOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            console.log('🔄 Sidebar loading shown:', message);
        }
    }
    
    // Fungsi untuk hide loading
    function hideSidebarLoading() {
        if (loadingOverlay) {
            loadingOverlay.classList.remove('active');
            document.body.style.overflow = '';
            
            console.log('✅ Sidebar loading hidden');
        }
    }
    
    // ========================================
    // ATTACH EVENT LISTENERS KE SIDEBAR LINKS
    // ========================================
    
    // 1. List Pengajuan (Current Page - Skip)
    const listPengajuanLink = document.querySelector('a[href*="list-surat-tugas"]');
    if (listPengajuanLink) {
        listPengajuanLink.addEventListener('click', function(e) {
            // Skip jika sudah di halaman ini
            if (window.location.href.includes('list-surat-tugas')) {
                e.preventDefault();
                console.log('Already on List Pengajuan page');
                return;
            }
            
            e.preventDefault();
            showSidebarLoading('Memuat List Pengajuan...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
        console.log('✅ List Pengajuan link attached');
    }
    
    // 2. Surat Tugas
    const suratTugasLink = document.querySelector('a[href*="input_surat"]');
    if (suratTugasLink) {
        suratTugasLink.addEventListener('click', function(e) {
            e.preventDefault();
            showSidebarLoading('Memuat Form Surat Tugas...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
        console.log('✅ Surat Tugas link attached');
    }
    
    // 3. WhatsApp Server Control
    const whatsappLink = document.querySelector('a[href*="whatsapp/dashboard"]');
    if (whatsappLink) {
        whatsappLink.addEventListener('click', function(e) {
            e.preventDefault();
            showSidebarLoading('Memuat WhatsApp Server Control...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
        console.log('✅ WhatsApp link attached');
    }
    
    // 4. Peminjaman Ruangan - Daftar Ruangan
    const daftarRuanganLink = document.querySelector('a[href*="daftarsemuatempat"]');
    if (daftarRuanganLink) {
        daftarRuanganLink.addEventListener('click', function(e) {
            e.preventDefault();
            showSidebarLoading('Memuat Daftar Ruangan...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
        console.log('✅ Daftar Ruangan link attached');
    }
    
    // 5. Peminjaman Ruangan - Riwayat
    const riwayatLink = document.querySelector('a[href*="Pic_kk/riwayat"]');
    if (riwayatLink) {
        riwayatLink.addEventListener('click', function(e) {
            e.preventDefault();
            showSidebarLoading('Memuat Riwayat Peminjaman...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
        console.log('✅ Riwayat link attached');
    }
    
    // 6. Ticketing - Riwayat
    const riwayatTicketingLink = document.querySelector('a[href*="riwayat_ticketing"]');
    if (riwayatTicketingLink) {
        riwayatTicketingLink.addEventListener('click', function(e) {
            e.preventDefault();
            showSidebarLoading('Memuat Riwayat Ticketing...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
        console.log('✅ Riwayat Ticketing link attached');
    }
    
    // 7. Helpdesk
    const helpdeskLinks = document.querySelectorAll('a[href*="helpdesk"]');
    helpdeskLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            showSidebarLoading('Menghubungi Helpdesk...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
    });
    if (helpdeskLinks.length > 0) {
        console.log('✅ Helpdesk links attached');
    }
    
    // 8. Handle Logout Confirmation
    const logoutConfirmBtn = document.querySelector('button[onclick*="logout"]');
    if (logoutConfirmBtn) {
        logoutConfirmBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showSidebarLoading('Logging out...');
            
            setTimeout(() => {
                window.location.href = 'https://ifik.telkomuniversity.ac.id/auth/logout';
            }, 800);
        });
        console.log('✅ Logout confirm button attached');
    }
    
    // ========================================
    // 🎯 TOMBOL KEMBALI DI HEADER
    // ========================================
    const btnKembali = document.querySelector('.btn-back');
    if (btnKembali) {
        btnKembali.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            showSidebarLoading('Kembali ke Form Surat Tugas...');
            
            setTimeout(() => {
                window.location.href = 'https://ifik.telkomuniversity.ac.id/Pic_kk/input_surat';
            }, 500);
        });
        console.log('✅ Tombol Kembali attached');
    }
    
    // ========================================
    // 🎯 TOMBOL TAMBAH SURAT DI HEADER
    // ========================================
    const btnTambahSurat = document.querySelector('.btn-add-surat');
    if (btnTambahSurat) {
        btnTambahSurat.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            showSidebarLoading('Membuka Form Surat Tugas...');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 500);
        });
        console.log('✅ Tombol Tambah Surat attached');
    }
    
    // ========================================
    // AUTO-HIDE LOADING JIKA ADA ERROR
    // ========================================
    
    // Hide loading jika page load gagal setelah 5 detik
    window.addEventListener('load', function() {
        setTimeout(() => {
            hideSidebarLoading();
        }, 100);
    });
    
    // Hide loading jika terjadi error
    window.addEventListener('error', function() {
        hideSidebarLoading();
    });
    
    console.log('✅ Sidebar loading handler initialized');
});

// ========================================
// HANDLE BROWSER BACK/FORWARD
// ========================================
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        // Page loaded from cache (back/forward button)
        const loadingOverlay = document.getElementById('sidebar-loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        console.log('🔄 Page loaded from cache, hiding loading');
    }
});

// ========================================
// OVERRIDE FUNGSI goBack() YANG LAMA
// ========================================
window.goBack = function() {
    const loadingOverlay = document.getElementById('sidebar-loading-overlay');
    if (loadingOverlay) {
        const loadingText = loadingOverlay.querySelector('.sidebar-loading-text');
        if (loadingText) {
            loadingText.textContent = 'Kembali ke Form Surat Tugas...';
        }
        
        loadingOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            window.location.href = 'https://ifik.telkomuniversity.ac.id/Pic_kk/input_surat';
        }, 500);
    } else {
        // Fallback jika loading overlay tidak ada
        window.location.href = 'https://ifik.telkomuniversity.ac.id/Pic_kk/input_surat';
    }
};
</script>
</body>
</html>