<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

    public function getNotifByUser($userId)
    {
        return $this->db->where('user_id', $userId)
                        ->where('is_read', 0)
                        ->order_by('created_at', 'DESC')
                        ->limit(10)
                        ->get('notifikasi')
                        ->result();
    }
}
