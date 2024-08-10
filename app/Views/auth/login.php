<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/auth/auth.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/auth/login.css') ?>">
<div class="content-container">

    <div class="screen">
        <div class="msg-content df jcc aic rounded-left-2 bg-dark text-light">
            <div class="px-5">
                <h1 class="msg-heading text-light mb-3"><span class="bg-light text-dark">Welcome Back to Quizzit!</span></h1>
                <h3 class="msg-sub-heading mb-3">Log in to access your quizzes and track your progress. Ready to dive back into the fun?</h3>
                <h4 class="msg-sub-sub-heading">Learn something new every day</h4>
            </div>
        </div>

        <div class="form-content df jcc aic rounded-right-2 border">
            <form action="<?= base_url('/authenticate') ?>" method="post" class="w-100 px-5">
                <h2 class="text-center heading text-dark">Login</h2>

                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="your@email.com" class="input-dark" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="********" class="input-dark" required>
                </div>

                <div class="df jcc mt-4 gap-2">
                    <button type="submit" class="btn btn-dark">Login</button><a href="<?= base_url('/auth/google') ?>" class="btn btn-dark">Login with Google</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>