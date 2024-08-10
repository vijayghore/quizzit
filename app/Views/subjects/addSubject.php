<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-40 mx-auto">
    <h1 class="text-center my-3">Add New Subject</h1>

    <form action="<?= base_url('save-subject') ?>" method="post" class="" id="save-subject-form" onsubmit="return validateForm(event)">
        <div class="mb-3">
            <input type="text" name="description" id="description" placeholder="New Subject" class="input-dark" required>

        </div>
        <div class="mb-3 df jcc">
            <button type="submit" class="btn btn-dark" id="save-btn">Save</button>
        </div>
    </form>
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