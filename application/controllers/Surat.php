 <?php
        defined('BASEPATH') or exit('No direct script access allowed');

        require_once FCPATH . 'vendor/autoload.php';
        use Dompdf\Dompdf;
        use Dompdf\Options;
        use Endroid\QrCode\QrCode;
        use Endroid\QrCode\Writer\PngWriter;
        use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevel;

        class Surat extends CI_Controller
        {
            
            public function __construct()
            {
                parent::__construct();
                $this->load->model('Surat_model');
                $this->load->helper(['file', 'url']);
                $this->load->library('session');
                $this->load->database();
            }

            /* ===========================================
            FORMAT TANGGAL AMAN
            ============================================*/
            private function safe_date($val)
            {
                if (!$val || trim($val) === "" || $val === "-") return "-";
                $ts = strtotime($val);
                return $ts ? date('Y-m-d', $ts) : "";
            }

            /* ===========================================
            SAFE JSON DECODE
            ============================================*/
            private function safe_json_decode($json)
            {
                if (is_array($json)) return $json;
                if (!is_string($json)) return [];
                $decoded = json_decode($json, true);
                return (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
            }

private function get_dosen_by_nip($nip_data, $peran_data = null)
{
    // Handle berbagai tipe data input
    if (empty($nip_data)) {
        return [];
    }
    
    $nip_array = [];
    
    // Jika sudah array, langsung gunakan
    if (is_array($nip_data)) {
        $nip_array = $nip_data;
    } 
    // Jika string JSON, decode
    elseif (is_string($nip_data) && $nip_data !== '[]' && $nip_data !== '-') {
        $decoded = json_decode($nip_data, true);
        $nip_array = is_array($decoded) ? $decoded : [];
    }
    
    if (empty($nip_array)) {
        return [];
    }
    
    // Decode peran (array of JSON strings)
    $peran_array = [];
    if (!empty($peran_data)) {
        if (is_array($peran_data)) {
            $peran_array = $peran_data;
        } elseif (is_string($peran_data)) {
            $decoded_peran = json_decode($peran_data, true);
            $peran_array = is_array($decoded_peran) ? $decoded_peran : [];
        }
    }
    
    $dosen_data = [];
    
    foreach ($nip_array as $index => $nip) {
        if (!empty($nip) && $nip !== '-') {
            // ✅ SELECT FOTO DARI DATABASE
            $this->db->select('nip, nama_dosen, jabatan, divisi, foto');
            $this->db->where('nip', $nip);
            $dosen = $this->db->get('list_dosen')->row();
            
            // Parse jabatan dan peran dari peran_array
            $jabatan_from_peran = '';
            $peran_from_data = '';
            
            if (isset($peran_array[$index]) && !empty($peran_array[$index])) {
                $peran_item = json_decode($peran_array[$index], true);
                if ($peran_item && is_array($peran_item)) {
                    $jabatan_from_peran = $peran_item['jabatan'] ?? '';
                    $peran_from_data = $peran_item['peran'] ?? '';
                }
            }
            
            // Gunakan jabatan dari peran_data jika ada, jika tidak gunakan dari list_dosen
            $final_jabatan = !empty($jabatan_from_peran) ? $jabatan_from_peran : ($dosen ? $dosen->jabatan : '');
            
            // ✅ PROSES FOTO - DARI FOLDER uploads/foto/
            $foto_url = '';
            if ($dosen && !empty($dosen->foto)) {
                // Cek apakah foto adalah URL lengkap
                if (filter_var($dosen->foto, FILTER_VALIDATE_URL)) {
                    $foto_url = $dosen->foto;
                } 
                // Jika hanya nama file, buat URL lengkap
                else {
                    // Path file di server
                    $foto_path = FCPATH . 'uploads/foto/' . $dosen->foto;
                    
                    // Cek apakah file exist
                    if (file_exists($foto_path)) {
                        $foto_url = base_url('uploads/foto/' . $dosen->foto);
                    }
                }
            }
            
            $dosen_data[] = [
                'nip' => $dosen ? $dosen->nip : $nip,
                'nama_dosen' => $dosen ? $dosen->nama_dosen : '',
                'jabatan' => $final_jabatan,
                'jabatan_original' => $dosen ? $dosen->jabatan : '',
                'peran' => $peran_from_data,
                'divisi' => $dosen ? $dosen->divisi : '',
                'foto' => $foto_url, // ✅ URL FOTO LENGKAP
                'index' => $index
            ];
        }
    }
    
    return $dosen_data;
}

          public function autocomplete_nip()
{
    header('Content-Type: application/json');
    
    $query = $this->input->get('q');
    
    if (!$query || strlen($query) < 2) {
        echo json_encode([
            'success' => false,
            'message' => 'Kata kunci terlalu pendek',
            'results' => []
        ]);
        return;
    }
    
    try {
        // Mencari di database dengan multiple fields
        $this->db->select('nip, nama_dosen, jabatan, divisi');
        $this->db->from('list_dosen');
        
        // Search in multiple columns
        $this->db->group_start();
        $this->db->like('nip', $query);
        $this->db->or_like('nama_dosen', $query);
        $this->db->or_like('jabatan', $query);
        $this->db->or_like('divisi', $query);
        $this->db->group_end();
        
        $this->db->limit(10);
        $this->db->order_by('nama_dosen', 'ASC');
        
        $result = $this->db->get();
        
        if ($result->num_rows() > 0) {
            $dosen_list = $result->result_array();
            
            // Format results untuk autocomplete
            $results = array_map(function($dosen) {
                return [
                    'nip' => $dosen['nip'] ?? '',
                    'nama_dosen' => $dosen['nama_dosen'] ?? '',
                    'jabatan' => $dosen['jabatan'] ?? '',
                    'divisi' => $dosen['divisi'] ?? '',
                    'display_text' => $dosen['nama_dosen'] . ' (' . $dosen['nip'] . ') - ' . $dosen['jabatan']
                ];
            }, $dosen_list);
            
            echo json_encode([
                'success' => true,
                'results' => $results,
                'count' => count($results)
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'results' => [],
                'message' => 'Tidak ditemukan dosen yang cocok'
            ]);
        }
        
    } catch (Exception $e) {
        log_message('error', 'Autocomplete dosen error: ' . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => 'Terjadi kesalahan saat mencari dosen',
            'results' => []
        ]);
    }
}

            /* ===========================================
            LIST DATA - DEFAULT (UPDATED)
            ============================================*/
            public function index()
            {
                $data['surat_list'] = $this->Surat_model->get_all_surat();
                
                // TAMBAHAN: Enrich data dengan informasi dosen dari list_dosen
                foreach ($data['surat_list'] as &$surat) {
                    $surat->dosen_data = $this->get_dosen_by_nip($surat->nip, $surat->peran);
                }
                
                $this->load->view('surat', $data);
            }

            /* ===========================================
            HALAMAN STATS GRID - TOTAL (UPDATED)
            ============================================*/
            public function halaman_total()
            {
                $data['surat_list'] = $this->Surat_model->get_all_surat();
                
                // TAMBAHAN: Enrich data dengan informasi dosen
                foreach ($data['surat_list'] as &$surat) {
                    $surat->dosen_data = $this->get_dosen_by_nip($surat->nip);
                }
                
                $data['title'] = 'Semua Surat';
                $data['page_type'] = 'total';
                $this->load->view('halaman_total', $data);
            }

            /* ===========================================
            HALAMAN STATS GRID - PENDING (UPDATED)
            ============================================*/
            public function halaman_pending()
            {
                $data['surat_list'] = $this->Surat_model->get_by_status('pengajuan');
                
                // TAMBAHAN: Enrich data dengan informasi dosen
                foreach ($data['surat_list'] as &$surat) {
                    $surat->dosen_data = $this->get_dosen_by_nip($surat->nip);
                }
                
                $data['title'] = 'Surat Pending';
                $data['page_type'] = 'pending';
                $this->load->view('halaman_pending', $data);
            }

            /* ===========================================
            HALAMAN STATS GRID - DITOLAK (UPDATED)
            ============================================*/
            public function halaman_ditolak()
            {
                $data['surat_list'] = $this->Surat_model->get_ditolak();
                
                // TAMBAHAN: Enrich data dengan informasi dosen
                foreach ($data['surat_list'] as &$surat) {
                    $surat->dosen_data = $this->get_dosen_by_nip($surat->nip);
                }
                
                $data['title'] = 'Surat Ditolak';
                $data['page_type'] = 'ditolak';
                $this->load->view('halaman_ditolak', $data);
            }

            /* ===========================================
            HALAMAN STATS GRID - DISETUJUI (UPDATED)
            ============================================*/
            public function halaman_disetujui()
            {
                $data['surat_list'] = $this->Surat_model->get_disetujui();
                
                // TAMBAHAN: Enrich data dengan informasi dosen
                foreach ($data['surat_list'] as &$surat) {
                    $surat->dosen_data = $this->get_dosen_by_nip($surat->nip);
                }
                
                $data['title'] = 'Surat Disetujui';
                $data['page_type'] = 'disetujui';
                $this->load->view('halaman_disetujui', $data);
            }

            /* ===========================================
            GET STATUS - WITH APPROVAL STATUS JSON
            ============================================*/
            public function get_status($surat_id)
            {
                header('Content-Type: application/json');
                
                // Ambil data surat
                $this->db->select('id, status, created_at, catatan_penolakan, approval_status');
                $this->db->where('id', $surat_id);
                $query = $this->db->get('surat');

                if ($query->num_rows() == 0) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Data surat tidak ditemukan'
                    ]);
                    return;
                }

                $surat = $query->row();

                // Decode JSON approval_status
                $approval = json_decode($surat->approval_status, true);
                if (!is_array($approval)) $approval = [];

                // Ambil waktu persetujuan / penolakan
                $getTime = function($val) {
                    if (!$val) return null;

                    if (is_string($val)) return $val; // approved → datetime string
                    if (is_array($val) && isset($val['waktu'])) return $val['waktu']; // rejected → ambil waktu penolakan

                    return null;
                };

                $kk  = $getTime($approval['kk'] ?? null);
                $sek = $getTime($approval['sekretariat'] ?? null);
                $dek = $getTime($approval['dekan'] ?? null);

                // Normalisasi status
                $status = strtolower(trim($surat->status ?? 'pengajuan'));
                $catatan_penolakan = $surat->catatan_penolakan ?? null;
                $created_at = $surat->created_at;

                $steps = [];
                $progress_percentage = 0;

                // Step pertama: Mengirim
                $steps[] = [
                    'step_name' => 'Mengirim',
                    'status' => 'completed',
                    'date' => date('d M Y', strtotime($created_at)),
                    'label' => 'Terkirim'
                ];

                // Tentukan steps berdasarkan status
                switch ($status) {
                    case 'pengajuan':
                        $steps[] = ['step_name'=>'Dalam Proses','status'=>'in-progress','date'=>'-','label'=>'Dalam Proses'];
                        $steps[] = ['step_name'=>'Menunggu','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $steps[] = ['step_name'=>'Menunggu','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $progress_percentage = 35;
                        break;

                    case 'disetujui kk':
                        $steps[] = [
                            'step_name'=>'Disetujui Kaprodi',
                            'status'=>'completed',
                            'date'=> ($kk) ? date('d M Y', strtotime($kk)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = ['step_name'=>'Dalam Proses','status'=>'in-progress','date'=>'-','label'=>'Dalam Proses'];
                        $steps[] = ['step_name'=>'Menunggu','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $progress_percentage = 65;
                        break;

                    case 'disetujui sekretariat':
                        $steps[] = [
                            'step_name'=>'Disetujui Kaprodi',
                            'status'=>'completed',
                            'date'=> ($kk) ? date('d M Y', strtotime($kk)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = [
                            'step_name'=>'Disetujui Sekretariat',
                            'status'=>'completed',
                            'date'=> ($sek) ? date('d M Y', strtotime($sek)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = ['step_name'=>'Dalam Proses','status'=>'in-progress','date'=>'-','label'=>'Dalam Proses'];
                        $progress_percentage = 95;
                        break;

                    case 'disetujui dekan':
                    case 'selesai':
                    case 'completed':
                        $steps[] = [
                            'step_name'=>'Disetujui Kaprodi',
                            'status'=>'completed',
                            'date'=> ($kk) ? date('d M Y', strtotime($kk)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = [
                            'step_name'=>'Disetujui Sekretariat',
                            'status'=>'completed',
                            'date'=> ($sek) ? date('d M Y', strtotime($sek)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = [
                            'step_name'=>'Disetujui Dekan',
                            'status'=>'completed',
                            'date'=> ($dek) ? date('d M Y', strtotime($dek)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $progress_percentage = 80;
                        break;

                    case 'ditolak kk':
                        $steps[] = [
                            'step_name'=>'Ditolak Kaprodi',
                            'status'=>'rejected',
                            'date'=> ($kk) ? date('d M Y', strtotime($kk)) : '-',
                            'label'=>'Ditolak',
                            'catatan_penolakan'=>$catatan_penolakan
                        ];
                        $steps[] = ['step_name'=>'Menunggu','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $steps[] = ['step_name'=>'Menunggu','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $progress_percentage = 35;
                        break;

                    case 'ditolak sekretariat':
                        $steps[] = [
                            'step_name'=>'Disetujui Kaprodi',
                            'status'=>'completed',
                            'date'=> ($kk) ? date('d M Y', strtotime($kk)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = [
                            'step_name'=>'Ditolak Sekretariat',
                            'status'=>'rejected',
                            'date'=> ($sek) ? date('d M Y', strtotime($sek)) : '-',
                            'label'=>'Ditolak',
                            'catatan_penolakan'=>$catatan_penolakan
                        ];
                        $steps[] = ['step_name'=>'Menunggu','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $progress_percentage = 65;
                        break;

                    case 'ditolak dekan':
                        $steps[] = [
                            'step_name'=>'Disetujui Kaprodi',
                            'status'=>'completed',
                            'date'=> ($kk) ? date('d M Y', strtotime($kk)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = [
                            'step_name'=>'Disetujui Sekretariat',
                            'status'=>'completed',
                            'date'=> ($sek) ? date('d M Y', strtotime($sek)) : '-',
                            'label'=>'Disetujui'
                        ];
                        $steps[] = [
                            'step_name'=>'Ditolak Dekan',
                            'status'=>'rejected',
                            'date'=> ($dek) ? date('d M Y', strtotime($dek)) : '-',
                            'label'=>'Ditolak',
                            'catatan_penolakan'=>$catatan_penolakan
                        ];
                        $progress_percentage = 80;
                        break;

                    default:
                        $steps[] = ['step_name'=>'Persetujuan KK','status'=>'in-progress','date'=>'-','label'=>'Dalam Proses'];
                        $steps[] = ['step_name'=>'Persetujuan Sekretariat','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $steps[] = ['step_name'=>'Persetujuan Dekan','status'=>'pending','date'=>'-','label'=>'Menunggu'];
                        $progress_percentage = 25;
                        break;
                }

                // Deskripsi status dengan array
        $status_descriptions = [
            'pengajuan' => '⏳ Menunggu persetujuan Kepala Kelompok (KK).',
            'disetujui kk' => '⏳ Menunggu persetujuan Sekretariat.',
            'disetujui sekretariat' => '⏳ Menunggu persetujuan Dekan.',
            'disetujui dekan' => '✅ Semua persetujuan selesai.',
            'selesai' => '✅ Semua persetujuan selesai.',
            'completed' => '✅ Semua persetujuan selesai.',
            'ditolak kk' => '❌ Ditolak oleh Kepala Kelompok (KK).',
            'ditolak sekretariat' => '❌ Ditolak oleh Sekretariat.',
            'ditolak dekan' => '❌ Ditolak oleh Dekan.'
        ];

        $status_description = $status_descriptions[$status] ?? '⏳ Pengajuan sedang dalam proses.';
                // Response final
                echo json_encode([
                    'success' => true,
                    'data' => [
                        'steps' => $steps,
                        'current_status' => $status,
                        'status_raw' => $surat->status,
                        'progress_percentage' => $progress_percentage,
                        'catatan_penolakan' => $catatan_penolakan,
                        'status_description' => $status_description,
                        'durasi' => [
                            'durasi_1' => ($kk) ? $this->bedaWaktu($created_at, $kk) : '-',
                            'durasi_2' => ($kk && $sek) ? $this->bedaWaktu($kk, $sek) : '-',
                            'durasi_3' => ($sek && $dek) ? $this->bedaWaktu($sek, $dek) : '-',
                        ]
                    ]
                ]);
            }

            private function bedaWaktu($start, $end)
{
    if (!$start || !$end || $start == '-' || $end == '-') return '0 menit';

    try {
        $mulai = new DateTime($start);
        $selesai = new DateTime($end);
    } catch (Exception $e) {
        return '0 menit';
    }

    $diff = $mulai->diff($selesai);
    
    $days = $diff->d;
    $hours = $diff->h;
    $minutes = $diff->i;
    
    // LOGIKA BARU SESUAI PERMINTAAN:
    
    // 1. Jika >= 1 hari, tampilkan hari saja
    if ($days >= 1) {
        return $days . " hari";
    }
    
    // 2. Jika ada jam (tapi < 1 hari), tampilkan jam dan menit
    if ($hours > 0) {
        if ($minutes > 0) {
            return $hours . " jam " . $minutes . " menit";
        } else {
            return $hours . " jam";
        }
    }
    
    // 3. Jika < 1 jam, tampilkan menit saja
    if ($minutes > 0) {
        return $minutes . " menit";
    }
    
    // 4. Jika < 1 menit (detik)
    return "Kurang dari 1 menit";
}

            /* ===========================================
            HELPER: GET ICON BY STATUS
            ============================================*/
            private function get_icon_by_status($status)
            {
                switch ($status) {
                    case 'completed':
                    case 'approved':
                        return 'check';
                    case 'rejected':
                        return 'times';
                    case 'in-progress':
                        return 'spinner';
                    default:
                        return 'clock';
                }
            }

            /* ===========================================
            HELPER: CALCULATE PROGRESS PERCENTAGE
            ============================================*/
            private function calculate_progress($steps)
            {
                $completed = 0;
                $total = count($steps);
                
                foreach ($steps as $step) {
                    if ($step['status'] === 'completed' || $step['status'] === 'approved') {
                        $completed++;
                    }
                }
                
                return round(($completed / $total) * 100);
            }

public function submit()
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    log_message('debug', 'Submit function called - Manual Upload version');
    
    try {
        $post = $this->input->post() ?? [];
        $files = $_FILES ?? [];
        
        // Debug: Lihat data yang diterima
        log_message('debug', 'POST Data: ' . print_r($post, true));
        log_message('debug', 'FILES Data: ' . print_r($files, true));
        
        // Validasi data yang diperlukan
        if (empty($post)) {
            throw new Exception('Data POST kosong');
        }
        
        $nama_kegiatan = $post['nama_kegiatan'] ?? '';
        $tanggal_kegiatan = $this->safe_date($post['tanggal_awal_kegiatan'] ?? null);
        $user_id = $post['user_id'] ?? '';
        
        if (empty($user_id)) {
            throw new Exception('User ID tidak ditemukan');
        }
        
        // Clean array values
        foreach ($post as $k => $v) {
            if (is_array($v)) {
                $post[$k] = array_values(array_filter($v, function($x) {
                    return trim($x) !== "" && $x !== null;
                }));
            } else {
                $post[$k] = ($v === "" || $v === null) ? "-" : $v;
            }
        }
        
        /* ======================================================
           PROSES EVIDEN - MANUAL UPLOAD
           ====================================================== */
        $saved_filenames = [];
        
        // Pastikan folder ada
        $upload_dir = FCPATH . "uploads/eviden/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Konfigurasi upload
        $config['upload_path'] = $upload_dir;
        $config['allowed_types'] = 'pdf|jpg|jpeg|png|doc|docx|xls|xlsx';
        $config['max_size'] = 10240; // 10MB
        $config['encrypt_name'] = true;
        $config['overwrite'] = false;
        
        $this->load->library('upload', $config);
        
        // Handle multiple file uploads
        if (!empty($_FILES['eviden_files']['name'][0])) {
            log_message('debug', 'Processing manual upload files...');
            
            $files_count = count($_FILES['eviden_files']['name']);
            log_message('debug', 'Total files to upload: ' . $files_count);
            
            for ($i = 0; $i < $files_count; $i++) {
                if (!empty($_FILES['eviden_files']['name'][$i])) {
                    $_FILES['file']['name'] = $_FILES['eviden_files']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['eviden_files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['eviden_files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['eviden_files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['eviden_files']['size'][$i];
                    
                    log_message('debug', 'Uploading file: ' . $_FILES['file']['name'] . 
                               ' (' . $_FILES['file']['size'] . ' bytes)');
                    
                    if ($this->upload->do_upload('file')) {
                        $upload_data = $this->upload->data();
                        $saved_filenames[] = $upload_data['file_name'];
                        
                        log_message('info', 'File uploaded successfully: ' . $upload_data['file_name']);
                    } else {
                        $error = $this->upload->display_errors();
                        log_message('error', 'Upload failed: ' . $error);
                        throw new Exception('Gagal mengupload file: ' . $error);
                    }
                }
            }
        }
        
        // Validasi minimal 1 file
        if (empty($saved_filenames)) {
            throw new Exception('Minimal 1 file eviden harus diupload');
        }
        log_message('debug', 'Total files saved: ' . count($saved_filenames));
        
        // Process tanggal dengan aman
        $tanggal_kegiatan = $this->safe_date($post['tanggal_awal_kegiatan'] ?? null);
        $akhir_kegiatan = $this->safe_date($post['tanggal_akhir_kegiatan'] ?? null);
        $periode_penugasan = $this->safe_date($post['periode_penugasan'] ?? null);
        $akhir_periode_penugasan = $this->safe_date($post['akhir_periode_penugasan'] ?? null);
        
        // ===============================
        // PROSES NIP DAN PERAN
        // ===============================
        $nip_json = null;
        $peran_json = null;
        
        // Tentukan jenis pengajuan
        $jenis_pengajuan = $post['jenis_pengajuan'] ?? '';
        log_message('debug', "Jenis Pengajuan: $jenis_pengajuan");
        
        // Tangani NIP berdasarkan jenis pengajuan
        if (isset($post['nip']) && is_array($post['nip'])) {
            $nip_array = array_values(array_filter($post['nip'], function($x) {
                return trim($x) !== "" && $x !== null;
            }));
            
            if (!empty($nip_array)) {
                if ($jenis_pengajuan === 'Perorangan') {
                    // Untuk Perorangan: ambil NIP pertama saja
                    $nip_for_perorangan = [$nip_array[0]];
                    $nip_json = json_encode($nip_for_perorangan);
                    log_message('info', 'NIP data (Perorangan): ' . $nip_json . ' - NIP pertama: ' . $nip_array[0]);
                } else {
                    // Untuk Kelompok: ambil semua NIP
                    $nip_json = json_encode($nip_array);
                    log_message('info', 'NIP data (Kelompok): ' . $nip_json . ' - Jumlah: ' . count($nip_array));
                }
            } else {
                $nip_json = json_encode([]);
                log_message('error', 'NIP kosong untuk pengajuan');
            }
        } else {
            $nip_json = json_encode([]);
            log_message('error', 'NIP tidak ditemukan dalam POST atau bukan array');
        }
        
        // PROSES PERAN
        if ($jenis_pengajuan === 'Kelompok') {
            // Untuk KELOMPOK: Ambil data peran dari POST
            if (isset($post['peran']) && is_array($post['peran'])) {
                $peran_array = array_values(array_filter($post['peran'], function($x) {
                    return trim($x) !== "" && $x !== null;
                }));
                
                if (!empty($peran_array)) {
                    $peran_json = json_encode($peran_array);
                    log_message('info', 'Peran data (Kelompok): ' . $peran_json);
                } else {
                    $peran_json = json_encode([]);
                    log_message('info', 'Peran data (Kelompok) kosong: []');
                }
            } else {
                $peran_json = json_encode([]);
                log_message('warning', 'Peran tidak ditemukan untuk Kelompok, set ke []');
            }
        } else {
            // Untuk PERORANGAN: Set peran ke array kosong
            $peran_json = json_encode([]);
            log_message('info', 'Peran data (Perorangan): [] (array kosong)');
        }
        
        // VALIDASI: Pastikan ada NIP untuk semua jenis pengajuan
        $nip_array_decoded = json_decode($nip_json, true);
        if (empty($nip_array_decoded) || !is_array($nip_array_decoded)) {
            throw new Exception('NIP harus diisi untuk pengajuan');
        }
        
        // Proses jenis penugasan
        $jenis_penugasan_perorangan = '-';
        $penugasan_lainnya_perorangan = '-';
        $jenis_penugasan_kelompok = '-';
        $penugasan_lainnya_kelompok = '-';
        
        if ($jenis_pengajuan === 'Perorangan') {
            $jenis_penugasan_perorangan = $post['jenis_penugasan'] ?? $post['jenis_penugasan_perorangan'] ?? '-';
            
            if ($jenis_penugasan_perorangan === 'Lainnya') {
                $penugasan_lainnya_perorangan = $post['penugasan_lainnya_perorangan'] ?? '-';
            }
        } else if ($jenis_pengajuan === 'Kelompok') {
            $jenis_penugasan_kelompok = $post['jenis_penugasan_kelompok'] ?? '-';
            
            if ($jenis_penugasan_kelompok === 'Lainnya') {
                $penugasan_lainnya_kelompok = $post['penugasan_lainnya_kelompok'] ?? '-';
            }
        }
        
        // Siapkan data untuk insert
        $data = [
            'user_id' => $post['user_id'] ?? '-',
            'nama_kegiatan' => $post['nama_kegiatan'] ?? '-',
            'jenis_date' => $post['jenis_date'] ?? '-',
            'created_at' => date('Y-m-d H:i:s'),
            
            // TANGGAL KEGIATAN
            'tanggal_kegiatan' => $tanggal_kegiatan,
            'akhir_kegiatan' => $akhir_kegiatan,
            
            // PERIODE PENUGASAN
            'periode_penugasan' => $periode_penugasan,
            'akhir_periode_penugasan' => $akhir_periode_penugasan,
            
            'periode_value' => $post['periode_value'] ?? '-',
            'tempat_kegiatan' => $post['tempat_kegiatan'] ?? '-',
            'penyelenggara' => $post['penyelenggara'] ?? '-',
            'jenis_pengajuan' => $jenis_pengajuan,
            'lingkup_penugasan' => $post['lingkup_penugasan'] ?? '-',
            'jenis_penugasan_perorangan' => $jenis_penugasan_perorangan,
            'penugasan_lainnya_perorangan' => $penugasan_lainnya_perorangan,
            'jenis_penugasan_kelompok' => $jenis_penugasan_kelompok,
            'penugasan_lainnya_kelompok' => $penugasan_lainnya_kelompok,
            'format' => $post['format'] ?? '-',
            'nip' => $nip_json,
            'peran' => $peran_json,
            'eviden' => json_encode($saved_filenames),
            'status' => 'pengajuan',
            'approval_status' => json_encode([
                'kk' => null,
                'sekretariat' => null,
                'dekan' => null
            ]),
        ];
        
        log_message('debug', 'Data untuk Insert: ' . print_r($data, true));
        
        // ===============================
        // INSERT KE DATABASE
        // ===============================
        $this->db->insert('surat', $data);
        $insert_id = $this->db->insert_id();
        
        if ($insert_id) {
            log_message('info', 'Surat berhasil disubmit - ID: ' . $insert_id . 
                       ' - Jenis: ' . $jenis_pengajuan . 
                       ' - Files: ' . count($saved_filenames));
            
            // Simpan data dosen dengan format yang benar
            $dosen_data = $this->get_dosen_by_nip($nip_json, $peran_json);
            
            // Format data untuk modal success
            $added_item = [
                'id' => $insert_id,
                'nama' => $nama_kegiatan,
                'details' => '📅 ' . ($tanggal_kegiatan ? date('d M Y', strtotime($tanggal_kegiatan)) : '-') . 
                            ($akhir_kegiatan && $akhir_kegiatan !== '-' ? ' - ' . date('d M Y', strtotime($akhir_kegiatan)) : '') . 
                            ' | 📍 ' . ($post['tempat_kegiatan'] ?? '-'),
                'dosen_data' => $dosen_data,
                'file_count' => count($saved_filenames)
            ];
            
            log_message('debug', 'Added item data: ' . print_r($added_item, true));
            
            // ✅ KIRIM WHATSAPP OTOMATIS (OPSI 2)
            $this->send_whatsapp_notification($insert_id, $nama_kegiatan, $jenis_pengajuan, $tanggal_kegiatan);
            
            // Clear any output before setting flashdata
            if (ob_get_length()) {
                ob_end_clean();
            }
            
            // Set flashdata dengan urutan yang benar
            $this->session->set_flashdata('added_items', [$added_item]);
            $this->session->set_flashdata('is_single_add', true);
            $this->session->set_flashdata('success', 'Pengajuan surat tugas berhasil dikirim!');
            
            // Pastikan tidak ada output sebelum redirect
            if (ob_get_length()) {
                ob_end_clean();
            }
            
            // Response untuk AJAX atau redirect
            if ($this->input->is_ajax_request()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Pengajuan berhasil dikirim',
                    'id' => $insert_id,
                    'redirect' => base_url('list-surat-tugas')
                ]);
                return;
            } else {
                // ✅ LANGSUNG REDIRECT KE LIST (TIDAK KE wa_redirect)
                redirect(base_url('list-surat-tugas'));
                return;
            }
            
        } else {
            throw new Exception('Gagal menyimpan data ke database');
        }
        
    } catch (Exception $e) {
        log_message('error', 'Error in submit function: ' . $e->getMessage());
        log_message('error', 'Trace: ' . $e->getTraceAsString());
        
        // Clear output before flashdata
        if (ob_get_length()) {
            ob_end_clean();
        }
        
        $error_message = 'Terjadi kesalahan saat mengirim pengajuan: ' . $e->getMessage();
        
        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'success' => false,
                'message' => $error_message
            ]);
            return;
        } else {
            $this->session->set_flashdata('error', $error_message);
            
            // Clear output before redirect
            if (ob_get_length()) {
                ob_end_clean();
            }
            
            // ✅ REDIRECT KE LIST, BUKAN wa_redirect
            redirect(base_url('list-surat-tugas'));
            return;
        }
    }
}
            /* ===========================================
            DOWNLOAD EVIDEN
            ============================================*/
            public function download_eviden_url()
            {
                $url = $this->input->get('url');
                $name = $this->input->get('name') ?? "eviden";

                if (!$url) show_404();

                header("Content-Disposition: attachment; filename=\"$name\"");
                readfile($url);
            }

            public function download_eviden()
            {
                $file = $this->input->get('file');

                if (!$file) {
                    show_404();
                    return;
                }

                $file = urldecode($file);

                if (filter_var($file, FILTER_VALIDATE_URL)) {
                    $this->_download_from_url($file);
                    return;
                }

                $safe_filename = basename($file);
                $filepath = FCPATH . 'uploads/eviden/' . $safe_filename;

                if (!file_exists($filepath)) {
                    show_404();
                    return;
                }

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_file($finfo, $filepath);
                finfo_close($finfo);

                if (ob_get_level()) {
                    ob_end_clean();
                }

                header('Content-Description: File Transfer');
                header('Content-Type: ' . $mime_type);
                header('Content-Disposition: attachment; filename="' . $safe_filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filepath));

                flush();
                readfile($filepath);
                exit;
            }

            private function _download_from_url($url)
            {
                $filename = basename(parse_url($url, PHP_URL_PATH));

                if (empty($filename)) {
                    $filename = 'download_' . time();
                }

                $file_content = @file_get_contents($url);

                if ($file_content === false) {
                    show_404();
                    return;
                }

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_buffer($finfo, $file_content);
                finfo_close($finfo);

                if (ob_get_level()) {
                    ob_end_clean();
                }

                header('Content-Description: File Transfer');
                header('Content-Type: ' . $mime_type);
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . strlen($file_content));

                flush();
                echo $file_content;
                exit;
            }

            /* ===========================================
            GET EVIDEN URL - METHOD BARU
            ============================================*/
            public function get_eviden_url($eviden_data)
            {
                if (empty($eviden_data)) return [];
                
                $urls = [];
                
                if (is_string($eviden_data)) {
                    $decoded = json_decode($eviden_data, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $eviden_data = $decoded;
                    } else {
                        $eviden_data = [$eviden_data];
                    }
                }
                
                if (!is_array($eviden_data)) {
                    $eviden_data = [];
                }
                
                foreach ($eviden_data as $file) {
                    if (filter_var($file, FILTER_VALIDATE_URL)) {
                        $urls[] = $file;
                    } else if (strpos($file, 'ucarecdn.com') !== false || strpos($file, 'uploadcare.com') !== false) {
                        if (strpos($file, '//') === 0) {
                            $urls[] = 'https:' . $file;
                        } else {
                            $urls[] = 'https://' . $file;
                        }
                    } else {
                        $urls[] = base_url('uploads/eviden/' . $file);
                    }
                }
                
                return $urls;
            }
public function edit($id)
{
    $surat = $this->Surat_model->get_by_id($id);

    if (!$surat) show_404();

    // CEK APAKAH STATUS DITOLAK
    $status_lower = strtolower($surat->status);
    $is_rejected = in_array($status_lower, ['ditolak kk', 'ditolak sekretariat', 'ditolak dekan']);
    
    if (!$is_rejected) {
        $this->session->set_flashdata('error', 'Edit hanya dapat dilakukan untuk surat yang ditolak!');
        redirect('list-surat-tugas');
        return;
    }

    $data['surat'] = (array)$surat;
    
    // ============================================
    // 🔥 PERBAIKAN: Format data dosen untuk view
    // ============================================
    $nip_data = json_decode($surat->nip, true);
    $peran_data = json_decode($surat->peran, true);
    
    if (!is_array($nip_data)) {
        $nip_data = [];
    }
    if (!is_array($peran_data)) {
        $peran_data = [];
    }
    
    $dosen_array = [];
    
    foreach ($nip_data as $index => $nip) {
        if (!empty($nip) && $nip !== '-') {
            // Ambil data dari database
            $dosen_info = $this->db->get_where('list_dosen', ['nip' => $nip])->row();
            
            // Parse peran dengan benar
            $peran_value = '-';
            $jabatan_value = $dosen_info ? $dosen_info->jabatan : '';
            
            // Jika ada data peran di array peran_data
            if (isset($peran_data[$index]) && !empty($peran_data[$index])) {
                // PERBAIKAN: Peran sudah berupa array, tidak perlu decode ulang
                if (is_array($peran_data[$index])) {
                    $peran_item = $peran_data[$index];
                } else {
                    // Jika masih string, decode
                    $peran_item = json_decode($peran_data[$index], true);
                }
                
                if (is_array($peran_item)) {
                    $jabatan_value = $peran_item['jabatan'] ?? $jabatan_value;
                    $peran_value = $peran_item['peran'] ?? '-';
                } else {
                    // Jika peran bukan array, langsung gunakan nilai
                    $peran_value = $peran_data[$index];
                }
            }
            
            // Format data untuk view
            $dosen_array[] = [
                'nip' => $nip,
                'nama_dosen' => $dosen_info ? $dosen_info->nama_dosen : '',
                'jabatan' => $jabatan_value,
                'divisi' => $dosen_info ? $dosen_info->divisi : '',
                'peran' => $peran_value
            ];
        }
    }
    
    $data['dosen_data'] = $dosen_array;

    // Store initial data untuk tracking changes di view
    $data['initial_data'] = json_encode([
        'nama_kegiatan' => $surat->nama_kegiatan,
        'jenis_date' => $surat->jenis_date,
        'tanggal_kegiatan' => $surat->tanggal_kegiatan,
        'akhir_kegiatan' => $surat->akhir_kegiatan,
        'tempat_kegiatan' => $surat->tempat_kegiatan,
        'penyelenggara' => $surat->penyelenggara,
        'jenis_pengajuan' => $surat->jenis_pengajuan,
        'lingkup_penugasan' => $surat->lingkup_penugasan,
        'jenis_penugasan_perorangan' => $surat->jenis_penugasan_perorangan ?? '-',
        'penugasan_lainnya_perorangan' => $surat->penugasan_lainnya_perorangan ?? '-',
        'jenis_penugasan_kelompok' => $surat->jenis_penugasan_kelompok ?? '-',
        'penugasan_lainnya_kelompok' => $surat->penugasan_lainnya_kelompok ?? '-',
        'periode_value' => $surat->periode_value ?? '',
        'nip' => json_decode($surat->nip, true),
        'peran' => json_decode($surat->peran, true),
        'eviden' => json_decode($surat->eviden, true)
    ], JSON_UNESCAPED_UNICODE);
    
    // Process eviden
    $eviden_raw = $surat->eviden ?? "[]";
    
    if (is_string($eviden_raw)) {
        $eviden_decoded = json_decode($eviden_raw, true);
        $data['eviden'] = is_array($eviden_decoded) ? $eviden_decoded : [];
    } else {
        $data['eviden'] = is_array($eviden_raw) ? $eviden_raw : [];
    }

    if (!$this->input->post()) {
        $this->load->view('edit_surat', $data);
        return;
    }

    // ============================================
    // 🔥 PROSES UPDATE - DENGAN TRACKING CHANGES
    // ============================================
    $post = $this->input->post();
    
    // Clean data
    foreach ($post as $k => $v) {
        if (is_array($v)) {
            $post[$k] = array_values(array_filter($v, function($x) {
                return trim($x) !== "";
            }));
        } else {
            $post[$k] = ($v === "" ? "-" : $v);
        }
    }
    
    // Array untuk menyimpan perubahan
    $changes = [];
    
    // Function helper untuk track changes
    $trackChange = function($field, $field_label, $old_value, $new_value) use (&$changes) {
        $old_normalized = is_string($old_value) ? trim($old_value) : $old_value;
        $new_normalized = is_string($new_value) ? trim($new_value) : $new_value;
        
        if ($old_normalized === '-') $old_normalized = '';
        if ($new_normalized === '-') $new_normalized = '';
        
        if ($old_normalized != $new_normalized) {
            $changes[] = [
                'field' => $field,
                'field_label' => $field_label,
                'old_value' => $old_value ?: '-',
                'new_value' => $new_value ?: '-',
                'timestamp' => date('d M Y H:i:s')
            ];
            
            log_message('info', "Change tracked: {$field_label} | Old: {$old_value} | New: {$new_value}");
        }
    };
    
    // Track perubahan field biasa
    $trackChange('nama_kegiatan', 'Nama Kegiatan', $surat->nama_kegiatan, $post['nama_kegiatan']);
    $trackChange('jenis_date', 'Jenis Tanggal', $surat->jenis_date, $post['jenis_date']);
    
    $new_tanggal_kegiatan = $this->safe_date($post['tanggal_kegiatan']);
    $trackChange('tanggal_kegiatan', 'Tanggal Kegiatan', 
        $surat->tanggal_kegiatan ? date('d M Y', strtotime($surat->tanggal_kegiatan)) : '-',
        $new_tanggal_kegiatan ? date('d M Y', strtotime($new_tanggal_kegiatan)) : '-'
    );
    
    $new_akhir_kegiatan = $this->safe_date($post['akhir_kegiatan']);
    $trackChange('akhir_kegiatan', 'Akhir Kegiatan', 
        $surat->akhir_kegiatan ? date('d M Y', strtotime($surat->akhir_kegiatan)) : '-',
        $new_akhir_kegiatan ? date('d M Y', strtotime($new_akhir_kegiatan)) : '-'
    );
    
    $trackChange('tempat_kegiatan', 'Tempat Kegiatan', $surat->tempat_kegiatan, $post['tempat_kegiatan']);
    $trackChange('penyelenggara', 'Penyelenggara', $surat->penyelenggara, $post['penyelenggara']);
    $trackChange('jenis_pengajuan', 'Jenis Pengajuan', $surat->jenis_pengajuan, $post['jenis_pengajuan']);
    
    // ============================================
    // 🔥 PROSES NIP, JABATAN, DAN PERAN
    // ============================================
    $nip_array = $post['nip'] ?? [];
    $jabatan_array = $post['jabatan'] ?? [];
    $peran_array = $post['peran'] ?? [];
    
    // Build peran JSON array
    $peran_json_array = [];
    
    foreach ($nip_array as $index => $nip) {
        if (!empty($nip)) {
            $jabatan = $jabatan_array[$index] ?? '';
            $peran = $peran_array[$index] ?? '';
            
            // Simpan sebagai JSON string dengan jabatan dan peran
            $peran_json_array[] = json_encode([
                'jabatan' => $jabatan,
                'peran' => $peran
            ], JSON_UNESCAPED_UNICODE);
        }
    }
    
    // Track perubahan dosen
    $old_nip = json_decode($surat->nip, true) ?: [];
    $old_peran = json_decode($surat->peran, true) ?: [];
    
    if (json_encode($old_nip) !== json_encode($nip_array) || 
        json_encode($old_peran) !== json_encode($peran_json_array)) {
        
        $old_dosen_details = [];
        foreach ($old_nip as $i => $nip) {
            $peran_data = isset($old_peran[$i]) ? json_decode($old_peran[$i], true) : null;
            $jabatan_old = $peran_data['jabatan'] ?? '-';
            $peran_old = $peran_data['peran'] ?? '-';
            
            $dosen = $this->db->where('nip', $nip)->get('list_dosen')->row();
            $old_dosen_details[] = ($dosen ? $dosen->nama_dosen : $nip) . 
                                  " (Jabatan: {$jabatan_old}, Peran: {$peran_old})";
        }
        
        $new_dosen_details = [];
        foreach ($nip_array as $i => $nip) {
            $jabatan = $jabatan_array[$i] ?? '-';
            $peran = $peran_array[$i] ?? '-';
            
            $dosen = $this->db->where('nip', $nip)->get('list_dosen')->row();
            $new_dosen_details[] = ($dosen ? $dosen->nama_dosen : $nip) . 
                                  " (Jabatan: {$jabatan}, Peran: {$peran})";
        }
        
        $changes[] = [
            'field' => 'dosen',
            'field_label' => 'Daftar Dosen (Jabatan + Peran)',
            'old_value' => implode(', ', $old_dosen_details),
            'new_value' => implode(', ', $new_dosen_details),
            'timestamp' => date('d M Y H:i:s')
        ];
    }

    // ============================================
    // 🔥 PROSES EVIDEN
    // ============================================
    $existing_eviden = json_decode($surat->eviden, true) ?: [];
    
    // Hapus file yang ditandai untuk dihapus
    $deleted_files = $post['delete_eviden'] ?? [];
    foreach ($deleted_files as $del_file) {
        if ($del_file && trim($del_file) !== '') {
            $existing_eviden = array_filter($existing_eviden, function($f) use ($del_file) {
                return $f !== $del_file;
            });
            
            // Hapus file fisik dari server
            if (!filter_var($del_file, FILTER_VALIDATE_URL)) {
                $file_path = './uploads/eviden/' . $del_file;
                if (file_exists($file_path)) {
                    @unlink($file_path);
                }
            }
        }
    }
    
    // Upload file baru
    $new_files = [];
    $upload_path = './uploads/eviden/';
    
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0755, true);
    }
    
    // Handle multiple file uploads
    if (!empty($_FILES['new_eviden']['name'][0])) {
        $files_count = count($_FILES['new_eviden']['name']);
        
        for ($i = 0; $i < $files_count; $i++) {
            if (!empty($_FILES['new_eviden']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['new_eviden']['name'][$i];
                $_FILES['file']['type'] = $_FILES['new_eviden']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['new_eviden']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['new_eviden']['error'][$i];
                $_FILES['file']['size'] = $_FILES['new_eviden']['size'][$i];
                
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx';
                $config['max_size'] = 10240; // 10MB
                $config['encrypt_name'] = TRUE;
                $config['overwrite'] = FALSE;
                
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $new_files[] = $upload_data['file_name'];
                    
                    log_message('info', 'File uploaded: ' . $upload_data['file_name']);
                } else {
                    log_message('error', 'File upload failed: ' . $this->upload->display_errors());
                }
            }
        }
    }
    
    // Gabungkan tanpa duplikasi
    $existing_eviden = array_unique(array_values($existing_eviden));
    $new_files = array_unique($new_files);

    $final_eviden = $existing_eviden;
    foreach ($new_files as $new_file) {
        if (!in_array($new_file, $final_eviden)) {
            $final_eviden[] = $new_file;
        }
    }

    $update_eviden = json_encode(array_values($final_eviden));

    // ============================================
    // 🆕 PERBAIKAN UTAMA: RESET APPROVAL STATUS SESUAI PENOLAKAN
    // ============================================
    
    // Ambil approval status yang ada
    $approval_status = json_decode($surat->approval_status, true);
    if (!is_array($approval_status)) {
        $approval_status = [
            'kk' => null,
            'sekretariat' => null,
            'dekan' => null
        ];
    }
    
    // Tentukan status baru dan reset approval berdasarkan siapa yang menolak
    $new_status = 'pengajuan';
    
    switch ($status_lower) {
        case 'ditolak kk':
            // Hanya reset approval KK, biarkan yang lain
            $approval_status['kk'] = null;
            $new_status = 'pengajuan';
            
            log_message('info', 'Edit: Ditolak KK - Reset approval KK saja');
            break;
            
        case 'ditolak sekretariat':
            // Hanya reset approval Sekretariat, KK tetap ada
            $approval_status['sekretariat'] = null;
            $new_status = 'disetujui kk';
            
            log_message('info', 'Edit: Ditolak Sekretariat - Reset approval Sekretariat saja, KK tetap');
            break;
            
        case 'ditolak dekan':
            // Hanya reset approval Dekan, KK dan Sekretariat tetap ada
            $approval_status['dekan'] = null;
            $new_status = 'disetujui sekretariat';
            
            log_message('info', 'Edit: Ditolak Dekan - Reset approval Dekan saja, KK & Sekretariat tetap');
            break;
    }
    
    // Track status change
    $trackChange('status', 'Status Pengajuan', $surat->status, $new_status);
    
    // ============================================
    // 🔥 BUILD UPDATE DATA
    // ============================================
    $update = [
        'nama_kegiatan' => $post['nama_kegiatan'],
        'jenis_date' => $post['jenis_date'],
        'tanggal_kegiatan' => $new_tanggal_kegiatan,
        'akhir_kegiatan' => $new_akhir_kegiatan,
        'periode_penugasan' => $this->safe_date($post['periode_penugasan']),
        'akhir_periode_penugasan' => $this->safe_date($post['akhir_periode_penugasan']),
        'periode_value' => $post['periode_value'],
        'tempat_kegiatan' => $post['tempat_kegiatan'],
        'penyelenggara' => $post['penyelenggara'],
        'jenis_pengajuan' => $post['jenis_pengajuan'],
        'lingkup_penugasan' => $post['lingkup_penugasan'],
        'jenis_penugasan_perorangan' => $post['jenis_penugasan_perorangan'] ?? '-',
        'penugasan_lainnya_perorangan' => $post['penugasan_lainnya_perorangan'] ?? '-',
        'jenis_penugasan_kelompok' => $post['jenis_penugasan_kelompok'] ?? '-',
        'penugasan_lainnya_kelompok' => $post['penugasan_lainnya_kelompok'] ?? '-',
        'format' => $post['format'] ?? '-',
        'nip' => json_encode($nip_array, JSON_UNESCAPED_UNICODE),
        'peran' => json_encode($peran_json_array, JSON_UNESCAPED_UNICODE),
        'eviden' => $update_eviden,
        'status' => $new_status,
        'approval_status' => json_encode($approval_status), // Menggunakan approval_status yang sudah disesuaikan
        'catatan_penolakan' => null,
        'updated_at' => date('Y-m-d H:i:s'),
        'disposisi_status' => 'Modify By User',
        'disposisi_updated_at' => null,
        'disposisi_catatan' => null
    ];

    // ============================================
    // 🔥 EKSEKUSI UPDATE
    // ============================================
    $result = $this->Surat_model->update_surat($id, $update);

    if ($result) {
        // Get updated data untuk flashdata
        $updated_surat = $this->Surat_model->get_by_id($id);
        $dosen_data = $this->get_dosen_by_nip($updated_surat->nip, $updated_surat->peran);
        
        log_message('info', '=== EDIT COMPLETE ===');
        log_message('info', 'Total changes: ' . count($changes));
        log_message('info', 'New Status: ' . $new_status);
        log_message('info', 'Approval Status: ' . json_encode($approval_status));
        
        $edited_item = [
            'id' => $id,
            'nama' => $surat->nama_kegiatan,
            'details' => '📅 ' . date('d M Y', strtotime($surat->tanggal_kegiatan)) . ' | 📍 ' . $surat->penyelenggara,
            'new_status' => $new_status,
            'old_status' => $surat->status,
            'dosen_data' => $dosen_data,
            'changes' => $changes,
            'timestamp' => date('d M Y H:i:s'),
            'success' => true
        ];
        
        $this->session->set_flashdata('edited_items', [$edited_item]);
        $this->session->set_flashdata('is_single_edit', true);
        $this->session->set_flashdata('success', '✅ Edit berhasil disimpan! ' . count($changes) . ' perubahan dilakukan.');
        
        redirect('list-surat-tugas');
    } else {
        $this->session->set_flashdata('error', '❌ Gagal menyimpan perubahan!');
        redirect('list-surat-tugas');
    }
    
    if ($this->input->is_ajax_request()) {
        echo json_encode([
            'success' => true,
            'message' => 'Berhasil menyimpan perubahan',
            'redirect' => base_url('list-surat-tugas')
        ]);
        return;
    }
}
        /* ===========================================
            DELETE DATA
            ============================================*/
            public function delete($id)
            {
                $surat = $this->Surat_model->get_by_id($id);
                
                if ($surat) {
                    $eviden = json_decode($surat->eviden, true) ?: [];
                    foreach ($eviden as $file) {
                        if ($file && !filter_var($file, FILTER_VALIDATE_URL)) {
                            $file_path = './uploads/eviden/' . $file;
                            if (file_exists($file_path)) {
                                @unlink($file_path);
                            }
                        }
                    }
                }
                
                $this->Surat_model->delete_surat($id);
                $this->session->set_flashdata('success', 'Data berhasil dihapus!');
                redirect('list-surat-tugas');
            }

            /* ===========================================
            MULTI DELETE
            ============================================*/
            public function multi_delete()
            {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }

                $ids_input = $this->input->post('ids');
                
                if (!$ids_input) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Tidak ada data yang dipilih untuk dihapus.'
                    ]);
                    return;
                }

                if (is_string($ids_input)) {
                    $ids = array_map('intval', explode(',', $ids_input));
                } else if (is_array($ids_input)) {
                    $ids = array_map('intval', $ids_input);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Format ID tidak valid.'
                    ]);
                    return;
                }

                $ids = array_filter($ids, function($id) {
                    return $id > 0;
                });

                if (empty($ids)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Tidak ada ID yang valid untuk dihapus.'
                    ]);
                    return;
                }

                $deleted_count = 0;
                $failed_ids = [];

                foreach ($ids as $id) {
                    $surat = $this->Surat_model->get_by_id($id);
                    
                    if ($surat) {
                        $eviden = json_decode($surat->eviden, true) ?: [];
                        foreach ($eviden as $file) {
                            if ($file && !filter_var($file, FILTER_VALIDATE_URL)) {
                                $file_path = './uploads/eviden/' . $file;
                                if (file_exists($file_path)) {
                                    @unlink($file_path);
                                }
                            }
                        }

                        $result = $this->Surat_model->delete_surat($id);
                        
                        if ($result) {
                            $deleted_count++;
                        } else {
                            $failed_ids[] = $id;
                        }
                    } else {
                        $failed_ids[] = $id;
                    }
                }

                if ($deleted_count > 0) {
                    $message = "Berhasil menghapus {$deleted_count} data.";
                    
                    if (!empty($failed_ids)) {
                        $message .= " Gagal menghapus ID: " . implode(', ', $failed_ids);
                    }
                    
                    echo json_encode([
                        'success' => true,
                        'message' => $message,
                        'deleted_count' => $deleted_count
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Tidak ada data yang berhasil dihapus.'
                    ]);
                }
            }

            public function multi_edit()
            {
                $ids = $this->input->get('ids');

                if (!$ids) {
                    $this->session->set_flashdata('error', 'Tidak ada data yang dipilih untuk di-edit.');
                    redirect('list-surat-tugas');
                    return;
                }

                $idArray = explode(',', $ids);
                
                $idArray = array_filter(array_map('intval', $idArray), function($id) {
                    return $id > 0;
                });

                if (empty($idArray)) {
                    $this->session->set_flashdata('error', 'ID yang diberikan tidak valid.');
                    redirect('list-surat-tugas');
                    return;
                }

                $data['surat_list'] = $this->Surat_model->getMultiByIds($idArray);

                if (empty($data['surat_list'])) {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan untuk ID: ' . implode(', ', $idArray));
                    redirect('list-surat-tugas');
                    return;
                }

                // TAMBAHAN: Enrich dengan data dosen dari list_dosen
                foreach ($data['surat_list'] as &$surat) {
                    $nip_data = $surat->nip;
                    $surat->dosen_data = $this->get_dosen_by_nip($nip_data, $surat->peran);
                }

                $this->load->view('multi_edit_surat', $data);
            }

            /* ===========================================
            SAVE MULTI EDIT (UPDATED)
            ============================================*/
            public function save_multi_edit()
            {
                if (!$this->input->post()) {
                    $this->session->set_flashdata('error', 'Tidak ada data yang dikirim.');
                    redirect('list-surat-tugas');
                    return;
                }

                $post = $this->input->post();
                
                if (!isset($post['items']) || !is_array($post['items'])) {
                    $this->session->set_flashdata('error', 'Format data tidak valid.');
                    redirect('list-surat-tugas');
                    return;
                }

                $success_count = 0;
                $failed_count = 0;

                foreach ($post['items'] as $item) {
                    if (!isset($item['id']) || empty($item['id'])) {
                        continue;
                    }

                    $id = intval($item['id']);
                    if ($id <= 0) {
                        $failed_count++;
                        continue;
                    }

                    $existing = $this->Surat_model->get_by_id($id);
                    if (!$existing) {
                        $failed_count++;
                        continue;
                    }

                    $update_data = [
                        'nama_kegiatan' => $item['nama_kegiatan'] ?? $existing->nama_kegiatan,
                        'jenis_date' => $item['jenis_date'] ?? $existing->jenis_date,
                        'tanggal_kegiatan' => $this->safe_date($item['tanggal_kegiatan'] ?? null),
                        'akhir_kegiatan' => $this->safe_date($item['akhir_kegiatan'] ?? null),
                        'periode_penugasan' => $this->safe_date($item['periode_penugasan'] ?? null),
                        'akhir_periode_penugasan' => $this->safe_date($item['akhir_periode_penugasan'] ?? null),
                        'periode_value' => $item['periode_value'] ?? $existing->periode_value,
                        'tempat_kegiatan' => $item['tempat_kegiatan'] ?? $existing->tempat_kegiatan,
                        'penyelenggara' => $item['penyelenggara'] ?? $existing->penyelenggara,
                        'jenis_pengajuan' => $item['jenis_pengajuan'] ?? $existing->jenis_pengajuan,
                        'lingkup_penugasan' => $item['lingkup_penugasan'] ?? $existing->lingkup_penugasan,
                        'jenis_penugasan_perorangan' => $item['jenis_penugasan_perorangan'] ?? $existing->jenis_penugasan_perorangan,
                        'penugasan_lainnya_perorangan' => $item['penugasan_lainnya_perorangan'] ?? $existing->penugasan_lainnya_perorangan,
                        'jenis_penugasan_kelompok' => $item['jenis_penugasan_kelompok'] ?? $existing->jenis_penugasan_kelompok,
                        'penugasan_lainnya_kelompok' => $item['penugasan_lainnya_kelompok'] ?? $existing->penugasan_lainnya_kelompok,
                        
                        'nip' => isset($item['nip']) ? json_encode($item['nip']) : $existing->nip,
                        'peran' => (isset($item['jenis_pengajuan']) && $item['jenis_pengajuan'] === 'Kelompok' && isset($item['peran'])) 
                            ? json_encode($item['peran']) 
                            : $existing->peran
                    ];

                    $result = $this->Surat_model->update_surat($id, $update_data);
                    
                    if ($result) {
                        $success_count++;
                    } else {
                        $failed_count++;
                    }
                }

                if ($success_count > 0) {
                    $message = "Berhasil mengupdate {$success_count} data.";
                    if ($failed_count > 0) {
                        $message .= " Gagal update {$failed_count} data.";
                    }
                    $this->session->set_flashdata('success', $message);
                } else {
                    $this->session->set_flashdata('error', 'Tidak ada data yang berhasil diupdate.');
                }

                redirect('list-surat-tugas');
            }

                        public function cetak($id)
                        {
                            // Ambil data surat langsung dari database dengan query yang lengkap
                            $this->db->where('id', $id);
                            $surat = $this->db->get('surat')->row();
                            
                            if (!$surat) {
                                show_404();
                                return;
                            }
                            
                            // Validasi: harus ada status yang sesuai untuk dicetak
                            $allowed_statuses = ['disetujui sekretariat', 'disetujui dekan'];
                            if (!in_array(strtolower($surat->status), $allowed_statuses)) {
                                $this->session->set_flashdata('error', 'Surat belum disetujui untuk dicetak.');
                                redirect('sekretariat');
                                return;
                            }
                            
                            // Proses data NIP
                            $nip_data = $surat->nip;
                            if (is_string($nip_data)) {
                                $nip_array = json_decode($nip_data, true);
                                $surat->nip = is_array($nip_array) ? $nip_array : [$nip_data];
                            } else {
                                $surat->nip = is_array($surat->nip) ? $surat->nip : [];
                            }
                            
                            // Ambil data dosen
                            $surat->dosen_data = $this->get_dosen_data_from_nip_fixed($surat->nip, $surat->peran);
                            $jumlah_dosen = count($surat->dosen_data);
                            
                            // Tentukan file view berdasarkan jumlah dosen
                            if ($jumlah_dosen == 1) {
                                $view_file = 'surat_satu';
                            } elseif ($jumlah_dosen <= 5) {
                                $view_file = 'surat_print';
                            } else {
                                $view_file = 'surat_banyak';
                            }
                            
                            // --- QR VALIDATION URL ---
                            $validation_url = base_url("surat/validasi/" . $surat->id);
                            
                            // --- QR CODE GENERATE ---
                            $qr_base64 = '';
                            try {
                                if (extension_loaded('gd')) {
                                    $qrCode = new QrCode();
                                    $qrCode->setText($validation_url);
                                    $qrCode->setSize(160);
                                    
                                    // hasil PNG ke base64
                                    $qr_base64 = base64_encode($qrCode->get());
                                }
                            } catch (Exception $e) {
                                log_message('error', 'QR Code generation failed: ' . $e->getMessage());
                            }
                            
                            $data = [
                                'surat' => $surat,
                                'qr_base64' => $qr_base64
                            ];
                            
                            // Render view
                            $html = $this->load->view($view_file, $data, TRUE);
                            
                            // PDF OPTIONS
                            $options = new Options();
                            $options->set('isHtml5ParserEnabled', true);
                            $options->set('isRemoteEnabled', true);
                            $options->set('defaultFont', 'Arial');
                            
                            $dompdf = new Dompdf($options);
                            $dompdf->loadHtml($html);
                            $dompdf->setPaper('A4', 'portrait');
                            
                            // Tingkatkan memory limit untuk handle PDF yang kompleks
                            ini_set("memory_limit", "256M");
                            ini_set("pcre.backtrack_limit", "1000000");
                            
                            $dompdf->render();
                            
                            // Penamaan file berdasarkan nama kegiatan
                            $nama_kegiatan_clean = preg_replace('/[^a-zA-Z0-9\s]/', '', $surat->nama_kegiatan);
                            $nama_kegiatan_clean = str_replace(' ', '_', $nama_kegiatan_clean);
                            $nama_kegiatan_clean = substr($nama_kegiatan_clean, 0, 50); // Batasi panjang
                            $filename =  $nama_kegiatan_clean . ".pdf";
                            
                            $dompdf->stream($filename, array('Attachment' => 0));
                        }
 /* ================================
                        GET DOSEN DATA FROM NIP - DENGAN PARSE JABATAN & PERAN
                        ================================= */
                        private function get_dosen_data_from_nip_fixed($nip_data, $peran_data = null)
                        {
                            $dosen_data = array();

                            if (empty($nip_data) || $nip_data === '-' || $nip_data === '[]' || $nip_data === 'null') {
                                return [array(
                                    'nama' => 'Data dosen tidak tersedia',
                                    'nip' => '-',
                                    'jabatan' => '-',
                                    'divisi' => '-',
                                    'peran' => '-'
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

                            $nip_array = array_filter(array_map(function ($nip) {
                                if (is_array($nip)) {
                                    return !empty($nip) ? trim(strval($nip[0])) : null;
                                }
                                return trim(strval($nip));
                            }, $nip_array), function ($nip) {
                                return !empty($nip) && $nip !== '-' && $nip !== 'null' && $nip !== '[]';
                            });

                            if (empty($nip_array)) {
                                return [array(
                                    'nama' => 'Data dosen tidak tersedia',
                                    'nip' => '-',
                                    'jabatan' => '-',
                                    'divisi' => '-',
                                    'peran' => '-'
                                )];
                            }

                            // Process peran data (yang berisi gabungan jabatan & peran)
                            $peran_array = [];
                            if (!empty($peran_data)) {
                                if (is_string($peran_data)) {
                                    $decoded_peran = json_decode($peran_data, true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded_peran)) {
                                        $peran_array = $decoded_peran;
                                    } else {
                                        $peran_array = [$peran_data];
                                    }
                                } elseif (is_array($peran_data)) {
                                    $peran_array = $peran_data;
                                }
                            }

                            // Query dosen dari database
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

                                foreach ($nip_array as $index => $nip) {
                                    $clean_nip = trim(strval($nip));
                                    if (isset($dosen_by_nip[$clean_nip])) {
                                        $dosen_info = $dosen_by_nip[$clean_nip];
                                        
                                        // PARSE PERAN DATA (yang berisi jabatan & peran)
                                        $peran_value = '-';
                                        $jabatan_value = $dosen_info['jabatan']; // Default dari database
                                        
                                        if (isset($peran_array[$index])) {
                                            $peran_item = $peran_array[$index];
                                            
                                            // Jika peran_item adalah string JSON, decode
                                            if (is_string($peran_item)) {
                                                $decoded = json_decode($peran_item, true);
                                                if (is_array($decoded) && isset($decoded['jabatan'])) {
                                                    $jabatan_value = $decoded['jabatan'];
                                                    $peran_value = $decoded['peran'] ?? '-';
                                                } else {
                                                    // Fallback: jika string biasa (data lama)
                                                    $peran_value = $peran_item;
                                                }
                                            } 
                                            // Jika peran_item sudah array
                                            elseif (is_array($peran_item) && isset($peran_item['jabatan'])) {
                                                $jabatan_value = $peran_item['jabatan'];
                                                $peran_value = $peran_item['peran'] ?? '-';
                                            }
                                        }
                                        
                                        $dosen_data[] = array(
                                            'nama' => $dosen_info['nama'],
                                            'nip' => $dosen_info['nip'],
                                            'jabatan' => $jabatan_value, // Jabatan dari edit atau database
                                            'divisi' => $dosen_info['divisi'],
                                            'peran' => $peran_value // Peran dari edit
                                        );
                                    } else {
                                        $dosen_data[] = array(
                                            'nama' => 'Data tidak ditemukan',
                                            'nip' => $clean_nip,
                                            'jabatan' => '-',
                                            'divisi' => '-',
                                            'peran' => '-'
                                        );
                                    }
                                }
                            } else {
                                foreach ($nip_array as $index => $nip) {
                                    $clean_nip = trim(strval($nip));
                                    $dosen_data[] = array(
                                        'nama' => 'Data dari NIP: ' . $clean_nip,
                                        'nip' => $clean_nip,
                                        'jabatan' => '-',
                                        'divisi' => '-',
                                        'peran' => '-'
                                    );
                                }
                            }

                            return $dosen_data;
                        }
            public function download_pdf($id)
            {
                $this->load->helper('download');

                $surat = $this->Surat_model->get_by_id($id);

                $file_path = FCPATH . "uploads/surat_pdf/" . $surat->file_pdf;

                if (!file_exists($file_path)) {
                    show_404();
                    return;
                }

                force_download($file_path, NULL);
            }

            /* ===========================================
            VALIDASI (UPDATED WITH DOSEN LIST)
            ============================================*/
            public function validasi($id)
            {
                $surat = $this->Surat_model->get_by_id($id);
                
                if (!$surat) {
                    $data['found'] = false;
                    $data['surat'] = null;
                    $data['dosen_list'] = [];
                    $data['dosen_penandatangan'] = null;
                    $data['logo_base64'] = '';
                } else {
                    $data['found'] = true;
                    $data['surat'] = $surat;
                    
                    // AMBIL SEMUA DOSEN YANG TERLIBAT DALAM PENGAJUAN INI
                    $data['dosen_list'] = $this->get_dosen_by_nip($surat->nip, $surat->peran);
                    
                    // Ambil data dosen penandatangan (dekan)
                    $data['dosen_penandatangan'] = $this->db
                        ->select('nama_dosen, jabatan, divisi')
                        ->from('list_dosen')
                        ->where('jabatan LIKE', '%Dekan%')
                        ->or_where('divisi LIKE', '%Dekan%')
                        ->limit(1)
                        ->get()
                        ->row();
                    
                    // Load logo untuk header
                    $logo_path = FCPATH . 'assets/Tel-U_logo.png';
                    if (file_exists($logo_path)) {
                        $logo_data = file_get_contents($logo_path);
                        $data['logo_base64'] = base64_encode($logo_data);
                    } else {
                        $data['logo_base64'] = '';
                    }
                }

                $this->load->view('surat_validasi', $data);
            }

            private function get_dosen_detail($surat)
            {
                // NIP sudah array → tidak perlu json_decode
                $nip_list = is_array($surat->nip) ? $surat->nip : json_decode($surat->nip, true);

                if (!$nip_list) return [];

                // 🆕 Decode peran array
                $peran_list = [];
                if (!empty($surat->peran)) {
                    $peran_decoded = json_decode($surat->peran, true);
                    if (is_array($peran_decoded)) {
                        $peran_list = $peran_decoded;
                    }
                }

                // Ambil dosen dari model
                $this->load->model('ListSurat_model');
                $dosen_data = $this->ListSurat_model->get_many_by_nip($nip_list);

                // Susun ulang urutan sesuai urutan NIP di surat
                $result = [];

                foreach ($nip_list as $index => $nip) {
                    if (isset($dosen_data[$nip])) {
                        $result[] = [
                            'nip' => $nip,
                            'nama' => $dosen_data[$nip]->nama_dosen,
                            'jabatan' => $dosen_data[$nip]->jabatan,
                            'divisi' => $dosen_data[$nip]->divisi,
                            'peran' => isset($peran_list[$index]) ? $peran_list[$index] : '-',
                        ];
                    } else {
                        // fallback jika nip tidak ada di tabel list_dosen
                        $result[] = [
                            'nip' => $nip,
                            'nama' => '-',
                            'jabatan' => '-',
                            'divisi' => '-',
                            'peran' => isset($peran_list[$index]) ? $peran_list[$index] : '-',
                        ];
                    }
                }

                return $result;
            }

            /* ===========================================
            LIST SURAT TUGAS (UPDATED)
            ============================================*/
            public function list_surat_tugas()
            {
                $data['surat_list'] = $this->Surat_model->get_all_surat();
                
                // TAMBAHAN: Enrich data dengan informasi dosen
                foreach ($data['surat_list'] as &$surat) {
                    $surat->dosen_data = $this->get_dosen_by_nip($surat->nip, $surat->peran);
                }
                
                $this->load->view('list_surat_tugas', $data);
            }

            /* ===========================================
            TAMBAH DOSEN KE PENGAJUAN (AJAX)
            ============================================*/
            public function tambah_dosen()
            {
                header('Content-Type: application/json');
                
                log_message('debug', 'tambah_dosen called');
                log_message('debug', 'POST data: ' . print_r($this->input->post(), true));
                
                $surat_id = $this->input->post('surat_id');
                $nip_baru = $this->input->post('nip');
                
                if (!$surat_id || !$nip_baru) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Data tidak lengkap'
                    ]);
                    return;
                }
                
                // Ambil data surat
                $surat = $this->Surat_model->get_by_id($surat_id);
                
                if (!$surat) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Surat tidak ditemukan'
                    ]);
                    return;
                }
                
                // Decode NIP yang sudah ada
                $nip_array = json_decode($surat->nip, true);
                if (!is_array($nip_array)) {
                    $nip_array = [];
                }
                
                // Cek apakah NIP sudah ada
                if (in_array($nip_baru, $nip_array)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Dosen dengan NIP ini sudah ada dalam pengajuan'
                    ]);
                    return;
                }
                
                // Cek apakah NIP valid di database
                $this->db->where('nip', $nip_baru);
                $dosen = $this->db->get('list_dosen')->row();
                
                if (!$dosen) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'NIP tidak ditemukan di database dosen'
                    ]);
                    return;
                }
                
                // Tambahkan NIP baru
                $nip_array[] = $nip_baru;
                
                // Update database
                $update_data = [
                    'nip' => json_encode($nip_array),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $result = $this->Surat_model->update_surat($surat_id, $update_data);
                
                if ($result) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Dosen berhasil ditambahkan',
                        'dosen' => [
                            'nip' => $dosen->nip,
                            'nama_dosen' => $dosen->nama_dosen,
                            'jabatan' => $dosen->jabatan,
                            'divisi' => $dosen->divisi
                        ],
                        'total_dosen' => count($nip_array)
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Gagal menambahkan dosen ke database'
                    ]);
                }
            }

            /* ===========================================
            HAPUS DOSEN DARI PENGAJUAN
            ============================================*/
            public function hapus_dosen()
            {
                header('Content-Type: application/json');
                
                $surat_id = $this->input->post('surat_id');
                $nip = $this->input->post('nip');
                
                if (!$surat_id || !$nip) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Data tidak lengkap'
                    ]);
                    return;
                }
                
                // Ambil data surat
                $surat = $this->Surat_model->get_by_id($surat_id);
                
                if (!$surat) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Surat tidak ditemukan'
                    ]);
                    return;
                }
                
                // Decode NIP yang sudah ada
                $nip_array = json_decode($surat->nip, true);
                if (!is_array($nip_array)) {
                    $nip_array = [];
                }
                
                // Cek apakah NIP ada dalam array
                if (!in_array($nip, $nip_array)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Dosen dengan NIP ini tidak ditemukan dalam pengajuan'
                    ]);
                    return;
                }
                
                // Cek minimal harus ada 1 dosen tersisa
                if (count($nip_array) <= 1) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Minimal harus ada 1 dosen dalam pengajuan'
                    ]);
                    return;
                }
                
                // Hapus NIP dari array
                $new_nip_array = array_values(array_filter($nip_array, function($item) use ($nip) {
                    return $item !== $nip;
                }));
                
                // Update database
                $update_data = [
                    'nip' => json_encode($new_nip_array),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('id', $surat_id);
                $result = $this->db->update('surat', $update_data);
                
                if ($result) {
                    // Ambil info dosen yang dihapus untuk response
                    $this->db->where('nip', $nip);
                    $dosen_hapus = $this->db->get('list_dosen')->row();
                    
                    $dosen_info = [
                        'nip' => $nip,
                        'nama_dosen' => $dosen_hapus ? $dosen_hapus->nama_dosen : '-',
                        'jabatan' => $dosen_hapus ? $dosen_hapus->jabatan : '-',
                        'divisi' => $dosen_hapus ? $dosen_hapus->divisi : '-'
                    ];
                    
                    echo json_encode([
                        'success' => true,
                        'message' => 'Dosen berhasil dihapus',
                        'dosen' => $dosen_info,
                        'total_dosen' => count($new_nip_array)
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Gagal menghapus dosen dari database'
                    ]);
                }
            }

            /* ===========================================
            HAPUS BANYAK DOSEN SEKALIGUS
            ============================================*/
            public function hapus_banyak_dosen()
            {
                header('Content-Type: application/json');
                
                $surat_id = $this->input->post('surat_id');
                $nip_list_json = $this->input->post('nip_list');
                
                if (!$surat_id || !$nip_list_json) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Data tidak lengkap'
                    ]);
                    return;
                }
                
                // Decode NIP list
                $nip_list = json_decode($nip_list_json, true);
                if (!is_array($nip_list) || empty($nip_list)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Daftar NIP tidak valid'
                    ]);
                    return;
                }
                
                // Ambil data surat
                $surat = $this->Surat_model->get_by_id($surat_id);
                if (!$surat) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Surat tidak ditemukan'
                    ]);
                    return;
                }
                
                // Decode NIP yang sudah ada
                $existing_nips = json_decode($surat->nip, true);
                if (!is_array($existing_nips)) {
                    $existing_nips = [];
                }
                
                // Validasi: minimal harus ada 1 dosen tersisa setelah penghapusan
                $remaining_nips = array_diff($existing_nips, $nip_list);
                if (count($remaining_nips) < 1) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Minimal harus ada 1 dosen tersisa dalam pengajuan. Tidak dapat menghapus semua dosen.'
                    ]);
                    return;
                }
                
                // Filter NIP yang benar-benar ada di dalam surat
                $nips_to_remove = array_intersect($existing_nips, $nip_list);
                
                // Jika tidak ada NIP yang valid untuk dihapus
                if (empty($nips_to_remove)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Tidak ada NIP yang valid untuk dihapus'
                    ]);
                    return;
                }
                
                // Hapus NIP dari array
                $final_nips = array_values(array_diff($existing_nips, $nips_to_remove));
                
                // Update database
                $update_data = [
                    'nip' => json_encode($final_nips),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('id', $surat_id);
                $result = $this->db->update('surat', $update_data);
                
                if ($result) {
                    // Get dosen data untuk response
                    $removed_dosen = [];
                    foreach ($nips_to_remove as $nip) {
                        $this->db->where('nip', $nip);
                        $dosen = $this->db->get('list_dosen')->row();
                        if ($dosen) {
                            $removed_dosen[] = [
                                'nip' => $dosen->nip,
                                'nama_dosen' => $dosen->nama_dosen,
                                'jabatan' => $dosen->jabatan,
                                'divisi' => $dosen->divisi
                            ];
                        } else {
                            $removed_dosen[] = [
                                'nip' => $nip,
                                'nama_dosen' => '-',
                                'jabatan' => '-',
                                'divisi' => '-'
                            ];
                        }
                    }
                    
                    echo json_encode([
                        'success' => true,
                        'message' => 'Berhasil menghapus ' . count($nips_to_remove) . ' dosen',
                        'removed_count' => count($nips_to_remove),
                        'removed_dosen' => $removed_dosen,
                        'total_dosen' => count($final_nips)
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Gagal memperbarui database'
                    ]);
                }
            }

            /* ===========================================
            CARI DOSEN UNTUK AUTOCOMPLETE (AJAX)
            ============================================*/
            public function cari_dosen()
            {
                header('Content-Type: application/json');
                
                $nip = $this->input->get('q');
                
                if (!$nip) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'NIP tidak boleh kosong'
                    ]);
                    return;
                }
                
                // Cari dosen di database
                $this->db->select('nip, nama_dosen, jabatan, divisi');
                $this->db->from('list_dosen');
                $this->db->where('nip', $nip);
                $query = $this->db->get();
                
                if ($query->num_rows() > 0) {
                    $dosen = $query->row();
                    echo json_encode([
                        'success' => true,
                        'dosen' => [
                            'nip' => $dosen->nip,
                            'nama_dosen' => $dosen->nama_dosen,
                            'jabatan' => $dosen->jabatan,
                            'divisi' => $dosen->divisi
                        ]
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Dosen tidak ditemukan'
                    ]);
                }
            }

            /* ===========================================
            CEK STATUS SURAT - Untuk debugging
            ============================================*/
            public function cek_surat($id)
            {
                header('Content-Type: application/json');
                
                $surat = $this->Surat_model->get_by_id($id);
                
                if (!$surat) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Surat tidak ditemukan'
                    ]);
                    return;
                }
                
                $nip_array = json_decode($surat->nip, true);
                
                echo json_encode([
                    'success' => true,
                    'data' => [
                        'id' => $surat->id,
                        'nama_kegiatan' => $surat->nama_kegiatan,
                        'nip_raw' => $surat->nip,
                        'nip_array' => $nip_array,
                        'count_nip' => is_array($nip_array) ? count($nip_array) : 0,
                        'dosen_data' => $this->get_dosen_by_nip($surat->nip, $surat->peran)
                    ]
                ]);
            }

            /* ===========================================
            AUTOCOMPLETE DOSEN UNTUK MODAL TAMBAH
            ============================================*/
            public function autocomplete_dosen()
            {
                header('Content-Type: application/json');
                
                $query = $this->input->get('q');
                
                if (!$query || strlen($query) < 2) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Kata kunci terlalu pendek',
                        'results' => []
                    ]);
                    return;
                }
                
                try {
                    // Mencari di database dengan multiple fields
                    $this->db->select('nip, nama_dosen, jabatan, divisi');
                    $this->db->from('list_dosen');
                    
                    // Search in multiple columns
                    $this->db->group_start();
                    $this->db->like('nip', $query);
                    $this->db->or_like('nama_dosen', $query);
                    $this->db->or_like('jabatan', $query);
                    $this->db->or_like('divisi', $query);
                    $this->db->group_end();
                    
                    $this->db->limit(10);
                    $this->db->order_by('nama_dosen', 'ASC');
                    
                    $result = $this->db->get();
                    
                    if ($result->num_rows() > 0) {
                        $dosen_list = $result->result_array();
                        
                        // Format results for autocomplete
                        $results = array_map(function($dosen) {
                            return [
                                'nip' => $dosen['nip'] ?? '',
                                'nama_dosen' => $dosen['nama_dosen'] ?? '',
                                'jabatan' => $dosen['jabatan'] ?? '',
                                'divisi' => $dosen['divisi'] ?? '',
                                'display_text' => $dosen['nama_dosen'] . ' (' . $dosen['nip'] . ')'
                            ];
                        }, $dosen_list);
                        
                        echo json_encode([
                            'success' => true,
                            'results' => $results,
                            'count' => count($results)
                        ]);
                    } else {
                        echo json_encode([
                            'success' => true,
                            'results' => [],
                            'message' => 'Tidak ditemukan dosen yang cocok'
                        ]);
                    }
                    
                } catch (Exception $e) {
                    log_message('error', 'Autocomplete dosen error: ' . $e->getMessage());
                    echo json_encode([
                        'success' => false,
                        'message' => 'Terjadi kesalahan saat mencari dosen',
                        'results' => []
                    ]);
                }
            }

            /* ===========================================
            TAMBAH BANYAK DOSEN SEKALIGUS (BATCH)
            ============================================*/
            public function tambah_banyak_dosen()
            {
                header('Content-Type: application/json');
                
                $surat_id = $this->input->post('surat_id');
                $nip_list_json = $this->input->post('nip_list');
                
                if (!$surat_id || !$nip_list_json) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Data tidak lengkap'
                    ]);
                    return;
                }
                
                // Decode NIP list
                $nip_list = json_decode($nip_list_json, true);
                if (!is_array($nip_list) || empty($nip_list)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Daftar NIP tidak valid'
                    ]);
                    return;
                }
                
                // Ambil data surat
                $surat = $this->Surat_model->get_by_id($surat_id);
                if (!$surat) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Surat tidak ditemukan'
                    ]);
                    return;
                }
                
                // Decode NIP yang sudah ada
                $existing_nips = json_decode($surat->nip, true);
                if (!is_array($existing_nips)) {
                    $existing_nips = [];
                }
                
                // Filter NIP yang belum ada
                $new_nips = array_filter($nip_list, function($nip) use ($existing_nips) {
                    return !in_array($nip, $existing_nips);
                });
                
                // Validasi NIP di database
                $valid_nips = [];
                $invalid_nips = [];
                
                foreach ($new_nips as $nip) {
                    // Cek apakah NIP valid di database
                    $this->db->where('nip', $nip);
                    $dosen = $this->db->get('list_dosen')->row();
                    
                    if ($dosen) {
                        $valid_nips[] = $nip;
                    } else {
                        $invalid_nips[] = $nip;
                    }
                }
                
                // Jika tidak ada NIP valid
                if (empty($valid_nips)) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Tidak ada NIP yang valid untuk ditambahkan',
                        'invalid_nips' => $invalid_nips
                    ]);
                    return;
                }
                
                // Gabungkan NIP lama dengan baru
                $final_nips = array_merge($existing_nips, $valid_nips);
                
                // Update database
                $update_data = [
                    'nip' => json_encode($final_nips),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('id', $surat_id);
                $result = $this->db->update('surat', $update_data);
                
                if ($result) {
                    // Get dosen data untuk response
                    $added_dosen = [];
                    foreach ($valid_nips as $nip) {
                        $this->db->where('nip', $nip);
                        $dosen = $this->db->get('list_dosen')->row();
                        if ($dosen) {
                            $added_dosen[] = [
                                'nip' => $dosen->nip,
                                'nama_dosen' => $dosen->nama_dosen,
                                'jabatan' => $dosen->jabatan,
                                'divisi' => $dosen->divisi
                            ];
                        }
                    }
                    
                    echo json_encode([
                        'success' => true,
                        'message' => 'Berhasil menambahkan ' . count($valid_nips) . ' dosen',
                        'added_count' => count($valid_nips),
                        'added_dosen' => $added_dosen,
                        'invalid_nips' => $invalid_nips,
                        'total_dosen' => count($final_nips)
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Gagal memperbarui database'
                    ]);
                }
            }
    

// ===============================
// METHOD: KIRIM WHATSAPP OTOMATIS KE SEMUA RECIPIENT AKTIF
// ===============================
private function send_whatsapp_notification($surat_id, $nama_kegiatan, $created_at)
{
    try {
        // Load model recipient
        $this->load->model('WhatsappRecipient_model');
        
        // Get semua recipient yang aktif
        $recipients = $this->WhatsappRecipient_model->get_active_recipients();
        
        if (empty($recipients)) {
            log_message('warning', 'Tidak ada recipient aktif untuk broadcast WhatsApp');
            return false;
        }
        
        // Konfigurasi
        $api_url = 'http://localhost:3000/send-message';
        
        // Gunakan tanggal pembuatan pengajuan (sekarang)
        $created_at = date('d M Y'); // Format: 31 Des 2025 14:30:45
        
        // Format pesan WhatsApp
        $pesan = "📄 *Pengajuan Surat Tugas Baru*\n\n" .
                 "Nama Kegiatan: *" . $nama_kegiatan . "*\n" .
                 "Tanggal Pengajuan: " . $created_at . "\n\n" .
                 "Silakan cek dashboard untuk detail lengkap:\n" .
                 base_url('list-surat-tugas');
        
        $success_count = 0;
        $failed_count = 0;
        
        // Kirim ke setiap recipient
        foreach ($recipients as $recipient) {
            $data = json_encode([
                'nomor' => $recipient->nomor,
                'pesan' => $pesan
            ]);
            
            // Kirim request ke wa-server.js
            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curl_error = curl_error($ch);
            curl_close($ch);
            
            // Log response
            if ($httpcode == 200) {
                log_message('info', '✅ WhatsApp berhasil dikirim ke ' . $recipient->nama . ' (' . $recipient->nomor . ')');
                $success_count++;
            } else {
                log_message('error', '❌ WhatsApp gagal dikirim ke ' . $recipient->nama . ' - HTTP Code: ' . $httpcode . ' - Error: ' . $curl_error);
                $failed_count++;
            }
            
            // Delay 1 detik antar pesan (agar tidak spam)
            sleep(1);
        }
        
        // Log summary
        log_message('info', "📊 Broadcast summary: {$success_count} berhasil, {$failed_count} gagal dari " . count($recipients) . " recipient");
        
        return ($success_count > 0);
        
    } catch (Exception $e) {
        log_message('error', '❌ Exception saat broadcast WhatsApp: ' . $e->getMessage());
        return false;
    }
}
            /* ===========================================
            DEBUG FUNCTION - Untuk troubleshooting
            ============================================*/
            public function debug_submit()
            {
                // Aktifkan error reporting
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                
                echo "<h2>Debug Submit Function</h2>";
                echo "<pre>";
                
                echo "POST Data:\n";
                print_r($this->input->post());
                
                echo "\n\nFILES Data:\n";
                print_r($_FILES);
                
                echo "\n\nServer Info:\n";
                echo "PHP Version: " . phpversion() . "\n";
                echo "CI Version: " . CI_VERSION . "\n";
                
                // Cek apakah ada error di PHP
                $errors = error_get_last();
                if ($errors) {
                    echo "\n\nPHP Errors:\n";
                    print_r($errors);
                }
                
                // Cek apakah database terhubung
                echo "\n\nDatabase Connection:\n";
                if ($this->db->conn_id) {
                    echo "Database Connected: YES\n";
                    echo "Database Name: " . $this->db->database . "\n";
                    
                    // Cek tabel surat
                    echo "\n\nTable surat structure:\n";
                    $fields = $this->db->list_fields('surat');
                    print_r($fields);
                } else {
                    echo "Database Connected: NO\n";
                }
                
                echo "</pre>";
                die();
            }
        }