<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['whatsapp'] = array(
    'api_token' => 'YOUR_FONNTE_API_TOKEN_HERE', // Ganti dengan token Anda
    'sender' => 'SistemSurat',
    'enabled' => true,
    'admin_numbers' => array(
        '6282119509135', // Contoh nomor admin 1
        '6282295709229'  // Contoh nomor admin 2
    )
);