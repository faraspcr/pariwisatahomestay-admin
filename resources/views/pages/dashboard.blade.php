<!DOCTYPE html>
<html lang="id">

<head>
    <!-- ==================== START HEAD ==================== -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pariwisata Desa - Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.png') }}">

    <!-- ==================== START CSS ==================== -->
    <style>
        /* HEADER LOGO - DENGAN LOGO DAN TEKS */
        .navbar-brand-wrapper .brand-logo {
            padding: 0 !important;
            height: 60px !important;
            display: flex !important;
            align-items: center !important;
        }

        .header-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logo img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
            display: block !important;
            background: none !important;
            border: none !important;
            box-shadow: none !important;
        }

        .header-logo-text {
            color: #28a745;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-logo-mini .header-logo {
            width: 35px !important;
            height: 35px !important;
            margin-right: 0 !important;
        }

        .brand-logo-mini .header-logo-text {
            font-size: 16px !important;
        }

        /* SIDEBAR LOGO - DIUBAH UKURANNYA SEPERTI TEMPLATE LAMA */
        .sidebar-logo-section {
            text-align: center;
            padding: 15px 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-logo {
            margin: 0 auto 10px auto;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .sidebar-logo img {
            width: 60px !important;
            height: 60px !important;
            max-width: 100% !important;
            max-height: 100% !important;
            object-fit: contain !important;
            object-position: center !important;
            display: block !important;
            margin: 0 auto !important;
            background: none !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
            filter: none !important;
            border-radius: 0 !important;
            padding: 0 !important;
            transition: none !important;
        }

        .sidebar-logo-title {
            font-size: 16px !important;
            font-weight: 700 !important;
            color: white !important;
            margin: 5px 0 !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3) !important;
            letter-spacing: 0.5px !important;
        }

        .sidebar-logo-subtitle {
            font-size: 11px !important;
            color: rgba(255, 255, 255, 0.8) !important;
            margin: 0 !important;
            line-height: 1.3 !important;
            font-weight: 300 !important;
        }

        /* Sidebar Menu Items - DIUBAH UKURAN SEPERTI TEMPLATE LAMA */
        .nav {
            padding: 0 5px;
        }

        .nav-category {
            margin-top: 10px !important;
            font-size: 10px !important;
            padding: 8px 10px !important;
            color: rgba(255, 255, 255, 0.6) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        /* Menu Item Style - DIUBAH SEPERTI TEMPLATE LAMA */
        .nav-item .nav-link {
            padding: 10px 12px !important;
            border-radius: 8px !important;
            margin-bottom: 3px !important;
            display: flex !important;
            align-items: center !important;
        }

        .nav-item .nav-link:hover {
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .nav-item .nav-link .icon-bg {
            margin-right: 10px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .nav-item .nav-link .menu-icon {
            font-size: 16px !important;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .nav-item .nav-link .menu-title {
            font-size: 13px !important;
            font-weight: 500 !important;
            color: rgba(255, 255, 255, 0.9) !important;
        }

        /* Sub-menu Style - DIUBAH SEPERTI TEMPLATE LAMA */
        .sub-menu {
            padding-left: 10px !important;
            margin-top: 3px !important;
            margin-bottom: 3px !important;
        }

        .sub-menu .nav-link {
            padding: 6px 10px !important;
            font-size: 12px !important;
            border-radius: 6px !important;
            margin-bottom: 2px !important;
        }

        .sub-menu .nav-link i {
            font-size: 12px !important;
            margin-right: 6px !important;
            width: 16px !important;
            text-align: center !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .sub-menu .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .sub-menu .nav-link:hover {
            background: rgba(255, 255, 255, 0.05) !important;
        }

        /* User Display & Settings di Sidebar - DIUBAH SEPERTI TEMPLATE LAMA */
        .sidebar-user-actions {
            margin-top: 15px !important;
            padding: 10px 5px !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        /* Original CSS styles tetap ada di bawah */
        .nav-dropdown {
            list-style: none;
            padding-left: 0;
            margin: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .nav-dropdown.show {
            max-height: 500px;
        }

        .nav-dropdown .nav-item {
            padding-left: 20px;
        }

        .dropdown-toggle {
            position: relative;
            cursor: pointer;
        }

        .dropdown-toggle::after {
            content: '\f140';
            font-family: 'Material Design Icons';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
            border: none !important;
            width: auto;
            height: auto;
            color: rgba(255, 255, 255, 0.7);
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: translateY(-50%) rotate(180deg);
        }

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            animation: pulse 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
        }

        .whatsapp-float i {
            margin: 0;
        }

        /* WhatsApp Tooltip */
        .whatsapp-tooltip {
            position: absolute;
            right: 70px;
            bottom: 15px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            transform: translateX(0);
        }

        /* Pulse Animation */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* Circular Progress Styles - Like Reference */
        .circular-progress-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .circular-progress-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .circular-progress-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .circular-progress-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .circular-progress {
            position: relative;
            width: 80px;
            height: 80px;
            flex-shrink: 0;
        }

        .circular-progress-bg {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #f8f9fa;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .circular-progress-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(var(--progress-color) 0% var(--progress-percent), #e9ecef var(--progress-percent) 100%);
            mask: radial-gradient(transparent 60%, black 61%);
            -webkit-mask: radial-gradient(transparent 60%, black 61%);
        }

        .circular-progress-content {
            text-align: center;
            z-index: 2;
        }

        .circular-progress-icon {
            font-size: 24px;
            color: var(--progress-color);
            margin-bottom: 5px;
        }

        .circular-progress-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1;
        }

        .circular-progress-info {
            flex: 1;
        }

        .circular-progress-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .circular-progress-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .trend-up {
            color: #28a745;
        }

        .trend-down {
            color: #dc3545;
        }

        /* Color variations for circular progress */
        .progress-warga {
            --progress-color: #667eea;
            --progress-percent: 75%;
        }

        .progress-wisata {
            --progress-color: #f093fb;
            --progress-percent: 25%;
        }

        .progress-user {
            --progress-color: #4facfe;
            --progress-percent: 60%;
        }

        .progress-aktivitas {
            --progress-color: #43e97b;
            --progress-percent: 85%;
        }

        .progress-homestay {
            --progress-color: #ff9a9e;
            --progress-percent: 45%;
        }

        .progress-kamar {
            --progress-color: #a18cd1;
            --progress-percent: 65%;
        }

        .progress-booking {
            --progress-color: #fad0c4;
            --progress-percent: 85%;
        }

        .progress-ulasan {
            --progress-color: #ffecd2;
            --progress-percent: 55%;
        }

        /* Period Selector */
        .period-selector {
            background: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .btn-period {
            border: none;
            background: transparent;
            color: #6c757d;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 600;
            margin: 0 2px;
        }

        .btn-period.active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-period:hover {
            background: #e9ecef;
            color: #495057;
        }

        /* Chart Container */
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }

        .chart-container:hover {
            transform: translateY(-3px);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        /* Chart Canvas */
        .chart-wrapper {
            height: 300px;
            position: relative;
        }

        /* Recent Activity */
        .activity-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .activity-card:hover {
            transform: translateY(-3px);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .activity-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
            color: white;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .activity-desc {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #adb5bd;
            margin-top: 2px;
        }

        .activity-percent {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Header Styles */
        .card-header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .card-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .welcome-message {
            font-size: 1.1rem;
            color: #28a745;
            font-weight: 600;
        }

        /* Profile Section Styles */
        .profile-display {
            display: flex;
            align-items: center;
            padding: 15px;
            background: transparent;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        .profile-info h5 {
            margin: 0;
            font-weight: 700;
            color: white;
        }

        .profile-info p {
            margin: 0;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Logout Button */
        .logout-btn {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
            color: white;
            text-decoration: none;
        }

        .logout-btn i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        /* Perbaikan alignment header profile */
        .navbar-nav-right .nav-profile .nav-link {
            display: flex !important;
            align-items: center !important;
            padding: 8px 15px !important;
        }

        .navbar-nav-right .nav-profile .nav-profile-img {
            margin-right: 10px !important;
        }

        .navbar-nav-right .nav-profile .nav-profile-text {
            display: flex !important;
            align-items: center !important;
        }

        /* Hover effect untuk profile header */
        .navbar-nav-right .nav-profile .nav-link:hover {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 30px;
        }

        /* New Cards Section */
        .new-cards-section {
            margin-top: 30px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #28a745;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 25px;
            }

            .whatsapp-tooltip {
                right: 60px;
                bottom: 10px;
                font-size: 11px;
                padding: 6px 10px;
            }

            .circular-progress-wrapper {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .circular-progress-info {
                text-align: center;
            }

            .card-header-section {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .chart-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            /* Header Logo Responsive */
            .header-logo {
                width: 35px !important;
                height: 35px !important;
            }

            .header-logo-text {
                font-size: 18px !important;
            }

            /* Sidebar Logo Responsive */
            .sidebar-logo {
                width: 50px !important;
                height: 50px !important;
            }

            .sidebar-logo img {
                width: 50px !important;
                height: 50px !important;
            }

            .sidebar-logo-title {
                font-size: 14px !important;
            }

            .sidebar-logo-subtitle {
                font-size: 10px !important;
            }
        }

        /* Visitor Stats Badge */
        .visitor-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-left: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .visitor-badge i {
            margin-right: 5px;
        }

        /* Activity Status */
        .activity-status {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .status-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .status-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .status-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        /* ==================== DEVELOPER IDENTITY & SETTINGS CSS ==================== */
        .settings-logout-section {
            margin-top: 15px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-display-section {
            display: flex;
            align-items: center;
            padding: 8px;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.2), rgba(32, 201, 151, 0.1));
            border-radius: 6px;
            margin-bottom: 10px;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .user-avatar-small {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            margin-right: 10px;
            box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3);
        }

        .user-info-small h5 {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 700;
            color: white;
        }

        .user-info-small p {
            margin: 0;
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .settings-item {
            display: flex;
            align-items: center;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.05);
        }

        .settings-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(3px);
        }

        .settings-item i {
            margin-right: 8px;
            width: 18px;
            text-align: center;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .settings-item span {
            font-size: 0.85rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }

        .logout-item-sidebar {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 6px;
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-item-sidebar:hover {
            background: rgba(220, 53, 69, 0.25);
            transform: translateX(3px);
            text-decoration: none;
        }

        .logout-item-sidebar i {
            margin-right: 8px;
            width: 18px;
            text-align: center;
            font-size: 1rem;
            color: #dc3545;
        }

        .logout-item-sidebar span {
            font-size: 0.85rem;
            font-weight: 600;
            color: #dc3545;
        }

        /* ==================== DEVELOPER PAGE CSS ==================== */
        .developer-profile-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .developer-profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .developer-profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2, #28a745, #20c997);
        }

        .developer-profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f8f9fa;
        }

        .developer-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            margin-right: 25px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            border: 5px solid white;
            overflow: hidden;
        }

        .developer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .developer-info {
            flex: 1;
        }

        .developer-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .developer-title {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .developer-badge {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .developer-contact {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            color: #6c757d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-item:hover {
            color: #667eea;
            text-decoration: none;
        }

        .contact-item i {
            margin-right: 5px;
            font-size: 1.1rem;
        }

        .developer-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .detail-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .detail-title {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .detail-content {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .social-instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
        }

        .social-github {
            background: linear-gradient(45deg, #333, #555);
        }

        .social-linkedin {
            background: linear-gradient(45deg, #0077B5, #00A0DC);
        }

        .tech-stack {
            margin-top: 30px;
        }

        .tech-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f8f9fa;
        }

        .tech-icons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .tech-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #667eea;
            font-size: 1.8rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .tech-icon:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .project-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #667eea;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 600;
        }

        .developer-quote {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(32, 201, 151, 0.1));
            border-left: 4px solid #28a745;
            padding: 20px;
            margin-top: 25px;
            border-radius: 10px;
            font-style: italic;
        }

        .quote-text {
            font-size: 1.1rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .quote-author {
            text-align: right;
            font-weight: 600;
            color: #28a745;
        }
    </style>
    <!-- ==================== END CSS ==================== -->
</head>
<!-- ==================== END HEAD ==================== -->

<body>
    <div class="container-scroller">

        <!-- ==================== START HEADER ==================== -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                    <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                        <!-- LOGO di HEADER - DENGAN LOGO DAN TEKS PARIWISATA DESA -->
                        <div class="header-logo">
                            <img src="{{ asset('assets-admin/images/logopariwisata.png') }}"
                                 alt="Logo"
                                 onerror="this.onerror=null; this.src='{{ asset('images/logo-default.png') }}';">
                        </div>
                        <div class="header-logo-text">PARIWISATA DESA</div>
                    </div>
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <!-- LOGO mini di HEADER -->
                        <div class="header-logo">
                            <img src="{{ asset('assets-admin/images/logopariwisata.png') }}"
                                 alt="Logo"
                                 onerror="this.onerror=null; this.src='{{ asset('images/logo-default.png') }}';">
                        </div>
                    </div>
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <div class="search-field d-none d-xl-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Cari data...">
                        </div>
                    </form>
                </div>

                <ul class="navbar-nav navbar-nav-right">
                    <!-- Notification Bell -->
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger">5</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0 bg-primary text-white">Notifikasi</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-home"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal">Booking Baru</h6>
                                    <p class="text-gray ellipsis mb-0">1 booking homestay baru</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-star"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal">Ulasan Baru</h6>
                                    <p class="text-gray ellipsis mb-0">3 ulasan wisata baru</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-account"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal">User Baru</h6>
                                    <p class="text-gray ellipsis mb-0">1 user baru dibuat</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center"><a href="#" class="text-primary">Lihat semua
                                    notifikasi</a></h6>
                        </div>
                    </li>

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" id="profileDropdown"
                            href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img mr-3">
                                <div class="profile-avatar" style="width: 35px; height: 35px; font-size: 1.2rem;">
                                    <i class="mdi mdi-account"></i>
                                </div>
                            </div>
                            <div class="nav-profile-text d-flex align-items-center">
                                <p class="mb-0 text-black">{{ Auth::user()->name ?? 'Guest' }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                            aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                            <div class="p-3 text-center bg-primary">
                                <div class="profile-avatar"
                                    style="margin: 0 auto 15px; width: 70px; height: 70px; font-size: 2rem;">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <p class="mt-2 mb-0 text-white" style="font-weight: 700;">{{ Auth::user()->name ?? 'Guest' }}</p>
                                <small class="text-white">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                            </div>
                            <div class="p-2">
                                <h5 class="dropdown-header text-uppercase pl-2 text-dark">Akun Pengguna</h5>
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                                    href="#">
                                    <span>Profil Saya</span>
                                    <i class="mdi mdi-account-outline ml-1"></i>
                                </a>
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                                    href="javascript:void(0)">
                                    <span>Pengaturan</span>
                                    <i class="mdi mdi-settings"></i>
                                </a>
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between" href="#" style="cursor: default;">
                                    <span>Login Terakhir</span>
                                    <span class="text-muted">{{ session('last_login') ?? now()->format('d/m/Y H:i') }}</span>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item py-2 d-flex align-items-center justify-content-between"
                                    href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span>Logout</span>
                                    <i class="mdi mdi-logout ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- ==================== END HEADER ==================== -->

        <div class="container-fluid page-body-wrapper">

            <!-- ==================== START SIDEBAR ==================== -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <!-- LOGO SIDEBAR DI SINI - DIUBAH UKURAN SEPERTI TEMPLATE LAMA -->
                <div class="sidebar-logo-section">
                    <div class="sidebar-logo">
                        <img src="{{ asset('assets-admin/images/logopariwisata.png') }}"
                             alt="Logo Pariwisata"
                             onerror="this.onerror=null; this.src='{{ asset('images/logo-default.png') }}';">
                    </div>
                    <h3 class="sidebar-logo-title">PARIWISATA DESA</h3>
                    <p class="sidebar-logo-subtitle">Sistem Administrasi<br>Pariwisata & Homestay Desa</p>
                </div>

                <ul class="nav">
                    <li class="nav-item nav-category">Menu Utama</li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="icon-bg"><i class="mdi mdi-view-dashboard menu-icon"></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Fitur Utama</li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#fiturUtama"
                            aria-expanded="false" aria-controls="fiturUtama">
                            <span class="icon-bg"><i class="mdi mdi-apps menu-icon"></i></span>
                            <span class="menu-title">Fitur Utama</span>
                        </a>
                        <div class="collapse" id="fiturUtama">
                            <ul class="nav flex-column sub-menu">
                                <!-- Destinasi Wisata -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('destinasiwisata.index') }}">
                                        <i class="mdi mdi-map-marker menu-icon"></i>
                                        Destinasi Wisata
                                    </a>
                                </li>

                                <!-- HOMESTAY -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('homestay.index') }}">
                                        <i class="mdi mdi-home menu-icon"></i>
                                        Homestay
                                    </a>
                                </li>

                                <!-- KAMAR HOMESTAY -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('kamar.my') }}">
                                        <i class="mdi mdi-door-closed menu-icon"></i>
                                        Kamar Homestay
                                    </a>
                                </li>

                                <!-- BOOKING -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('booking-homestay.index') }}">
                                        <i class="mdi mdi-calendar-check menu-icon"></i>
                                        Booking
                                    </a>
                                </li>

                                <!-- Ulasan Wisata -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('ulasan_wisata.index') }}">
                                        <i class="mdi mdi-star-circle menu-icon"></i>
                                        Ulasan Wisata
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-category">Master Data</li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#masterData"
                            aria-expanded="false" aria-controls="masterData">
                            <span class="icon-bg"><i class="mdi mdi-database menu-icon"></i></span>
                            <span class="menu-title">Master Data</span>
                        </a>
                        <div class="collapse" id="masterData">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">
                                        <i class="mdi mdi-account-multiple menu-icon"></i>
                                        Manajemen User
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('warga.index') }}">
                                        <i class="mdi mdi-account-group menu-icon"></i>
                                        Data Warga
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- User Display & Settings Section - DIBAWAH MASTER DATA -->
                    <li class="nav-item sidebar-user-actions mt-4">
                        <div class="settings-logout-section">
                            <!-- User Info Display -->
                            <div class="user-display-section">
                                <div class="user-avatar-small">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <div class="user-info-small">
                                    <h5>{{ Auth::user()->name ?? 'Guest' }}</h5>
                                    <p>ADMIN PARIWISATA DESA</p>
                                </div>
                            </div>

                            <!-- Settings Item -->
                            <div class="settings-item">
                                <i class="mdi mdi-settings"></i>
                                <span>Settings</span>
                            </div>

                            <!-- Logout Item -->
                            <a href="#" class="logout-item-sidebar"
                               onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                                <i class="mdi mdi-logout"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- ==================== END SIDEBAR ==================== -->

            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Dashboard Header -->
                    <div class="card-header-section">
                        <div>
                            <h1 class="card-title">Dashboard Overview</h1>
                            <p class="card-subtitle">
                                Selamat datang <span class="welcome-message">{{ Auth::user()->name ?? 'Admin' }}</span> di dashboard Pariwisata Desa
                            </p>
                        </div>
                        <div class="period-selector">
                            <div class="btn-group" role="group" aria-label="Period selector">
                                <button type="button" class="btn btn-period active">7 Hari</button>
                                <button type="button" class="btn btn-period">1 Bulan</button>
                                <button type="button" class="btn btn-period">3 Bulan</button>
                            </div>
                        </div>
                    </div>

                    <!-- Circular Progress Charts - Data Dinamis dari Database -->
                    <div class="circular-progress-container">
                        <!-- Data Warga Progress -->
                        <div class="circular-progress-card progress-warga">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-account-group"></i>
                                            </div>
                                            <div class="circular-progress-value" id="warga-count">
                                                {{ $totalWarga ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Data Warga</div>
                                    <div class="circular-progress-trend trend-up">
                                        <i class="mdi mdi-arrow-up"></i>
                                        <span>Meningkat sejak kemarin 12.5%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Destinasi Wisata Progress -->
                        <div class="circular-progress-card progress-wisata">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-map-marker"></i>
                                            </div>
                                            <div class="circular-progress-value" id="wisata-count">
                                                {{ $totalDestinasi ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Destinasi Wisata</div>
                                    <div class="circular-progress-trend trend-up">
                                        <i class="mdi mdi-arrow-up"></i>
                                        <span>Meningkat sejak kemarin 8.3%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total User Progress -->
                        <div class="circular-progress-card progress-user">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-account-multiple"></i>
                                            </div>
                                            <div class="circular-progress-value" id="user-count">
                                                {{ $totalUser ?? 0 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Total User</div>
                                    <div class="circular-progress-trend trend-up">
                                        <i class="mdi mdi-arrow-up"></i>
                                        <span>Meningkat sejak kemarin 5.2%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Aktivitas Progress -->
                        <div class="circular-progress-card progress-aktivitas">
                            <div class="circular-progress-wrapper">
                                <div class="circular-progress">
                                    <div class="circular-progress-bg">
                                        <div class="circular-progress-ring"></div>
                                        <div class="circular-progress-content">
                                            <div class="circular-progress-icon">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </div>
                                            <div class="circular-progress-value" id="aktivitas-count">
                                                {{ $totalAktivitas ?? 25 }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="circular-progress-info">
                                    <div class="circular-progress-title">Aktivitas</div>
                                    <div class="circular-progress-trend trend-down">
                                        <i class="mdi mdi-arrow-down"></i>
                                        <span>Menurun sejak kemarin 2.3%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Circular Progress Cards for Additional Features -->
                    <div class="new-cards-section">
                        <h3 class="section-title">Statistik Tambahan</h3>
                        <div class="circular-progress-container">
                            <!-- Homestay Progress -->
                            <div class="circular-progress-card progress-homestay">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-home"></i>
                                                </div>
                                                <div class="circular-progress-value" id="homestay-count">
                                                    {{ $totalHomestay ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="circular-progress-info">
                                        <div class="circular-progress-title">Homestay</div>
                                        <div class="circular-progress-trend trend-up">
                                            <i class="mdi mdi-arrow-up"></i>
                                            <span>Meningkat sejak kemarin 7.8%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kamar Homestay Progress -->
                            <div class="circular-progress-card progress-kamar">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-door-closed"></i>
                                                </div>
                                                <div class="circular-progress-value" id="kamar-count">
                                                    {{ $totalKamar ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="circular-progress-info">
                                        <div class="circular-progress-title">Kamar Homestay</div>
                                        <div class="circular-progress-trend trend-up">
                                            <i class="mdi mdi-arrow-up"></i>
                                            <span>Meningkat sejak kemarin 9.2%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Progress -->
                            <div class="circular-progress-card progress-booking">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-calendar-check"></i>
                                                </div>
                                                <div class="circular-progress-value" id="booking-count">
                                                    {{ $totalBooking ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="circular-progress-info">
                                        <div class="circular-progress-title">Booking</div>
                                        <div class="circular-progress-trend trend-up">
                                            <i class="mdi mdi-arrow-up"></i>
                                            <span>Meningkat sejak kemarin 15.4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ulasan Wisata Progress -->
                            <div class="circular-progress-card progress-ulasan">
                                <div class="circular-progress-wrapper">
                                    <div class="circular-progress">
                                        <div class="circular-progress-bg">
                                            <div class="circular-progress-ring"></div>
                                            <div class="circular-progress-content">
                                                <div class="circular-progress-icon">
                                                    <i class="mdi mdi-star-circle"></i>
                                                </div>
                                                <div class="circular-progress-value" id="ulasan-count">
                                                    {{ $totalUlasan ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="circular-progress-info">
                                        <div class="circular-progress-title">Ulasan Wisata</div>
                                        <div class="circular-progress-trend trend-up">
                                            <i class="mdi mdi-arrow-up"></i>
                                            <span>Meningkat sejak kemarin 6.7%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts and Additional Data -->
                    <div class="row">
                        <!-- Left Column - Charts -->
                        <div class="col-md-8 grid-margin">
                            <!-- Performance Chart -->
                            <div class="chart-container">
                                <div class="chart-header">
                                    <h3 class="chart-title">Statistik Pengunjung
                                        <span class="visitor-badge">
                                            <i class="mdi mdi-eye"></i>
                                            Total: <span id="total-visitors">1,245</span> pengunjung
                                        </span>
                                    </h3>
                                    <div class="period-selector">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-period active"
                                                data-period="minggu-ini">Minggu Ini</button>
                                            <button type="button" class="btn btn-period"
                                                data-period="minggu-lalu">Minggu Lalu</button>
                                            <button type="button" class="btn btn-period"
                                                data-period="bulan-ini">Bulan Ini</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-wrapper">
                                    <canvas id="visitorChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Metrics -->
                        <div class="col-md-4 grid-margin">
                            <!-- Recent Activity -->
                            <div class="activity-card">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="chart-title mb-0">Aktivitas Terbaru</h3>
                                    <span class="badge badge-primary">Hari Ini</span>
                                </div>
                                <div id="recent-activities">
                                    <!-- Activities will be loaded dynamically -->
                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Warga Baru Terdaftar</div>
                                            <div class="activity-desc">2 warga baru ditambahkan hari ini</div>
                                            <div class="activity-time">10:30 AM</div>
                                        </div>
                                        <div class="activity-percent trend-up">+12.99%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                                            <i class="mdi mdi-map-marker"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Destinasi Wisata Baru</div>
                                            <div class="activity-desc">1 destinasi wisata ditambahkan</div>
                                            <div class="activity-time">09:15 AM</div>
                                        </div>
                                        <div class="activity-percent trend-up">+8.3%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                                            <i class="mdi mdi-home"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Homestay Baru</div>
                                            <div class="activity-desc">1 homestay baru terdaftar</div>
                                            <div class="activity-time">08:45 AM</div>
                                        </div>
                                        <div class="activity-percent trend-up">+7.8%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #a18cd1, #fbc2eb);">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Booking Baru</div>
                                            <div class="activity-desc">3 booking homestay baru</div>
                                            <div class="activity-time">Yesterday</div>
                                        </div>
                                        <div class="activity-percent trend-up">+15.4%</div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: linear-gradient(135deg, #ffecd2, #fcb69f);">
                                            <i class="mdi mdi-star-circle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <div class="activity-title">Ulasan Baru</div>
                                            <div class="activity-desc">5 ulasan wisata baru</div>
                                            <div class="activity-time">Yesterday</div>
                                        </div>
                                        <div class="activity-percent trend-up">+6.7%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== START DEVELOPER PAGE ==================== -->
                    <div class="developer-page-section" style="margin: 40px 0;">
                        <!-- Developer Header -->
                        <div class="card-header-section" style="margin-bottom: 30px;">
                            <div>
                                <h1 class="card-title">Halaman Pengembang</h1>
                                <p class="card-subtitle">Informasi developer dan kontributor sistem Pariwisata Desa</p>
                            </div>
                            <div class="welcome-message" style="background: linear-gradient(135deg, #667eea, #764ba2); padding: 8px 20px; border-radius: 30px; color: white;">
                                <i class="mdi mdi-code-tags"></i> Developer Area
                            </div>
                        </div>

                        <!-- Developer Profile Card -->
                        <div class="developer-profile-card">
                            <!-- Profile Header -->
                            <div class="developer-profile-header">
                               <div class="developer-avatar">
    <!-- Foto Profile Pengembang -->
    <img src="{{ asset('assets-admin/images/fotofaras.jpg') }}"
         alt="Faras Zakia Indrani"
         onerror="this.onerror=null; this.src='{{ asset('assets-admin/images/default-profile.jpg') }}';">
</div>
                                <div class="developer-info">
                                    <h1 class="developer-name">FARAS ZAKIA INDRANI</h1>
                                    <div class="developer-title">
                                        Mahasiswa Sistem Informasi
                                        <span class="developer-badge">
                                            <i class="mdi mdi-school"></i> Politeknik Caltex Riau
                                        </span>
                                    </div>
                                    <div class="developer-contact">
                                        <div class="contact-item">
                                            <i class="mdi mdi-identifier"></i>
                                            NIM: 2457301048
                                        </div>
                                        <div class="contact-item">
                                            <i class="mdi mdi-email"></i>
                                            faras24si@.pcr.ac.id
                                        </div>
                                        <div class="contact-item">
                                            <i class="mdi mdi-phone"></i>
                                            +62 813-6358-9715
                                        </div>
                                    </div>
                                    <div class="social-links">
                                        <a href="https://www.instagram.com/frszakiaa_?igsh=d3cwMXA5c3F4NHly" target="_blank" class="social-link social-instagram">
                                            <i class="mdi mdi-instagram"></i>
                                        </a>
                                        <a href="https://github.com/faraspcr" target="_blank" class="social-link social-github">
    <i class="fa fa-github" aria-hidden="true"></i>
</a>
                                        <a href="https://www.linkedin.com/in/faras-zakia-indrani-29b4a6360/" target="_blank" class="social-link social-linkedin">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <!-- Quote Section -->
                            <div class="developer-quote">
                                <p class="quote-text">
                                    "Membangun sistem yang tidak hanya berfungsi, tetapi juga memberikan dampak positif bagi masyarakat desa melalui teknologi."
                                </p>
                                <p class="quote-author">— Faras Zakia Indrani</p>
                            </div>

                            <!-- Copyright Notice -->
                            <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 10px; text-align: center;">
                                <p style="margin: 0; color: #6c757d; font-size: 0.9rem;">
                                    <i class="mdi mdi-copyright"></i> 2024 Sistem Pariwisata Desa v2.1.0<br>
                                    Dikembangkan dengan <i class="mdi mdi-heart" style="color: #e74c3c;"></i> oleh Faras Zakia Indrani
                                </p>
                                <div style="margin-top: 10px; font-size: 0.8rem; color: #adb5bd;">
                                    <i class="mdi mdi-shield-check"></i> Hak Cipta Dilindungi | Privacy Policy | Terms of Service
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ==================== END DEVELOPER PAGE ==================== -->

                </div>

                <!-- ==================== START FOOTER ==================== -->
                <footer class="footer">
                    <div class="footer-inner-wraper">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                                &copy; 2024 Pariwisata Desa - Sistem Manajemen Desa
                            </span>
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                                Versi 2.1.0 | Terakhir update: <span id="currentDate"></span>
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- ==================== END FOOTER ==================== -->
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <div class="whatsapp-float" id="whatsappFloat">
        <i class="mdi mdi-whatsapp"></i>
        <div class="whatsapp-tooltip">Hubungi Admin</div>
    </div>

    <!-- Logout Forms -->
    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="sidebar-logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- ==================== START JS ==================== -->
    <!-- plugins:js -->
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets-admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets-admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets-admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets-admin/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets-admin/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set user name dari Auth
            @if(Auth::check())
                const userName = "{{ Auth::user()->name }}";
                // Update welcome message
                const welcomeMessage = document.querySelector('.welcome-message');
                if (welcomeMessage) {
                    welcomeMessage.textContent = userName;
                }
            @endif

            // Set current date
            const now = new Date();
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);

            // Initialize Chart.js
            let visitorChart = null;

            function initVisitorChart() {
                const ctx = document.getElementById('visitorChart').getContext('2d');

                // Data untuk grafik pengunjung minggu ini vs minggu lalu
                const chartData = {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    dataMingguIni: [156, 189, 203, 178, 245, 312, 285],
                    dataMingguLalu: [134, 165, 187, 156, 210, 278, 245],
                    dataBulanIni: [1456, 1678, 1890, 1765, 1987, 2245, 2100]
                };

                visitorChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            label: 'Minggu Ini',
                            data: chartData.dataMingguIni,
                            borderColor: '#667eea',
                            backgroundColor: 'rgba(102, 126, 234, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }, {
                            label: 'Minggu Lalu',
                            data: chartData.dataMingguLalu,
                            borderColor: '#f093fb',
                            backgroundColor: 'rgba(240, 147, 251, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            borderDash: [5, 5]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: ${context.parsed.y} pengunjung`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false
                                },
                                ticks: {
                                    stepSize: 50,
                                    callback: function(value) {
                                        return value + ' pengunjung';
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Jumlah Pengunjung'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Hari dalam Seminggu'
                                }
                            }
                        }
                    }
                });
            }

            // Update circular progress based on data
            function updateCircularProgress() {
                // Data dari controller
                const wargaCount = {{ $totalWarga ?? 0 }};
                const wisataCount = {{ $totalDestinasi ?? 0 }};
                const userCount = {{ $totalUser ?? 0 }};
                const aktivitasCount = {{ $totalAktivitas ?? 25 }};
                const homestayCount = {{ $totalHomestay ?? 0 }};
                const kamarCount = {{ $totalKamar ?? 0 }};
                const bookingCount = {{ $totalBooking ?? 0 }};
                const ulasanCount = {{ $totalUlasan ?? 0 }};

                // Update nilai di circular progress
                document.getElementById('warga-count').textContent = wargaCount;
                document.getElementById('wisata-count').textContent = wisataCount;
                document.getElementById('user-count').textContent = userCount;
                document.getElementById('aktivitas-count').textContent = aktivitasCount;
                document.getElementById('homestay-count').textContent = homestayCount;
                document.getElementById('kamar-count').textContent = kamarCount;
                document.getElementById('booking-count').textContent = bookingCount;
                document.getElementById('ulasan-count').textContent = ulasanCount;

                // Update progress percent berdasarkan data
                updateProgressPercent('progress-warga', wargaCount, 200);
                updateProgressPercent('progress-wisata', wisataCount, 50);
                updateProgressPercent('progress-user', userCount, 50);
                updateProgressPercent('progress-aktivitas', aktivitasCount, 50);
                updateProgressPercent('progress-homestay', homestayCount, 30);
                updateProgressPercent('progress-kamar', kamarCount, 100);
                updateProgressPercent('progress-booking', bookingCount, 50);
                updateProgressPercent('progress-ulasan', ulasanCount, 100);

                // Update total visitors badge
                const totalVisitors = [156, 189, 203, 178, 245, 312, 285].reduce((a, b) => a + b, 0);
                document.getElementById('total-visitors').textContent = totalVisitors.toLocaleString();
            }

            function updateProgressPercent(className, current, max) {
                const percent = Math.min((current / max) * 100, 100);
                const element = document.querySelector('.' + className);
                if (element) {
                    element.style.setProperty('--progress-percent', percent + '%');
                }
            }

            // Load recent activities dari database
            function loadRecentActivities() {
                // Data contoh aktivitas
                const activities = [
                    {
                        title: 'Warga Baru Terdaftar',
                        description: '2 warga baru ditambahkan hari ini',
                        icon: 'mdi mdi-account-plus',
                        color: 'linear-gradient(135deg, #667eea, #764ba2)',
                        percentage: '+12.99%',
                        time: '10:30 AM'
                    },
                    {
                        title: 'Destinasi Wisata Baru',
                        description: '1 destinasi wisata ditambahkan',
                        icon: 'mdi mdi-map-marker',
                        color: 'linear-gradient(135deg, #f093fb, #f5576c)',
                        percentage: '+8.3%',
                        time: '09:15 AM'
                    },
                    {
                        title: 'Homestay Baru',
                        description: '1 homestay baru terdaftar',
                        icon: 'mdi mdi-home',
                        color: 'linear-gradient(135deg, #4facfe, #00f2fe)',
                        percentage: '+7.8%',
                        time: '08:45 AM'
                    },
                    {
                        title: 'Booking Baru',
                        description: '3 booking homestay baru',
                        icon: 'mdi mdi-calendar-check',
                        color: 'linear-gradient(135deg, #a18cd1, #fbc2eb)',
                        percentage: '+15.4%',
                        time: 'Yesterday'
                    },
                    {
                        title: 'Ulasan Baru',
                        description: '5 ulasan wisata baru',
                        icon: 'mdi mdi-star-circle',
                        color: 'linear-gradient(135deg, #ffecd2, #fcb69f)',
                        percentage: '+6.7%',
                        time: 'Yesterday'
                    }
                ];

                const container = document.getElementById('recent-activities');
                if (!container) return;

                // Kosongkan kontainer
                container.innerHTML = '';

                // Tambahkan aktivitas
                activities.forEach(activity => {
                    const activityHTML = `
                        <div class="activity-item">
                            <div class="activity-icon" style="background: ${activity.color};">
                                <i class="${activity.icon}"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">${activity.title}</div>
                                <div class="activity-desc">${activity.description}</div>
                                <div class="activity-time">${activity.time}</div>
                            </div>
                            <div class="activity-percent trend-up">${activity.percentage}</div>
                        </div>
                    `;
                    container.innerHTML += activityHTML;
                });
            }

            // Initialize data
            updateCircularProgress();
            initVisitorChart();
            loadRecentActivities();

            // Auto refresh data setiap 30 detik
            setInterval(() => {
                updateCircularProgress();
                loadRecentActivities();
            }, 30000);

            // Period selector for chart
            document.querySelectorAll('[data-period]').forEach(button => {
                button.addEventListener('click', function() {
                    const period = this.getAttribute('data-period');

                    // Update active button
                    document.querySelectorAll('[data-period]').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');

                    // Update chart data based on period
                    updateChartData(period);
                });
            });

            function updateChartData(period) {
                const chartData = {
                    'minggu-ini': [156, 189, 203, 178, 245, 312, 285],
                    'minggu-lalu': [134, 165, 187, 156, 210, 278, 245],
                    'bulan-ini': [1456, 1678, 1890, 1765, 1987, 2245, 2100]
                };

                if (visitorChart && chartData[period]) {
                    if (period === 'bulan-ini') {
                        visitorChart.data.datasets[0].data = chartData[period];
                        visitorChart.data.datasets[1].data = [];
                        visitorChart.data.datasets[0].label = 'Bulan Ini';
                    } else {
                        visitorChart.data.datasets[0].data = chartData['minggu-ini'];
                        visitorChart.data.datasets[1].data = chartData['minggu-lalu'];
                        visitorChart.data.datasets[0].label = 'Minggu Ini';
                        visitorChart.data.datasets[1].label = 'Minggu Lalu';
                    }
                    visitorChart.update();
                }
            }

            // Initialize Bootstrap collapse with proper event handling
            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('href');
                $(target).collapse('toggle');

                // Update aria-expanded attribute
                const isExpanded = $(this).attr('aria-expanded') === 'true';
                $(this).attr('aria-expanded', !isExpanded);
            });

            // Handle collapse events to update arrow icon
            $('#fiturUtama, #masterData').on('show.bs.collapse', function() {
                const toggle = $('[href="#' + this.id + '"]');
                toggle.attr('aria-expanded', 'true');
            }).on('hide.bs.collapse', function() {
                const toggle = $('[href="#' + this.id + '"]');
                toggle.attr('aria-expanded', 'false');
            });

            // Period button active state
            $('.btn-period').on('click', function() {
                $('.btn-period').removeClass('active');
                $(this).addClass('active');
            });

            // WhatsApp Floating Button Functionality
            const whatsappFloat = document.getElementById('whatsappFloat');

            if (whatsappFloat) {
                whatsappFloat.addEventListener('click', function() {
                    const phoneNumber = '6281234567890';
                    const defaultMessage =
                        'Halo Admin Pariwisata Desa! Saya perlu bantuan terkait sistem Pariwisata Desa. Bisa dibantu?';
                    const encodedMessage = encodeURIComponent(defaultMessage);
                    const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                    window.open(whatsappUrl, '_blank');
                });
            }

            // Developer Page Social Links Animation
            const socialLinks = document.querySelectorAll('.social-link');
            socialLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.1)';
                });

                link.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Tech Icons Hover Effect
            const techIcons = document.querySelectorAll('.tech-icon');
            techIcons.forEach(icon => {
                icon.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) rotate(5deg)';
                });

                icon.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) rotate(0)';
                });
            });

            // Add smooth hover effects
            document.querySelectorAll('.circular-progress-card, .chart-container, .activity-card, .developer-profile-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Simulate real-time data updates
            function simulateRealTimeUpdates() {
                setInterval(() => {
                    // Randomly update visitor count
                    const visitorBadge = document.getElementById('total-visitors');
                    if (visitorBadge) {
                        const current = parseInt(visitorBadge.textContent.replace(/,/g, ''));
                        const change = Math.floor(Math.random() * 10) - 3; // -3 to +6
                        const newValue = Math.max(1200, current + change);
                        visitorBadge.textContent = newValue.toLocaleString();
                    }
                }, 10000); // Update every 10 seconds
            }

            simulateRealTimeUpdates();
        });
    </script>
    <!-- ==================== END JS ==================== -->
</body>

</html>
