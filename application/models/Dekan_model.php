<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dekan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

    public function index()
{
    $tahun = $this->input->get('tahun') ?? date('Y');
    $data['tahun'] = $tahun;

    // Filter berdasarkan tahun
    $this->db->where('YEAR(created_at)', $tahun);

    // Statistik
    $data['total_surat'] = $this->db->count_all_results('surat');

    $data['approved_count'] = $this->db->where('YEAR(created_at)', $tahun)
                                      ->where('status', 'disetujui dekan')
                                      ->count_all_results('surat');

    $data['pending_count'] = $this->db->where('YEAR(created_at)', $tahun)
                                      ->where('status', 'disetujui sekretariat')
                                      ->count_all_results('surat');

    $data['rejected_count'] = $this->db->where('YEAR(created_at)', $tahun)
                                       ->where_in('status', ['ditolak KK', 'ditolak sekretariat'])
                                       ->count_all_results('surat');

    // Grafik
    $total     = array_fill(0, 12, 0);
    $approved  = array_fill(0, 12, 0);
    $rejected  = array_fill(0, 12, 0);

    $this->db->where('YEAR(created_at)', $tahun);
    $query = $this->db->get('surat')->result();

    foreach ($query as $row) {
        $month = (int)date('m', strtotime($row->created_at)) - 1;

        $total[$month]++;

        if ($row->status == 'disetujui dekan') {
            $approved[$month]++;
        }

        if (in_array($row->status, ['ditolak KK', 'ditolak sekretariat'])) {
            $rejected[$month]++;
        }
    }

    $data['chart_total']    = $total;
    $data['chart_approved'] = $approved;
    $data['chart_rejected'] = $rejected;

    $this->load->view('dekan/dashboard', $data);
}



    public function approve($id)
{
    $this->db->where('id', $id)->update('surat', [
        'status' => 'disetujui dekan',
    ]);

    $this->session->set_flashdata('success', 'Surat berhasil disetujui oleh Dekan.');
    redirect('dekan');
}

public function reject($id)
{
    $notes = $this->input->post('rejection_notes');

    // Dekan tidak memutuskan ditolak, tetapi mengembalikan ke sekretariat
    $this->db->where('id', $id)->update('surat', [
        'status' => 'ditolak dekan',
        'catatan_penolakan' => $notes,
    ]);

    $this->session->set_flashdata('success', 'Surat dikembalikan ke Sekretariat.');
    redirect('dekan');
}

    public function list_surat_tugas()
    {
        // Semua surat yg pernah diproses Dekan
        $this->db->where_in("status", [
            'disetujui sekretariat',
            'disetujui dekan',
            'kembalikan ke sekretariat'
        ]);
        $this->db->order_by("created_at", "DESC");
        $data['surat_list'] = $this->db->get("surat")->result();

        // Statistik mengikuti aturan baru
        $data['approved_count'] = $this->db->where('status', 'disetujui dekan')->count_all_results('surat');
        $data['pending_count'] = $this->db->where('status', 'disetujui sekretariat')->count_all_results('surat');
        $data['rejected_count'] = $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat'])->count_all_results('surat');
        $data['total_count'] = $this->db->count_all_results('surat');

        $this->load->view('dekan/list_surat_tugas', $data);
    }

    public function laporan()
    {
        $data['stats'] = [
            'total_surat'        => $this->db->count_all_results('surat'),
            'surat_bulan_ini'    => $this->db->like('created_at', date('Y-m'))->count_all_results('surat'),
            'surat_diselesaikan' => $this->db->where('status', 'disetujui dekan')->count_all_results('surat'),
            'surat_ditolak'      => $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat'])->count_all_results('surat'),
            'surat_menunggu'     => $this->db->where('status', 'disetujui sekretariat')->count_all_results('surat')
        ];

        $this->load->view('dekan/laporan', $data);
    }
    

    public function detail($id)
    {
        $this->db->where('id', $id);
        $data['surat'] = $this->db->get("surat")->row();

        if (!$data['surat']) {
            show_404();
        }

        $this->load->view('dekan/detail_surat', $data);
    }

    public function get_surat_detail($id)
    {
        $this->db->where('id', $id);
        $surat = $this->db->get("surat")->row();

        echo json_encode($surat ? $surat : ['error' => 'Data tidak ditemukan']);
    }

    // Filter laporan sesuai aturan baru
    public function filter($status = '')
    {
        $this->db->order_by("created_at", "DESC");

        if ($status == 'menunggu') {
            $this->db->where('status', 'disetujui sekretariat');
        } 
        elseif ($status == 'disetujui') {
            $this->db->where('status', 'disetujui dekan');
        } 
        elseif ($status == 'ditolak') {
            // DITOLAK = KK + sekretariat, BUKAN dekan
            $this->db->where_in('status', ['ditolak KK', 'ditolak sekretariat']);
        } 
        else {
            // Semua yg terkait Dekan
            $this->db->where_in('status', [
                'disetujui sekretariat',
                'disetujui dekan',
                'kembalikan ke sekretariat'
            ]);
        }

        $data['surat_list'] = $this->db->get("surat")->result();
        $data['current_filter'] = $status;

        $this->load->view('dekan/list_surat_tugas', $data);
    }
    // Di Surat_model.php
public function countByMonthYear($month, $year)
{
    $this->db->where('YEAR(created_at)', $year);
    $this->db->where('MONTH(created_at)', $month);
    return $this->db->count_all_results('surat_tugas');
}

public function countApprovedByMonthYear($month, $year)
{
    $this->db->where('YEAR(created_at)', $year);
    $this->db->where('MONTH(created_at)', $month);
    $this->db->where('status', 'disetujui');
    return $this->db->count_all_results('surat_tugas');
}

public function countRejectedByMonthYear($month, $year)
{
    $this->db->where('YEAR(created_at)', $year);
    $this->db->where('MONTH(created_at)', $month);
    $this->db->where('status', 'ditolak');
    return $this->db->count_all_results('surat_tugas');
}
}
