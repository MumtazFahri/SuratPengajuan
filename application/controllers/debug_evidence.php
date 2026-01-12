<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug_evidence extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function index() {
        echo "<h1>Debug Evidence Data</h1>";
        
        // Query semua data surat
        $query = $this->db->get('surat');
        $surat_list = $query->result();
        
        foreach ($surat_list as $surat) {
            echo "<h3>Surat ID: {$surat->id} - {$surat->nama_kegiatan}</h3>";
            echo "<p><strong>Evidence Raw:</strong> " . htmlspecialchars($surat->eviden) . "</p>";
            
            // Process evidence
            $eviden_processed = $this->process_evidence_data($surat->eviden);
            echo "<p><strong>Evidence Processed:</strong> " . print_r($eviden_processed, true) . "</p>";
            
            // Validate URLs
            echo "<p><strong>Valid URLs:</strong>";
            if (!empty($eviden_processed)) {
                foreach ($eviden_processed as $file) {
                    if (is_string($file)) {
                        $valid_url = $this->validate_file_url($file);
                        echo "<br> - Original: " . htmlspecialchars($file);
                        echo "<br> - Valid: " . htmlspecialchars($valid_url);
                        echo "<br> - File exists: " . (file_exists(FCPATH . $file) ? 'YES' : 'NO');
                        echo "<hr>";
                    }
                }
            }
            echo "</p>";
        }
    }
    
    private function process_evidence_data($evidence) {
        if (!$evidence || $evidence === '-' || $evidence === 'null' || $evidence === '[]') {
            return [];
        }
        
        if (is_array($evidence)) {
            return array_filter($evidence, function($item) {
                return !empty($item) && $item !== '-' && $item !== 'null' && is_string($item);
            });
        }
        
        if (is_string($evidence)) {
            try {
                $decoded = json_decode($evidence, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    return array_filter($decoded, function($item) {
                        return !empty($item) && $item !== '-' && $item !== 'null' && is_string($item);
                    });
                }
            } catch (Exception $e) {}
            
            return [$evidence];
        }
        
        return [];
    }
    
    private function validate_file_url($url) {
        if (!$url || !is_string($url)) return null;
        
        $url = trim($url);
        if ($url === '') return null;
        
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return $url;
        }
        
        $base_url = rtrim(base_url(), '/');
        
        if (strpos($url, '/') === 0) {
            return $base_url . $url;
        } else {
            return $base_url . '/' . ltrim($url, '/');
        }
    }
}