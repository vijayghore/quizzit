<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="w-50 mx-auto">
    <h1 class="text-center text-dark my-3">Add Question</h1>
    <form action="<?= base_url('/save-question') ?>" method="post" class="px-5">

        <div class="form-group">
            <select id="subject_id" name="subject_id" class="select2 input-dark" required>
                <option value="" disabled selected>Select Subject</option>

                <?php if (isset($subjects)) : ?>
                    <?php foreach ($subjects as $subject) : ?>
                        <option value="<?= $subject['id'] ?>"><?= $subject['description'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <textarea id="description" name="description" placeholder="Type your question here..." class="input-dark" required></textarea>
        </div>

        <div class="form-group">
            <input type="text" id="option_1" name="option_1" placeholder="Option 1" class="input-dark" required>
        </div>

        <div class="form-group">
            <input type="text" id="option_2" name="option_2" placeholder="Option 2" class="input-dark" required>
        </div>

        <div class="form-group">
            <input type="text" id="option_3" name="option_3" placeholder="Option 3" class="input-dark" required>
        </div>

        <div class="form-group">
            <input type="text" id="option_4" name="option_4" placeholder="Option 4" class="input-dark" required>
        </div>

        <div class="form-group">
            <label for="" class="label">Correct Answer</label>
            <div class="df jcc" role="group">
                <input type="radio" class="radio-hidden" name="correct_answer" id="option1" value="1" autocomplete="off">
                <label class="radio-label w-25 text-center" for="option1">Option 1</label>

                <input type="radio" class="radio-hidden" name="correct_answer" id="option2" value="2" autocomplete="off">
                <label class="radio-label w-25 text-center" for="option2">Option 2</label>

                <input type="radio" class="radio-hidden" name="correct_answer" id="option3" value="3" autocomplete="off">
                <label class="radio-label w-25 text-center" for="option3">Option 3</label>

                <input type="radio" class="radio-hidden" name="correct_answer" id="option4" value="4" autocomplete="off">
                <label class="radio-label w-25 text-center" for="option4">Option 4</label>
            </div>
        </div>

        <div class="df jcc my-3">
            <button type="submit" class="btn btn-dark mb-5">Add Question</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
