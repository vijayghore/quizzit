<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Quizzit' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/utilities.css') ?>">
    <script src="<?= base_url('js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('css/select2.min.css') ?>">
    <script src="<?= base_url('js/select2.min.js') ?>"></script>
</head>

<body class="">
    <?= view_cell('App\Cells\Navbar::render') ?>
    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
    <?= view_cell('App\Cells\Alerts::render') ?>


    <script src="<?= base_url('js/global.js') ?>"></script>
</body>

</html>