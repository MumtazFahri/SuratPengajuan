<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Step Progress Bar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .step-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .step {
            position: relative;
            padding: 10px 30px 10px 40px;
            color: #fff;
            font-weight: 600;
            flex: 1;
            text-align: center;
        }

        /* Panah bentuk kanan */
        .step::after {
            content: "";
            position: absolute;
            top: 0;
            right: -20px;
            width: 0;
            height: 0;
            border-top: 25px solid transparent;
            border-bottom: 25px solid transparent;
            border-left: 20px solid #fff;
            z-index: 2;
        }

        /* Warna tiap step */
        .step:nth-child(1) {
            background: #c0392b;
        }

        /* Merah */
        .step:nth-child(2) {
            background: #e67e22;
        }

        /* Oranye */
        .step:nth-child(3) {
            background: #7f8c8d;
        }

        /* Abu */
        .step:nth-child(4) {
            background: #2980b9;
        }

        /* Biru */
        .step:nth-child(5) {
            background: #27ae60;
        }

        /* Hijau */

        /* Hilangkan panah di terakhir */
        .step:last-child::after {
            display: none;
        }

        /* Efek hover (opsional) */
        .step:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Step Progress Bar</h2>

        <?php foreach ($progress as $p): ?>
            <div class="mb-4">
                <h5>ID <?= $p->id ?> - Value <?= $p->value ?></h5>
                <div class="step-arrow">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="step <?= ($i <= $p->value) ? 'active' : '' ?>">
                            Step <?= $i ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</body>

</html>