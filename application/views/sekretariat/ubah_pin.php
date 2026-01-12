<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ubah PIN</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    body{
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background:#f4f6f9;
        margin:0;
        padding:0;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
    }

    .card{
        background:white;
        width:380px;
        padding:25px 30px;
        border-radius:12px;
        box-shadow:0 4px 15px rgba(0,0,0,0.15);
    }

    .card h2{
        text-align:center;
        margin-bottom:20px;
        color:#16A085;
    }

    label{
        font-weight:600;
        color:#444;
        margin-bottom:5px;
        display:block;
    }

    .input-pin{
        width:100%;
        padding:12px;
        border:1px solid #ccc;
        border-radius:8px;
        font-size:18px;
        text-align:center;
        letter-spacing:4px;
    }

    .btn{
        width:100%;
        padding:12px;
        margin-top:18px;
        border:none;
        border-radius:8px;
        background:#16A085;
        color:white;
        font-size:16px;
        cursor:pointer;
        font-weight:600;
    }

    .btn:hover{
        background:#138f76;
    }

    .alert{
        padding:12px;
        border-radius:6px;
        margin-bottom:15px;
        text-align:center;
        font-weight:600;
        font-size:14px;
    }

    .alert-success{
        background:#d4edda;
        color:#155724;
    }

    .alert-error{
        background:#f8d7da;
        color:#721c24;
    }
</style>
</head>
<body>

<div class="card">
    <h2><i class="fas fa-key"></i> Ubah PIN</h2>

    <!-- Feedback dari controller -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-error">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('sekretariat/update_pin') ?>" method="POST">

        <label>PIN Lama</label>
        <input type="password" name="pin_lama" maxlength="6" class="input-pin"
               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
               required>

        <label>PIN Baru (6 Digit)</label>
        <input type="password" name="pin_baru" maxlength="6" class="input-pin"
               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
               required>

        <label>Ulangi PIN Baru</label>
        <input type="password" name="pin_konfirmasi" maxlength="6" class="input-pin"
               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
               required>

        <button class="btn"><i class="fas fa-save"></i> Simpan PIN</button>
    </form>
</div>

</body>
</html>
