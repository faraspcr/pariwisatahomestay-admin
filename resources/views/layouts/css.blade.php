{{-- ====================== START CSS ====================== --}}
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <!-- End layout styles -->
    <style>
        .badge-gender-male {
            background: linear-gradient(45deg, #1976D2, #64B5F6);
            color: white;
        }
        .badge-gender-female {
            background: linear-gradient(45deg, #C2185B, #F48FB1);
            color: white;
        }
        .badge-religion {
            background: linear-gradient(45deg, #388E3C, #66BB6A);
            color: white;
        }
        .badge-job {
            background: linear-gradient(45deg, #F57C00, #FFB74D);
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(41, 98, 255, 0.05);
            transform: translateY(-1px);
            transition: all 0.3s ease;
        }
        .action-buttons .btn {
            border-radius: 8px;
            margin: 2px;
        }
    </style>
    {{-- ====================== END CSS ====================== --}}
