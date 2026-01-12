
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_model extends CI_Model {

    public function get_dosen_by_ids($ids)
    {
        if (!$ids || count($ids) == 0) return [];

        $this->db->where_in('id', $ids);
        return $this->db->get('list_dosen')->result();
    }
}
