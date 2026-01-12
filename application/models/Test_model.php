<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model {

    private $table = 'surat';

    public function get_all() {
        return $this->db->order_by('id','DESC')->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete($this->table);
    }
}
