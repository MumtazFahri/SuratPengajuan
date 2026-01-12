<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WhatsApp Helper untuk mengirim notifikasi
 * Menggunakan Fonnte API (bisa diganti dengan provider lain)
 */

if (!function_exists('send_whatsapp_notification')) {
    /**
     * Mengirim notifikasi WhatsApp
     * 
     * @param string $phone - Nomor WhatsApp (format: 628123456789)
     * @param string $message - Pesan yang akan dikirim
     * @return array - Response dari API
     */
    function send_whatsapp_notification($phone, $message) {
        $CI =& get_instance();
        
        // Konfigurasi API (sebaiknya simpan di config/whatsapp.php)
        $api_url = 'https://api.fonnte.com/send';
        $api_token = 'YOUR_FONNTE_API_TOKEN'; // Ganti dengan token Anda
        
        // Format nomor telepon
        $phone = format_phone_number($phone);
        
        // Data yang akan dikirim
        $data = array(
            'target' => $phone,
            'message' => $message,
            'countryCode' => '62' // Kode negara Indonesia
        );
        
        // Kirim request ke API
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $api_token,
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        
        curl_close($curl);
        
        // Log response
        log_message('info', 'WhatsApp Send to ' . $phone . ': ' . $response);
        
        return array(
            'success' => ($http_code == 200),
            'response' => json_decode($response, true),
            'http_code' => $http_code,
            'error' => $error
        );
    }
}

if (!function_exists('format_phone_number')) {
    /**
     * Format nomor telepon ke format WhatsApp
     * 
     * @param string $phone - Nomor telepon
     * @return string - Nomor terformat (628xxx)
     */
    function format_phone_number($phone) {
        // Hapus semua karakter non-digit
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Jika diawali dengan 0, ganti dengan 62
        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // Jika belum diawali dengan 62, tambahkan
        if (substr($phone, 0, 2) != '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
}

if (!function_exists('send_whatsapp_with_image')) {
    /**
     * Mengirim WhatsApp dengan gambar
     * 
     * @param string $phone - Nomor WhatsApp
     * @param string $message - Pesan
     * @param string $image_url - URL gambar
     * @return array - Response
     */
    function send_whatsapp_with_image($phone, $message, $image_url) {
        $api_url = 'https://api.fonnte.com/send';
        $api_token = 'YOUR_FONNTE_API_TOKEN';
        
        $phone = format_phone_number($phone);
        
        $data = array(
            'target' => $phone,
            'message' => $message,
            'url' => $image_url,
            'countryCode' => '62'
        );
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $api_token,
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
        
        return array(
            'success' => ($http_code == 200),
            'response' => json_decode($response, true)
        );
    }
}

if (!function_exists('send_whatsapp_broadcast')) {
    /**
     * Mengirim broadcast ke multiple nomor
     * 
     * @param array $phones - Array nomor telepon
     * @param string $message - Pesan
     * @return array - Response
     */
    function send_whatsapp_broadcast($phones, $message) {
        $results = array();
        
        foreach ($phones as $phone) {
            $result = send_whatsapp_notification($phone, $message);
            $results[] = array(
                'phone' => $phone,
                'status' => $result['success'] ? 'sent' : 'failed',
                'response' => $result
            );
            
            // Delay 1 detik untuk menghindari spam
            sleep(1);
        }
        
        return $results;
    }
}