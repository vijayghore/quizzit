<?php $session = session(); ?>

<link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">

<nav class="navbar">
    <input type="checkbox" id="check" />
    <label for="check" class="menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
    </label>
    <div class="logo">
        <img src="<?php echo base_url('images/quizzit-logo-dark.png') ?>" alt="" height="100%">
    </div>
    <div class="nav-items">
    
        <ul class="auth">

            <?php if ($session->get('isLoggedIn')) : ?>
                <li class="nav-item"><a href="<?= base_url('/') ?>" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="<?= base_url('/dashboard') ?>" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="<?= base_url('/logout') ?>" class="nav-link">Logout</a></li>
            <?php else : ?>
                <li class="nav-item"><a href="<?= base_url('/register') ?>" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="<?= base_url('/login') ?>" class="nav-link">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>