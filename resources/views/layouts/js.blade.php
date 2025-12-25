{{-- ====================== START JS ====================== --}}
    <!-- plugins:js -->
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets-admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets-admin/js/misc.js') }}"></script>
    <!-- endinject -->

    <script>
        // Initialize tooltips
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    </script>
    {{-- ====================== END JS ====================== --}}


