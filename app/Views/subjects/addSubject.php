<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="df gap-3 w-90 mx-auto min-vh-75">

    <div class="w-60">
        <h1 class="text-center my-3">Subjects We Already Have</h1>

        <div class="dg gtc-3 gap-2">
            <?php if ($subjects): ?>
                <?php foreach ($subjects as $i => $row): ?>
                    <div class="df aic jcc text-center bg-dark hover-black text-light p-3 rounded-1 fs-2">
                        <?= esc($row['description']) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center my-5">No subjects found.</p>
            <?php endif; ?>
        </div>

    </div>

    <div class="w-40">
        <form action="<?= base_url('save-subject') ?>" method="post" class="border border-dark rounded-2  p-3 p-sticky t-50 transform-y-50" id="save-subject-form" onsubmit="return validateForm(event)">
            <h1 class="text-center my-3">Add New Subject</h1>
            <div class="mb-3">
                <input type="text" name="description" id="description" placeholder="New Subject" class="input-dark" required>

            </div>
            <div class="mb-3 df jcc">
                <button type="submit" class="btn btn-dark" id="save-btn">Save</button>
            </div>
        </form>
    </div>
</div>


<script>
    function validateForm(event) {
        event.preventDefault(); // Prevent the form from submitting

        const form = document.getElementById("save-subject-form");

        // Check if the form is valid
        if (!form.checkValidity()) {
            // If the form is invalid, let the browser display the validation errors
            form.reportValidity();
            return;
        }

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-dark mr-2",
                cancelButton: "btn btn-dark"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You want to add new subject?",
            color: "#000000",
            html: "",
            icon: "question",
            iconColor: "#dadada",
            showConfirmButton: true,
            confirmButtonText: "Save",
            // confirmButtonColor: "#333333",
            showCancelButton: true,
            // cancelButtonColor: "#dadada",
            showCloseButton: true,

            background: 'linear-gradient(180deg, rgba(51,51,51,1) 0%, rgba(218,218,218,1) 100%)',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('save-btn').disabled = true;
                form.submit();
            }
        });
    }
</script>
<?= $this->endSection() ?>