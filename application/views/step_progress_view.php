<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Step Progress Bar Custom Text & Colors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .stepper {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .step {
            flex: 1;
            height: 45px;
            line-height: 45px;
            color: #fff;
            font-weight: 600;
            text-align: center;
            background: #ccc;
            clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 50%, calc(100% - 20px) 100%, 0 100%, 20px 50%);
            transition: background 0.3s ease;
        }

        .step:last-child {
            clip-path: polygon(0 0, calc(100% - 20px) 0, 100% 50%, calc(100% - 20px) 100%, 0 100%, 20px 50%);
        }

        .step.active {
            background: var(--step-color);
        }

        .step:not(:last-child)::after {
            content: "";
            position: absolute;
            right: -5px;
            top: 0;
            width: 10px;
            height: 100%;
            background: #fff;
            z-index: 1;
            clip-path: polygon(0 0, 100% 0, 0 50%, 100% 100%, 0 100%);
        }

        .step span {
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .step {
                font-size: 14px;
                height: 40px;
                line-height: 40px;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <?php
        $colors = [
        1  => '#b30000',
        2  => '#9e2600',
        3  => '#893d00',
        4  => '#745400',
        5  => '#5f6a00',
        6  => '#4a8000',
        7  => '#359500',
        8  => '#20a200',
        9  => '#0bae00',
        10 => '#009e00',

                 
        ];
        $labels = [
            1 => 'selesai',
            2 => 'hehe',
            3 => 'selesai',
            4 => 'hehe',
            5 => 'Selesai',
            6 => 'hehe',
            7 => 'Selesai',
            8 => 'hehe',
            9 => 'Selesai',
            10 => 'hehe'
        ];
        ?>

        <?php foreach ($progress as $p): ?>
            <?php $steps = count($colors); ?>
            <div class="mb-4">
                <div class="stepper">
                    <?php for ($i = 1; $i <= $steps; $i++): ?>
                        <?php
                        $isActive = ($i <= $p->value);
                        $stepColor = $colors[$i];
                        $label = $labels[$i];
                        ?>
                        <div class="step <?= $isActive ? 'active' : '' ?>" style="--step-color: <?= $stepColor ?>;">
                            <span><?= $label ?></span>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>