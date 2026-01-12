<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kaprodi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Surat_model');
    }
/**
 * Get display name untuk dosen dari data surat
 * Return array untuk tampilan yang lebih fleksibel
 */
private function get_dosen_data_for_display($surat) 
{
    $dosen_list = [];
    
    
    // 2. Cek dosen_list
    if (!empty($surat->dosen_list)) {
        if (is_string($surat->dosen_list) && strpos($surat->dosen_list, '[') !== false) {
            $decoded = json_decode($surat->dosen_list, true);
            if ($decoded && is_array($decoded)) {
                foreach ($decoded as $item) {
                    if (is_array($item) && isset($item['nama'])) {
                        $dosen_list[] = $item['nama'];
                    } elseif (is_string($item)) {
                        $dosen_list[] = $item;
                    }
                }
            }
        } else {
            $dosen_list[] = $surat->dosen_list;
        }
        
        if (!empty($dosen_list)) {
            return $dosen_list;
        }
    }
    
    // 3. Lookup dari NIP
    if (!empty($surat->nip) && $surat->nip !== '-') {
        $nip_data = null;
        
        if (is_string($surat->nip) && (strpos($surat->nip, '[') !== false || strpos($surat->nip, '{') !== false)) {
            $nip_data = json_decode($surat->nip, true);
        } else {
            $nip_data = [$surat->nip];
        }
        
        if ($nip_data && is_array($nip_data)) {
            $this->db->select('nama_dosen');
            $this->db->from('list_dosen');
            $this->db->where_in('nip', $nip_data);
            $this->db->order_by('nama_dosen', 'ASC'); // Sort alphabetically
            $result = $this->db->get()->result_array();
            
            if (!empty($result)) {
                foreach ($result as $row) {
                    $dosen_list[] = $row['nama_dosen'];
                }
                return $dosen_list;
            }
        }
    }
    
    return ['Data dosen tidak tersedia'];
}
    /* ================================
       DASHBOARD - DITAMBAHKAN FILTER BULAN
    ================================= */
    public function index()
    {
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulan = $this->input->get('bulan') ?? 'all';
        $search = $this->input->get('search');
        $status_filter = $this->input->get('status');
        
        
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        // Query dasar dengan filter
        $this->db->where('YEAR(created_at)', $tahun);
        
        // Filter bulan jika dipilih
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        
        $this->db->where_in('status', ['pengajuan', 'disetujui KK', 'ditolak KK', 'disetujui sekretariat', 'disetujui dekan', 'ditolak sekretariat', 'ditolak dekan']);
        
        // Filter search
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_kegiatan', $search);
            $this->db->or_like('penyelenggara', $search);
            $this->db->or_like('jenis_pengajuan', $search);
            $this->db->or_like('nama_dosen', $search);
            $this->db->group_end();
        }

        // Filter status dari URL parameter
        if (!empty($status_filter)) {
            switch($status_filter) {
                case 'pending':
                    $this->db->where('status', 'pengajuan');
                    break;
                case 'approved':
                    $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan']);
                    break;
                case 'rejected':
                    $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan']);
                    break;
            }
        }

        $this->db->order_by('created_at', 'DESC');
    $surat_raw = $this->db->get('surat')->result();
    
    // Pre-process: tambahkan dosen_display_list
    foreach ($surat_raw as $surat) {
        $surat->dosen_display_list = $this->get_dosen_data_for_display($surat);
    }
    
    $data['surat_list'] = $surat_raw;

        // Statistik untuk card (dengan filter bulan)
        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['total_surat'] = $this->db->count_all_results('surat');

        // Pending count
        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['pending_count'] = $this->db->where('status', 'pengajuan')
                                         ->count_all_results('surat');

        // Approved count
        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['approved_count'] = $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan'])
                                          ->count_all_results('surat');

        // Rejected count
        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['rejected_count'] = $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan'])
                                          ->count_all_results('surat');

        // Grafik data - dengan dukungan filter bulan
        $total     = array_fill(0, 12, 0);
        $approved  = array_fill(0, 12, 0);
        $rejected  = array_fill(0, 12, 0);

        if ($bulan === 'all') {
            // Jika semua bulan, ambil data 12 bulan
            for ($i = 1; $i <= 12; $i++) {
                $total[$i-1] = $this->countByMonthYear($i, $tahun);
                $approved[$i-1] = $this->countApprovedByMonthYear($i, $tahun);
                $rejected[$i-1] = $this->countRejectedByMonthYear($i, $tahun);
            }
        } else {
            // Jika filter bulan spesifik, isi hanya bulan tersebut
            $bulan_int = (int)$bulan;
            for ($i = 1; $i <= 12; $i++) {
                if ($i == $bulan_int) {
                    $total[$i-1] = $this->countByMonthYear($i, $tahun);
                    $approved[$i-1] = $this->countApprovedByMonthYear($i, $tahun);
                    $rejected[$i-1] = $this->countRejectedByMonthYear($i, $tahun);
                } else {
                    $total[$i-1] = 0;
                    $approved[$i-1] = 0;
                    $rejected[$i-1] = 0;
                }
            }
        }

        $data['chart_total']    = $total;
        $data['chart_approved'] = $approved;
        $data['chart_rejected'] = $rejected;

        $this->load->view('kaprodi/dashboard', $data);
    }
public function check_nama_dosen_field()
{
    echo "<h3>Cek Field nama_dosen</h3>";
    
    // 1. Cek field yang ada
    $fields = $this->db->list_fields('surat');
    echo "<strong>Fields yang ada di tabel 'surat':</strong><br><pre>";
    print_r($fields);
    echo "</pre>";
    
    // 2. Cek apakah field nama_dosen ada
    if (in_array('nama_dosen', $fields)) {
        echo "<p style='color:green'><strong>✓ Field 'nama_dosen' ADA</strong></p>";
        
        // 3. Cek sample data
        $this->db->select('id, nama_kegiatan, nama_dosen, dosen_list, nip');
        $this->db->limit(5);
        $sample = $this->db->get('surat')->result();
        
        echo "<h4>Sample Data (5 baris pertama):</h4>";
        echo "<pre>";
        foreach ($sample as $row) {
            echo "ID: {$row->id}\n";
            echo "Nama Kegiatan: {$row->nama_kegiatan}\n";
            echo "Nama Dosen: " . (isset($row->nama_dosen) ? $row->nama_dosen : 'NULL/EMPTY') . "\n";
            echo "Dosen List: " . (isset($row->dosen_list) ? $row->dosen_list : 'NULL/EMPTY') . "\n";
            echo "NIP: " . (isset($row->nip) ? $row->nip : 'NULL/EMPTY') . "\n";
            echo "---\n";
        }
        echo "</pre>";
    } else {
        echo "<p style='color:red'><strong>✗ Field 'nama_dosen' TIDAK ADA</strong></p>";
        echo "<p>Field alternatif: dosen_list, nip</p>";
    }
}
    /* ================================
       HELPER FUNCTIONS UNTUK COUNT DATA PER BULAN
    ================================= */
    private function countByMonthYear($month, $year)
    {
        $this->db->where('YEAR(created_at)', $year);
        $this->db->where('MONTH(created_at)', $month);
        $this->db->where_in('status', ['pengajuan', 'disetujui KK', 'ditolak KK', 'disetujui sekretariat', 'disetujui dekan', 'ditolak sekretariat', 'ditolak dekan']);
        return $this->db->count_all_results('surat');
    }

    private function countApprovedByMonthYear($month, $year)
    {
        $this->db->where('YEAR(created_at)', $year);
        $this->db->where('MONTH(created_at)', $month);
        $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan']);
        return $this->db->count_all_results('surat');
    }

    private function countRejectedByMonthYear($month, $year)
    {
        $this->db->where('YEAR(created_at)', $year);
        $this->db->where('MONTH(created_at)', $month);
        $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan']);
        return $this->db->count_all_results('surat');
    }

    /* ================================
       PENDING (Status Pengajuan)
    ================================= */
    public function pending()
    {
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulan = $this->input->get('bulan') ?? 'all';
        $search = $this->input->get('search');
        
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['judul'] = "Pengajuan Menunggu Persetujuan Kaprodi";
        $data['role'] = "kaprodi";

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $this->db->where('status', 'pengajuan');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_kegiatan', $search);
            $this->db->or_like('penyelenggara', $search);
            $this->db->or_like('jenis_pengajuan', $search);
            $this->db->or_like('nama_dosen', $search);
            $this->db->group_end();
        }

        $this->db->order_by("created_at", "DESC");
        $data['surat_list'] = $this->db->get("surat")->result();
        $data['total_surat'] = count($data['surat_list']);

        // Statistik untuk card
        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['total_all'] = $this->db->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['pending_count'] = $this->db->where('status', 'pengajuan')
                                         ->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['approved_count'] = $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan'])
                                          ->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['rejected_count'] = $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan'])
                                          ->count_all_results('surat');

        $this->load->view('kaprodi/halaman_pending', $data);
    }

    /* ================================
       DISETUJUI 
    ================================= */
    public function disetujui()
    {
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulan = $this->input->get('bulan') ?? 'all';
        $search = $this->input->get('search');
        
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['judul'] = "Pengajuan Disetujui";
        $data['role'] = "kaprodi";

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan']);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_kegiatan', $search);
            $this->db->or_like('penyelenggara', $search);
            $this->db->or_like('jenis_pengajuan', $search);
            $this->db->or_like('nama_dosen', $search);
            $this->db->group_end();
        }

        $this->db->order_by("created_at", "DESC");
        $data['surat_list'] = $this->db->get("surat")->result();
        $data['total_surat'] = count($data['surat_list']);

        // Statistik untuk card
        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['total_all'] = $this->db->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['pending_count'] = $this->db->where('status', 'pengajuan')
                                         ->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['approved_count'] = $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan'])
                                          ->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['rejected_count'] = $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan'])
                                          ->count_all_results('surat');

        $this->load->view('kaprodi/halaman_disetujui', $data);
    }

    /* ================================
       DITOLAK
    ================================= */
    public function ditolak()
    {
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulan = $this->input->get('bulan') ?? 'all';
        $search = $this->input->get('search');
        
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['judul'] = "Pengajuan Ditolak";
        $data['role'] = "kaprodi";

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan']);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama_kegiatan', $search);
            $this->db->or_like('penyelenggara', $search);
            $this->db->or_like('jenis_pengajuan', $search);
            $this->db->or_like('nama_dosen', $search);
            $this->db->group_end();
        }

        $this->db->order_by("created_at", "DESC");
        $data['surat_list'] = $this->db->get("surat")->result();
        $data['total_surat'] = count($data['surat_list']);

        // Statistik untuk card
        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['total_all'] = $this->db->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['pending_count'] = $this->db->where('status', 'pengajuan')
                                         ->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['approved_count'] = $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan'])
                                          ->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $data['rejected_count'] = $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan'])
                                          ->count_all_results('surat');

        $this->load->view('kaprodi/halaman_ditolak', $data);
    }
/* ================================
   SEMUA (TOTAL) PENGAJUAN - DIPERBAIKI UNTUK MULTIPLE SELECTION
================================= */
public function semua()
{
    $tahun = $this->input->get('tahun') ?? date('Y');
    $bulan = $this->input->get('bulan') ?? 'all';
    $search = $this->input->get('search');
    $status_filter = $this->input->get('status');
    $lingkup_filter = $this->input->get('lingkup_penugasan');
    $jenis_penugasan_filter = $this->input->get('jenis_penugasan');
    
    $data['tahun'] = $tahun;
    $data['bulan'] = $bulan;
    $data['judul'] = "Total Pengajuan - Kaprodi";
    $data['role'] = "kaprodi";
    $data['status_filter'] = $status_filter;
    $data['lingkup_filter'] = $lingkup_filter;
    $data['jenis_penugasan_filter'] = $jenis_penugasan_filter;

    // **PERBAIKAN UTAMA: Reset query builder untuk menghindari konflik**
    $this->db->reset_query();
    
    // Mulai dari query yang bersih
    $this->db->from('surat');
    
    // Filter tahun dan bulan
    $this->db->where('YEAR(created_at)', $tahun);
    if ($bulan !== 'all') {
        $this->db->where('MONTH(created_at)', $bulan);
    }

    // **PERBAIKAN: Filter status dengan kondisi yang benar**
    if (!empty($status_filter) && $status_filter !== 'all') {
        switch ($status_filter) {
            case 'pending':
                $this->db->where('status', 'pengajuan');
                break;
            case 'approved':
                $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan']);
                break;
            case 'rejected':
                $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan']);
                break;
            case 'dekan_approved':
                $this->db->where('status', 'disetujui dekan');
                break;
            case 'dekan_rejected':
                $this->db->where('status', 'ditolak dekan');
                break;
        }
    }

    // **PERBAIKAN: Filter lingkup penugasan - PERHATIAN KHUSUS**
    if (!empty($lingkup_filter) && $lingkup_filter !== 'all') {
        // Jika ingin exact match
        $this->db->where('lingkup_penugasan', $lingkup_filter);
        
        // ATAU jika ingin case insensitive
        // $this->db->where('LOWER(lingkup_penugasan)', strtolower($lingkup_filter));
    }

    // **PERBAIKAN KRITIS: Filter jenis penugasan - CEK DATA DI DATABASE**
    if (!empty($jenis_penugasan_filter) && $jenis_penugasan_filter !== 'all') {
        // Debug: Tampilkan filter yang diterima
        // echo "DEBUG: Jenis Penugasan Filter = " . $jenis_penugasan_filter . "<br>";
        
        // Cek field apa yang ada di database
        $fields = $this->db->list_fields('surat');
        
        if (in_array('jenis_penugasan', $fields)) {
            $this->db->where('jenis_penugasan', $jenis_penugasan_filter);
        } 
        else if (in_array('jenis_tugas', $fields)) {
            $this->db->where('jenis_tugas', $jenis_penugasan_filter);
        }
        else if (in_array('kategori', $fields)) {
            $this->db->where('kategori', $jenis_penugasan_filter);
        }
        else if (in_array('jenis_pengajuan', $fields)) {
            // Mungkin maksudnya jenis_pengajuan, bukan jenis_penugasan
            $this->db->where('jenis_pengajuan', $jenis_penugasan_filter);
        }
    }

    // Filter search
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('nama_kegiatan', $search);
        $this->db->or_like('penyelenggara', $search);
        $this->db->or_like('jenis_pengajuan', $search);

        $this->db->group_end();
    }

    // Clone query untuk count
    $query_count = clone $this->db;
    $data['total_surat'] = $query_count->count_all_results();
    
    // Ambil data dengan order by
    $this->db->order_by("created_at", "DESC");
    $data['surat_list'] = $this->db->get()->result();

    // **DEBUG: Tampilkan query SQL yang dihasilkan**
    // echo "DEBUG Query: " . $this->db->last_query() . "<br>";
    // echo "DEBUG Total Data: " . $data['total_surat'] . "<br>";
    // echo "DEBUG Jenis Penugasan Filter: " . ($jenis_penugasan_filter ?: 'tidak ada') . "<br>";

    // Statistik untuk card (tanpa filter jenis/lingkup agar statistik tetap lengkap)
    $this->db->reset_query();
    $this->db->where('YEAR(created_at)', $tahun);
    if ($bulan !== 'all') {
        $this->db->where('MONTH(created_at)', $bulan);
    }
    $data['total_all'] = $this->db->count_all_results('surat');

    // Pending count
    $this->db->reset_query();
    $this->db->where('YEAR(created_at)', $tahun);
    if ($bulan !== 'all') {
        $this->db->where('MONTH(created_at)', $bulan);
    }
    $data['pending_count'] = $this->db->where('status', 'pengajuan')
                                     ->count_all_results('surat');

    // Approved count
    $this->db->reset_query();
    $this->db->where('YEAR(created_at)', $tahun);
    if ($bulan !== 'all') {
        $this->db->where('MONTH(created_at)', $bulan);
    }
    $data['approved_count'] = $this->db->where_in('status', ['disetujui KK', 'disetujui sekretariat', 'disetujui dekan'])
                                      ->count_all_results('surat');

    // Rejected count
    $this->db->reset_query();
    $this->db->where('YEAR(created_at)', $tahun);
    if ($bulan !== 'all') {
        $this->db->where('MONTH(created_at)', $bulan);
    }
    $data['rejected_count'] = $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan'])
                                      ->count_all_results('surat');

    $this->load->view('kaprodi/halaman_total', $data);
}
    /* ================================
       GET DETAIL PENGAJUAN (AJAX) - DENGAN PROGRESS TIMELINE
    ================================= */
/* ================================
   PROCESS MULTI APPROVE - DENGAN SUCCESS MODAL
================================= */
public function process_multi_approve()
{
    if ($this->input->server('REQUEST_METHOD') !== 'POST') {
        $this->session->set_flashdata('error', 'Invalid request method.');
        redirect('kaprodi/pending');
        return;
    }

    $selected_ids = explode(',', $this->input->post('selected_ids'));
    
    if (empty($selected_ids) || !is_array($selected_ids)) {
        $this->session->set_flashdata('error', 'Tidak ada pengajuan yang dipilih.');
        redirect('kaprodi/pending');
        return;
    }
    
    $success_count = 0;
    $error_count = 0;
    $error_messages = [];
    $approved_items = [];
    
    foreach ($selected_ids as $id) {
        $id = trim($id);
        
        if (empty($id)) {
            continue;
        }
        
        $surat = $this->db->get_where('surat', ['id' => $id])->row();
        
        if (!$surat) {
            $error_count++;
            $error_messages[] = "Data tidak ditemukan (ID: $id)";
            continue;
        }
        
        // Validasi status - hanya bisa approve jika status = 'pengajuan'
        if ($surat->status !== 'pengajuan') {
            $error_count++;
            $error_messages[] = "Pengajuan '{$surat->nama_kegiatan}' sudah diproses";
            continue;
        }
        
        $approval = json_decode($surat->approval_status, true) ?? [];
        
        if (!isset($approval['pengirim'])) {
            $approval['pengirim'] = $surat->created_at;
        }
        
        $approval['kk'] = date("Y-m-d H:i:s");
        
        $update_data = [
            'status' => 'disetujui KK',
            'approval_status' => json_encode($approval),
            'updated_at' => date('Y-m-d H:i:s'),
            'disposisi_status' => 'none'
        ];
        
        $this->db->where('id', $id);
        if ($this->db->update('surat', $update_data)) {
            $success_count++;
            
            // Ambil data dosen untuk ditampilkan di success modal
            $dosen_data = $this->get_dosen_data_from_nip_fixed($surat->nip);
            
            $approved_items[] = [
                'nama' => $surat->nama_kegiatan,
                'details' => '📅 ' . date('d M Y', strtotime($surat->tanggal_kegiatan)) . ' | 📍 ' . $surat->penyelenggara,
                'dosen_data' => $dosen_data
            ];
        } else {
            $error_count++;
            $error_messages[] = "Gagal update database (ID: $id)";
        }
    }
    
    if ($success_count > 0) {
        $message = "✅ Berhasil menyetujui $success_count pengajuan.";
        if ($error_count > 0) {
            $message .= " ⚠️ $error_count pengajuan gagal: " . implode(', ', $error_messages);
        }
        
        $this->session->set_flashdata('approved_items', $approved_items);
        $this->session->set_flashdata('is_multi_approve', true);
        $this->session->set_flashdata('success', $message);
    } else {
        $this->session->set_flashdata('error', "❌ Gagal menyetujui semua pengajuan: " . implode(', ', $error_messages));
    }
    
    redirect('kaprodi');
}

/* ================================
   PROCESS MULTI REJECT
================================= */
public function process_multi_reject()
{
    if ($this->input->server('REQUEST_METHOD') !== 'POST') {
        $this->session->set_flashdata('error', 'Invalid request method.');
        redirect('kaprodi/pending');
        return;
    }

    $selected_ids = $this->input->post('selected_ids');
    $rejection_notes_array = $this->input->post('rejection_notes');
    
    if (empty($selected_ids) || !is_array($selected_ids)) {
        $this->session->set_flashdata('error', 'Tidak ada pengajuan yang dipilih.');
        redirect('kaprodi/pending');
        return;
    }
    
    if (empty($rejection_notes_array) || !is_array($rejection_notes_array)) {
        $this->session->set_flashdata('error', 'Alasan penolakan harus diisi.');
        redirect('kaprodi/pending');
        return;
    }
    
    if (count($selected_ids) !== count($rejection_notes_array)) {
        $this->session->set_flashdata('error', 'Jumlah pengajuan dan alasan penolakan tidak sesuai.');
        redirect('kaprodi/pending');
        return;
    }
    
    $success_count = 0;
    $error_count = 0;
    $error_messages = [];
    $rejected_items = [];
    
    foreach ($selected_ids as $index => $id) {
        $id = trim($id);
        $rejection_notes = isset($rejection_notes_array[$index]) ? trim($rejection_notes_array[$index]) : '';
        
        if (empty($id)) {
            continue;
        }
        
        if (empty($rejection_notes)) {
            $error_count++;
            $error_messages[] = "Alasan penolakan kosong untuk ID: $id";
            continue;
        }
        
        $surat = $this->db->get_where('surat', ['id' => $id])->row();
        
        if (!$surat) {
            $error_count++;
            $error_messages[] = "Data tidak ditemukan (ID: $id)";
            continue;
        }
        
        // Validasi status - hanya bisa reject jika status = 'pengajuan'
        if ($surat->status !== 'pengajuan') {
            $error_count++;
            $error_messages[] = "Pengajuan '{$surat->nama_kegiatan}' sudah diproses";
            continue;
        }
        
        $approval = json_decode($surat->approval_status, true) ?? [];
        
        if (!isset($approval['pengirim'])) {
            $approval['pengirim'] = $surat->created_at;
        }
        
        $approval['kk'] = date("Y-m-d H:i:s");
        
        $update_data = [
            'status' => 'ditolak KK',
            'approval_status' => json_encode($approval),
            'catatan_penolakan' => $rejection_notes,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        if ($this->db->update('surat', $update_data)) {
            $success_count++;
            
            // Ambil data dosen untuk ditampilkan di success modal
            $dosen_data = $this->get_dosen_data_from_nip_fixed($surat->nip);
            
            $rejected_items[] = [
                'nama' => $surat->nama_kegiatan,
                'details' => '📅 ' . date('d M Y', strtotime($surat->tanggal_kegiatan)) . ' | 📍 ' . $surat->penyelenggara,
                'dosen_data' => $dosen_data,
                'rejection_notes' => $rejection_notes
            ];
        } else {
            $error_count++;
            $error_messages[] = "Gagal update database (ID: $id)";
        }
    }
    
    if ($success_count > 0) {
        $message = "✅ Berhasil menolak $success_count pengajuan.";
        if ($error_count > 0) {
            $message .= " ⚠️ $error_count pengajuan gagal: " . implode(', ', $error_messages);
        }
        
        $this->session->set_flashdata('rejected_items', $rejected_items);
        $this->session->set_flashdata('is_multi_reject', true);
        $this->session->set_flashdata('success', $message);
    } else {
        $this->session->set_flashdata('error', "❌ Gagal menolak semua pengajuan: " . implode(', ', $error_messages));
    }
    
    redirect('kaprodi');
}
/**
 * Fungsi untuk ambil data dosen dengan FOTO
 */
private function get_dosen_data_from_nip_with_foto($nip_data, $peran_data = null)
{
    $dosen_data = array();
    
    if (empty($nip_data) || $nip_data === '-' || $nip_data === '[]' || $nip_data === 'null') {
        return [array(
            'nama' => 'Data dosen tidak tersedia',
            'nip' => '-',
            'jabatan' => '-',
            'divisi' => '-',
            'foto' => '' // ✅ TAMBAHKAN FOTO
        )];
    }
    
    // Parse NIP
    $nip_array = array();
    
    if (is_string($nip_data)) {
        $trimmed_data = trim($nip_data);
        
        if (preg_match('/^\[.*\]$/', $trimmed_data)) {
            $decoded = json_decode($trimmed_data, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $nip_array = $decoded;
            } else {
                preg_match_all('/\d+/', $trimmed_data, $matches);
                $nip_array = $matches[0] ?? [$trimmed_data];
            }
        } else {
            $nip_array = [$trimmed_data];
        }
    } elseif (is_array($nip_data)) {
        $nip_array = $nip_data;
    } else {
        $nip_array = [$nip_data];
    }
    
    $nip_array = array_filter(array_map(function($nip) {
        if (is_array($nip)) {
            return !empty($nip) ? trim(strval($nip[0])) : null;
        }
        return trim(strval($nip));
    }, $nip_array), function($nip) {
        return !empty($nip) && $nip !== '-' && $nip !== 'null' && $nip !== '[]';
    });
    
    if (empty($nip_array)) {
        return [array(
            'nama' => 'Data dosen tidak tersedia',
            'nip' => '-',
            'jabatan' => '-',
            'divisi' => '-',
            'foto' => ''
        )];
    }
    
    // ✅ PENTING: Query ambil data dosen TERMASUK FOTO
    $this->db->select('nip, nama_dosen, jabatan, divisi, foto'); // ✅ TAMBAHKAN FOTO
    $this->db->from('list_dosen');
    
    if (count($nip_array) === 1) {
        $this->db->where('nip', $nip_array[0]);
    } else {
        $this->db->where_in('nip', $nip_array);
    }
    
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        $results = $query->result_array();
        
        $dosen_by_nip = [];
        foreach ($results as $row) {
            // ✅ PROSES FOTO - SAMA SEPERTI DI SURAT.PHP
            $foto_url = '';
            if (!empty($row['foto'])) {
                // Cek apakah foto adalah URL lengkap
                if (filter_var($row['foto'], FILTER_VALIDATE_URL)) {
                    $foto_url = $row['foto'];
                } else {
                    // Jika hanya nama file, buat URL lengkap
                    $foto_path = FCPATH . 'uploads/foto/' . $row['foto'];
                    
                    // Cek apakah file exist
                    if (file_exists($foto_path)) {
                        $foto_url = base_url('uploads/foto/' . $row['foto']);
                    }
                }
            }
            
            $dosen_by_nip[trim($row['nip'])] = array(
                'nama' => $row['nama_dosen'],
                'nip' => $row['nip'],
                'jabatan' => $row['jabatan'],
                'divisi' => $row['divisi'],
                'foto' => $foto_url // ✅ TAMBAHKAN FOTO
            );
        }
        
        foreach ($nip_array as $nip) {
            $clean_nip = trim(strval($nip));
            if (isset($dosen_by_nip[$clean_nip])) {
                $dosen_data[] = $dosen_by_nip[$clean_nip];
            } else {
                $dosen_data[] = array(
                    'nama' => 'Data tidak ditemukan',
                    'nip' => $clean_nip,
                    'jabatan' => '-',
                    'divisi' => '-',
                    'foto' => ''
                );
            }
        }
    } else {
        foreach ($nip_array as $nip) {
            $clean_nip = trim(strval($nip));
            $dosen_data[] = array(
                'nama' => 'Data dari NIP: ' . $clean_nip,
                'nip' => $clean_nip,
                'jabatan' => '-',
                'divisi' => '-',
                'foto' => ''
            );
        }
    }
    
    return $dosen_data;
}
    public function getDetailPengajuan($id)
    {
        $this->db->where('id', $id);
        $pengajuan = $this->db->get('surat')->row();
        
        if ($pengajuan) {
            $dosen_data = $this->get_dosen_data_from_nip_with_foto($pengajuan->nip, $pengajuan->peran);
            
            // Ambil progress timeline yang lengkap
            $progress_timeline = $this->getProgressTimeline($id);
            
            // Ambil semua field yang berkaitan dengan periode
            $jenis_date = $pengajuan->jenis_date ?? null;
            $periode_kegiatan = $pengajuan->periode_kegiatan ?? null;
            $periode_value = $pengajuan->periode_value ?? null;
            $tanggal_kegiatan = $pengajuan->tanggal_kegiatan ?? null;
            $akhir_kegiatan = $pengajuan->akhir_kegiatan ?? null;
            
            // Tentukan nilai periode yang akan ditampilkan
            $periode_display = '-';
            
            if ($jenis_date === 'Custom') {
                // FORMAT CUSTOM: "30 Nov 2025 - 01 Des 2025"
                if ($tanggal_kegiatan && $akhir_kegiatan) {
                    // Format tanggal Indonesia
                    $bulan_indonesia = [
                        'Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr',
                        'May' => 'Mei', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Ags',
                        'Sep' => 'Sep', 'Oct' => 'Okt', 'Nov' => 'Nov', 'Dec' => 'Des'
                    ];
                    
                    $format_tanggal = function($date) use ($bulan_indonesia) {
                        $day = date('d', strtotime($date));
                        $month_en = date('M', strtotime($date));
                        $month_id = $bulan_indonesia[$month_en] ?? $month_en;
                        $year = date('Y', strtotime($date));
                        return $day . ' ' . $month_id . ' ' . $year;
                    };
                    
                    $start_formatted = $format_tanggal($tanggal_kegiatan);
                    $end_formatted = $format_tanggal($akhir_kegiatan);
                    $periode_display = $start_formatted . ' - ' . $end_formatted;
                } elseif ($tanggal_kegiatan) {
                    // Jika hanya ada tanggal mulai
                    $periode_display = date('d M Y', strtotime($tanggal_kegiatan));
                }
            } elseif ($jenis_date === 'Periode') {
                // Untuk jenis Periode, gunakan periode_kegiatan atau periode_value
                $periode_display = $periode_kegiatan ?: $periode_value ?: '-';
            }
            
            $response_data = array(
                'id' => $pengajuan->id,
                'nama_kegiatan' => $pengajuan->nama_kegiatan,
                'status' => $pengajuan->status,
                'jenis_pengajuan' => $pengajuan->jenis_pengajuan,
                'lingkup_penugasan' => $pengajuan->lingkup_penugasan,
                'jenis_penugasan' => $pengajuan->jenis_penugasan ?? ($pengajuan->jenis_tugas ?? '-'), // Field baru
                'penyelenggara' => $pengajuan->penyelenggara,
                'tanggal_kegiatan' => $tanggal_kegiatan,
                'akhir_kegiatan' => $akhir_kegiatan,
                'periode_kegiatan' => $periode_display,
                'jenis_date' => $jenis_date,
                'periode_value' => $periode_value,
                'tempat_kegiatan' => $pengajuan->tempat_kegiatan,
                'created_at' => $pengajuan->created_at,
                'eviden' => $pengajuan->eviden,
                'nomor_surat' => $pengajuan->nomor_surat,
                'catatan_penolakan' => $pengajuan->catatan_penolakan,
                'dosen_data' => $dosen_data,
                'progress_timeline' => $progress_timeline,
                'approval_status' => json_decode($pengajuan->approval_status, true)
            );
            
            echo json_encode([
                'success' => true,
                'data' => $response_data
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    /* ================================
       FUNGSI UNTUK MENDAPATKAN PROGRESS TIMELINE
    ================================= */
    private function getProgressTimeline($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get('surat')->row();
        
        if (!$surat) {
            return null;
        }
        
        $approval = json_decode($surat->approval_status, true) ?? [];
        
        // Timeline untuk Kaprodi
        $timeline = [
            'pengirim' => [
                'status' => 'completed',
                'timestamp' => $surat->created_at,
                'label' => 'Mengirim',
                'display_time' => $this->formatDisplayTime($surat->created_at)
            ],
            'kaprodi' => [
                'status' => 'pending',
                'timestamp' => null,
                'label' => 'Disetujui Kaprodi',
                'display_time' => '-'
            ]
        ];
        
        // Update dari approval status
        if (isset($approval['kaprodi'])) {
            $kaprodi_approval = $approval['kaprodi'];
            
            if (is_array($kaprodi_approval)) {
                if (isset($kaprodi_approval['status'])) {
                    if ($kaprodi_approval['status'] == 'approved') {
                        $timeline['kaprodi']['status'] = 'completed';
                    } elseif ($kaprodi_approval['status'] == 'rejected') {
                        $timeline['kaprodi']['status'] = 'rejected';
                    }
                }
                $timeline['kaprodi']['timestamp'] = $kaprodi_approval['timestamp'] ?? null;
            } else {
                // Jika format lama
                $timeline['kaprodi']['status'] = 'completed';
                $timeline['kaprodi']['timestamp'] = $kaprodi_approval;
            }
            
            if ($timeline['kaprodi']['timestamp']) {
                $timeline['kaprodi']['display_time'] = $this->formatDisplayTime($timeline['kaprodi']['timestamp']);
            }
        }
        
        // Tambahkan tahap selanjutnya jika sudah disetujui kaprodi
        if ($timeline['kaprodi']['status'] == 'completed') {
            $timeline['sekretariat'] = [
                'status' => 'pending',
                'timestamp' => null,
                'label' => 'Disetujui Sekretariat',
                'display_time' => '-'
            ];
            
            if (isset($approval['sekretariat'])) {
                $sekretariat_approval = $approval['sekretariat'];
                
                if (is_array($sekretariat_approval)) {
                    if (isset($sekretariat_approval['status'])) {
                        if ($sekretariat_approval['status'] == 'approved') {
                            $timeline['sekretariat']['status'] = 'completed';
                        } elseif ($sekretariat_approval['status'] == 'rejected') {
                            $timeline['sekretariat']['status'] = 'rejected';
                        }
                    }
                    $timeline['sekretariat']['timestamp'] = $sekretariat_approval['timestamp'] ?? null;
                } else {
                    $timeline['sekretariat']['status'] = 'completed';
                    $timeline['sekretariat']['timestamp'] = $sekretariat_approval;
                }
                
                if ($timeline['sekretariat']['timestamp']) {
                    $timeline['sekretariat']['display_time'] = $this->formatDisplayTime($timeline['sekretariat']['timestamp']);
                }
            }
            
            // Tambahkan tahap dekan jika sudah disetujui sekretariat
            if ($timeline['sekretariat']['status'] == 'completed') {
                $timeline['dekan'] = [
                    'status' => 'pending',
                    'timestamp' => null,
                    'label' => 'Disetujui Dekan',
                    'display_time' => '-'
                ];
                
                if (isset($approval['dekan'])) {
                    $dekan_approval = $approval['dekan'];
                    
                    if (is_array($dekan_approval)) {
                        if (isset($dekan_approval['status'])) {
                            if ($dekan_approval['status'] == 'approved') {
                                $timeline['dekan']['status'] = 'completed';
                            } elseif ($dekan_approval['status'] == 'rejected') {
                                $timeline['dekan']['status'] = 'rejected';
                            }
                        }
                        $timeline['dekan']['timestamp'] = $dekan_approval['timestamp'] ?? null;
                    } else {
                        $timeline['dekan']['status'] = 'completed';
                        $timeline['dekan']['timestamp'] = $dekan_approval;
                    }
                    
                    if ($timeline['dekan']['timestamp']) {
                        $timeline['dekan']['display_time'] = $this->formatDisplayTime($timeline['dekan']['timestamp']);
                    }
                }
            }
        }
        
        return $timeline;
    }

    /* ================================
       FORMAT DISPLAY TIME
    ================================= */
    private function formatDisplayTime($timestamp)
    {
        if (!$timestamp) return '-';
        
        $time = strtotime($timestamp);
        $now = time();
        $diff = $now - $time;
        
        if ($diff < 60) {
            return 'Baru saja';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' menit yang lalu';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' jam yang lalu';
        } else {
            return date('d M Y H:i', $time);
        }
    }

    /* ================================
       FUNGSI AMBIL DATA DOSEN
    ================================= */
    private function get_dosen_data_from_nip_fixed($nip_data)
    {
        $dosen_data = array();
        
        if (empty($nip_data) || $nip_data === '-' || $nip_data === '[]' || $nip_data === 'null') {
            return [array(
                'nama' => 'Data dosen tidak tersedia',
                'nip' => '-',
                'jabatan' => '-',
                'divisi' => '-'
            )];
        }
        
        // Handle berbagai format NIP
        $nip_array = array();
        
        if (is_string($nip_data)) {
            $trimmed_data = trim($nip_data);
            
            if (preg_match('/^\[.*\]$/', $trimmed_data)) {
                $decoded = json_decode($trimmed_data, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $nip_array = $decoded;
                } else {
                    preg_match_all('/\d+/', $trimmed_data, $matches);
                    $nip_array = $matches[0] ?? [$trimmed_data];
                }
            } else {
                $nip_array = [$trimmed_data];
            }
        } elseif (is_array($nip_data)) {
            $nip_array = $nip_data;
        } else {
            $nip_array = [$nip_data];
        }
        
        $nip_array = array_filter(array_map(function($nip) {
            if (is_array($nip)) {
                return !empty($nip) ? trim(strval($nip[0])) : null;
            }
            return trim(strval($nip));
        }, $nip_array), function($nip) {
            return !empty($nip) && $nip !== '-' && $nip !== 'null' && $nip !== '[]';
        });
        
        if (empty($nip_array)) {
            return [array(
                'nama' => 'Data dosen tidak tersedia',
                'nip' => '-',
                'jabatan' => '-',
                'divisi' => '-'
            )];
        }
        
        // Ambil data dosen dari tabel list_dosen
        $this->db->select('nip, nama_dosen, jabatan, divisi');
        $this->db->from('list_dosen');
        
        if (count($nip_array) === 1) {
            $this->db->where('nip', $nip_array[0]);
        } else {
            $this->db->where_in('nip', $nip_array);
        }
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
            
            $dosen_by_nip = [];
            foreach ($results as $row) {
                $dosen_by_nip[trim($row['nip'])] = array(
                    'nama' => $row['nama_dosen'],
                    'nip' => $row['nip'],
                    'jabatan' => $row['jabatan'],
                    'divisi' => $row['divisi']
                );
            }
            
            foreach ($nip_array as $nip) {
                $clean_nip = trim(strval($nip));
                if (isset($dosen_by_nip[$clean_nip])) {
                    $dosen_data[] = $dosen_by_nip[$clean_nip];
                } else {
                    $dosen_data[] = array(
                        'nama' => 'Data tidak ditemukan',
                        'nip' => $clean_nip,
                        'jabatan' => '-',
                        'divisi' => '-'
                    );
                }
            }
        } else {
            foreach ($nip_array as $nip) {
                $clean_nip = trim(strval($nip));
                $dosen_data[] = array(
                    'nama' => 'Data dari NIP: ' . $clean_nip,
                    'nip' => $clean_nip,
                    'jabatan' => '-',
                    'divisi' => '-'
                );
            }
        }
        
        return $dosen_data;
    }

/* ================================
   APPROVE SINGLE - DENGAN SUCCESS MODAL & DATA DOSEN
================================= */
public function approve($id)
{
    $surat = $this->db->get_where('surat', ['id' => $id])->row();
    
    if (!$surat) {
        $this->session->set_flashdata('error', 'Surat tidak ditemukan.');
        redirect('kaprodi/pending');
    }

    // Validasi status - hanya bisa approve jika status = 'pengajuan'
    if ($surat->status !== 'pengajuan') {
        $this->session->set_flashdata('error', 'Hanya pengajuan baru yang dapat disetujui.');
        redirect('kaprodi');
    }

    // Update approval status
    $approval = json_decode($surat->approval_status, true) ?? [];
    
    if (!isset($approval['pengirim'])) {
        $approval['pengirim'] = $surat->created_at;
    }
    
    $approval['kk'] = date("Y-m-d H:i:s");
    
    $update_data = [
        'status' => 'disetujui KK',
        'approval_status' => json_encode($approval),
        'updated_at' => date('Y-m-d H:i:s'),
        'disposisi_status' => 'none'
    ];

    $result = $this->db->where('id', $id)->update('surat', $update_data);

    if ($result) {
        // AMBIL DATA DOSEN DARI DATABASE
        $dosen_data = $this->get_dosen_data_from_nip_fixed($surat->nip);
        
        // Siapkan data untuk success modal dengan data dosen
        $approved_items = [[
            'nama' => $surat->nama_kegiatan,
            'details' => '📅 ' . date('d M Y', strtotime($surat->tanggal_kegiatan)) . ' | 📍 ' . $surat->penyelenggara,
            'dosen_data' => $dosen_data // TAMBAHKAN DATA DOSEN
        ]];
        
        // Set flashdata untuk success modal
        $this->session->set_flashdata('approved_items', $approved_items);
        $this->session->set_flashdata('is_single_approve', true);
        $this->session->set_flashdata('success', 'Surat berhasil disetujui Kaprodi.');
    } else {
        $this->session->set_flashdata('error', 'Gagal menyetujui surat.');
    }
    
    redirect('kaprodi');
}
/* ================================
   REJECT SINGLE - DENGAN SUCCESS MODAL
================================= */
public function reject($id)
{
    $surat = $this->db->get_where('surat', ['id' => $id])->row();
    
    if (!$surat) {
        $this->session->set_flashdata('error', 'Surat tidak ditemukan.');
        redirect('kaprodi');
    }

    // Validasi status - hanya bisa reject jika status = 'pengajuan'
    if ($surat->status !== 'pengajuan') {
        $this->session->set_flashdata('error', 'Hanya pengajuan baru yang dapat ditolak.');
        redirect('kaprodi');
    }

    // Get rejection notes
    $rejection_notes = $this->input->post('rejection_notes');
    if (empty($rejection_notes)) {
        $this->session->set_flashdata('error', 'Alasan penolakan harus diisi');
        redirect('kaprodi');
    }

    // Update approval status
    $approval = json_decode($surat->approval_status, true) ?? [];
    
    if (!isset($approval['pengirim'])) {
        $approval['pengirim'] = $surat->created_at;
    }
    
    $approval['kk'] = date("Y-m-d H:i:s");

    $update_data = [
        'status' => 'ditolak KK',
        'approval_status' => json_encode($approval),
        'catatan_penolakan' => $rejection_notes,
        'updated_at' => date('Y-m-d H:i:s')
    ];

    $result = $this->db->where('id', $id)->update('surat', $update_data);

    if ($result) {
        // AMBIL DATA DOSEN DARI DATABASE
        $dosen_data = $this->get_dosen_data_from_nip_fixed($surat->nip);
        
        // Siapkan data untuk success modal dengan data dosen
        $rejected_items = [[
            'nama' => $surat->nama_kegiatan,
            'details' => '📅 ' . date('d M Y', strtotime($surat->tanggal_kegiatan)) . ' | 📍 ' . $surat->penyelenggara,
            'dosen_data' => $dosen_data,
            'rejection_notes' => $rejection_notes
        ]];
        
        // Set flashdata untuk success modal
        $this->session->set_flashdata('rejected_items', $rejected_items);
        $this->session->set_flashdata('is_single_reject', true);
        $this->session->set_flashdata('success', 'Surat berhasil ditolak oleh Kaprodi.');
    } else {
        $this->session->set_flashdata('error', 'Gagal menolak surat.');
    }
    
    redirect('kaprodi');
}


    /* ================================
       GET DASHBOARD COUNTS (AJAX) - DENGAN FILTER BULAN
    ================================= */
    public function get_dashboard_counts()
    {
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulan = $this->input->get('bulan') ?? 'all';

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $total = $this->db->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $this->db->where('status', 'pengajuan');
        $pending = $this->db->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $this->db->where_in('status', ['disetujui KK', 'disetujui dekan', 'disetujui sekretariat']);
        $approved = $this->db->count_all_results('surat');

        $this->db->where('YEAR(created_at)', $tahun);
        if ($bulan !== 'all') {
            $this->db->where('MONTH(created_at)', $bulan);
        }
        $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat', 'ditolak dekan']);
        $rejected = $this->db->count_all_results('surat');

        $counts = [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected
        ];

        header('Content-Type: application/json');
        echo json_encode($counts);
    }

    /* ================================
       TAMPILKAN SURAT PENGAJUAN DALAM MODAL
    ================================= */
    public function view_surat_pengajuan($id)
    {
        $this->db->where('id', $id);
        $data['surat'] = $this->db->get('surat')->row();
        
        if (!$data['surat']) {
            show_404();
            return;
        }
        
        $data['dosen_data'] = $this->get_dosen_data_from_nip_fixed($data['surat']->nip);
        
        $this->load->view('surat_print2', $data);
    }
    
    /* ================================
       GET EVIDEN - UNTUK TOMBOL LIHAT EVIDEN
    ================================= */
    public function getEviden($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get('surat')->row();
        
        if ($surat && !empty($surat->eviden)) {
            $file_path = FCPATH . $surat->eviden;
            
            if (file_exists($file_path)) {
                echo json_encode([
                    'success' => true,
                    'eviden' => $surat->eviden,
                    'nama_kegiatan' => $surat->nama_kegiatan
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'File eviden tidak ditemukan di server'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak ada eviden untuk pengajuan ini'
            ]);
        }
    }

    /* ================================
       HELPER FUNCTION UNTUK REDIRECT
    ================================= */
    private function redirectToPreviousPage()
    {
        $current_page = $this->input->get('from') ?? 'kaprodi';
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulan = $this->input->get('bulan') ?? 'all';
        $search = $this->input->get('search');
        $status = $this->input->get('status');
        $lingkup = $this->input->get('lingkup_penugasan');
        $jenis_penugasan = $this->input->get('jenis_penugasan');
        
        $query_params = 'tahun=' . $tahun . '&bulan=' . $bulan;
        if (!empty($search)) {
            $query_params .= '&search=' . urlencode($search);
        }
        if (!empty($status)) {
            $query_params .= '&status=' . $status;
        }
        if (!empty($lingkup)) {
            $query_params .= '&lingkup_penugasan=' . $lingkup;
        }
        if (!empty($jenis_penugasan)) {
            $query_params .= '&jenis_penugasan=' . $jenis_penugasan;
        }
        
        switch($current_page) {
            case 'total':
                redirect('kaprodi/semua?' . $query_params);
                break;
            case 'disetujui':
                redirect('kaprodi/disetujui?' . $query_params);
                break;
            case 'ditolak':
                redirect('kaprodi/ditolak?' . $query_params);
                break;
            case 'pending':
                redirect('kaprodi/pending?' . $query_params);
                break;
            default:
                redirect('kaprodi?' . $query_params);
        }
    }

    /* ================================
       CEK FIELD DATABASE UNTUK FILTER JENIS PENUGASAN - TAMBAHKAN DI VIEW
    ================================= */
    public function check_fields_simple()
    {
        echo "<h3>Checking Database Structure</h3>";
        
        // Cek field yang ada
        $fields = $this->db->list_fields('surat');
        echo "<strong>All fields in 'surat' table:</strong><br>";
        foreach ($fields as $field) {
            echo "- " . $field . "<br>";
        }
        
        // Cek nilai yang ada untuk filter
        echo "<br><strong>Checking filter-related fields:</strong><br>";
        
        $filter_fields = ['jenis_penugasan', 'jenis_tugas', 'lingkup_penugasan', 'kategori'];
        
        foreach ($filter_fields as $field) {
            if ($this->db->field_exists($field, 'surat')) {
                echo "<br><strong>Field '$field' exists. Values:</strong><br>";
                
                $this->db->distinct();
                $this->db->select($field);
                $this->db->from('surat');
                $this->db->where($field . ' IS NOT NULL');
                $this->db->where($field . ' !=', '');
                $this->db->order_by($field);
                $result = $this->db->get();
                
                if ($result->num_rows() > 0) {
                    foreach ($result->result() as $row) {
                        $value = $row->$field;
                        echo "- '" . htmlspecialchars($value) . "'<br>";
                    }
                } else {
                    echo "- No values found (all NULL or empty)<br>";
                }
            } else {
                echo "<br>Field '$field' does NOT exist in database<br>";
            }
        }
        
        // Cek sample data
        echo "<br><strong>Sample data (first 3 rows):</strong><br>";
        $this->db->limit(3);
        $sample = $this->db->get('surat')->result();
        
        echo "<pre>";
        foreach ($sample as $row) {
            print_r($row);
        }
        echo "</pre>";
    }
public function check_dosen_field()
{
    $fields = $this->db->list_fields('surat');
    
    echo "Field yang ada di tabel surat:<br>";
    echo "<pre>";
    print_r($fields);
    echo "</pre>";
    
    // Cek jika field nama_dosen ada
    if (in_array('nama_dosen', $fields)) {
        echo "<p style='color: green;'><strong>Field 'nama_dosen' ADA di database</strong></p>";
        
        // Cek sample data
        $this->db->select('id, nama_kegiatan, nama_dosen, nip, dosen_list');
        $this->db->limit(5);
        $sample = $this->db->get('surat')->result();
        
        echo "<p>Sample data:</p>";
        echo "<pre>";
        print_r($sample);
        echo "</pre>";
    } else {
        echo "<p style='color: red;'><strong>Field 'nama_dosen' TIDAK ADA di database!</strong></p>";
    }
}
    /* ================================
       DEBUG: CEK STRUKTUR TABEL SURAT
    ================================= */
    public function debug_table_structure()
    {
        $query = $this->db->query("DESCRIBE surat");
        $structure = $query->result();
        
        echo "<h3>Struktur Tabel Surat:</h3>";
        echo "<pre>";
        foreach ($structure as $field) {
            echo "Field: " . $field->Field . " | Type: " . $field->Type . " | Null: " . $field->Null . " | Key: " . $field->Key . "<br>";
        }
        echo "</pre>";
        
        $sample = $this->db->get('surat')->row();
        echo "<h3>Data Contoh:</h3>";
        echo "<pre>";
        print_r($sample);
        echo "</pre>";
    }
    public function return_pengajuan($id)
{
    $surat = $this->db->get_where('surat', ['id' => $id])->row();
    
    if (!$surat) {
        $this->session->set_flashdata('error', 'Surat tidak ditemukan.');
        $this->redirectToPreviousPage();
        return;
    }

    // Validasi: Hanya bisa return jika sudah disetujui/ditolak oleh Kaprodi
    $allowed_statuses = ['disetujui KK', 'ditolak KK'];
    
    if (!in_array($surat->status, $allowed_statuses)) {
        $this->session->set_flashdata('error', 'Hanya pengajuan yang sudah disetujui/ditolak Kaprodi yang dapat dikembalikan.');
        $this->redirectToPreviousPage();
        return;
    }
    
    // Cek apakah sudah disetujui oleh pihak selanjutnya (Sekretariat/Dekan)
    $approval = json_decode($surat->approval_status, true) ?? [];
    
    if (isset($approval['sekretariat']) || isset($approval['dekan'])) {
        $this->session->set_flashdata('error', 'Pengajuan tidak dapat dikembalikan karena sudah diproses oleh Sekretariat/Dekan.');
        $this->redirectToPreviousPage();
        return;
    }

    // Update: Kembalikan ke status pengajuan & hapus approval Kaprodi
    if (isset($approval['kk'])) {
        unset($approval['kk']);
    }
    
    $this->db->where('id', $id)->update('surat', [
        'status' => 'pengajuan',
        'approval_status' => json_encode($approval),
        'catatan_penolakan' => null, // Hapus catatan penolakan jika ada
    ]);

    // Set flashdata untuk success return modal
    $surat = $this->db->get_where('surat', ['id' => $id])->row();
    
    $returned_items = [
        [
            'nama' => $surat->nama_kegiatan,
            'details' => "{$surat->penyelenggara} - " . date('d M Y', strtotime($surat->tanggal_kegiatan)),
            'new_status' => $surat->status
        ]
    ];
    
    $this->session->set_flashdata('returned_items', $returned_items);
    $this->session->set_flashdata('is_single_return', true);
    $this->redirectToPreviousPage();
}

}
