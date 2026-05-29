<!DOCTYPE html>
<html lang="id">
@php use Illuminate\Support\Facades\Auth; @endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Toko - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { 
            --sidebar-w: 240px;
            /* Light Mode Colors */
            --bg-primary: #f0f4f8;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f8f9fa;
            --text-primary: #1a2535;
            --text-secondary: #6c757d;
            --text-muted: #adb5bd;
            --border-color: #e9ecef;
            --card-shadow: 0 1px 8px rgba(0,0,0,.06);
            --sidebar-bg: linear-gradient(180deg, #1a2535 0%, #2c3e50 100%);
            --input-bg: #ffffff;
            --input-border: #ced4da;
            --table-stripe: #f8f9fa;
            --table-hover: #f1f3f5;
        }
        
        /* Dark Mode Colors */
        [data-theme="dark"] {
            --bg-primary: #1e1e1e;
            --bg-secondary: #2d2d30;
            --bg-tertiary: #3e3e42;
            --text-primary: #ffffff;
            --text-secondary: #cccccc;
            --text-muted: #999999;
            --border-color: #3e3e42;
            --card-shadow: 0 2px 12px rgba(0,0,0,.4);
            --sidebar-bg: linear-gradient(180deg, #1e1e1e 0%, #252526 100%);
            --input-bg: #3e3e42;
            --input-border: #4e4e52;
            --table-stripe: #3e3e42;
            --table-hover: #4e4e52;
        }
        
        body { 
            background: var(--bg-primary); 
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            max-height: 100vh;
            background: linear-gradient(180deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-column: column;
            flex-direction: column;
            padding: 0;
            z-index: 100;
            box-shadow: 4px 0 30px rgba(0,0,0,.3);
            overflow-y: auto;
        }
        /* Custom Scrollbar untuk Sidebar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(0,0,0,.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,.2);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,.3);
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.1);
            background: rgba(0,0,0,.15);
        }
        .sidebar-brand .brand-name {
            color: #fff;
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: .2px;
            text-shadow: 0 2px 8px rgba(0,0,0,.3);
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-brand .brand-sub {
            color: rgba(255,255,255,.6);
            font-size: .7rem;
            margin-top: 1px;
            font-weight: 500;
        }
        .sidebar-nav { padding: 16px 12px 24px 12px; }
        .nav-label {
            color: rgba(255,255,255,.4);
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 0 8px;
            margin: 12px 0 8px;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,.7);
            text-decoration: none;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 500;
            transition: all .2s ease;
            margin-bottom: 3px;
            position: relative;
            overflow: hidden;
        }
        .sidebar-nav a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(180deg, #3498db, #2ecc71);
            transform: scaleY(0);
            transition: transform .2s ease;
        }
        .sidebar-nav a:hover { 
            color: #fff; 
            background: rgba(255,255,255,.12);
            transform: translateX(3px);
        }
        .sidebar-nav a:hover::before {
            transform: scaleY(1);
        }
        .sidebar-nav a.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.3), rgba(46, 204, 113, 0.3));
            box-shadow: 0 4px 15px rgba(52,152,219,.25);
            border-left: 3px solid #3498db;
        }
        .sidebar-nav a i { 
            font-size: 1.1rem; 
            width: 22px; 
            text-align: center;
        }
        .sidebar-nav form button:hover a {
            color: #fff;
            background: rgba(255,255,255,.08);
        }
        
        /* Submenu Styles */
        .sidebar-nav .menu-item {
            position: relative;
        }
        .sidebar-nav .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding-left: 0;
            margin: 0;
            list-style: none;
        }
        .sidebar-nav .submenu.show {
            max-height: 500px;
        }
        .sidebar-nav .submenu a {
            padding: 8px 12px 8px 44px;
            font-size: .85rem;
            margin-bottom: 2px;
        }
        .sidebar-nav .menu-toggle {
            cursor: pointer;
            position: relative;
        }
        .sidebar-nav .menu-toggle::after {
            content: '\F282';
            font-family: 'bootstrap-icons';
            position: absolute;
            right: 14px;
            transition: transform 0.3s ease;
            font-size: .9rem;
        }
        .sidebar-nav .menu-toggle.active::after {
            transform: rotate(180deg);
        }
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.06);
            margin-bottom: 10px;
        }
        .user-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .85rem; font-weight: 700;
            flex-shrink: 0;
        }
        .user-name { color: #fff; font-size: .85rem; font-weight: 600; }
        .user-role { color: rgba(255,255,255,.4); font-size: .72rem; }

        /* ── Main ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--bg-primary);
        }
        .topbar {
            background: var(--bg-secondary);
            padding: 14px 28px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: var(--card-shadow);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .topbar-title { font-size: 1.1rem; font-weight: 700; color: var(--text-primary); }
        .main-content { 
            padding: 28px; 
            flex: 1;
            background: var(--bg-primary);
        }

        /* ── Cards ── */
        .card { 
            border-radius: 12px !important;
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .card-body {
            color: var(--text-primary) !important;
        }
        .card-header {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Forms ── */
        .form-control, .form-select {
            background: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-primary) !important;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            background: var(--input-bg) !important;
            border-color: #3498db !important;
            color: var(--text-primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25) !important;
        }
        .form-control::placeholder {
            color: var(--text-muted) !important;
            opacity: 0.7;
        }
        .form-label {
            color: var(--text-primary) !important;
            font-weight: 500;
        }
        .form-text {
            color: var(--text-secondary) !important;
        }
        [data-theme="dark"] .form-control option {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .invalid-feedback {
            color: #ffa8b3 !important;
        }
        [data-theme="dark"] .valid-feedback {
            color: #8fec9f !important;
        }
        
        /* ── Tables ── */
        .table {
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        .table thead {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        .table tbody tr {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background: var(--bg-secondary) !important;
        }
        .table-striped tbody tr:nth-of-type(even) {
            background: var(--bg-secondary) !important;
        }
        .table-hover tbody tr:hover {
            background: var(--table-hover) !important;
        }
        .table-light {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .table > :not(caption) > * > * {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        
        /* ── Text Colors ── */
        [data-theme="dark"] .text-muted {
            color: #cccccc !important;
        }
        [data-theme="dark"] .text-secondary {
            color: #cccccc !important;
        }
        [data-theme="dark"] .text-primary {
            color: #5dade2 !important;
        }
        [data-theme="dark"] .text-success {
            color: #8fec9f !important;
        }
        [data-theme="dark"] .text-danger {
            color: #ffa8b3 !important;
        }
        [data-theme="dark"] .text-warning {
            color: #ffe066 !important;
        }
        [data-theme="dark"] .text-info {
            color: #7de9f7 !important;
        }
        [data-theme="dark"] h1, 
        [data-theme="dark"] h2, 
        [data-theme="dark"] h3, 
        [data-theme="dark"] h4, 
        [data-theme="dark"] h5, 
        [data-theme="dark"] h6 {
            color: #ffffff !important;
        }
        [data-theme="dark"] p,
        [data-theme="dark"] span:not(.badge),
        [data-theme="dark"] div,
        [data-theme="dark"] td,
        [data-theme="dark"] th,
        [data-theme="dark"] label {
            color: #ffffff !important;
        }
        [data-theme="dark"] strong,
        [data-theme="dark"] b {
            color: #ffffff !important;
        }
        [data-theme="dark"] a:not(.btn) {
            color: #5dade2 !important;
        }
        [data-theme="dark"] a:not(.btn):hover {
            color: #85c1e9 !important;
        }
        [data-theme="dark"] .fw-semibold,
        [data-theme="dark"] .fw-bold {
            color: #ffffff !important;
        }
        [data-theme="dark"] .card-title {
            color: #ffffff !important;
        }
        [data-theme="dark"] .topbar-title {
            color: #ffffff !important;
        }
        [data-theme="dark"] .small,
        [data-theme="dark"] small {
            color: #ffffff !important;
        }
        
        /* Force white text on all elements in dark mode */
        [data-theme="dark"] * {
            color: inherit;
        }
        [data-theme="dark"] body,
        [data-theme="dark"] .card,
        [data-theme="dark"] .table {
            color: #ffffff !important;
        }
        
        /* Override Bootstrap text utilities in dark mode */
        [data-theme="dark"] .text-dark {
            color: #ffffff !important;
        }
        [data-theme="dark"] .text-black {
            color: #ffffff !important;
        }
        [data-theme="dark"] .text-body {
            color: #ffffff !important;
        }
        [data-theme="dark"] .text-white {
            color: #ffffff !important;
        }
        [data-theme="dark"] .display-1,
        [data-theme="dark"] .display-2,
        [data-theme="dark"] .display-3,
        [data-theme="dark"] .display-4,
        [data-theme="dark"] .display-5,
        [data-theme="dark"] .display-6 {
            color: #ffffff !important;
        }
        [data-theme="dark"] .fs-1,
        [data-theme="dark"] .fs-2,
        [data-theme="dark"] .fs-3,
        [data-theme="dark"] .fs-4,
        [data-theme="dark"] .fs-5,
        [data-theme="dark"] .fs-6 {
            color: #ffffff !important;
        }
        [data-theme="dark"] .lead {
            color: #ffffff !important;
        }
        
        /* Badge in dark mode - ensure text is visible */
        [data-theme="dark"] .badge.bg-light {
            background: #6c757d !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .badge.bg-white {
            background: #6c757d !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .badge.bg-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .badge {
            color: #ffffff !important;
        }
        /* Force badge to have visible background */
        [data-theme="dark"] .badge:not(.bg-primary):not(.bg-success):not(.bg-danger):not(.bg-warning):not(.bg-info):not(.bg-dark) {
            background: #6c757d !important;
            color: #ffffff !important;
        }
        
        /* Badge Kategori - custom inline badge */
        .badge-kategori {
            background: #e8f4fd;
            color: #2980b9;
            font-size: .78rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 50px;
            display: inline-block;
        }
        [data-theme="dark"] .badge-kategori {
            background: #6c757d !important;
            color: #ffffff !important;
        }
        
        /* Fix inline style backgrounds in dark mode */
        [data-theme="dark"] [style*="background:#e8f4fd"],
        [data-theme="dark"] [style*="background:#fef3e8"],
        [data-theme="dark"] [style*="background:#f0f4f8"],
        [data-theme="dark"] [style*="background:#f8fafc"],
        [data-theme="dark"] [style*="background:#f8f9fa"],
        [data-theme="dark"] [style*="background:#e8f8f5"],
        [data-theme="dark"] [style*="background:#e8edf2"],
        [data-theme="dark"] [style*="background:#fff3f3"] {
            background: var(--bg-tertiary) !important;
        }
        
        /* Fix inline style colors in dark mode */
        [data-theme="dark"] [style*="color:#667eea"],
        [data-theme="dark"] [style*="color:#2980b9"] {
            color: #5dade2 !important;
        }
        [data-theme="dark"] [style*="color:#3498db"] {
            color: #5dade2 !important;
        }
        [data-theme="dark"] [style*="color:#e74c3c"] {
            color: #ffa8b3 !important;
        }
        
        /* ── Alerts ── */
        [data-theme="dark"] .alert-success {
            background: rgba(40, 167, 69, 0.25) !important;
            border-color: rgba(40, 167, 69, 0.5) !important;
            color: #8fec9f !important;
        }
        [data-theme="dark"] .alert-danger {
            background: rgba(220, 53, 69, 0.25) !important;
            border-color: rgba(220, 53, 69, 0.5) !important;
            color: #ffa8b3 !important;
        }
        [data-theme="dark"] .alert-warning {
            background: rgba(255, 193, 7, 0.25) !important;
            border-color: rgba(255, 193, 7, 0.5) !important;
            color: #ffe066 !important;
        }
        [data-theme="dark"] .alert-info {
            background: rgba(13, 202, 240, 0.25) !important;
            border-color: rgba(13, 202, 240, 0.5) !important;
            color: #7de9f7 !important;
        }
        
        /* ── Badges ── */
        [data-theme="dark"] .badge {
            filter: brightness(1.3) saturate(1.1);
        }
        
        /* ── Buttons ── */
        [data-theme="dark"] .btn-light {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .btn-outline-secondary {
            color: var(--text-primary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .btn-outline-secondary:hover {
            background: var(--bg-tertiary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .btn-outline-info {
            color: #5de0f5 !important;
            border-color: #5de0f5 !important;
        }
        [data-theme="dark"] .btn-outline-info:hover {
            background: rgba(13, 202, 240, 0.2) !important;
            color: #5de0f5 !important;
        }
        
        /* ── Dropdown ── */
        [data-theme="dark"] .dropdown-menu {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .dropdown-item {
            color: #ffffff !important;
        }
        [data-theme="dark"] .dropdown-item:hover {
            background: var(--bg-tertiary) !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .dropdown-divider {
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .dropdown-header {
            color: var(--text-secondary) !important;
        }
        
        /* ── Modal ── */
        [data-theme="dark"] .modal-content {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .modal-header,
        [data-theme="dark"] .modal-footer {
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .modal-title {
            color: #ffffff !important;
        }
        [data-theme="dark"] .modal-body {
            color: #ffffff !important;
        }
        [data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        
        /* ── Images & Icons ── */
        [data-theme="dark"] img {
            opacity: 0.9;
        }
        [data-theme="dark"] img:hover {
            opacity: 1;
        }
        
        /* ── Footer ── */
        [data-theme="dark"] footer {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        
        /* ── Small Text ── */
        [data-theme="dark"] .small,
        [data-theme="dark"] small {
            color: var(--text-secondary) !important;
        }
        
        /* ── List Group ── */
        [data-theme="dark"] .list-group-item {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .list-group-item:hover {
            background: var(--bg-tertiary) !important;
        }
        
        /* ── Pagination ── */
        [data-theme="dark"] .pagination .page-link {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .pagination .page-link:hover {
            background: var(--bg-tertiary) !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .pagination .page-item.active .page-link {
            background: #3498db !important;
            border-color: #3498db !important;
            color: #ffffff !important;
        }
        [data-theme="dark"] .pagination .page-item.disabled .page-link {
            background: var(--bg-secondary) !important;
            color: var(--text-muted) !important;
        }
        
        /* ── Breadcrumb ── */
        [data-theme="dark"] .breadcrumb {
            background: var(--bg-secondary) !important;
        }
        [data-theme="dark"] .breadcrumb-item,
        [data-theme="dark"] .breadcrumb-item a {
            color: var(--text-secondary) !important;
        }
        [data-theme="dark"] .breadcrumb-item.active {
            color: var(--text-primary) !important;
        }
        
        /* ── Progress Bar ── */
        [data-theme="dark"] .progress {
            background: var(--bg-tertiary) !important;
        }
        
        /* ── Nav Tabs ── */
        [data-theme="dark"] .nav-tabs {
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .nav-tabs .nav-link {
            color: var(--text-secondary) !important;
            border-color: transparent !important;
            background: transparent !important;
        }
        [data-theme="dark"] .nav-tabs .nav-link:hover {
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
            background: var(--bg-tertiary) !important;
        }
        [data-theme="dark"] .nav-tabs .nav-link.active {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) var(--border-color) var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Accordion ── */
        [data-theme="dark"] .accordion-item {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
        }
        [data-theme="dark"] .accordion-button {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .accordion-button:not(.collapsed) {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .accordion-body {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Toast ── */
        [data-theme="dark"] .toast {
            background: var(--bg-secondary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .toast-header {
            background: var(--bg-tertiary) !important;
            border-color: var(--border-color) !important;
            color: var(--text-primary) !important;
        }
        
        /* ── Offcanvas ── */
        [data-theme="dark"] .offcanvas {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .offcanvas-header {
            border-color: var(--border-color) !important;
        }
        
        /* ── Dark Mode Toggle ── */
        .theme-toggle {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 20px;
            padding: 6px 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: rgba(255,255,255,.7);
            font-size: 0.85rem;
        }
        .theme-toggle:hover {
            background: rgba(255,255,255,.15);
            color: #fff;
        }
        .theme-toggle i {
            font-size: 1rem;
        }

        /* ── Mobile Responsive ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,.5);
            z-index: 99;
        }
        .btn-hamburger {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #1a2535;
            cursor: pointer;
            padding: 4px 8px;
        }

        /* Tablet */
        @media (max-width: 992px) {
            .main-content { padding: 20px; }
            .card { margin-bottom: 16px; }
            .table-responsive { font-size: .9rem; }
        }

        /* Mobile */
        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }
            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
                z-index: 100;
                width: 240px;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-overlay.open { display: block; }
            .main-wrapper { margin-left: 0; }
            .btn-hamburger { display: inline-block; }
            .main-content { padding: 16px; }
            .topbar { padding: 12px 16px; }
            .topbar-title { font-size: .95rem; }
            .display-6 { font-size: 1.5rem !important; }
            
            /* Cards responsive */
            .row > [class*='col-'] {
                margin-bottom: 12px;
            }
            
            /* Table responsive */
            .table {
                font-size: .85rem;
            }
            .table th, .table td {
                padding: 8px 6px !important;
            }
            .btn-sm {
                font-size: .75rem;
                padding: 4px 8px;
            }
            
            /* Form responsive */
            .form-label {
                font-size: .9rem;
            }
            .form-control, .form-select {
                font-size: .9rem;
            }
            
            /* Hide some columns on mobile */
            .d-none-mobile {
                display: none !important;
            }
        }

        /* Small Mobile */
        @media (max-width: 576px) {
            .main-content { padding: 12px; }
            .topbar { padding: 10px 12px; }
            .topbar-title { font-size: .85rem; }
            
            .card-body {
                padding: 16px !important;
            }
            
            .btn {
                font-size: .85rem;
                padding: 6px 12px;
            }
            
            h1, .h1 { font-size: 1.5rem !important; }
            h2, .h2 { font-size: 1.3rem !important; }
            h3, .h3 { font-size: 1.1rem !important; }
            h4, .h4 { font-size: 1rem !important; }
            h5, .h5 { font-size: .9rem !important; }
        }
    </style>
</head>
<body>

{{-- Sidebar --}}
@php $toko = \App\Models\Toko::first(); @endphp
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-2">
            <div style="width:42px;height:42px;background:linear-gradient(135deg,#3498db,#2ecc71);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(52,152,219,.4)">
                <i class="bi bi-shop-window text-white" style="font-size:1.3rem"></i>
            </div>
            <div>
                <div class="brand-name">TAGEPE UMKM</div>
                <div class="brand-sub">pos management</div>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Main Menu</div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i> Dashboard
        </a>

        @if(Auth::user()->role === 'kasir')
        <div class="nav-label mt-3">Transaksi</div>
        
        {{-- Menu Transaksi dengan Submenu --}}
        <div class="menu-item">
            <a href="javascript:void(0)" class="menu-toggle {{ request()->routeIs('transaksi.*') || request()->routeIs('order.kasir.*') || request()->routeIs('pemesanan.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                <i class="bi bi-cash-coin"></i> Transaksi
            </a>
            <ul class="submenu {{ request()->routeIs('transaksi.*') || request()->routeIs('order.kasir.*') || request()->routeIs('pemesanan.*') ? 'show' : '' }}">
                <li><a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.index') ? 'active' : '' }}">Kasir</a></li>
                <li>
                    <a href="{{ route('order.kasir.index') }}" class="{{ request()->routeIs('order.kasir.*') ? 'active' : '' }}">
                        Order Customer
                        @php $orderMenunggu = \App\Models\OrderPublik::where('status','menunggu')->count(); @endphp
                        @if($orderMenunggu > 0)
                            <span class="badge bg-warning text-dark ms-2" style="font-size:.65rem;padding:2px 6px">{{ $orderMenunggu }}</span>
                        @endif
                    </a>
                </li>
                <li><a href="{{ route('pemesanan.index') }}" class="{{ request()->routeIs('pemesanan.*') ? 'active' : '' }}">Pemesanan</a></li>
            </ul>
        </div>
        
        <div class="nav-label mt-3">Produk</div>
        <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
            <i class="bi bi-box-seam-fill"></i> Daftar Produk
        </a>
        @endif

        @if(Auth::user()->role === 'admin')
        <div class="nav-label mt-3">Laporan</div>
        <a href="{{ route('transaksi.laporan') }}" class="{{ request()->routeIs('transaksi.laporan') || request()->routeIs('transaksi.show') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line-fill"></i> Laporan Penjualan
        </a>

        <div class="nav-label mt-3">Master Data</div>
        
        {{-- Menu Produk dengan Submenu --}}
        <div class="menu-item">
            <a href="javascript:void(0)" class="menu-toggle {{ request()->routeIs('produk.*') || request()->routeIs('kategori.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                <i class="bi bi-box-seam-fill"></i> Produk
            </a>
            <ul class="submenu {{ request()->routeIs('produk.*') || request()->routeIs('kategori.*') ? 'show' : '' }}">
                <li><a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">Daftar Produk</a></li>
                <li><a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">Kategori</a></li>
            </ul>
        </div>
        
        {{-- Menu Cabang dengan Submenu --}}
        <div class="menu-item">
            <a href="javascript:void(0)" class="menu-toggle {{ request()->routeIs('cabang.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                <i class="bi bi-building-fill"></i> Cabang
            </a>
            <ul class="submenu {{ request()->routeIs('cabang.*') ? 'show' : '' }}">
                <li><a href="{{ route('cabang.index') }}" class="{{ request()->routeIs('cabang.index') || request()->routeIs('cabang.edit') || request()->routeIs('cabang.create') ? 'active' : '' }}">Daftar Cabang</a></li>
                @php $cabangs = \App\Models\Cabang::where('is_active', true)->get(); @endphp
                @foreach($cabangs->take(3) as $cabang)
                <li><a href="{{ route('cabang.stok', $cabang->id) }}" class="{{ request()->routeIs('cabang.stok') && request()->route('id') == $cabang->id ? 'active' : '' }}">{{ $cabang->nama_cabang }}</a></li>
                @endforeach
            </ul>
        </div>
        
        <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Pengguna
        </a>
        
        {{-- Menu Pengaturan dengan Submenu --}}
        <div class="menu-item">
            <a href="javascript:void(0)" class="menu-toggle {{ request()->routeIs('toko.*') || request()->routeIs('profile.*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                <i class="bi bi-gear-fill"></i> Pengaturan
            </a>
            <ul class="submenu {{ request()->routeIs('toko.*') || request()->routeIs('profile.*') ? 'show' : '' }}">
                <li><a href="{{ route('toko.index') }}" class="{{ request()->routeIs('toko.*') ? 'active' : '' }}">Info Toko</a></li>
                <li><a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">Profil Saya</a></li>
            </ul>
        </div>
        @endif

        <div class="nav-label mt-3">Lainnya</div>
        <a href="{{ route('katalog') }}" target="_blank">
            <i class="bi bi-globe2"></i> Lihat Website
            <i class="bi bi-box-arrow-up-right ms-auto" style="font-size:.7rem;opacity:.5"></i>
        </a>
        
        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,.08);">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="width:100%;background:none;border:none;padding:0;text-align:left;cursor:pointer">
                    <a style="color:rgba(255,255,255,.6);display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;font-size:.9rem;transition:all .18s;margin-bottom:2px;text-decoration:none">
                        <i class="bi bi-box-arrow-right" style="font-size:1rem;width:20px;text-align:center"></i> Keluar
                    </a>
                </button>
            </form>
        </div>
    </nav>
</aside>

{{-- Sidebar overlay untuk mobile --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

{{-- Main --}}
<div class="main-wrapper">
    <div class="topbar">
        <div class="d-flex align-items-center gap-2">
            <button class="btn-hamburger" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <span class="topbar-title">@yield('title', 'Dashboard')</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            {{-- Notifikasi stok menipis --}}
            @php
                $user = Auth::user();
                if ($user->role === 'kasir' && $user->cabang_id) {
                    $stokMenipis = \App\Models\StokCabang::with('produk')
                        ->where('cabang_id', $user->cabang_id)
                        ->whereHas('produk', fn($q) => $q->where('status','aktif'))
                        ->whereColumn('stok', '<=', \Illuminate\Support\Facades\DB::raw('(SELECT stok_minimum FROM produks WHERE produks.id = stok_cabangs.produk_id)'))
                        ->where('stok', '>', 0)->get();
                    $stokHabis = \App\Models\StokCabang::where('cabang_id', $user->cabang_id)->where('stok', 0)->count();
                } else {
                    $stokMenipis = \App\Models\Produk::whereColumn('stok', '<=', 'stok_minimum')->where('stok', '>', 0)->where('status', 'aktif')->get();
                    $stokHabis = \App\Models\Produk::where('stok', 0)->where('status', 'aktif')->count();
                }
            @endphp
            @if($stokMenipis->count() > 0 || $stokHabis > 0)
            <div class="dropdown">
                <button class="btn btn-sm position-relative" style="background:rgba(231,76,60,.1);color:#e74c3c;border:1px solid rgba(231,76,60,.2);border-radius:8px"
                        data-bs-toggle="dropdown">
                    <i class="bi bi-bell-fill"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:.6rem">
                        {{ $stokMenipis->count() + $stokHabis }}
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0" style="min-width:280px;border-radius:12px;overflow:hidden">
                    <div class="p-3 border-bottom" style="background:#fff3f3">
                        <strong class="small text-danger"><i class="bi bi-exclamation-triangle me-1"></i>Peringatan Stok</strong>
                    </div>
                    @if($stokHabis > 0)
                    <div class="px-3 py-2 border-bottom bg-light">
                        <span class="badge bg-danger me-2">Habis</span>
                        <span class="small">{{ $stokHabis }} produk stok habis</span>
                    </div>
                    @endif
                    @foreach($stokMenipis->take(5) as $p)
                    <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center">
                        <span class="small">{{ $p->nama ?? $p->produk->nama ?? '-' }}</span>
                        <span class="badge bg-warning text-dark">Sisa {{ $p->stok }}</span>
                    </div>
                    @endforeach
                    @if($stokMenipis->count() > 5)
                    <div class="px-3 py-2 text-center">
                        <span class="small text-muted">+{{ $stokMenipis->count() - 5 }} produk lainnya</span>
                    </div>
                    @endif
                    <div class="p-2 text-center border-top">
                        <a href="{{ route('produk.index') }}" class="small text-primary">Lihat semua produk →</a>
                    </div>
                </div>
            </div>
            @endif
            <button class="btn btn-sm" onclick="toggleTheme()" id="themeToggle" style="background:rgba(52,152,219,.1);color:#3498db;border:1px solid rgba(52,152,219,.2);border-radius:8px">
                <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
            </button>
            <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ now()->translatedFormat('d F Y') }}</span>
        </div>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    {{-- Footer dengan alamat toko --}}
    <footer style="background:white;border-top:1px solid #e9ecef;padding:20px 28px;margin-top:auto">
        <div class="text-center text-muted small">
            @if($toko)
                <p class="mb-1">
                    <i class="bi bi-shop me-1"></i><strong>{{ $toko->nama_toko }}</strong>
                </p>
                <p class="mb-1">
                    <i class="bi bi-geo-alt me-1"></i>{{ $toko->alamat }}
                </p>
                <p class="mb-0">
                    <i class="bi bi-telephone me-1"></i>{{ $toko->telepon }}
                    @if($toko->email)
                        <span class="mx-2">|</span>
                        <i class="bi bi-envelope me-1"></i>{{ $toko->email }}
                    @endif
                </p>
            @else
                <p class="mb-0">sistem manajemen gue!</p>
            @endif
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Dark Mode Toggle
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeUI(newTheme);
}

function updateThemeUI(theme) {
    const icon = document.getElementById('themeIcon');
    const text = document.getElementById('themeText');
    
    if (theme === 'dark') {
        icon.className = 'bi bi-sun-fill';
        text.textContent = 'Light Mode';
    } else {
        icon.className = 'bi bi-moon-stars-fill';
        text.textContent = 'Dark Mode';
    }
}

// Load theme on page load
(function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    updateThemeUI(savedTheme);
})();

// Sidebar toggle
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('open');
}
function closeSidebar() {
    document.querySelector('.sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('open');
}
// Tutup sidebar saat klik link di mobile
document.querySelectorAll('.sidebar-nav a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) closeSidebar();
    });
});

// Toggle Submenu
function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    
    // Toggle current submenu only
    submenu.classList.toggle('show');
    element.classList.toggle('active');
}

// Auto open submenu if current page is in submenu
document.addEventListener('DOMContentLoaded', function() {
    const activeSubmenus = document.querySelectorAll('.submenu.show');
    activeSubmenus.forEach(submenu => {
        const toggle = submenu.previousElementSibling;
        if (toggle) {
            toggle.classList.add('active');
        }
    });
});
</script>
@stack('scripts')
</body>
</html>
