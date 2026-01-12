<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mengalihkan ke WhatsApp</title>
</head>
<body>

<script>
    window.location.href = "<?= $wa_url ?>";

    setTimeout(function () {
        window.location.href = "<?= $fallback ?>";
    }, 3000);
</script>

<p style="text-align:center;margin-top:50px">
    Mengalihkan ke WhatsApp...<br>
    Jika tidak terbuka, Anda akan diarahkan ke dashboard.
</p>

</body>
</html>
