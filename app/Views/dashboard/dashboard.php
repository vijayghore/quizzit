<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="dg gtc-4 gap-4 w-80 mx-auto mt-5">
    <!-- display svgs from the images folder in image tag-->
    <div>
        <div class="text-center">
            <a href="">
                <img src="<?= base_url('images/start-quiz.svg'); ?>" alt="Start Quiz" class="w-75 p-4 ar1by1 bg-dark hover-black border border-black rounded-2 cp" /></a>
        </div>
        <div class="text-center fs-3 text-dark">
            Start Quiz
        </div>
    </div>
    <div>
        <div class="text-center">
            <img src="<?= base_url('images/past-quizzes.svg'); ?>" alt="Past Quizzes" class="w-75 p-4 ar1by1 bg-dark hover-black border border-black rounded-2 cp" />
        </div>
        <div class="text-center fs-3 text-dark">
            Past Quizzes
        </div>
    </div>
    <div>
        <div class="text-center">
            <a href="<?php echo base_url('add-subject'); ?>">
                <img src="<?= base_url('images/new-subject.svg'); ?>" alt="New Subject" class="w-75 p-4 ar1by1 bg-dark hover-black border border-black rounded-2 cp" /></a>
        </div>
        <div class="text-center fs-3 text-dark">
            Add New Subject
        </div>
    </div>
    <div>
        <div class="text-center">
        <a href="<?php echo base_url('add-question'); ?>">
            <img src="<?= base_url('images/new-question.svg'); ?>" alt="New Question" class="w-75 p-4 ar1by1 bg-dark hover-black border border-black rounded-2 cp" /></a>
        </div>
        <div class="text-center fs-3 text-dark">
            Add New Question
        </div>
    </div>
</div>

<?= $this->endSection() ?>