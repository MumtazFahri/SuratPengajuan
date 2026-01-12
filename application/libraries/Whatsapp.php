<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whatsapp
{
    private $ci;
    
    public function __construct()
    {
        $this->ci =& get_instance();
        log_message('debug', 'WhatsApp Library loaded');
    }
    
    /**
     * Kirim broadcast ke nomor admin utama
     */
    public function broadcast($phones, $message)
    {
        log_message('info', 'WhatsApp broadcast initiated');
        
        if (!is_array($phones) || empty($phones)) {
            log_message('error', 'WhatsApp: No phone numbers provided');
            return [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'error' => 'No phone numbers'
            ];
        }
        
        log_message('info', 'Sending to ' . count($phones) . ' admin numbers');
        
        // SIMULASI KIRIM - UNTUK TESTING
        // Hapus kode ini jika sudah pakai API asli
        
        $success_count = 0;
        $failed_count = 0;
        
        foreach ($phones as $phone) {
            $phone = $this->format_phone($phone);
            
            if (empty($phone)) {
                log_message('warning', 'Invalid phone number format: ' . $phone);
                $failed_count++;
                continue;
            }
            
            log_message('info', 'Sending WhatsApp to: ' . $phone);
            
            // ============================================
            // UNCOMMENT KODE DI BAWAH INI UNTUK API ASLI
            // ============================================
            /*
            $api_result = $this->send_via_api($phone, $message);
            
            if ($api_result['status']) {
                $success_count++;
                log_message('info', 'Success to: ' . $phone);
            } else {
                $failed_count++;
                log_message('error', 'Failed to: ' . $phone . ' - ' . ($api_result['error'] ?? 'Unknown'));
            }
            */
            
            // ============================================
            // SIMULASI BERHASIL - UNTUK TESTING
            // ============================================
            $success_count++;
            log_message('info', '[SIMULASI] WhatsApp sent to: ' . $phone);
            
            // Delay kecil
            usleep(100000); // 0.1 detik
        }
        
        return [
            'total' => count($phones),
            'success' => $success_count,
            'failed' => $failed_count
        ];
    }
    
    /**
     * Kirim via API (Fonnte/Wablas/WhatsApp Business API)
     */
    private function send_via_api($phone, $message)
    {
        // ================================
        // KONFIGURASI API ANDA
        // ================================
        $api_url = 'https://api.fonnte.com/send';
        $api_token = 'YOUR_API_TOKEN_HERE'; // GANTI DENGAN TOKEN ASLI
        
        $data = [
            'target' => $phone,
            'message' => $message,
            'countryCode' => '62',
        ];
        
        $ch = curl_init();
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                'Authorization: ' . $api_token
            ],
        ]);
        
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        log_message('debug', 'API Response: ' . $response);
        log_message('debug', 'HTTP Code: ' . $http_code);
        
        if ($error) {
            return ['status' => false, 'error' => $error];
        }
        
        $result = json_decode($response, true);
        
        return [
            'status' => isset($result['status']) && $result['status'] == true,
            'data' => $result
        ];
    }
    
    /**
     * Format nomor telepon
     */
    private function format_phone($phone)
    {
        if (empty($phone)) return '';
        
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        if (empty($phone)) return '';
        
        // Jika diawali 0, ganti dengan 62
        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika diawali 8, tambahkan 62
        if (substr($phone, 0, 1) == '8' && substr($phone, 0, 2) != '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
    
    /**
     * Format pesan sederhana untuk admin utama
     */
    public function format_admin_message($surat_id, $judul, $jenis, $waktu)
    {
        $message = "📋 *NOTIFIKASI SURAT BARU*\n\n";
        $message .= "ID: #{$surat_id}\n";
        $message .= "Judul: {$judul}\n";
        $message .= "Jenis: {$jenis}\n";
        $message .= "Dibuat: {$waktu}\n\n";
        $message .= "_Sistem Pengajuan Surat_";
        
        return $message;
    }
}