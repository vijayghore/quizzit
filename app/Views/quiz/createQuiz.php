<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="w-50 mx-auto">
    <h1 class="text-center text-dark my-3">Create New Quiz</h1>
    <form action="<?= base_url('/save-quiz') ?>" method="post" class="px-5">

        <div class="form-group">
            <label for="subject_id" class="form-label">Select Subject</label>
            <select id="subject_id" name="subject_id" class="select2" required>
                <option value="" disabled selected>Select Subject</option>
                <?php if (isset($subjects)) : ?>
                    <?php foreach ($subjects as $subject) : ?>
                        <option value="<?= $subject['id'] ?>"><?= $subject['description'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        
        <div class="form-group">
        <label for="total_questions" class="form-label">Total Questions in Quiz</label>
            <select id="total_questions" name="total_questions" class="select2" required>
                <option value="" disabled selected>Total Questions in Quiz</option>
                    <?php for ($i=1; $i <= 50; $i++) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="marks_per_question" class="form-label">Marks Per Question</label>
            <select id="marks_per_question" name="marks_per_question" class="select2" required>
                <option value="" disabled selected>Marks Per Question</option>
                    <?php for ($i=1; $i <= 5; $i++) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
            </select>
        </div>

        <div class="df jcc my-3">
            <button type="submit" class="btn btn-dark mb-5">Create</button>
        </div>
    </form>
</div>

<script>
      $('.select2').select2();
</script>

<?= $this->endSection() ?>
