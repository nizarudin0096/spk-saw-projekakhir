<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPK Pemilihan Supplier</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/datatables/css/dataTables.bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/skins/_all-skins.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">

    <link rel="shortcut icon" href="<?= base_url('assets/images/icon.png') ?>" type="image/x-icon">

</head>

<body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <a href="<?= base_url(); ?>" class="logo">
                <span class="logo-mini"><b>SAW</b></span>
                <span class="logo-lg">SPK <b>Supplier</b></span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <?= view('template/menu'); ?>
                </ul><!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">