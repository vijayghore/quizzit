<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        didOpen: (toast) => {
            // toast.onmouseenter = Swal.stopTimer;
            // toast.onmouseleave = Swal.resumeTimer;
        }
    });

    // Success Alert
    <?php if (session()->getFlashdata('success')) : ?>
        Toast.fire({
            icon: "success",
            title: "<?= session()->getFlashdata('success') ?>"
        });
    <?php endif; ?>

    // Error Alert
    <?php if (session()->getFlashdata('error')) : ?>
        Toast.fire({
            icon: "error",
            title: "<?= session()->getFlashdata('error') ?>"
        });
    <?php endif; ?>

    // Info Alert
    <?php if (session()->getFlashdata('info')) : ?>
        Toast.fire({
            icon: "info",
            title: "<?= session()->getFlashdata('info') ?>"
        });
    <?php endif; ?>

    // Warning Alert
    <?php if (session()->getFlashdata('warning')) : ?>
        Toast.fire({
            icon: "warning",
            title: "<?= session()->getFlashdata('warning') ?>"
        });
    <?php endif; ?>

</script>