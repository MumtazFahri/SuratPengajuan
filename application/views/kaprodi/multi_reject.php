<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Reject - Dashboard Kaprodi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .navbar { background: #8E44AD; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar h2 { font-size: 20px; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .card { background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); margin-bottom: 20px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #e74c3c; }
        .card-header h3 { color: #2c3e50; font-size: 22px; }
        .back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s; margin-bottom: 20px; }
        .back-btn:hover { background: #2980b9; transform: translateY(-2px); }
        .btn { padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-danger:hover { background: #c0392b; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #ecf0f1; text-align: left; }
        thead { background: #e74c3c; color: white; }
        tbody tr:hover { background: #f8f9fa; }
        .selected-count { background: #ffeaea; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #e74c3c; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #2c3e50; }
        .form-control { width: 100%; padding: 12px 15px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: border-color 0.3s; }
        .form-control:focus { outline: none; border-color: #e74c3c; box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1); }
        textarea.form-control { min-height: 120px; resize: vertical; }
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .checkbox-cell { width: 50px; text-align: center; }
        .action-buttons { display: flex; gap: 10px; margin-top: 20px; }
        .empty-state { text-align: center; padding: 40px; color: #7f8c8d; }
        .empty-state i { font-size: 64px; margin-bottom: 15px; opacity: 0.3; }
        .rejection-reason { background: #fff5f5; border: 1px solid #f8cccc; padding: 15px; border-radius: 8px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2><i class="fa-solid fa-user-tie"></i> Dashboard Kaprodi - Multi Reject</h2>
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
                <h3><i class="fa-solid fa-ban"></i> Multi Reject Pengajuan</h3>
                <div class="selected-count" id="selectedCount">
                    <strong><i class="fa-solid fa-list-check"></i> <span id="countText">0</span> pengajuan dipilih</strong>
                </div>
            </div>

            <?php if(!empty($surat_list)): ?>
            <form id="multiRejectForm" method="POST" action="<?= base_url('kaprodi/process_multi_reject') ?>">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                
                <div class="form-group">
                    <label for="rejection_notes"><i class="fa-solid fa-comment-dots"></i> Alasan Penolakan *</label>
                    <textarea id="rejection_notes" name="rejection_notes" class="form-control" 
                              placeholder="Masukkan alasan penolakan untuk semua pengajuan yang dipilih..." 
                              required></textarea>
                    <small style="color: #6c757d; margin-top: 5px; display: block;">
                        <i class="fa-solid fa-info-circle"></i> Alasan ini akan dikirim ke semua dosen yang pengajuannya ditolak
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
                    <button type="submit" class="btn btn-danger" id="rejectButton" disabled>
                        <i class="fa-solid fa-ban"></i> Reject Selected
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
            const rejectButton = document.getElementById('rejectButton');
            
            countText.textContent = selectedCount;
            
            if (selectedCount > 0) {
                rejectButton.disabled = false;
            } else {
                rejectButton.disabled = true;
            }
            
            // Update select all checkbox
            const selectAll = document.getElementById('selectAll');
            selectAll.checked = selectedCount === checkboxes.length;
        }

        // Form validation
        document.getElementById('multiRejectForm').addEventListener('submit', function(e) {
            const selectedCount = document.querySelectorAll('.row-checkbox:checked').length;
            const rejectionNotes = document.getElementById('rejection_notes').value.trim();
            
            if (selectedCount === 0) {
                e.preventDefault();
                alert('Pilih minimal satu pengajuan untuk ditolak');
                return;
            }
            
            if (!rejectionNotes) {
                e.preventDefault();
                alert('Alasan penolakan harus diisi');
                return;
            }
            
            if (!confirm(`Apakah Anda yakin ingin menolak ${selectedCount} pengajuan?`)) {
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