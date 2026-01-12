/* ===========================================
   SUBMIT DATA - VERSI REVISI LENGKAP
============================================*/
public function submit()
{
    // Enable error reporting untuk debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $post = $this->input->post() ?? [];
    
    // DEBUG: Log post data
    log_message('debug', '=== START UPLOAD PROCESS ===');
    log_message('debug', 'POST Data: ' . print_r($post, true));
    log_message('debug', 'FILES Data: ' . print_r($_FILES, true));

    // Process post data
    foreach ($post as $k => $v) {
        if (is_array($v)) {
            $post[$k] = array_values(array_filter($v, function($x) { 
                return trim($x) !== ""; 
            }));
        } else {
            $post[$k] = ($v === "" || $v === null) ? "-" : $v;
        }
    }

    $tp_safe = $this->safe_date($post['created_at'] ?? null);
    $created_at = ($tp_safe === "-") ? date('Y-m-d') : $tp_safe;

    // PROSES UPLOAD FILE EVIDENCE - VERSI DIPERBAIKI
    $eviden_final = [];
    
    // Handle uploaded files - PERBAIKAN UTAMA
    if (isset($_FILES['eviden']) && is_array($_FILES['eviden']['name'])) {
        $upload_path = FCPATH . 'uploads/eviden/';
        
        // Pastikan folder upload ada
        if (!is_dir($upload_path)) {
            if (!mkdir($upload_path, 0755, true)) {
                log_message('error', '❌ Failed to create upload directory: ' . $upload_path);
                $this->session->set_flashdata('error', 'Gagal membuat folder upload!');
                redirect('surat');
                return;
            }
            log_message('debug', '✅ Created upload directory: ' . $upload_path);
        }
        
        // Cek permission folder
        if (!is_writable($upload_path)) {
            log_message('error', '❌ Upload directory not writable: ' . $upload_path);
            // Coba fix permission
            if (!chmod($upload_path, 0755)) {
                $this->session->set_flashdata('error', 'Folder upload tidak dapat ditulisi! Permission denied.');
                redirect('surat');
                return;
            }
        }
        
        $files_count = count($_FILES['eviden']['name']);
        log_message('debug', '📁 Number of files to upload: ' . $files_count);
        
        // Upload configuration
        $config = [
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|ppt|pptx|zip|rar|txt',
            'max_size' => 10240, // 10MB
            'encrypt_name' => true,
            'overwrite' => false,
            'remove_spaces' => true
        ];
        
        $this->upload->initialize($config);
        
        $successful_uploads = 0;
        
        for ($i = 0; $i < $files_count; $i++) {
            // Skip jika tidak ada file atau error upload
            if (empty($_FILES['eviden']['name'][$i]) || $_FILES['eviden']['error'][$i] !== UPLOAD_ERR_OK) {
                $error_msg = $this->get_upload_error($_FILES['eviden']['error'][$i]);
                log_message('debug', '⏭️ Skipping file ' . $i . ': ' . $error_msg);
                continue;
            }
            
            $original_filename = $_FILES['eviden']['name'][$i];
            $file_size = $_FILES['eviden']['size'][$i];
            
            log_message('debug', "📤 Uploading file {$i}: {$original_filename} (Size: {$file_size} bytes)");
            
            // Setup file data untuk upload library
            $_FILES['userfile']['name'] = $_FILES['eviden']['name'][$i];
            $_FILES['userfile']['type'] = $_FILES['eviden']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['eviden']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $_FILES['eviden']['error'][$i];
            $_FILES['userfile']['size'] = $_FILES['eviden']['size'][$i];
            
            // Cek type file manual untuk security tambahan
            $file_extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
            $allowed_extensions = explode('|', $config['allowed_types']);
            
            if (!in_array($file_extension, $allowed_extensions) && !in_array('*', $allowed_extensions)) {
                log_message('error', "❌ File type not allowed: {$original_filename} (.{$file_extension})");
                continue;
            }
            
            // Cek file size
            if ($file_size > ($config['max_size'] * 1024)) {
                log_message('error', "❌ File too large: {$original_filename} ({$file_size} bytes)");
                continue;
            }
            
            // Proses upload
            if ($this->upload->do_upload('userfile')) {
                $upload_data = $this->upload->data();
                $saved_filename = $upload_data['file_name'];
                $file_path = 'uploads/eviden/' . $saved_filename;
                
                $eviden_final[] = $file_path;
                $successful_uploads++;
                
                log_message('debug', "✅ File uploaded successfully: {$original_filename} -> {$saved_filename}");
                log_message('debug', "📊 Upload details: " . json_encode([
                    'original_name' => $original_filename,
                    'saved_name' => $saved_filename,
                    'file_size' => $upload_data['file_size'],
                    'file_type' => $upload_data['file_type'],
                    'full_path' => $upload_data['full_path']
                ]));
                
                // Verifikasi file benar-benar ada di server
                if (file_exists($upload_data['full_path'])) {
                    log_message('debug', "✅ File verified on server: {$upload_data['full_path']}");
                } else {
                    log_message('error', "❌ Uploaded file not found on server: {$upload_data['full_path']}");
                }
                
            } else {
                $error = $this->upload->display_errors();
                log_message('error', "❌ Upload failed for {$original_filename}: {$error}");
                
                // Log detail error
                log_message('error', "📋 File details: " . json_encode([
                    'name' => $_FILES['userfile']['name'],
                    'type' => $_FILES['userfile']['type'],
                    'tmp_name' => $_FILES['userfile']['tmp_name'],
                    'error' => $_FILES['userfile']['error'],
                    'size' => $_FILES['userfile']['size']
                ]));
            }
        }
        
        log_message('debug', "📈 Upload summary: {$successful_uploads}/{$files_count} files uploaded successfully");
        
    } else {
        log_message('debug', '📭 No files found in $_FILES[eviden] or invalid file structure');
        if (isset($_FILES['eviden']['error'])) {
            log_message('debug', '❌ Upload errors: ' . json_encode($_FILES['eviden']['error']));
        }
    }
    
    // Handle existing evidence URLs dari form (jika edit)
    $existing_eviden = $post['existing_eviden'] ?? [];
    if (!empty($existing_eviden)) {
        if (is_array($existing_eviden)) {
            foreach ($existing_eviden as $existing_file) {
                if (!empty($existing_file) && is_string($existing_file)) {
                    $eviden_final[] = $existing_file;
                }
            }
        } else if (is_string($existing_eviden) && !empty($existing_eviden)) {
            $eviden_final[] = $existing_eviden;
        }
        log_message('debug', '➕ Existing evidence added: ' . json_encode($existing_eviden));
    }

    // Remove duplicates and empty values
    $eviden_final = array_values(array_unique(array_filter($eviden_final)));
    
    log_message('debug', '📦 Final evidence array: ' . json_encode($eviden_final));
    log_message('debug', '🔢 Total evidence files: ' . count($eviden_final));

    // PREPARE DATA FOR DATABASE
    $data = [
        'user_id' => $post['user_id'] ?? '-',
        'nama_kegiatan' => $post['nama_kegiatan'] ?? '-',
        'jenis_date' => $post['jenis_date'] ?? '-',
        'created_at' => $created_at,
        'tanggal_kegiatan' => $this->safe_date($post['tanggal_kegiatan'] ?? null),
        'akhir_kegiatan' => $this->safe_date($post['akhir_kegiatan'] ?? null),
        'periode_penugasan' => $this->safe_date($post['periode_penugasan'] ?? null),
        'akhir_periode_penugasan' => $this->safe_date($post['akhir_periode_penugasan'] ?? null),
        'periode_value' => $post['periode_value'] ?? '-',
        'tempat_kegiatan' => $post['tempat_kegiatan'] ?? '-',
        'penyelenggara' => $post['penyelenggara'] ?? '-',
        'jenis_pengajuan' => $post['jenis_pengajuan'] ?? '-',
        'lingkup_penugasan' => $post['lingkup_penugasan'] ?? '-',
        'jenis_penugasan_perorangan' => $post['jenis_penugasan_perorangan'] ?? '-',
        'penugasan_lainnya_perorangan' => $post['penugasan_lainnya_perorangan'] ?? '-',
        'jenis_penugasan_kelompok' => $post['jenis_penugasan_kelompok'] ?? '-',
        'penugasan_lainnya_kelompok' => $post['penugasan_lainnya_kelompok'] ?? '-',
        'format' => $post['format'] ?? '-',
        'nip' => isset($post['nip']) ? json_encode($post['nip']) : '[]',
        'eviden' => !empty($eviden_final) ? json_encode($eviden_final) : '[]',
        'status' => 'pengajuan',
        'created_at' => date('Y-m-d H:i:s'),
    ];

    log_message('debug', '💾 Data to be saved to database: ' . json_encode($data));

    // SAVE TO DATABASE
    try {
        $result = $this->Surat_model->insert_surat($data);
        
        if ($result) {
            $inserted_id = $this->db->insert_id();
            log_message('debug', "✅ Data surat berhasil disimpan ke database dengan ID: {$inserted_id}");
            
            // Set success message based on upload results
            $message = 'Data berhasil disimpan!';
            if (count($eviden_final) > 0) {
                $message .= ' ' . count($eviden_final) . ' file evidence berhasil diupload.';
            } else {
                $message .= ' Tidak ada file evidence yang diupload.';
            }
            
            $this->session->set_flashdata('success', $message);
        } else {
            log_message('error', '❌ Gagal menyimpan data surat ke database');
            $this->session->set_flashdata('error', 'Gagal menyimpan data ke database!');
        }
    } catch (Exception $e) {
        log_message('error', '❌ Database exception: ' . $e->getMessage());
        $this->session->set_flashdata('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
    }

    log_message('debug', '=== END UPLOAD PROCESS ===');
    redirect('surat');
}

/* ===========================================
   HELPER: GET UPLOAD ERROR MESSAGE
============================================*/
private function get_upload_error($error_code)
{
    $upload_errors = [
        UPLOAD_ERR_OK => 'No error',
        UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE in HTML form',
        UPLOAD_ERR_PARTIAL => 'File only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
    ];
    
    return $upload_errors[$error_code] ?? 'Unknown upload error';
}