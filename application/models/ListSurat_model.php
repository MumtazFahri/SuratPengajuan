<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListSurat_model extends CI_Model {

    protected $table = 'list_dosen'; // ⬅️ FIX WAJIB

    /* ================================
       Ambil detail surat + data dekan
    ==================================*/
    public function getDetailSurat($id_surat)
    {
        $this->db->select('
            surat.*,
            list_dosen.nama_dosen AS dekan_nama,
            list_dosen.jabatan AS dekan_jabatan,
            list_dosen.divisi AS dekan_divisi
        ');
        $this->db->from('surat');
        $this->db->join('list_dosen', 'list_dosen.nip = surat.dekan_nip', 'left');
        $this->db->where('surat.id', $id_surat);

        return $this->db->get()->row_array();  
    }

    /* ================================
       Ambil 1 dosen berdasarkan NIP
    ==================================*/
    public function get_by_nip($nip)
    {
        return $this->db->get_where($this->table, ['nip' => $nip])->row();
    }

    /* ======================================
       Ambil banyak dosen berdasarkan array NIP
       Output: array dengan key = NIP
    =======================================*/
    public function get_many_by_nip(array $nip_list)
    {
        if (empty($nip_list)) return [];

        $this->db->where_in('nip', $nip_list);
        $query = $this->db->get($this->table);

        $result = [];
        foreach ($query->result() as $row) {
            $result[$row->nip] = $row;
        }

        return $result;
    }
}
