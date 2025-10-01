<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="UTF-8">
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="color-scheme" content="light dark" />
    <meta name="keywords" content="Wastutalk STT Wastukancana">
    <meta name="author" content="WithDiv">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <meta property="og:image" content="<?= base_url('assets/logo.png') ?>">
    <meta property="og:image:type" content="image/png">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">

    <title>
        <?php echo isset($page_title) ? $page_title . ' - Wastutalk STT Wastukancana' : 'Wastutalk STT Wastukancana'; ?>
    </title>
    <!--end::Accessibility Meta Tags-->
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="<?= base_url(); ?>/assets/templates/AdminLTE-4.0.0-rc4/dist/css/adminlte.css"
        as="style" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/bootstrap-5.3.8-dist/css/bootstrap.min.css" />
    <!--mdb5-->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>/assets/mdb5-standar-ui-kit/css/mdb.min.css" /> -->
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/templates/AdminLTE-4.0.0-rc4/dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->


    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="<?= base_url(); ?>/assets/bootstrap-5.3.8-dist/js/bootstrap.min.js"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="<?= base_url(); ?>/assets/templates/AdminLTE-4.0.0-rc4/dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!--mdb5-->
    <!-- <script src="<?= base_url(); ?>/assets/mdb5-standar-ui-kit/js/mdb.umd.min.js"></script> -->
    <!-- jQuery -->
    <script src="<?= base_url(); ?>/assets/jquery-3.7.1/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<!--end::Head-->
<!--begin::Body-->
<!-- <style>
    .bg-body-tertiary {
        --bs-bg-opacity: 1;
        background-color: rgb(177 204 231) !important;
    }
</style> -->

<body class="fixed-header fixed-footer layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <?php $this->load->view('templates/admin/header'); ?>
        <?php $this->load->view('templates/admin/sidebar'); ?>
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <?php $this->load->view($content); ?>
        </main>
        <?php $this->load->view('templates/admin/footer'); ?>


    </div>
    <!--end::App Wrapper-->

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->

</body>
<!--end::Body-->

</html>