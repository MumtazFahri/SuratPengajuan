<?php if 
(!defined('BASEPATH')) exit('No direct script access allowed');

class Qr {

    public function generate($text, $filename = false, $size = 4, $margin = 1)
    {
        include APPPATH . 'third_party/phpqrcode/qrlib.php';

        // Jika tanpa filename → tampilkan langsung ke browser
        if (!$filename) {
            QRcode::png($text, null, QR_ECLEVEL_L, $size, $margin);
            return;
        }

        // Jika ada filename → simpan ke file
        QRcode::png($text, $filename, QR_ECLEVEL_L, $size, $margin);
        return $filename;
    }

}
