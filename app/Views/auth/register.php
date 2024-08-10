<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/auth/auth.css') ?>">
<link rel="stylesheet" href="<?= base_url('css/auth/register.css') ?>">
<div class="content-container">

    <div class="screen">    
        <div class="form-content df jcc aic bg-dark rounded-left-2">
            <form action="<?= base_url('/store') ?>" method="post" class="w-100 px-5">
                <h2 class="text-center heading text-light">Register</h2>

                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Full Name" class="input-light" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="your@email.com"
                    class="input-light" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Secure Password" class="input-light" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="input-light" required>
                </div>

                <div class="df jcc mt-4">
                    <button type="submit" class="btn btn-light">Register</button>
                </div>
            </form>
        </div>

        <div class="msg-content border df jcc aic rounded-right-2">
            <div class="px-5">
                <h1 class="msg-heading text-light mb-3"><span class="bg-dark"> Join the Quizzit Community!</span></h1>
                <h3 class="msg-sub-heading">Unlock a world of knowledge and fun quizzes.</h3>
                <h4 class="msg-sub-heading mb-3">Challenge yourself, learn new things, and compete with friends.</h4>
                <h4 class="msg-sub-sub-heading">Ready to start your quiz journey?</h4>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>