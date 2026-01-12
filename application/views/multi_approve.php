<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Approve - Dashboard Kaprodi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .navbar { background: #8E44AD; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar h2 { font-size: 20px; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .card { background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); margin-bottom: 20px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #8E44AD; }
        .card-header h3 { color: #2c3e50; font-size: 22px; }
        .back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s; margin-bottom: 20px; }
        .back-btn:hover { background: #2980b9; transform: translateY(-2px); }
        .btn { padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
        .btn-primary { background: #27ae60; color: white; }
        .btn-primary:hover { background: #229954; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-danger:hover { background: #c0392b; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #ecf0f1; text-align: left; }
        thead { background: #8E44AD; color: white; }
        tbody tr:hover { background: #f8f9fa; }
        .selected-count { background: #e8f5e8; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #27ae60; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50; }
        .form-control { width: 100%; padding: 12px 15px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s; }
        .form-control:focus { outline: none; border-color: #8E44AD; box-shadow: 0 0 0 3px rgba(142, 68, 173, 0.1); }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .checkbox-cell { width: 50px; text-align: center; }
        .action-buttons { display: flex; gap: 10px; margin-top: 20px; }
        .empty-state { text-align: center; padding: 40px; color: #7f8c8d; }
        .empty-state i { font-size: 64px; margin-bottom: 15px; opacity: 0.3; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2><i class="fa-solid fa-user-tie"></i> Dashboard Kaprodi - Multi Approve</h2>
    </div>

    <div class="container">
        <a href="<?= base_url('kaprodi/pending') ?>" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Pengajuan Menunggu
        </a>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h3><i class="fa-solid fa-check-double"></i> Multi Approve Pengajuan</h3>
                <div class="selected-count" id="selectedCount">
                    <strong><i class="fa-solid fa-list-check"></i> <span id="countText">0</span> pengajuan dipilih</strong>
                </div>
            </div>

            <?php if(!empty($surat_list)): ?>
            <form id="multiApproveForm" method="POST" action="<?= base_url('kaprodi/process_multi_approve') ?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div class="form-group">
                    <label for="nomor_surat"><i class="fa-solid fa-file-alt"></i> Nomor Surat *</label>
                    <input type="text" id="nomor_surat" name="nomor_surat" class="form-control" 
                           placeholder="Contoh: 001/SKT/FT/2025" required>
                    <small style="color: #6c757d; margin-top: 5px; display: block;">
                        <i class="fa-solid fa-info-circle"></i> Format: Nomor/SKT/FT/Tahun
                    </small>
                </div>

                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th class="checkbox-cell">
                                    <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                </th>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Penyelenggara</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Jenis</th>
                                <th>Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($surat_list as $s): ?>
                            <tr>
                                <td class="checkbox-cell">
                                    <input type="checkbox" name="selected_ids[]" value="<?= $s->id ?>" 
                                           class="row-checkbox" onchange="updateSelectedCount()">
                                </td>
                                <td><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($s->nama_kegiatan) ?></strong></td>
                                <td><?= htmlspecialchars($s->penyelenggara) ?></td>
                                <td><?= date('d M Y', strtotime($s->tanggal_kegiatan)) ?></td>
                                <td><?= htmlspecialchars($s->jenis_pengajuan) ?></td>
                                <td><?= htmlspecialchars($s->nama_dosen) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary" id="approveButton" disabled>
                        <i class="fa-solid fa-check-double"></i> Approve Selected
                    </button>
                    <a href="<?= base_url('kaprodi/pending') ?>" class="btn btn-secondary">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                </div>
            </form>
            <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-inbox"></i>
                <h3>Tidak ada pengajuan yang tersedia</h3>
                <p>Semua pengajuan telah diproses atau tidak ada data yang memenuhi kriteria.</p>
                <a href="<?= base_url('kaprodi/pending') ?>" class="btn btn-secondary" style="margin-top: 15px;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll').checked;
            const checkboxes = document.querySelectorAll('.row-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll;
            });
            
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            const selectedCount = document.querySelectorAll('.row-checkbox:checked').length;
            const countText = document.getElementById('countText');
            const approveButton = document.getElementById('approveButton');
            
            countText.textContent = selectedCount;
            
            if (selectedCount > 0) {
                approveButton.disabled = false;
            } else {
                approveButton.disabled = true;
            }
            
            // Update select all checkbox
            const selectAll = document.getElementById('selectAll');
            selectAll.checked = selectedCount === checkboxes.length;
        }

        // Form validation
        document.getElementById('multiApproveForm').addEventListener('submit', function(e) {
            const selectedCount = document.querySelectorAll('.row-checkbox:checked').length;
            const nomorSurat = document.getElementById('nomor_surat').value.trim();
            
            if (selectedCount === 0) {
                e.preventDefault();
                alert('Pilih minimal satu pengajuan untuk disetujui');
                return;
            }
            
            if (!nomorSurat) {
                e.preventDefault();
                alert('Nomor surat harus diisi');
                return;
            }
            
            if (!confirm(`Apakah Anda yakin ingin menyetujui ${selectedCount} pengajuan?`)) {
                e.preventDefault();
            }
        });

        // Initialize count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateSelectedCount();
        });
    </script>
</body>
</html>