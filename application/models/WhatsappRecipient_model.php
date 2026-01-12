<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WhatsappRecipient_model extends CI_Model
{
    private $table = 'whatsapp_recipients';

    // Get all recipients
    public function get_all($active_only = false)
    {
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Get active recipients (untuk broadcast)
    public function get_active_recipients()
    {
        $this->db->where('is_active', 1);
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Get by ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Insert new recipient
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update recipient
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete recipient
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Toggle active status
    public function toggle_active($id)
    {
        $recipient = $this->get_by_id($id);
        if ($recipient) {
            $new_status = $recipient->is_active ? 0 : 1;
            return $this->update($id, ['is_active' => $new_status]);
        }
        return false;
    }

    // Check if nomor exists
    public function nomor_exists($nomor, $exclude_id = null)
    {
        $this->db->where('nomor', $nomor);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->get($this->table)->num_rows() > 0;
    }
}