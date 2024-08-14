<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Quizzit' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/utilities.css') ?>">
    <script src="<?= base_url('js/sweetalert2.all.min.js') ?>"></script>
    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@10.0.2/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js@10.0.2/public/assets/scripts/choices.min.js"></script>


</head>
<body class="">
    <?= view_cell('App\Cells\Navbar::render') ?>
    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
    <?= view_cell('App\Cells\Alerts::render') ?>
    
   
    <link rel="stylesheet" href="<?= base_url('js/global.js') ?>">
</body>
</html>
