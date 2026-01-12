<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>CRUD Surat - CodeIgniter 3</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
  <h2 class="mb-4">Data Surat</h2>

  <?php
  // Jika ada flashdata sukses
  if ($this->session->flashdata('success')) {
      echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>';
  }

  // Jika ada flashdata error
  if ($this->session->flashdata('error')) {
      echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
  }

  // Jika edit mode, data surat yang diedit ada di $edit_surat
  $is_edit = isset($edit_surat);
  ?>

  <!-- FORM TAMBAH / EDIT -->
  <div class="card mb-4">
    <div class="card-header">
      <?= $is_edit ? 'Edit Surat' : 'Tambah Surat' ?>
    </div>
    <div class="card-body">
      <form action="<?= $is_edit ? site_url('surat/update/'.$edit_surat->id) : site_url('surat/store') ?>" method="post">
        <div class="mb-3">
          <label class="form-label">Nomor Surat</label>
          <input type="text" name="nomor_surat" class="form-control" required
                 value="<?= $is_edit ? htmlspecialchars($edit_surat->nomor_surat) : '' ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Perihal</label>
          <input type="text" name="perihal" class="form-control" required
                 value="<?= $is_edit ? htmlspecialchars($edit_surat->perihal) : '' ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Tanggal</label>
          <input type="date" name="tanggal" class="form-control" required
                 value="<?= $is_edit ? $edit_surat->tanggal : '' ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Keterangan</label>
          <textarea name="keterangan" class="form-control"><?= $is_edit ? htmlspecialchars($edit_surat->keterangan) : '' ?></textarea>
        </div>
        <?php if ($is_edit): ?>
          <a href="<?= site_url('surat') ?>" class="btn btn-secondary">Batal</a>
          <button type="submit" class="btn btn-primary">Update</button>
        <?php else: ?>
          <button type="submit" class="btn btn-success">Simpan</button>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <!-- TABEL DATA SURAT -->
  <table class="table table-bordered table-striped">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>Nomor Surat</th>
        <th>Perihal</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th width="160">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($surat)): ?>
        <?php foreach ($surat as $s): ?>
          <tr>
            <td><?= $s->id ?></td>
            <td><?= htmlspecialchars($s->nomor_surat) ?></td>
            <td><?= htmlspecialchars($s->perihal) ?></td>
            <td><?= $s->tanggal ?></td>
            <td><?= htmlspecialchars($s->keterangan) ?></td>
            <td>
              <a href="<?= site_url('surat/edit/'.$s->id) ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="<?= site_url('surat/delete/'.$s->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus surat ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="6" class="text-center">Belum ada data surat</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
