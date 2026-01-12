<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress_model extends CI_Model {

    public function get_progress() {
        $query = $this->db->get('progress');
        return $query->result();
    }
}
