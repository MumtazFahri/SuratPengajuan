<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/

$route['default_controller'] = 'surat';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| SURAT ROUTES
| -------------------------------------------------------------------------
*/

// DOWNLOAD ROUTES
$route['surat/download_eviden'] = 'surat/download_eviden';
$route['surat/download_eviden_url'] = 'surat/download_eviden_url';
$route['surat/dl/(.+)'] = 'surat/dl/$1';

// STATUS TRACKING
$route['surat/status/(:num)'] = 'surat/get_status/$1';
$route['api/status/(:num)'] = 'surat/get_status/$1';

// MULTI ACTION ROUTES
$route['surat/multi_delete'] = 'surat/multi_delete';
$route['surat/multi_edit'] = 'surat/multi_edit';
$route['surat/save_multi_edit'] = 'surat/save_multi_edit';

// CRUD ROUTES
$route['surat'] = 'surat/index';
$route['surat/index'] = 'surat/index';
$route['surat/create'] = 'surat/create';
$route['surat/submit'] = 'surat/submit';
$route['surat/edit/(:num)'] = 'surat/edit/$1';
$route['surat/delete/(:num)'] = 'surat/delete/$1';
$route['surat/cetak/(:num)'] = 'surat/cetak/$1';

// LIST SURAT TUGAS ROUTES
$route['surat/list-surat-tugas'] = 'surat/list_surat_tugas';
$route['list-surat-tugas'] = 'surat/list_surat_tugas';
$route['surat/list_surat_tugas'] = 'surat/list_surat_tugas';

// STATS GRID ROUTES
$route['surat/total'] = 'surat/halaman_total';
$route['surat/disetujui'] = 'surat/halaman_disetujui';
$route['surat/ditolak'] = 'surat/halaman_ditolak';
$route['surat/pending'] = 'surat/halaman_pending';

// COMPATIBILITY ROUTES
$route['surat/semua'] = 'surat/halaman_total';
$route['surat/menunggu'] = 'surat/halaman_pending';

/*
| -------------------------------------------------------------------------
| SEKRETARIAT SURAT ROUTES
| -------------------------------------------------------------------------
*/
$route['surat/sekretariat/semua'] = 'surat/semua_sekretariat';
$route['surat/sekretariat/disetujui'] = 'surat/disetujui_sekretariat';
$route['surat/sekretariat/ditolak'] = 'surat/ditolak_sekretariat';
$route['surat/sekretariat/pending'] = 'surat/pending_sekretariat';
$route['surat/sekretariat/menunggu'] = 'surat/menunggu_sekretariat';

// APPROVAL ROUTES
$route['surat/setujui/(:num)'] = 'surat/setujui/$1';
$route['surat/tolak/(:num)'] = 'surat/tolak/$1';
$route['surat/update_status/(:num)/(:any)'] = 'surat/update_status/$1/$2';

// DETAIL ROUTE
$route['surat/detail/(:num)'] = 'surat/detail/$1';

// QR CODE
$route['surat/generate_qr/(:num)'] = 'surat/generate_qr/$1';

// AJAX ROUTES
$route['surat/get_dosen_by_nip'] = 'surat/get_dosen_by_nip';
$route['surat/autocomplete_nip'] = 'surat/autocomplete_nip';
$route['sekretariat/autocomplete_nip'] = 'sekretariat/autocomplete_nip';

// DEBUG ROUTES
$route['surat/test_path'] = 'surat/test_path';
$route['surat/debug_eviden/(:num)'] = 'surat/debug_eviden/$1';

/*
| -------------------------------------------------------------------------
| DASHBOARD ROUTES
| -------------------------------------------------------------------------
*/

// Dekan routes
$route['dekan'] = 'dekan/index';
$route['dekan/dashboard'] = 'dekan/index';
$route['dekan/index'] = 'dekan/index';
$route['dekan/index/(:any)'] = 'dekan/index/$1';
$route['dekan/halaman_total'] = 'dekan/halaman_total';
$route['dekan/halaman_disetujui'] = 'dekan/halaman_disetujui';
$route['dekan/halaman_ditolak'] = 'dekan/halaman_ditolak';
$route['dekan/halaman_pending'] = 'dekan/halaman_pending';
$route['dekan/approve/(:num)'] = 'dekan/approve/$1';
$route['dekan/reject/(:num)'] = 'dekan/reject/$1';
$route['dekan/detail/(:num)'] = 'dekan/detail/$1';
$route['dekan/laporan'] = 'dekan/laporan';
$route['dekan/list_surat_tugas'] = 'dekan/list_surat_tugas';
$route['dekan/filter/(:any)'] = 'dekan/filter/$1';
$route['dekan/test'] = 'dekan/test';

// ✅ FIXED: Kaprodi routes dengan method yang benar
$route['kaprodi'] = 'kaprodi/index';
$route['kaprodi/dashboard'] = 'kaprodi/index';
$route['kaprodi/index'] = 'kaprodi/index';
$route['kaprodi/semua'] = 'kaprodi/semua';
$route['kaprodi/disetujui'] = 'kaprodi/disetujui';
$route['kaprodi/ditolak'] = 'kaprodi/ditolak';
$route['kaprodi/pending'] = 'kaprodi/pending';
$route['kaprodi/rejected'] = 'kaprodi/rejected';

// Single approve/reject
$route['kaprodi/approve/(:num)'] = 'kaprodi/approve/$1';
$route['kaprodi/reject/(:num)'] = 'kaprodi/reject/$1';

// Detail
$route['kaprodi/getDetailPengajuan/(:num)'] = 'kaprodi/getDetailPengajuan/$1';

// ✅ FIXED: Multi approve/reject routes - sesuai dengan method di controller
$route['kaprodi/process_multi_approve'] = 'kaprodi/process_multi_approve';
$route['kaprodi/process_multi_reject'] = 'kaprodi/process_multi_reject';

// Dashboard counts
$route['kaprodi/get_dashboard_counts'] = 'kaprodi/get_dashboard_counts';

// Sekretariat routes
$route['sekretariat'] = 'sekretariat/index';
$route['sekretariat/dashboard'] = 'sekretariat/index';
$route['sekretariat/index'] = 'sekretariat/index';
$route['sekretariat/pending'] = 'sekretariat/pending';
$route['sekretariat/bulk_approve'] = 'sekretariat/bulk_approve';
$route['sekretariat/bulk_reject'] = 'sekretariat/bulk_reject';
$route['sekretariat/disetujui'] = 'sekretariat/disetujui';
$route['sekretariat/ditolak'] = 'sekretariat/ditolak';
$route['sekretariat/semua'] = 'sekretariat/semua';
$route['sekretariat/approve/(:num)'] = 'sekretariat/approve/$1';
$route['sekretariat/reject/(:num)'] = 'sekretariat/reject/$1';
$route['sekretariat/getDetailPengajuan/(:num)'] = 'sekretariat/getDetailPengajuan/$1';
$route['sekretariat/get_dashboard_counts'] = 'sekretariat/get_dashboard_counts';
$route['sekretariat/update-pin'] = 'Sekretariat/update_pin';
$route['sekretariat/update-pin'] = 'Sekretariat/update_pin';
// Edit untuk sekretariat (semua status kecuali ditolak dekan)
$route['sekretariat/edit_surat_sekretariat/(:num)'] = 'sekretariat/edit_surat_sekretariat/$1';
$route['sekretariat/update_surat_sekretariat/(:num)'] = 'sekretariat/update_surat_sekretariat/$1';
// routes.php
$route['sekretariat/edit_surat/(:num)'] = 'sekretariat/edit_surat/$1';
$route['sekretariat/update_surat/(:num)'] = 'sekretariat/update_surat/$1';
$route['sekretariat/download_pdf/(:num)'] = 'sekretariat/download_pdf/$1';



/*
| -------------------------------------------------------------------------
| API ROUTES
| -------------------------------------------------------------------------
*/

$route['api/surat/status/(:num)'] = 'surat/get_status/$1';
$route['api/surat/list'] = 'surat/index';
$route['api/surat/detail/(:num)'] = 'surat/get_status/$1';

// API Routes for Kaprodi
$route['api/kaprodi/detail/(:num)'] = 'kaprodi/getDetailPengajuan/$1';

// API Routes for Sekretariat
$route['api/sekretariat/detail/(:num)'] = 'sekretariat/getDetailPengajuan/$1';
$route['api/sekretariat/dashboard_counts'] = 'sekretariat/get_dashboard_counts';

/*
| -------------------------------------------------------------------------
| AUTH ROUTES
| -------------------------------------------------------------------------
*/

$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';
$route['auth/process_login'] = 'auth/process_login';

/*
| -------------------------------------------------------------------------
| CATCH-ALL ROUTE
| -------------------------------------------------------------------------
*/

$route['(:any)'] = 'errors/page_404';
$route['sekretariat/edit_surat/(:num)'] = 'sekretariat/edit_surat/$1';
$route['sekretariat/update_surat/(:num)'] = 'sekretariat/update_surat/$1';

// WhatsApp Server Control Panel
$route['whatsapp/dashboard'] = 'whatsapp/dashboard';
$route['whatsapp/get_status'] = 'whatsapp/get_status';
$route['whatsapp/start_server'] = 'whatsapp/start_server';
$route['whatsapp/stop_server'] = 'whatsapp/stop_server';
$route['whatsapp/restart'] = 'whatsapp/restart';

// Recipient Management
$route['whatsapp/get_recipients'] = 'whatsapp/get_recipients';
$route['whatsapp/add_recipient'] = 'whatsapp/add_recipient';
$route['whatsapp/update_recipient'] = 'whatsapp/update_recipient';
$route['whatsapp/delete_recipient'] = 'whatsapp/delete_recipient';
$route['whatsapp/toggle_recipient'] = 'whatsapp/toggle_recipient';