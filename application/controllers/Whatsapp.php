<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp extends CI_Controller
{
    private $server_path = FCPATH . 'wa-server/wa-server.js';
    private $node_path = 'node';
    private $pid_file = 'C:\xampp\htdocs\wa-server\server.pid';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url']);
        $this->load->library('session');
        $this->load->model('WhatsappRecipient_model');
    }

    public function dashboard()
    {
        $data['title'] = 'WhatsApp Server Control Panel';
        $data['server_status'] = $this->check_server_status();
        $data['is_running'] = $this->is_server_running();
        $data['recipients'] = $this->WhatsappRecipient_model->get_all();
        
        $this->load->view('whatsapp_dashboard', $data);
    }

    private function is_server_running()
    {
        $api_url = 'http://localhost:3000/status';
        
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return ($httpcode == 200);
    }

    private function check_server_status()
    {
        $api_url = 'http://localhost:3000/status';
        
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 200) {
            $data = json_decode($response, true);
            return [
                'online' => true,
                'whatsapp_status' => $data['whatsapp'] ?? 'unknown',
                'ready' => $data['ready'] ?? false
            ];
        } else {
            return [
                'online' => false,
                'whatsapp_status' => 'offline',
                'ready' => false
            ];
        }
    }

    public function get_status()
    {
        header('Content-Type: application/json');
        
        $status = $this->check_server_status();
        $status['is_running'] = $this->is_server_running();
        
        echo json_encode($status);
    }

    public function start_server()
    {
        header('Content-Type: application/json');
        
        try {
            if ($this->is_server_running()) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Server sudah berjalan'
                ]);
                return;
            }
            
            $server_path = FCPATH . 'wa-server/wa-server.js';
            
            if (!file_exists($server_path)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'File wa-server.js tidak ditemukan di: ' . $server_path
                ]);
                return;
            }
            
            $command = 'start /B node "' . $server_path . '" > NUL 2>&1';
            pclose(popen($command, 'r'));
            
            sleep(3);
            
            if ($this->is_server_running()) {
                log_message('info', 'WhatsApp server started successfully');
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Server berhasil dijalankan'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Server gagal start. Coba jalankan manual: node wa-server.js'
                ]);
            }
            
        } catch (Exception $e) {
            log_message('error', 'Error starting server: ' . $e->getMessage());
            
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // ✅ UPDATE: Stop server + Logout WhatsApp
    public function stop_server()
    {
        header('Content-Type: application/json');
        
        try {
            if (!$this->is_server_running()) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Server tidak sedang berjalan'
                ]);
                return;
            }
            
            // ✅ LOGOUT WhatsApp dulu sebelum stop server
            $this->logout_whatsapp_internal();
            
            sleep(1); // Tunggu logout selesai
            
            // Kill process node.js
            $command = 'taskkill /F /IM node.exe > NUL 2>&1';
            exec($command);
            
            sleep(2);
            
            if (!$this->is_server_running()) {
                log_message('info', 'WhatsApp server stopped and logged out successfully');
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Server berhasil dihentikan dan WhatsApp logout'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal menghentikan server'
                ]);
            }
            
        } catch (Exception $e) {
            log_message('error', 'Error stopping server: ' . $e->getMessage());
            
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // ✅ FUNGSI BARU: Logout WhatsApp (untuk button)
    public function logout_whatsapp()
    {
        header('Content-Type: application/json');
        
        try {
            if (!$this->is_server_running()) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Server tidak sedang berjalan'
                ]);
                return;
            }
            
            $result = $this->logout_whatsapp_internal();
            
            if ($result['success']) {
                log_message('info', 'WhatsApp logged out successfully');
            }
            
            echo json_encode($result);
            
        } catch (Exception $e) {
            log_message('error', 'Error logout WhatsApp: ' . $e->getMessage());
            
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    // ✅ Helper function untuk logout (digunakan internal)
    private function logout_whatsapp_internal()
    {
        $api_url = 'http://localhost:3000/logout';
        
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 200) {
            $data = json_decode($response, true);
            return $data;
        } else {
            return [
                'success' => false,
                'message' => 'Gagal logout WhatsApp'
            ];
        }
    }

    public function test_send()
    {
        header('Content-Type: application/json');
        
        $nomor = $this->input->post('nomor') ?? '6282119509135';
        $pesan = $this->input->post('pesan') ?? '🧪 Test pesan dari Dashboard - ' . date('d M Y H:i:s');
        
        $api_url = 'http://localhost:3000/send-message';
        
        $data = json_encode([
            'nomor' => $nomor,
            'pesan' => $pesan
        ]);
        
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 200) {
            echo $response;
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Server tidak merespon'
            ]);
        }
    }

    public function restart()
    {
        header('Content-Type: application/json');
        
        try {
            if ($this->is_server_running()) {
                $command = 'taskkill /F /IM node.exe > NUL 2>&1';
                exec($command);
                sleep(2);
            }
            
            $server_path = FCPATH . 'wa-server/wa-server.js';
            $command = 'start /B node "' . $server_path . '" > NUL 2>&1';
            pclose(popen($command, 'r'));
            
            sleep(3);
            
            if ($this->is_server_running()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Server berhasil di-restart'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Gagal restart server'
                ]);
            }
            
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    // RECIPIENT MANAGEMENT
    public function get_recipients()
    {
        header('Content-Type: application/json');
        
        $recipients = $this->WhatsappRecipient_model->get_all();
        
        echo json_encode([
            'success' => true,
            'data' => $recipients
        ]);
    }

    public function add_recipient()
    {
        header('Content-Type: application/json');
        
        $nama = $this->input->post('nama');
        $nomor = $this->input->post('nomor');
        $jabatan = $this->input->post('jabatan');
        
        if (empty($nama) || empty($nomor)) {
            echo json_encode([
                'success' => false,
                'message' => 'Nama dan nomor harus diisi'
            ]);
            return;
        }
        
        $nomor_clean = preg_replace('/\D/', '', $nomor);
        
        if ($this->WhatsappRecipient_model->nomor_exists($nomor_clean)) {
            echo json_encode([
                'success' => false,
                'message' => 'Nomor WhatsApp sudah terdaftar'
            ]);
            return;
        }
        
        $data = [
            'nama' => $nama,
            'nomor' => $nomor_clean,
            'jabatan' => $jabatan,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->WhatsappRecipient_model->insert($data)) {
            log_message('info', 'New recipient added: ' . $nama . ' (' . $nomor_clean . ')');
            
            echo json_encode([
                'success' => true,
                'message' => 'Penerima berhasil ditambahkan'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menambahkan penerima'
            ]);
        }
    }

    public function update_recipient()
    {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $nomor = $this->input->post('nomor');
        $jabatan = $this->input->post('jabatan');
        
        if (empty($id) || empty($nama) || empty($nomor)) {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak lengkap'
            ]);
            return;
        }
        
        $nomor_clean = preg_replace('/\D/', '', $nomor);
        
        if ($this->WhatsappRecipient_model->nomor_exists($nomor_clean, $id)) {
            echo json_encode([
                'success' => false,
                'message' => 'Nomor WhatsApp sudah digunakan recipient lain'
            ]);
            return;
        }
        
        $data = [
            'nama' => $nama,
            'nomor' => $nomor_clean,
            'jabatan' => $jabatan,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->WhatsappRecipient_model->update($id, $data)) {
            log_message('info', 'Recipient updated: ID ' . $id);
            
            echo json_encode([
                'success' => true,
                'message' => 'Penerima berhasil diupdate'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengupdate penerima'
            ]);
        }
    }

    public function delete_recipient()
    {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id');
        
        if (empty($id)) {
            echo json_encode([
                'success' => false,
                'message' => 'ID tidak valid'
            ]);
            return;
        }
        
        $total_recipients = count($this->WhatsappRecipient_model->get_all());
        if ($total_recipients <= 1) {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak bisa hapus. Minimal harus ada 1 penerima aktif.'
            ]);
            return;
        }
        
        if ($this->WhatsappRecipient_model->delete($id)) {
            log_message('info', 'Recipient deleted: ID ' . $id);
            
            echo json_encode([
                'success' => true,
                'message' => 'Penerima berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus penerima'
            ]);
        }
    }

    public function toggle_recipient()
    {
        header('Content-Type: application/json');
        
        $id = $this->input->post('id');
        
        if (empty($id)) {
            echo json_encode([
                'success' => false,
                'message' => 'ID tidak valid'
            ]);
            return;
        }
        
        $active_count = count($this->WhatsappRecipient_model->get_active_recipients());
        $recipient = $this->WhatsappRecipient_model->get_by_id($id);
        
        if ($active_count <= 1 && $recipient->is_active == 1) {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak bisa nonaktifkan. Minimal harus ada 1 penerima aktif.'
            ]);
            return;
        }
        
        if ($this->WhatsappRecipient_model->toggle_active($id)) {
            $new_status = $recipient->is_active ? 'dinonaktifkan' : 'diaktifkan';
            
            echo json_encode([
                'success' => true,
                'message' => 'Penerima berhasil ' . $new_status
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal mengubah status'
            ]);
        }
    }
}