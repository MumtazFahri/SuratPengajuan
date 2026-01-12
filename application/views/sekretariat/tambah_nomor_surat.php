<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nomor Surat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #f5f7fa; 
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #16A085;
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }
        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s;
        }
        .close-btn:hover {
            background: rgba(255,255,255,0.2);
        }
        .content {
            padding: 30px;
        }
        .info-box {
            background: #e8f6f3;
            border: 1px solid #16A085;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .info-box h4 {
            color: #16A085;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-box p {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        .form-hint {
            color: #7f8c8d;
            font-size: 12px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-cancel {
            background: #95a5a6;
            color: white;
        }
        .btn-cancel:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }
        .btn-submit {
            background: #27ae60;
            color: white;
        }
        .btn-submit:hover {
            background: #229954;
            transform: translateY(-2px);
        }
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><i class="fa-solid fa-file-alt"></i> Tambah Nomor Surat</h2>
            <button class="close-btn" onclick="window.history.back()">&times;</button>
        </div>
        
        <div class="content">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-check-circle"></i> 
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-error">
                    <i class="fa-solid fa-exclamation-circle"></i> 
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            
            <div class="info-box">
                <h4><i class="fa-solid fa-info-circle"></i> Informasi Surat</h4>
                <p><strong>Nama Kegiatan:</strong> <?php echo htmlspecialchars($surat->nama_kegiatan); ?></p>
                <p><strong>Status:</strong> <span style="background:#d4edda;color:#155724;padding:4px 8px;border-radius:4px;font-weight:600"><?php echo $surat->status; ?></span></p>
                <p><strong>Nomor Surat Saat Ini:</strong> 
                    <?php if(empty($surat->nomor_surat) || $surat->nomor_surat === '-'): ?>
                        <span style="color:#e74c3c;font-weight:600">Belum diisi</span>
                    <?php else: ?>
                        <span style="color:#27ae60;font-weight:600"><?php echo htmlspecialchars($surat->nomor_surat); ?></span>
                    <?php endif; ?>
                </p>
            </div>
            
            <form method="POST" action="<?php echo site_url('sekretariat/tambah_nomor_surat/' . $surat->id); ?>">
                <div class="form-group">
                    <label for="nomorSurat">
                        <i class="fa-solid fa-hashtag"></i> Nomor Surat <span style="color:#e74c3c">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nomorSurat" 
                        name="nomor_surat" 
                        class="form-control" 
                        placeholder="Contoh: 001/SKT/FT/2025" 
                        value="<?php echo !empty($surat->nomor_surat) && $surat->nomor_surat !== '-' ? htmlspecialchars($surat->nomor_surat) : ''; ?>"
                        required
                        autocomplete="off"
                        autofocus
                    >
                    <div class="form-hint">
                        <i class="fa-solid fa-lightbulb"></i> 
                        Format yang disarankan: XXX/SKT/FT/Tahun
                    </div>
                </div>
                
                <div class="actions">
                    <button type="button" class="btn btn-cancel" onclick="window.history.back()">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-submit">
                        <i class="fa-solid fa-save"></i> Simpan Nomor Surat
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Auto-focus ke input
        document.getElementById('nomorSurat').focus();
    </script>
</body>
</html>