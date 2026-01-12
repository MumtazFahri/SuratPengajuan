<!DOCTYPE html>
<html lang="en-id">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pic kk</title>

    <!-- Bootstrap & Nice Select -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jquery-nice-select@1.1.0/css/nice-select.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Lab. FIK Main Style -->
    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/css/style.css">

    <!-- Google Fonts - Sama seperti views kedua -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- JQuery 3.3.1 -->
    <script src="https://ifik.telkomuniversity.ac.id/assets/vendor/jquery.min.js"></script>

    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/vendor/fontawesome-free-5.13.0-web/css/all.min.css">

    <!-- JS Vendor -->
    <script src="https://ifik.telkomuniversity.ac.id/assets/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="https://ifik.telkomuniversity.ac.id/assets/js/booking.js"></script>
    <link rel="icon" href="https://ifik.telkomuniversity.ac.id/assets/img/logo/favicon.png" type="image/gif">

    <style>
        body {
            background-color: #f6f9fb;
            font-family: 'Poppins', sans-serif;
        }

        .multi-step-form {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            padding: 35px;
            position: relative;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* Progressbar container */
        .progress-container {
            position: relative;
            height: 8px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .progress-bar-animated {
            position: absolute;
            height: 8px;
            background: #FB8C00;
            width: 0%;
            border-radius: 5px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Step animation */
        fieldset {
            display: none;
            border: none;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        fieldset.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .action-btn {
            background: #FB8C00;
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .action-btn:hover {
            background: #FB8C00;
        }

        .btn-secondary {
            border: 1px solid #ccc;
            background: transparent;
            color: #555;
            font-family: 'Poppins', sans-serif;
        }

        .btn-secondary:hover {
            background: #FB8C00;
            color: #fff;
            border-color: #FB8C00;
        }

        .nice-select {
            width: 100%;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color, #333);
            background-color: var(--bs-body-bg, #fff);
            background-clip: padding-box;
            border: var(--bs-border-width, 1px) solid var(--bs-border-color, #d1d5db);
            border-radius: var(--bs-border-radius, 8px);
            padding: .375rem .75rem;
            
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .nice-select.open {
            border-color: #FB8C00;
            box-shadow: 0 0 0 0.2rem rgba(92, 184, 92, 0.25);
        }

        .nice-select .list {
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-color: #e5e7eb;
            font-family: 'Poppins', sans-serif;
        }

        .nice-select .option.focus,
        .nice-select .option.selected.focus {
            background-color: #FB8C00;
            color: #fff;
        }

        .step-counter {
            text-align: right;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 15px;
            font-family: 'Poppins', sans-serif;
        }

        /* Static button area inside form */
        .button-area {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 15px;
            position: relative;
        }

        @media (max-width: 575px) {
            .button-area {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Font untuk semua elemen - sama seperti views kedua */
        h1, h2, h3, h4, h5, h6, p, span, div, input, textarea, select, button, label, a {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Font untuk navbar */
        .navbar, .fik-navbar-menu, .fik-username, .fik-login-dropdown, .dropdown-menu {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Font untuk modal */
        .modal, .modal-title, .modal-body, .modal-footer {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Font untuk side menu */
        .fik-db-side-menu, .card, .btn {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Font untuk form */
        .custom-form, .form-group, .form-control, .form-check, .form-check-label {
            font-family: 'Poppins', sans-serif !important;
        }
        .custom-form label::after {
        content: none !important;
    }

        /* Font untuk table */
        table, th, td, .table, .badge {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Font untuk footer */
        .footer, .fik-footer, .credit {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Form group styling */
        .form-group { 
            margin-bottom: 20px; 
        }

        /* wrapper periode */
        #periode_section {
            position: relative;
            z-index: 9999 !important;
            transition: margin-bottom 0.3s ease;
             margin-top: -10px !important; /* Atur nilai negatif untuk naik */
        }

        /* dropdown nice-select */
        .nice-select {
            z-index: 99999 !important;
        }

        /* dropdown saat open = paling depan */
        .nice-select.open {
            z-index: 999999 !important;
        }

        /* Tambah margin yang lebih besar saat dropdown dibuka */
        #periode_section.open-margin {
            margin-bottom: 250px !important;
        }

        /* Tambah padding bottom untuk memberikan ruang lebih */
        #periode_section .nice-select.open + .list {
            margin-bottom: 20px;
        }

        /* sembunyikan select asli */
        .has-select select.nice-original {
          display: none !important;
        }

        /* Pastikan list dropdown tidak terpotong */
        .nice-select .list {
            max-height: 200px;
            overflow-y: auto;
        }

        /* Animasi smooth untuk spacing */
        #periode_section {
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Style untuk error message */
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .form-group.has-error input {
            border-color: #dc3545;
        }

        /* Style untuk info message */
        .info-message {
            color: #0d6efd;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        /* Style untuk success message */
        .success-message {
            color: #198754;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        /* Button cell styling */
        .button-cell { display: none; justify-content: center; align-items: center; }
        .add-row-btn, .remove-row-btn { width: 35px; height: 35px; border-radius: 50%; padding: 0; }
        .panitia-row { transition: all 0.3s ease; opacity: 1; transform: translateY(0); }
        .panitia-row.removing { opacity: 0; transform: translateX(20px); }

        /* Google-style Autocomplete */
        .autocomplete-box-fixed {
            position: fixed;
            background: #fff;
            border: none;
            z-index: 9999999;
            max-height: 400px;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(32,33,36,0.28);
            border-radius: 24px;
            font-size: 14px;
            padding: 8px 0;
            margin-top: 8px;
            font-family: 'Poppins', sans-serif;
            min-width: 300px;
        }

        .autocomplete-item {
            padding: 0;
            cursor: pointer;
            transition: background-color 0.1s ease;
            border: none;
            line-height: 1.4;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
        }

        .autocomplete-item:hover,
        .autocomplete-item.active {
            background: #f8f9fa;
        }

        .autocomplete-icon {
            width: 20px;
            height: 20px;
            margin-left: 16px;
            flex-shrink: 0;
            opacity: 0.54;
        }

        .autocomplete-icon svg {
            width: 20px;
            height: 20px;
            fill: #5f6368;
        }

        .autocomplete-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 12px 16px 12px 0;
            flex: 1;
            min-width: 0;
        }

        .autocomplete-item .item-primary {
            font-size: 14px;
            color: #202124;
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .autocomplete-item .item-secondary {
            font-size: 12px;
            color: #70757a;
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .query-match {
            font-weight: 600;
        }

        .autocomplete-item:first-child {
            border-left: 3px solid #1a73e8;
        }

        .autocomplete-loading,
        .autocomplete-empty {
            padding: 16px 20px;
            text-align: center;
            color: #70757a;
            font-size: 13px;
        }

        .autocomplete-box-fixed::-webkit-scrollbar {
            width: 10px;
        }

        .autocomplete-box-fixed::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .autocomplete-box-fixed::-webkit-scrollbar-thumb {
            background: #dadce0;
            border-radius: 10px;
            border: 2px solid #fff;
        }

        .autocomplete-box-fixed::-webkit-scrollbar-thumb:hover {
            background: #bdc1c6;
        }

        .multi-step-form, fieldset, .container {
            overflow: visible !important;
        }

        /* Perbaikan untuk tampilan form */
        .form-group.has-select {
            margin-bottom: 1rem;
        }

        .form-control.custom-form-control {
            margin-top: 12px;
        }

        .panitia-row {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .panitia-row:last-child {
            border-bottom: none;
        }
        /* PERBAIKAN FONT AWESOME */
.fas, .far, .fab, .fa {
    font-family: "Font Awesome 6 Free" !important;
    font-weight: 900;
}

/* Pastikan icon tidak disembunyikan */
[class*="fa-"]:before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
}

/* Override any hiding styles */
i[class*="fa-"] {
    display: inline-block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

/* Icon colors untuk berbagai konteks */
.input-group-text i {
    color: #6c757d;
    width: 16px;
}

.btn i {
    margin-right: 5px;
}

.step-counter i {
    color: #FB8C00;

}
/* ===== LOADING SCREEN ===== */
.loading-overlay {
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
}

.loading-overlay.active {
    display: flex;
    animation: fadeIn 0.3s ease;
}

.loading-spinner {
    width: 60px;
    height: 60px;
    border: 5px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    border-top-color: #FB8C00;
    animation: spin 1s linear infinite;
    margin-bottom: 20px;
}

.loading-text {
    color: white;
    font-size: 18px;
    font-weight: 600;
    margin-top: 20px;
    text-align: center;
}

.loading-details {
    color: rgba(255, 255, 255, 0.8);
    font-size: 14px;
    margin-top: 10px;
    text-align: center;
    max-width: 400px;
    line-height: 1.5;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
/* Hilangkan SEMUA tanda bintang */
label::after {
    content: "" !important;
    display: none !important;
}

/* Hilangkan span bintang */
label span:contains("*"),
label span[style*="color: #dc3545"],
label span[style*="color:red"],
label span.text-danger {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    font-size: 0 !important;
    width: 0 !important;
    height: 0 !important;
    overflow: hidden !important;
}

/* Untuk asterisk di dalam label */
label {
    position: relative;
}

label:has(> span:contains("*"))::after,
label:has(> span[style*="#dc3545"])::after {
    content: "" !important;
}  
/* PERBAIKAN ICON WHATSAPP */
.fab.fa-whatsapp {
    font-family: "Font Awesome 6 Brands" !important;
    font-weight: 400;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
}

/* Pastikan icon terlihat */
.fa-whatsapp:before {
    content: "\f232" !important; /* Unicode untuk WhatsApp */
}
    </style>
</head>

<body>
    <nav class="navbar fixed-top">
        <div class="container loss">
            <a class="db-menu-trigger show-mobile"><span class="fas fa-th-large"></span></a>
            <div class="navbar-brand akun">
                <a href="https://ifik.telkomuniversity.ac.id/"><img src="https://ifik.telkomuniversity.ac.id/assets/img/logo/logo-dummy.png" /></a>
            </div>
            <div class="fik-navbar-menu">
                <ul class="left akun fik-username hide-mobile">
                    <li>
                        <img src="https://ifik.telkomuniversity.ac.id/assets/img/profile/default.jpg">
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

    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Logout</h5>
                </div>
                <div class="modal-body">
                    Anda yakin akan keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="location.href='https://ifik.telkomuniversity.ac.id/auth/logout';" class="btn btn-primary">Keluar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="fik-db-side-menu">
        <div id="accordion">
            <div class="card show-mobile profil">
                <div class="img-wrapper">
                    <img src="https://ifik.telkomuniversity.ac.id/assets/img/profile/default.jpg">
                </div>
                <b>PIC MEDCRAFT</b>
                <span>pic kk</span>
            </div>
             <!-- FONT AWESOME - HARUS DITARUH DI ATAS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">

            <div class="divider show-mobile" style="margin-top:20px"></div>
            <div class="card">
                <a href="<?= base_url('list-surat-tugas') ?>" class="btn"><span class="fas fa-palette"></span> List Pengajuan</a>
            </div>
            <div class="card">
                <a href="https://ifik.telkomuniversity.ac.id/Pic_kk/input_surat" class="btn"><span class="fas fa-envelope-open-text"></span> Surat Tugas</a>
            </div>
            <div class="card">
                <a href="<?= base_url('whatsapp/dashboard') ?>" class="btn"><span class="fab fa-whatsapp"></span> Whatsapp Server Control</a>
            </div>
            <div class="divider"></div>
            <div class="card">
                <a href="#" class="btn" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2"><span class="fas fa-door-open"></span> Peminjaman Ruangan</a>
                <div id="collapse2" class="collapse" data-parent="#accordion">
                    <ul>

                        <li><a data-toggle="modal" data-target="#termcondition">Buat Peminjaman</a></li>

                        <li><a href="https://ifik.telkomuniversity.ac.id/users/daftarsemuatempat">Daftar Ruangan</a></li>
                        <li><a href="https://ifik.telkomuniversity.ac.id/Pic_kk/riwayat">Riwayat</a></li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <a href="#" class="btn" data-toggle="collapse" data-target="#ticketing" aria-expanded="true" aria-controls="ticketing"><span class="fas fa-door-open"></span> Ticketing</a>
                <div id="ticketing" class="collapse" data-parent="#accordion">
                    <ul>

                        <li><a data-toggle="modal" data-target="#maketicketing">Input ticketing</a></li>

                        <li><a href="https://ifik.telkomuniversity.ac.id/users/daftarsemuatempat">Daftar Ruangan</a></li>
                        <li><a href="https://ifik.telkomuniversity.ac.id/pic_kk/riwayat_ticketing">Riwayat</a></li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <a href="#" class="btn show-mobile"><span class="fas fa-life-ring"></span>Helpdesk</a>
            </div>
            <div class="card logout">
                <button class="btn" data-toggle="modal" data-target="#logout"><span class="fas fa-sign-out-alt"></span> Logout</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termcondition" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <p><a href="#"><u>Ketentuan Peminjaman</u></a></p>
                    </h5>
                </div>
                <div class="modal-body">
                    <ol>
                        <div style="margin-left:20px;margin-bottom:10px;"><b>
                                <li>Peminjaman melalui Ifik hanya booking ruangan </li>
                            </b></div>
                        <div style="margin-left:20px;margin-bottom:10px;"><b>
                                <li>Teknis dan operasional silahkan menghubungi Bpk. Yayan (081219639375)</li>
                            </b></div>
                        <div style="margin-left:20px;margin-bottom:10px;"><b>
                                <li>Pengajuan peminjaman ruangan minimal 3 hari sebelum pelaksanaan kegiatan </li>
                            </b></div>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button data-toggle="modal" type="button" data-target="#makebooking" class="btn btn-primary">Dimengerti dan Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>


    <!-- End Side Menu -->
    <div class="modal fade" id="makebooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog wide" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Buat Peminjaman</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="https://ifik.telkomuniversity.ac.id/booking/bookingplace" method="POST" enctype="multipart/form-data">
                        <div class="custom-form">
                            <div class="form-group" style="margin-bottom:12px">
                                <input type="text" name="name" class="form-control" placeholder="" required="required" value="PIC MEDCRAFT" autocomplete="off" />
                                <label>Nama Lengkap</label>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="id_ruangan" id="ruangan" onchange="disablemodals()" disabled required>
                                    <option disabled selected>Pilih Ruangan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="keterangan" class="form-control" placeholder="" required="required" autocomplete="off"></textarea>
                                <label>Keterangan</label>
                            </div>
                            <div class="form-group">
                                <input type="date" name="tanggal" id="tanggal" onchange="Bookingmodals()" class="form-control" disabled placeholder="" required="required" autocomplete="off" />
                                <label>Tanggal Peminjaman</label>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <div class="form-control waktu">Waktu</div>
                            </div>
                        </div><br>
                        <div class="jadwal-ruangan" id="jadwal">
                            <table border="0" class="table bookings" id="booking">
                                <tbody>
                                    <tr class="display" style="background:transparent">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="id_peminjam" class="form-control" placeholder="" value="632045c808b1c" required="required" autocomplete="off" />
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-pill btn-sm" id="createbookingmodals">Kirim Permintaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="maketicketing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog wide" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Buat Ticketing</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="https://ifik.telkomuniversity.ac.id/pic_kk/input_ticketing" method="POST" enctype="multipart/form-data">
                        <div class="custom-form">
                            <div class="form-group" style="margin-bottom:12px">
                                <input type="text" name="name" class="form-control" placeholder="" required="required" value="PIC MEDCRAFT" autocomplete="off" />
                                <label>Nama Lengkap</label>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="sub_kategori" id="kategori_ticketing" onchange="disablemodals()" disabled required>
                                    <option disabled selected>Pilih Kategori</option>
                                </select>
                            </div>
                            <div style="padding:10px" id="keuangan">
                                <label><b>Kelengkapan dokumen yang wajib di upload</b></label><br>
                                <div class="form-check">
                                    <input type="checkbox" id="fenomena" name="kelayakan2[]" value="">
                                    <label for="fenomena">Daftar honor mengajar per Prodi yang di generate oleh LAA per tgl 15 setiap bulannya</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="identifikasi" name="kelayakan2[]" value="">
                                    <label for="identifikasi">Rekap Kehadiran Dosen LB</label>
                                </div>
                            </div>
                            <div style="padding:10px" id="keuangan2">
                                <div class="form-check">
                                    <input type="checkbox" id="justifikasi" name="kelayakan2[]" value="">
                                    <label for="justifikasi">Form Justifikasi/Proposal Kegiatan (Sudah lengkap ttd basah/Asli)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="undangan_kesediaan" name="kelayakan2[]" value="">
                                    <label for="undangan_kesediaan">Undangan kesediaan sebagai pembicara / narasumber</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="undangan_peserta" name="kelayakan2[]" value="">
                                    <label for="undangan_peserta">Surat undangan peserta / poster kegiatan</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="ftcp_narsum" name="kelayakan2[]" value="">
                                    <label for="ftcp_narsum">Fotocopy Materi</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="cv_pembicara" name="kelayakan2[]" value="">
                                    <label for="cv_pembicara">CV Pembicara / narasumber</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="ftcp_npwp_narsum" name="kelayakan2[]" value="">
                                    <label for="ftcp_npwp_narsum">Fotocopy NPWP Pembicara / narasumber</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="daftar_hadir_narsum" name="kelayakan2[]" value="">
                                    <label for="daftar_hadir_narsum">Daftar hadir pembicara/narasumber ttd basah/asli (jika onsite), Screenshoot zoom (jika Online/Daring)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="daftar_hadir_peserta" name="kelayakan2[]" value="">
                                    <label for="daftar_hadir_peserta">Daftar hadir peserta ttd basah/asli (jika onsite), screenshoot zoom (jika online/daring)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="daftar_honor" name="kelayakan2[]" value="">
                                    <label for="daftar_honor">Daftar honor (Dikenakan potongan pajak, jika WNI dikenakan PPH PSL 21 sebesar 5%, Jika WNA dikenakan PPH PSL 26 sebesar 20%)</label>
                                </div>
                            </div>
                            <div style="padding:10px" id="keuangan3">
                                <div class="form-check">
                                    <input type="checkbox" id="undangan_rapat3" name="kelayakan2[]" value="">
                                    <label for="undangan_rapat3">Undangan Rapat</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="daftar_hadir_peserta3" name="kelayakan2[]" value="">
                                    <label for="daftar_hadir_peserta3">Daftar Hadir Peserta</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="konsumsi3" name="kelayakan2[]" value="">
                                    <label for="konsumsi3">Pembelian Konsumsi (Snack/Makan) harus melalui Kantin Tel-U</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="kuitansi3" name="kelayakan2[]" value="">
                                    <label for="kuitansi3">Kuitansi dan Struk/Nota/Bon/Invoice (lengkap ttd, nama, cap stempel )</label>
                                </div>
                            </div>
                            <div style="padding:10px" id="keuangan4">
                                <div class="form-check">
                                    <input type="checkbox" id="justifikasi4" name="kelayakan2[]" value="">
                                    <label for="justifikasi4">Form Justifikasi/Proposal Kegiatan (Sudah lengkap ttd basah/Asli)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="nde_user_dekan4" name="kelayakan2[]" value="">
                                    <label for="nde_user_dekan4">NDE Ijin Kegiatan User ke Dekan</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="nde_dekan_warek4" name="kelayakan2[]" value="">
                                    <label for="nde_dekan_warek4">NDE Ijin Kegiatan Dekan ke Warek II</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="undangan_luar4" name="kelayakan2[]" value="">
                                    <label for="undangan_luar4">Undangan dari luar</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="surat_tugas4" name="kelayakan2[]" value="">
                                    <label for="surat_tugas4">Surat Tugas</label>
                                </div>
                            </div>
                            <div style="padding:10px" id="keuangan5">
                                <div class="form-check">
                                    <input type="checkbox" id="justifikasi5" name="kelayakan2[]" value="">
                                    <label for="justifikasi5">Justifikasi Pelatihan / Sertifikasi yang diketahui dan disetujui oleh Kaprodi, KK, Wadek II dan Dekan</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="surat_tugas5" name="kelayakan2[]" value="">
                                    <label for="surat_tugas5">Surat Tugas Dekan</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="penawaran5" name="kelayakan2[]" value="">
                                    <label for="penawaran5">Surat Penawaran/Poster</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="kuitansi5" name="kelayakan2[]" value="">
                                    <label for="kuitansi5">Kuitansi dan Struk/Nota/Bon/Invoice (lengkap ttd, nama, cap stempel )</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="surat_tugas_digitrain5" name="kelayakan2[]" value="">
                                    <label for="surat_tugas_digitrain5">Surat Tugas Digi-Train</label>
                                </div>
                            </div>
                            <div style="padding:10px" id="keuangan6">
                                <div class="form-check">
                                    <input type="checkbox" id="justifikasi6" name="kelayakan2[]" value="">
                                    <label for="justifikasi5">Form Justifikasi Pengadaan Barang/Proposal Kegiatan (Sudah lengkap ttd basah/Asli)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="kuitansi6" name="kelayakan2[]" value="">
                                    <label for="kuitansi6">Kuitansi dan Struk/Nota/Bon/Invoice (lengkap ttd, nama, cap stempel )</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="ft_barang" name="kelayakan2[]" value="">
                                    <label for="ft_barang">Foto barang</label>
                                </div>
                            </div>
                            <div style="padding:10px" id="keuangan7">
                                <div class="form-check">
                                    <input type="checkbox" id="justifikasi7" name="kelayakan2[]" value="">
                                    <label for="justifikasi7">Form Justifikasi FIK/Proposal Kegiatan (Sudah lengkap ttd basah/Asli)</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="invoice7" name="kelayakan2[]" value="">
                                    <label for="invoice7">Invoice / Surat permohonan pembayaran</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="kuitansi7" name="kelayakan2[]" value="">
                                    <label for="kuitansi7">Kuitansi</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="npwp7" name="kelayakan2[]" value="">
                                    <label for="npwp7">NPWP Pihak ke-3</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="ba7" name="kelayakan2[]" value="">
                                    <label for="ba7">Berita Acara Serah Terima</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="ft_barang7" name="kelayakan2[]" value="">
                                    <label for="ft_barang7">Foto Sebelum dan Sesudah</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="isi_ticketing" class="mytextarea1"></textarea>
                                <label>Isi Ticket</label>
                            </div>
                            <div style="margin-bottom:12px">
                                <label for="eviden" style="margin-left: 16px;"><b>File Pendukung</b></label>
                                <input type="file" name="images[]" class="form-control" style="padding:13px 16px">
                                <span id="chk-error"></span>
                            </div>
                        </div>
                </div><br>
                <input type="hidden" name="id_user" class="form-control" placeholder="" value="632045c808b1c" required="required" autocomplete="off" />
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-pill btn-sm">Kirim Permintaan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#kategoriruanganmhs').change(function() {
                document.getElementById("ruangan").disabled = false;
                var id_kategori = $('#kategoriruanganmhs').val();

                if (id_kategori != '') {
                    $.ajax({
                        url: "https://ifik.telkomuniversity.ac.id/booking/fetchRuanganMhs",
                        method: "POST",
                        data: {
                            id_kategori: id_kategori
                        },
                        success: function(data) {
                            $('#ruangan').html(data);
                        }
                    })
                }
            });
            $('#kategoriruangandsn').change(function() {
                document.getElementById("ruangan").disabled = false;
                var id_kategori = $('#kategoriruangandsn').val();

                if (id_kategori != '') {
                    $.ajax({
                        url: "https://ifik.telkomuniversity.ac.id/booking/fetchRuanganDsn",
                        method: "POST",
                        data: {
                            id_kategori: id_kategori
                        },
                        success: function(data) {
                            $('#ruangan').html(data);
                        }
                    })
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#unit_mhs').change(function() {
                document.getElementById("kategori_ticketing").disabled = false;
                var id_kategori = $('#unit_mhs').val();

                if (id_kategori != '') {
                    $.ajax({
                        url: "https://ifik.telkomuniversity.ac.id/booking/fetchTicketingMhs",
                        method: "POST",
                        data: {
                            id_kategori: id_kategori
                        },
                        success: function(data) {
                            $('#kategori_ticketing').html(data);
                        }
                    })
                }
            });
            $('#unit_dosen').change(function() {
                document.getElementById("kategori_ticketing").disabled = false;
                var id_kategori = $('#unit_dosen').val();

                if (id_kategori != '') {
                    $.ajax({
                        url: "https://ifik.telkomuniversity.ac.id/booking/fetchTicketingDsn",
                        method: "POST",
                        data: {
                            id_kategori: id_kategori
                        },
                        success: function(data) {
                            $('#kategori_ticketing').html(data);
                        }
                    })
                }
            });
        });
        jQuery(function() {
            jQuery("#keuangan").hide()
            jQuery("#keuangan2").hide()
            jQuery("#keuangan3").hide()
            jQuery("#keuangan4").hide()
            jQuery("#keuangan5").hide()
            jQuery("#keuangan6").hide()
            jQuery("#keuangan7").hide()
            jQuery("#kategori_ticketing").change(function() {
                //  jQuery(this).val() == 'select' ? jQuery("#textarea").hide() : jQuery("#textarea").show();
                var value = jQuery(this).val();
                if (value == "Pertanggungan Honor Mengajar Dosen Luar Biasa (LB)") {
                    $("#keuangan").show();
                    $("#keuangan2").hide();
                    $("#keuangan3").hide();
                    $("#keuangan4").hide();
                    $("#keuangan5").hide();
                    $("#keuangan6").hide();
                    $("#keuangan7").hide();
                } else if (value == "Pertanggungan Honor Pembicara Tamu / Narasumber") {
                    $("#keuangan2").show();
                    $("#keuangan").hide();
                    $("#keuangan3").hide();
                    $("#keuangan4").hide();
                    $("#keuangan5").hide();
                    $("#keuangan6").hide();
                    $("#keuangan7").hide();
                } else if (value == "Pertanggungan Konsumsi (Snack/Makan)") {
                    $("#keuangan3").show();
                    $("#keuangan").hide();
                    $("#keuangan2").hide();
                    $("#keuangan4").hide();
                    $("#keuangan5").hide();
                    $("#keuangan6").hide();
                    $("#keuangan7").hide();
                } else if (value == "Pertanggungan SPPD") {
                    $("#keuangan4").show();
                    $("#keuangan").hide();
                    $("#keuangan2").hide();
                    $("#keuangan3").hide();
                    $("#keuangan5").hide();
                    $("#keuangan6").hide();
                    $("#keuangan7").hide();
                } else if (value == "Pertanggungan Biaya Pelatihan/Sertifikasi/Asosiasi") {
                    $("#keuangan5").show();
                    $("#keuangan").hide();
                    $("#keuangan2").hide();
                    $("#keuangan3").hide();
                    $("#keuangan4").hide();
                    $("#keuangan6").hide();
                    $("#keuangan7").hide();
                } else if (value == "Pertanggungan Pembelian Barang Habis Pakai") {
                    $("#keuangan6").show();
                    $("#keuangan").hide();
                    $("#keuangan2").hide();
                    $("#keuangan3").hide();
                    $("#keuangan4").hide();
                    $("#keuangan5").hide();
                    $("#keuangan7").hide();
                } else if (value == "Penggunaan Jasa Pihak ke 3 (Sewa, Pembuatan Barang, Maintenance)") {
                    $("#keuangan7").show();
                    $("#keuangan").hide();
                    $("#keuangan2").hide();
                    $("#keuangan3").hide();
                    $("#keuangan4").hide();
                    $("#keuangan5").hide();
                    $("#keuangan6").hide();
                } else {
                    jQuery("#keuangan").hide()
                    jQuery("#keuangan2").hide()
                    jQuery("#keuangan3").hide()
                    jQuery("#keuangan4").hide()
                    jQuery("#keuangan5").hide()
                    jQuery("#keuangan6").hide()
                    jQuery("#keuangan7").hide()
                }
            });
        });
    </script>

    <main class="akun-container">
        <div class="fik-section-title2"></div>
        <section class="multi-step-form">
            <form id="msform" method="post" action="<?php echo site_url('surat/submit'); ?>" enctype="multipart/form-data">

                <div class="text-center mb-4">
                    <h3>Verification Process</h3>
                    <p class="text-muted">Complete these steps to verify your account.</p>
                </div>

                <!-- Progress bar -->
                <div class="progress-container">
                    <div class="progress-bar-animated" id="progressBar"></div>
                </div>

                <div class="step-counter">
                    Step <span id="currentStep">1</span> of <span id="totalSteps">3</span>
                </div>
<!-- Step 1 (Dulunya Step 2) -->
<fieldset class="active">
    <div class="container">

        <!-- Jenis Pengajuan & Status -->
        <div class="row mb-3">
            <div class="col-md-6">
                <select class="form-control" name="jenis_pengajuan" id="jenis_pengajuan" required>
                    <option disabled selected value="">Jenis Pengajuan</option>
                    <option value="Kelompok">Kelompok</option>
                    <option value="Perorangan">Perorangan</option>
                </select>
            </div>

            <div class="col-md-6">
                <select class="form-control" name="lingkup_penugasan" id="lingkup_penugasan" required>
                    <option disabled selected value="">Status Kepegawaian</option>
                    <option value="Dosen">Dosen</option>
                    <option value="TPA">TPA</option>
                    <option value="Dosen dan TPA">Dosen dan TPA</option>
                </select>
            </div>
        </div>

        <!-- Jenis Penugasan Perorangan -->
        <div class="form-group has-select mb-3" id="jenis_penugasan_perorangan_container" style="display: none;">
            <select class="form-control" name="jenis_penugasan" id="jenis_penugasan_perorangan">
                <option disabled selected value="">Jenis Penugasan</option>
                <option value="Juri">Juri</option>
                <option value="Pembicara">Pembicara</option>
                <option value="Narasumber">Narasumber</option>
                <option value="Lainnya">Lainnya</option>
            </select>

            <input type="text" class="form-control custom-form-control"
                   name="penugasan_lainnya_perorangan" id="penugasan_lainnya_perorangan"
                   placeholder="Masukan Jenis Penugasan Lainnya"
                   style="margin-top:12px; display:none;">
        </div>

        <!-- Jenis Penugasan Kelompok -->
        <div class="form-group has-select mb-3" id="jenis_penugasan_kelompok_container" style="display: none;">
            <select class="form-control" name="jenis_penugasan_kelompok" id="jenis_penugasan_kelompok">
                <option disabled selected value="">Jenis Penugasan</option>
                <option value="Tim">Tim</option>
                <option value="Kepanitiaan">Kepanitiaan</option>
                <option value="Lainnya">Lainnya</option>
            </select>

            <input type="text" class="form-control custom-form-control"
                   name="penugasan_lainnya_kelompok" id="penugasan_lainnya_kelompok"
                   placeholder="Masukan Jenis Penugasan Lainnya"
                   style="margin-top:12px; display:none;">
        </div>

        <!-- Field Input Jumlah Baris (Hanya untuk Kelompok) -->
        <div class="form-group mb-4" id="jumlah_baris_container" style="display: none;">
            <label for="jumlah_baris">Jumlah Anggota Kelompok</label>
            <div class="input-group">
                <input type="number" class="form-control" id="jumlah_baris" name="jumlah_baris" 
                       min="1" max="20" value="1" placeholder="Masukkan jumlah anggota">
                <button type="button" class="btn btn-primary" id="generate_rows_btn">
                    <i class="fas fa-sync-alt"></i> Generate Baris
                </button>
            </div>
            <small class="form-text text-muted">Masukkan jumlah anggota kelompok (maksimal 20)</small>
        </div>

        <!-- FORM PANITIA -->
        <div id="panitiaContainer" class="mt-4">
            <!-- Baris akan dibuat secara dinamis -->
        </div>

        <!-- Hidden input untuk menangkap peran untuk jenis perorangan -->
        <input type="hidden" name="peran_perorangan" id="peran_perorangan" value="">

    </div>
</fieldset>

<style>
.button-cell { 
    display: none !important; /* Default: disembunyikan */
    justify-content: center; 
    align-items: center; 
    padding-top: 28px;
}
.button-cell.show {
    display: flex !important; /* Ditampilkan hanya untuk Kelompok */
}
.add-row-btn, .remove-row-btn { 
    width: 35px; 
    height: 35px; 
    border-radius: 50%; 
    padding: 0;
    display: flex !important;
    align-items: center;
    justify-content: center;
}
.panitia-row { 
    transition: all 0.3s ease; 
    opacity: 1; 
    transform: translateY(0); 
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}
.panitia-row.removing { 
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
    fill: #4285f4;
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
    color: #1a73e8;
    background-color: #e8f0fe;
    padding: 0 2px;
    border-radius: 2px;
}

.autocomplete-item:first-child {
    border-left: 4px solid #1a73e8;
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

.multi-step-form, fieldset, .container {
    overflow: visible !important;
}

/* Perbaikan untuk tampilan form */
.form-group.has-select {
    margin-bottom: 1rem;
}

.form-control.custom-form-control {
    margin-top: 12px;
}

.panitia-row:last-child {
    border-bottom: none;
}

/* Styling untuk kolom peran */
.peran-column.hidden {
    display: none !important;
}

.peran-column.visible {
    display: block !important;
}

/* Label tanpa bintang - SUDAH DIPERBAIKI */
.panitia-row label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 6px;
    display: block;
}

/* Hapus tanda bintang dari label yang required */
.panitia-row label::after {
    content: none !important;
}

/* Style untuk input yang required */
.panitia-row input[required] {
    border-color: #ced4da;
}

/* Styling untuk jumlah baris */
#jumlah_baris_container {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    margin-top: 20px;
}

#jumlah_baris_container label {
    font-weight: 600;
    margin-bottom: 8px;
    color: #495057;
}

#generate_rows_btn {
    min-width: 140px;
}

/* Styling untuk tampilan awal (belum memilih jenis pengajuan) */
.form-disabled .panitia-row {
    opacity: 0.6;
    pointer-events: none;
}

.form-disabled .panitia-row input {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .panitia-row .col-md-2,
    .panitia-row .col-md-3,
    .panitia-row .col-md-1 {
        flex: 0 0 auto;
        width: 100%;
        margin-bottom: 10px;
    }
    
    .button-cell {
        justify-content: flex-start;
        margin-top: 0;
        padding-top: 0;
    }
    
    /* Adjust kolom peran untuk tampilan mobile */
    .peran-column {
        width: 100% !important;
    }
    
    /* Responsive autocomplete */
    .autocomplete-box-fixed {
        position: absolute !important;
        width: 90% !important;
        left: 5% !important;
        right: 5% !important;
        max-height: 300px;
    }
    
    /* Responsive jumlah baris */
    #jumlah_baris_container .input-group {
        flex-direction: column;
    }
    
    #generate_rows_btn {
        margin-top: 10px;
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const panitiaContainer = document.getElementById('panitiaContainer');
    const jenisPengajuan = document.getElementById('jenis_pengajuan');
    const jenisPenugasanPeroranganContainer = document.getElementById('jenis_penugasan_perorangan_container');
    const jenisPenugasanKelompokContainer = document.getElementById('jenis_penugasan_kelompok_container');
    const jumlahBarisContainer = document.getElementById('jumlah_baris_container');
    const jumlahBarisInput = document.getElementById('jumlah_baris');
    const generateRowsBtn = document.getElementById('generate_rows_btn');
    const peranPeroranganHidden = document.getElementById('peran_perorangan');
    
    let isSelectingAutocomplete = false;

    // Mock data untuk testing
    const mockData = [
        { nip: '17770081', nama_dosen: 'Dr. Moh Isa Pramana Koesoemadinata, S.Sn, M.Sn.', jabatan: 'Dosen', kaprodi: 'DKV'},
        { nip: '14800004', nama_dosen: 'Bijaksana Prabawa, S.Ds., M.M.', jabatan: 'Dosen', kaprodi: 'DKV'},
        { nip: '14810009', nama_dosen: 'Dr. Ira Wirasari, S.Sos., M.Ds.', jabatan: 'Dosen', kaprodi: 'DKV' },
        { nip: '19860001', nama_dosen: 'Mahendra Nur Hadiansyah, S.T., M.Ds.', jabatan: 'Dosen', kaprodi: 'DI'},
        { nip: '19850010', nama_dosen: 'Diena Yudiarti, S.Ds., M.S.M.', jabatan: 'Dosen', kaprodi: 'DKV'},
        { nip: '20940012', nama_dosen: 'Ganesha Puspa Nabila, S.Sn., M.Ds.', jabatan: 'Dosen', kaprodi: 'DI'},
        { nip: '20950008', nama_dosen: 'Hana Faza Surya Rusyda, ST., M.Ars.', jabatan: 'Dosen', kaprodi: 'DI'},
        { nip: '20920049', nama_dosen: 'Angelia Lionardi, S.Sn., M.Ds.', jabatan: 'Dosen', kaprodi: 'DKV'},
        { nip: '15870029', nama_dosen: 'Ica Ramawisari, S.T., M.T.', jabatan: 'Dosen', kaprodi: 'DP' },
        { nip: '82196019', nama_dosen: 'Alisa Rahadiasmurti Isfandiari, S.A.B., M.M.', jabatan: 'Dosen', kaprodi: 'Ketua KK'  }
    ];

    // Global state untuk autocomplete
    let currentAutocompleteBox = null;
    let currentKeydownHandler = null;
    let currentClickHandler = null;
    let currentInputElement = null;
    let currentAutocompleteItems = [];

    // Fungsi untuk membuat elemen baris dengan tombol yang benar
    function createRowElement(index, showButtons = false, isFirstRow = false) {
        const rowEl = document.createElement('div');
        rowEl.className = 'row g-3 align-items-end panitia-row';
        rowEl.dataset.rowIndex = index;
        
        let buttonHtml = '';
        let buttonCellClass = 'button-cell';
        
        if (showButtons) {
            buttonCellClass += ' show';
            if (isFirstRow) {
                // Baris pertama: tombol tambah
                buttonHtml = `
                    <button type="button" class="btn btn-success add-row-btn" title="Tambah Baris">
                        <i class="fas fa-plus"></i>
                    </button>
                `;
            } else {
                // Baris lainnya: tombol kurang
                buttonHtml = `
                    <button type="button" class="btn btn-danger remove-row-btn" title="Hapus Baris">
                        <i class="fas fa-minus"></i>
                    </button>
                `;
            }
        }
        
        rowEl.innerHTML = `
            <div class="col-md-2 position-relative">
                <label>NIP</label>
                <input type="text" name="nip[]" class="form-control nip-input" autocomplete="off" required>
            </div>

            <div class="col-md-3 position-relative">
                <label>Nama Dosen</label>
                <input type="text" name="nama_dosen[]" class="form-control nama-dosen-input" autocomplete="off" required>
            </div>

            <div class="col-md-2 position-relative">
                <label>Jabatan</label>
                <input type="text" name="jabatan[]" class="form-control jabatan-input" autocomplete="off" required>
            </div>

            <div class="col-md-2 position-relative">
                <label>Kaprodi</label>
                <input type="text" name="kaprodi[]" class="form-control kaprodi-input" autocomplete="off" required>
            </div>

            <div class="col-md-2 position-relative peran-column">
                <label>Peran</label>
                <input type="text" name="peran[]" class="form-control peran-input" autocomplete="off" placeholder="Masukkan peran/posisi">
            </div>

            <div class="col-md-1 text-center ${buttonCellClass}">
                ${buttonHtml}
            </div>
        `;
        
        return rowEl;
    }

    // Update semua tampilan berdasarkan jenis pengajuan
    function updateViewBasedOnPengajuan() {
        console.log('Updating view for:', jenisPengajuan.value);
        
        // Toggle visibility jenis penugasan
        if (jenisPengajuan.value === 'Perorangan') {
            jenisPenugasanPeroranganContainer.style.display = 'block';
            jenisPenugasanKelompokContainer.style.display = 'none';
            jumlahBarisContainer.style.display = 'none';
        } else if (jenisPengajuan.value === 'Kelompok') {
            jenisPenugasanPeroranganContainer.style.display = 'none';
            jenisPenugasanKelompokContainer.style.display = 'block';
            jumlahBarisContainer.style.display = 'block';
        } else {
            jenisPenugasanPeroranganContainer.style.display = 'none';
            jenisPenugasanKelompokContainer.style.display = 'none';
            jumlahBarisContainer.style.display = 'none';
        }
        
        // Kosongkan container
        panitiaContainer.innerHTML = '';
        
        if (jenisPengajuan.value === 'Kelompok') {
            // Untuk kelompok: buat baris sesuai jumlah dengan TAMPILKAN TOMBOL
            const jumlah = parseInt(jumlahBarisInput.value) || 1;
            
            for (let i = 0; i < jumlah; i++) {
                const isFirstRow = (i === 0);
                const rowEl = createRowElement(i, true, isFirstRow); // true = showButtons
                panitiaContainer.appendChild(rowEl);
            }
            
            // Tampilkan kolom peran
            document.querySelectorAll('.peran-column').forEach(col => {
                col.style.display = 'block';
                col.classList.remove('hidden');
                col.classList.add('visible');
            });
            
            // Enable form dan hapus disabled state
            panitiaContainer.classList.remove('form-disabled');
            
        } else if (jenisPengajuan.value === 'Perorangan') {
            // Untuk perorangan: hanya 1 baris TANPA TOMBOL
            const rowEl = createRowElement(0, false, false); // false = showButtons
            panitiaContainer.appendChild(rowEl);
            
            // Sembunyikan kolom peran
            document.querySelectorAll('.peran-column').forEach(col => {
                col.style.display = 'none';
                col.classList.add('hidden');
                col.classList.remove('visible');
            });
            
            // Enable form
            panitiaContainer.classList.remove('form-disabled');
            
        } else {
            // Belum memilih: 1 baris kosong TANPA TOMBOL
            const rowEl = createRowElement(0, false, false); // false = showButtons
            panitiaContainer.appendChild(rowEl);
            
            // Sembunyikan kolom peran
            document.querySelectorAll('.peran-column').forEach(col => {
                col.style.display = 'none';
                col.classList.add('hidden');
                col.classList.remove('visible');
            });
            
            // Disable form
            panitiaContainer.classList.add('form-disabled');
        }
        
        // Inisialisasi autocomplete
        setTimeout(() => {
            initializeAllRows();
        }, 100);
    }

    // Event listener untuk jenis pengajuan
    jenisPengajuan.addEventListener('change', function () {
        updateViewBasedOnPengajuan();
    });

    // Event listener untuk tombol generate baris
    generateRowsBtn.addEventListener('click', function() {
        if (jenisPengajuan.value === 'Kelompok') {
            const jumlah = parseInt(jumlahBarisInput.value) || 1;
            if (jumlah < 1) {
                alert('Jumlah baris minimal 1');
                jumlahBarisInput.value = 1;
                return;
            }
            if (jumlah > 20) {
                alert('Jumlah baris maksimal 20');
                jumlahBarisInput.value = 20;
                return;
            }
            
            updateViewBasedOnPengajuan();
        }
    });

    // Event listener untuk input jumlah baris (enter untuk generate)
    jumlahBarisInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            generateRowsBtn.click();
        }
    });

    // Inisialisasi awal
    window.addEventListener('load', function() {
        updateViewBasedOnPengajuan();
    });

    // Handle "Lainnya" option untuk penugasan perorangan
    document.getElementById('jenis_penugasan_perorangan').addEventListener('change', function() {
        const lainnyaInput = document.getElementById('penugasan_lainnya_perorangan');
        lainnyaInput.style.display = this.value === 'Lainnya' ? 'block' : 'none';
        if (this.value !== 'Lainnya') {
            lainnyaInput.value = '';
        }
    });

    // Handle "Lainnya" option untuk penugasan kelompok
    document.getElementById('jenis_penugasan_kelompok').addEventListener('change', function() {
        const lainnyaInput = document.getElementById('penugasan_lainnya_kelompok');
        lainnyaInput.style.display = this.value === 'Lainnya' ? 'block' : 'none';
        if (this.value !== 'Lainnya') {
            lainnyaInput.value = '';
        }
    });

    // Debounce function
    function debounce(fn, delay = 300) {
        let timeout;
        return function (...args) {
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
        currentAutocompleteItems = [];
    }

    // Fetch suggestions
    async function fetchSuggestions(query, fieldType = 'nip') {
        if (!query) return [];
        
        try {
            if (fieldType !== 'nip' && fieldType !== 'nama_dosen') {
                return [];
            }
            
            await new Promise(resolve => setTimeout(resolve, 150));
            const lowerQuery = query.toLowerCase();
            return mockData.filter(item => {
                const searchIn = item[fieldType] ? item[fieldType].toLowerCase() : '';
                return searchIn.includes(lowerQuery);
            });
        } catch (error) {
            console.error('Autocomplete error:', error);
            return [];
        }
    }

    // Fungsi untuk memilih opsi autocomplete
    function selectAutocompleteItem(item, inputElement, onSelect) {
        if (!item) return;
        
        isSelectingAutocomplete = true;
        
        const fieldType = inputElement.classList.contains('nip-input') ? 'nip' : 'nama_dosen';
        if (fieldType === 'nip') {
            inputElement.value = item.nip || '';
        } else {
            inputElement.value = item.nama_dosen || '';
        }
        
        if (typeof onSelect === 'function') {
            onSelect(item);
        }
        
        removeAutocompleteBox();
        
        setTimeout(() => {
            isSelectingAutocomplete = false;
        }, 300);
    }

    // Show suggestion box
    function showSuggestionBox(inputEl, items, onSelect, fieldType) {
        // Jangan tampilkan autocomplete jika form disabled
        if (jenisPengajuan.value === '' || inputEl.disabled) {
            return;
        }
        
        removeAutocompleteBox();

        if (fieldType !== 'nip' && fieldType !== 'nama_dosen') {
            return;
        }

        const rect = inputEl.getBoundingClientRect();
        const box = document.createElement('div');
        box.className = 'autocomplete-box-fixed';
        box.style.left = rect.left + 'px';
        box.style.top = (rect.bottom + 4) + 'px';
        box.style.width = Math.max(rect.width, 350) + 'px';

        if (!items || !items.length) {
            const empty = document.createElement('div');
            empty.className = 'autocomplete-empty';
            empty.innerHTML = '<i class="fas fa-search" style="margin-right: 8px; opacity: 0.6;"></i>Tidak ada data ditemukan';
            box.appendChild(empty);
            document.body.appendChild(box);
            currentAutocompleteBox = box;
            currentInputElement = inputEl;
            setTimeout(() => removeAutocompleteBox(), 2000);
            return;
        }

        const query = inputEl.value.trim();
        let selectedIndex = -1;
        currentAutocompleteItems = items;

        items.forEach((item, idx) => {
            const option = document.createElement('div');
            option.className = `autocomplete-item type-${fieldType}`;
            option.dataset.index = idx;
            
            let primaryText = '';
            let secondaryText = '';
            
            switch(fieldType) {
                case 'nip':
                    primaryText = highlightMatch(item.nip, query);
                    secondaryText = item.nama_dosen;
                    break;
                case 'nama_dosen':
                    primaryText = highlightMatch(item.nama_dosen, query);
                    secondaryText = `NIP: ${item.nip}`;
                    break;
                default:
                    primaryText = item[fieldType] || '-';
                    secondaryText = `${item.nama_dosen} (${item.nip})`;
            }

            option.innerHTML = `
                <div class="autocomplete-icon">
                    <svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="#4285f4"></path>
                    </svg>
                </div>
                <div class="autocomplete-content">
                    <div class="item-primary">${primaryText || '-'}</div>
                    ${secondaryText ? '<div class="item-secondary">' + secondaryText + '</div>' : ''}
                </div>
            `;
            
            option.addEventListener('mousedown', (e) => {
                e.preventDefault();
                e.stopPropagation();
                selectAutocompleteItem(item, inputEl, onSelect);
            });
            
            box.appendChild(option);
        });

        document.body.appendChild(box);
        currentAutocompleteBox = box;
        currentInputElement = inputEl;

        currentClickHandler = function(ev) {
            if (currentAutocompleteBox && !currentAutocompleteBox.contains(ev.target) && ev.target !== currentInputElement) {
                if (!isSelectingAutocomplete) {
                    removeAutocompleteBox();
                }
            }
        };
        document.addEventListener('click', currentClickHandler);
    }

    // Initialize autocomplete for a row
    function initAutocompleteForRow(rowEl) {
        if (!rowEl) return;
        
        delete rowEl.dataset.autocompleteInitialized;

        const inputNip = rowEl.querySelector('.nip-input');
        const inputNama = rowEl.querySelector('.nama-dosen-input');
        const inputJabatan = rowEl.querySelector('.jabatan-input');
        const inputKaprodi = rowEl.querySelector('.kaprodi-input');
        const inputPeran = rowEl.querySelector('.peran-input');

        if (!inputNip || !inputNama) {
            return;
        }

        function fillRowWith(item) {
            if (!item) return;
            
            inputNip.value = item.nip || '';
            inputNama.value = item.nama_dosen || '';
            if (inputJabatan) inputJabatan.value = item.jabatan || '';
            if (inputKaprodi) inputKaprodi.value = item.kaprodi || '';
        }

        function createAutocompleteHandler(fieldType, inputElement) {
            if (fieldType !== 'nip' && fieldType !== 'nama_dosen') return;

            const handler = debounce(async function() {
                if (isSelectingAutocomplete) {
                    return;
                }
                
                if (this.disabled || jenisPengajuan.value === '') {
                    return;
                }
                
                const val = this.value.trim();
                
                if (val.length < 2 || document.activeElement !== this) {
                    removeAutocompleteBox();
                    return;
                }

                const suggestions = await fetchSuggestions(val, fieldType);
                showSuggestionBox(inputElement, suggestions, fillRowWith, fieldType);
            }, 250);

            if (inputElement._currentHandler) {
                inputElement.removeEventListener('input', inputElement._currentHandler);
            }
            
            inputElement._currentHandler = handler;
            inputElement.addEventListener('input', handler);
        }

        createAutocompleteHandler('nip', inputNip);
        createAutocompleteHandler('nama_dosen', inputNama);

        rowEl.dataset.autocompleteInitialized = 'true';
    }

    // Tambah baris baru (untuk kelompok)
    function addNewRow() {
        if (jenisPengajuan.value !== 'Kelompok') return;
        
        const currentRows = panitiaContainer.querySelectorAll('.panitia-row').length;
        const newRow = createRowElement(currentRows, true, false); // true = showButtons, false = bukan baris pertama
        panitiaContainer.appendChild(newRow);
        
        // Update jumlah di input
        jumlahBarisInput.value = currentRows + 1;
        
        // Inisialisasi autocomplete untuk baris baru
        setTimeout(() => {
            initAutocompleteForRow(newRow);
            // Tambah event listener untuk tombol kurang
            const removeBtn = newRow.querySelector('.remove-row-btn');
            if (removeBtn) {
                removeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    removeRow(newRow);
                });
            }
        }, 100);
    }

    // Hapus baris (untuk kelompok)
    function removeRow(rowEl) {
        if (jenisPengajuan.value !== 'Kelompok') return;
        
        const totalRows = panitiaContainer.querySelectorAll('.panitia-row').length;
        if (totalRows <= 1) {
            alert('Minimal harus ada 1 baris data');
            return;
        }
        
        rowEl.classList.add('removing');
        setTimeout(() => {
            if (rowEl.parentNode) {
                rowEl.remove();
                // Update jumlah di input
                const currentRows = panitiaContainer.querySelectorAll('.panitia-row').length;
                jumlahBarisInput.value = currentRows;
            }
        }, 300);
    }

    // Initialize semua baris
    function initializeAllRows() {
        const rows = panitiaContainer.querySelectorAll('.panitia-row');
        
        rows.forEach((row, index) => {
            row.dataset.rowIndex = index;
            delete row.dataset.autocompleteInitialized;
            initAutocompleteForRow(row);
            
            // Setup event listeners untuk tombol (hanya untuk Kelompok)
            if (jenisPengajuan.value === 'Kelompok') {
                const addBtn = row.querySelector('.add-row-btn');
                const removeBtn = row.querySelector('.remove-row-btn');
                
                if (addBtn) {
                    addBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        addNewRow();
                    });
                }
                
                if (removeBtn) {
                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        removeRow(row);
                    });
                }
            }
        });
    }

    // Event delegation untuk container (fallback)
    panitiaContainer.addEventListener('click', function (e) {
        if (jenisPengajuan.value !== 'Kelompok') return;
        
        const addBtn = e.target.closest('.add-row-btn');
        const removeBtn = e.target.closest('.remove-row-btn');

        if (addBtn) {
            e.preventDefault();
            e.stopPropagation();
            addNewRow();
        }

        if (removeBtn) {
            e.preventDefault();
            e.stopPropagation();
            const rowEl = removeBtn.closest('.panitia-row');
            if (rowEl) {
                removeRow(rowEl);
            }
        }
    });

    // Submit form validation
    document.querySelector('form')?.addEventListener('submit', function(e) {
        if (!jenisPengajuan.value) {
            e.preventDefault();
            alert('Mohon pilih Jenis Pengajuan terlebih dahulu');
            jenisPengajuan.focus();
            return;
        }
    });
});
</script>
<!-- Step 2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<fieldset>
  <div class="custom-form" style="position: relative; z-index: 1;">
    <input type="hidden" name="user_id" id="user_id" value="632045c808b1c">

    <!-- Nama kegiatan (WAJIB) -->
    <div class="form-group mb-4">
      <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required autocomplete="off">
     <label>Nama Kegiatan</label>
    </div>

    <!-- Pilihan jenis tanggal (WAJIB) -->
    <div class="form-group has-select mb-4">
      <select class="nice form-control" name="jenis_date" id="jenis_date" required>
        <option disabled selected value="">Tanggal Kegiatan</option>
        <option value="Periode">Periode</option>
        <option value="Custom">Custom</option>
      </select>
    </div>

    <div class="row">
      <!-- Tanggal awal & akhir kegiatan (WAJIB untuk Custom) -->
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <input type="text" id="datepicker" class="form-control custom-form-control"
                 autocomplete="off" inputmode="none" readonly
                >

          <label id="lbl_mulai">Tanggal Awal s/d Akhir</label>

          <!-- Hidden input -->
          <input type="hidden" id="tanggal_awal_kegiatan" name="tanggal_awal_kegiatan">
          <input type="hidden" id="tanggal_akhir_kegiatan" name="tanggal_akhir_kegiatan">

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
            Klik tanggal awal, lalu klik tanggal akhir
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
                 class="form-control custom-form-control"
                 autocomplete="off" inputmode="none" readonly
                 >

          <label id="lbl_mulai1">Periode Penugasan</label>
          <div class="info-message small" id="info_periode">Akan terisi otomatis</div>
        </div>
      </div>

      <!-- Akhir penugasan -->
      <div class="col-md-4 mt-3">
        <div class="form-group">
          <input type="text" name="akhir_periode_penugasan" id="datepicker4"
                 class="form-control custom-form-control"
                 autocomplete="off" inputmode="none" readonly
                 >

          <label id="lbl_akhir1">Akhir Penugasan</label>
          <div class="info-message small" id="info_akhir">Akan terisi otomatis</div>
        </div>
      </div>
    </div>

    <!-- Dropdown periode -->
    <div id="periode_section" class="form-group has-select" 
         style="display:none; position:relative; margin-top: 20px; margin-bottom: 60px;">
      <select class="nice form-control" name="periode_value" id="periode_value">
        <option disabled selected value="">Pilih Periode</option>
        <option value="2024/2025 Ganjil">2024/2025 Ganjil</option>
        <option value="2024/2025 Genap">2024/2025 Genap</option>
        <option value="2025/2026 Ganjil">2025/2026 Ganjil</option>
        <option value="2025/2026 Genap">2025/2026 Genap</option>
      </select>
    </div>

    <!-- Tempat kegiatan (OPSIONAL) -->
    <div class="form-group mb-4">
      <input type="text" name="tempat_kegiatan" class="form-control custom-form-control" 
             autocomplete="off">
      <label>Tempat Kegiatan <span style="color: #6c757d; font-size: 12px;">(Opsional)</span></label>
    </div>

    <!-- Penyelenggara (OPSIONAL) -->
    <div class="form-group mb-4">
      <input type="text" name="penyelenggara" class="form-control custom-form-control" 
             autocomplete="off">
      <label>Penyelenggara <span style="color: #6c757d; font-size: 12px;">(Opsional)</span></label>
    </div>
  </div>
</fieldset>

<!-- CSS -->
<style>
    /* Hilangkan datepicker bawaan browser */
    input::-webkit-calendar-picker-indicator {
        display: none !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }

    /* Style untuk form yang sudah ada (tidak diubah) */
    .form-group { 
        margin-bottom: 20px; 
    }

    #periode_section {
        position: relative;
        z-index: 9999 !important;
        transition: margin-bottom 0.3s ease;
    }

    .nice-select {
        z-index: 99999 !important;
    }

    .nice-select.open {
        z-index: 999999 !important;
    }

    #periode_section.open-margin {
        margin-bottom: 250px !important;
    }

    .has-select select.nice-original {
        display: none !important;
    }

    .nice-select .list {
        max-height: 200px;
        overflow-y: auto;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        display: none;
        padding: 8px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        animation: fadeIn 0.3s ease;
    }

    .form-group.has-error input {
        border-color: #dc3545 !important;
    }

    .info-message {
        color: #0d6efd;
        font-size: 12px;
        margin-top: 5px;
    }

    .success-message {
        color: #198754;
        font-size: 12px;
        margin-top: 5px;
        display: none;
    }

    .custom-form-control {
        padding: 10px 12px;
        font-size: 14px;
        height: 45px;
    }

    .auto-filled {
        background-color: #f0f8ff !important;
        border-left: 3px solid #007bff !important;
    }

    @keyframes highlight {
        0% { background-color: #fff3cd; }
        100% { background-color: #f0f8ff; }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .highlight-animation {
        animation: highlight 1s ease;
    }

    /* Style untuk konfirmasi tanggal */
    #konfirmasi_tanggal {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 8px 10px;
        border-left: 3px solid #28a745;
    }

    /* Badge untuk counter hari */
    .badge.bg-info {
        font-size: 10px;
        padding: 3px 8px;
        font-weight: 600;
    }

    /* Flatpickr disabled date styling */
    .flatpickr-day.disabled {
        color: #ccc !important;
        background-color: #f8f9fa !important;
        cursor: not-allowed !important;
        text-decoration: line-through;
    }
    
    .flatpickr-day.disabled:hover {
        background-color: #f8f9fa !important;
        color: #ccc !important;
    }

    /* Flatpickr day limit styling */
    .flatpickr-day.over-limit {
        color: #ff6b6b !important;
        background-color: #ffeaea !important;
        text-decoration: line-through;
    }
    
    .flatpickr-day.over-limit:hover {
        background-color: #ffeaea !important;
        color: #ff6b6b !important;
        cursor: not-allowed;
    }

    /* Flatpickr selected date styling */
    .flatpickr-day.selected {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: white !important;
        font-weight: bold;
    }
    
    .flatpickr-day.selected:hover {
        background-color: #0056b3 !important;
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .custom-form-control {
            height: 42px;
            font-size: 13px;
        }
        
        .ui-datepicker {
            display: none !important;
        }
        
        #konfirmasi_tanggal {
            padding: 6px 8px;
            font-size: 11px;
        }
        
        .error-message {
            font-size: 11px;
            padding: 6px;
        }
        
        .badge.bg-info {
            font-size: 9px;
            padding: 2px 6px;
        }
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Variabel untuk menyimpan tanggal awal yang dipilih
    let selectedStartDate = null;
    const MAX_DAYS_LIMIT = 60; // Batas maksimal 60 hari

    // Fungsi untuk menghitung tanggal 30 hari yang lalu dari hari ini
    function getMinAllowedDate() {
        const today = new Date();
        const minDate = new Date(today);
        minDate.setDate(today.getDate() - 30);
        return minDate;
    }

    // Fungsi untuk format tanggal ke format Indonesia
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

    // Fungsi untuk format tanggal ke YYYY-MM-DD
    function formatDateLocal(date) {
        const y = date.getFullYear();
        const m = (date.getMonth() + 1).toString().padStart(2, "0");
        const d = date.getDate().toString().padStart(2, "0");
        return `${y}-${m}-${d}`;
    }

    // Fungsi untuk menghitung selisih hari antara dua tanggal
    function calculateDayDifference(startDate, endDate) {
        const oneDay = 24 * 60 * 60 * 1000; // milliseconds dalam satu hari
        const diffDays = Math.round(Math.abs((endDate - startDate) / oneDay));
        return diffDays;
    }

    // Fungsi untuk menonaktifkan tanggal yang melebihi batas 60 hari dari tanggal awal
    function disableDatesBeyondLimit(date) {
        if (!selectedStartDate) return false;
        
        const diffDays = calculateDayDifference(selectedStartDate, date);
        return diffDays > MAX_DAYS_LIMIT;
    }

    // Fungsi untuk validasi tanggal range
    function validateDateRange(selectedDates) {
        const dateError = document.getElementById("date_error");
        const errorText = document.getElementById("error_text");
        const datepickerInput = document.getElementById("datepicker");
        const formGroup = datepickerInput.closest('.form-group');
        
        if (selectedDates.length === 2) {
            const startDate = selectedDates[0];
            const endDate = selectedDates[1];
            const minAllowedDate = getMinAllowedDate();
            
            // Reset error state
            dateError.style.display = 'none';
            formGroup.classList.remove('has-error');
            
            // Validasi 1: tanggal awal tidak boleh lebih dari 30 hari ke belakang
            if (startDate < minAllowedDate) {
                errorText.textContent = `Tanggal awal tidak boleh lebih dari 30 hari ke belakang dari hari ini (${formatDateIndonesian(minAllowedDate)})`;
                dateError.style.display = 'block';
                formGroup.classList.add('has-error');
                return false;
            }
            
            // Validasi 2: tanggal akhir tidak boleh lebih dari 30 hari ke belakang
            if (endDate < minAllowedDate) {
                errorText.textContent = `Tanggal akhir tidak boleh lebih dari 30 hari ke belakang dari hari ini (${formatDateIndonesian(minAllowedDate)})`;
                dateError.style.display = 'block';
                formGroup.classList.add('has-error');
                return false;
            }
            
            // Validasi 3: tanggal akhir tidak boleh lebih dari 60 hari dari tanggal awal
            const dayDifference = calculateDayDifference(startDate, endDate);
            if (dayDifference > MAX_DAYS_LIMIT) {
                errorText.textContent = `Rentang tanggal tidak boleh lebih dari ${MAX_DAYS_LIMIT} hari. Rentang saat ini: ${dayDifference} hari`;
                dateError.style.display = 'block';
                formGroup.classList.add('has-error');
                return false;
            }
            
            // Validasi 4: tanggal akhir tidak boleh sebelum tanggal awal
            if (endDate < startDate) {
                errorText.textContent = 'Tanggal akhir tidak boleh sebelum tanggal awal';
                dateError.style.display = 'block';
                formGroup.classList.add('has-error');
                return false;
            }
            
            return true;
        }
        
        return false;
    }

    // Fungsi untuk validasi Step 2 sebelum melanjutkan
    function validateStep2() {
        const namaKegiatan = document.getElementById("nama_kegiatan").value.trim();
        const jenisDate = document.getElementById("jenis_date").value;
        const datepickerInput = document.getElementById("datepicker");
        const datepicker = window.datepicker; // Reference to flatpickr instance
        const selectedDates = datepicker ? datepicker.selectedDates : [];
        
        let isValid = true;
        let errorMessage = "";
        
        // Validasi 1: Nama Kegiatan harus diisi
        if (!namaKegiatan) {
            isValid = false;
            errorMessage = "Nama Kegiatan harus diisi";
            document.getElementById("nama_kegiatan").focus();
        }
        // Validasi 2: Jenis Tanggal harus dipilih
        else if (!jenisDate) {
            isValid = false;
            errorMessage = "Pilih jenis tanggal kegiatan";
            document.getElementById("jenis_date").focus();
        }
        // Validasi 3: Jika jenis Custom, tanggal harus dipilih
        else if (jenisDate === "Custom" && selectedDates.length !== 2) {
            isValid = false;
            errorMessage = "Pilih tanggal awal dan akhir kegiatan";
            datepickerInput.focus();
        }
        // Validasi 4: Jika jenis Periode, periode harus dipilih
        else if (jenisDate === "Periode") {
            const periodeValue = document.getElementById("periode_value").value;
            if (!periodeValue) {
                isValid = false;
                errorMessage = "Pilih periode kegiatan";
                document.getElementById("periode_value").focus();
            }
        }
        
        // Tampilkan pesan error jika validasi gagal
        if (!isValid) {
            alert("⚠ " + errorMessage);
        }
        
        return isValid;
    }

    // Fungsi untuk mengupdate status tombol CONTINUE
    function updateContinueButtonState() {
        const nextBtn = document.querySelector('.next-btn');
        const step2Fieldset = document.querySelector('fieldset:nth-of-type(2)');
        
        if (nextBtn && step2Fieldset && step2Fieldset.classList.contains('active')) {
            // Hapus atribut disabled dan ubah style
            nextBtn.disabled = false;
            nextBtn.style.cursor = 'pointer';
            nextBtn.style.backgroundColor = '#007bff';
            nextBtn.style.borderColor = '#007bff';
            nextBtn.style.opacity = '1';
            
            // Hapus validasi untuk kolom opsional
            const tempatKegiatan = document.querySelector('input[name="tempat_kegiatan"]');
            const penyelenggara = document.querySelector('input[name="penyelenggara"]');
            
            if (tempatKegiatan) {
                tempatKegiatan.required = false;
            }
            
            if (penyelenggara) {
                penyelenggara.required = false;
            }
            
            // Update text tombol
            const nextBtnText = document.getElementById('next-btn-text');
            if (nextBtnText) {
                nextBtnText.textContent = 'Continue';
            }
            
            console.log("✅ Tombol CONTINUE di Step 2 diaktifkan");
        }
    }

    // Inisialisasi flatpickr dengan validasi tanggal
    const minAllowedDate = getMinAllowedDate();
    const datepicker = flatpickr("#datepicker", {
        mode: "range",
        dateFormat: "Y-m-d",
        allowInput: false,
        minDate: minAllowedDate, // Tidak bisa pilih tanggal sebelum 30 hari yang lalu
        locale: {
            firstDayOfWeek: 1 // Senin
        },
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            // Tambahkan kelas khusus untuk tanggal yang melebihi batas 60 hari
            if (selectedStartDate) {
                const currentDate = new Date(dayElem.dateObj);
                const diffDays = calculateDayDifference(selectedStartDate, currentDate);
                
                if (diffDays > MAX_DAYS_LIMIT) {
                    dayElem.classList.add("over-limit");
                    
                    // Tambahkan tooltip
                    dayElem.title = `Melebihi batas ${MAX_DAYS_LIMIT} hari dari tanggal awal`;
                }
            }
        },
        onChange: function(selectedDates, dateStr, instance) {
            const konfirmasiDiv = document.getElementById("konfirmasi_tanggal");
            const dayCounter = document.getElementById("day_counter");
            const rangeInfo = document.getElementById("range_info");
            const dayLimitInfo = document.getElementById("day_limit_info");
            const dateError = document.getElementById("date_error");
            const datepickerInput = document.getElementById("datepicker");
            const formGroup = datepickerInput.closest('.form-group');
            
            // Reset error state setiap kali ada perubahan
            dateError.style.display = 'none';
            formGroup.classList.remove('has-error');
            
            // Tampilkan/sembunyikan info batas hari
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
                
                // Simpan tanggal awal untuk kalkulasi
                selectedStartDate = awal;
                
                // Validasi tanggal
                if (!validateDateRange(selectedDates)) {
                    // Jika validasi gagal, reset datepicker
                    instance.clear();
                    konfirmasiDiv.style.display = 'none';
                    dayCounter.textContent = '';
                    rangeInfo.style.display = 'block';
                    
                    // Reset auto-filled inputs
                    document.getElementById("datepicker3").value = "";
                    document.getElementById("datepicker4").value = "";
                    document.getElementById("info_periode").innerHTML = "Akan terisi otomatis";
                    document.getElementById("info_akhir").innerHTML = "Akan terisi otomatis";
                    
                    // Hapus class styling
                    document.getElementById("datepicker3").classList.remove("auto-filled");
                    document.getElementById("datepicker4").classList.remove("auto-filled");
                    return;
                }
                
                // Format untuk hidden inputs
                const awalFormatted = formatDateLocal(awal);
                const akhirFormatted = formatDateLocal(akhir);
                
                // Format untuk display
                const awalDisplay = formatDateIndonesian(awal);
                const akhirDisplay = formatDateIndonesian(akhir);
                
                // Set hidden inputs
                document.getElementById("tanggal_awal_kegiatan").value = awalFormatted;
                document.getElementById("tanggal_akhir_kegiatan").value = akhirFormatted;
                
                // Set auto-filled inputs
                document.getElementById("datepicker3").value = awalFormatted;
                document.getElementById("datepicker4").value = akhirFormatted;
                
                // Update day counter
                dayCounter.textContent = `${dayDifference} hari`;
                
                // Tampilkan konfirmasi tanggal
                document.getElementById("konfirmasi_awal").innerHTML = `<strong>Awal:</strong> ${awalDisplay}`;
                document.getElementById("konfirmasi_akhir").innerHTML = `<strong>Akhir:</strong> ${akhirDisplay}`;
                konfirmasiDiv.style.display = 'block';
                rangeInfo.style.display = 'none';
                dayLimitInfo.style.display = 'none';
                
                // Update info messages
                document.getElementById("info_periode").innerHTML = "Terisi otomatis ✓";
                document.getElementById("info_akhir").innerHTML = "Terisi otomatis ✓";
                
                // Tambahkan efek visual
                document.getElementById("datepicker3").classList.add("auto-filled", "highlight-animation");
                document.getElementById("datepicker4").classList.add("auto-filled", "highlight-animation");
                
                // Hapus animasi setelah selesai
                setTimeout(() => {
                    document.getElementById("datepicker3").classList.remove("highlight-animation");
                    document.getElementById("datepicker4").classList.remove("highlight-animation");
                }, 1000);
                
            } else if (selectedDates.length === 1) {
                // Jika hanya satu tanggal yang dipilih (tanggal awal)
                const awalDisplay = formatDateIndonesian(selectedDates[0]);
                
                // Validasi tanggal tunggal
                const dateError = document.getElementById("date_error");
                const formGroup = datepickerInput.closest('.form-group');
                const minAllowedDate = getMinAllowedDate();
                
                if (selectedDates[0] < minAllowedDate) {
                    errorText.textContent = `Tanggal tidak boleh lebih dari 30 hari ke belakang dari hari ini (${formatDateIndonesian(minAllowedDate)})`;
                    dateError.style.display = 'block';
                    formGroup.classList.add('has-error');
                    instance.clear();
                    selectedStartDate = null;
                    return;
                }
                
                selectedStartDate = selectedDates[0];
                document.getElementById("konfirmasi_awal").innerHTML = `<strong>Tanggal awal:</strong> ${awalDisplay}`;
                document.getElementById("konfirmasi_akhir").innerHTML = `<strong>Tanggal akhir:</strong> Pilih tanggal akhir (maks ${MAX_DAYS_LIMIT} hari)`;
                konfirmasiDiv.style.display = 'block';
                dayCounter.textContent = '';
                rangeInfo.style.display = 'none';
                dayLimitInfo.style.display = 'block';
                
                // Refresh calendar untuk update disabled dates
                instance.redraw();
            } else {
                // Jika tanggal di-reset
                selectedStartDate = null;
                konfirmasiDiv.style.display = 'none';
                dayCounter.textContent = '';
                rangeInfo.style.display = 'block';
                dayLimitInfo.style.display = 'none';
                
                // Reset auto-filled inputs
                document.getElementById("datepicker3").value = "";
                document.getElementById("datepicker4").value = "";
                document.getElementById("info_periode").innerHTML = "Akan terisi otomatis";
                document.getElementById("info_akhir").innerHTML = "Akan terisi otomatis";
                
                // Hapus class styling
                document.getElementById("datepicker3").classList.remove("auto-filled");
                document.getElementById("datepicker4").classList.remove("auto-filled");
                
                // Refresh calendar
                instance.redraw();
            }
            
            // Update status tombol CONTINUE setelah perubahan tanggal
            updateContinueButtonState();
        },
        onOpen: function(selectedDates, dateStr, instance) {
            // Update info tentang batasan tanggal
            const minDate = getMinAllowedDate();
            const infoElement = instance._input.nextElementSibling;
            if (infoElement && infoElement.classList.contains('info-message')) {
                infoElement.innerHTML = `Tidak bisa memilih tanggal sebelum ${formatDateIndonesian(minDate)}<br>Maksimal ${MAX_DAYS_LIMIT} hari dari tanggal awal`;
            }
            
            // Jika sudah memilih tanggal awal, tampilkan info
            if (selectedDates.length === 1) {
                const dayLimitInfo = document.getElementById("day_limit_info");
                if (dayLimitInfo) {
                    dayLimitInfo.style.display = 'block';
                }
            }
        },
        onClose: function(selectedDates, dateStr, instance) {
            // Sembunyikan info batas hari saat calendar ditutup
            const dayLimitInfo = document.getElementById("day_limit_info");
            if (dayLimitInfo) {
                dayLimitInfo.style.display = 'none';
            }
            
            // Jika hanya memilih satu tanggal (awal), jangan reset
            if (selectedDates.length === 1) {
                selectedStartDate = selectedDates[0];
            } else if (selectedDates.length === 0) {
                selectedStartDate = null;
            }
        }
    });

    // Handler untuk dropdown jenis tanggal
    document.getElementById("jenis_date").addEventListener("change", function () {
        const periodeSection = document.getElementById("periode_section");
        const datepickerInput = document.getElementById("datepicker");
        
        if (this.value === "Periode") {
            periodeSection.style.display = "block";
            // Nonaktifkan datepicker
            datepickerInput.disabled = true;
            // Hapus tanggal yang sudah dipilih
            datepicker.clear();
        } else if (this.value === "Custom") {
            periodeSection.style.display = "none";
            // Aktifkan datepicker
            datepickerInput.disabled = false;
            // Reset periode value
            document.getElementById("periode_value").value = "";
            
            // Tampilkan info awal
            const rangeInfo = document.getElementById("range_info");
            if (rangeInfo) {
                const minDate = getMinAllowedDate();
                rangeInfo.innerHTML = `Klik tanggal awal, lalu klik tanggal akhir<br>
                                      <small style="color: #666;">• Tidak bisa memilih tanggal sebelum ${formatDateIndonesian(minDate)}</small><br>
                                      <small style="color: #666;">• Maksimal ${MAX_DAYS_LIMIT} hari dari tanggal awal</small>`;
            }
        }
        
        // Update status tombol CONTINUE setelah perubahan jenis tanggal
        updateContinueButtonState();
    });

    // Event listener untuk dropdown periode
    document.getElementById("periode_value").addEventListener("change", function() {
        // Update status tombol CONTINUE setelah memilih periode
        updateContinueButtonState();
    });

    // Event listener untuk input nama kegiatan
    document.getElementById("nama_kegiatan").addEventListener("input", function() {
        // Update status tombol CONTINUE setelah mengisi nama kegiatan
        updateContinueButtonState();
    });

    // Tambahkan info batasan tanggal di halaman load
    window.addEventListener('load', function() {
        const minDate = getMinAllowedDate();
        const rangeInfo = document.getElementById("range_info");
        const dayLimitInfo = document.getElementById("day_limit_info");
        
        if (rangeInfo) {
            rangeInfo.innerHTML = `Klik tanggal awal, lalu klik tanggal akhir<br>
                                  <small style="color: #666;">• Tidak bisa memilih tanggal sebelum ${formatDateIndonesian(minDate)}</small><br>
                                  <small style="color: #666;">• Maksimal ${MAX_DAYS_LIMIT} hari dari tanggal awal</small>`;
        }
        
        if (dayLimitInfo) {
            dayLimitInfo.innerHTML = `<i class="fas fa-info-circle"></i> Maksimal ${MAX_DAYS_LIMIT} hari dari tanggal awal`;
        }
        
        // Update status tombol CONTINUE saat halaman dimuat
        updateContinueButtonState();
        
        // Tambahkan event listener untuk menghitung ulang saat ada perubahan
        document.getElementById('datepicker').addEventListener('change', function() {
            const selectedDates = datepicker.selectedDates;
            if (selectedDates.length === 2) {
                const awal = selectedDates[0];
                const akhir = selectedDates[1];
                const dayDifference = calculateDayDifference(awal, akhir);
                
                // Update counter
                const dayCounter = document.getElementById("day_counter");
                if (dayCounter) {
                    dayCounter.textContent = `${dayDifference} hari`;
                    
                    // Update warna badge berdasarkan jumlah hari
                    if (dayDifference > 50) {
                        dayCounter.className = "badge bg-danger";
                    } else if (dayDifference > 30) {
                        dayCounter.className = "badge bg-warning";
                    } else {
                        dayCounter.className = "badge bg-info";
                    }
                }
            }
        });
    });
    
    // Simpan referensi datepicker ke window untuk akses dari fungsi validasi
    window.datepicker = datepicker;
    
    // Fungsi untuk menangani klik tombol CONTINUE
    function handleContinueButtonClick(e) {
        const step2Fieldset = document.querySelector('fieldset:nth-of-type(2)');
        
        // Cek apakah saat ini berada di Step 2
        if (step2Fieldset && step2Fieldset.classList.contains('active')) {
            // Validasi Step 2 sebelum melanjutkan
            if (!validateStep2()) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        }
        return true;
    }
    
    // Attach event listener untuk tombol CONTINUE
    document.addEventListener('DOMContentLoaded', function() {
        const nextBtn = document.querySelector('.next-btn');
        
        if (nextBtn) {
            // Hapus atribut disabled dari HTML
            nextBtn.removeAttribute('disabled');
            
            // Atur style untuk tombol aktif
            nextBtn.style.cursor = 'pointer';
            nextBtn.style.backgroundColor = '#007bff';
            nextBtn.style.borderColor = '#007bff';
            nextBtn.style.opacity = '1';
            
            // Tambahkan event listener untuk validasi
            nextBtn.addEventListener('click', function(e) {
                const step2Fieldset = document.querySelector('fieldset:nth-of-type(2)');
                
                // Cek apakah saat ini berada di Step 2
                if (step2Fieldset && step2Fieldset.classList.contains('active')) {
                    // Validasi Step 2 sebelum melanjutkan
                    if (!validateStep2()) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                }
            });
            
            console.log("✅ Tombol CONTINUE diinisialisasi");
        }
        
        // Event listener untuk step perubahan
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    const target = mutation.target;
                    if (target.tagName === 'FIELDSET' && target.classList.contains('active')) {
                        // Update status tombol ketika berpindah ke Step 2
                        setTimeout(updateContinueButtonState, 100);
                    }
                }
            });
        });
        
        // Observe semua fieldset untuk perubahan class
        const fieldsets = document.querySelectorAll('fieldset');
        fieldsets.forEach(function(fieldset) {
            observer.observe(fieldset, { attributes: true });
        });
    });
});
</script>


<!-- Loading Screen (Hidden by default) -->
<div id="loading-screen" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; display: none; justify-content: center; align-items: center; z-index: 9999; opacity: 0; transition: opacity 0.5s ease;">
    <div class="loading-container" style="text-align: center; max-width: 400px; padding: 30px;">
        <!-- Logo Telkom University pada loading screen -->
        <img src="<?= base_url('assets/Tel-U_logo.png') ?>" class="loading-logo" alt="Telkom University Logo" style="width: 120px; margin-bottom: 25px; opacity: 0.9;">
        
        <div class="loading-spinner" style="border: 4px solid rgba(0, 123, 255, 0.1); border-top: 4px solid #007bff; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite; margin: 0 auto 25px;"></div>
        
        <div class="loading-text" style="font-size: 18px; font-weight: 600; color: #343a40; margin-bottom: 10px;">Mengirim Form</div>
        <div class="loading-subtext" style="font-size: 14px; color: #6c757d; max-width: 300px; line-height: 1.5; margin: 0 auto 20px;">Sedang mengirim formulir dan file eviden ke server...</div>
        
        <div class="loading-progress" style="width: 100%; background-color: #e9ecef; height: 6px; border-radius: 3px; overflow: hidden; margin-top: 20px;">
            <div class="loading-progress-bar" style="width: 0%; height: 100%; background-color: #007bff; transition: width 0.5s ease;"></div>
        </div>
    </div>
</div>
<!-- Step 3 -->
<fieldset id="step-upload">
    <div style="width: 100%;">
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 10px; color: #333;">
                <i class="fas fa-cloud-upload-alt"></i> Upload File Eviden
            </label>
            <p style="font-size: 13px; color: #6c757d; margin-bottom: 15px;">
                Upload file pendukung (PDF, JPG, PNG, DOC, XLS). Maksimal 10MB per file.
                <span style="color: #dc3545; font-weight: 600;">Minimal 1 file.</span>
            </p>
            
            <!-- Drag & Drop Upload Zone -->
            <div id="drop-zone" class="drop-zone" style="border: 2px dashed #17a2b8; border-radius: 12px; padding: 40px; text-align: center; background: #f8f9fa; transition: all 0.3s ease; cursor: pointer;">
                <div class="drop-zone-content">
                    <div class="upload-icon" style="font-size: 60px; color: #6c757d; margin-bottom: 20px; opacity: 0.7;">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="drop-text" style="font-size: 18px; color: #495057; font-weight: 500; margin-bottom: 10px;">
                        Drag & Drop file di sini
                    </div>
                    <div class="drop-or" style="font-size: 14px; color: #6c757d; margin: 15px 0;">
                        atau
                    </div>
                    <label for="file-input" class="choose-file-btn" style="background: #17a2b8; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-block;">
                        <i class="fas fa-folder-open"></i> Pilih File
                    </label>
                    <input type="file" name="eviden_files[]" id="file-input" 
                           class="form-control d-none" multiple 
                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx" 
                           required>
                    <p class="mt-3" style="font-size: 12px; color: #6c757d;">
                        Format: PDF, JPG, PNG, DOC, XLS (Maks. 10MB per file)
                    </p>
                </div>
            </div>

            <!-- PROGRESS BAR AREA - BARU DITAMBAHKAN -->
            <div id="upload-progress-bar" class="upload-progress-container" style="display: none; margin-top: 20px; background: #f8f9fa; border-radius: 8px; padding: 15px; border: 1px solid #e9ecef;">
                <div class="progress-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span class="progress-title" style="font-weight: 600; color: #495057; font-size: 14px;">
                        <i class="fas fa-upload"></i> Sedang Mengupload File...
                    </span>
                    <span class="progress-percentage" id="progress-percentage" style="font-weight: 600; color: #17a2b8; font-size: 14px;">
                        0%
                    </span>
                </div>
                <div class="progress-bar-container" style="background: #e9ecef; border-radius: 4px; overflow: hidden; height: 10px;">
                    <div id="progress-bar-fill" class="progress-bar-fill" style="height: 100%; background: linear-gradient(90deg, #17a2b8 0%, #20c997 100%); width: 0%; border-radius: 4px; transition: width 0.3s ease;"></div>
                </div>
                <div class="progress-details" style="display: flex; justify-content: space-between; margin-top: 8px;">
                    <span class="progress-filename" id="progress-filename" style="font-size: 12px; color: #6c757d; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 70%;">
                        Menyiapkan upload...
                    </span>
                    <span class="progress-stats" id="progress-stats" style="font-size: 12px; color: #6c757d;">
                        <span id="current-file">0</span> dari <span id="total-files">0</span> file
                    </span>
                </div>
            </div>

            <!-- File Preview -->
            <div id="file-preview" class="mt-4" style="display: none;">
                <h6 style="font-weight: 600; color: #333; margin-bottom: 15px;">
                    <i class="fas fa-paperclip"></i> File yang akan diupload:
                    <span id="file-count" style="background: #17a2b8; color: white; padding: 2px 8px; border-radius: 10px; font-size: 12px; margin-left: 5px;">0</span>
                </h6>
                <div id="files-list" class="files-list"></div>
            </div>
            
            <!-- Validation Message -->
            <div id="validation-message" class="validation-message mt-3" style="display: none; padding: 12px; border-radius: 6px; border: 1px solid #ddd;">
                <div style="display: flex; align-items: center;">
                    <i id="validation-icon" class="fas mr-2"></i>
                    <span id="validation-text"></span>
                </div>
            </div>
        </div>
    </div>
</fieldset>

<!-- CSS untuk Upload Zone -->
<style>
.drop-zone {
    border: 2px dashed #17a2b8;
    border-radius: 12px;
    padding: 60px 40px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.drop-zone.dragover {
    background: #e7f5f8;
    border-color: #0c5460;
    transform: scale(1.02);
}

.drop-zone-content {
    pointer-events: none;
}

.upload-icon {
    font-size: 80px;
    color: #6c757d;
    margin-bottom: 20px;
    opacity: 0.7;
}

.drop-text {
    font-size: 18px;
    color: #495057;
    font-weight: 500;
    margin-bottom: 10px;
}

.drop-or {
    font-size: 14px;
    color: #6c757d;
    margin: 15px 0;
}

.choose-file-btn {
    background: #17a2b8;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    pointer-events: all;
}

.choose-file-btn:hover {
    background: #138496;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
}

.files-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.file-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    transition: all 0.2s ease;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.file-item:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-color: #17a2b8;
}

.file-icon {
    flex-shrink: 0;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e9ecef;
    border-radius: 8px;
    margin-right: 15px;
}

.file-icon i {
    font-size: 22px;
}

.file-info {
    flex: 1;
    min-width: 0;
}

.file-name {
    font-size: 14px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 4px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.file-size {
    font-size: 12px;
    color: #6c757d;
}

.file-remove {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.file-remove:hover {
    background: #c82333;
    transform: scale(1.1);
}

.btn-show-files {
    background: transparent;
    border: 1px solid #17a2b8;
    color: #17a2b8;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-show-files:hover {
    background: #17a2b8;
    color: white;
}

.validation-message {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Progress Bar Styles - BARU DITAMBAHKAN */
.upload-progress-container {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.progress-bar-fill {
    position: relative;
    overflow: hidden;
}

.progress-bar-fill::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-image: linear-gradient(
        -45deg,
        rgba(255, 255, 255, 0.2) 25%,
        transparent 25%,
        transparent 50%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0.2) 75%,
        transparent 75%,
        transparent
    );
    background-size: 50px 50px;
    animation: move 2s linear infinite;
}

@keyframes move {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 50px 50px;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .drop-zone {
        padding: 40px 20px;
    }
    
    .upload-icon {
        font-size: 60px;
    }
    
    .drop-text {
        font-size: 16px;
    }
    
    .progress-details {
        flex-direction: column;
        gap: 5px;
    }
    
    .progress-filename {
        max-width: 100% !important;
    }
}
</style>

<script>
// ========================================
// DRAG & DROP FILE UPLOAD DENGAN VALIDASI DAN PROGRESS BAR
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const filesList = document.getElementById('files-list');
    const filePreview = document.getElementById('file-preview');
    const fileCount = document.getElementById('file-count');
    const validationMessage = document.getElementById('validation-message');
    const validationIcon = document.getElementById('validation-icon');
    const validationText = document.getElementById('validation-text');
    const nextBtn = document.querySelector('.next-btn');
    
    // Elemen progress bar - BARU DITAMBAHKAN
    const uploadProgressBar = document.getElementById('upload-progress-bar');
    const progressBarFill = document.getElementById('progress-bar-fill');
    const progressPercentage = document.getElementById('progress-percentage');
    const progressFilename = document.getElementById('progress-filename');
    const progressStats = document.getElementById('progress-stats');
    const currentFileElement = document.getElementById('current-file');
    const totalFilesElement = document.getElementById('total-files');
    
    // Array untuk menyimpan file
    let selectedFiles = [];
    
    // Event Listeners untuk Drag & Drop
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.style.background = '#e7f5f8';
        dropZone.style.borderColor = '#0c5460';
        dropZone.style.transform = 'scale(1.02)';
    });
    
    dropZone.addEventListener('dragleave', function() {
        dropZone.style.background = '#f8f9fa';
        dropZone.style.borderColor = '#17a2b8';
        dropZone.style.transform = 'scale(1)';
    });
    
    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.style.background = '#f8f9fa';
        dropZone.style.borderColor = '#17a2b8';
        dropZone.style.transform = 'scale(1)';
        
        const files = e.dataTransfer.files;
        handleFiles(files);
    });
    
    // Event Listener untuk file input
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });
    
    // Fungsi untuk menangani file dengan progress bar
    function handleFiles(files) {
        const newFiles = Array.from(files);
        const validFiles = [];
        
        // Validasi awal sebelum upload
        newFiles.forEach(file => {
            // Validasi ukuran file (max 10MB)
            if (file.size > 10 * 1024 * 1024) {
                showValidation(`File "${file.name}" melebihi 10MB`, 'error');
                return;
            }
            
            // Validasi tipe file
            const validExtensions = ['.pdf', '.jpg', '.jpeg', '.png', '.doc', '.docx', '.xls', '.xlsx'];
            const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
            
            if (!validExtensions.includes(fileExtension)) {
                showValidation(`Format file "${file.name}" tidak didukung`, 'error');
                return;
            }
            
            validFiles.push(file);
        });
        
        if (validFiles.length === 0) {
            return;
        }
        
        // Tampilkan progress bar
        showUploadProgress(validFiles);
        
        // Simulasi upload dengan progress bar
        simulateUploadWithProgress(validFiles);
    }
    
    // Fungsi untuk menampilkan progress bar - BARU DITAMBAHKAN
    function showUploadProgress(files) {
        uploadProgressBar.style.display = 'block';
        progressBarFill.style.width = '0%';
        progressPercentage.textContent = '0%';
        progressFilename.textContent = 'Mempersiapkan upload...';
        currentFileElement.textContent = '0';
        totalFilesElement.textContent = files.length;
        
        // Animate progress bar
        progressBarFill.style.animation = 'move 2s linear infinite';
    }
    
    // Fungsi untuk mensimulasikan upload dengan progress bar - BARU DITAMBAHKAN
    function simulateUploadWithProgress(files) {
        let uploadedCount = 0;
        const totalFiles = files.length;
        
        // Update progress stats
        progressStats.textContent = `0 dari ${totalFiles} file`;
        
        // Simulasi upload setiap file
        files.forEach((file, index) => {
            setTimeout(() => {
                // Update progress untuk file saat ini
                progressFilename.textContent = `Mengupload: ${file.name}`;
                currentFileElement.textContent = (index + 1).toString();
                
                // Simulasi waktu upload berdasarkan ukuran file
                const fileSizeMB = file.size / (1024 * 1024);
                const uploadTime = Math.min(2000, Math.max(500, fileSizeMB * 500)); // 500ms per MB, min 500ms, max 2000ms
                
                // Simulasi progress untuk file ini
                let fileProgress = 0;
                const fileInterval = setInterval(() => {
                    fileProgress += 5;
                    const overallProgress = Math.floor(((index + fileProgress / 100) / totalFiles) * 100);
                    
                    // Update progress bar
                    progressBarFill.style.width = overallProgress + '%';
                    progressPercentage.textContent = overallProgress + '%';
                    
                    if (fileProgress >= 100) {
                        clearInterval(fileInterval);
                        uploadedCount++;
                        
                        // Tambahkan file ke array setelah "upload selesai"
                        selectedFiles.push(file);
                        
                        // Update tampilan setelah semua file selesai
                        if (uploadedCount === totalFiles) {
                            setTimeout(() => {
                                // Sembunyikan progress bar
                                uploadProgressBar.style.display = 'none';
                                progressBarFill.style.animation = '';
                                
                                // Update tampilan file
                                updateFileList();
                                updateButtonState();
                                
                                // Tampilkan pesan sukses
                                showValidation(`${totalFiles} file berhasil diupload`, 'success');
                            }, 500);
                        } else {
                            // Update untuk file berikutnya
                            const nextIndex = index + 1;
                            if (nextIndex < totalFiles) {
                                progressFilename.textContent = `Mengupload: ${files[nextIndex].name}`;
                            }
                        }
                    }
                }, uploadTime / 20); // Bagi waktu upload menjadi 20 bagian
            }, index * 300); // Delay antar file
        });
    }
    
    // Fungsi untuk menyembunyikan progress bar - BARU DITAMBAHKAN
    function hideUploadProgress() {
        uploadProgressBar.style.display = 'none';
        progressBarFill.style.animation = '';
    }
    
    // Fungsi untuk update daftar file
    function updateFileList() {
        filesList.innerHTML = '';
        
        if (selectedFiles.length === 0) {
            filePreview.style.display = 'none';
            return;
        }
        
        filePreview.style.display = 'block';
        fileCount.textContent = selectedFiles.length;
        
        selectedFiles.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            
            // Get file icon based on extension
            const ext = file.name.split('.').pop().toLowerCase();
            let icon = 'fa-file';
            let iconColor = '#6c757d';
            
            if (['pdf'].includes(ext)) {
                icon = 'fa-file-pdf';
                iconColor = '#dc3545';
            } else if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                icon = 'fa-file-image';
                iconColor = '#17a2b8';
            } else if (['doc', 'docx'].includes(ext)) {
                icon = 'fa-file-word';
                iconColor = '#2b579a';
            } else if (['xls', 'xlsx'].includes(ext)) {
                icon = 'fa-file-excel';
                iconColor = '#217346';
            }
            
            fileItem.innerHTML = `
                <div class="file-icon" style="background: ${iconColor + '20'};">
                    <i class="fas ${icon}" style="color: ${iconColor};"></i>
                </div>
                <div class="file-info">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${formatFileSize(file.size)}</div>
                </div>
                <button type="button" class="file-remove" onclick="removeFile(${index})" title="Hapus file">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            filesList.appendChild(fileItem);
        });
    }
    
    // Fungsi untuk menghapus file
    window.removeFile = function(index) {
        if (confirm('Hapus file ini?')) {
            selectedFiles.splice(index, 1);
            updateFileList();
            updateButtonState();
            showValidation('File berhasil dihapus', 'info');
        }
    };
    
    // Fungsi untuk format ukuran file
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Fungsi untuk menampilkan pesan validasi
    function showValidation(message, type = 'info') {
        validationMessage.style.display = 'block';
        validationText.textContent = message;
        
        // Set icon dan warna berdasarkan tipe
        switch(type) {
            case 'success':
                validationIcon.className = 'fas fa-check-circle';
                validationMessage.style.background = '#d4edda';
                validationMessage.style.borderColor = '#c3e6cb';
                validationMessage.style.color = '#155724';
                break;
            case 'error':
                validationIcon.className = 'fas fa-exclamation-triangle';
                validationMessage.style.background = '#f8d7da';
                validationMessage.style.borderColor = '#f5c6cb';
                validationMessage.style.color = '#721c24';
                break;
            case 'info':
                validationIcon.className = 'fas fa-info-circle';
                validationMessage.style.background = '#d1ecf1';
                validationMessage.style.borderColor = '#bee5eb';
                validationMessage.style.color = '#0c5460';
                break;
        }
        
        // Auto hide setelah 5 detik
        setTimeout(() => {
            validationMessage.style.display = 'none';
        }, 5000);
    }
    
    // Fungsi untuk update state tombol
    function updateButtonState() {
        if (!nextBtn) return;
        
        const isValid = selectedFiles.length >= 1;
        
        if (isValid) {
            nextBtn.disabled = false;
            nextBtn.style.cursor = 'pointer';
            nextBtn.style.opacity = '1';
            nextBtn.style.background = '#28a745';
            nextBtn.style.borderColor = '#28a745';
        } else {
            nextBtn.disabled = true;
            nextBtn.style.cursor = 'not-allowed';
            nextBtn.style.opacity = '0.6';
            nextBtn.style.background = '#6c757d';
            nextBtn.style.borderColor = '#6c757d';
        }
    }
    
    // Fungsi untuk validasi step 3
    function validateStep3() {
        if (selectedFiles.length === 0) {
            showValidation('Minimal upload 1 file eviden sebelum melanjutkan', 'error');
            
            // Highlight drop zone
            dropZone.style.animation = 'pulse 0.5s 3';
            setTimeout(() => {
                dropZone.style.animation = '';
            }, 1500);
            
            return false;
        }
        
        // Validasi tambahan: total ukuran file tidak melebihi 50MB
        const totalSize = selectedFiles.reduce((total, file) => total + file.size, 0);
        if (totalSize > 50 * 1024 * 1024) {
            showValidation('Total ukuran file melebihi 50MB', 'error');
            return false;
        }
        
        return true;
    }
    
    // Update hidden input dengan file yang dipilih
    function updateFormFiles() {
        // Hapus file input lama
        const dataTransfer = new DataTransfer();
        
        // Tambahkan semua file ke DataTransfer
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        
        // Update file input
        fileInput.files = dataTransfer.files;
    }
    
    // Event listener untuk tombol next di step 3
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            const stepUploadFieldset = document.getElementById('step-upload');
            
            // Cek apakah sedang di step upload
            if (stepUploadFieldset && stepUploadFieldset.classList.contains('active')) {
                // Update form files terlebih dahulu
                updateFormFiles();
                
                // Validasi step 3
                if (!validateStep3()) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
                
                console.log('✅ Step 3 validated:', selectedFiles.length, 'files');
            }
        });
    }
    
    // Initialize button state
    updateButtonState();
    
    console.log('✅ Drag & Drop upload dengan progress bar initialized');
});
// CSS Animation untuk pulse effect
const style = document.createElement('style');
style.textContent = `
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}
`;
document.head.appendChild(style);
</script>

<!-- Modal Preview File - PDF Viewer Style -->
<div id="file-preview-modal" class="file-preview-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #202124; z-index: 10000;">
    <div class="modal-content-fullscreen" style="width: 100%; height: 100%; display: flex; flex-direction: column; background: #202124;">
        <!-- Header Purple seperti PDF viewer -->
        <div class="pdf-viewer-header" style="background: linear-gradient(135deg, #7b5e9f 0%, #9370b8 100%); color: white; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);">
            <div class="pdf-header-left" style="display: flex; align-items: center; gap: 15px; flex: 1; min-width: 0;">
                <button type="button" class="header-icon-btn" onclick="closePreviewModal()" title="Close" style="background: transparent; border: none; color: white; width: 40px; height: 40px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 18px;">
                    <i class="fas fa-times"></i>
                </button>
                <span class="pdf-title" id="modal-file-title" style="font-size: 16px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: white;">Preview: document.pdf</span>
            </div>
            <div class="pdf-header-right" style="display: flex; gap: 5px; align-items: center;">
                <a id="btn-download-file" href="#" target="_blank" download class="header-icon-btn" title="Download" style="background: transparent; border: none; color: white; width: 40px; height: 40px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 18px; text-decoration: none;">
                    <i class="fas fa-download"></i>
                </a>
                <button type="button" class="header-icon-btn" onclick="window.print()" title="Print" style="background: transparent; border: none; color: white; width: 40px; height: 40px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 18px;">
                    <i class="fas fa-print"></i>
                </button>
                <button type="button" class="header-icon-btn" title="More options" style="background: transparent; border: none; color: white; width: 40px; height: 40px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 18px;">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>

        <!-- Toolbar Dark seperti PDF viewer -->
        <div class="pdf-viewer-toolbar" style="background: #323639; color: #e8eaed; padding: 8px 16px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);">
            <div class="toolbar-left" style="display: flex; align-items: center; gap: 8px;">
                <button type="button" class="toolbar-icon-btn" title="Menu" style="background: transparent; border: none; color: #e8eaed; width: 36px; height: 36px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 16px;">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="page-indicator" style="color: #e8eaed; font-size: 13px; padding: 0 12px; white-space: nowrap;">
                    <span id="current-page">1</span> / <span id="total-pages">1</span>
                </span>
            </div>
            
            <div class="toolbar-center" style="flex: 1; justify-content: center; display: flex; align-items: center; gap: 8px;">
                <button type="button" class="toolbar-icon-btn" title="Zoom out" onclick="zoomOut()" style="background: transparent; border: none; color: #e8eaed; width: 36px; height: 36px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 16px;">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="toolbar-icon-btn" title="Zoom in" onclick="zoomIn()" style="background: transparent; border: none; color: #e8eaed; width: 36px; height: 36px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 16px;">
                    <i class="fas fa-plus"></i>
                </button>
                <select class="zoom-select" id="zoom-select" style="background: #3c4043; border: 1px solid #5f6368; color: #e8eaed; padding: 6px 8px; border-radius: 4px; font-size: 13px; cursor: pointer; outline: none;">
                    <option value="50">50%</option>
                    <option value="75">75%</option>
                    <option value="100" selected>100%</option>
                    <option value="125">125%</option>
                    <option value="150">150%</option>
                    <option value="200">200%</option>
                </select>
                <button type="button" class="toolbar-icon-btn" title="Rotate" onclick="rotateImage()" style="background: transparent; border: none; color: #e8eaed; width: 36px; height: 36px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 16px;">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <button type="button" class="toolbar-icon-btn" title="Fit to page" onclick="fitToPage()" style="background: transparent; border: none; color: #e8eaed; width: 36px; height: 36px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 16px;">
                    <i class="fas fa-expand"></i>
                </button>
            </div>

            <div class="toolbar-right" style="display: flex; align-items: center; gap: 8px;">
                <button type="button" class="toolbar-icon-btn" title="Undo" style="background: transparent; border: none; color: #e8eaed; width: 36px; height: 36px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 16px;">
                    <i class="fas fa-undo"></i>
                </button>
                <button type="button" class="toolbar-icon-btn" title="Redo" style="background: transparent; border: none; color: #e8eaed; width: 36px; height: 36px; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s; font-size: 16px;">
                    <i class="fas fa-redo"></i>
                </button>
            </div>
        </div>

        <!-- Content Area -->
        <div class="pdf-viewer-body" style="flex: 1; overflow: auto; background: #202124; display: flex; justify-content: center; align-items: center; padding: 20px;">
            <div id="preview-content" class="preview-container" style="width: 100%; max-width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100%;">
                <div class="loading-spinner" style="border: 4px solid rgba(255, 255, 255, 0.3); border-top: 4px solid white; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite; margin: 100px auto;"></div>
            </div>
        </div>
    </div>
</div>

<!-- BUTTON AREA -->
<div class="button-area" style="margin-top:25px; text-align:center;">
    <button type="button" class="btn btn-primary prev-btn rounded-pill btn-sm" style="padding: 6px 20px; border-radius: 50px; background: #007bff; border: none; color: white; cursor: pointer;">Back</button>
    <button type="button" class="action-btn next-btn rounded-pill btn-sm" style="padding: 6px 20px; border-radius: 50px; background: #6c757d; border-color: #6c757d; color: white; cursor: not-allowed;" disabled>
        <span id="next-btn-text">Continue</span>
    </button>
</div>

<style>
/* CSS Utama */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.file-preview-modal.show {
    display: flex;
    flex-direction: column;
}

/* Style untuk tombol upload */
#upload-btn:hover {
    background: #0056b3 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,123,255,0.3);
    transition: all 0.3s ease;
}

#upload-btn:active {
    transform: translateY(0);
}

/* Style untuk file item */
.file-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    background: white;
    border-radius: 6px;
    margin-bottom: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.2s ease;
}

.file-item:hover {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-color: #007bff;
}

.file-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e9ecef;
    border-radius: 6px;
}

.file-info {
    flex: 1;
    min-width: 0;
}

.file-name {
    font-size: 14px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 4px;
}

.file-url {
    font-size: 11px;
    color: #6c757d;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.btn-remove {
    padding: 6px 12px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
}

.btn-remove:hover {
    background: #c82333;
    transform: scale(1.05);
}

.btn-view {
    padding: 6px 12px;
    background: #17a2b8;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
    text-decoration: none;
    margin-right: 5px;
}

.btn-view:hover {
    background: #138496;
    transform: scale(1.05);
}

/* Validation Message */
.validation-message.success {
    background-color: #d4edda !important;
    border-color: #c3e6cb !important;
    color: #155724 !important;
}

.validation-message.error {
    background-color: #f8d7da !important;
    border-color: #f5c6cb !important;
    color: #721c24 !important;
}

.validation-message.info {
    background-color: #d1ecf1 !important;
    border-color: #bee5eb !important;
    color: #0c5460 !important;
}

/* Button disabled state */
.next-btn:disabled {
    background-color: #6c757d !important;
    border-color: #6c757d !important;
    cursor: not-allowed !important;
    opacity: 0.65;
    transform: none !important;
    box-shadow: none !important;
}

/* Button enabled state */
.next-btn:not(:disabled) {
    background-color: #007bff !important;
    border-color: #007bff !important;
    cursor: pointer !important;
    opacity: 1;
}

.next-btn:not(:disabled):hover {
    background-color: #0056b3 !important;
    border-color: #0056b3 !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
}

/* Progress Bar */
#upload-progress {
    animation: fadeIn 0.5s ease;
}

.pulse-animation {
    animation: pulse 2s infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .pdf-viewer-header {
        padding: 10px 15px !important;
    }
    
    .pdf-title {
        font-size: 14px !important;
    }
    
    .toolbar-center {
        gap: 4px !important;
    }
    
    .zoom-select {
        width: 70px !important;
        font-size: 12px !important;
    }
    
    .pdf-viewer-body {
        padding: 10px !important;
    }
    
    .file-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .file-info {
        width: 100%;
    }
    
    .file-item > div:last-child {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        gap: 5px;
        margin-top: 8px;
    }
    
    .upload-progress-container {
        padding: 12px !important;
    }
}
</style>

<script>
// ========================================
// MULTIPLE UPLOAD DENGAN UPLOADCARE DENGAN VALIDASI KONSISTEN
// ========================================

document.addEventListener("DOMContentLoaded", function () {
    const loadingScreen = document.getElementById('loading-screen');
    const loadingProgressBar = loadingScreen.querySelector('.loading-progress-bar');
    const loadingText = loadingScreen.querySelector('.loading-text');
    const loadingSubtext = loadingScreen.querySelector('.loading-subtext');
    
    // Fungsi untuk menampilkan loading screen
    function showLoadingScreen() {
        // Reset progress bar
        if (loadingProgressBar) {
            loadingProgressBar.style.width = '0%';
        }
        
        // Update teks loading
        if (loadingText && loadingSubtext) {
            loadingText.textContent = 'Mengirim Form';
            loadingSubtext.textContent = 'Sedang mengirim formulir dan file eviden ke server...';
        }
        
        // Tampilkan loading screen dengan efek fade in
        loadingScreen.style.display = 'flex';
        setTimeout(() => {
            loadingScreen.style.opacity = '1';
        }, 10);
        
        // Animate progress bar
        simulateSubmitProgress();
    }
    
    // Fungsi untuk menyembunyikan loading screen
    function hideLoadingScreen() {
        loadingScreen.style.opacity = '0';
        setTimeout(() => {
            loadingScreen.style.display = 'none';
        }, 500);
    }
    
    // Simulasi progress untuk submit form
    function simulateSubmitProgress() {
        let progress = 0;
        const interval = setInterval(function() {
            progress += 10;
            if (loadingProgressBar) {
                loadingProgressBar.style.width = progress + '%';
            }
            
            if (progress >= 100) {
                clearInterval(interval);
                // Progress selesai, form akan disubmit
                setTimeout(() => {
                    // Set progress 100% untuk efek selesai
                    if (loadingProgressBar) {
                        loadingProgressBar.style.width = '100%';
                    }
                    
                    if (loadingText && loadingSubtext) {
                        loadingText.textContent = 'Form Terkirim!';
                        loadingSubtext.textContent = 'Formulir berhasil dikirim ke sistem';
                    }
                }, 300);
            }
        }, 200);
    }
    
    // Inisialisasi variabel utama
    const evidenInput = document.getElementById("eviden");
    const uploadedDisplay = document.getElementById("uploaded-files-display");
    const filesList = document.getElementById("files-list");
    const uploadBtn = document.getElementById("upload-btn");
    const evidenPanel = document.getElementById("eviden-panel");
    const totalFilesSpan = document.getElementById("total-files");
    const nextBtn = document.querySelector('.next-btn');
    const nextBtnText = document.getElementById('next-btn-text');
    const validationMessage = document.getElementById("validation-message");
    const validationText = document.getElementById("validation-text");
    const currentFileCount = document.getElementById("current-file-count");
    const fileCountIndicator = document.getElementById("file-count-indicator");
    const uploadProgress = document.getElementById("upload-progress");
    const progressBar = document.getElementById("progress-bar");
    const progressText = document.getElementById("progress-text");
    const stepUploadFieldset = document.getElementById('step-upload');
    
    // Pastikan default selalu array kosong
    if (!evidenInput.value || evidenInput.value === "") {
        evidenInput.value = "[]";
    }

    // Array untuk menyimpan semua URL yang di-upload
    let uploadedFiles = [];
    let currentPanel = null;
    let currentRotation = 0;
    let isUploading = false;

    // Function untuk update button state berdasarkan jumlah file
    function updateButtonState() {
        const fileCount = uploadedFiles.length;
        
        // Update file count indicator
        currentFileCount.textContent = fileCount;
        
        // Update validation message
        if (fileCount === 0) {
            // Jika belum ada file
            validationText.textContent = "Silakan upload minimal 1 file eviden untuk melanjutkan.";
            validationMessage.className = "validation-message error";
            validationMessage.style.display = 'flex';
            
            // Update file count indicator color
            fileCountIndicator.style.color = "#dc3545";
            
            // Disable tombol continue
            if (nextBtn) {
                nextBtn.disabled = true;
                nextBtn.style.cursor = "not-allowed";
                nextBtn.title = "Upload minimal 1 file untuk melanjutkan";
            }
        } else {
            // Jika sudah ada file
            validationText.textContent = `✓ ${fileCount} file telah diupload. Anda dapat melanjutkan.`;
            validationMessage.className = "validation-message success";
            validationMessage.style.display = 'flex';
            
            // Update file count indicator color
            fileCountIndicator.style.color = "#28a745";
            
            // Enable tombol continue
            if (nextBtn) {
                nextBtn.disabled = false;
                nextBtn.style.cursor = "pointer";
                nextBtn.title = "Klik untuk melanjutkan ke langkah berikutnya";
                
                // Tambahkan efek visual untuk enabled state
                nextBtn.style.animation = "pulse 2s 1";
            }
        }
        
        // Update total files display
        totalFilesSpan.textContent = fileCount;
    }

    // Function untuk get file type icon
    function getFileIcon(url) {
        const ext = url.split('.').pop().toLowerCase().split('?')[0];
        
        if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(ext)) {
            return '<i class="fas fa-file-image" style="font-size: 20px; color: #17a2b8;"></i>';
        } else if (['pdf'].includes(ext)) {
            return '<i class="fas fa-file-pdf" style="font-size: 20px; color: #dc3545;"></i>';
        } else if (['doc', 'docx'].includes(ext)) {
            return '<i class="fas fa-file-word" style="font-size: 20px; color: #2b579a;"></i>';
        } else if (['xls', 'xlsx'].includes(ext)) {
            return '<i class="fas fa-file-excel" style="font-size: 20px; color: #217346;"></i>';
        } else if (['zip', 'rar', '7z'].includes(ext)) {
            return '<i class="fas fa-file-archive" style="font-size: 20px; color: #ffc107;"></i>';
        } else {
            return '<i class="fas fa-file-alt" style="font-size: 20px; color: #6c757d;"></i>';
        }
    }

    // Function untuk update display files
    function updateFilesDisplay() {
        if (uploadedFiles.length === 0) {
            uploadedDisplay.style.display = 'none';
            return;
        }

        uploadedDisplay.style.display = 'block';
        filesList.innerHTML = '';

        uploadedFiles.forEach((url, index) => {
            const filename = url.split('/').pop().split('?')[0];
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            
            fileItem.innerHTML = `
                <div class="file-icon">
                    ${getFileIcon(url)}
                </div>
                <div class="file-info">
                    <div class="file-name">File ${index + 1}: ${filename}</div>
                    <div class="file-url">${url}</div>
                </div>
                <div style="display: flex; gap: 5px;">
                    <button type="button" onclick="previewFile('${url}', '${filename}')" class="btn-view">
                        <i class="fas fa-eye"></i> Lihat
                    </button>
                    <button type="button" onclick="removeFile(${index})" class="btn-remove">
                        <i class="fas fa-times"></i> Hapus
                    </button>
                </div>
            `;
            
            filesList.appendChild(fileItem);
        });
    }

    // Function untuk remove file
    window.removeFile = function(index) {
        if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
            uploadedFiles.splice(index, 1);
            evidenInput.value = JSON.stringify(uploadedFiles);
            updateFilesDisplay();
            updateButtonState();
            console.log("🗑 File dihapus. Total file:", uploadedFiles.length);
        }
    };

    // ========================================
    // FUNCTION UNTUK VALIDASI UPLOAD
    // ========================================
    
    function validateUploadStep() {
        const fileCount = uploadedFiles.length;
        const isValid = fileCount > 0;
        
        console.log("🔍 Validating upload step:", {
            fileCount: fileCount,
            isValid: isValid,
            isCurrentStep: isCurrentStepUpload()
        });
        
        // Update button state berdasarkan validasi
        if (isCurrentStepUpload()) {
            updateButtonState();
        }
        
        return isValid;
    }
    
    // Cek apakah step saat ini adalah step upload
    function isCurrentStepUpload() {
        if (!stepUploadFieldset) return false;
        return stepUploadFieldset.classList.contains('active');
    }

    // ========================================
    // FUNCTION UNTUK PREVIEW FILE
    // ========================================
    
    // Zoom functions
    window.zoomIn = function() {
        const zoomSelect = document.getElementById('zoom-select');
        const currentValue = parseInt(zoomSelect.value);
        const options = [50, 75, 100, 125, 150, 200];
        const currentIndex = options.indexOf(currentValue);
        
        if (currentIndex < options.length - 1) {
            zoomSelect.value = options[currentIndex + 1];
            applyZoom(options[currentIndex + 1]);
        }
    };

    window.zoomOut = function() {
        const zoomSelect = document.getElementById('zoom-select');
        const currentValue = parseInt(zoomSelect.value);
        const options = [50, 75, 100, 125, 150, 200];
        const currentIndex = options.indexOf(currentValue);
        
        if (currentIndex > 0) {
            zoomSelect.value = options[currentIndex - 1];
            applyZoom(options[currentIndex - 1]);
        }
    };

    // Rotate function untuk gambar
    window.rotateImage = function() {
        const img = document.querySelector('.preview-image');
        if (img) {
            currentRotation = (currentRotation + 90) % 360;
            const currentScale = parseInt(document.getElementById('zoom-select').value) / 100;
            img.style.transform = `scale(${currentScale}) rotate(${currentRotation}deg)`;
        }
    };

    // Fit to page function
    window.fitToPage = function() {
        const zoomSelect = document.getElementById('zoom-select');
        zoomSelect.value = '100';
        applyZoom(100);
        currentRotation = 0;
        const img = document.querySelector('.preview-image');
        if (img) {
            img.style.transform = 'scale(1) rotate(0deg)';
        }
    };

    function applyZoom(zoomValue) {
        const previewContent = document.getElementById('preview-content');
        const img = previewContent.querySelector('.preview-image');
        
        if (img) {
            img.style.transform = `scale(${zoomValue / 100}) rotate(${currentRotation}deg)`;
            img.style.transformOrigin = 'center center';
        }
    }

    // Zoom select change event
    document.addEventListener('change', function(e) {
        if (e.target.id === 'zoom-select') {
            applyZoom(parseInt(e.target.value));
        }
    });

    // Function untuk preview file dalam modal
    window.previewFile = function(url, filename) {
        const modal = document.getElementById('file-preview-modal');
        const modalTitle = document.getElementById('modal-file-title');
        const previewContent = document.getElementById('preview-content');
        const downloadBtn = document.getElementById('btn-download-file');
        
        // Reset zoom dan rotation
        const zoomSelect = document.getElementById('zoom-select');
        zoomSelect.value = '100';
        currentRotation = 0;
        
        // Set modal title
        modalTitle.textContent = 'Preview: ' + filename;
        
        // Set download link
        downloadBtn.href = url;
        downloadBtn.download = filename;
        
        // Show modal
        modal.classList.add('show');
        
        // Show loading
        previewContent.innerHTML = '<div class="loading-spinner"></div>';
        
        // Get file extension
        const ext = url.split('.').pop().toLowerCase().split('?')[0];
        
        // Render preview based on file type
        setTimeout(() => {
            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'].includes(ext)) {
                // Image preview - Load image properly
                const img = new Image();
                img.onload = function() {
                    previewContent.innerHTML = `
                        <img src="${url}" alt="${filename}" class="preview-image" style="max-width: 90%; max-height: 85vh; height: auto; width: auto; border-radius: 4px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7); background: transparent; transition: transform 0.3s ease; object-fit: contain;">
                    `;
                };
                img.onerror = function() {
                    previewContent.innerHTML = `
                        <div class="preview-file-info" style="text-align: center; padding: 60px 40px; background: #3c3f43; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); max-width: 500px; border: 1px solid #5f6368;">
                            <div class="preview-file-icon" style="font-size: 100px; margin-bottom: 25px; opacity: 0.9; color: #e8eaed;">
                                <i class="fas fa-exclamation-triangle" style="color: #ff6b6b;"></i>
                            </div>
                            <div class="preview-file-name" style="font-size: 20px; font-weight: 600; color: #e8eaed; margin-bottom: 12px; word-break: break-all;">Gagal Memuat Gambar</div>
                            <p style="color: #999; font-size: 14px;">
                                Tidak dapat menampilkan gambar ini.<br>
                                Silakan coba download file.
                            </p>
                        </div>
                    `;
                };
                img.src = url;
            } else if (ext === 'pdf') {
                // PDF preview
                previewContent.innerHTML = `
                    <iframe src="${url}" class="preview-pdf" frameborder="0" style="width: 100%; height: calc(100vh - 120px); border: none; background: white; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);"></iframe>
                `;
            } else {
                // Other file types - show info
                const fileTypeMap = {
                    'doc': 'Microsoft Word Document',
                    'docx': 'Microsoft Word Document',
                    'xls': 'Microsoft Excel Spreadsheet',
                    'xlsx': 'Microsoft Excel Spreadsheet',
                    'ppt': 'Microsoft PowerPoint Presentation',
                    'pptx': 'Microsoft PowerPoint Presentation',
                    'zip': 'ZIP Archive',
                    'rar': 'RAR Archive',
                    '7z': '7-Zip Archive',
                    'txt': 'Text File',
                    'csv': 'CSV File'
                };
                
                const fileType = fileTypeMap[ext] || 'File';
                const iconHtml = getFileIcon(url);
                
                previewContent.innerHTML = `
                    <div class="preview-file-info" style="text-align: center; padding: 60px 40px; background: #3c3f43; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4); max-width: 500px; border: 1px solid #5f6368;">
                        <div class="preview-file-icon" style="font-size: 100px; margin-bottom: 25px; opacity: 0.9; color: #e8eaed;">${iconHtml}</div>
                        <div class="preview-file-name" style="font-size: 20px; font-weight: 600; color: #e8eaed; margin-bottom: 12px; word-break: break-all;">${filename}</div>
                        <div class="preview-file-type" style="font-size: 15px; color: #9aa0a6; margin-bottom: 25px;">${fileType}</div>
                        <p style="color: #999; font-size: 14px; line-height: 1.6;">
                            Preview tidak tersedia untuk tipe file ini.<br>
                            Klik tombol "Download" di header untuk mengunduh.
                        </p>
                        <a href="${url}" target="_blank" class="btn-open-tab" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: #1a73e8; color: white; text-decoration: none; border-radius: 6px; font-weight: 500; font-size: 14px; transition: all 0.2s ease; box-shadow: 0 2px 8px rgba(26, 115, 232, 0.3);">
                            <i class="fas fa-external-link-alt"></i> Buka di Tab Baru
                        </a>
                    </div>
                `;
            }
        }, 300);
    };

    // Function untuk close modal
    window.closePreviewModal = function() {
        const modal = document.getElementById('file-preview-modal');
        modal.classList.remove('show');
        currentRotation = 0;
        
        // Clear content after animation
        setTimeout(() => {
            document.getElementById('preview-content').innerHTML = '<div class="loading-spinner"></div>';
        }, 300);
    };

    // Close modal when clicking outside (pada area abu-abu)
    document.getElementById('file-preview-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePreviewModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('file-preview-modal');
            if (modal.classList.contains('show')) {
                closePreviewModal();
            }
        }
    });

    // Function untuk open upload panel
    function openUploadPanel() {
        // Jika sedang uploading, jangan buka panel baru
        if (isUploading) {
            alert("Mohon tunggu, proses upload sedang berlangsung...");
            return;
        }
        
        // Tutup panel sebelumnya jika ada
        if (currentPanel) {
            try {
                currentPanel.reject();
            } catch (e) {
                console.log("Panel sudah tertutup");
            }
        }

        // Show panel container
        evidenPanel.style.display = 'block';
        
        // Clear panel content
        evidenPanel.innerHTML = '';

        // Create new panel
        currentPanel = uploadcare.openPanel('#eviden-panel', null, {
            multiple: true,
            multipleMax: 10,
            multipleMin: 1,
            previewStep: true,
            tabs: "file url camera dropbox gdrive",
            publicKey: "48f975cd90d221e0ee3",
            imagesOnly: false,
            clearable: true
        });

        // Event ketika user selesai upload
        currentPanel.done(function (fileGroup) {
            console.log("✅ Upload selesai! File group:", fileGroup);
            
            // Show progress bar
            isUploading = true;
            uploadProgress.style.display = 'block';
            progressBar.style.width = '0%';
            progressText.textContent = '0%';
            
            // Process all files dengan progress indicator
            const files = fileGroup.files();
            const totalFiles = files.length;
            let processedFiles = 0;
            
            files.forEach((filePromise, index) => {
                filePromise.done(fileInfo => {
                    console.log("📁 File info:", fileInfo);
                    
                    // Add URL to array
                    uploadedFiles.push(fileInfo.cdnUrl);
                    
                    // Update progress
                    processedFiles++;
                    const progressPercent = Math.round((processedFiles / totalFiles) * 100);
                    progressBar.style.width = progressPercent + '%';
                    progressText.textContent = progressPercent + '%';
                    
                    // Update hidden input
                    evidenInput.value = JSON.stringify(uploadedFiles);
                    
                    // Jika semua file sudah diproses
                    if (processedFiles === totalFiles) {
                        // Update display
                        updateFilesDisplay();
                        validateUploadStep();
                        
                        // Hide progress bar setelah delay
                        setTimeout(() => {
                            uploadProgress.style.display = 'none';
                            isUploading = false;
                        }, 500);
                        
                        // Show success message
                        validationText.textContent = `✓ ${totalFiles} file berhasil diupload!`;
                        validationMessage.className = "validation-message success pulse-animation";
                        validationMessage.style.display = 'flex';
                        
                        // Remove animation setelah 2 detik
                        setTimeout(() => {
                            validationMessage.classList.remove('pulse-animation');
                        }, 2000);
                        
                        console.log("💾 Semua file tersimpan:", uploadedFiles.length, "file");
                    }
                }).fail(function(error) {
                    console.error("❌ Error uploading file:", error);
                    processedFiles++;
                    
                    // Update progress meskipun error
                    const progressPercent = Math.round((processedFiles / totalFiles) * 100);
                    progressBar.style.width = progressPercent + '%';
                    progressText.textContent = progressPercent + '%';
                    
                    if (processedFiles === totalFiles) {
                        // Update display untuk file yang berhasil
                        updateFilesDisplay();
                        validateUploadStep();
                        
                        // Hide progress bar
                        setTimeout(() => {
                            uploadProgress.style.display = 'none';
                            isUploading = false;
                        }, 500);
                    }
                });
            });

            // Hide panel setelah upload
            setTimeout(() => {
                evidenPanel.style.display = 'none';
                evidenPanel.innerHTML = '';
            }, 500);
        });

        // Event ketika user cancel
        currentPanel.fail(function() {
            console.log("❌ Upload dibatalkan");
            evidenPanel.style.display = 'none';
            evidenPanel.innerHTML = '';
            isUploading = false;
        });
    }

    // Event listener untuk tombol upload
    if (uploadBtn) {
        uploadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openUploadPanel();
        });
    }

    // ========================================
    // FORM NAVIGATION DENGAN VALIDASI KONSISTEN
    // ========================================
    
    const prevBtn = document.querySelector('.prev-btn');
    const fieldsets = document.querySelectorAll('fieldset');
    let currentStep = 0;

    // Function untuk validasi semua step
    function validateCurrentStep() {
        const currentFieldset = fieldsets[currentStep];
        if (!currentFieldset) return true;
        
        // Jika ini adalah step upload
        if (currentFieldset.id === 'step-upload') {
            return validateUploadStep();
        }
        
        // Untuk step lainnya (Step 1 dan 2), gunakan validasi yang sudah ada
        // Anda perlu menyesuaikan dengan logika validasi Step 1 dan 2
        return true;
    }

    // Event listener untuk tombol Next/Continue
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log("🔄 Validasi sebelum pindah step...");
            
            // Validasi step saat ini
            const isValid = validateCurrentStep();
            
            if (!isValid) {
                console.log("❌ Validasi gagal, tidak dapat melanjutkan");
                
                // Tampilkan pesan error khusus untuk upload step
                if (isCurrentStepUpload() && uploadedFiles.length === 0) {
                    validationText.textContent = "❌ Anda harus mengupload minimal 1 file eviden untuk melanjutkan!";
                    validationMessage.className = "validation-message error pulse-animation";
                    validationMessage.style.display = 'flex';
                    
                    // Highlight upload button
                    if (uploadBtn) {
                        uploadBtn.classList.add('pulse-animation');
                        setTimeout(() => {
                            uploadBtn.classList.remove('pulse-animation');
                        }, 2000);
                    }
                    
                    // Scroll ke validation message
                    validationMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                
                return false;
            }
            
            console.log("✅ Validasi berhasil, melanjutkan...");
            
            const totalSteps = fieldsets.length;
            
            // Jika masih ada step berikutnya
            if (currentStep < totalSteps - 1) {
                fieldsets[currentStep].classList.remove('active');
                currentStep++;
                fieldsets[currentStep].classList.add('active');
                
                // Update progress bar jika ada
                if (document.getElementById('progressBar')) {
                    const percent = ((currentStep + 1) / totalSteps) * 100;
                    document.getElementById('progressBar').style.width = percent + '%';
                }
                if (document.getElementById('currentStep')) {
                    document.getElementById('currentStep').textContent = currentStep + 1;
                }
                
                // Toggle tombol back
                if (prevBtn) {
                    prevBtn.style.display = currentStep > 0 ? 'inline-block' : 'none';
                }
                
                // Update text tombol
                nextBtnText.textContent = currentStep === totalSteps - 1 ? 'Finish' : 'Continue';
                
                // Jika pindah ke step upload, inisialisasi ulang
                if (isCurrentStepUpload()) {
                    // Load existing files
                    loadExistingFiles();
                    
                    // Validasi awal
                    validateUploadStep();
                }
            } 
            // Jika sudah di step terakhir (Finish) - INI YANG DIPERBAIKI
            else {
                console.log("🚀 Submitting form...");
                console.log("📎 Final eviden value:", evidenInput.value);
                console.log("📊 Total files:", uploadedFiles.length);
                
                // Validasi final sebelum submit
                if (!validateCurrentStep()) {
                    alert("⚠ Silakan selesaikan semua persyaratan sebelum submit form!");
                    return false;
                }
                
                // Konfirmasi submit
                if (uploadedFiles.length > 0) {
                    const confirmMsg = `Apakah Anda yakin ingin mengirim form dengan ${uploadedFiles.length} file eviden?\n\nFile yang akan dikirim:\n${uploadedFiles.map((url, i) => `${i+1}. ${url.split('/').pop().split('?')[0]}`).join('\n')}`;
                    
                    if (!confirm(confirmMsg)) {
                        console.log("❌ Submit dibatalkan oleh user");
                        return false;
                    }
                }
                
                // TAMPILKAN LOADING SCREEN DI SINI
                showLoadingScreen();
                
                // Disable tombol untuk mencegah double click
                nextBtn.disabled = true;
                nextBtnText.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                
                // Submit form setelah progress loading selesai
                setTimeout(() => {
                    const msform = document.getElementById('msform');
                    if (msform) {
                        console.log("✅ Form sedang disubmit...");
                        msform.submit();
                    }
                }, 2500); // Memberikan waktu untuk animasi loading selesai
            }
        });
    }

    // Tombol Back
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (currentStep > 0) {
                fieldsets[currentStep].classList.remove('active');
                currentStep--;
                fieldsets[currentStep].classList.add('active');
                
                // Update progress
                const totalSteps = fieldsets.length;
                if (document.getElementById('progressBar')) {
                    const percent = ((currentStep + 1) / totalSteps) * 100;
                    document.getElementById('progressBar').style.width = percent + '%';
                }
                if (document.getElementById('currentStep')) {
                    document.getElementById('currentStep').textContent = currentStep + 1;
                }
                
                prevBtn.style.display = currentStep > 0 ? 'inline-block' : 'none';
                nextBtnText.textContent = currentStep === totalSteps - 1 ? 'Finish' : 'Continue';
                
                // Jika kembali ke step upload, inisialisasi ulang
                if (isCurrentStepUpload()) {
                    // Load existing files
                    loadExistingFiles();
                    
                    // Validasi awal
                    validateUploadStep();
                }
            }
        });
    }

    // Load existing files if any (for edit mode)
    function loadExistingFiles() {
        try {
            const existingFiles = JSON.parse(evidenInput.value);
            if (Array.isArray(existingFiles) && existingFiles.length > 0) {
                uploadedFiles = existingFiles;
                updateFilesDisplay();
                validateUploadStep();
                console.log("📂 Loaded existing files:", uploadedFiles.length);
            } else {
                console.log("📭 No existing files to load");
                validateUploadStep(); // Still update button state
            }
        } catch (e) {
            console.log("❌ Error loading existing files:", e);
            validateUploadStep();
        }
    }

    // Initialize when page loads
    // Cek apakah step upload sedang aktif
    if (isCurrentStepUpload()) {
        loadExistingFiles();
        validateUploadStep();
    }

    // Event listener untuk mendeteksi perubahan step
    document.addEventListener('stepChanged', function(e) {
        if (e.detail && e.detail.step === 'upload') {
            loadExistingFiles();
            validateUploadStep();
        }
    });

    // Fallback: Check every 500ms if we're on upload step
    const checkUploadStepInterval = setInterval(() => {
        if (isCurrentStepUpload()) {
            loadExistingFiles();
            validateUploadStep();
            clearInterval(checkUploadStepInterval);
        }
    }, 500);
});

// ========================================
// VALIDASI FINAL SEBELUM SUBMIT FORM
// ========================================
const msform = document.getElementById("msform");
if (msform) {
    msform.addEventListener("submit", function(e) {
        const evidenValue = document.getElementById("eviden").value;
        console.log("📤 Form akan di-submit dengan eviden:", evidenValue);
        
        // Cek apakah eviden kosong
        try {
            const parsed = JSON.parse(evidenValue);
            if (!Array.isArray(parsed) || parsed.length === 0) {
                console.warn("⚠ WARNING: Eviden kosong!");
                e.preventDefault();
                alert("❌ SUBMIT GAGAL!\n\nAnda harus mengupload minimal 1 file eviden sebelum dapat mengirim form.");
                return false;
            } else {
                console.log("✅ Eviden berisi", parsed.length, "file(s)");
                parsed.forEach((url, index) => {
                    console.log(`   ${index + 1}. ${url}`);
                });
            }
        } catch (err) {
            console.error("❌ ERROR: Format eviden tidak valid!", err);
            e.preventDefault();
            alert("❌ Error: Format file eviden tidak valid!");
            return false;
        }
    });
}
</script>
</div>
</form>
</section>
</main>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="akun-container">
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color:green;"><?php echo $this->session->flashdata('success'); ?></p>
        <?php elseif ($this->session->flashdata('error')): ?>
            <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
<!-- FONT AWESOME ICON -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script type="text/javascript">
        $(document).ready(function() {
            $('#nama_kegiatan').autocomplete({
                source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nama_kegiatan",
                select: function(event, ui) {
                    $('[name="nama_kegiatan"]').val(ui.item.label);
                }
            });
            $('#no_ememo').autocomplete({
                source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_ememo",
                select: function(event, ui) {
                    $('[name="no_ememo"]').val(ui.item.label);
                }
            });
            $('#periode_penugasan').autocomplete({
                source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_periode_penugasan",
                select: function(event, ui) {
                    $('[name="periode_penugasan"]').val(ui.item.label);
                }
            });
            $('#nip').autocomplete({
                source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                select: function(event, ui) {
                    $('[name="nip"]').val(ui.item.label);
                    $('[name="nama_dosen"]').val(ui.item.name);
                    $('[name="jabatan"]').val(ui.item.jabatan);
                }
            });

        });
        var dateToday = new Date();
        $(document).ready(function() {
                $(function() {
                    $("#datepicker2").datepicker({
                        minDate: -49,
                        maxDate: 180,
                        dateFormat: 'dd-mm-yy'
                    });
                });
            $(function() {
                $("#datepicker3").datepicker({
                    minDate: -49,
                    dateFormat: 'dd-mm-yy'
                });
            });
            $(function() {
                $("#datepicker4").datepicker({
                    minDate: -49,
                    maxDate: 180,
                    dateFormat: 'dd-mm-yy'
                });
            });
            //periode penugasan
            $(function() {
                $("#periode_penugasan").datepicker({
                    dateFormat: 'dd M yy'
                });
            });
            $(function() {
                $("#periode_penugasan1").datepicker({
                    dateFormat: 'dd M yy'
                });
            });

            function toggleRequired() {
                $('input[required], select[required]').each(function() {
                    if ($(this).is(':visible')) {
                        $(this).prop('required', true);
                    } else {
                        $(this).prop('required', false);
                    }
                });
            }

            toggleRequired();

            $('.next').click(function() {
                toggleRequired();
            });

            $('.previous_button').click(function() {
                toggleRequired();
            });
        });

        //Tambah NIP
        $(document).ready(function() {
            var rowIdx = 0;
            $('#addBtn').on('click', function() {
                $('#tbody').append(`<div id="R${++rowIdx}" >
            
            <div class="show-index" id="showIndex">
                <div class="delete-index" id="remove">
                    <div class="form-group" style="margin-bottom:12px">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="nip[]" class="autocomplete${rowIdx} form-control custom-form-control " id="nip" required="required" place="nip${rowIdx}">
                                <label style="margin-left:16px">NIP</label>
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="nama_dosen" id="nama${rowIdx}" class=" form-control custom-form-control col-md-11" place="nama${rowIdx}" >
                            <label>Nama</label>
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="jabatan" class=" form-control custom-form-control col-md-11" id="jabatan" place="jabatan${rowIdx}" >
                            <label>Jabatan</label>
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="divisi[]" id="divisi" class="form-control custom-form-control col-md-11"  required="required"autocomplete="off" ><label>Divisi</label>
                            </div>
                            <div class="col-md-1">
                                <i id ="minus" class="fas fa-trash-alt " style="margin-top: 12px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			</div>`)

                $('.autocomplete1').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama1" ]').val(ui.item.name);
                        $('[place="jabatan1"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete2').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama2" ]').val(ui.item.name);
                        $('[place="jabatan2"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete3').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama3" ]').val(ui.item.name);
                        $('[place="jabatan3"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete4').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama4" ]').val(ui.item.name);
                        $('[place="jabatan4"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete5').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama5" ]').val(ui.item.name);
                        $('[place="jabatan5"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete6').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama6" ]').val(ui.item.name);
                        $('[place="jabatan6"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete7').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama7" ]').val(ui.item.name);
                        $('[place="jabatan7"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete8').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama8" ]').val(ui.item.name);
                        $('[place="jabatan8"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete9').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama9" ]').val(ui.item.name);
                        $('[place="jabatan9"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete10').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama10" ]').val(ui.item.name);
                        $('[place="jabatan10"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete11').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama11" ]').val(ui.item.name);
                        $('[place="jabatan11"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete12').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama12" ]').val(ui.item.name);
                        $('[place="jabatan12"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete13').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama13" ]').val(ui.item.name);
                        $('[place="jabatan13"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete14').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama14" ]').val(ui.item.name);
                        $('[place="jabatan14"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete15').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama15" ]').val(ui.item.name);
                        $('[place="jabatan15"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete16').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama16" ]').val(ui.item.name);
                        $('[place="jabatan16"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete17').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama17" ]').val(ui.item.name);
                        $('[place="jabatan17"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete18').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama18" ]').val(ui.item.name);
                        $('[place="jabatan18"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete19').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama19" ]').val(ui.item.name);
                        $('[place="jabatan19"]').val(ui.item.jabatan);
                    }
                });
                $('.autocomplete20').autocomplete({
                    source: "https://ifik.telkomuniversity.ac.id/autocomplete/get_nip",
                    select: function(event, ui) {
                        $('[place="nama20" ]').val(ui.item.name);
                        $('[place="jabatan20"]').val(ui.item.jabatan);
                    }
                });
            });
        });
        $(document).on('click', '#minus', function() {
            var myobj = document.getElementById("remove");
            myobj.remove();
        });

        //addEviden
        $(document).ready(function() {
            $('#addEviden').on('click', function() {
                $('#tambahEviden').append(`
            <div class="form-group" style="margin-bottom:12;" id="removeEviden">
                <div class="row">
                <div class="col-md-11">
                        <input type="file" name="eviden[]" id="eviden" class="form-control" style="padding:13px 16px" value="">
                        <span id="chk-error"></span>
                        <label style="margin-left:16px"></label>
                    </div>
                    <div class="col-md-1">
                        <i id="hapus" class="fas fa-trash-alt" ></i>
                    </div>
                </div>
            </div>`)
            });
        });
        $(document).on('click', '#hapus', function() {
            var myobj = document.getElementById("removeEviden");
            myobj.remove();
        });
    </script>
    <script>
        jQuery(function() {
            jQuery("#tambahPanitia").hide()
            jQuery("#tambahDivisi").hide()
            jQuery("#kepanitiaan").hide()
            jQuery("#divisi").hide()
            jQuery("#lbldivisi").hide()
            jQuery("#selectformat").hide()
            jQuery("#jenis_pengajuan").change(function() {
                var value = jQuery(this).val();
                if (value == "Kelompok") {
                    $("#tambahDivisi").show();
                    $("#kepanitiaan").show();
                    $("#tambahPanitia").show()
                    $("#divisi").show()
                    $("#lbldivisi").show()
                    $("#selectformat").show()
                } else {
                    jQuery("#tambahDivisi").hide()
                    jQuery("#tambahPanitia").hide()
                    jQuery("#kepanitiaan").hide()
                    jQuery("#divisi").hide()
                    jQuery("#lbldivisi").hide()
                    jQuery("#selectformat").hide()
                }
            });
        });
    </script>
    <script>
        jQuery(function() {
            // jQuery("#jenis_pengajuan").hide()
            jQuery("#jenis_penugasan_kelompok").hide()

            jQuery("#jenis_penugasan_perorangan").hide()
            jQuery("#jenis_pengajuan").change(function() {
                var value = jQuery(this).val();
                if (value == "Perorangan") {
                    jQuery("#jenis_penugasan_perorangan").hide()
                    $("#jenis_penugasan_perorangan").show();
                    jQuery("#penugasan_lainnya_kelompok").hide()
                } else {
                    jQuery("#jenis_penugasan_perorangan").hide()
                }
            });
        });
    </script>
    <script>
        jQuery(function() {
            // jQuery("#jenis_pengajuan").hide()
            // jQuery("#penugasan_lainnya_perorangan").hide()
            // jQuery("#penugasan_lainnya_kelompok").hide()
            jQuery("#jenis_penugasan_perorangan").hide()

            jQuery("#jenis_penugasan_kelompok").hide()
            jQuery("#jenis_pengajuan").change(function() {
                var value = jQuery(this).val();
                if (value == "Kelompok") {
                    jQuery("#jenis_penugasan_kelompok").hide()
                    $("#jenis_penugasan_kelompok").show();
                    jQuery("#penugasan_lainnya_perorangan").hide()
                } else {
                    jQuery("#jenis_penugasan_kelompok").hide()
                }
            });
        });
    </script>
    <script>
        jQuery(function() {
            jQuery("#penugasan_lainnya_perorangan").hide()
            jQuery("#jenis_penugasan_perorangan").change(function() {
                //  jQuery(this).val() == 'select' ? jQuery("#textarea").hide() : jQuery("#textarea").show();
                var value = jQuery(this).val();
                if (value == "Lainnya") {
                    jQuery("#penugasan_lainnya_perorangan").hide()
                    $("#penugasan_lainnya_perorangan").show();
                } else {
                    jQuery("#penugasan_lainnya_perorangan").hide()
                }
            });
        });
    </script>
    <script>
        jQuery(function() {
            jQuery("#penugasan_lainnya_kelompok").hide()
            jQuery("#jenis_penugasan_kelompok").change(function() {
                //  jQuery(this).val() == 'select' ? jQuery("#textarea").hide() : jQuery("#textarea").show();
                var value = jQuery(this).val();
                if (value == "Lainnya") {
                    jQuery("#penugasan_lainnya_kelompok").hide()
                    $("#penugasan_lainnya_kelompok").show();
                } else {
                    jQuery("#penugasan_lainnya_kelompok").hide()
                }
            });
        });
    </script>
    <script>
        jQuery(function() {
            // jQuery("#jenis_pengajuan").hide()
            jQuery("#datepicker").hide()
            jQuery("#datepicker2").hide()
            jQuery("#datepicker3").hide()
            jQuery("#datepicker4").hide()
            jQuery("#periode_value").hide()
            jQuery("#lbl_mulai").hide()
            jQuery("#lbl_mulai1").hide()
            jQuery("#lbl_akhir").hide()
            jQuery("#lbl_akhir1").hide()
            jQuery("#jenis_date").change(function() {
                var value = jQuery(this).val();
                if (value == "Custom") {
                    $("#periode_value").hide();
                    $("#lbl_mulai").show();
                    $("#lbl_mulai1").show();
                    $("#lbl_akhir").show();
                    $("#lbl_akhir1").show();
                    $("#datepicker").show();
                    $("#datepicker2").show();
                    $("#datepicker3").show();
                    $("#datepicker4").show();
                    // jQuery("#penugasan_lainnya_kelompok").hide()
                } else {
                    $("#lbl_mulai").hide();
                    $("#datepicker").hide();
                    $("#datepicker2").hide();
                    $("#datepicker3").hide();
                    $("#datepicker4").hide();
                }
            });
        });
    </script>
    <!-- Footer -->
    <div class="footer">
        <div class="padding-t50"></div>
        <footer class="fik-footer">
            <div class="credit" style="text-align:left;padding-left:285px;border-top:1px solid #ddd;background-color:#f8f8fa">Laboratorium, Bengkel &amp; Studio FIK &copy; 2020</div>
        </footer>
    </div>

    <!-- End Footer -->

    <!-- ✅ Then load jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js"></script>

    <!-- Other plugins (after jQuery UI) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.min.js"></script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-nice-select@1.1.0/js/jquery.nice-select.min.js"></script>

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

    <!-- (Opsional) Bahasa Indonesia -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.id.min.js"></script>

    <!-- Your custom scripts (load last) -->
    <script src="https://ifik.telkomuniversity.ac.id/assets/js/tambahan.js"></script>
    <script src="./js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#chatSection').TrackpadScrollEmulator();
        });
    </script>

<script>
$(document).ready(function() {

    // 1️⃣ Inisialisasi Nice Select untuk semua select yang pakai class .nice
    $('select.nice').niceSelect();

    // 2️⃣ Hide semua elemen tanggal & periode awal
    $("#datepicker, #datepicker2, #datepicker3, #datepicker4, #lbl_mulai, #lbl_mulai1, #lbl_akhir, #lbl_akhir1").hide();
    $("#periode_value").closest('.nice-select').hide(); // hide wrapper Nice Select

    // 3️⃣ Fungsi toggle untuk #jenis_date
    function toggleJenisDate(value) {
        if (value === "Custom") {
            $("#periode_value").closest('.nice-select').hide(); 
            $("#lbl_mulai, #lbl_mulai1, #lbl_akhir, #lbl_akhir1, #datepicker, #datepicker2, #datepicker3, #datepicker4").show();
        } else {
            $("#periode_value").closest('.nice-select').show();
            $("#lbl_mulai, #lbl_mulai1, #lbl_akhir, #lbl_akhir1, #datepicker, #datepicker2, #datepicker3, #datepicker4").hide();
        }
    }

    // 4️⃣ Bind change event untuk #jenis_date
    $('#jenis_date').on('change', function() {
        toggleJenisDate($(this).val());
    });

    // 5️⃣ Multi-step form setup
    const fieldsets = $('fieldset');
    const totalSteps = fieldsets.length;
    let currentStep = 0;

    const updateProgress = () => {
        const percent = ((currentStep + 1) / totalSteps) * 100;
        $('#progressBar').css('width', percent + '%');
        $('#currentStep').text(currentStep + 1);

        // Tombol Back hanya muncul jika bukan langkah pertama
        $('.prev-btn').toggle(currentStep > 0);

        // Ganti teks tombol Next jadi Finish di langkah terakhir
        $('.next-btn').text(currentStep === totalSteps - 1 ? 'Finish' : 'Continue');
    };

    updateProgress();

    $('.next-btn').click(function() {
        if (currentStep < totalSteps - 1) {
            // Pindah ke step berikutnya
            fieldsets.eq(currentStep).removeClass('active');
            currentStep++;
            fieldsets.eq(currentStep).addClass('active');
            updateProgress();
        } else {
            // Step terakhir → submit form
            $('#msform').submit(); 
        }
    });

    $('.prev-btn').click(function() {
        if (currentStep > 0) {
            fieldsets.eq(currentStep).removeClass('active');
            currentStep--;
            fieldsets.eq(currentStep).addClass('active');
            updateProgress();
        }
    });

    // 6️⃣ Jika ada select tambahan yang ingin toggle lain, bisa bind di sini
    $('#periode_value').on('change', function() {
        const value = $(this).val();
        console.log("Periode dipilih:", value);
        // Tambahkan logika tambahan jika perlu
    });

});

// ========================================
// 1. FUNGSI LOADING SCREEN
// ========================================
function showLoadingScreen(message = 'Mengirim Pengajuan Surat Tugas...') {
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
        loadingOverlay.querySelector('.loading-text').textContent = message;
        loadingOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        console.log('🔄 Loading screen aktif:', message);
    }
}

function hideLoadingScreen() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
        loadingOverlay.classList.remove('active');
        document.body.style.overflow = '';
        console.log('✅ Loading screen non-aktif');
    }
}

// ========================================
// 2. HAPUS PESAN "LEAVE SITE?"
// ========================================
window.onbeforeunload = null;

// ========================================
// 4. MULTI-STEP NAVIGATION DENGAN VALIDASI
// ========================================
let currentStep = 0;
const fieldsets = $('fieldset');
const totalSteps = fieldsets.length;
let isSubmitting = false;

function updateProgress() {
    const percent = ((currentStep + 1) / totalSteps) * 100;
    $('#progressBar').css('width', percent + '%');
    $('#currentStep').text(currentStep + 1);
    $('#totalSteps').text(totalSteps);
    
    // Toggle tombol Back
    $('.prev-btn').toggle(currentStep > 0);
    
    // Update teks tombol Next
    const nextBtn = $('.next-btn');
    if (currentStep === totalSteps - 1) {
        nextBtn.text('Finish');
        nextBtn.removeClass('btn-primary').addClass('btn-success');
    } else {
        nextBtn.text('Continue');
        nextBtn.removeClass('btn-success').addClass('btn-primary');
    }
}

// Tombol Back
$('.prev-btn').off('click').on('click', function(e) {
    e.preventDefault();
    
    if (currentStep > 0) {
        fieldsets.eq(currentStep).removeClass('active');
        currentStep--;
        fieldsets.eq(currentStep).addClass('active');
        updateProgress();
        
        // Scroll ke atas form
        $('html, body').animate({
            scrollTop: $('.multi-step-form').offset().top - 100
        }, 300);
    }
});

// ========================================
// 5. AJAX FORM SUBMIT DENGAN LOADING SCREEN
// ========================================
$('#msform').off('submit').on('submit', function(e) {
    e.preventDefault();
    
    console.log('🚀 Form submit diproses...');
    
    // Cegah double submit
    if (isSubmitting) {
        console.log('⚠ Form sedang diproses, tunggu...');
        return false;
    }

    isSubmitting = true;
    
    // Tampilkan loading screen
    showLoadingScreen('Mengirim pengajuan surat tugas...');
    
    // Siapkan form data
    const formData = new FormData(this);
    
    // Debug: log data yang akan dikirim
    console.log('📤 Data yang akan dikirim:');
    for (let pair of formData.entries()) {
        if (pair[0] === 'eviden') {
            console.log('📎 Eviden:', pair[1]);
        } else {
            console.log(pair[0] + ': ' + pair[1]);
        }
    }
    
    // Kirim via AJAX
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        timeout: 30000, // 30 detik timeout
        beforeSend: function() {
            console.log('🔄 Mengirim request ke server...');
        },
        success: function(response, status, xhr) {
            console.log('✅ Response sukses:', response);
            hideLoadingScreen();
            isSubmitting = false;
            
            // Cek jika response adalah JSON
            let responseData;
            try {
                responseData = typeof response === 'string' ? JSON.parse(response) : response;
            } catch (e) {
                responseData = { success: true, message: 'Pengajuan berhasil dikirim!' };
            }
            
            // Tampilkan pesan sukses
            if (responseData.success) {
                // Redirect ke halaman list surat tugas
                setTimeout(function() {
                    window.location.href = "<?= base_url('list-surat-tugas') ?>?success=1&id=" + (responseData.id || '');
                }, 1500);
                
                // Tampilkan pesan sementara
                $('.multi-step-form').html(`
                    <div class="text-center py-5">
                        <div style="font-size: 80px; color: #28a745; margin-bottom: 20px;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3 class="text-success">Pengajuan Berhasil!</h3>
                        <p class="text-muted">Surat tugas Anda telah berhasil diajukan.</p>
                        <p class="text-muted"><small>Mengalihkan ke halaman daftar surat...</small></p>
                    </div>
                `);
            } else {
                alert('❌ ' + (responseData.message || 'Terjadi kesalahan pada server'));
                hideLoadingScreen();
                isSubmitting = false;
            }
        },
        error: function(xhr, status, error) {
            console.error('❌ Error AJAX:', status, error);
            hideLoadingScreen();
            isSubmitting = false;
            
            let errorMessage = 'Terjadi kesalahan saat mengirim pengajuan. ';
            
            if (xhr.status === 0) {
                errorMessage += 'Koneksi internet terputus atau server tidak merespon.';
            } else if (xhr.status === 400) {
                errorMessage += 'Data yang dikirim tidak valid.';
            } else if (xhr.status === 500) {
                errorMessage += 'Terjadi kesalahan internal server.';
            } else {
                errorMessage += 'Error ' + xhr.status + ': ' + (xhr.responseText || error);
            }
            
            alert('❌ ' + errorMessage);
            
            // Enable form kembali
            $('button[type="submit"]').prop('disabled', false);
        },
        complete: function() {
            console.log('✅ Request selesai');
        }
    });
});

// ========================================
// 6. INITIAL SETUP SAAT DOM READY
// ========================================
$(document).ready(function() {
    console.log('📄 Document ready, initializing form...');
    
    // Inisialisasi progress
    updateProgress();
    
    // Hapus beforeunload handler
    window.onbeforeunload = null;
    
    // Setup Nice Select
    if ($.fn.niceSelect) {
        $('select.nice').niceSelect();
    }
    
    // Inisialisasi datepicker (jika belum)
    if ($.fn.datepicker) {
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            autoclose: true
        });
    }
    
    // Setup event untuk jenis_date
    $('#jenis_date').on('change', function() {
        const value = $(this).val();
        const periodeSection = $('#periode_section');
        const customDateSection = $('.row .col-md-3.mt-3');
        
        if (value === 'Periode') {
            periodeSection.show();
            customDateSection.hide();
        } else if (value === 'Custom') {
            periodeSection.hide();
            customDateSection.show();
        }
    });
    
    // Setup event untuk jenis_pengajuan
    $('#jenis_pengajuan').on('change', function() {
        const value = $(this).val();
        const buttonCells = $('.button-cell');
        
        if (value === 'Kelompok') {
            buttonCells.css('display', 'flex');
            $('#jenis_penugasan_kelompok_container').show();
            $('#jenis_penugasan_perorangan_container').hide();
        } else {
            buttonCells.css('display', 'none');
            $('#jenis_penugasan_kelompok_container').hide();
            $('#jenis_penugasan_perorangan_container').show();
        }
    });
    
    // Setup untuk "Lainnya" option
    $('#jenis_penugasan_perorangan, #jenis_penugasan_kelompok').on('change', function() {
        const value = $(this).val();
        const isPerorangan = $(this).attr('id') === 'jenis_penugasan_perorangan';
        const lainnyaInput = isPerorangan ? $('#penugasan_lainnya_perorangan') : $('#penugasan_lainnya_kelompok');
        
        if (value === 'Lainnya') {
            lainnyaInput.show().focus();
        } else {
            lainnyaInput.hide().val('');
        }
    });
    
    // Sembunyikan loading jika ada pesan dari session
    <?php if ($this->session->flashdata('error') || $this->session->flashdata('success')): ?>
        setTimeout(function() {
            hideLoadingScreen();
            isSubmitting = false;
        }, 100);
    <?php endif; ?>
    
    console.log('✅ Form initialization complete');
});

// ========================================
// 8. HANDLE UPLOADCARE SUCCESS
// ========================================
window.updateEvidenList = function(files) {
    console.log('📁 File diupload:', files);
    
    // Update display
    const uploadedFiles = [];
    const filesList = $('#files-list');
    filesList.empty();
    
    files.forEach((file, index) => {
        uploadedFiles.push(file.cdnUrl);
        
        const fileName = file.name || `File ${index + 1}`;
        const fileSize = file.size ? `(${(file.size / 1024 / 1024).toFixed(2)} MB)` : '';
        
        const fileItem = $(`
            <div class="file-item mb-2 p-2 border rounded" style="background: #f8f9fa;">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-file-alt text-muted me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">${fileName}</div>
                        <small class="text-muted">${fileSize}</small>
                    </div>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-sm btn-danger remove-file" data-index="${index}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `);
        
        filesList.append(fileItem);
    });
    
    // Update hidden input
    $('#eviden').val(JSON.stringify(uploadedFiles));
    
    // Tampilkan container jika ada file
    if (uploadedFiles.length > 0) {
        $('#uploaded-files-display').show();
    }
    
    // Event untuk tombol hapus
    $('.remove-file').off('click').on('click', function() {
        const index = $(this).data('index');
        files.splice(index, 1);
        window.updateEvidenList(files);
    });
};

// ========================================
// 9. RESET FORM FLAG JIKA PAGE DIBUKA KEMBALI
// ========================================
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        // Page di-load dari cache (back/forward)
        hideLoadingScreen();
        isSubmitting = false;
        console.log('🔄 Page di-load dari cache, reset flag');
    }
});
</script>
<script>
// ========================================
// REAL-TIME VALIDATION & BUTTON STATE
// ========================================

// Fungsi untuk mengecek apakah Step 1 valid
function checkStep1Validity() {
    let isValid = true;
    
    // Cek Jenis Pengajuan
    const jenisPengajuan = $('#jenis_pengajuan').val();
    if (!jenisPengajuan || jenisPengajuan === '') {
        isValid = false;
    }
    
    // Cek Status Kepegawaian
    const lingkupPenugasan = $('#lingkup_penugasan').val();
    if (!lingkupPenugasan || lingkupPenugasan === '') {
        isValid = false;
    }
    
    // Cek Jenis Penugasan berdasarkan Jenis Pengajuan
    if (jenisPengajuan === 'Perorangan') {
        const jenisPenugasanPerorangan = $('#jenis_penugasan_perorangan').val();
        if (!jenisPenugasanPerorangan || jenisPenugasanPerorangan === '') {
            isValid = false;
        }
        
        // Cek "Lainnya" jika dipilih
        if (jenisPenugasanPerorangan === 'Lainnya') {
            const penugasanLainnya = $('#penugasan_lainnya_perorangan').val().trim();
            if (!penugasanLainnya) {
                isValid = false;
            }
        }
    } else if (jenisPengajuan === 'Kelompok') {
        const jenisPenugasanKelompok = $('#jenis_penugasan_kelompok').val();
        if (!jenisPenugasanKelompok || jenisPenugasanKelompok === '') {
            isValid = false;
        }
        
        // Cek "Lainnya" jika dipilih
        if (jenisPenugasanKelompok === 'Lainnya') {
            const penugasanLainnya = $('#penugasan_lainnya_kelompok').val().trim();
            if (!penugasanLainnya) {
                isValid = false;
            }
        }
    }
    
    // Cek Data Panitia/Dosen - minimal harus ada 1 row lengkap
    const panitiaRows = $('.panitia-row');
    let hasCompleteRow = false;
    
    panitiaRows.each(function() {
        const row = $(this);
        const nip = row.find('.nip-input').val().trim();
        const nama = row.find('.nama-dosen-input').val().trim();
        const jabatan = row.find('.jabatan-input').val().trim();
        const kaprodi = row.find('.kaprodi-input').val().trim();
        
        // Untuk kelompok, cek juga peran
        let peranValid = true;
        if (jenisPengajuan === 'Kelompok') {
            const peran = row.find('.peran-input').val().trim();
            peranValid = (peran !== '');
        }
        
        if (nip && nama && jabatan && kaprodi && peranValid) {
            hasCompleteRow = true;
        }
    });
    
    if (!hasCompleteRow) {
        isValid = false;
    }
    
    return isValid;
}

// Fungsi untuk mengecek apakah Step 2 valid
function checkStep2Validity() {
    let isValid = true;
    
    // Cek Nama Kegiatan
    const namaKegiatan = $('#nama_kegiatan').val().trim();
    if (!namaKegiatan) {
        isValid = false;
    }
    
    // Cek Jenis Tanggal
    const jenisDate = $('#jenis_date').val();
    if (!jenisDate || jenisDate === '') {
        isValid = false;
    } else {
        // Cek berdasarkan jenis tanggal
        if (jenisDate === 'Periode') {
            const periodeValue = $('#periode_value').val();
            if (!periodeValue || periodeValue === '') {
                isValid = false;
            }
        } else if (jenisDate === 'Custom') {
            const tanggalAwal = $('#tanggal_awal_kegiatan').val();
            const tanggalAkhir = $('#tanggal_akhir_kegiatan').val();
            
            if (!tanggalAwal || !tanggalAkhir) {
                isValid = false;
            }
        }
    }
    
    // Cek Tempat Kegiatan
    const tempatKegiatan = $('input[name="tempat_kegiatan"]').val().trim();
    if (!tempatKegiatan) {
        isValid = false;
    }
    
    // Cek Penyelenggara
    const penyelenggara = $('input[name="penyelenggara"]').val().trim();
    if (!penyelenggara) {
        isValid = false;
    }
    
    return isValid;
}

// Fungsi untuk mengecek apakah Step 3 valid
function checkStep3Validity() {
    // Step 3 selalu valid karena upload file bersifat opsional
    // Jika ingin file eviden wajib, uncomment kode berikut:
    /*
    const evidenValue = $('#eviden').val();
    try {
        const evidenArray = JSON.parse(evidenValue);
        if (!Array.isArray(evidenArray) || evidenArray.length === 0) {
            return false;
        }
    } catch (e) {
        return false;
    }
    */
    return true;
}

// Fungsi untuk update state tombol Continue
function updateContinueButtonState() {
    const nextBtn = $('.next-btn');
    let isValid = false;
    
    // Cek validitas berdasarkan step saat ini
    if (currentStep === 0) {
        isValid = checkStep1Validity();
    } else if (currentStep === 1) {
        isValid = checkStep2Validity();
    } else if (currentStep === 2) {
        isValid = checkStep3Validity();
    }
    
    // Update state tombol
    if (isValid) {
        nextBtn.prop('disabled', false);
        nextBtn.removeClass('btn-disabled');
        nextBtn.css({
            'opacity': '1',
            'cursor': 'pointer'
        });
    } else {
        nextBtn.prop('disabled', true);
        nextBtn.addClass('btn-disabled');
        nextBtn.css({
            'opacity': '0.6',
            'cursor': 'not-allowed'
        });
    }
    
    // Log untuk debugging
    console.log(`🔘 Button state - Step ${currentStep + 1}:`, isValid ? 'ENABLED ✅' : 'DISABLED ❌');
}

// ========================================
// EVENT LISTENERS UNTUK REAL-TIME VALIDATION
// ========================================

$(document).ready(function() {
    
    // ===== STEP 1 EVENT LISTENERS =====
    
    // Monitor perubahan pada Jenis Pengajuan
    $('#jenis_pengajuan').on('change', function() {
        console.log('📝 Jenis Pengajuan changed:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Status Kepegawaian
    $('#lingkup_penugasan').on('change', function() {
        console.log('📝 Status Kepegawaian changed:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Jenis Penugasan (Perorangan)
    $('#jenis_penugasan_perorangan').on('change', function() {
        console.log('📝 Jenis Penugasan (Perorangan) changed:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Penugasan Lainnya (Perorangan)
    $('#penugasan_lainnya_perorangan').on('input', function() {
        console.log('📝 Penugasan Lainnya (Perorangan) input:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Jenis Penugasan (Kelompok)
    $('#jenis_penugasan_kelompok').on('change', function() {
        console.log('📝 Jenis Penugasan (Kelompok) changed:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Penugasan Lainnya (Kelompok)
    $('#penugasan_lainnya_kelompok').on('input', function() {
        console.log('📝 Penugasan Lainnya (Kelompok) input:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada field Panitia/Dosen menggunakan event delegation
    $('#panitiaContainer').on('input change', '.nip-input, .nama-dosen-input, .jabatan-input, .kaprodi-input, .peran-input', function() {
        console.log('📝 Panitia field changed:', $(this).attr('class'), $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor penambahan/penghapusan row panitia
    $('#panitiaContainer').on('click', '.add-row-btn, .remove-row-btn', function() {
        setTimeout(function() {
            console.log('🔄 Panitia row added/removed');
            updateContinueButtonState();
        }, 100);
    });
    
    // ===== STEP 2 EVENT LISTENERS =====
    
    // Monitor perubahan pada Nama Kegiatan
    $('#nama_kegiatan').on('input', function() {
        console.log('📝 Nama Kegiatan input:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Jenis Tanggal
    $('#jenis_date').on('change', function() {
        console.log('📝 Jenis Tanggal changed:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Periode
    $('#periode_value').on('change', function() {
        console.log('📝 Periode changed:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Datepicker (tanggal custom)
    $('#datepicker').on('change', function() {
        console.log('📝 Datepicker changed');
        // Delay sedikit karena flatpickr butuh waktu untuk update hidden inputs
        setTimeout(function() {
            updateContinueButtonState();
        }, 100);
    });
    
    // Monitor perubahan pada hidden inputs tanggal
    $('#tanggal_awal_kegiatan, #tanggal_akhir_kegiatan').on('change', function() {
        console.log('📝 Hidden date input changed:', $(this).attr('name'), $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Tempat Kegiatan
    $('input[name="tempat_kegiatan"]').on('input', function() {
        console.log('📝 Tempat Kegiatan input:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor perubahan pada Penyelenggara
    $('input[name="penyelenggara"]').on('input', function() {
        console.log('📝 Penyelenggara input:', $(this).val());
        updateContinueButtonState();
    });
    
    // ===== STEP 3 EVENT LISTENERS =====
    
    // Monitor perubahan pada file upload
    $('#eviden').on('change', function() {
        console.log('📝 Eviden changed:', $(this).val());
        updateContinueButtonState();
    });
    
    // Monitor saat file diupload via Uploadcare
    window.updateEvidenList = function(files) {
        console.log('📁 File diupload:', files);
        
        // Update display (kode existing)
        const uploadedFiles = [];
        const filesList = $('#files-list');
        filesList.empty();
        
        files.forEach((file, index) => {
            uploadedFiles.push(file.cdnUrl);
            
            const fileName = file.name || `File ${index + 1}`;
            const fileSize = file.size ? `(${(file.size / 1024 / 1024).toFixed(2)} MB)` : '';
            
            const fileItem = $(`
                <div class="file-item mb-2 p-2 border rounded" style="background: #f8f9fa;">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-file-alt text-muted me-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold">${fileName}</div>
                            <small class="text-muted">${fileSize}</small>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-sm btn-danger remove-file" data-index="${index}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
            
            filesList.append(fileItem);
        });
        
        // Update hidden input
        $('#eviden').val(JSON.stringify(uploadedFiles));
        
        // Tampilkan container jika ada file
        if (uploadedFiles.length > 0) {
            $('#uploaded-files-display').show();
        }
        
        // Event untuk tombol hapus
        $('.remove-file').off('click').on('click', function() {
            const index = $(this).data('index');
            files.splice(index, 1);
            window.updateEvidenList(files);
            
            // Update button state setelah hapus file
            updateContinueButtonState();
        });
        
        // Update button state setelah upload
        updateContinueButtonState();
    };
    
    // ===== INITIAL STATE =====
    // Set initial state saat page load
    setTimeout(function() {
        updateContinueButtonState();
        console.log('🎬 Initial button state set');
    }, 500);
    
    // Update button state saat pindah step
    const originalUpdateProgress = window.updateProgress;
    window.updateProgress = function() {
        if (originalUpdateProgress) {
            originalUpdateProgress();
        }
        
        // Update button state untuk step baru
        setTimeout(function() {
            updateContinueButtonState();
        }, 100);
    };
});

// ========================================
// UPDATE TOMBOL NEXT DENGAN VALIDASI
// ========================================
$(document).ready(function() {
    // Override event handler untuk tombol Next
    $('.next-btn').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Cek apakah tombol disabled
        if ($(this).prop('disabled')) {
            console.log('⛔ Button disabled, tidak bisa lanjut');
            
            // Tampilkan pesan

            showValidationAlert(errorMessages);
            return false;
        }
        
        const totalSteps = fieldsets.length;
        
        // Validasi berdasarkan step saat ini (double check)
        let isValid = true;
        
        if (currentStep === 0) {
            isValid = validateStep1();
            console.log('🔍 Validasi Step 1:', isValid ? '✅ Valid' : '❌ Invalid');
        } else if (currentStep === 1) {
            isValid = validateStep2();
            console.log('🔍 Validasi Step 2:', isValid ? '✅ Valid' : '❌ Invalid');
        } else if (currentStep === 2) {
            isValid = validateStep3();
            console.log('🔍 Validasi Step 3:', isValid ? '✅ Valid' : '❌ Invalid');
        }
        
        // Jika validasi gagal, hentikan
        if (!isValid) {
            console.log('⛔ Validasi gagal, tidak bisa lanjut ke step berikutnya');
            return false;
        }
        
        // Jika masih ada step berikutnya
        if (currentStep < totalSteps - 1) {
            fieldsets.eq(currentStep).removeClass('active');
            currentStep++;
            fieldsets.eq(currentStep).addClass('active');
            
            // Update progress bar
            updateProgress();
            
            // Scroll ke atas form
            $('html, body').animate({
                scrollTop: $('.multi-step-form').offset().top - 100
            }, 300);
            
            console.log('✅ Pindah ke Step', currentStep + 1);
        } 
        // Jika sudah di step terakhir (Finish)
        else {
            console.log("🚀 Validasi semua step berhasil, submitting form...");
            
            // Validasi final sebelum submit
            const finalValidation = validateStep1() && validateStep2() && validateStep3();
            
            if (finalValidation) {
                // Submit form via AJAX
                $('#msform').submit();
            } else {
                showValidationAlert(['❌ Mohon lengkapi semua data yang required sebelum mengirim']);
                return false;
            }
        }
    });
});

// Fungsi untuk validasi Step 1
function validateStep1() {
    let isValid = true;
    let errorMessages = [];
    
    // Validasi Jenis Pengajuan
    const jenisPengajuan = $('#jenis_pengajuan').val();
    if (!jenisPengajuan || jenisPengajuan === '') {
        errorMessages.push('❌ Jenis Pengajuan harus dipilih');
        $('#jenis_pengajuan').addClass('is-invalid');
        isValid = false;
    } else {
        $('#jenis_pengajuan').removeClass('is-invalid');
    }
    
    // Validasi Status Kepegawaian
    const lingkupPenugasan = $('#lingkup_penugasan').val();
    if (!lingkupPenugasan || lingkupPenugasan === '') {
        errorMessages.push('❌ Status Kepegawaian harus dipilih');
        $('#lingkup_penugasan').addClass('is-invalid');
        isValid = false;
    } else {
        $('#lingkup_penugasan').removeClass('is-invalid');
    }
    
    // Validasi Jenis Penugasan berdasarkan Jenis Pengajuan
    if (jenisPengajuan === 'Perorangan') {
        const jenisPenugasanPerorangan = $('#jenis_penugasan_perorangan').val();
        if (!jenisPenugasanPerorangan || jenisPenugasanPerorangan === '') {
            errorMessages.push('❌ Jenis Penugasan harus dipilih');
            $('#jenis_penugasan_perorangan').addClass('is-invalid');
            isValid = false;
        } else {
            $('#jenis_penugasan_perorangan').removeClass('is-invalid');
            
            // Validasi "Lainnya" jika dipilih
            if (jenisPenugasanPerorangan === 'Lainnya') {
                const penugasanLainnya = $('#penugasan_lainnya_perorangan').val().trim();
                if (!penugasanLainnya) {
                    errorMessages.push('❌ Jenis Penugasan Lainnya harus diisi');
                    $('#penugasan_lainnya_perorangan').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#penugasan_lainnya_perorangan').removeClass('is-invalid');
                }
            }
        }
    } else if (jenisPengajuan === 'Kelompok') {
        const jenisPenugasanKelompok = $('#jenis_penugasan_kelompok').val();
        if (!jenisPenugasanKelompok || jenisPenugasanKelompok === '') {
            errorMessages.push('❌ Jenis Penugasan harus dipilih');
            $('#jenis_penugasan_kelompok').addClass('is-invalid');
            isValid = false;
        } else {
            $('#jenis_penugasan_kelompok').removeClass('is-invalid');
            
            // Validasi "Lainnya" jika dipilih
            if (jenisPenugasanKelompok === 'Lainnya') {
                const penugasanLainnya = $('#penugasan_lainnya_kelompok').val().trim();
                if (!penugasanLainnya) {
                    errorMessages.push('❌ Jenis Penugasan Lainnya harus diisi');
                    $('#penugasan_lainnya_kelompok').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#penugasan_lainnya_kelompok').removeClass('is-invalid');
                }
            }
        }
    }
    
    // Validasi Data Panitia/Dosen
    const panitiaRows = $('.panitia-row');
    let hasEmptyFields = false;
    
    panitiaRows.each(function(index) {
        const row = $(this);
        const nip = row.find('.nip-input').val().trim();
        const nama = row.find('.nama-dosen-input').val().trim();
        const jabatan = row.find('.jabatan-input').val().trim();
        const kaprodi = row.find('.kaprodi-input').val().trim();
        
        if (!nip) {
            row.find('.nip-input').addClass('is-invalid');
            hasEmptyFields = true;
        } else {
            row.find('.nip-input').removeClass('is-invalid');
        }
        
        if (!nama) {
            row.find('.nama-dosen-input').addClass('is-invalid');
            hasEmptyFields = true;
        } else {
            row.find('.nama-dosen-input').removeClass('is-invalid');
        }
        
        if (!jabatan) {
            row.find('.jabatan-input').addClass('is-invalid');
            hasEmptyFields = true;
        } else {
            row.find('.jabatan-input').removeClass('is-invalid');
        }
        
        if (!kaprodi) {
            row.find('.kaprodi-input').addClass('is-invalid');
            hasEmptyFields = true;
        } else {
            row.find('.kaprodi-input').removeClass('is-invalid');
        }
        
        // Validasi Peran untuk Kelompok
        if (jenisPengajuan === 'Kelompok') {
            const peran = row.find('.peran-input').val().trim();
            if (!peran) {
                row.find('.peran-input').addClass('is-invalid');
                hasEmptyFields = true;
            } else {
                row.find('.peran-input').removeClass('is-invalid');
            }
        }
    });
    
    if (hasEmptyFields) {
        errorMessages.push('❌ Semua field data dosen harus diisi lengkap');
        isValid = false;
    }
    
    // Tampilkan pesan error jika ada
    if (!isValid) {
        showValidationAlert(errorMessages);
    }
    
    return isValid;
}
// Fungsi untuk mengecek apakah Step 2 valid
function checkStep2Validity() {
    let isValid = true;
    
    // Cek Nama Kegiatan
    const namaKegiatan = $('#nama_kegiatan').val().trim();
    if (!namaKegiatan) {
        isValid = false;
    }
    
    // Cek Jenis Tanggal
    const jenisDate = $('#jenis_date').val();
    if (!jenisDate || jenisDate === '') {
        isValid = false;
    } else {
        // Cek berdasarkan jenis tanggal
        if (jenisDate === 'Periode') {
            const periodeValue = $('#periode_value').val();
            if (!periodeValue || periodeValue === '') {
                isValid = false;
            }
        } else if (jenisDate === 'Custom') {
            const tanggalAwal = $('#tanggal_awal_kegiatan').val();
            const tanggalAkhir = $('#tanggal_akhir_kegiatan').val();
            
            if (!tanggalAwal || !tanggalAkhir) {
                isValid = false;
            }
        }
    }
    
    // HAPUS validasi Tempat Kegiatan dan Penyelenggara
    // Field ini sekarang opsional, tidak perlu divalidasi
    
    return isValid;
}
// Fungsi untuk validasi Step 3
function validateStep3() {
    // Step 3 selalu valid karena upload file bersifat opsional
    return true;
}

// Fungsi untuk menampilkan alert validasi
function showValidationAlert(messages) {
    const alertHtml = `
        <div class="alert alert-danger alert-dismissible fade show validation-alert" role="alert" style="position: fixed; top: 80px; right: 20px; z-index: 9999; max-width: 400px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <strong><i class="fas fa-exclamation-triangle"></i> Validasi Form</strong>
            <ul class="mb-0 mt-2" style="padding-left: 20px;">
                ${messages.map(msg => `<li>${msg}</li>`).join('')}
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    // Hapus alert sebelumnya jika ada
    $('.validation-alert').remove();
    
    // Tambahkan alert baru
    $('body').append(alertHtml);
    
    // Auto-hide setelah 5 detik
    setTimeout(() => {
        $('.validation-alert').fadeOut(() => {
            $('.validation-alert').remove();
        });
    }, 5000);
    
    // Scroll ke atas
    $('html, body').animate({
        scrollTop: $('.multi-step-form').offset().top - 100
    }, 300);
}
</script>

<style>
/* Style untuk button disabled */
.next-btn:disabled,
.next-btn.btn-disabled {
    opacity: 0.6 !important;
    cursor: not-allowed !important;
    pointer-events: none;
    background-color: #6c757d !important;
    border-color: #6c757d !important;
}

.next-btn:not(:disabled):not(.btn-disabled):hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(251, 140, 0, 0.3);
    transition: all 0.3s ease;
}

/* Style untuk field yang invalid */
.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

.is-invalid:focus {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

/* Animation untuk alert */
.validation-alert {
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

/* Visual indicator untuk required fields */
label:after {
    content: " *";
    color: #dc3545;
    font-weight: bold;
}

/* Tooltip untuk button disabled */
.next-btn:disabled::after,
.next-btn.btn-disabled::after {
content: "Lengkapi semua field yang diperlukan";
position: absolute;
bottom: -30px;
left: 50%;
transform: translateX(-50%);
background: rgba(0, 0, 0, 0.8);
color: white;
padding: 5px 10px;
border-radius: 4px;
font-size: 12px;
white-space: nowrap;
opacity: 0;
pointer-events: none;
transition: opacity 0.3s;
}
.next-btn:disabled:hover::after,
.next-btn.btn-disabled:hover::after {
opacity: 1;
}
</style>
<!-- ============================ -->
<!-- LOADING SCREEN HTML          -->
<!-- ============================ -->
<div id="loadingOverlay" class="loading-overlay">
    <div class="loading-spinner"></div>
    <div class="loading-text">Mengirim Pengajuan Surat Tugas</div>
    <div class="loading-details">
        <p><i class="fas fa-sync-alt fa-spin"></i> Mohon tunggu sejenak. Pengajuan surat tugas sedang diproses.</p>
        <p><i class="fas fa-exclamation-circle"></i> Jangan tutup atau refresh halaman ini.</p>
        <p><small>Proses mungkin memakan waktu beberapa detik...</small></p>
    </div>
</div>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
// ========================================
// MULTI-STEP FORM NAVIGATION - FIXED
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Initializing multi-step form...');
    
    const fieldsets = document.querySelectorAll('fieldset');
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');
    const progressBar = document.getElementById('progressBar');
    const currentStepSpan = document.getElementById('currentStep');
    const totalStepsSpan = document.getElementById('totalSteps');
    
    let currentStep = 0;
    const totalSteps = fieldsets.length;
    
    // Set total steps
    if (totalStepsSpan) {
        totalStepsSpan.textContent = totalSteps;
    }
    
    // Update progress bar
    function updateProgress() {
        const percent = ((currentStep + 1) / totalSteps) * 100;
        
        if (progressBar) {
            progressBar.style.width = percent + '%';
        }
        
        if (currentStepSpan) {
            currentStepSpan.textContent = currentStep + 1;
        }
        
        // Toggle prev button
        if (prevBtn) {
            prevBtn.style.display = currentStep > 0 ? 'inline-block' : 'none';
        }
        
        // Update next button text
        if (nextBtn) {
            const nextBtnText = document.getElementById('next-btn-text');
            if (currentStep === totalSteps - 1) {
                if (nextBtnText) {
                    nextBtnText.textContent = 'Finish';
                } else {
                    nextBtn.textContent = 'Finish';
                }
                nextBtn.classList.remove('btn-primary');
                nextBtn.classList.add('btn-success');
            } else {
                if (nextBtnText) {
                    nextBtnText.textContent = 'Continue';
                } else {
                    nextBtn.textContent = 'Continue';
                }
                nextBtn.classList.remove('btn-success');
                nextBtn.classList.add('btn-primary');
            }
        }
        
        console.log('📊 Step:', currentStep + 1, '/', totalSteps);
    }
    
    // Validasi Step 1
    function validateStep1() {
        const jenisPengajuan = document.getElementById('jenis_pengajuan').value;
        const lingkupPenugasan = document.getElementById('lingkup_penugasan').value;
        
        if (!jenisPengajuan || jenisPengajuan === '') {
            alert('❌ Pilih Jenis Pengajuan terlebih dahulu!');
            return false;
        }
        
        if (!lingkupPenugasan || lingkupPenugasan === '') {
            alert('❌ Pilih Status Kepegawaian terlebih dahulu!');
            return false;
        }
        
        // Validasi jenis penugasan
        if (jenisPengajuan === 'Perorangan') {
            const jenisPenugasanPerorangan = document.getElementById('jenis_penugasan_perorangan').value;
            if (!jenisPenugasanPerorangan || jenisPenugasanPerorangan === '') {
                alert('❌ Pilih Jenis Penugasan terlebih dahulu!');
                return false;
            }
        } else if (jenisPengajuan === 'Kelompok') {
            const jenisPenugasanKelompok = document.getElementById('jenis_penugasan_kelompok').value;
            if (!jenisPenugasanKelompok || jenisPenugasanKelompok === '') {
                alert('❌ Pilih Jenis Penugasan terlebih dahulu!');
                return false;
            }
        }
        
        // Validasi minimal 1 dosen dengan data lengkap
        const panitiaRows = document.querySelectorAll('.panitia-row');
        let hasValidDosen = false;
        
        panitiaRows.forEach(row => {
            const nip = row.querySelector('.nip-input').value.trim();
            const nama = row.querySelector('.nama-dosen-input').value.trim();
            const jabatan = row.querySelector('.jabatan-input').value.trim();
            const kaprodi = row.querySelector('.kaprodi-input').value.trim();
            
            if (nip && nama && jabatan && kaprodi) {
                hasValidDosen = true;
            }
        });
        
        if (!hasValidDosen) {
            alert('❌ Minimal harus ada 1 dosen dengan data lengkap (NIP, Nama, Jabatan, Kaprodi)!');
            return false;
        }
        
        console.log('✅ Step 1 validation passed');
        return true;
    }
    
    // Validasi Step 2 - LEBIH PERMISIF
    function validateStep2() {
        const namaKegiatan = document.getElementById('nama_kegiatan').value.trim();
        const jenisDate = document.getElementById('jenis_date').value;
        
        if (!namaKegiatan) {
            alert('❌ Nama Kegiatan harus diisi!');
            document.getElementById('nama_kegiatan').focus();
            return false;
        }
        
        if (!jenisDate || jenisDate === '') {
            alert('❌ Pilih Jenis Tanggal terlebih dahulu!');
            document.getElementById('jenis_date').focus();
            return false;
        }
        
        // Validasi berdasarkan jenis tanggal
        if (jenisDate === 'Custom') {
            const tanggalAwal = document.getElementById('tanggal_awal_kegiatan').value;
            const tanggalAkhir = document.getElementById('tanggal_akhir_kegiatan').value;
            
            if (!tanggalAwal || !tanggalAkhir) {
                alert('❌ Pilih tanggal awal dan akhir kegiatan!');
                return false;
            }
        } else if (jenisDate === 'Periode') {
            const periodeValue = document.getElementById('periode_value').value;
            
            if (!periodeValue || periodeValue === '') {
                alert('❌ Pilih Periode terlebih dahulu!');
                document.getElementById('periode_value').focus();
                return false;
            }
        }
        
        // FIELD OPSIONAL - TIDAK PERLU VALIDASI
        // - Tempat Kegiatan
        // - Penyelenggara
        
        console.log('✅ Step 2 validation passed');
        return true;
    }
    
    // Validasi Step 3
    function validateStep3() {
        const fileInput = document.getElementById('file-input');
        
        // Cek apakah ada file yang dipilih
        if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
            // Cek dari selectedFiles global variable
            if (typeof selectedFiles === 'undefined' || selectedFiles.length === 0) {
                alert('❌ Minimal upload 1 file eviden sebelum submit!');
                return false;
            }
        }
        
        console.log('✅ Step 3 validation passed');
        return true;
    }
    
    // Next Button Handler
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            console.log('🔘 Next button clicked - Current step:', currentStep + 1);
            
            // Validasi step saat ini
            let isValid = true;
            
            if (currentStep === 0) {
                isValid = validateStep1();
            } else if (currentStep === 1) {
                isValid = validateStep2();
            } else if (currentStep === 2) {
                isValid = validateStep3();
            }
            
            if (!isValid) {
                console.log('❌ Validation failed for step', currentStep + 1);
                return;
            }
            
            // Jika belum step terakhir, pindah ke step berikutnya
            if (currentStep < totalSteps - 1) {
                fieldsets[currentStep].classList.remove('active');
                currentStep++;
                fieldsets[currentStep].classList.add('active');
                updateProgress();
                
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                console.log('➡️ Moved to step', currentStep + 1);
            } else {
                // Step terakhir - submit form
                console.log('📤 Submitting form...');
                
                const form = document.getElementById('msform');
                if (form) {
                    // Tampilkan loading screen jika ada
                    const loadingScreen = document.getElementById('loading-screen');
                    if (loadingScreen) {
                        loadingScreen.style.display = 'flex';
                        setTimeout(() => {
                            loadingScreen.style.opacity = '1';
                        }, 10);
                    }
                    
                    form.submit();
                }
            }
        });
    }
    
    // Previous Button Handler
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (currentStep > 0) {
                fieldsets[currentStep].classList.remove('active');
                currentStep--;
                fieldsets[currentStep].classList.add('active');
                updateProgress();
                
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                console.log('⬅️ Moved back to step', currentStep + 1);
            }
        });
    }
    
    // Initialize
    updateProgress();
    
    console.log('✅ Multi-step form initialized');
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hapus semua span dengan warna merah (#dc3545) di dalam label
        const labels = document.querySelectorAll('label');
        labels.forEach(label => {
            const spans = label.querySelectorAll('span');
            spans.forEach(span => {
                if (span.style.color === 'rgb(220, 53, 69)' || 
                    span.style.color === '#dc3545' ||
                    span.textContent === '*') {
                    span.style.display = 'none';
                     span.remove();
                }
            });
        });
        
        console.log('✅ Semua bintang merah telah disembunyikan');
    });
    document.addEventListener('DOMContentLoaded', function() {
    // Hapus semua tanda bintang
    setTimeout(function() {
        // Method 1: Hapus span dengan bintang
        document.querySelectorAll('label span').forEach(span => {
            if (span.textContent.includes('*') || 
                span.style.color === '#dc3545' || 
                span.style.color === 'rgb(220, 53, 69)' ||
                span.classList.contains('text-danger')) {
                span.remove();
            }
        });
        
        // Method 2: Hapus konten after dari label
        const style = document.createElement('style');
        style.textContent = `
            label::after {
                content: "" !important;
                display: none !important;
            }
            label span {
                display: none !important;
            }
        `;
        document.head.appendChild(style);
        
        // Method 3: Iterasi semua label
        document.querySelectorAll('label').forEach(label => {
            let html = label.innerHTML;
            // Hapus semua <span> yang mengandung bintang atau warna merah
            html = html.replace(/<span[^>]*>[\s\S]*?\*[\s\S]*?<\/span>/g, '');
            html = html.replace(/<span[^>]*style=["'][^"']*color.*?#dc3545[^"']*["'][^>]*>[\s\S]*?<\/span>/g, '');
            html = html.replace(/\*/g, '');
            label.innerHTML = html;
        });
        
        console.log('✅ Semua tanda bintang telah dihapus');
    }, 500);
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
    
    // 1. List Pengajuan
    const listPengajuanLink = document.querySelector('a[href*="list-surat-tugas"]');
    if (listPengajuanLink) {
        listPengajuanLink.addEventListener('click', function(e) {
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
    
    // 4. Peminjaman Ruangan - Buat Peminjaman
    const buatPeminjamanBtn = document.querySelector('a[data-target="#termcondition"]');
    if (buatPeminjamanBtn) {
        buatPeminjamanBtn.addEventListener('click', function() {
            console.log('📋 Buat Peminjaman modal opened');
        });
    }
    
    // 5. Peminjaman Ruangan - Daftar Ruangan
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
    
    // 6. Peminjaman Ruangan - Riwayat
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
    
    // 7. Ticketing - Input Ticketing
    const inputTicketingBtn = document.querySelector('a[data-target="#maketicketing"]');
    if (inputTicketingBtn) {
        inputTicketingBtn.addEventListener('click', function() {
            console.log('🎫 Input Ticketing modal opened');
        });
    }
    
    // 8. Ticketing - Riwayat
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
    
    // 9. Helpdesk
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
    
    // 10. Logout Button
    const logoutBtn = document.querySelector('button[data-target="#logout"]');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            console.log('🚪 Logout modal opened');
        });
    }
    
    // 11. Handle Logout Confirmation
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
</script>
</body>

</html>