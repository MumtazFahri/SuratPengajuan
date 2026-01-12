<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    public function get_pin()
    {
        $this->db->select('pin');
        $this->db->from('settings');
        $this->db->where('id', 1); // Sesuai dengan ID di tabel Anda
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->pin;
        }
        
        return '123456'; // Default PIN
    }

    public function getPin()
    {
        return $this->get_pin();
    }

    public function update_pin($new_pin)
    {
        $this->db->where('id', 1);
        return $this->db->update('settings', ['pin' => $new_pin]);
    }

    public function updatePin($new_pin)
    {
        return $this->update_pin($new_pin);
    }
}